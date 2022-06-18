<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistema Academico y Control de Notas SEBBES" name="description" />
    <meta content="JGuillen" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico') }}">

    <!-- Plugins css-->
    <link href="{{ URL::asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">


                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ URL::asset('images/users/profile.png') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">¡Bienvenid@!</h6>
                        </div>

                        <!-- item-->
                        <a href="/mi-cuenta" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-outline"></i>
                            <span>Cambiar mi clave</span>
                        </a>                       

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>


            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.html" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{ URL::asset('images/logo-sebbes.png') }}" alt="" height="18">
                        <!-- <span class="logo-lg-text-dark">Velonic</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-lg-text-dark">V</span> -->
                        <img src="{{ URL::asset('images/logo-sebbes.png') }}" alt="" height="22">
                    </span>
                </a>

                <a href="index.html" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <!--<img src="{{ URL::asset('images/logo-sebbes.png') }}" alt="" height="18">-->
                        <span class="logo-lg-text-light">SEBBES</span>
                    </span>
                    <span class="logo-sm">
                        <span class="logo-lg-text-light">SEBBES</span>
                        <!--<img src="{{ URL::asset('images/logo-sm.png') }}" alt="" height="22">-->
                    </span>
                </a>
            </div>

            <!-- LOGO -->


            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="slimscroll-menu">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul class="metismenu" id="side-menu">

                        <li class="menu-title">Menu Principal</li>

                        <li>
                            <a href="/" class="waves-effect">
                                <i class="ion-md-speedometer"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ion ion-md-people"></i>
                                <span> Estudiantes </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">

                                <!--<li><a href="/estudiantes/registrar">Nuevo Estudiante</a></li>-->
                                <li><a href="/estudiantes">Lista de Estudiantes</a></li>                               
                                <li><a href="/solicitudes-de-admision">Solicitudes de Admisión</a></li>  
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ion-ios-apps"></i>
                                <span> Academico </span>      
                                <span class="menu-arrow"></span>                          
                            </a>    
                            <ul class="nav-second-level" aria-expanded="false">                                
                                <li><a href="/inscripciones">Inscripción de Materias</a></li>                               
                                <li><a href="/colector-de-notas">Colector de Notas</a></li>  
                                <li><a href="/hojas-de-asistencia">Hoja de Asistencia</a></li>  
                            </ul>                        
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ion ion-md-stats"></i>
                                <span> Informes </span>     
                                <span class="menu-arrow"></span>                           
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="/listado-de-materias">Listado de Materias</a></li>
                                <li><a href="/listado-de-inscripciones">Listado de Inscripciones</a></li>
                                <li><a href="/listado-de-notas-por-materia">Listado de Notas por Materia</a></li>
                                <li><a href="/registro-academico-estudiante">Registro Académico por Estudiante</a></li>                                
                            </ul>
                        </li>                        

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ion ion-md-contacts"></i>
                                <span> Usuarios </span>  
                                <span class="menu-arrow"></span>                              
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">                                
                                <li><a href="/usuarios">Listado de Usuarios</a></li>                                
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="ion ion-md-build"></i>
                                <span> Configuración </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="/periodos">Períodos</a></li>
                                <li><a href="/ciclos">Ciclos</a></li>                                
                                <li><a href="/materias">Materias</a></li>                              
                            </ul>
                        </li>

                        
                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ Env('APP_NAME') }}</h4>
                                @yield('breadcrumb')
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @yield('content')

                </div>
                <!-- end container-fluid -->

            </div>
            <!-- end content -->



            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2022 &copy; {{ env('APP_NAME') }}
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->



    <!-- Vendor js -->
    <script src="{{ URL::asset('js/vendor.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script src="{{ URL::asset('libs/jquery-scrollto/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ URL::asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('libs/switchery/switchery.min.js') }}"></script>
    <script src="{{ URL::asset('libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('libs/moment/moment.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('js/app.min.js') }}"></script>

    @yield('custom-scripts')

</body>

</html>