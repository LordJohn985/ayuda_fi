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

        @if($categoryIsNew)
            <h2 class="">Create a new Category</h2>
        @else
            <h2 class="">Edit Category</h2>
        @endif

        <form  {{($categoryIsNew == true ) ? 'action=/dashboard/categories/create' : 'action=/dashboard/categories/edit/'.$category->id}}  method="POST" enctype="multipart/form-data">


            <div class=form-group>
                <label>Category Name</label>
                <input  type="text" class="form-control"  name="name" placeholder="Category Name" value="{{isset($category->name)?$category->name:''}}" required>
            </div>

            <input class="btn btn-accent pull-right" type="submit" value="Save">

            {{ csrf_field() }}

        </form>

    </section>

@stop