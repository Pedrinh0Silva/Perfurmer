<?php

use Illuminate\Support\Facades\Route;
// Importamos os 3 Controllers que acabámos de criar
use App\Http\Controllers\FlorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rota da Página Inicial
// Por enquanto, vamos redirecionar quem entra no site direto para a lista de flores
Route::get('/', function () {
    return redirect()->route('flores.index');
});

// Rotas de Flores (Produtos)
// O comando 'resource' cria AUTOMATICAMENTE as 7 rotas (index, create, store, edit, etc.)
Route::resource('flores', FlorController::class);

// Rotas de Clientes
Route::resource('clientes', ClienteController::class);

// Rotas de Pedidos (Vendas)
Route::resource('pedidos', PedidoController::class);

// Rota de Teste para vermos se a autenticação funciona (futuramente)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php'; // Mantém as rotas de login do Laravel Breeze/Jetstream se tiver instalado