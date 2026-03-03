<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // <--- Importando o Model Cliente
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Lista todos os clientes
     */
    public function index()
    {
        $clientes = Cliente::all();
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
        // Validação: O email deve ser único na tabela 'clientes'
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Mostra detalhes do cliente
     */
    public function show(Cliente $cliente)
    {
        // Aqui futuramente podemos mostrar o histórico de pedidos dele!
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
            'email' => 'required|email', // Aqui tiramos o 'unique' para não dar erro se ele mantiver o mesmo email
            'telefone' => 'required',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Dados do cliente atualizados!');
    }

    /**
     * Remove o cliente
     */
    public function destroy(Cliente $cliente)
    {
        // ATENÇÃO: Se o banco estiver configurado com CASCADE,
        // isso vai apagar também todos os pedidos desse cliente.
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente removido com sucesso!');
    }
}