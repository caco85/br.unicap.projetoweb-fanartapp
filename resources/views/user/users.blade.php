@extends('layouts.template')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($users) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="d-flex">
                            <th class="col-1 text-center">ID</th>
                            <th class="col-4  text-center">Nome</th>
                            <th class="col-3 text-center">Email</th>
                            <th class="col-4 text-center">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr class="d-flex">
                                <td class="col-1 text-center">{{ $user->id }}</td>
                                <td class="col-4  text-center">{{ $user->name }}</td>
                                <td class="col-3 text-center">{{$user->email}}</td>
                                <td class="col-4 text-center">
                                    <a class="btn btn-success" href="/user/{{ $user->id }}/show"  title="Detalhar">Detalhar</a>
                                    <a class="btn btn-primary" href="/user/{{ $user->id }}/edit"  title="Editar">Editar</a>
                                    <span data-placement="top" title="Excluir">
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete"  id="btnModalExcluir" data-id="{{ $user->id }}">Excluir</a>
                                    </span>
                                </td>
                            </tr>
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
                                            <form class="d-inline-block" action="delete/{{ $user->id }}"  method="post">
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
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Nenhum usuário registrado!</p>
                @endif
            </div>
        </div>
    </div>
@endsection

