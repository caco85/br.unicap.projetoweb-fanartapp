@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Editar Fanart:</h1>
                </div>
                <form class="user" method="POST"  enctype="multipart/form-data" action="{{url('fanart/update')}}/{{$fanart->id}}"  >
                    @csrf

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label for="title">Titulo:</label>
                            <input type="text" class="form-control " id="title" name="title"
                                   value="{{$fanart->title}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label for="description">Descrição:</label>
                            <textarea id="description" name="description" class="form-control">{{ $fanart->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem:</label>
                        @if ($fanart->image)
                            <img src="{{ url('storage/fanartimages/'.$fanart->image )}}" style="max-width: 50px;">
                        @endif
                        <input type="file" class="form-control " id="image" name="image">
                    </div>

                    <div class="form-group">
                        <label for="id_category">Categoria:</label>
                        <select class="form-control" name="id_scheduleCategory" id="id_scheduleCategory">
                            <option>Selecione uma categoria</option>
                            @foreach ($categories as $category)
                                @if ($fanart->id_category == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->type }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->type }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary btn-block">
                        Atualizar
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a href="/fanart/fanarts" class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

