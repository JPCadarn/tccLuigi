@extends('layouts.default')

@section('title', 'Login')

@section('fab')@endsection

@section('content')
    <div class="container">
        <div class="col s12 row-login">
            <h2 class="header center">Bem Vindo</h2>
            <div class="card horizontal">
                <div class="card-stacked">
                    <form action="{{route('login.make')}}" method="POST">
                        @csrf
                        <div class="card-content">
                            <div class='row'>
                                <div class="input-field col s12">
                                    <input id="email" name="email" type="text" required autocomplete="off">
                                    <label for="email">Login</label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="input-field col s12">
                                    <input id="password" name="password" type="password" required autocomplete="off">
                                    <label for="password">Senha</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class='row'>
                                <button type='submit' name='btn_login' class='indigo darken-4 col s12 btn btn-large waves-effect'>
                                    Fazer Login <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
