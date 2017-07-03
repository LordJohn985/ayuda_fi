@extends('layouts.admin.base')

@section('content')

	<div class='content table-responsive'>
		<table id="tableExample2" class="table table-striped table-hover">
			<thead>
				<tr>
					<th class='no-sort'>Puntaje</th>
					<th class='no-sort'>Nombre</th>
					<th >Reputacion</th>
				</tr>	
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{$user->score}}</td>
						<td><a href="/user/{{$user->id}}">{{$user->name,$user->last_name}}</a></td>
						<td>{{\App\Reputation::where('necesary_score', '<=', $user->score)->orderBy('necesary_score', 'DESC')->first()->name}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection