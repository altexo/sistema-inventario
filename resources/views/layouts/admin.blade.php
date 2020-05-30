@extends('layouts.app')

@section('head')
<link href="{{ asset('css/nav-style.css') }}" rel="stylesheet">
  <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

   
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
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Usuarios</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                    <a href="{{route('users.index')}}">Ver Usuarios</a>
                    </li>
                    <li>
                    <a href="{{route('users.create')}}">Nuevo Usuario</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
	    </nav>

	 
@endsection

