@extends('layouts.admin.base')

@section('content')

	<div class='content table-responsive'>
		<p><a href="reputations/create">Crear nueva reputacion</a></p>
		<br>
		<table id="tableExample2" class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Puntaje necesario</th>
					<th>Nombre reputacion</th>
						<th>Modificar</th>
						<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				@foreach($reputations as $reputation)
					<tr>
						<td>{{$reputation->necesary_score}}</td>
						<td>{{$reputation->name}}</td>
							<td>
								@if(($reputation->id)>2)
									<a href="/reputations/edit/{{$reputation->id}}">Modificar</a>
								@endif
							</td>
							<td>
								@if(($reputation->id)>2)
									<a href="/reputations/delete/{{$reputation->id}}" onclick="return confirm('¿Esta seguro que desea eliminar esta reputacion?')">Eliminar</a>
								@endif
							</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection