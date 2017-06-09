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

        {{--publication controls--}}
        @if($candidateSelected->count()==0)
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
                            <td>{{$candidate->name}}</td>
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
        @elseif($candidateIsRated->label->id == 1)
            {{--form to rate candidate--}}
            <form action="/dashboard/publications/rate/{{$publication->id}}" method="POST" id="form-update">
                <label>Usuario elegido: {{$candidateSelected->user->name}}</label>
                <input type="submit" value="Calificar">
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
                <label>El candidato ya fue calificado o la publicación ha expirado.</label>
            </div>
        @endif
    </section>

@stop