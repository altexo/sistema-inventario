@extends('layouts.admin')

@section('content')
    <div class="col-md-12 shadow-lg p-4 mb-5 bg-white rounded">
        <h2>Crear Producto</h2>
        
        <div class="col-md-12 shadow p-3 mb-5 bg-white rounded">
            <form method="POST" action="{{route('products.store')}}">
                @csrf
                <div class="form-group">
                   
                    <label for="inputProductName">Nombre el producto</label>
                    <input required type="text" class="form-control" id="inputProductName" name="product_name">
                    @error('product_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="selectProductType">Tipo de venta</label>
                    <select required class="form-control" id="selectProductType" name="type">
                      <option value="KG" selected>KG</option>
                      <option value="PZA">Pza</option>
                    </select>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                
                
              <add-to-stock-component></add-to-stock-component>
               
                <button type="submit" class="btn btn-primary mt-4">Guardar</button>
            </form>
        </div>
    </div>

@endsection