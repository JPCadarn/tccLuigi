function validarModoPagamento() {
    if ($('#switchPagamentos').prop('checked')) {
        $('#divPagamentoManual').hide();
        $('#fileInputPagamentos').show();
        $('#pago_a').attr('required', false);
        $('#valor').attr('required', false);
        $('#data_vencimento').attr('required', false);
        $('#tipoCusto').attr('required', false);
    } else {
        $('#divPagamentoManual').show();
        $('#fileInputPagamentos').hide();
        $('#pago_a').attr('required', true);
        $('#valor').attr('required', true);
        $('#data_vencimento').attr('required', true);
        $('#tipoCusto').attr('required', true);
    }
}

function validarModoRecebimento() {
    if ($('#switchRecebimentos').prop('checked')) {
        $('#divRecebimentoManual').hide();
        $('#fileInputRecebimentos').show();
        $('#descricao').attr('required', false);
        $('#paciente').attr('required', false);
        $('#valor_recebimento').attr('required', false);
        $('#data_vencimento_recebimento').attr('required', false);
    } else {
        $('#divRecebimentoManual').show();
        $('#fileInputRecebimentos').hide();
        $('#descricao').attr('required', true);
        $('#paciente').attr('required', true);
        $('#valor_recebimento').attr('required', true);
        $('#data_vencimento_recebimento').attr('required', true);
    }
}

$('#apresentacaoPrecificacao').hide()
$('#apresentacaoAnaliseFinanceira').hide()

$('#switchPagamentos').on('change', function(){
    validarModoPagamento();
});
$('#switchRecebimentos').on('change', function(){
    validarModoRecebimento();
});

validarModoPagamento();
validarModoRecebimento();

$('.btnEditPagamento').on('click', function (event) {
    $.ajax({
        type: 'GET',
        url: event.currentTarget.dataset.action,
    }).done(function (response) {
        console.log(response);
        const elem = document.getElementById('modalPagamento');
        const instance = M.Modal.init(elem);
        $('#pago_a').val(response.pago_a);
        $('#data_pagamento').val(response.data_pagamento);
        $('#data_vencimento').val(response.data_vencimento);
        $('#modo_pagamento').val(response.modo_pagamento);
        $('#valor').val(response.valor);
        $('#rowSwitchPagamentos').hide();
        $('#id').val(response.id);
        $('#tipoCusto').val(response.tipo_custo).change();
        $('select').formSelect();
        M.updateTextFields();
        instance.open();
    });
});

$('.btnEditRecebimento').on('click', function (event) {
    $.ajax({
        type: 'GET',
        url: event.currentTarget.dataset.action,
    }).done(function (response) {
        console.log(response);
        const elem = document.getElementById('modalRecebimento');
        const instance = M.Modal.init(elem);
        $('#valor_recebimento').val(response.valor);
        $('#descricao').val(response.descricao);
        $('#paciente').val(response.paciente);
        $('#modo_recebimento').val(response.modo_recebimento);
        $('#data_vencimento_recebimento').val(response.data_vencimento);
        $('#data_recebimento').val(response.data_recebimento);
        $('#rowSwitchRecebimento').hide();
        $('#idRecebimento').val(response.id);
        M.updateTextFields();
        instance.open();
    });
});

$('#btnAnaliseFinanceira').on('click', function (event) {
    $.ajax({
        type: 'GET',
        url: event.currentTarget.dataset.action,
    }).done(function (response) {
        console.log(response);
        let corPontoEquilibrio = '';
        let somaTotais = response.totalFixoBruto + response.totalVariavelBruto;
        if (response.pontoEquilibrioBruto > somaTotais) {
            corPontoEquilibrio = 'red-text'
        }else if (response.pontoEquilibrioBruto < somaTotais) {
            corPontoEquilibrio = 'green-text'
        }

        $('#apresentacaoAnaliseFinanceira').show();
        $('#headerAnaliseFinanceira').html('<h5>Resultados:</h5>');
        $('#margemContribuicaoAnaliseFinanceira').html('<b>Margem de Contribui????o: </b>'+response.margemContribuicao);
        $('#pontoEquilibrioAnaliseFinanceira').html('<b>Ponto de Equil??brio: </b><span class="'+corPontoEquilibrio+'">'+response.pontoEquilibrio+'</span>');
        $('#receitaTotalAnaliseFinanceira').html('<b>Receita Total: </b>'+response.receitaTotal);
        $('#totalFixoAnaliseFinanceira').html('<b>Total Fixo: </b>'+response.totalFixo);
        $('#totalVariavelAnaliseFinanceira').html('<b>Total Vari??vel: </b>'+response.totalVariavel);
    });
});
$('#btnPrecificacao').on('click', function (event) {
    $.ajax({
        type: 'GET',
        url: event.currentTarget.dataset.action,
    }).done(function (response) {
        console.log(response);
        $('#apresentacaoPrecificacao').show()
        $('#headerPrecifcacao').html('<h5>Resultados: </h5>');
        $('#valorMedioPrecificacao').html('<b>Valor M??dio: </b>'+response.valorMedio);
        $('#numeroClientesPrecificacao').html('<b>N??mero de Clientes: </b>'+response.numeroClientes);
        $('#receitaMedia').html('<b>Receita M??dia: </b>'+response.receitaMedia);
        $('#margemContribuicaoPrecificacao').html('<b>Margem de Contribui????o: </b>'+response.margemContribuicao);
        $('#pontoEquilibrioPrecificacao').html('<b>Ponto de Equil??brio: </b>'+response.pontoEquilibrio);
        $('#valorMinimo').html('<b>Valor M??nimo por consulta: </b>'+response.valorMinimo);
        $('#nroMinimoComPrecificacao').html('<b>N??mero m??nimo de clientes com precifica????o: </b>'+response.nroMinimoClientesComPrecificacao);
    });
});
