@extends('layouts.app')

@section('head')
<link href="{{ asset('css/nav-style.css') }}" rel="stylesheet">
  <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script href="{{ asset('js/scripts.js') }}" > </script>
   
@endsection

@section('navbar')
	
	    <!-- Sidebar -->
	    <nav id="sidebar">
	        <div class="sidebar-header">
            <h3>CAPYTAN</h3>
        </div>

        <ul class="list-unstyled components">
            {{-- <p>Sistmea Inven</p> --}}
            <li class="active">
                <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Usuarios</a>
                <ul class="collapse list-unstyled" id="userSubmenu">
                    <li>
                    <a href="{{route('users.index')}}">Ver Usuarios</a>
                    </li>
                    <li>
                    <a href="{{route('users.create')}}">Nuevo Usuario</a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="#productsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Products</a>
                <ul class="collapse list-unstyled" id="productsSubmenu">
                    <li>
                    <a href="{{route('products.index')}}">Ver Productos</a>
                    </li>
                    <li>
                    <a href="{{route('products.create')}}">Nuevo Producto</a>
                    </li>
                </ul>
            </li>
           
        </ul>
	    </nav>

	 
@endsection

