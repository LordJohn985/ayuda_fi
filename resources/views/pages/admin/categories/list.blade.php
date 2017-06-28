@extends('layouts.admin.base')
@section('content')
    <section class="content">
        <div>
            <a href="/dashboard/categories/create" class="btn btn-warning">Crear categoría</a>
        </div>
        <br><br>
        <div class="table-responsive">
            <table id="tableExample2"  class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="no-sort" >Name</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $categories as $category)
                    <tr data-id = "{{$category->id}}">
                        <td>{{$category->name}}</td>
                        <td>
                            @if(($category->id)>1)
                                <a href="/dashboard/categories/edit/{{$category->id}}">Modificar</a>
                            @endif
                        </td>
                        <td>
                            @if(($category->id)>1)
                                <a href="/dashboard/categories/delete/{{$category->id}}" class="btn-delete" onclick="return confirm('¿Está seguro que desea eliminar esta categoria?')">Eliminar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links()}}
    </section>
@endsection