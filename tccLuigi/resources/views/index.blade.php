@extends('layouts.default')

@section('title', 'Página Inicial')

@section('content')
	{{--<ul class="collapsible popout">
		<li class="active">
			<div class="collapsible-header"><i class="material-icons">filter_drama</i>Contas a Pagar</div>
			<div class="collapsible-body">
				<table>
					<thead>
					<tr>
						<th>Name</th>
						<th>Item Name</th>
						<th>Item Price</th>
					</tr>
					</thead>

					<tbody>
					<tr>
						<td>Alvin</td>
						<td>Eclair</td>
						<td>$0.87</td>
					</tr>
					<tr>
						<td>Alan</td>
						<td>Jellybean</td>
						<td>$3.76</td>
					</tr>
					<tr>
						<td>Jonathan</td>
						<td>Lollipop</td>
						<td>$7.00</td>
					</tr>
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
						<th>Name</th>
						<th>Item Name</th>
						<th>Item Price</th>
					</tr>
					</thead>

					<tbody>
					<tr>
						<td>Alvin</td>
						<td>Eclair</td>
						<td>$0.87</td>
					</tr>
					<tr>
						<td>Alan</td>
						<td>Jellybean</td>
						<td>$3.76</td>
					</tr>
					<tr>
						<td>Jonathan</td>
						<td>Lollipop</td>
						<td>$7.00</td>
					</tr>
					</tbody>
				</table>
			</div>
		</li>
	</ul>--}}

	{{$pagamentos}}
	<br>
	<br>
	{{$recebimentos}}
@endsection
