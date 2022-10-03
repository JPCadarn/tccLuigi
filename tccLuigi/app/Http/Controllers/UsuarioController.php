<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
	public function login(Request $request)
	{
		dd($request);
    }

	public function getAll(Usuario $usuario)
	{
		return $usuario::all();
	}
}
