@extends('layouts.admin')

@section('content')
	<h2>Usuarios</h2>
	<button class="btn btn-primary mb-2 ">Registrar nuevo usuario</button>
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
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
							<td class="display-flex">
								<a class="btn btn-default btn-small" href="{{route('users.edit', ['user'=> $user->id])}}" ><img src="{{url('images/edit-regular.svg')}}" alt="Edit" class="svg-action-icon"></a>
								<form action="{{route('users.destroy', ['user'=>$user->id])}}" method="POST">
									<button type="submit" class="btn btn-default btn-small" onclick="return confirm('Seguro quieres eliminar este usuario?')" ><img src="{{url('images/trash-alt-regular.svg')}}" alt="Borrar" class="svg-action-icon"></button>
									@method('DELETE')
									@csrf
								</form>
							</td>
					  	</tr>  
				  	@empty
					  
				  	@endforelse
		    	
		  	</tbody>
		</table>
	</div>
@endsection