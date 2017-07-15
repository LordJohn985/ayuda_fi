@extends('layouts.admin.base')

@section('content')
    {{--<section class="content">--}}


	<form  action='/user/publications/filter' method="POST" enctype="multipart/form-data">
        <div class="content">
            <div class=form-group>
                <label>Estado</label>
                <select class="form-control" name="state">
                    <option value="1"{{(isset($state)&&($state==1))?'selected="selected"':''}}>Sin postulantes</option>
                    <option value="2"{{(isset($state)&&($state==2))?'selected="selected"':''}}>Con postulantes</option>
                    <option value="3"{{(isset($state)&&($state==3))?'selected="selected"':''}}>Calificacion pendiente</option>
                    <option value="4"{{(isset($state)&&($state==4))?'selected="selected"':''}}>Calificacion puesta</option>
                    <option value="5"{{(isset($state)&&($state==5))?'selected="selected"':''}}>Vencida</option>
                </select>
                <input type="hidden" name='user' value='{{$user->id}}' >
            </div>

            @if($hasFilter)
                <a href="/user/publications/{{$user->id}}" class="btn btn-accent pull-right" name="remove_filter">Quitar Filtros</a>
            @endif

            <input class="btn btn-accent pull-right" type="submit" name="filter_button" value="Filtrar">
        </div>
        {{ csrf_field() }}
    </form>

    <div class="content">
        <h2>Postulaciones de {{$user->name}} {{$user->last_name}}</h2>
    </div>


    <div class="content table-responsive">
        <table id="tableExample2" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Gauchada</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($postulations as $postulation)
                <tr>
                    <td><a href="/dashboard/publications/show/{{$publication->id}}">{{$publication->title}}</a></td>
                    <td>
                        @if($postulation->publications->calification!=null)
                            @if($postulation->publications->calification->user_id!=$user->id)
                                Rechazado
                            @else
                                Aceptado
                            @endif
                        @else
                            Pendiente
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--</section>--}}
@stop