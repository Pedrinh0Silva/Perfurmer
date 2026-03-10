<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Página inicial de boas-vindas
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Protegido por login)
Route::get('/dashboard', function () {
    return view('dashboard');
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

}); // <- O grupo protegido fecha aqui!

// Rotas de autenticação padrão do Laravel Breeze
require __DIR__.'/auth.php';