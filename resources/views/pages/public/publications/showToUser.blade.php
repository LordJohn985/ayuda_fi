use App\City;
@extends('layouts.admin.base')


@section('content')

    <section class="content">

        {{--publication details--}}
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

        {{--publication controls--}}
        @if($userIsCandidate->count() == 0)
            <form action="/dashboard/publications/aply/{{$publication->id}}" method="POST" id="form-update">
                <input type="submit" value="Postularse">
                <label>Comentario de postulacion:</label>
                <input type="textarea" name="comment" required>
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        @else
            <form action="#" method="POST" id="form-update">
                <input type="submit" value="Cancelar postulacion">
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        @endif
    </section>

@stop