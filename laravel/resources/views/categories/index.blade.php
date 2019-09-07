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
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Category name</th>
            <th>Created date</th>
            <th>Update date</th>
            <td>Number of albums</td>
        </tr>
        @forelse($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->category_name}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td>{{$category->albums_count}}</td>
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


@endsection
