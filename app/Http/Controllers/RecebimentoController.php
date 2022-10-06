<?php

namespace App\Http\Controllers;

use App\Models\Recebimento;
use Illuminate\Http\Request;

class RecebimentoController extends Controller
{
    public function save(Request $request)
    {
        if (! $Recebimento = Recebimento::find($request->id)) {
            $Recebimento = new Recebimento;
        }
        $Recebimento->valor = str_replace(['.', ','], ['', '.'], $request->valor);
        $Recebimento->descricao = $request->descricao;
        $Recebimento->paciente = $request->paciente;
        $Recebimento->modo_recebimento = $request->modo_recebimento;
        $Recebimento->data_vencimento = $request->data_vencimento;
        $Recebimento->data_recebimento = $request->data_recebimento;

        if ($Recebimento->save()) {
            return redirect()->intended();
        }
    }

    public function delete(Request $request)
    {
        if (Recebimento::destroy($request->id)) {
            return redirect()->intended();
        }
    }

    public function get(Request $request)
    {
        return Recebimento::find($request->id);
    }
}
