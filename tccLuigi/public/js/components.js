$(document).ready(function() {
	$('input#input_text, textarea#textarea2').characterCounter();
});

$(document).ready(function(){
	$('.sidenav').sidenav();
});

$(document).ready(function(){
	$('.collapsible').collapsible();
});

$(document).ready(function(){
	$('.fixed-action-btn').floatingActionButton({
		hoverEnabled: false
	});
});

$(document).ready(function(){
	$('.tooltipped').tooltip();
});

$(document).ready(function(){
	$('.modal').modal();
});

$(document).ready(function(){
	$('.datepicker').datepicker({
		autoClose: true,
		i18n: {
			cancel: 'Cancelar',
			clear: 'Limpar',
			months: [
				'Janeiro',
				'Fevereiro',
				'Março',
				'Abril',
				'Maio',
				'Junho',
				'Julho',
				'Agosto',
				'Setembro',
				'Outubro',
				'Novembro',
				'Dezembro'
			],
			monthsShort: [
				'Jan',
				'Fev',
				'Mar',
				'Abr',
				'Mai',
				'Jun',
				'Jul',
				'Ago',
				'Set',
				'Out',
				'Nov',
				'Dez'
			],
			weekdays: [
				'Domingo',
				'Segunda-Feira',
				'Terça-Feira',
				'Quarta-Feira',
				'Quinta-Feira',
				'Sexta-Feira',
				'Sábado'
			],
			weekdaysShort: [
				'Dom',
				'Seg',
				'Ter',
				'Qua',
				'Qui',
				'Sex',
				'Sáb'
			],
			weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S']
		}
	});
});
