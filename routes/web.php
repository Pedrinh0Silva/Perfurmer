<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Exports\FlorExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Flor;
use App\Models\Cliente;
use App\Models\Pedido;

// --- ALTERAÇÃO AQUI ---
// Quando acessar o site (/) ele abre o login
Route::get('/', function () {
    return view('auth.login'); 
});
// -----------------------

// Dashboard (Protegido por login)
Route::get('/dashboard', function () {
    $totalFlores = Flor::count() ?? 0;
    $totalClientes = Cliente::count() ?? 0;
    
    try {
        $faturamentoMensal = Pedido::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->sum('valor_total'); 
    } catch (\Exception $e) {
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

// GRUPO PROTEGIDO
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('flores', FlorController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('pedidos', PedidoController::class);
    
    Route::get('/export-flores', function() {
        $fileName = 'Relatorio' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new FlorExport, $fileName);
    })->name('flores.export');   
});

require __DIR__.'/auth.php';