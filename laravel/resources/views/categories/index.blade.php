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
    <div class="col-10">
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Category name</th>
            <th>Created date</th>
            <th>Update date</th>
            <th>Number of albums</th>
            <th>&nbsp;</th>
        </tr>
        @forelse($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->category_name}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td>{{$category->albums_count}}</td>
                <td>
                    <form method="post" action="{{route('categories.destroy',$category->id)}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button class="btn btn-danger">DELETE</button>
                    </form>
                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary">UPDATE</a>
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
     <div class="col-2">
         <h2>Add New Category</h2>
         @include('categories.categoryform')
     </div>
 </div><div class="row"></div>
@endsection
