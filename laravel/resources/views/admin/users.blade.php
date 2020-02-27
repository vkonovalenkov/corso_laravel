@extends('templates.admin')
@section('content')
    <h1>User</h1>
    <table class="table-striped" id="dataTable">
        <thead>
        <tr>
            <th>NAME</th>
            <th>NAME</th>
            <th>NAME</th>
            <th>CREATED AT</th>
            <th>DELETED</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->deleted_at}}</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <button class="btn btn-primary" title="UPDATE">
                                <i class="fa fa-pencil-square-o"></i>
                            </button>
                        </div>
                        <div class="col-4">
                            <button @if($user->deleted_at)
                                    disabled
                                    @else

                                    @endif
                                    class="btn btn-danger" title="SOFT DELETE">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-danger" title="FORCE DELETE">
                                <i class="fa fa-minus-square-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
