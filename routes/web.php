<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Exports\FlorExport;
use Maatwebsite\Excel\Facades\Excel;

// Importa Models para a Dashboard funcionar
use App\Models\Flor;
use App\Models\Cliente;
use App\Models\Pedido;

// Página inicial de boas-vindas

// Dashboard (Protegido por login) com a coluna de valor corrigida
Route::get('/dashboard', function () {
    // Busca os dados reais das contagens (flores e clientes)
    $totalFlores = Flor::count() ?? 0;
    $totalClientes = Cliente::count() ?? 0;
    
    // Busca o faturamento usando a coluna real 'valor_total'
    try {
        $faturamentoMensal = Pedido::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->sum('valor_total'); 
    } catch (\Exception $e) {
        // Se algo der errado no banco, define como 0 para não travar a tela
        $faturamentoMensal = 0;
    }

    // NOVAS BUSCAS (Adicionadas para a tabela e os avisos não quebrarem)
    try {
        // Pega as 5 vendas mais recentes
        $ultimosPedidos = Pedido::with('cliente')->latest()->take(5)->get();
        // Pega as flores com estoque <= 5 (usando a coluna exata do seu banco)
        $estoqueBaixo = Flor::where('quantidade_estoque', '<=', 5)->get();
    } catch (\Exception $e) {
        // Se a tabela ainda não existir, envia vazio para não dar erro
        $ultimosPedidos = collect(); 
        $estoqueBaixo = collect();
    }

    return view('dashboard', [
        'totalFlores' => $totalFlores,
        'totalClientes' => $totalClientes,
        'faturamentoMensal' => $faturamentoMensal,
        'ultimosPedidos' => $ultimosPedidos, // <-- Variável enviada para a tela
        'estoqueBaixo' => $estoqueBaixo      // <-- Variável enviada para a tela
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// GRUPO PROTEGIDO: Tudo aqui dentro exige que o usuário esteja logado
Route::middleware('auth')->group(function () {
    
    // Rotas de Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Suas rotas do Sistema (Flores, Clientes e Pedidos)
    Route::post('flores/{flor}', [FlorController::class, 'update'])->name('flores.update');
    Route::resource('flores', FlorController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('pedidos', PedidoController::class);
    
    Route::get('/export-flores', function() {
        
        $flores = Flor::all();
        $csvData = "ID,Nome,Cor,Preço,Quantidade Estoque\n";

        foreach ($flores as $flor) {
            $csvData .= "{$flor->id},\"{$flor->nome}\",\"{$flor->cor}\",{$flor->preco},{$flor->quantidade_estoque}\n";
        }

        $fileName = 'Relatorio' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new FlorExport, $fileName);
    })->name('flores.export');   

});

// Rotas de autenticação padrão do Laravel Breeze
require __DIR__.'/auth.php';