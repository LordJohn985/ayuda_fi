@extends('layouts.admin.base')

@section('content')

    <section class="content">
        <div>
            <a href="/dashboard/categories/list" class="btn btn-warning">Volver</a>
        </div>
        <br><br>
        @if($categoryIsNew)
            <h2 class="">Crear nueva Categoria</h2>
        @else
            <h2 class="">Editar Categoria</h2>
        @endif

        <form  {{($categoryIsNew == true ) ? 'action=/dashboard/categories/create' : 'action=/dashboard/categories/edit/'.$category->id}}  method="POST" enctype="multipart/form-data">


            <div class=form-group>
                <label>Nombre</label>
                <input  type="text" class="form-control"  name="name" placeholder="Nombre de cateogría" value="{{isset($category->name)?$category->name: ''}}" required>
            </div>

            @if($categoryIsNew)
                <input class="btn btn-accent pull-right" type="submit" value="Crear">
            @else
                <input class="btn btn-accent pull-right" type="submit" value="Editar">
            @endif

            {{ csrf_field() }}

        </form>

    </section>

@stop