<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Recebimento;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index(Pagamento $pagamento, Recebimento $recebimento)
	{
		return view('index', ['pagamentos' => $pagamento::all(), 'recebimentos' => $recebimento::all()]);
	}
}
