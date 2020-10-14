@extends('layouts.admin')

@section('content')
<div class="col-md-12 card p-4 shadow-lg p-3 mb-5 bg-white rounded">


	<h2>Productos</h2>
	<a class="btn btn-primary mb-2 col-md-2" href="{{route('products.create')}}">Nuevo Producto</a>


	
	<div class="col-md-12 card p-4 shadow p-3 mb-5 bg-white rounded">
	<form method="GET" action="{{route('products.index')}}">
		<div id="custom-search-input">
			<div class="input-group">
			  <input
				type="text"
				class="search-query form-control border border-secondary"
				name="query"
				placeholder="Buscar Producto"
				value="{{request('query')}}"
			  />
			  @if (request('query'))
				  
			  <span class="input-group-btn">
				  <a href="{{route('products.index')}}">
			  	<button type="button">
					X
				  <span class=""></span>
				  </button>
				</a>
			  </span>
			  @else
				  
			  <span class="input-group-btn">
				<button  type="button" disabled>
				  <span class="fa fa-search"></span>
				</button>
			  </span>

			  @endif

			</div>
		  </div>
		</form>


		<table class="table table-md shadow-sm primary table-hover mt-4">
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
					  		<td>$ @convert($product->last_price)</td>
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