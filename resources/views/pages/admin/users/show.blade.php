use \App\Publication
use \App\Label

@extends('layouts.admin.base')

@section('content')
    <section class='content'>

        {{--User information--}}

        <div class='form-group col-md-6'>
            <h4>Nombre: <small>{{$user->last_name}}, {{$user->name}}</small></h4>
            <br>
            <h4>Reputacion: <small>{{\App\Reputation::where('necesary_score', '<=', $user->score)->orderBy('necesary_score', 'DESC')->first()->name}}</small></h4>
            <br>
            <div class='form-group' style="display: inline-block; margin-right: 5px;">
                <a href="/user/publications/{{$user->id}}" class="btn btn-warning">Ver gauchadas que creo este usuario</a>
            </div>
            <br>
            {{--<div class='form-group' style="display: inline-block">
                <a href="/user/postulations/{{$user->id}}" class="btn btn-warning">Ver postulaciones de este usuario</a>
            </div>--}}
        </div>

        <div class='form-group col-md-6'>
            <h4>Imagen:
                <img src="{{asset($user->picture)}}" style="max-height: 200px; max-width: 300px">
            </h4>
        </div>




        
        <div class='form-group col-md-12' style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
            <label>CALIFICACIONES RECIBIDAS:</label>
            <div class="panel-body" >
                <table id="tableExample3" class="table table-striped table-hover">
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
                                <td>{{$calification->label->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@stop