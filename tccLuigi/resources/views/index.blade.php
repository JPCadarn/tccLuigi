@extends('layouts.default')

@section('title', 'Página Inicial')

@section('content')
		<ul class="collapsible popout">
			<li class="active">
				<div class="collapsible-header"><i class="material-icons">filter_drama</i>Contas a Pagar</div>
				<div class="collapsible-body">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Pago a</th>
								<th>Data Vencimento</th>
								<th>Data Pagamento</th>
								<th>Modo Pag.</th>
								<th>Valor</th>
							</tr>
						</thead>

						<tbody>
							@if(!empty($pagamentos))
								@foreach($pagamentos as $pagamento)
									<tr>
										<td>{{$pagamento['id']}}</td>
										<td>{{$pagamento['pago_a']}}</td>
										<td>{{$pagamento['data_vencimento']}}</td>
										<td>{{$pagamento['data_pagamento']}}</td>
										<td>{{$pagamento['modo_pagamento']}}</td>
										<td>{{$pagamento['valor']}}</td>
									</tr>
								@endforeach
							@else
								Nenhum registro cadastrado.
							@endif
						</tbody>
					</table>
				</div>
			</li>
		</ul>

		<ul class="collapsible popout">
			<li class="active">
				<div class="collapsible-header"><i class="material-icons">filter_drama</i>Contas a Receber</div>
				<div class="collapsible-body">
					<table>
						<thead>
						<tr>
							<th>ID</th>
							<th>Paciente</th>
							<th>Data Vencimento</th>
							<th>Data Recebimento</th>
							<th>Modo Rec.</th>
							<th>Valor</th>
						</tr>
						</thead>

						<tbody>
						@if(!empty($recebimentos))
							@foreach($recebimentos as $recebimento)
								<tr>
									<td>{{$recebimento['id']}}</td>
									<td>{{$recebimento['paciente']}}</td>
									<td>{{$recebimento['data_vencimento']}}</td>
									<td>{{$recebimento['data_recebimento']}}</td>
									<td>{{$recebimento['modo_recebiment']}}</td>
									<td>{{$recebimento['valor']}}</td>
								</tr>
							@endforeach
						@else
							Nenhum registro cadastrado.
						@endif
						</tbody>
					</table>
				</div>
			</li>
		</ul>
@endsection
