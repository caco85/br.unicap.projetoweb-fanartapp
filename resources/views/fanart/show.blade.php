@extends('layouts.template')
@section('content')
    <div class="row mb-4">
        @if ($fanart->image)
            <img src="{{ url('storage/fanartimages/'.$fanart->image )}}" class="col-lg-6 d-none d-lg-block  img-thumbnail"  >
        @endif
        <div class="col">
            <h2><strong>Detalhes da FanArt:</strong></h2>
            <h5 class="mb-1">{{$fanart->title}} </h5>
            <p class="mb-2">{{ $fanart->description}}</p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">Média de Avaliações: {{ round($fanart->mediaRating,1) }}<i class="fas fa-star"></i></li>
                <li class="list-group-item">Postado por: <a href="/user/{{ $fanart->user->id }}/show"  title="Visitar">
                        {{$fanart->user->name}}</a></li>
                <li class="list-group-item">Categoria: {{ $fanart->category->type }}</li>
            </ul>
            <a id="btnEvaluation" class="btn btn-primary pull-left"  title="Avaliar" onclick="checkButton(this)">Avaliar</a>
            <a id="btnComments" class="btn btn-success pull-left" title="Ver Avaliações" onclick="checkButtonComm(this)">Avaliações</a>
            <a href="/public/index" class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <div class="row" id="toEvaluation" hidden>
        <div class="col">
            <div class="p-5">
                <div class="text-center">
                    <h5 class="h4 text-gray-900 mb-4">Avaliar Fanart:</h5>
                </div>
                <form class="user" method="POST"  enctype="multipart/form-data" action="{{ url('evaluation') }}"  >
                    @csrf
                    <div class="stars">
                        <label for="stars">Avaliação</label>
                        <label for="oneStar"><i class="fa"></i></label>
                        <input type="radio" id="oneStar" name="star" value="1" checked>

                        <label for="twoStar"><i class="fa"></i></label>
                        <input type="radio" id="twoStar" name="star" value="2">

                        <label for="treeStar"><i class="fa"></i></label>
                        <input type="radio" id="treeStar" name="star" value="3">

                        <label for="fourSTar"><i class="fa"></i></label>
                        <input type="radio" id="fourSTar" name="star" value="4">

                        <label for="fiveStar"><i class="fa"></i></label>
                        <input type="radio" id="fiveStar" name="star" value="5"><br>
                    </div>
                    <div class="form-group">
                        <textarea id="description" name="description" rows="5" placeholder="Comentário"
                                  class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required autofocus></textarea>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="id_fanArt" id="id_fanArt" >
                            <option value="{{ $fanart->id }}">{{ $fanart->title }} </option>
                        </select>
                    </div>
                    <button id="btnCadastrar" class="btn btn-primary btn-block">
                        Cadastrar
                    </button>
                </form>
                <hr>
            </div>
        </div>
    </div>
    <div class="row" id="toComments" hidden>
        <ul class="list-group list-group-flush mb-3">
        <h5 class="mb-4">O que acharam desta fanart!</h5><br>
        @foreach ($evaluations as $evaluation)
                <li class="list-group-item">Comentário: {{ $evaluation->description }}</li>
        @endforeach
        </ul>
    </div>
@endsection
