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

    <table class="table table-striped">
        <thead>
        <tr>
            <td>Album name</td>
            <td>Thumb</td>
            <td>Creator</td>
            <td>Created Date</td>
            <td>&nbsp;</td>
        </tr>
        </thead>

        @foreach($albums as $album)
            <tr >
                <td>({{$album->id}}){{$album->album_name}}{{
                        $album->photos_count
                    }}pictures</td>
                <td>
                @if($album->album_thumb)
                    <img width="300" src="{{asset($album->path)}}" title="{{$album->album_name}}" alt="{{$album->album_name}}">
                @endif
                </td>
                <td>{{$album->user->fullname}}</td>
                <td>{{$album->created_at}}</td>
                <td>
                        <a title="Add picture" href="{{route('photos.create')}}?album_id={{$album->id}}" class="btn btn-success">
                            <span class="fa fa-plus"></span>
                        </a>
                    @if($album->photos_count)
                    <a title="View Images" href="{{route('album.getimages',$album->id)}}" class="btn btn-primary">
                        <span class="fa fa-search"></span></a>
                    @endif
                    <a title="Update album" href="{{route('album.edit',$album->id)}}" class="btn btn-primary">
                        <span  class="fa fa-pen"></span></a>
                    <a title="Delete Album" id="delete" href="{{route('album.delete',$album->id)}}" class="btn btn-danger">
                        <span class="fa fa-minus"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="row" colspan="5">
                <div class="col-md-8 push-2">
                    {{$albums->links('vendor.pagination.bootstrap-4')}}
                </div>
            </td>
        </tr>
    </table>
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
