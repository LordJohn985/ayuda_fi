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
        @if(auth::check() && auth::id()!=$publication->user->id)
            <form action="/dashboard/publications/aply/{{$publication->id}}" method="POST" id="form-update">
                <input type="submit" value="Postularse">
                <label>Comentario de postulacion:</label>
                <input type="textarea" name="comment" required>
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        @elseif(auth::id()==$publication->user->id)
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
                            <td>{{$user->comment}}</td>
                            <td>{{$user->score}}</td>
                            <td>
                                <a href="/dashboard/publications/selectCandidate/{{$user->id}}/{{$publication->id}}">Elegir</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

@stop