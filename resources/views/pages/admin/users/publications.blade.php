@extends('layouts.admin.base')

@section('content')
    <section class="content">


	<form  action='/user/publications/filter' method="POST" enctype="multipart/form-data">
        <div>
            <div class=form-group>
                <label>Estado</label>
                <select class="form-control" name="state">
                    @if(!$hasFilter)
                        <option value="all">Todas</option>
                    @endif
                    <option value="1"{{(isset($state)&&($state==1))?'selected="selected"':''}}>Sin calificacion</option> 
                    <option value="2"{{(isset($state)&&($state==2))?'selected="selected"':''}}>Con calificacion</option>
                    <option value="3"{{(isset($state)&&($state==3))?'selected="selected"':''}}>Vencida</option>
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

        <br>

    <div>
        <h2>Gauchadas de <a href="/user/{{$user->id}}">{{$user->name}} {{$user->last_name}}</a></h2>
    </div>

        <br>
    <div class="table-responsive">
        <table id="tableExample2" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($publications as $publication)
                <tr>
                    <td><a href="/dashboard/publications/show/{{$publication->id}}">{{$publication->title}}</a></td>
                    <td>
                        @if($publication->calification!=null)
                            @if($publication->calification->label_id==1)
                                Calificacion pendiente
                            @else
                                Calificacion puesta
                            @endif
                        @elseif(strtotime($publication->finish_date)<=strtotime(date('Y-m-d')))
                            Vencida
                        @elseif(count($publication->postulations)>0)
                            Con postulantes
                        @else
                            Sin postulantes
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </section>
@stop