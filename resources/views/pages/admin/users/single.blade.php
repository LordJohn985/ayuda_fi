@extends('layouts.admin.base')

@section('content')

    <section class="content">
        @if (Session::has('error'))
            <div class="col-md-6 pull-right">
                <div class="alert alert-error fade in">
                    <strong>{{ Session::get('error') }}</strong>
                </div>
            </div>
        @endif
        @if (Session::has('error-db'))
            <div class="col-md-6 pull-right">
                <div class="alert alert-error fade in">
                    <strong>{{ Session::get('error-db') }}</strong>
                </div>
            </div>
        @endif

        @if($userIsNew)
            <h2 class="">Create a new User</h2>
        @else
            <h2 class="">Edit User</h2>
        @endif

        <form  {{($userIsNew == true ) ? 'action=/dashboard/users/create' : 'action=/dashboard/users/edit/'.$user->id}}  method="POST" enctype="multipart/form-data">


            <div class=form-group>
                <label>First Name</label>
                <input  type="text" class="form-control"  name="name" placeholder="First Name" value="{{isset($user->name)?$user->name:''}}" required>
            </div>

            <div class=form-group>
                <label>Email</label>
                <input  type="email" class="form-control"  name="email" placeholder="Email" value="{{isset($user->email)?$user->email:''}}" required>
            </div>

            <div class=form-group>
                <label>Password</label>
                <input  type="text" class="form-control"  name="password" placeholder="Password" value="" required>
            </div>

            <div class=form-group>
                <label>User's Role</label>
                <select class="form-control" name="role">
                    @foreach(\App\Role::all() as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                    <option value="{{isset($user->role)?$user->role->id:''}}" selected="selected">{{isset($user->role)?$user->role->name:''}} </option>
                </select>
            </div>

            <div class=form-group>
                <label>Picture</label>
                <input type="file" name="picture" class="form-control" rows="3" />
            </div>

            <input class="btn btn-accent pull-right" type="submit" value="Save">

            {{ csrf_field() }}

        </form>

    </section>

@stop