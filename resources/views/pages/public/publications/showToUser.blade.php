@extends('layouts.admin.base')


@section('content')

    <section class="content" style="padding: 5px; margin-top: 45px;">

        {{--PUBLICATION DETAILS--}}

        <div class="col-md-6">
            <h4>Título: <small>{{$publication->title}}</small></h4>
            <h4>Ciudad: <small>{{$publication->city->name}}</small></h4>
            <h4>Categoría: <small>{{$publication->category->name}}</small></h4>
            <h4>Fecha de finalización: <small>{{$publication->finish_date}}</small></h4>
        </div>

        <div class="col-md-6">
            <h4>Imagen:
                <img src="{{asset($publication->image)}}" style="max-height: 250px; max-width: 300px">
            </h4>
        </div>

        <br><br><br><br><br><br><br>

        {{--Content of publication--}}
        <div class=form-group>
            <h4>Contenido</h4>
            <div>{{$publication->content}}</div>
        </div>

        {{--PUBLICATION CONTROLS--}}
        @if(!$canSomeoneAply)
            {{--No es posible postularse--}}
            <div style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                @if(((\Carbon\Carbon::parse($publication->finish_date)->isPast()))||($publication->calification->user_id == auth::id()))
                    <label>Ya has sido seleccionado y calificado en esta gauchada, o la gauchada ha expirado.</label>
                @else
                    <label>El candidato ya fue calificado o la gauchada ha expirado.</label>
                @endif
            </div>
        @else
            {{--Controls to aply or stop aplying to a publication--}}
            <div style="display: inline-block; border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                @if($userIsCandidate->count() == 0) {{--Controls to aply--}}
                <form action="/dashboard/publications/aply/{{$publication->id}}" method="POST" id="form-update">
                    <label>Comentario de postulacion:</label>
                    <input type="textarea" name="comment" required>
                    <input type="submit" class="btn btn-success" value="Postularse">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
                @else {{--Controls to stop aplying--}}
                <form action="/dashboard/publications/quit_aply/{{$publication->id}}" method="POST" id="form-update">
                    <input type="submit" class="btn btn-danger" value="Cancelar postulacion">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
                @endif
            </div>

            <br><br>
            {{--Table of questions--}}
            <div style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 5px;">
                <div class="table-responsive">
                    <label>PREGUNTAS:</label>
                    <table id="tableExample2" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Reputacion</th>
                            <th class="no-sort" >Pregunta</th>
                            <th class="no-sort" >Respuesta</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $publication->questions as $question)
                            <tr>
                                <td><a href="/user/{{$question->user_id}}">{{ $question->user->name}}</a></td>
                                <td>{{ \App\Reputation::where('necesary_score', '<=', \App\User::where('id', '=', $question->user_id)->first()->score )->orderBy('necesary_score', 'DESC')->first()->name }}</td>
                                <td>{{$question->content}}</td>
                                <td>{{$question->answer}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <form action="/questions/ask/{{$publication->id}}" method="POST" id="form-update">
                    <label>Ingresa tu pregunta:</label>
                    <input type="textarea" name="body_content" required>
                    <input type="submit" class="btn btn-success" value="Preguntar">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
            </div>
        @endif
    </section>
@stop