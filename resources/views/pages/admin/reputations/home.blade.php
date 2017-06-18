@extends('layouts.admin.base')

@section('content')

	<div class='content table-responsive'>
		<p><a href="reputations/create">Crear nueva reputacion</a></p>
		<br>
		<table id="tableExample2" class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Nombre reputacion</th>
					<th>Puntaje necesario</th>
				</tr>
			</thead>
			<tbody>
				@foreach($reputations as $reputation)
					<tr>
						<td>{{$reputation->name}}</td>
						<td>{{$reputation->necesary_score}}</td>
						@if(($reputation->id)>2)
							<td><a href="#">Modificar</a></td>
							<td><a href="#">Eliminar</a></td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection