@extends('layouts.admin.base')

@section('content')

    <section class="content">

        @if($userIsNew)
            <h2 class="">Create a new User</h2>
        @else
            <h2 class="">Edit User</h2>
        @endif

        <form  {{($userIsNew == true ) ? 'action=/dashboard/users/create' : 'action=/dashboard/users/edit/'.$user->id}}  method="POST" enctype="multipart/form-data">


            <div class=form-group>
                <label>Nombre</label>
                <input  type="text" class="form-control"  name="name" placeholder="First Name" value="{{isset($user->name)?$user->name:''}}" required>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="last_name" class="col-md-4 control-label">Apellido</label>
                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ isset($user->last_name)?$user->last_name:'' }}" required>
                @if ($errors->has('name'))
                    <span class="help-block">
                       <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>            

            <div class=form-group>
                <label>Email</label>
                <input  type="email" class="form-control"  name="email" placeholder="Email" value="{{isset($user->email)?$user->email:''}}" required>
            </div>



            <div class=form-group>
                <label>Picture</label>
                <input type="file" name="picture" class="form-control" rows="3" />
            </div>

            <div class="form-group">
                <label for="birth" class="col-md-4 control-label">Fecha de nacimiento</label>
                <input id="birth" type="date" class="form-control" name="birth" value="{{ isset($user->born_date)?date('Y-m-d',strtotime($user->born_date)):'' }}" required>
                @if ($errors->has('birth'))
                    <span class="help-block">
                    <strong>{{ $errors->first('birth') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-group">
                <label for="phone" class="col-md-4 control-label">Telefono</label>
                <input id="phone" type="number" class="form-control" name="phone" value="{{isset($user->phone)?$user->phone:''}}" required>
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
                
            <div class=form-group>
                <label>Password</label>
                <input  type="password" class="form-control"  name="password" placeholder="Password" value="">
            </div>
            
            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
            </div>


            <input class="btn btn-accent pull-right" type="submit" value="Save">

            {{ csrf_field() }}

        </form>

    </section>

@stop