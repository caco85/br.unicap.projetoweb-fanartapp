@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Cadastrar Usuário:</h1>
                </div>
                <form class="form-group" method="POST"  enctype="multipart/form-data"  action="{{url('user')}}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" id="name"  name="name" placeholder="Nome completo"
                                   class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required >

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="email" type="email" placeholder="Email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input id="password" type="password" placeholder="Senha" class="form-control
                                @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input id="password_confirmation" type="password" class="form-control " name="password_confirmation"
                                   required autocomplete="new-password" placeholder="Confirmação de Senha">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file" id="photo" name="photo"
                               class="form-control @error('photo') is-invalid @enderror" value="{{ old('photo') }}" >

                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="instagram" type="text" name="instagram" placeholder="Instagram"
                               class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}" >

                        @error('instagram')
                        <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="date" id="birthday" name="birthday"
                               class="form-control @error('birthday') is-invalid @enderror" value="{{ old('birthday') }}" required autofocus>

                        @error('birthday')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        @if( Auth::check())
                            @php $users = Auth::user(); @endphp

                            <select class="form-control @error('type') is-invalid @enderror"
                                    id="type" name="type" required>
                                <option value="">Escolha o Tipo</option>
                                <option value="admin">Administrador</option>
                                <option value="simple">Usuário Comum</option>
                            </select>
                        @else
                            <input class="form-control @error('type') is-invalid @enderror"
                                    id="type" name="type" value="simple" hidden>
                        @endif
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button id="btnCadastrar" class="btn btn-primary btn-block">
                        Cadastrar
                    </button>
                </form>

                <div class="text-center">
                    <a href="/" class="pull-right"><i class="fa fa-arrow-left"></i> Voltar</a>
                </div>

            </div>
        </div>
    </div>
@endsection
<!-- Botão para acionar modal -- impletementar futuramente o modal de regras >
{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLongoExemplo">--}}
{{--    Abrir modal de demonstração--}}
{{--</button>--}}

{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="TituloModalLongoExemplo">Título do modal</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                ...--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>--}}
{{--                <button type="button" class="btn btn-primary">Salvar mudanças</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
