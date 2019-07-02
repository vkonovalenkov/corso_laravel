@extends('templates.default')
@section('content')
    <div class="card-columns">
        @foreach($albums as $album)
        <div class="card">
            <div class ="card-body">
                <a href="{{route('gallery.album.images',$album->id)}}"><img  title="{{$album->album_name}}" class="card-img-top"
                     src="{{asset($album->album_thumb)}}"
                     alt="{{$album->album_name}}"></a>

                <h5 class="card-title" >
                    <a href="{{route('gallery.album.images',$album->id)}}">{{$album->album_name}}</a>
                </h5>
                <p class="card-text">{{$album->description}}</p>
                <p class="card-text"><small class="text-muted">{{$album->created_at->diffForHumans()}}</small></p>
            </div>
        </div>
        @endforeach
    </div>
    @endsection
