@extends('templates.admin')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>User Insert/Update</h1>
                @if($user->id)
                        <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        {{method_field('PATCH')}}
                @else
                        <form action="{{route('users.create')}}" method="POST" enctype="multipart/form-data">

                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input value="{{$user->name?$user->name:old("name")}}" type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="your name">
                    @if($errors->get('name'))
                        <div class="badge badge-danger">
                            @foreach($errors->get('name') as $error)
                                {{$error}}<br>
                                @endforeach
                        </div>
                        @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="{{$user->email?$user->email:old("email")}}" type="email" name="email" id="email" class="form-control" placeholder="" aria-describedby="your email">
                    @if($errors->get('email'))
                        <div class="badge badge-danger">
                            @foreach($errors->get('email') as $error)
                                {{$error}}<br>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">Seleziona</option>
                        <option value="user"
                            {{($user->role == 'user' || old("role") == 'user' ? 'selected': '')}}
                        >User</option>
                        <option value="admin"
                            {{($user->role == 'admin' || old("role") == 'admin' ? 'selected': '')}}
                        >Admin</option>
                    </select>
                    @if($errors->get('role'))
                        <div class="badge badge-danger">
                            @foreach($errors->get('role') as $error)
                                {{$error}}<br>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="form-group text-center">
                    {{csrf_field()}}
                    <button class="btn btn-default" id="reset" type="reset">SAVE</button>
                    <button class="btn btn-primary" id="save" >SAVE</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
