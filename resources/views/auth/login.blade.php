@extends('layouts.app')
@section('head')
<style>
    html{
        background-color: #007ab6;
        height: 100%;
    }   
    main{
        background-color: #007ab6;
    } 
    .login-logo{
        width: 15%;
    }
    .card{
        background-color: #0f5787 !important;
        color: white;
    }

</style>    
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-md-12 ">
                <div class="col-md-12 text-center">
                    <img class="img-responsive login-logo" src="{{url('images/LOGO_COGELADORA_CAPYTAN.png')}}" alt="">
                </div>
                <div class="col-md-12 text-center">
                    <h1 class="h2 text-white">Congeladora CAPYTAN</h1>
                </div>
            </div>
           
            
            <div class="card shadow">
                <div class="card-header bg-primary-dark">{{ __('Iniciar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Iniciar Sesión') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
