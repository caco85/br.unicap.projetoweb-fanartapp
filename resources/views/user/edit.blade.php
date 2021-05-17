@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Editar Usuuário:</h1>
                </div>
                <form class="user" method="post" enctype="multipart/form-data" action="{{ url('user/update') }}/{{$user->id}}">
                    @csrf
                    <div class="form-group row">
                        <label for="name">Nome:</label>
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" class="form-control " id="name" name="name" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control " id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">

                        <label for="photo">Foto:</label>
                        @if ($user->photo)
                            <img src="{{ url('storage/users-images/'.$user->photo )}}" style="max-width: 50px;">
                        @endif
                        <input type="file" class="form-control " id="photo" name="photo">
                    </div>

                    <div class="form-group">
                        <label for="instagram">Instagram:</label>
                        <input type="text" id="instagram" name="instagram" class="form-control" value="{{$user->instagram}}" >
                    </div>
                    <div class="form-group">
                        <label for="birthday">Data de Aniversário:</label>
                        <input type="date" class="form-control " id="birthday" name="birthday" value="{{$user->birthday}}">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="chancePass" name="chancePass" onclick="checkInputCB(this)">
                        <label for="chancePass">Deseja alterar a senha?</label>
                    </div>
                    <div  id="chancePassword" class="form-group row " hidden>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input id="password" type="password" placeholder="Senha" class="form-control
                            @error('password') is-invalid @enderror" name="password"  value="{{$user->password}}" autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-4">
                            <input id="password_confirmation" type="password" class="form-control " name="password_confirmation"
                                    autocomplete="new-password"   value="{{$user->password}}" placeholder="Confirmação de Senha">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Atualizar
                        </button>
                    </div>
                </form>
                <hr>
            </div>
            @php $users = Auth::user(); @endphp
            @if($users->type == 'admin')
                <a href="/user/users"  class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>

            @else
                <a href="/public/index"  class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>
            @endif
        </div>
    </div>
@endsection

