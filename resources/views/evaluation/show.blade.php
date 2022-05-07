@extends('layouts.template')
@section('content')
    <div class="row mb-4">
        @if ($evaluation->fanart->image)
            <img src="{{ url('storage/fanartimages/'.$evaluation->fanart->image )}}" class="col-lg-6 d-none d-lg-block  img-thumbnail"  >
        @endif
        <div class="col">
            <h2><strong>Detalhes da Avaliação:</strong></h2>
            <h5 class="mb-1">{{$evaluation->star}}<i class="fas fa-star"></i></h5>
            <p class="mb-2">{{ $evaluation->description}}</p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">Avaliador:  {{$evaluation->user->name}}</li>
                <li class="list-group-item">Titulo: {{ $evaluation->fanart->title }}</li>
                <li class="list-group-item">Status: {{ $evaluation->status }}</li>
            </ul>
            <div class="form-group text-center">
                @php $users = Auth::user();@endphp
                @if ($users->type != 'simple' && $evaluation->status == "pending")

                    <form class="d-inline-block" method="post" action="{{ url('evaluation/approve')}}/{{$evaluation->id}}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="far fa-check-circle"></i> <strong>Aprovar</strong>
                        </button>
                    </form>
                @endif
            </div>
            <a href="/public/index" class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
@endsection
