@extends('layouts.template')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($evaluations) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="d-flex">
                            {{-- <th class="col-1 text-center">ID</th> --}}
                            <th class="col-3  text-center">Nome do Avaliador</th>
                            <th class="col-3 text-center">Titulo da Fanart</th>
                            <th class="col-2 text-center">Status</th>
                            <th class="col-4 text-center">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr class="d-flex">
                                {{-- <td class="col-1 text-center">{{ $evaluation->id }}</td> --}}
                                <td class="col-3  text-center">{{ $evaluation->user->name }}</td>
                                <td class="col-3 text-center">{{$evaluation->fanArt->title}}</td>
                                <td class="col-2 text-center">{{$evaluation->status}}</td>
                                <td class="col-4 text-center">
                                    <a class="btn btn-success" href="/evaluation/{{ $evaluation->id }}/show"  title="Detalhar">Detalhar</a>
                                    <a class="btn btn-primary" href="/evaluation/{{ $evaluation->id }}/edit"  title="Editar">Editar</a>
                                    <span data-placement="top" title="Excluir">
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">Excluir</a>
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
                                            <form class="d-inline-block" action="evaluation/{{ $evaluation->id }}"  method="post">
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
                    <p class="text-center">Nenhuma avaliação registrada!</p>
                @endif
            </div>
        </div>
    </div>
@endsection

