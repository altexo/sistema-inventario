@extends('layouts.admin')

@section('content')
<div class="col-md-12 card p-4 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="col-md-12 row">
        <div class="col-md-10">
            <h2>Historial de Ventas</h2>
        </div>
        <div class="col-md-2">
            <button onclick="exportSales()" type="submit" class="btn btn-sm btn-success float-right"><img src="{{url('images/download.svg')}}" alt="Edit" class="svg-action-icon-button"> Exportar</button>
        </div>
       
    </div>
   
    <ul class="nav col-md-12 card  shadow navbar-dark bg-dark rounded" >
      <form method="GET" action="{{ route('sales.history') }}" class="col-md-12 row" id="filter-form">
        <li class="nav-item col-md-3 pt-4">
           
                <div class="form-group row ">
                    <label class="col-md-4 text-white">Desde </label>
                <date-picker name="fromDate" class="col-md-8" value="{{request('fromDate')}}"></date-picker>
                    {{-- <img src="{{ url('images/calendar.svg') }}" alt="Edit"
                        class="svg-action-icon-button col-md-3"> --}}
                </div>

        </li>
        <li class="nav-item col-md-3 pt-4">
            <div class="form-group row">
                <label class="col-md-4 text-white">Hasta</label>
                <date-picker name="toDate" class="col-md-8" value="{{request('toDate')}}"></date-picker>
            </div>

        </li>
        <li class="nav-item col-md-3 pt-4">
            <button type="submit" class="btn btn-sm btn-primary">Aplicar rango de fechas</button>
        </li>
        
        </form>
   
        
    </ul>
    <div class="col-md-12 card p-4 shadow p-3 mb-5 bg-white rounded">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col"># de venta</th>
                <th scope="col">Fecha</th>
                <th scope="col">Productos</th>
                <th scope="col">Total de venta</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <th scope="row">{{ $sale->id }}</th>
                    <?php \Carbon\Carbon::setLocale('es'); ?>
                    <td>{{$sale->created_at->translatedFormat('l j F Y')}}</td>
                    <td>
                        @forelse ($sale->products as $product)
                            {{ $product->name }} {{ $product->pivot->quantity }} {{ $product->type }} | Precio/Unitario: $ @convert($product->pivot->sale_price) <br>
                        @empty

            @endforelse
            </td>
            <td>$ @convert($sale->total)</td>
            <td>  
                <form action="{{route('sales.delete')}}" method="GET">
                    <input type="hidden" value="{{$sale->id}}" name="id">
                    <button class="btn btn-small btn-danger"  onclick="return confirm('Seguro quieres cancelar esta venta?')">Cancelar</button>
                    @csrf
                </form>
            </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $sales->links() }}
    </div>
</div>
@endsection
@section('footer')
    <script>
        const exportSales = () => {
           let fromDate = document.querySelector('input[name=fromDate]').value
           let toDate = document.querySelector('input[name=toDate]').value
           if(toDate !== '' || fromDate !== ''){
                 
           }
           
        }
    </script>
    
@endsection
