<!DOCTYPE html>
<?php  $IPHOST = Session::get('IPHOST');?>
<?php  $IPCLIENT = Session::get('IPCLIENT');?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HOME') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   
      <script src="/js/jquery.min.js"></script>

      <script src="/table/dataTables.jqueryui.min.js"></script>
      
      
    <!-- Fonts -->
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dataTables.bootstrap4.minbueno.css') }}" rel="stylesheet">
   
   <link href="{{ asset('iconfont/material-icons.css') }}" rel="stylesheet">
    <!----------------------------------------- Styles -->

<style type="text/css">
    .dropdown-item:hover {
  color: white;
  background: rgb(50,50,50);
}
 
</style>

</head>
<body style="background-image:url('{{ URL::asset ('img/fondo.jpg') }}');

  background-size: 100% 300%;
  height: 100%;">
    <div id="app" style="height: 600px;">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">HOME
                 <!--    {{ config('app.name', 'HOME') }}-->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                   @if($IPHOST==$IPCLIENT)
                                
                               
                            <a class="nav-link" href="{{ url('/Menus') }}" role="button">
                    CATEGORIAS
                </a>
                     <a class="nav-link" href="{{ url('/Agregamesa') }}" role="button">
                    CUENTAS
                </a>
              

                            <!-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   CLIENTES<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/Cliente">
                                        ....
                                    </a>
                                    


                                   
                                </div>
                            </li>-->

                           
                            <a class="nav-link" href="{{ url('/Meseros') }}" role="button">
                              PERSONAL
                            </a>


                           <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   ORDENES<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/Ordenes/1">
                                       COCINA
                                    </a>
                                    <a class="dropdown-item cambia" href="/Ordenes/2" >
                                       BAR
                                    </a>
                                </div>
                                
                            </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   REPORTES<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/ReporteGeneral">
                                       REPORTE GENERAL
                                    </a>
                                    <a class="dropdown-item" href="/ReporteMeseros">
                                       REPORTE MESEROS
                                    </a>
                                </div>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/ReporteMeseros">
                                       REPORTE MESEROS
                                    </a>
                                </div>

                            </li>



 @endif  

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} 
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="font-size: 1em;">
                                      <i class="material-icons" style="font-size:16px; ">exit_to_app</i>  {{ __('SALIR') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
 

        <main class="py-4" >
            @yield('content')
             
        </main>
    </div>


    <!-- Scripts -->
         

</body>
</html>
   
