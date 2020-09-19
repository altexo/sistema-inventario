@extends('layouts.admin')
@section('content')
    <h2>Reportes</h2>
    <div class="col-md-12 card p-4 shadow-lg p-3 mb-5 bg-white rounded d-flex align-items-center">
        <div class="col-md-8 card p-4 shadow p-3 mb-5 bg-white rounded ">
            <div class="form-group row">
                <label for="fromDate" class="col-sm-2 col-form-label">Desde</label>
                <div class="col-sm-10">
                    <date-picker name="fromDate" inputClass="form-control"  value="{{request('fromDate')}}"></date-picker>
                   
                </div>
              </div>
              <div class="form-group row">
                <label for="toDate" class="col-sm-2 col-form-label">Hasta</label>
                <div class="col-sm-10">
                    <date-picker name="toDate" inputClass="form-control"  value="{{request('fromDate')}}"></date-picker>
                </div>
              </div>
              <div class="form-group row mt-2">
                <label for="reportType"  class="col-sm-3 col-form-label">Tipo de reporte</label>
                <select id="reportType" class="form-control col-sm-8">
                  <option disabled selected>Seleccione el tipo de reporte</option>
                  <option>Por Productos</option>
                  <option>Por ventas facturadas</option>
                </select>
              </div>
              <div class="col-md-12 text-right">
                <button class="col-md-3 btn btn-sm btn-success "><img src="{{url('images/download.svg')}}" alt="Edit" class="svg-action-icon-button"> Exportar reporte</button>
              </div>
              
        </div>
    </div>
@endsection