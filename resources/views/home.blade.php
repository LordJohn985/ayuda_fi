@extends('layouts.admin.base')

@section('content')
    <form  action='/publications/filter' method="POST" enctype="multipart/form-data">
    <div class="content">
        <div class=form-group>
            <label>Categoría</label>
            <select class="form-control" name="category">
                @if(!isset($filterCategory))
                    <option value="all" selected="selected">Todas</option>
                @endif
                @foreach(\App\Category::all() as $category)
                    @if(isset($filterCategory))
                        <option value="{{$category->id}}" {{$category->id==$filterCategory ? 'selected="selected"' : ''}}>{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @endforeach
                {{--<option value="{{isset($publication->category)?$publication->category->id:''}}" selected="selected">{{isset($publication->category)?$publication->category->name:''}} </option>--}}
            </select>
        </div>
        <div class=form-group>
            <label>Ciudad</label>
            <select class="form-control" name="city">
                @if(!isset($filterCity))
                    <option value="all" selected="selected">Todas</option>
                @endif
                @foreach(\App\City::all() as $city)
                    @if(isset($filterCity))
                        <option value="{{$city->id}}" {{$city->id==$filterCity ? 'selected="selected"' : ''}}>{{$city->name}}</option>
                    @else
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endif
                @endforeach
                {{--<option value="{{isset($publication->city)?$publication->city->id:''}}" selected="selected">{{isset($publication->city)?$publication->city->name:''}} </option>--}}
            </select>
        </div>
        {{--@if(isset($filterTitle))
            <input type="text" name="title" placeholder="título" value="{{$filterTitle}}">
        @else--}}
            <input type="text" name="title" placeholder="título">
        {{--@endif--}}
        {{--@if($hasFilter)--}}
            <input class="btn btn-accent pull-right" type="submit" value="Quitar filtros">
        {{--@else--}}
            <input class="btn btn-accent pull-right" type="submit" value="Filtrar">
        {{--@endif--}}
        </div>
        {{ csrf_field() }}

    </form>

    <div class="content table-responsive">
        <table id="tableExample2" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Fecha Creacion</th>
                <th>Autor</th>
                <th>Titulo</th>
                <th>Categoría</th>
                <th>Ciudad</th>
                <th class="no-sort" >Imagen</th>
                <th>Postulantes</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $publications as $publication)
                <tr>
                    <td>{{$publication->created_at}}</td>
                    <td><a href="/user/{{$publication->user->id}}">{{$publication->user->name}}</a></td>
                    <td><a href="/dashboard/publications/show/{{$publication->id}}">{{$publication->title}}</a></td>
                    <td>{{$publication->category->name}}</td>
                    <td>{{$publication->city->name}}</td>
                    <td><img src="{{asset($publication->image)}}" style="max-height: 350px; max-width: 350px"></td>
                    <td>{{$publication->postulations->count()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--<div>
        <form action="/dashboard/publications/filter" method="get">
            <input type="text" name="title">
            <input type="text" name="city">
            <input type="text" name="category">
        </form>
        <form action="/dashboard/publications/unfilter" method="get">
            <input type="submit" valie="Quitar filtros">
        </form>
    </div>--}}
    {{-- $publications->links()--}}
@endsection
