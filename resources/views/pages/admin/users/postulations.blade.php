@extends('layouts.admin.base')

@section('content')
    <section class="content">
        {{--Filters--}}
        <form  action='/user/postulations/filter' method="POST" enctype="multipart/form-data">
            <div {{--class="content"--}}>
                <div class=form-group>
                    <label>Estado</label>
                    <select class="form-control" name="state">
                        <option value="1"{{(isset($state)&&($state==1))?'selected="selected"':''}}>Aceptado</option>
                        <option value="2"{{(isset($state)&&($state==2))?'selected="selected"':''}}>Rechazado</option>
                        <option value="3"{{(isset($state)&&($state==3))?'selected="selected"':''}}>Pendiente</option>
                    </select>
                    <input type="hidden" name='user' value='{{$user->id}}' >
                </div>

                @if($hasFilter)
                    <a href="/user/postulations/{{$user->id}}" class="btn btn-accent pull-right" name="remove_filter">Quitar Filtros</a>
                @endif

                <input class="btn btn-accent pull-right" type="submit" name="filter_button" value="Filtrar">
            </div>
            {{ csrf_field() }}
        </form>

        <br>

        <div class="form-group">
            <h2>Postulaciones de <a href="/user/{{$user->id}}">{{$user->name}} {{$user->last_name}}</a></h2>
        </div>

        <br>

        <div class="table-responsive">
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
                        @if(!(($postulation->calification==null)&&($postulation->deleted_at!=null)))
                            <td><a href="/dashboard/publications/show/{{$postulation->id}}">{{$postulation->title}}</a></td>
                            <td>
                                @if($postulation->calification!=null)
                                    @if($postulation->calification->user_id!=$user->id)
                                        Rechazado
                                    @else
                                        Aceptado
                                    @endif
                                @else
                                    Pendiente
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop