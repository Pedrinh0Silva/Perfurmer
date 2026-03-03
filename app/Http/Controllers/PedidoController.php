<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Cliente;
use App\Models\Flor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importante para usar Transações

class PedidoController extends Controller
{
    /**
     * Lista todas as vendas realizadas
     */
    public function index()
    {
        // O 'with' já traz os dados do Cliente junto, evitando lentidão (Eager Loading)
        $pedidos = Pedido::with('cliente')->orderBy('created_at', 'desc')->get();
        
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Mostra o formulário de Nova Venda
     */
    public function create()
    {
        // Precisamos enviar a lista de clientes e flores para preencher os <select>
        $clientes = Cliente::all();
        $flores = Flor::where('quantidade_estoque', '>', 0)->get(); // Só mostra o que tem estoque

        return view('pedidos.create', compact('clientes', 'flores'));
    }

    /**
     * O CORAÇÃO DO SISTEMA: Salva a venda, os itens e baixa o estoque
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array', // O formulário deve enviar um array de produtos
        ]);

        try {
            // DB::transaction garante que ou salva TUDO ou não salva NADA (se der erro no meio)
            DB::transaction(function () use ($request) {
                
                // 1. Cria o Pedido (Cabeçalho)
                $pedido = Pedido::create([
                    'cliente_id' => $request->cliente_id,
                    'data_pedido' => now(),
                    'valor_total' => 0, // Vamos calcular logo abaixo
                    'status' => 'realizado'
                ]);

                $totalGeral = 0;

                // 2. Percorre cada item escolhido no formulário
                foreach ($request->itens as $itemData) {
                    $flor = Flor::findOrFail($itemData['flor_id']);
                    $quantidade = $itemData['quantidade'];

                    // Verifica se tem estoque suficiente
                    if ($flor->quantidade_estoque < $quantidade) {
                        throw new \Exception("Estoque insuficiente para a flor: {$flor->nome}");
                    }

                    // Calcula o subtotal desse item
                    $subtotal = $flor->preco * $quantidade;
                    $totalGeral += $subtotal;

                    // Cria o Item do Pedido
                    ItemPedido::create([
                        'pedido_id' => $pedido->id,
                        'flor_id' => $flor->id,
                        'quantidade' => $quantidade,
                        'preco_unitario' => $flor->preco,
                        'subtotal' => $subtotal
                    ]);

                    // 3. Baixa o Estoque
                    $flor->decrement('quantidade_estoque', $quantidade);
                }

                // 4. Atualiza o valor total do pedido no final
                $pedido->update(['valor_total' => $totalGeral]);
            });

            return redirect()->route('pedidos.index')->with('success', 'Venda realizada com sucesso!');

        } catch (\Exception $e) {
            // Se der erro (ex: falta de estoque), volta para o formulário com o erro
            return back()->withErrors(['erro' => $e->getMessage()]);
        }
    }

    /**
     * Mostra os detalhes de uma venda (Recibo)
     */
    public function show($id)
    {
        // Carrega o pedido com o cliente e os itens (e as flores dos itens)
        $pedido = Pedido::with(['cliente', 'itens.flor'])->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Cancela/Apaga um pedido
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        // DICA: Num sistema real, aqui nós deveríamos devolver os itens para o estoque.
        // Para simplificar agora, vamos apenas apagar o registro.
        
        $pedido->delete(); // O 'cascade' no banco vai apagar os itens automaticamente

        return redirect()->route('pedidos.index')->with('success', 'Pedido cancelado!');
    }
}