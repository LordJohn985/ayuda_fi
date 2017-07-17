use \App\Publication
use \App\Label

@extends('layouts.admin.base')

@section('content')
    <section class='content'>
        <div class='form-group'>
            <label>Nombre</label>
            <div class="panel-body" >{{$user->name}}, {{$user->last_name}}</div>
        </div>

        <div class='form-group'>
            <label>Imagen</label>
            <img src="{{asset($user->picture)}}">
        </div>

        <div class='form-group'>
            <label>Reputacion</label>
            <div class="panel-body" >{{\App\Reputation::where('necesary_score', '<=', $user->score)->orderBy('necesary_score', 'DESC')->first()->name}}</div>
        </div>


        <div class='form-group'>
                    <div class='form-group'>
            <a href="/user/publications/{{$user->id}}">Ver gauchadas que creo este usuario</a>
        </div>
        
        <div class='form-group'>
            <a href="/user/postulations/{{$user->id}}">Ver postulaciones de este usuario</a>
        </div>  
        
        <div class='form-group'>
            {{--<label>Calificaciones recibidas</label>--}}
            <div class="panel-body" >
                <table id="tableExample3" class="table table-striped table-hover">
                    <caption>Calificaciones recibidas:</caption>
                    <thead>
                        <tr>
                            <th>Gauchada</th>
                            <th>Comentario</th>
                            <th>Calificacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($califications as $calification)
                            <tr>
                                <td><a href="/publications/show/{{$calification->publication_id}}">{{$calification->title}}</a></td>
                                <td>{{$calification->content}}</td>
                                <td>{{$calification->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
