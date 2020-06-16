@extends('layouts.admin')

@section('content')
<h2>Editar Producto</h2>

@if(Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show col-md-10" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {{Session::forget('success')}}
@endif
<a href="{{route('products.index')}}" class="btn btn-danger mb-3"><img src="{{url('images/arrow-left-solid.svg')}}" alt="Edit" class="svg-action-icon-button">  Volver</a>

    <div class="col-md-8 card p-3 shadow p-4 mb-5 bg-white rounded">
        <form method="POST" action="{{route('products.update', ['product' => $product->id])}}">
            @csrf
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="inputName">Nombre del Producto</label>
                <input type="text" name="name" class="form-control" id="inputName" value="{{$product->name}}"  placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            
        </form>
    </div>

@endsection