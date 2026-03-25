<?php

namespace App\Http\Controllers;

use App\Models\Flor;
use App\Models\User;
use Illuminate\Http\Request;

class FlorController extends Controller
{
    /**
     * Mostra a lista de todas as flores
     */
    public function ocultar($id)
    {
        $item = Flor::findOrFail($id);
        $user = auth()->user();

        $user->floresOcultas()->attach($item->id);

        return redirect()->back()->with('success', 'Item removido da sua visualização!');

    }
    public function index()
    {
        $user = auth()->user();

        // Se for Admin, traz todas as flores
        if ($user->is_admin) {
            $flores = Flor::all();
        } else {
            // Se for User, traz apenas as flores que NÃO estão na lista de ocultas dele
            $flores = Flor::whereDoesntHave('usuariosQueOcultaram', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        }

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
     * Recebe os dados do formulário e salva no banco 
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'cor' => 'required|string|max:100',
            'preco' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantidade_estoque' => 'required|integer',
        ]);
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('flores', 'public');
            $dados['imagem'] = $path;
        }



        // Cria no banco usando os dados validados
        Flor::create($dados);

        // Redireciona com sucesso
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
        // Acha a flor no banco de dados
        $flor = Flor::findOrFail($id);
        // Validação no Update para garantir que os dados estão corretos
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'cor' => 'required|string|max:100',
            'preco' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantidade_estoque' => 'required|integer',
        ]);
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('flores', 'public');
            $dados['imagem'] = $path;
        } else {
            unset($dados['imagem']);
        }
        // Atualiza os dados
        $flor->update($dados);

        // Volta para a lista
        return redirect()->route('flores.index')
            ->with('success', 'Flor atualizada com sucesso!');
    }

    /**
     * Apaga a flor do banco
     */
    public function destroy($id)
    {
        // Bloqueia se não for admin
        $user = auth()->user();
        // : Bloqueia se não for admin
        if (!$user->is_admin) {
            $user->floresOcultas()->syncWithoutDetaching([$id]);

            return redirect()->route('flores.index')->with('success', 'Item removido da sua lista.');
        }

        try {
            // Busca a flor pelo ID
            $flor = Flor::findOrFail($id);

            // Deleta a flor
            $flor->delete();

            // Redireciona de volta com sucesso
            return redirect()->route('flores.index')->with('success', 'Flor excluída com sucesso!');
        } catch (\Exception $e) {
            // Captura qualquer erro do banco e avisa
            return redirect()->back()->withErrors(['erro' => 'Erro ao excluir a flor: ' . $e->getMessage()]);
        }
    }


}
