@extends('templates.default')
@section('content')
    <h1>Images for {{$album->album_name}}</h1>
    @if(session()->has('message'))
        @component('components.alert-info')
            {{session()->get('message')}}
        @endcomponent
    @endif
<table class="table table-bordered">
    <tr>
        <th>CREATED DATE</th>
        <th>TITLE</th>
        <th>ALBUM</th>
        <th>THUMBNAIL</th>
    </tr>
    @forelse($images as $image)
        <tr>
            <td>{{$image->created_at}}</td>
            <td>{{$image->name}}</td>
            <td><a href="{{route('album.edit',$image->album_id)}}" >{{$album->album_name}}</a> </td>
            <td>
                <img width="120" src="{{asset($image->image_path)}}">
            </td>
            <td>

                <a title="Edit Picture" href="{{route('photos.edit',$image->id)}}" class="btn btn-sm btn-primary">
                    <span class="fa fa-pen"></span></a>

                <a title="Delete Picture" href="{{route('photos.destroy',$image->id)}}" class="btn btn-sm btn-danger">
                    <span class="fa fa-minus"></span></a>
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="5">
                    NO IMAGES FOUND
                </td>
            </tr>
        @endforelse
    <tr>
        <td colspan="6" class="text-center">
            <div class="row">
                <div class="col-md-8 push-2">
                    {{$images->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>

        </td>
    </tr>
</table>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            //$('div.alert').fadeOut(5000);
            $('table').on('click','a.btn-danger',function(ele) {
                ele.preventDefault();
                //alert(ele.target.href);
                var urlImg = $(this).attr('href');
                var tr = ele.target.parentNode.parentNode;
                $.ajax(
                    urlImg,
                    {
                        data:{
                            '_token': '{{csrf_token()}}'
                        },
                        method: 'DELETE',
                        complete: function (resp) {
                            //alert(resp.responseText);
                            console.log(resp);
                            if (resp.responseText == 1) {
                                tr.parentNode.removeChild(tr);
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

