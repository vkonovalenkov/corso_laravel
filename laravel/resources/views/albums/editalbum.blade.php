@extends('templates.default')
@section('content')
<h1>Edit Album</h1>
@include('partials.inputerrors')
    <form action="/albums/{{$album->id}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label for="">Name</label>
            <input value="{{old('name',$album->album_name)}}" type="text"  required id="name" name="name" placeholder="Album name" class="form-control">
        </div>
        @include('albums.partials.fileupload')
        <div class="form-group">
            <label for="">Description</label>
            <textarea required  id="description" name="description" placeholder="Album description" class="form-control">
            {{old('description',$album->description)}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('albums')}}" class="btn btn-info">Back</a>
        <a href="{{route('album.getimages',$album->id)}}" class="btn btn-success">Album Image</a>
    </form>
@stop
