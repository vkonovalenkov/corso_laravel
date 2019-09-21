{{--
/**
 * Created by PhpStorm.
 * User: vkono
 * Date: 06/09/2019
 * Time: 18:04
 */
--}}

@extends('templates.default')

@section('content')
    @include('partials.inputerrors')
 <div class="row">
    <div class="col-8">
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Category name</th>
            <th>Created date</th>
            <th>Update date</th>
            <th>Number of albums</th>
            <th>&nbsp;</th>
        </tr>
        @forelse($categories as $categoryI)
            <tr>
                <td>{{$categoryI->id}}</td>
                <td>{{$categoryI->category_name}}</td>
                <td>{{$categoryI->created_at}}</td>
                <td>{{$categoryI->albums_count}}</td>
                <td>
                    <form class="form-inline" method="post" action="{{route('categories.destroy',$categoryI->id)}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button class="btn btn-danger" title="DELETE"><span class="fa fa-minus"></span></button>&nbsp;
                        <a href="{{route('categories.edit',$categoryI->id)}}" class="btn btn-primary" title="UPDATE"><span class="fa fa-pen"></span></a>
                    </form>
                </td>
            </tr>
            @empty
            <tfoot>
                <tr>
                    <td colspan="5">No categories</td>
                </tr>
            </tfoot>
            @endforelse
    </table>
        <div class="row">
            <div class="col-md-8 order-first order-md-2">{{$categories->links('vendor.pagination.bootstrap-4')}}</div>
        </div>
     </div>
     <div class="col-4">
         <h2>Add New Category</h2>
         @include('categories.categoryform')
     </div>
 </div>
@endsection
