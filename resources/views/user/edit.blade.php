@extends('layouts.admin')

@section('content')
<h2>Editar Usuario</h2>

<a href="{{route('users.index')}}" class="btn btn-danger mb-3"><img src="{{url('images/arrow-left-solid.svg')}}" alt="Edit" class="svg-action-icon-button">  Cancelar</a>

    <div class="col-md-8 card p-3 shadow p-4 mb-5 bg-white rounded">
        <form method="POST" action="{{route('users.update', ['user' => $user->id])}}">
            @csrf
            {{ method_field('PATCH') }}
            <div class="form-group">
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
                <label for="inputName">Nombre</label>
                <input type="text" name="name" class="form-control" id="inputName" value="{{$user->name}}"  placeholder="">
            </div>
            <div class="form-group">
                @if($errors->has('username'))
                    <div class="error">{{ $errors->first('username') }}</div>
                @endif
                <label for="inputUsername">Nombre de Usuario</label>
                <input type="text" name="username" class="form-control" id="inputUsername"  value="{{$user->username}}"  placeholder="">
            </div>
            <div class="form-group">
                @if($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
                <label for="inputPassword1">Contraseña</label>
                <input type="password" class="form-control" name="password" id="inputPassword1" placeholder="">
            </div>
            <div class="form-group">
                @if($errors->has('role'))
                    <div class="error">{{ $errors->first('role') }}</div>
                @endif
                <label for="roleSelect">Permisos</label>
                <select class="form-control" id="roleSelect" name="role">
                    <option value="0" disabled selected>Selecciona los persmisos</option>
                    <option value="1" {{ $user->role->id == 1 ? 'selected' : '' }}>Administrador</option>
                    <option value="2" {{ $user->role->id == 2 ? 'selected' : '' }}>Gerente</option>
                </select>
              </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            
        </form>
    </div>

@endsection