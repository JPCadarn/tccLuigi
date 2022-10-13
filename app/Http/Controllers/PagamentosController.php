<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PagamentosController extends Controller
{
	public function save(Request $request)
	{
        if (!empty($request->file('planilha'))) {
            $planilhas = IOFactory::load($request->file('planilha')->getPathname())->getAllSheets();
            $insertData = [];
            foreach ($planilhas as $planilha) {
                foreach ($planilha->toArray() as $key => $row) {
                    if ($key === array_key_first($planilha->toArray()) && $row[0] === 'Data Venc.') {
                        continue;
                    }
                    if (!empty(array_filter($row))) {
//                        dd($row[1]);
                        $insertData[] = [
                            'data_vencimento' => DateTime::createFromFormat('m/d/Y', $row[0])->format('Y-m-d'),
                            'data_pagamento' => DateTime::createFromFormat('m/d/Y', $row[1]) ? DateTime::createFromFormat('m/d/Y', $row[1])->format('Y-m-d') : null,
                            'pago_a' => $row[3],
                            'tipo_custo' => $row[6],
                            'modo_pagamento' => $row[7],
                            'valor' => $row[10]
                        ];
                    }
                }
            }
            dd($insertData);
            if (Pagamento::insert($insertData)) {
                return redirect()->intended();
            }
        }

        if (! $Pagamento = Pagamento::find($request->id)) {
            $Pagamento = new Pagamento;
        }
        $Pagamento->pago_a = $request->pago_a;
        $Pagamento->valor = str_replace(['.', ','], ['', '.'], $request->valor);
        $Pagamento->modo_pagamento = $request->modo_pagamento;
        $Pagamento->data_vencimento = $request->data_vencimento;
        $Pagamento->data_pagamento = $request->data_pagamento;
        $Pagamento->tipo_custo = $request->tipo_custo;

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
