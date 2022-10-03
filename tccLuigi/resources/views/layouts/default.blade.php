<!DOCTYPE html>
<html>
<head>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>@yield('title', 'Meu Título')</title>
</head>

<body>

	<main>
		<div class="container">
			@yield('content')
		</div>
	</main>

	@section('footer')
		<footer class="page-footer">
			<div class="container">
				<div class="row">
					<div class="col s6">
						<a class="waves-effect waves-light btn full-width"><i class="material-icons left">cloud</i>Inserção de Contas</a>
					</div>
					<div class="col s6">
						<a class="waves-effect waves-light btn full-width"><i class="material-icons left">cloud</i>Precificação</a>
					</div>
				</div>
			</div>
		</footer>
	@show

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/components.js')}}"></script>
</body>
</html>
