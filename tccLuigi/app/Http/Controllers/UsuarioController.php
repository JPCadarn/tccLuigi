<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
	public function login(Request $request)
	{
		$request->validate([
			'login' => 'required',
			'senha' => 'required'
		]);
		$credenciais = $request->only('login', 'senha');
		if (Auth::attempt($credenciais)) {
			return redirect()->intended('dashboard')
				->withSuccess('Signed in');
		}
		return redirect("login")->withSuccess('Login details are not valid');
    }
}
