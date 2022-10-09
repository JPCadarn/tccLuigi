@extends('layouts.default')

@section('title', 'Página Inicial')

@section('content')
    <div class="row">
        <div class="col s6">
            <ul class="collapsible popout">
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>Contas a Pagar</div>
                    <div class="collapsible-body">
                        <table id="tablePagamentos">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pago a</th>
                                <th>Tipo de Custo</th>
                                <th>Data de Vencimento</th>
                                <th>Data de Pagamento</th>
                                <th>Modo de Pagamento</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($pagamentos as $pagamento)
                                <tr>
                                    <td>{{$pagamento['id']}}</td>
                                    <td>{{$pagamento['pago_a']}}</td>
                                    <td>{{$pagamento['tipo_custo']}}</td>
                                    <td>{{date('d/m/Y', strtotime($pagamento['data_vencimento']))}}</td>
                                    <td>{{date('d/m/Y', strtotime($pagamento['data_pagamento']))}}</td>
                                    <td>{{$pagamento['modo_pagamento']}}</td>
                                    <td>{{number_format($pagamento['valor'], 2, ',', '.')}}</td>
                                    <td>
                                        <a class="waves-effect tooltipped btnEditPagamento" data-tooltip="Editar" data-position="bottom" data-action="{{route('pagamentos.get', $pagamento['id'])}}"><i class="material-icons yellow-text text-darken-3">edit</i></a>
                                        <a class="waves-effect tooltipped btnDelete" data-tooltip="Excluir" data-position="bottom" data-action="{{route('pagamentos.delete', $pagamento['id'])}}"><i class="material-icons yellow-text text-darken-3">delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col s6">
            <ul class="collapsible popout">
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>Contas a Receber</div>
                    <div class="collapsible-body">
                        <table id="tableRecebimentos">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Paciente</th>
                                <th>Data Vencimento</th>
                                <th>Data Recebimento</th>
                                <th>Modo Rec.</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($recebimentos as $recebimento)
                                <tr>
                                    <td>{{$recebimento['id']}}</td>
                                    <td>{{$recebimento['paciente']}}</td>
                                    <td>{{$recebimento['data_vencimento']}}</td>
                                    <td>{{$recebimento['data_recebimento']}}</td>
                                    <td>{{$recebimento['modo_recebimento']}}</td>
                                    <td>{{$recebimento['valor']}}</td>
                                    <td>
                                        <a class="waves-effect tooltipped btnEditRecebimento" data-tooltip="Editar" data-position="bottom" data-action="{{route('recebimentos.get', $recebimento['id'])}}"><i class="material-icons yellow-text text-darken-3">edit</i></a>
                                        <a class="waves-effect tooltipped btnDelete" data-tooltip="Excluir" data-position="bottom" data-action="{{route('recebimentos.delete', $recebimento['id'])}}"><i class="material-icons yellow-text text-darken-3">delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <script>
        $('.btnDelete').on('click', function (event) {
            let token = '@csrf';
            token = token.substr(42, 40);
            $.ajax({
                type: "POST",
                url: event.currentTarget.dataset.action,
                data: `_token=${token}`
            }).done(function (response) {
                window.location = response;
            });
        });
    </script>

@endsection
