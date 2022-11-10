<?php

namespace App\Http\Controllers;

use App\Models\Recebimento;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RecebimentosController extends Controller
{
    public function save(Request $request)
    {
        if (!empty($request->file('planilhaRecebimento'))) {
            $planilhas = IOFactory::load($request->file('planilhaRecebimento')->getPathname())->getAllSheets();
            $insertData = [];
            foreach ($planilhas as $planilha) {
                foreach ($planilha->toArray(null, true, false) as $key => $row) {
                    if ($key === array_key_first($planilha->toArray(null, true, false)) && $row[($request->posicao_coluna_data_vencimento - 1)] === 'Data Venc.') {
                        continue;
                    }
                    if (!empty(array_filter($row))) {
                        $insertData[] = [
                            'data_vencimento' => Date::excelToDateTimeObject($row[($request->posicao_coluna_data_vencimento - 1)])->format('Y-m-d'),
                            'data_recebimento' => Date::excelToDateTimeObject($row[($request->posicao_coluna_data_recebimento - 1)]) ? Date::excelToDateTimeObject($row[2])->format('Y-m-d') : null,
                            'descricao' => substr($row[($request->posicao_coluna_descricao - 1)], 0, 50),
                            'paciente' => substr($row[($request->posicao_coluna_paciente - 1)], 0, 50),
                            'modo_recebimento' => $row[($request->posicao_coluna_modo_recebimento - 1)],
                            'valor' => $row[($request->posicao_coluna_valor - 1)]
                        ];
                    }
                }
            }
            if (Recebimento::insert($insertData)) {
                return redirect()->intended();
            }
        }

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
