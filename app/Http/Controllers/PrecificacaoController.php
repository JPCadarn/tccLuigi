<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Recebimento;

class PrecificacaoController extends Controller
{
    public function get()
    {
        $totalVariavel = Pagamento::whereRaw('data_vencimento >= DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2 WHERE tipo_custo = \'V\'), INTERVAL 30 DAY) AND tipo_custo = \'V\'')->sum('valor');
        $totalFixo = Pagamento::whereRaw('data_vencimento >= DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2 WHERE tipo_custo = \'F\'), INTERVAL 30 DAY) AND tipo_custo = \'F\'')->sum('valor');
        $numeroClientes = Recebimento::whereRaw('data_recebimento >= DATE_SUB((SELECT MAX(r2.data_recebimento) FROM recebimentos r2), INTERVAL 30 DAY)')->count();
        $totalPagamentos = Recebimento::whereRaw('data_vencimento >= DATE_SUB((SELECT MAX(r2.data_recebimento) FROM recebimentos r2), INTERVAL 30 DAY)')->sum('valor');

        $mediaConsulta = abs($totalPagamentos / $numeroClientes);
        $receitaMedia = $mediaConsulta * $numeroClientes;
        $margemContribuicao = ($receitaMedia - $totalVariavel) / $receitaMedia;
        $pontoEquilibrio = $totalFixo / $margemContribuicao;
        $valorMinimo = $pontoEquilibrio / $numeroClientes;
        $nroMinimoClientesComPrecificacao = ceil($pontoEquilibrio / $mediaConsulta);

        return [
            'valorMedio' => 'R$ '.number_format($mediaConsulta, 2, ',', '.'),
            'totalFixo' => 'R$ '.number_format($totalFixo, 2, ',', '.'),
            'totalVariavel' => 'R$ '.number_format($totalVariavel, 2, ',', '.'),
            'numeroClientes' => number_format($numeroClientes, 2, ',', '.'),
            'receitaMedia' => 'R$ '.number_format($receitaMedia, 2, ',', '.'),
            'margemContribuicao' => number_format($margemContribuicao, 2, ',', '.'),
            'pontoEquilibrio' => number_format($pontoEquilibrio, 2, ',', '.'),
            'valorMinimo' => 'R$ '.number_format($valorMinimo, 2, ',', '.'),
            'nroMinimoClientesComPrecificacao' => $nroMinimoClientesComPrecificacao,
        ];
    }
}
