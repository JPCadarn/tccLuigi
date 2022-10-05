$(document).ready(function () {
    $('#tablePagamentos').DataTable({
        colReorder: true,
        bFilter: false,
        info: false,
        language: {
            emptyTable: 'Nenhum registro cadastrado.'
        }
    }).page.len(10).draw();
    $('#tableRecebimentos').DataTable({
        colReorder: true,
        bFilter: false,
        info: false,
        language: {
            emptyTable: 'Nenhum registro cadastrado.'
        }
    }).page.len(10).draw();
});
