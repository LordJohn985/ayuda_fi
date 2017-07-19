@extends('layouts.admin.base')

@section('content')
    {{--<section class="content">--}}


	<form  action='/user/publications/filter' method="POST" enctype="multipart/form-data">
        <div class="content">
            <div class=form-group>
                <label>Estado</label>
                <select class="form-control" name="state">
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

    <div class="content table-responsive">
        <h2>Gauchadas de {{$user->name}}  {{$user->last_name}}</h2>
    </div>


    <div class="content table-responsive">
        <table id="tableExample2" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($publications as $publication)
                @if(!(($publication->calification==null)&&($publication->deleted_at!=null)))
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
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    {{--</section>--}}
@stop