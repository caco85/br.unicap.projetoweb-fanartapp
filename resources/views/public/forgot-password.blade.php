@extends('layouts.template')
@section('content')
    <div class="row mb-4">
        <div class="col-lg-6 d-none d-lg-block mb-4">
            <img  src="{{ asset('/img/logo.png') }}" width="100%">
        </div>
        <div class="col-lg-6">
            <div class="p-5">

                <div class="text-center" style="color: white">
                    <h1 class="h4  mb-2">Esqueceu a Senha?</h1>
                    <p class="mb-4">Insira seu email cadastrado, para enviar-mos o reset de senha.</p>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        O e-mail de reset de senha foi enviado para seu e-mail.
                    </div>
                @endif
                <form class="user" method="POST" action="{{ url('/forgot-password/sendEmail') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                              placeholder="Digite o seu e-mail cadastrado...">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                          Enviar e-mail de reset de senha.
                    </button>
                </form>

                <hr>
                {{-- <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                </div> --}}
                <div class="text-center ">
                    {{-- <a class="small" href="/login">Deseja volta? Login!</a> --}}
                    <a href="/login" class="pull-right" style="color: white"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection


