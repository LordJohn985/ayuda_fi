@extends('layouts.public.base')

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
                    <td>{{$publication->user->name}}</td>
                    <td><a href=/dashboard/publications/show/{{$publication->id}}">{{$publication->title}}</a></td>
                    <td>{{$publication->category->name}}</td>
                    <td>{{$publication->city->name}}</td>
                    <td><img src="{{asset($publication->image)}}" style="max-height: 350px; max-width: 350px"></td>
                    <td>{{$publication->postulations->count()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{-- $publications->links()--}}
@endsection
