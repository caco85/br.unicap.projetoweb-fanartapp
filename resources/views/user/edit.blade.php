@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-white mb-4">Editar Usuário:</h1>
                </div>

                <div class="media mb-4">
                    <div class="media-body">
                        {{-- <h4 class="mt-0 mb-1 text-white">{{$user->name}}</h4> --}}
                    </div>
                    @if ($user->photo )
                        <img  class="img-profile rounded-circle ml-3" src="{{ url('storage/'.$user->photo )}}" style="height: 10rem; width: 10rem;" >
                    @endif
                </div>

                <form class="user" method="post" enctype="multipart/form-data" action="{{ url('user/update') }}/{{$user->id}}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control text-black" id="name" name="name" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control " id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">

                        <label for="photo">Foto:</label>

                        <input type="file" class="form-control " id="photo" name="photo">
                    </div>

                    <div class="form-group">
                        <label for="instagram">Instagram:</label>
                        <input type="text" id="instagram" name="instagram" class="form-control" value="{{$user->instagram}}" >
                    </div>
                    <div class="form-group">
                        <label for="birthday">Data de Aniversário:</label>
                        <input type="date" class="form-control " id="birthday" name="birthday" value="{{$user->birthday}}">

                    <div class="mt-4">
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

