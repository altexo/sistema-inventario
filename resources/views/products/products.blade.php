@extends('layouts.admin')

@section('content')
	<h2>Productos</h2>
	<button class="btn btn-primary mb-2 ">Nuevo Producto</button>
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
			      	<th scope="col">En Inventario</th>
					<th scope="col">Ultimo precio registrado</th>
					<th scope="col"></th>  
		    	</tr>
		  	</thead>
		  	<tbody>
				  	@forelse ($products as $product)
					  <tr>
					  	<th scope="row">{{$product->id}}</th>
					  		<td>{{$product->name}}</td>
							<td>{{$product->in_Stock}}</td>
					  		<td>{{$product->last_price}}</td>
							<td class="display-flex">
								<a class="btn btn-default btn-small" href="{{route('products.edit', ['product'=> $product->id])}}" ><img src="{{url('images/edit-regular.svg')}}" alt="Edit" class="svg-action-icon"></a>
								<form action="{{route('products.destroy', ['product'=>$product->id])}}" method="POST">
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