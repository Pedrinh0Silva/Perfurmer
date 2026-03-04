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

Route::get('/', function () {
    return redirect()->route('flores.index');
});

// Rotas de Flores (Produtos)
Route::resource('flores', FlorController::class);

// Rotas de Clientes
Route::resource('clientes', ClienteController::class);

// Rotas de Pedidos (Vendas)
Route::resource('pedidos', PedidoController::class);

