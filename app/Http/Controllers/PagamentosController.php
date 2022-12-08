<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PagamentosController extends Controller
{
	public function save(Request $request)
	{
        if (!empty($request->file('planilha'))) {
            $planilhas = IOFactory::load($request->file('planilha')->getPathname())->getAllSheets();
            $insertData = [];
            foreach ($planilhas as $planilha) {
                foreach ($planilha->toArray(null, true, false) as $key => $row) {
                    if ($key === array_key_first($planilha->toArray()) && $row[($request->posicao_coluna_data_vencimento - 1)] === 'Data Venc.') {
                        continue;
                    }
                    if (!empty(array_filter($row))) {
                        if(empty($row[($request->posicao_coluna_data_pagamento - 1)])){
                            $dataPagamento = null;
                        }else{
                            $dataPagamento = Date::excelToDateTimeObject($row[($request->posicao_coluna_data_pagamento - 1)])->format('Y-m-d');
                        }
                        $insertData[] = [
                            'data_vencimento' => Date::excelToDateTimeObject($row[($request->posicao_coluna_data_vencimento - 1)])->format('Y-m-d'),
                            'data_pagamento' => $dataPagamento,
                            'pago_a' => $row[($request->posicao_coluna_pago_a - 1)],
                            'tipo_custo' => $row[($request->posicao_coluna_tipo_custo - 1)],
                            'modo_pagamento' => $row[($request->posicao_coluna_modo_pagamento - 1)],
                            'valor' => $row[($request->posicao_coluna_valor - 1)]
                        ];
                    }
                }
            }
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
