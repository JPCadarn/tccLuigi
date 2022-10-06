function validarModoPagamento() {

    if ($('#switchPagamentos').prop('checked')) {

        $('#divPagamentoManual').hide();
        $('#fileInputPagamentos').show();
    } else {
        $('#divPagamentoManual').show();
        $('#fileInputPagamentos').hide();
    }
}
function validarModoRecebimento() {
    if ($('#switchRecebimentos').prop('checked')) {

        $('#divRecebimentoManual').hide();
        $('#fileInputRecebimentos').show();
    } else {
        $('#divRecebimentoManual').show();
        $('#fileInputRecebimentos').hide();
    }
}

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
        const elem = document.getElementById('modalPagamento');
        const instance = M.Modal.init(elem);
        $('#pago_a').val(response.pago_a);
        $('#data_pagamento').val(response.data_pagamento);
        $('#data_vencimento').val(response.data_vencimento);
        $('#modo_pagamento').val(response.modo_pagamento);
        $('#valor').val(response.valor);
        $('#rowSwitchPagamentos').hide();
        $('#id').val(response.id);
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
