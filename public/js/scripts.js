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
        $('#apresentacaoAnaliseFinanceira').show()
        $('#headerAnaliseFinanceira').html('<h5>Resultados:</h5>');
        $('#margemContribuicaoAnaliseFinanceira').html('<b>Margem de Contribuição: </b>'+response.margemContribuicao);
        $('#pontoEquilibrioAnaliseFinanceira').html('<b>Ponto de Equilíbrio: </b>'+response.pontoEquilibrio);
        $('#receitaTotalAnaliseFinanceira').html('<b>Receita Total: </b>'+response.receitaTotal);
        $('#totalFixoAnaliseFinanceira').html('<b>Total Fixo: </b>'+response.totalFixo);
        $('#totalVariavelAnaliseFinanceira').html('<b>Total Variável: </b>'+response.totalVariavel);
    });
});
$('#btnPrecificacao').on('click', function (event) {
    $.ajax({
        type: 'GET',
        url: event.currentTarget.dataset.action,
    }).done(function (response) {
        $('#apresentacaoPrecificacao').show()
        $('#headerPrecifcacao').html('<h5>Resultados: </h5>');
        $('#valorMedioPrecificacao').html('<b>Valor Médio: </b>'+response.valorMedio);
        $('#nroMinimoClientesPrecificacao').html('<b>Número mínimo de clientes: </b>'+response.numeroMinimoClientes);
        $('#totalFixoPrecificacao').html('<b>Total Fixo: </b>'+response.totalFixo);
        $('#totalVariavelPrecificacao').html('<b>Total Variável: </b>'+response.totalVariavel);
        $('#numeroClientesPrecificacao').html('<b>Número de Clientes: </b>'+response.numeroClientes);
    });
});
