use App\City;

@extends('layouts.admin.base')

@section('content')

    <section class="content">

        {{--Controls to edit or delete a publication--}}

        @if(!$publicationIsExpired)
            @if(($candidateIsRated===null)||($candidateIsRated->label->id == 1))
                <div class="col-md-2">
                    <a href="../delete/{{$publication->id}}" class="btn btn-warning" onclick="return confirm('¿Esta seguro que desea eliminar esta gauchada?')">Eliminar Gauchada</a>
                </div>
            @endif
            @if($candidates->count() == 0)
                <div class="col-md-10">
                    <a href="../edit/{{$publication->id}}" class="btn btn-warning">Editar Gauchada</a>
                </div>
            @endif
            <br><br>
        @endif

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
                @if(!$publicationIsExpired)
                    <a href="/publication/setOriginalPhoto/{{$publication->id}}" class="btn btn-warning" onclick="return confirm('¿Esta seguro que desea poner la foto por defecto?')">Eliminar foto</a>
                @endif
            </h4>
        </div>

        <br><br><br><br><br><br><br>
        {{--Content of publication--}}
        <div class="form-group">
            <h4>Contenido</h4>
            <div class="panel-body" >{{$publication->content}}</div>
        </div>

        {{--PUBLICATION CONTROLS--}}
        @if($candidateSelected->count()==0)
            @if($publicationIsExpired)
                <div class="divContainer" style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                    <div>
                        <label>La publicación ha expirado o fué borrada.</label>
                    </div>
                </div>
            @else
                {{--table of candidates--}}
                <div class="divContainer" style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                    <div>
                        <label>POSTULANTES:</label>
                    </div>
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
                </div>
                @if($questionsAll->count() > 0)
                    {{--table of questions--}}
                    <br><br>
                    <div class="divContainer" style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                        <div class="table-responsive">
                            <table id="tableExample2" class="table table-striped table-hover">
                                <caption>PREGUNTAS</caption>
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

                                                <form action="/questions/answer/{{$question->id}}/{{$publication->id}}" method="POST" id="form-update">
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
                    </div>
                @endif

            @endif
        @elseif($candidateIsRated->label->id == 1)
            {{--form to rate candidate--}}
            <div class="divContainer" style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                <form action="/dashboard/publications/rate/{{$publication->id}}" method="POST" id="form-update">
                    <label>Usuario elegido: <a href="/user/{{$candidateSelected->first()->id}}" style="display: inline">{{$candidateSelected->first()->name}}</a></label>
                    <input type="submit" class="btn btn-info" value="Calificar">
                    <label>Comentario de calificacion:</label>
                    <input type="textarea" name="comment" value="{{old('comment')}}" required>
                    <br><br>
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
            </div>

        @else
            {{--message when candidate is rated or publication has expired--}}
            <div class="divContainer" style="border: solid; border-color: #ff9a00; border-radius: 5px; padding: 10px;">
                <div>
                    <label>El candidato  <a href="/user/{{$candidateIsRated->user->id}}" style="display: inline">{{$candidateIsRated->user->name}}</a> ya fue calificado.</label>
                </div>
            </div>
        @endif
    </section>

@stop