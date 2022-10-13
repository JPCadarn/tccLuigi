<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Recebimento;

class AnaliseFinanceiraController extends Controller
{
    public function get()
    {
        $totalVariavel = Pagamento::whereRaw('data_vencimento > DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2), INTERVAL 30 DAY) AND tipo_custo = \'V\'')->sum('valor');
        $receitaTotal = Recebimento::whereRaw('data_recebimento > DATE_SUB((SELECT MAX(r2.data_recebimento) FROM recebimentos r2), INTERVAL 30 DAY)')->sum('valor');
        $totalFixo = Pagamento::whereRaw('data_pagamento > DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2), INTERVAL 30 DAY) AND tipo_custo = \'F\'')->sum('valor');

        $margemContribuicao = $receitaTotal - $totalVariavel;
        $pontoEquilibrio = $totalFixo / $margemContribuicao;

        return [
            'margemContribuicao' => $margemContribuicao,
            'pontoEquilibrio' => $pontoEquilibrio,
            'receitaTotal' => $receitaTotal,
            'totalFixo' => $totalFixo,
            'totalVariavel' => $totalVariavel
        ];
    }
}
