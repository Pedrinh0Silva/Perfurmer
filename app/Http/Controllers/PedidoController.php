<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Cliente;
use App\Models\Flor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class PedidoController extends Controller
{
    /**
     * Lista todas as vendas realizadas
     */
    public function index()
    {
        // traz os dados disponíveis do cliente junto, evitando consultas extras.
        $pedidos = Pedido::with('cliente')->orderBy('created_at', 'desc')->get();      
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Mostra o formulário de Nova Venda
     */
    public function create()
    {
        $clientes = Cliente::all(); // Busca todos os clientes
        $flores = Flor::all();     // Busca todas as flores 
        
        return view('pedidos.create', compact('clientes', 'flores'));
    }

    /**
     *  Salva a venda, os itens e baixa o estoque
     */
    public function store(Request $request)
    {
        // Validação blindada: verifica o array e o que tem dentro dele
        $request->validate([
            'cliente_id'         => 'required|exists:clientes,id',
            'itens'              => 'required|array|min:1',
            'itens.*.flor_id'    => 'required|exists:flores,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'forma_pagamento'    => 'nullable|string|max:100',
        ]);

        try {
            // DB::transaction garante que ou salva TUDO ou desfaz TUDO
            DB::transaction(function () use ($request) {
                
                // 2. Cria o Pedido (Cabeçalho)
                $pedido = Pedido::create([
                    'cliente_id'  => $request->cliente_id,
                    'data_pedido' => now(),
                    'valor_total' => 0, // Vamos atualizar logo abaixo
                    'status'      => 'realizado',
                    'forma_pagamento' => $request->forma_pagamento ?? 'Não especificada'
                ]);

                $totalGeral = 0;

                // Percorre cada item escolhido no formulário
                foreach ($request->itens as $itemData) {
                    $flor = Flor::findOrFail($itemData['flor_id']);
                    $quantidade = $itemData['quantidade'];

                    // Verifica se tem estoque suficiente
                    if ($flor->quantidade_estoque < $quantidade) {
                        throw new \Exception("Estoque insuficiente para a flor: {$flor->nome}. Disponível: {$flor->quantidade_estoque}");
                    }

                    // Calcula o subtotal desse item usando o preço do banco (segurança máxima)
                    $subtotal = $flor->preco * $quantidade;
                    $totalGeral += $subtotal;

                    // Cria o Item do Pedido
                    ItemPedido::create([
                        'pedido_id'      => $pedido->id,
                        'flor_id'        => $flor->id,
                        'quantidade'     => $quantidade,
                        'preco_unitario' => $flor->preco,
                        'subtotal'       => $subtotal,
                        'forma_pagamento' => $request->forma_pagamento ?? 'Não especificada',
                    ]);

                    // Baixa o Estoque
                    $flor->decrement('quantidade_estoque', $quantidade);
                }

                // Atualiza o valor total do pedido no final
                $pedido->update(['valor_total' => $totalGeral]);
            });

            return redirect()->route('pedidos.index')->with('success', 'Venda realizada com sucesso!');

        } catch (\Exception $e) {
            // Se der erro, volta para a tela anterior mantendo os dados preenchidos
            return back()->withInput()->withErrors(['erro' => $e->getMessage()]);
        }
    }

    /**
     * Mostra os detalhes de uma venda 
     */
    public function show($id)
    {
        // Carrega o pedido com dados e itens do cliente, em uma única consulta
        $pedido = Pedido::with(['cliente', 'itens.flor'])->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Cancela/Apaga um pedido
     */
    public function destroy($id)
    {
        // BARRAMENTO: Bloqueia se não for admin
        if (!auth()->user()->is_admin) {
            return redirect()->back()->withErrors(['erro' => 'Acesso negado! Apenas administradores podem excluir vendas.']);
        }

        try {
            // Busca o pedido pelo ID
            $pedido = Pedido::findOrFail($id);
            
            // Deleta o pedido
            $pedido->delete();

            // Redireciona de volta com sucesso
            return redirect()->route('pedidos.index')->with('success', 'Venda excluída com sucesso!');

        } catch (\Exception $e) {
            // Captura qualquer erro
            return redirect()->back()->withErrors(['erro' => 'Erro ao excluir a venda: ' . $e->getMessage()]);
        }
    }
}