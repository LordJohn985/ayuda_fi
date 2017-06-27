@extends('layouts.admin.base')

    <section class="content">

	<form  action='/pendingPublications/filter' method="POST" enctype="multipart/form-data">
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
                </select>
            </div>

            <input type="text" name="title" placeholder="título" value="{{isset($filterTitle)?$filterTitle:''}}">

            @if($hasFilter)
                <a href="/pendingPublications" class="btn btn-accent pull-right" name="remove_filter">Quitar Filtros</a>
            @endif

            <input class="btn btn-accent pull-right" type="submit" name="filter_button" value="Filtrar">
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
            @foreach($publications as $publication)
               	@if(($publication->calification==null)||($publication->calification->label_id==1))
                <tr>
                    <td>{{$publication->created_at}}</td>
                    <td><a href="/user/{{$publication->user->id}}">{{$publication->user->name}}</a></td>
                    <td><a href="/dashboard/publications/show/{{$publication->id}}">{{$publication->title}}</a></td>
                    <td>{{$publication->category->name}}</td>
                    <td>{{$publication->city->name}}</td>
                    <td><img src="{{asset($publication->image)}}" style="max-height: 350px; max-width: 350px"></td>
                    <td>{{$publication->postulations->count()}}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
