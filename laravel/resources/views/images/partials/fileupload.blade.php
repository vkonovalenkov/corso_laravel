<div class="form-group">
            <label for="">Thumbnail</label>
            <input value="{{$photo->image_path}}" type="file"
                   id="image_path" name="image_path"
                   placeholder="Photo name" class="form-control">
        </div>
@if($photo->image_path)
    <div class="form-group">
        <img width="300" src="{{asset($photo->image_path)}}"
             title="{{$photo->name}}" alt="{{$photo->name}}">
    </div>
@endif

