<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\RecebimentoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->middleware('auth');

Route::get('/login', function () {
    return view('login');
})->name('login.form');
Route::post('/login', [UsuarioController::class, 'customLogin'])->name('login.make');

Route::post('/pagamentos/insert', [PagamentoController::class, 'insert'])->name('pagamentos.insert')->middleware('auth');

Route::post('/recebimentos/insert', [RecebimentoController::class, 'insert'])->name('recebimentos.insert')->middleware('auth');
