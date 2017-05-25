use App\City;
@extends('layouts.admin.base')


@section('content')

    <section class="content">

        <div class=form-group>
            <label>Título</label>
            <div class="panel-body" >{{$publication->title}}</div>
        </div>

        <div class=form-group>
            <label>Imagen</label>
            <div class="panel-body">{{$publication->image}}</div>
        </div>

        <div class=form-group>
            <label>Fecha de finalización</label>
            <div class="panel-body" >{{$publication->finish_date}}</div>
        </div>

        <div class=form-group>
            <label>Ciudad</label>
            <div class="panel-body" >{{$publication->city->name}}</div>
        </div>

        <div class=form-group>
            <label>Categoría</label>
            <div class="panel-body" >{{$publication->category->name}}</div>
        </div>

        <div class=form-group>
            <label>Contenido</label>
            <div class="panel-body" >{{$publication->content}}</div>
        </div>
        @if(!auth::id()==1)
            <form action="/dashboard/publications/aply/{{$publication->id}}" method="GET" id="form-update">
                <input type="submit" value="Postularse">
                <label>Comentario de postulacion:</label>
                <input type="textarea" name="comment" required>
                <input type="hidden" name="_method" value="GET">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        @else
            <div class="table-responsive">
                <table id="tableExample2" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Comentario</th>
                        <th class="no-sort" >Reputacion</th>
                        <th class="no-sort" >Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach( $users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->}}</td>
                            <td>{{$user->image}}</td>
                            <td>
                                <a href="/dashboard/update-article/{{$article->id}}">Edit</a>
                                <a href="/dashboard/delete-article/{{$article->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

@stop