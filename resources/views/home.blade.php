@extends('layouts.admin.base')

@section('content')
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
                    <td><img src="{{asset($publication->image)}}"></td>
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
