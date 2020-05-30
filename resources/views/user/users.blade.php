@extends('layouts.admin')

@section('content')
	<h2>Usuarios</h2>
	<button class="btn btn-primary mb-2 ">Registrar nuevo usuario</button>
	<div class="col-md-9 card p-4 shadow p-3 mb-5 bg-white rounded">
		<table class="table table-md primary">
		  	<thead>
		    	<tr>
			      	<th scope="col">#</th>
			      	<th scope="col">Nombre</th>
			      	<th scope="col">Usuario</th>
					<th scope="col">Permisos</th>
					<th scope="col"></th>  
		    	</tr>
		  	</thead>
		  	<tbody>
				  	@forelse ($users as $user)
					  <tr>
					  	<th scope="row">{{$user->id}}</th>
					  		<td>{{$user->name}}</td>
							<td>{{$user->username}}</td>
					  		<td>{{$user->role->role}}</td>
							<td>actions</td>
					  	</tr>  
				  	@empty
					  
				  	@endforelse
		    	
		  	</tbody>
		</table>
	</div>
@endsection