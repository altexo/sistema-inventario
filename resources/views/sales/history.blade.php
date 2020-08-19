@extends('layouts.admin')

@section('content')
    <h2>Historial de Ventas</h2>
    <ul class="nav mt-3">
        <li class="nav-item col-md-3">
            <div class="form-group row ">
                <label class="col-md-3">Desde</label>
                <date-picker class="col-md-8"></date-picker>
                {{-- <img src="{{url('images/calendar.svg')}}" alt="Edit" class="svg-action-icon-button col-md-3"> --}}
            </div>

        </li>
        <li class="nav-item col-md-3">
            <div class="form-group row">
                <label class="col-md-4">Hasta</label>
                <date-picker class="col-md-8"></date-picker>
            </div>

        </li>
        <li class="nav-item col-md-3">
            <button class="btn btn-sm btn-primary">Aplicar rango de fechas</button>
        </li>
        <li class="nav-item">
            {{-- <button class="btn btn-sm btn-primary">Generar reporte</button> --}}
        </li>
      </ul>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"># de venta</th>
            <th scope="col">Productos</th>
            <th scope="col">Total de venta</th>
            {{-- <th scope="col">Handle</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($sales as $sale)
              <tr>
                <th scope="row">{{$sale->id}}</th>
                <td>
                @forelse ($sale->products as $product)
                    {{$product->name}} {{$product->pivot->quantity}} {{$product->type}} <br>
                @empty
                    
                @endforelse
                </td>
                <td>@convert($sale->total)</td>
              </tr>
          @endforeach
    
        </tbody>
      </table>
@endsection
