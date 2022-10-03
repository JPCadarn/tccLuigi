@extends('layouts.default')

@section('title', 'Login')

@section('footer')

@endsection

@section('content')
	<div class="row col s12 row-login">
		<h3 class="header center">Bem-vindo</h3>
		<div class="card horizontal">
			<div class="card-stacked">
				<form>
					<div class="card-content">
						<div class="input-field col s12">
							<input id="last_name" type="text" required>
							<label for="last_name">Login</label>
						</div>
						<div class="input-field col s12">
							<input id="last_name" type="password" required>
							<label for="last_name">Senha</label>
						</div>
					</div>
					<div class="card-action">
						<button class="btn waves-effect waves-light right" type="submit" name="action">
							<i class="material-icons right">send</i>
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
