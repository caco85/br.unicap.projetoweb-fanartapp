@extends('layouts.template')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($loginRecords) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="d-flex">
                            <th class="col-1 text-center">ID</th>
                            <th class="col-1  text-center">ID do Usuário</th>
                            <th class="col-5  text-center">Nome do Usuário</th>
                            <th class="col-5 text-center">Data/Hora do Login</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($loginRecords as $loginRecord)
                            <tr class="d-flex">
                                <td class="col-1 text-center">{{ $loginRecord->id }}</td>
                                <td class="col-1  text-center">{{ $loginRecord->user->id }}</td>
                                <td class="col-5  text-center">{{ $loginRecord->user->name }}</td>
                                <td class="col-5 text-center">{{ date( 'd/m/Y  H:i:s' , strtotime($loginRecord->created_at))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Nenhum registro de login!</p>
                @endif
            </div>
        </div>
    </div>
@endsection

