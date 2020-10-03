@extends('layouts.admin')

@section('content')
<h2>Editar Producto</h2>

<a href="{{route('products.index')}}" class="btn btn-danger mb-3"><img src="{{url('images/arrow-left-solid.svg')}}" alt="Edit" class="svg-action-icon-button">  Volver</a>

    <div class="col-md-8 card p-3 shadow p-4 mb-5 bg-white rounded">
        <form method="POST" action="{{route('products.update', ['product' => $product->id])}}">
            @csrf
            {{ method_field('PATCH') }}
            <div class="form-group">
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
                <label for="inputName">Nombre del Producto</label>
                <input type="text" name="name" class="form-control" id="inputName" value="{{$product->name}}"  placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            
        </form>
    </div>

@endsection