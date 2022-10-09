<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Recebimento;

class AnaliseFinanceiraController extends Controller
{
    public function get()
    {
        $receitaTotal = Recebimento::whereRaw('data_recebimento > DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)')->sum('valor');
        $totalFixo = Pagamento::whereRaw('data_pagamento > DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) AND tipo_custo = \'F\'')->sum('valor');
        $totalVariavel = Pagamento::whereRaw('data_pagamento > DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) AND tipo_custo = \'V\'')->sum('valor');

        $margemContribuicao = $receitaTotal - $totalVariavel;
        $pontoEquilibrio = $totalFixo / $margemContribuicao;

        return [
            'margemContribuicao' => $margemContribuicao,
            'pontoEquilibrio' => $pontoEquilibrio
        ];
    }
}
