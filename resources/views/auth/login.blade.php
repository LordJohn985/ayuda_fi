@extends('layouts.public.base')


@section('content')
    <!-- Main content-->
    <section class="content">

        <div class="container-center animated slideInDown">


            <div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-unlock"></i>
                </div>
                <div class="header-title">
                    <h3>Login</h3>
                    <small>
                        Ingresa tus credenciales para loguearte.
                    </small>
                </div>
            </div>

            <div class="panel panel-filled">
                <div class="panel-body">
                    <form  id="loginForm" role="form" method="POST" action="{{ route('login') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label" for="username">Email</label>
                            <input type="text" placeholder="example@gmail.com" title="Please enter you email" required="" value="" name="email" id="email" class="form-control">
                            <span class="help-block small">Ingresa aquí tu email.</span>
                        </div>
                        @include('includes.form-error', ['field' => 'email'])
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                            <span class="help-block small">Ingresa aquí tu contraseña.</span>
                        </div>
                        @include('includes.form-error', ['field' => 'password'])
                        <div style="text-align: center;">
                            <button class="btn btn-accent ">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!-- End main content-->
@endsection
