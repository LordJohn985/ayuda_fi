use App\City;

@extends('layouts.admin.base')

@section('content')

    <section class="content">
        <a href="../edit/{{$publication->id}}">Editar</a>
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
        @if($candidateSelected->count()==0)
            @if($publicationIsExpired)
                <div>
                    <label>La publicación ha expirado.</label>
                </div>
            @else
                {{--table of candidates--}}
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

                        @foreach( $candidates as $candidate)
                            <tr>
                                <td><a href="/user/{{$candidate->id}}">{{$candidate->name}}</a></td>
                                <td>{{$candidate->comment}}</td>
                                <td>{{\App\Reputation::where('necesary_score', '<=', $candidate->score)->orderBy('necesary_score', 'DESC')->first()->name}}</td>
                                <td>
                                    <a href="/dashboard/publications/selectCandidate/{{$candidate->id}}/{{$publication->id}}">Elegir</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if($questionsAll->count() > 0)
                    {{--table of questions--}}
                    <div class="table-responsive">
                        <table id="tableExample2" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Reputacion</th>
                                <th class="no-sort" >Pregunta</th>
                                <th class="no-sort" >Respuesta</th>
                                <th class="no-sort" >Responder</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $questionsAll as $question)
                                    <tr>
                                        <td><a href="/user/{{$question->user_id}}">{{ $question->user->name}}</a></td>
                                        <td>{{ \App\Reputation::where('necesary_score', '<=', \App\User::where('id', '=', $question->user_id)->first()->score )->orderBy('necesary_score', 'DESC')->first()->name }}</td>
                                        {{--<td>{{var_dump($question->user->reputation)}}</td>--}}
                                        <td>{{$question->content}}</td>
                                        <td>{{$question->answer}}</td>
                                        <td>
                                        <!--ESTO NO CREO FUNCIONE-->
                                        @if($question->answer=='Sin respuesta aun')

                                            <form action="/questions/answer/{{$question->id}}" method="POST" id="form-update">
                                                <input type="submit" class="btn btn-success" value="Responder">
                                                <input type="textarea" name="answer" required>
                                                <input type="hidden" name="_method" value="POST">
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            </form>

                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            @endif
        @elseif($candidateIsRated->label->id == 1)
            {{--form to rate candidate--}}
            <form action="/dashboard/publications/rate/{{$publication->id}}" method="POST" id="form-update">
                <label>Usuario elegido: {{$candidateSelected->first()->name}}</label>
                <input type="submit" class="btn btn-info" value="Calificar">
                <label>Comentario de calificacion:</label>
                <input type="textarea" name="comment" required>
                <select class="form-control" name="label">
                    @foreach(\App\Label::all() as $label)
                        {{--@if($label->id==1)
                            <option value="{{$label->id}}" selected="selected">{{$label->name}}</option>
                        @else
                            <option value="{{$label->id}}">{{$label->name}}</option>
                        @endif--}}
                        <option value="{{$label->id}}">{{$label->name}}</option>
                    @endforeach
                    {{--<option value="{{isset($publication->calification->label)?$publication->calification->label->id:''}}" selected="selected">{{isset($publication->calification->label)?$publication->calification->label->name:''}} </option>--}}
                </select>
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        @else
            {{--message when candidate is rated or publication has expired--}}
            <div>
                <label>El candidato ya fue calificado.</label>
            </div>
        @endif
    </section>

@stop