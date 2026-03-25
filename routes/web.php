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

    // Rotas do Sistema (Flores)
    Route::post('flores/{flor}', [FlorController::class, 'update'])->name('flores.update');
    Route::get('/flores', [FlorController::class, 'index'])->name('flores.index');
    Route::get('/flores/create', [FlorController::class, 'create'])->name('flores.create');
    Route::post('/flores', [FlorController::class, 'store'])->name('flores.store');
    Route::get('/flores/{id}/edit', [FlorController::class, 'edit'])->name('flores.edit');
    Route::post('/flores/{id}/ocultar', [FlorController::class, 'ocultar'])->name('flores.ocultar');

    // Rotas do Sistema (Clientes)
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::patch('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::post('/clientes/{id}/ocultar', [ClienteController::class, 'ocultar'])->name('clientes.ocultar');

    // Rotas do Sistema (Pedidos)
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::get('/pedidos/{id}/edit', [PedidoController::class, 'edit'])->name('pedidos.edit');
    Route::patch('/pedidos/{id}', [PedidoController::class, 'update'])->name('pedidos.update');
    Route::post('/pedidos/{id}/ocultar', [PedidoController::class, 'ocultar'])->name('pedidos.ocultar');

    Route::middleware('checkAdmin')->group(function () {
        Route::delete('/flores/{id}', [FlorController::class, 'destroy'])->name('flores.destroy');
        Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
        Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    });
    
    
    
    Route::get('/export-flores', function() {
        $fileName = 'Relatorio' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new FlorExport, $fileName);
    })->name('flores.export');   
});

require __DIR__.'/auth.php';