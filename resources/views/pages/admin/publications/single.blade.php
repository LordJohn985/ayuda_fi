@extends('layouts.admin.base')

@section('content')

    <section class="content">


        @if($publicationIsNew)
            <h2>Crear una nueva Gauchada</h2>
        @else
            <h2>Editar Gauchada</h2>
        @endif

        <form  {{($publicationIsNew == true ) ? 'action=/dashboard/publications/create' : 'action=/dashboard/publications/edit/'.$publication->id}}  method="POST" enctype="multipart/form-data">


            <div class="form-group col-md-3">
                <label>Título</label>
                <input  type="text" class="form-control"  name="title" placeholder="Título" value="{{isset($publication->title)?$publication->title:''}}" required>
            </div>

            <div class="form-group col-md-3">
                <label>Fecha de finalización</label>
                <input  type="date" min="{{date('Y-m-d')}}" class="form-control"  name="finish_date" placeholder="Fecha de finalización" value="{{isset($publication->finish_date)?$publication->finish_date:''}}" required>
            </div>

            <div class="form-group col-md-3">
                <label>Ciudad</label>
                <select class="form-control" name="city">
                    @foreach(\App\City::all() as $city)
                        @if($publicationIsNew)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @else
                            <option value="{{$city->id}}" {{($city->id==$publication->city_id)?'selected="selected"':''}}>{{$city->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label>Categoría</label>
                <select class="form-control" name="category">
                    @foreach(\App\Category::where('active','=',1)->get() as $category)
                        @if($publicationIsNew)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}" selected="{{($category->id==$publication->category_id?'selected':'')}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                    {{--<option value="{{isset($publication->category)?$publication->category->id:''}}" selected="selected">{{isset($publication->category)?$publication->category->name:''}} </option>--}}
                </select>
            </div>

            <div class="form-group col-md-12">
                <label>Imagen</label>
                <input  type="file" class="form-control" name="image" placeholder="Imagen" value="{{isset($publication->image)?$publication->image:''}}">
            </div>

            <div class="form-group col-md-12">
                <label>Contenido</label>
                <textarea class="form-control" rows="10" cols="100" name="body_content" placeholder="Describa su publicación" required>{{isset($publication->content)?$publication->content:''}}</textarea>
            </div>

            <input class="btn btn-accent pull-right" type="submit" value="Save">

            {{ csrf_field() }}

        </form>

    </section>

@stop