use \App\Publication
use \App\Label

@extends('layouts.admin.base')

@section('content')
    <section class='content'>
        <div class="col-md-12">
            <a href="/user/edit/{{$user->id}}" class="btn btn-warning">Editar perfil</a>
        </div>

        <br><br>

        <div class='form-group'>
            <label>Nombre: </label>
            <div class="panel-body" >{{$user->name}}, {{$user->last_name}}</div>
        </div>

        <div class='form-group'>
            <label>Imagen: </label>
            <img src="{{asset($user->picture)}}">
        </div>

        <div class="col-md-12">
            <a href="/user/setOriginalPhoto/{{$user->id}}" class="btn btn-warning" onclick="return confirm('¿Esta seguro que desea poner la foto por defecto?')">Eliminar foto</a>
        </div>

        <br><br>

        <div class='form-group'>
            <label>Reputacion: </label>
            <div class="panel-body" >{{\App\Reputation::where('necesary_score', '<=', $user->score)->orderBy('necesary_score', 'DESC')->first()->name}}</div>
        </div>
		
		<div class='form-group'>
            <label>Correo electronico: </label>
            <div class="panel-body" >{{$user->email}}</div>
        </div>

        <div class='form-group'>
            <label>Telefono: </label>
            <div class="panel-body" >{{$user->phone}}</div>
        </div>

        <div class='form-group'>
            <label>Creditos disponibles: </label>
            <div class="panel-body" >{{$user->credits}}</div>
        </div>

        
        <div class='form-group'>
            {{--<label>Gauchadas a las que te postulaste:</label>--}}
            <div class="panel-body" >
                <table id="tableExample2" class="table table-striped table-hover">
                    <caption>Gauchadas a las que te postulaste:</caption>
                    <thead>
                        <tr>
                            <th>Gauchada</th>                   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($postulations as $postulation)
                            <tr>
                                <td><a href="/publications/show/{{$postulation->publication_id}}">{{$postulation->title}}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
		<div class='form-group'>
            {{--<label>Gauchadas que creaste:</label>--}}
            <div class="panel-body" >
                <table id="tableExample1" class="table table-striped table-hover">
                    <caption>Gauchadas que creaste:</caption>
                    <thead>
                        <tr>
                            <th>Gauchada</th>                   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publications as $publication)
                            <tr>
                                <td><a href="/publications/show/{{$publication->id}}">{{$publication->title}}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class='form-group'>
            {{--<label>Calificaciones que recibiste:</label>--}}
            <div class="panel-body" >
                <table id="tableExample3" class="table table-striped table-hover">
                    <caption>Calificaciones que recibiste:</caption>
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