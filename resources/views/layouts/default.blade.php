<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Meu Título')</title>
</head>

<body>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

@section('fab')
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red tooltipped" data-position="left" data-tooltip="Adicionar">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a class="btn-floating red tooltipped modal-trigger" data-target="modalInsertPagamentos" data-position="left" data-tooltip="Inserir Pagamentos"><i class="material-icons">trending_down</i>Inserir Pagamentos</a></li>
            <li><a class="btn-floating red tooltipped modal-trigger" data-target="modalInsertRecebimentos" data-position="left" data-tooltip="Inserir Recebimentos"><i class="material-icons">trending_up</i>Inserir Recebimentos</a></li>
            <li><a class="btn-floating yellow tooltipped modal-trigger" data-target="modalPrecificacao" data-position="left" data-tooltip="Precificação"><i class="material-icons">attach_money</i>Precificação</a></li>
        </ul>
    </div>
@show

<div id="modalInsertPagamentos" class="modal">
    @csrf
    <form action="{{route('pagamentos.insert')}}" method="POST">
        @csrf
        <div class="modal-content">
            <h5 class="center">Contas a Pagar</h5>
            <br>
            <div class="row">
                <div class="switch">
                    <label>
                        Manual
                        <input type="checkbox" id="switchPagamentos"><span class="lever"></span>
                        Automática
                    </label>
                </div>
            </div>
            <div class="file-field input-field" id="fileInputPagamentos">
                <div class="btn">
                    <span>Arquivo</span>
                    <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="row" id="divPagamentoManual">
                <div class="input-field col s12">
                    <input id="pago_a" name="pago_a" type="text" data-length="50">
                    <label for="pago_a">Pago A</label>
                </div>
                <div class="input-field col s6">
                    <input id="valor" name="valor" type="number" step="1">
                    <label for="valor">Valor</label>
                </div>
                <div class="input-field col s6">
                    <input id="modo_pagamento" name="modo_pagamento" type="text">
                    <label for="modo_pagamento">Modo de Pagamento</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="datepicker" name="data_vencimento" id="data_vencimento">
                    <label for="data_vencimento">Data de Vencimento</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="datepicker" name="data_pagamento" id="data_pagamento">
                    <label for="data_pagamento">Data de Pagamento</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<div id="modalInsertRecebimentos" class="modal">
    <form action="{{route('recebimentos.insert')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-content">
            <h5 class="center">Contas a Pagar</h5>
            <br>
            <div class="row">
                <div class="switch">
                    <label>
                        Manual
                        <input type="checkbox" id="switchRecebimentos"><span class="lever"></span>
                        Automática
                    </label>
                </div>
                <div class="file-field input-field" id="fileInputRecebimentos">
                    <div class="btn">
                        <span>Arquivo</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="row" id="divRecebimentoManual">
                    <div class="input-field col s12">
                        <input id="descricao" name="descricao" type="text" data-length="50">
                        <label for="descricao">Descrição</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="paciente" name="paciente" type="text" data-length="50">
                        <label for="paciente">Paciente</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="Valor" name="Valor" type="number" step="1">
                        <label for="Valor">Valor</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="modo_recebimento" name="modo_recebimento" type="text">
                        <label for="modo_recebimento">Modo de Recebimento</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" class="datepicker" name="data_vencimento" id="data_vencimento">
                        <label for="data_vencimento">Data de Vencimento</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" class="datepicker" name="data_pagamento" id="data_pagamento">
                        <label for="data_pagamento">Data de Recebimentos</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<div id="modalPrecificacao" class="modal">
    <form action="/precificacoes/insert" method="POST">
        <div class="modal-content">
            <h5 class="center">Análise Financeira e Precificação</h5>
            <br>
            <div class="row">
                <div class="col s6">
                    <h6 class="center">Análise Financeira</h6>
                    <div class="input-field col s12">
                        <input type="number" step="1" id="margem_contribuicao" name="margem_contribuicao">
                        <label for="margem_contribuicao">Margem de Contribuição</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" id="ponto_equilibro" name="ponto_equilibro">
                        <label for="ponto_equilibro">Ponto de Equilíbrio</label>
                    </div>
                    <div class="row center">
                        <button class="btn waves-effect waves-light" id="btnAnaliseFinanceira">Análise Financeira</button>
                    </div>
                    <div id="apresentacaoSituacaoFinanceira">

                    </div>
                </div>
                <div class="col s6">
                    <h6 class="center">Realizar Precificação</h6>
                    <div class="input-field col s12">
                        <input type="number" step="1" id="margem_contribuicao_precificacao" name="margem_contribuicao_precificacao">
                        <label for="margem_contribuicao_precificacao">Margem de Contribuição</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" id="ponto_equilibro_precificacao" name="ponto_equilibro_precificacao">
                        <label for="ponto_equilibro_precificacao">Ponto de Equilíbrio</label>
                    </div>
                    <div class="row center">
                        <button class="btn waves-effect waves-light" id="btnPrecificacao">Precificação</button>
                    </div>
                    <div id="apresentacaoPrecificacao">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{asset('js/components.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/dataTables.js')}}"></script>
</body>
</html>
