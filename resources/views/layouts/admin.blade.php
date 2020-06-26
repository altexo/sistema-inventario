@extends('layouts.app')

@section('head')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"> --}}


    <script href="{{ asset('js/scripts.js') }}" > </script>
   
@endsection

@section('navbar')
	
{{-- 	 
	    <nav id="sidebar">
	        <div class="sidebar-header">

            <img class="img-responsive logo" src="{{url('images/LOGO_COGELADORA_CAPYTAN.png')}}" alt="">
            <h3 class="vertical-align-content-middle">CAPYTAN</h3> 
            </div>

        <ul class="list-unstyled components">
         
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
            <li>
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

            <li >
                <a href="{{route('sales.sale')}}" >Venta</a>

            </li>
           
        </ul>
	    </nav> --}}
        <nav class="navbar navbar-dark fixed-top bg-primary-light flex-md-nowrap p-0 shadow mb-4">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-white" href="#"><img class="img-responsive logo" src="{{url('images/LOGO_COGELADORA_CAPYTAN.png')}}" alt="">CONGELADORA CAPYTAN</a>
            <ul class="navbar-nav px-3">
              <li class="nav-item text-nowrap">
                <a class="nav-link text-white" href="{{ route('logout')  }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Cerrar Sesion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
            </ul>
          </nav>
      
          <div class="container-fluid mt-4">
            <div class="row max-height">
              <nav class="col-md-2 d-none d-md-block bg-primary-dark sidebar mt-4">
                <div class="sidebar-sticky">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link active" href="#">
                        {{-- <span data-feather="home"></span>
                        Dashboard <span class="sr-only">(current)</span> --}}
                      </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.index')}}">  <span> <img src="{{url('images/users-solid.svg')}}" alt="users" class="svg-action-navbar"> </span>  Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('products.index')}}">  <span><img src="{{url('images/fish-solid.svg')}}" alt="products" class="svg-action-navbar"></span>
                            Products</a>
                      
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('sales.sale')}}" >      
                        <span><img src="{{url('images/cash-register-solid.svg')}}" alt="sale" class="svg-action-navbar"></span>
                        Venta
                    </a>
                     
                  

                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <span><img src="{{url('images/file-invoice-dollar-solid.svg')}}" alt="Volcer" class="svg-action-navbar"></span>
                        Reportes
                      </a>
                    </li>
              
                  </ul>
      
                  <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    {{-- <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                      <span data-feather="plus-circle"></span>
                    </a>
                  </h6>
                  <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        Current month
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        Last quarter
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        Social engagement
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        Year-end sale
                      </a>
                    </li>
                  </ul> --}}
                </div>
              </nav>
      
       
     
	 
@endsection
@section('footer')

@endsection
