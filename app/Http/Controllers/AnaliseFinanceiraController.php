<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Recebimento;

class AnaliseFinanceiraController extends Controller
{
    public function get()
    {
        $receitaTotal = Recebimento::whereRaw('data_vencimento >= DATE_SUB((SELECT MAX(r2.data_recebimento) FROM recebimentos r2), INTERVAL 30 DAY)')->sum('valor');
        $totalVariavel = Pagamento::whereRaw('data_vencimento >= DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2 WHERE tipo_custo = \'V\'), INTERVAL 30 DAY) AND tipo_custo = \'V\'')->sum('valor');
        $totalFixo = Pagamento::whereRaw('data_vencimento >= DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2 WHERE tipo_custo = \'F\'), INTERVAL 30 DAY) AND tipo_custo = \'F\'')->sum('valor');

        $margemContribuicao = $receitaTotal - $totalVariavel;
        $pontoEquilibrio = $totalFixo / $margemContribuicao;

        return [
            'margemContribuicao' => number_format($margemContribuicao, 2, ',', '.'),
            'pontoEquilibrio' => number_format($pontoEquilibrio, 2, ',', '.'),
            'receitaTotal' => 'R$ '.number_format($receitaTotal, 2, ',', '.'),
            'totalFixo' => 'R$ '.number_format($totalFixo, 2, ',', '.'),
            'totalVariavel' => 'R$ '.number_format($totalVariavel, 2, ',', '.')
        ];
    }
}
