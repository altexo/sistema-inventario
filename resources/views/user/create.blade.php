@extends('layouts.admin')

@section('content')
<div class="card col-md-12 shadow-lg">
<h2 class="mt-3">Registrar Nuevo Usuario</h2>
<a href="{{route('users.index')}}" class="btn btn-danger mb-3 col-md-2"><img src="{{url('images/arrow-left-solid.svg')}}" alt="Edit" class="svg-action-icon-button">  Cancelar</a>
    <div class="col-md-12 card p-3 shadow p-4 mb-5 bg-white rounded">
        <form method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="form-group">
                <label for="inputName">Nombre</label>
                <input type="text" name="name" class="form-control" id="inputName"  placeholder="">
            </div>
            <div class="form-group">
                <label for="inputUsername">Nombre de Usuario</label>
                <input type="text" name="username" class="form-control" id="inputUsername"  placeholder="">
            </div>
            <div class="form-group">
                <label for="inputPassword1">Contraseña</label>
                <input type="password" class="form-control" name="password" id="inputPassword1" placeholder="">
            </div>
            <div class="form-group">
                <label for="roleSelect">Permisos</label>
                <select class="form-control" id="roleSelect" name="role">
                    <option disabled selected>Selecciona los persmisos</option>
                    <option value="1">Administrador</option>
                    <option value="2" >Gerente</option>
                </select>
              </div>
            <button type="submit" class="btn btn-primary">Guardad</button>
        </form>
    </div>
</div>
@endsection