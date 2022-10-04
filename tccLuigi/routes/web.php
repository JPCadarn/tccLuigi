<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\PrecificacaoController;
use App\Http\Controllers\RecebimentoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
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

require __DIR__.'/auth.php';

Route::get('/teste', function (Usuario $user) {
	return view('index', ['users' => $user::all()]);
});

Route::get('/', [IndexController::class, 'index']);

Route::get('/login', function () {
	return view('login');
})->name('login.form');
Route::post('/login', [UsuarioController::class, 'login'])->name('login.make');

Route::post('/pagamentos/insert', [PagamentoController::class, 'insert'])->name('pagamentos.insert');

Route::post('/recebimentos/insert', [RecebimentoController::class, 'insert'])->name('recebimentos.insert');

Route::post('/precificao/insert', [PrecificacaoController::class, 'insert'])->name('precificacao.insert');
