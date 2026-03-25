<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function ocultar($id)
    {
        $item = Cliente::findOrFail($id);
        $user = auth()->user();


        $user->clientesOcultos()->attach($item->id);

        return redirect()->back()->with('success', 'Item removido da sua visualização!');
    }
    /**
     * Lista dos clientes
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            $clientes = Cliente::all();
        } else {
            $clientes = Cliente::whereDoesntHave('usuariosQueOcultaram', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        }

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Mostra o formulário de cadastro
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Salva o cliente no banco
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'nullable|string|max:20',

            'cep' => 'nullable|string|max:10',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:20',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
        ]);

        Cliente::create($validatedData);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Mostra detalhes do cliente
     */
    public function show(Cliente $cliente)
    {
        // Mostra o histórico de pedidos do cliente
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Mostra formulário de edição
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza os dados
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'required',

            'cep' => 'nullable|string|max:10',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:20',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Dados do cliente atualizados!');
    }

    /**
     * Remove o cliente
     */
    public function destroy($id)
    {
        $user = auth()->user();
        // : Bloqueia se não for admin
        if (!$user->is_admin) {
            $user->floresOcultas()->syncWithoutDetaching([$id]);

            return redirect()->route('flores.index')->with('success', 'Item removido da sua lista.');
        }

        try {
            //  Busca o cliente no banco
            $cliente = Cliente::findOrFail($id);

            //  Tenta excluir
            $cliente->delete();

            //  Se deu certo, volta para a lista com mensagem de sucesso
            return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');

        } catch (\Exception $e) {
            //  Se o banco bloquear, mostra este erro:
            return redirect()->back()->withErrors(['erro' => 'Não é possível excluir este cliente, pois ele possui pedidos vinculados a ele.']);
        }
    }
}