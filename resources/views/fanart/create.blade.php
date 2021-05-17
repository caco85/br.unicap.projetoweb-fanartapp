@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Poste sua FanArt:</h1>
                </div>
                <form class="user" method="POST"  enctype="multipart/form-data" action="{{url('fanart')}}"  >
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text"  id="title" name="title" placeholder="Titulo"
                                   class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <textarea id="description" name="description" rows="5" placeholder="Descrição" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required autofocus></textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file"  id="image" name="image"
                               class="form-control @error('title') is-invalid @enderror" value="{{ old('image') }}" autofocus>

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        @if (isset($categories[0]))

                            <select class="form-control @error('id_category') is-invalid @enderror" name="id_category" id="id_category" autofocus>
                                <option>Selecione uma Categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->type }}</option>
                                @endforeach

                                @error('id_category')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                        @else
                            <p class="text-center text-danger">Antes é necessário criar uma categoria!</p>
                        @endif
                    </div>
                    <button id="btnCadastrar" class="btn btn-primary btn-block">
                        Cadastrar
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a href="/public/index" class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
