<?php

namespace App\Http\Controllers;

use App\Models\Flor; 
use Illuminate\Http\Request;

class FlorController extends Controller
{
    /**
     * Mostra a lista de todas as flores (Página Inicial do Catálogo)
     */
    public function index()
    {
        $flores = Flor::all();
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
        // 1. Validação: Adicionamos a regra exigindo a 'cor'
        $request->validate([
            'nome' => 'required|string|max:255',
            'cor'  => 'required|string|max:100', // <--- Validação da Cor aqui!
            'preco' => 'required|numeric',
            'quantidade_estoque' => 'required|integer',
        ]);

        // 2. Cria no banco usando os dados validados
        Flor::create($request->all());

        // 3. Redireciona com sucesso
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
    public function edit(string $id)
    {
        $flor = Flor::findOrFail($id);
        return view('flores.edit', compact('flor'));
    }

    /**
     * Atualiza os dados no banco
     */
    public function update(Request $request, string $id)
    {
        // 1. Validação no Update também para garantir a segurança!
        $request->validate([
            'nome' => 'required|string|max:255',
            'cor'  => 'required|string|max:100', // <--- Validação da Cor aqui também!
            'preco' => 'required|numeric',
            'quantidade_estoque' => 'required|integer',
        ]);

        // 2. Acha a flor no banco de dados
        $flor = Flor::findOrFail($id);
        
        // 3. Atualiza os dados
        $flor->update($request->all());
        
        // 4. Volta para a lista
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