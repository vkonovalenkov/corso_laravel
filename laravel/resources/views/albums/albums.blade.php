@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>
    @if(session()->has('message'))
        @component('components.alert-info')
            {{session()->get('message')}}
        @endcomponent
    @endif
    <form>
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item justify-content-between">
                ({{$album->id}}){{$album->album_name}}
                @if($album->album_thumb)
                    <img width="300" src="{{asset($album->path)}}" title="{{$album->album_name}}" alt="{{$album->album_name}}">
                @endif
                <div style="text-align:right;">
                        <a href="{{route('photos.create')}}?album_id={{$album->id}}" class="btn btn-primary">NEW IMAGE</a>
                    @if($album->photos_count)
                    <a href="{{route('album.getimages',$album->id)}}" class="btn btn-primary">VIEW IMAGES ({{
                        $album->photos_count
                    }})</a>
                    @endif
                    <a href="{{route('album.edit',$album->id)}}" class="btn btn-primary">UPDATE</a>
                    <a id="delete" href="{{route('album.delete',$album->id)}}" class="btn btn-danger">DELETE</a>
                </div>
            </li>
        @endforeach
            <div class="row">
                <div class="col-md-8 push-2">
                    {{$albums->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>

    </ul>
    </form>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(5000);
           $('ul').on('click','a[id="delete"]',function(ele) {
               ele.preventDefault();
               //alert(ele.target.href);
               var urlAlbum = $(this).attr('href');
               var li = ele.target.parentNode.parentNode;
               $.ajax(
                   urlAlbum,
                   {
                       data:{
                         '_token':$('#_token').val()
                       },
                       method: 'DELETE',
                       complete: function (resp) {
                           //alert(resp.responseText);
                           console.log(resp);
                           if (resp.responseText == 1) {
                               li.parentNode.removeChild(li);
                               //alert(resp.responseText);
                               //$(li).remove();
                           } else {
                               //alert('Problem contacting server');
                           }
                       }
                   }
               )
           });
        });
    </script>
    @endsection
