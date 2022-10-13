<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Recebimento;
use Illuminate\Http\Request;

class PrecificacaoController extends Controller
{
    public function get(Pagamento $Pagamento, Recebimento $Recebimento)
    {
        $totalFixo = Pagamento::whereRaw('data_pagamento > DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2), INTERVAL 1 MONTH) AND tipo_custo = \'F\'')->sum('valor');
        $totalVariavel = Pagamento::whereRaw('data_pagamento > DATE_SUB((SELECT MAX(p2.data_pagamento) FROM pagamentos p2), INTERVAL 1 MONTH) AND tipo_custo = \'V\'')->sum('valor');
        $numeroClientes = Recebimento::whereRaw('data_recebimento > DATE_SUB((SELECT MAX(r2.data_recebimento) FROM recebimentos r2), INTERVAL 1 MONTH)')->count();

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
