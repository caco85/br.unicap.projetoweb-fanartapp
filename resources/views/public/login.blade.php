@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block mb-4">
                <img  src="{{ asset('/img/logo.png') }}" width="100%">
        </div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-white-900 mb-4">Bem-vindo </h1>
                </div>
                <form class="user" method="POST" name="login" action="{{url('login')}}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email"  name="email" aria-describedby="emailHelp"  placeholder="Email"
                               class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <input id="password" type="password" name="password" placeholder="Senha"
                               class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if(request()->get('invalidCredentials'))
                        <div class="alert alert-danger" role="alert">
                            Usuário ou senha inválido.
                        </div>
                    @endif
                    <button class="btn btn-primary btn-block">
                        Entrar
                    </button>
                    <hr>
                </form>
                <a class="btn btn-link pull-right " href="forgot-password">
                    Esqueceu a senha? Clique aqui!
                </a>

            </div>
        </div>
    </div>
@endsection
