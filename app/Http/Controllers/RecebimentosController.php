<?php

namespace App\Http\Controllers;

use App\Models\Recebimento;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RecebimentosController extends Controller
{
    public function save(Request $request)
    {
        if (!empty($request->file('planilhaRecebimento'))) {
            $planilhas = IOFactory::load($request->file('planilhaRecebimento')->getPathname())->getAllSheets();
            $insertData = [];
            foreach ($planilhas as $planilha) {
                foreach ($planilha->toArray() as $key => $row) {
                    if ($key === array_key_first($planilha->toArray()) && $row[0] === 'Data Atend.') {
                        continue;
                    }
                    if (!empty(array_filter($row))) {
                        $insertData[] = [
                            'data_vencimento' => DateTime::createFromFormat('m/d/Y', $row[1])->format('Y-m-d'),
                            'data_recebimento' => DateTime::createFromFormat('m/d/Y', $row[2]) ? DateTime::createFromFormat('m/d/Y', $row[2])->format('Y-m-d') : null,
                            'descricao' => substr($row[3], 0, 50),
                            'paciente' => substr($row[6], 0, 50),
                            'modo_recebimento' => $row[12],
                            'valor' => $row[14]
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
