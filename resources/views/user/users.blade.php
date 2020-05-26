@extends('layouts.admin')

@section('content')
	<h1>Usuarios</h1>
	<button class="btn btn-primary">Registrar nuevo usuario</button>
	<div class="col-md-10 card p-4">
		<table class="table table-md primary">
		  	<thead>
		    	<tr>
			      	<th scope="col">#</th>
			      	<th scope="col">First</th>
			      	<th scope="col">Last</th>
			      	<th scope="col">Handle</th>
		    	</tr>
		  	</thead>
		  	<tbody>
		    	<tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			      <td>Otto</td>
			      <td>@mdo</td>
		    	</tr>
			    <tr>
			      	<th scope="row">2</th>
			      	<td>Jacob</td>
			      	<td>Thornton</td>
			      	<td>@fat</td>
			    </tr>
		   	 	<tr>
		      		<th scope="row">3</th>
		      		<td colspan="2">Larry the Bird</td>
		      		<td>@twitter</td>
		    	</tr>
		  	</tbody>
		</table>
	</div>
@endsection