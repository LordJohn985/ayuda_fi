@extends('layouts.admin.base')

@section('content')
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
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
