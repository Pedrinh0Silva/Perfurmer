<?php

namespace App\Http\Controllers;

use App\Models\Flor; // <--- Importante: Avisar que vamos usar o Model Flor
use Illuminate\Http\Request;

class FlorController extends Controller
{
    /**
     * Mostra a lista de todas as flores (Página Inicial do Catálogo)
     */
    public function index()
    {
        // 1. Vai no banco e pega TUDO da tabela 'flores'
        $flores = Flor::all();
        
        // 2. Manda esses dados para a View (telas/HTML)
        // A função compact('flores') cria um pacote com os dados
        return view('flores.index', compact('flores'));
    }

    /**
     * Mostra o formulário para criar uma nova flor
     */
    public function create()
    {
        return view('flores.create');
    }

    /**
     * Recebe os dados do formulário e salva no banco (A Mágica acontece aqui)
     */
    public function store(Request $request)
    {
        // 1. Validação (Segurança Básica)
        // Garante que o usuário não mandou o nome vazio ou preço com letras
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|numeric',
            'quantidade_estoque' => 'required|integer',
        ]);

        // 2. Cria no banco usando os dados que vieram do formulário
        Flor::create($request->all());

        // 3. Redireciona para a lista com uma mensagem de sucesso
        return redirect()->route('flores.index')
            ->with('success', 'Flor cadastrada com sucesso!');
    }

    /**
     * Mostra os detalhes de uma única flor
     */
    public function show(Flor $flor)
    {
        return view('flores.show', compact('flor'));
    }

    /**
     * Mostra o formulário para editar uma flor existente
     */
    public function edit(Flor $flor)
    {
        return view('flores.edit', compact('flor'));
    }

    /**
     * Atualiza os dados no banco (Igual ao store, mas para editar)
     */
    public function update(Request $request, Flor $flor)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|numeric',
        ]);

        $flor->update($request->all());

        return redirect()->route('flores.index')
            ->with('success', 'Flor atualizada com sucesso!');
    }

    /**
     * Apaga a flor do banco
     */
    public function destroy(Flor $flor)
    {
        $flor->delete();

        return redirect()->route('flores.index')
            ->with('success', 'Flor removida com sucesso!');
    }
}