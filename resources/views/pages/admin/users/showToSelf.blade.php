use \App\Publication
use \App\Label

@extends('layouts.admin.base')

@section('content')
    <section class='content'>
        <div class="col-md-12">
            <a href="/user/edit/{{$user->id}}" class="btn btn-warning">Editar perfil</a>
        </div>

        <br><br>

        {{--User information--}}

        <div class='form-group col-md-8'>
            <h4>Nombre: <small>{{$user->last_name}}, {{$user->name}}</small></h4>

            <h4>Reputacion: <small>{{\App\Reputation::where('necesary_score', '<=', $user->score)->orderBy('necesary_score', 'DESC')->first()->name}}</small></h4>

            <h4>Creditos disponibles: <smal>{{$user->credits}}</smal></h4>

            <h4>Correo electronico: <small>{{$user->email}}</small></h4>

            <h4>Telefono: <small>{{$user->phone}}</small></h4>
        </div>

        <div class='form-group col-md-4'>
            <h4>Imagen:
                <img src="{{asset($user->picture)}}" style="max-height: 250px; max-width: 300px">
                <a href="/user/setOriginalPhoto/{{$user->id}}" class="btn btn-warning" onclick="return confirm('¿Esta seguro que desea poner la foto por defecto?')">Eliminar foto</a>
            </h4>
        </div>

        {{--Links to publications--}}

        <div class='form-group col-md-12'>
            <div class='form-group' style="display: inline-block; margin-right: 5px;">
                <a href="/user/publications/{{$user->id}}" class="btn btn-warning">Ver gauchadas que creaste</a>
            </div>

            <div class='form-group' style="display: inline-block">
                <a href="/user/postulations/{{Auth::id()}}" class="btn btn-warning">Ver tus postulaciones</a>
            </div>
        </div>

        {{--Recieved califications--}}

        <div class='form-group col-md-12' style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 5px;">
            <label>CALIFICACIONES QUE RECIBISTE:</label>
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
                            <td>{{$calification->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@stop