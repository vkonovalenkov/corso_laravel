<div class="form-group">
            <label for="">Thumbnail</label>
            <input value="{{$album->album_name}}" type="file" id="album_thumb" name="album_thumb" placeholder="Album name" class="form-control">
        </div>
@if($album->album_thumb)
    <div class="form-group">
        <img width="300" src="{{asset($album->path)}}" title="{{$album->album_name}}" alt="{{$album->album_name}}">
    </div>
@endif
