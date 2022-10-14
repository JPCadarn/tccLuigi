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

        $diferencaTotais = $totalFixo - $totalVariavel;
        $valorMedio = abs($diferencaTotais / $numeroClientes);
        $numeroMinimoClientes = abs($diferencaTotais / $valorMedio);

        return [
            'valorMedio' => $valorMedio,
            'numeroMinimoClientes' => $numeroMinimoClientes,
            'totalFixo' => $totalFixo,
            'totalVariavel' => $totalVariavel,
            'numeroClientes' => $numeroClientes
        ];
    }
}
