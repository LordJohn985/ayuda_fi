use App\City;
@extends('layouts.admin.base')


@section('content')

    <section class="content">

        <div class=form-group>
            <label>Título</label>
            <div class="panel-body" >{{$publication->title}}</div>
        </div>

        <div class=form-group>
            <label>Imagen</label>
            <div class="panel-body">{{$publication->image}}</div>
        </div>

        <div class=form-group>
            <label>Fecha de finalización</label>
            <div class="panel-body" >{{$publication->finish_date}}</div>
        </div>

        <div class=form-group>
            <label>Ciudad</label>
            <div class="panel-body" >{{$publication->city->name}}</div>
        </div>

        <div class=form-group>
            <label>Categoría</label>
            <div class="panel-body" >{{$publication->category->name}}</div>
        </div>

        <div class=form-group>
            <label>Contenido</label>
            <div class="panel-body" >{{$publication->content}}</div>
        </div>

        <form action="/dashboard/publications/aply/{{$publication->id}}" method="GET" id="form-update">
            <input type="submit" value="Postularse">
            <label>Comentario de postulacion:</label>
            <input type="textarea" name="comment" required>
            <input type="hidden" name="_method" value="GET">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </form>

        <div>
            {{ Form::select('Usuarios', $users)}}
        </div>
    </section>

@stop