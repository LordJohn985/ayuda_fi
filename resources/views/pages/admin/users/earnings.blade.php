@extends('layouts.admin.base')

@section('content')

	<form  action='/earnings/getEarnings' method="get" enctype="multipart/form-data">
        <div class="content">
            <div class="form-group col-md-3">
                <label>Desde</label>
                <input  type="date" max="{{date('Y-m-d')}}" class="form-control"  name="date_from"  value="{{isset($date_from) ? $date_from : old('date_from')}}" required>
            </div>

            <div class="form-group col-md-3">
                <label>Hasta</label>
                <input  type="date" max="{{date('Y-m-d')}}" class="form-control"  name="date_to" value="{{isset($date_to) ? $date_to : old('date_to')}}" required>
            </div>

			<div class="form-group col-md-3">
				<label></label>
                <input class="btn btn-info" type="submit" name="filter_button" value="Filtrar">
            </div>

            <div class="form-group col-md-3">
            	<label></label>
                <a class="btn btn-success" href="/earnings/getAllPurchases">Todas</a>
            </div>
        </div>
        {{ csrf_field() }}
    </form>

	<div class='content table-responsive'>

		<label> TOTAL DE GANANCIAS: &nbsp &nbsp &nbsp &nbsp &nbsp {{ $total_gral }}</label> 

		<br><br><br><br>

		<table id="tableExample2" class="table table-striped table-hover">
			<caption>LISTADO DE COMPRAS</caption>
			<thead>
				<tr>
					<th >Fecha de Compra</th>
					<th class='no-sort'>Nombre</th>
					<th >Cantidad</th>
					<th >Precio Unitario</th>
					<th >Total</th>
				</tr>	
			</thead>
			<tbody>
				@foreach($purchases as $purchase)
					<tr>
						<td>{{$purchase->purchase_date}}</td>
						<td><a href="/user/{{$purchase->user_id}}">{{$purchase->name,$purchase->last_name}}</a></td>
						<td>{{$purchase->count}}</td>
						<td>{{$purchase->total / $purchase->count}}</td>
						<td>{{$purchase->total}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection