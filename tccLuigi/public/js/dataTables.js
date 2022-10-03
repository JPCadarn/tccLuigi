$(document).ready(function () {
	$('#tablePagamentos').DataTable({
		colReorder: true,
		bFilter: false,
		info: false,
		language: {
			emptyTable: 'Nenhum registro cadastrado.'
		}
	});
	$('#tableRecebimentos').DataTable({
		colReorder: true,
		bFilter: false,
		info: false,
		language: {
			emptyTable: 'Nenhum registro cadastrado.'
		}
	});
});
