@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>
    @if(session()->has('message'))
        @component('components.alert-info')
            {{session()->get('message')}}
        @endcomponent
    @endif



    <table class="table table-striped">
        <thead>
        <tr>
            <td>Album name</td>
            <td>Thumb</td>
            <td>Creator</td>
            <td>Created Date</td>
            <td>Categories</td>
            <td>&nbsp;</td>
        </tr>
        </thead>

        @foreach($albums as $album)
            <tr id="tr{{$album->id}}">
                <td>({{$album->id}}){{$album->album_name}}{{
                        $album->photos_count
                    }}pictures
                </td>
                <td>
                @if($album->album_thumb)
                    <img width="300" src="{{asset($album->path)}}" title="{{$album->album_name}}" alt="{{$album->album_name}}">
                @endif
                </td>
                <td>{{$album->user->fullname}}</td>
                <td>
                    @if($album->categories)
                    <ul>
                    @foreach($album->categories as $category)
                            <li>{{$category->category_name}} ({{$category->id}})</li>
                        @endforeach
                    </ul>
                        @else
                            No categories bound
                        @endif
                </td>
                <td>{{$album->created_at->format('d/m/Y H:i')}}</td>
                <td>
                    <div class="row">
                        <div class="col-3">
                        <a title="Add picture" href="{{route('photos.create')}}?album_id={{$album->id}}" class="btn btn-success">
                            <span class="fa fa-plus"></span>
                        </a>
                        </div>
                        <div class="col-3">
                        @if($album->photos_count)
                        <a title="View Images" href="{{route('album.getimages',$album->id)}}" class="btn btn-primary">
                            <span class="fa fa-search"></span>
                        </a>
                            @else
                                <span class="fa fa-search"></span>
                        @endif
                        </div>
                        <div class="col-3">
                        <a title="Update album" href="{{route('album.edit',$album->id)}}" class="btn btn-primary">
                            <span  class="fa fa-pen"></span>
                        </a>
                        </div>
                        <div class="col-3">
                            <form id="form{{$album->id}}" method="post" action="{{route('album.delete',$album->id)}}">
                            @csrf
                                @method('DELETE')
                            <button id="{{$album->id}}" title="Delete Album" id="delete" class="btn btn-danger">
                            <span class="fa fa-minus"></span>
                            </button>
                            </form>
                        </div>
                    </div>
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

@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            //alert('ok');
            $('div.alert').fadeOut(5000);
           $('table').on('click','button.btn-danger',function(evt) {
               evt.preventDefault();
               var id = evt.target.id;
               var f =$('#form'+id);
               //alert(ele.target.href);
               var urlAlbum = f.attr('action');
               var tr = $('#tr'+id);
               $.ajax(
                   urlAlbum,
                   {
                       data:{
                         '_token':'{{csrf_token()}}'
                       },
                       method: 'DELETE',
                       complete: function (resp) {
                           //alert(resp.responseText);
                           console.error(resp+'---resp');
                           if (resp.responseText == 1) {
                               //tr.parentNode.removeChild(tr);
                               tr.remove();
                               //alert(resp.responseText);
                               //$(li).remove();
                           } else {
                               alert('Problem contacting server');
                           }
                       }
                   }
               )
           });
        });
    </script>
    @endsection
