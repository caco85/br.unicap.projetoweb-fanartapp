@extends('layouts.template')
@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($fanarts as $fanart)
            <div class="col mb-4">
                <div class="card h-100">
                        <a href="/fanart/{{ $fanart->id }}/show">
                    @if ($fanart->image)
                        <img src="{{ url('~/storage/fanartimages/'.$fanart->image )}}" class="card-img-top "  alt="{{ $fanart->title}}">
                    @endif
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{$fanart->title}} </h5>
                        <h6 class="card-title">{{$fanart->category->type}}</h6>
                        <p class="card-text">{{$fanart->description }}</p>
                        @if(Auth::check())
                            <p class="card-text">{{$fanart->user->name }}</p>
                            <p class="card-text">{{ round($fanart->mediaRating,1) }}<i class="fas fa-star"></i></p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
