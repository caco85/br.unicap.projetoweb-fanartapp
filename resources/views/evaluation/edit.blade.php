@extends('layouts.template')
@section('content')
    <div class="col">
        <div class="p-5">
            @if($evaluation->status != 'approved' )
                <div class="text-center">
                    <h5 class="h4 text-gray-900 mb-4">Editar  Avaliação:</h5>
                </div>
                <form class="user" method="POST"  enctype="multipart/form-data" action="{{url('evaluation/update')}}/{{$evaluation->id}}">
                    @csrf
                    <div class="stars"  disable>
                        <label for="stars">Avaliação:</label>
                        @switch($evaluation->star)
                            @case('2')
                            <label for="oneStar"><i class="fa"></i></label>
                            <input type="radio" id="oneStar" name="star" value="1" >
                            <label for="twoStar"><i class="fa"></i></label>
                            <input type="radio" id="twoStar" name="star" value="2" checked >
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="treeStar" name="star" value="3">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="fourStar" name="star" value="4">
                            <label for="fiveStar"><i class="fa"></i></label>
                            <input type="radio" id="fiveStar" name="star" ><br>
                            @break

                            @case('3')
                            <label for="oneStar"><i class="fa"></i></label>
                            <input type="radio" id="oneStar" name="star" value="1">
                            <label for="twoStar"><i class="fa"></i></label>
                            <input type="radio" id="twoStar" name="star"  value="2">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="treeStar" name="star"  value="3"checked>
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="fourStar" name="star" value="4">
                            <label for="fiveStar"><i class="fa"></i></label>
                            <input type="radio" id="fiveStar" name="star" value="5"><br>
                            @break

                            @case('4')
                            <label for="oneStar"><i class="fa"></i></label>
                            <input type="radio" id="oneStar" name="star" value="1">
                            <label for="twoStar"><i class="fa"></i></label>
                            <input type="radio" id="twoStar" name="star"  value="2">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="treeStar" name="star" value="3">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="fourStar" name="star" value="4" checked>
                            <label for="fiveStar"><i class="fa"></i></label>
                            <input type="radio" id="fiveStar" name="star" value="5" ><br>
                            @break

                            @case('5')
                            <label for="oneStar"><i class="fa"></i></label>
                            <input type="radio" id="oneStar" name="star" value="1">
                            <label for="twoStar"><i class="fa"></i></label>
                            <input type="radio" id="twoStar" name="star"  value="2">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="treeStar" name="star" value="3">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="fourStar" name="star" value="4">
                            <label for="fiveStar"><i class="fa"></i></label>
                            <input type="radio" id="fiveStar" name="star" checked value="5" ><br>
                            @break

                            @default
                            <label for="oneStar"><i class="fa"></i></label>
                            <input type="radio" id="oneStar" name="star" value="1" checked>
                            <label for="twoStar"><i class="fa"></i></label>
                            <input type="radio" id="twoStar" name="star"  value="2">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="treeStar" name="star" value="3">
                            <label for="treeStar"><i class="fa"></i></label>
                            <input type="radio" id="fourStar" name="star" value="4">
                            <label for="fiveStar"><i class="fa"></i></label>
                            <input type="radio" id="fiveStar" name="star" value="5"><br>
                        @endswitch
                    </div>
                    <div class="form-group">
                        <textarea id="description" name="description" rows="5" placeholder="Comentário"
                                  class="form-control " >{{ $evaluation->description }} </textarea>
                    </div>
                    <button class="btn btn-primary btn-block">
                        Atualizar
                    </button>
                </form>
                <hr>
            @else
                <p>Sua Avaliação não pode ser Editada!</p>
            @endif
            <div class="text-center">
                <a href="/evaluation/evaluations" class="pull-right"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
        </div>
    </div>

@endsection

