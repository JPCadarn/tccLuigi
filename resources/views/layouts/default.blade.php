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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>

<main>
    @yield('content')
</main>

@section('fab')
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red tooltipped" data-position="left" data-tooltip="Adicionar">
            <i class="large material-icons">add</i>
        </a>
        <ul>
            <li><a class="btn-floating red tooltipped modal-trigger" data-target="modalPagamento" data-position="left" data-tooltip="Inserir Pagamentos"><i class="material-icons">trending_down</i>Inserir Pagamentos</a></li>
            <li><a class="btn-floating red tooltipped modal-trigger" data-target="modalRecebimento" data-position="left" data-tooltip="Inserir Recebimentos"><i class="material-icons">trending_up</i>Inserir Recebimentos</a></li>
            <li><a class="btn-floating yellow tooltipped modal-trigger" data-target="modalPrecificacao" data-position="left" data-tooltip="Precificação"><i class="material-icons">attach_money</i>Precificação</a></li>
        </ul>
    </div>
@show

<div id="modalPagamento" class="modal">
    @csrf
    <form action="{{route('pagamentos.save')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <h5 class="center">Contas a Pagar</h5>
            <br>
            <div class="row" id="rowSwitchPagamentos">
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
                    <input type="file" name="planilha">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
                <div class="input-field col s6">
                    <input id="posicao_coluna_pago_a" name="posicao_coluna_pago_a" type="number" required>
                    <label for="posicao_coluna_pago_a">Coluna Pago A</label>
                </div>
                <div class="input-field col s6">
                    <input id="posicao_coluna_valor" name="posicao_coluna_valor" type="number" required>
                    <label for="posicao_coluna_valor">Coluna Valor</label>
                </div>
                <div class="input-field col s6">
                    <input id="posicao_coluna_tipo_custo" name="posicao_coluna_tipo_custo" type="number" required>
                    <label for="posicao_coluna_tipo_custo">Coluna Tipo Custo</label>
                </div>
                <div class="input-field col s6">
                    <input id="posicao_coluna_modo_pagamento" name="posicao_coluna_modo_pagamento" type="number" required>
                    <label for="posicao_coluna_modo_pagamento">Coluna Modo Pagamento</label>
                </div>
                <div class="input-field col s6">
                    <input id="posicao_coluna_data_vencimento" name="posicao_coluna_data_vencimento" type="number" required>
                    <label for="posicao_coluna_data_vencimento">Coluna Data de Vencimento</label>
                </div>
                <div class="input-field col s6">
                    <input id="posicao_coluna_pagamento" name="posicao_coluna_pagamento" type="number" required>
                    <label for="posicao_coluna_pagamento">Coluna Data de Pagamento</label>
                </div>
            </div>
            <div class="row" id="divPagamentoManual">
                <input type="hidden" name="id" id="id">
                <div class="input-field col s12">
                    <input id="pago_a" name="pago_a" type="text" data-length="50" required>
                    <label for="pago_a">Pago A</label>
                </div>
                <div class="input-field col s6">
                    <input class="maskMoney" id="valor" name="valor" type="text" required>
                    <label for="valor">Valor</label>
                </div>
                <div class="input-field col s6">
                    <input id="modo_pagamento" name="modo_pagamento" type="text">
                    <label for="modo_pagamento">Modo de Pagamento</label>
                </div>
                <div class="input-field col s6">
                    <input type="date" name="data_vencimento" id="data_vencimento" required>
                    <label for="data_vencimento">Data de Vencimento</label>
                </div>
                <div class="input-field col s6">
                    <input type="date" name="data_pagamento" id="data_pagamento">
                    <label for="data_pagamento">Data de Pagamento</label>
                </div>
                <div class="input-field col s12">
                    <select id="tipoCusto" name="tipo_custo" required>
                        <option value="" disabled selected>Tipo de Custo</option>
                        <option value="F">Fixo</option>
                        <option value="V">Variável</option>
                    </select>
                    <label for="tipoCusto">Tipo de Custo</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn waves-effect waves-light" type="submit">Enviar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<div id="modalRecebimento" class="modal">
    <form action="{{route('recebimentos.save')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <h5 class="center">Contas a Receber</h5>
            <br>
            <div class="row" id="rowSwitchRecebimento">
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
                        <input type="file" name="planilhaRecebimento">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                    <div class="input-field col s6">
                        <input id="posicao_coluna_descricao" name="posicao_coluna_descricao" type="number" required>
                        <label for="posicao_coluna_descricao">Coluna Descrição</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="posicao_coluna_valor" name="posicao_coluna_valor" type="number" required>
                        <label for="posicao_coluna_valor">Coluna Valor</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="posicao_coluna_descricao" name="posicao_coluna_descricao" type="number" required>
                        <label for="posicao_coluna_descricao">Coluna Descrição</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="posicao_coluna_modo_recebimento" name="posicao_coluna_modo_recebimento" type="number" required>
                        <label for="posicao_coluna_modo_recebimento">Coluna Modo Recebimento</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="posicao_coluna_data_vencimento" name="posicao_coluna_data_vencimento" type="number" required>
                        <label for="posicao_coluna_data_vencimento">Coluna Data de Vencimento</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="posicao_coluna_recebimento" name="posicao_coluna_recebimento" type="number" required>
                        <label for="posicao_coluna_recebimento">Coluna Data de Recebimento</label>
                    </div>
                </div>
            </div>
            <div class="row" id="divRecebimentoManual">
                <input type="hidden" id="idRecebimento" name="id">
                <div class="input-field col s12">
                    <input id="descricao" name="descricao" type="text" data-length="50" required>
                    <label for="descricao">Descrição</label>
                </div>
                <div class="input-field col s12">
                    <input id="paciente" name="paciente" type="text" data-length="50 required">
                    <label for="paciente">Paciente</label>
                </div>
                <div class="input-field col s6">
                    <input class="maskMoney" id="valor_recebimento" name="valor" type="text" required>
                    <label for="valor_recebimento">Valor</label>
                </div>
                <div class="input-field col s6">
                    <input id="modo_recebimento" name="modo_recebimento" type="text">
                    <label for="modo_recebimento">Modo de Recebimento</label>
                </div>
                <div class="input-field col s6">
                    <input type="date" name="data_vencimento" id="data_vencimento_recebimento" required>
                    <label for="data_vencimento_recebimento">Data de Vencimento</label>
                </div>
                <div class="input-field col s6">
                    <input type="date" name="data_recebimento" id="data_recebimento">
                    <label for="data_recebimento">Data de Recebimentos</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn waves-effect waves-light" type="submit">Enviar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<div id="modalPrecificacao" class="modal">
    <div class="modal-content">
        <h5 class="center">Análise Financeira e Precificação</h5>
        <br>
        <div class="row">
            <div class="col s6">
                <h6 class="center">Análise Financeira</h6>
                <div id="apresentacaoAnaliseFinanceira">
                    <div class="row" id="headerAnaliseFinanceira"></div>
                    <div class="row" id="totalVariavelAnaliseFinanceira"></div>
                    <div class="row" id="totalFixoAnaliseFinanceira"></div>
                    <div class="row" id="receitaTotalAnaliseFinanceira"></div>
                    <div class="row" id="margemContribuicaoAnaliseFinanceira"></div>
                    <div class="row" id="pontoEquilibrioAnaliseFinanceira"></div>
                </div>
                <div class="row center">
                    <button class="btn waves-effect waves-light" id="btnAnaliseFinanceira" data-action="{{route('analiseFinanceira.get')}}">Análise Financeira</button>
                </div>
            </div>
            <div class="col s6">
                <h6 class="center">Precificação</h6>
                <div id="apresentacaoPrecificacao">
                    <div class="row" id="headerPrecifcacao"></div>
                    <div class="row" id="totalVariavelPrecificacao"></div>
                    <div class="row" id="totalFixoPrecificacao"></div>
                    <div class="row" id="nroMinimoClientesPrecificacao"></div>
                    <div class="row" id="numeroClientesPrecificacao"></div>
                    <div class="row" id="valorMedioPrecificacao"></div>
                </div>
                <div class="row center">
                    <button class="btn waves-effect waves-light" id="btnPrecificacao" data-action="{{route('precificacao.get')}}">Precificação</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/components.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/dataTables.js')}}"></script>
<script src="{{asset('js/masks.js')}}"></script>
</body>
</html>
