use App\City;
@extends('layouts.public.base')


@section('content')

    <section class="content">

        <div class=form-group>
            <label>Título</label>
            <div class="panel-body" >{{$publication->title}}</div>
        </div>

        <div class=form-group>
            <label>Imagen</label>
            <img src="{{asset($publication->image)}}">
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

        @if(!$canSomeoneAply)
            <div>
                <label>El candidato ya fue calificado o la publicación ha expirado.</label>
            </div>
        @endif
    </section>

@stop