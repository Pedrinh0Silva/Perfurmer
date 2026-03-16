<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

// Importa Models para a Dashboard funcionar
use App\Models\Flor;
use App\Models\Cliente;
use App\Models\Pedido;



// Página inicial de boas-vindas
Route::get('/', function () {
    return view('welcome');
});

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

    return view('dashboard', [
        'totalFlores' => $totalFlores,
        'totalClientes' => $totalClientes,
        'faturamentoMensal' => $faturamentoMensal
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// GRUPO PROTEGIDO: Tudo aqui dentro exige que o usuário esteja logado
Route::middleware('auth')->group(function () {
    
    // Rotas de Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Suas rotas do Sistema (Flores, Clientes e Pedidos)
    Route::resource('flores', FlorController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('pedidos', PedidoController::class);

});

// Rotas de autenticação padrão do Laravel Breeze
require __DIR__.'/auth.php';