<?php

use App\Http\Controllers\AnaliseFinanceiraController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PagamentosController;
use App\Http\Controllers\PrecificacaoController;
use App\Http\Controllers\RecebimentosController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [IndexController::class, 'index'])->name('index')->middleware('auth');

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'customLogin'])->name('login.make');

Route::post('/pagamentos/delete/{id}', [PagamentosController::class, 'delete'])->name('pagamentos.delete')->middleware('auth');
Route::post('/pagamentos/save', [PagamentosController::class, 'save'])->name('pagamentos.save')->middleware('auth');
Route::get('/pagamentos/{id}', [PagamentosController::class, 'get'])->name('pagamentos.get')->middleware('auth');

Route::post('/recebimentos/delete/{id}', [RecebimentosController::class, 'delete'])->name('recebimentos.delete')->middleware('auth');
Route::post('/recebimentos/save', [RecebimentosController::class, 'save'])->name('recebimentos.save')->middleware('auth');
Route::get('/recebimentos/{id}', [RecebimentosController::class, 'get'])->name('recebimentos.get')->middleware('auth');

Route::get('/analiseFinanceira', [AnaliseFinanceiraController::class, 'get'])->name('analiseFinanceira.get')->middleware('auth');

Route::get('/precificacao', [PrecificacaoController::class, 'get'])->name('precificacao.get')->middleware('auth');
