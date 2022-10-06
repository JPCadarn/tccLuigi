<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
	public function save(Request $request)
	{
        if (! $Pagamento = Pagamento::find($request->id)) {
            $Pagamento = new Pagamento;
        }
        $Pagamento->pago_a = $request->pago_a;
        $Pagamento->valor = str_replace(['.', ','], ['', '.'], $request->valor);
        $Pagamento->modo_pagamento = $request->modo_pagamento;
        $Pagamento->data_vencimento = $request->data_vencimento;
        $Pagamento->data_pagamento = $request->data_pagamento;

        if ($Pagamento->save()) {
            return redirect()->intended();
        }
    }

    public function delete(Request $request)
    {
        if (Pagamento::destroy($request->id)) {
            return route('index');
        }
    }

    public function get(Request $request)
    {
        return Pagamento::find($request->id);
    }
}
