@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col mb-4">

            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Detalhes do Usuário:</h2>
            </div>
            <p></p>
            <div class="media mb-4">
                <div class="media-body">
                    <h4 class="mt-0 mb-1">{{$user->name}}</h4>
                </div>
                @if ($user->photo )
                    <img  class="img-profile rounded-circle ml-3" src="{{ url('storage/users-images/'.$user->photo )}}" style="height: 10rem; width: 10rem;" >
                @endif
            </div>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">E-mail: {{$user->email}}</li>
                <li class="list-group-item">Instagram: {{$user->instagram}}</li>
                <li class="list-group-item">Data de Nascimento: {{ date( 'd/m/Y' , strtotime($user->birthday))}}</li>
                <li class="list-group-item">Media de Avaliações: {{ round($user->mediaRating,1)}} <i class="fas fa-star"></i></li>
            </ul>


            @php $users = Auth::user(); @endphp
            @if($users->type == 'admin')
                <a href="/user/users"  class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>

            @else
                <a class="btn btn-primary" href="/user/{{ $user->id }}/edit"  title="Editar">Editar</a>
                <span data-placement="top" title="Excluir">
                    <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">Excluir</a>
                </span>
                <a href="/public/index"  class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>

                <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="deleteModal"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModal">Excluir</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text text-danger">Deseja realmente excluir esse usuário?</div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
                                <form class="d-inline-block"   action="{{ url('/user/delete/'.$user->id) }}"   method="post">
                                    @csrf
                                    @method('delete')
                                    <button class=" btn btn-danger">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
