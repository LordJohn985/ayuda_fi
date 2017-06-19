@extends('layouts.admin.base')


@section('content')

    <section class="content">
            <p><a href="/reputations">Volver</a></p>

        @if($reputationIsNew)
            <h2 class="">Crear reputacion</h2>
        @else
            <h2 class="">Editar reputacion</h2>
        @endif

        <form  {{($reputationIsNew == true ) ? 'action=/reputations/create' : 'action=/reputations/edit/'.$reputation->id}}  method="POST">


            <div class=form-group>
                <label>Título</label>
                <input  type="text" class="form-control"  name="name" placeholder="Título" value="{{isset($reputation->name)?$reputation->name:''}}" required>
            </div>

            <div class=form-group>
                <label>Puntaje necesario</label>
                <input  type="number" class="form-control" rows="3" name="necesary_score" placeholder="Puntaje necesario" value="{{isset($reputation->necesary_score)?$reputation->necesary_score:''}}" required>
            </div>

            <input class="btn btn-accent pull-right" type="submit" value="Save">

            {{ csrf_field() }}

        </form>

    </section>

@stop