<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContatoController;

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

Route::get('/', function () {
    return view('welcome');
});


// Rotas para clientes (CRUD completo com Route::resource)
Route::resource('clientes', ClienteController::class);

// Rotas para contatos (CRUD completo com Route::resource)
Route::resource('contatos', ContatoController::class);
Route::delete('/contatos/{id}', [ContatoController::class, 'destroy'])->name('contatos.destroy');


// Rota personalizada para busca de cliente
Route::get('/contato/busca_cliente', [ContatoController::class, 'busca_cliente'])->name('contato.busca_cliente');

/*
Route::resource('clientes', ClienteController::class);
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::resource('contatos', ContatoController::class);
Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.index');
Route::get('/contatos/{contatos}/edit', [ContatoController::class, 'edit'])->name('contatos.edit');
Route::put('/contatos/{contatos}', [ContatoController::class, 'update'])->name('contatos.update');
Route::delete('/contatos/{contatos}', [ContatoController::class, 'destroy'])->name('contatos.destroy');
Route::get('/contato/busca_cliente', [ContatoController::class, 'busca_cliente'])->name('contato.busca_cliente');

*/


