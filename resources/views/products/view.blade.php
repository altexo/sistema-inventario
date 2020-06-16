@extends('layouts.admin')

@section('content')
<div class="col-md-12 row">

    <a href="{{URL::previous() }}" class="btn btn-danger mb-3 mr-3"><img src="{{url('images/arrow-left-solid.svg')}}" alt="Volcer" class="svg-action-icon-button red-hover">  Volver</a>
    {{-- <a href="#" class="btn btn-primary mb-3"><img src="{{url('images/box-open-solid-white.svg')}}" alt="Watch" class="svg-action-icon-button"> Registrar entrada a inventario</a> --}}
</div>

    <div class="col-md-12 shadow-lg p-4 mb-5 bg-white rounded">
        <h2>{{$product->name}}</h2>
        <div class="col-md-12 row mt-3">
            <div class="col-md-5 card mr-4 shadow text-white mb-3 bg-primary rounded">
                <div class="card-header">En invenario:</div>
                <h5 class="card-title p-3">{{$product->in_stock}} - {{$product->type}}</h5>
            </div>
            <div class="col-md-5 card shadow text-white mb-3 bg-success rounded">
                <div class="card-header">Ultimo precio de compra:</div>
                <h5 class="card-title p-3">{{$product->last_price}}</h5>
            </div>
        </div>
    </div>

    {{-- Registro de nueva entrada --}}
    <div class="col-md-12 shadow-lg p-4 mb-5 bg-white rounded">
        <h5><img src="{{url('images/box-open-solid-white.svg')}}" alt="Watch" class="svg-action-icon-button"> Registrar entrada a inventario</h5>
        <div class="col-md-12 card shadow p-4 mb-5 bg-white rounded  row mt-3" style="margin-left: 0px;">
            <form method="POST" action="{{ route('stock.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="form-row align-items-middle">
                <div class="col-md-5">
                    <label for="inputQty">Cantidad</label>
                    <div class="input-group  mb-4">
                       
                        <input type="number" class="form-control" name="quantity" id="inputQty" placeholder="e.g. 1000">
                        <div class="input-group-append">
                            <span class="input-group-text" id="quantity">KG</span>
                        </div>
                    </div>
                    @error('quantity')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="col-md-5">
                    <label for="inputPrice">Precio de compra</label>
                    <div class="input-group  mb-3 ">
                        <input type="number" class="form-control" id="inputPrice" name="price" min="0"  step=".01" placeholder="e.g. 200">
                        <div class="input-group-append">
                          <span class="input-group-text">$</span>
                        </div>
                    </div>
                    @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="col-md-2 vertical-align-content-middle">
                    <button type="submit" class="col-md-12 btn btn-primary mt-2">Registrar</button>
                </div>
                </div>
            </form>
        </div>
    </div>
     {{-- Termina registro de nueva entrada --}}

     {{-- Ultimas entradas --}}
    <div class="col-md-12 shadow-lg p-4 mb-5 bg-white rounded">
        <h5><img src="{{url('images/box-open-solid-red.svg')}}" alt="Watch" class="svg-action-icon-button"> Ultimos registros de entrada a inventario</h5>
        <div class="col-md-12 card shadow p-4 mb-5 bg-white rounded  row mt-3" style="margin-left: 0px;">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                  <tr>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($stock_entries as $entry)
                        <tr>
                            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $entry->created_at)->format('Y-m-d') }} </td>
                            <td>{{$entry->quantity}}</td>
                            <td>{{$entry->price}}</td>
                            <td>
                                <form action="{{route('stock.destroy', $entry->id)}}" method="POST">
                                    <button class="btn btn-small btn-danger"  onclick="return confirm('Seguro quieres eliminar este registro?')">Eliminar</button>
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
    </div>
@endsection