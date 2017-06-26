use App\City;
@extends('layouts.admin.base')


@section('content')

    <section class="content">

        {{--publication details--}}
        <div class=form-group>
            <label>Título</label>
            <div class="panel-body" >{{$publication->title}}</div>
        </div>

        <div class=form-group>
            <label>Imagen</label>
            <img src="{{asset($publication->image)}}">
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

        {{--publication controls--}}
        @if(!$canSomeoneAply)
            <div>
                <label>El candidato ya fue calificado o la publicación ha expirado.</label>
            </div>
        @else
            @if($userIsCandidate->count() == 0)
                <form action="/dashboard/publications/aply/{{$publication->id}}" method="POST" id="form-update">
                    <input type="submit" class="btn btn-success" value="Postularse">
                    <label>Comentario de postulacion:</label>
                    <input type="textarea" name="comment" required>
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
            @else
                <form action="#" method="POST" id="form-update">
                    <input type="submit" class="btn btn-danger" value="Cancelar postulacion" disabled>
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
            @endif

            <form action="/questions/ask/{{$publication->id}}" method="POST" id="form-update">
                <input type="submit" class="btn btn-success" value="Preguntar">
                <label>Ingresa tu pregunta:</label>
                <input type="textarea" name="body_content" required>
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>

            @if($userMadeQuestion->count() > 0)

            {{--table of questions--}}
                    <div class="table-responsive">
                        <table id="tableExample2" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="no-sort" >Pregunta</th>
                                <th class="no-sort" >Respuesta</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $userMadeQuestion as $question)
                                    <tr>
                                        <td>{{$question->content}}</td>
                                        <td>{{$question->answer}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            @endif

        @endif

    </section>

@stop