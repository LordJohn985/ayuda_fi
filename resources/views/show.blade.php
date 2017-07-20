use App\City;
@extends('layouts.public.base')


@section('content')

    <section class="content">

        <div class="col-md-6">
            <h4>Título: <small>{{$publication->title}}</small></h4>
            <h4>Ciudad: <small>{{$publication->city->name}}</small></h4>
            <h4>Categoría: <small>{{$publication->category->name}}</small></h4>
            <h4>Fecha de finalización: <small>{{$publication->finish_date}}</small></h4>
        </div>

        <div class="col-md-6">
            <h4>Imagen:
                <img src="{{asset($publication->image)}}" style="max-height: 250px; max-width: 300px">
            </h4>
        </div>

        <br><br><br><br><br><br><br><br>

        <div class=form-group>
            <h4>Contenido</h4>
            <div class="panel-body" >{{$publication->content}}</div>
        </div>

        @if(!$canSomeoneAply)
            <div style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                <label>El candidato ya fue calificado o la publicación ha expirado.</label>
            </div>
        @endif
    </section>

@stop