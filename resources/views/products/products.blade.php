@extends('layouts.admin')

@section('content')
<div class="col-md-12 card p-4 shadow-lg p-3 mb-5 bg-white rounded">


	<h2>Productos</h2>
	<button class="btn btn-primary mb-2 col-md-2">Nuevo Producto</button>

	
	<div class="col-md-12 card p-4 shadow p-3 mb-5 bg-white rounded">
		<table class="table table-md shadow-sm primary table-hover">
		  	<thead class="thead-dark">
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
					  		<td>{{$product->in_stock}} - {{$product->type}}</td>
					  		<td>{{$product->last_price}}</td>
							<td class="display-flex">
								<a class="btn btn-default action-button" title="Almacen" href="{{route('products.show', ['product'=> $product->id])}}" ><img src="{{url('images/box-open-solid.svg')}}" alt="Watch" class="svg-action-icon"></a>
								<a class="btn btn-default action-button" title="Editar" href="{{route('products.edit', ['product'=> $product->id])}}" ><img src="{{url('images/edit-regular.svg')}}" alt="Edit" class="svg-action-icon"></a>
								<form action="{{route('products.destroy', ['product'=>$product->id])}}" method="POST">
									<button type="submit" class="btn btn-default action-button" title="Borrar" onclick="return confirm('Seguro quieres eliminar este producto?')" ><img src="{{url('images/trash-alt-regular.svg')}}" alt="Borrar" class="svg-action-icon"></button>
									@method('DELETE')
									@csrf
								</form>
							</td>
					  	</tr>  
				  	@empty
					  
				  	@endforelse
		    	
		  	</tbody>
		</table>
		{{ $products->links() }}
	</div>
</div>
@endsection