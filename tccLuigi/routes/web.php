<?php

use App\Http\Controllers\IndexController;
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

Route::get('/teste', function (Usuario $user) {
    return view('index', ['users' => $user::all()]);
});

Route::get('/', [IndexController::class, 'index']);

Route::get('/login', function () {
	return view('login');
});

Route::post('/login', [UsuarioController::class, 'login']);

Route::get('/usuarios', [UsuarioController::class, 'getAll'])->name('usuarios');
