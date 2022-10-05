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
