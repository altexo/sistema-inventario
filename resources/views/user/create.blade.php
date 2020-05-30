@extends('layouts.admin')

@section('content')
<h2>Registrar Nuevo Usuario</h2>
    @if ($message = Session::get('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">{{$message}}')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-md-8 card p-3 shadow p-4 mb-5 bg-white rounded">
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

@endsection