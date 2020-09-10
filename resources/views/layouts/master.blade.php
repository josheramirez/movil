<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movilización Occidente</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    {{--  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">  --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    {{--  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">  --}}



    <!-- SweetAlerts 2 -->
    <script src="{{asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
     <!-- jQuery -->
     <script src="{{ URL::asset('/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ URL::asset('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('/dist/js/demo.js') }}"></script>

    <!-- DatePicker -->
    <link rel="stylesheet" href="{{asset('plugins/datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datePicker/css/bootstrap-datepicker3.standalone.css')}}">
    <script src="{{asset('plugins/datePicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

    <!-- jQuery timepicker library -->
    <link rel="stylesheet" href="{{ URL::asset('/plugins/timepicker/timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/plugins/timepicker/wickedpicker.css') }}">
    <script src="{{ URL::asset('/plugins/timepicker/timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/timepicker/wickedpicker.js') }}"></script>

    <script src="{{ URL::asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ URL::asset('/plugins/datatables/FixedHeader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/datatables/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/datatables/Responsive/js/responsive.bootstrap4.min.js') }}"></script>


    <link rel="stylesheet" href="{{asset('/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables/FixedHeader/css/fixedHeader.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables/Responsive/css/responsive.bootstrap.min.css')}}">


    <link rel="stylesheet" href="{{asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('/plugins/toastr/toastr.min.css')}}">
    <!-- Toastr -->
    <script src="{{asset('/plugins/toastr/toastr.min.js')}}"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Select2 -->
    <script src="{{asset('/plugins/select2/js/select2.full.min.js')}}"></script>

    <!-- Moment -->
    <script src="{{asset('/plugins/moment/moment.min.js')}}"></script>


    <style>
        .alert-info {
            color: #0c5460 !important;
            background-color: #d1ecf1 !important;
            border-color: #bee5eb !important;
        }

        .fc-day-grid-event>.fc-content {
            white-space: normal;
        }
        .navbar-nav{
            align-items: center;
            justify-content: center
        }
}
    </style>
</head>

{{-- <body class="hold-transition sidebar-mini sidebar-collapse"> --}}
<body class="hold-transition sidebar-collapse">




    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container col-md-11" style="padding-left:27.5px;padding-right:27.5px">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    Sistema de movilizacion
                </a>
                @php $usuario = Auth::user(); @endphp
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- <div class="usuario" style="padding-left:20px">
                    {{strtoupper ($usuario->obtenerTipoUsuario())}}
                </div> --}}


                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <ul class="navbar-nav" style="padding-left:20px">
                        @if($usuario!=null)
                            {{-- MENU ADMINISTRADOR --}}
                            @if($usuario->obtenerTipoUsuario()=='Administrador'||$usuario->obtenerTipoUsuario()=="God")
                                @if( Str::contains(Route::current()->uri(),'administrador'))
                                    <li class="nav-item" >
                                        <a href="{{route('administrador')}}" class="nav-link" style="font-weight:600"><i class="fas fa-route" aria-hidden="true"></i> Gestión solicitudes</a>
                                    </li>
                                    <li class="nav-item" >
                                        <a href="{{route('administrador')}}" class="nav-link" style="font-weight:600"><i class="fas fa-taxi" aria-hidden="true"></i> Gestión moviles</a>
                                    </li>
                                    <li class="nav-item" >
                                        <a href="{{route('post.index')}}" class="nav-link" style="font-weight:600"><i class="fas fa-taxi" aria-hidden="true"></i>Enviar notificacion</a>
                                    </li>
                                @endif
                            @endif
                            {{-- MENU TRABAJADOR --}}
                            @if($usuario->obtenerTipoUsuario()=='Trabajador'||$usuario->obtenerTipoUsuario()=="God")
                                @if( Str::contains(Route::current()->uri(),'trabajador'))
                                    <li class="nav-item" >
                                        <a href="{{route('usuario.solicitudesBuscar')}}" class="nav-link" style="font-weight:600"><i class="fas fa-route" aria-hidden="true"></i> Mis viajes</a>
                                    </li>
                                @endif
                            @endif
                        @endif
                    </ul>
                </div>

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        {{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{route('register')}}">
                        <i class="far fa-comments"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{route('login')}}">
                        <i class="far fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav> --}}
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="{{ URL::asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Agenda</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ URL::asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../index.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v1</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Widgets
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Layout Options
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../layout/top-nav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Top Navigation</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Charts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../charts/chartjs.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    UI Elements
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../UI/general.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Forms
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../forms/general.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General Elements</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../tables/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Tables</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.4
            </div>
            <strong>Agenda Occidente</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


</body>

</html>

