@extends('templates.default')
@section('content')
    <h1>New Album</h1>
    @include('partials.inputerrors')
    <form action="{{route('album.save')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="form-group">
            <label for="">Name</label>
            <input  value="{{old('name')}}" type="text" id="name" name="name" placeholder="Album name" class="form-control">
        </div>
        @include('albums.partials.fileupload')
        <div class="form-group">
            <label for="">Description</label>
            <textarea  id="description" name="description" placeholder="Album description" class="form-control">{{old('description')}}</textarea>
        </div>
        @include('albums.partials.category_combo')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
