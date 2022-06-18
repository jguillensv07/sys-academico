<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Somehuck - Panel de Clientes" name="description" />
    <meta content="JGuillen" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SEBBES - Sistema de Control Academico</title>

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
    <link href="{{ URL::asset('libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="{{ URL::asset('css/site.css') }}" rel="stylesheet" type="text/css" id="app-site-stylesheet" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-12 p-0 text-dark">
                <div class="full-height p-4">
                    <div>
                        <img src="{{ URL::asset('images/site/somehuck_logo1.png') }}" width="48px" class="d-inline" />
                        <h1 class="d-inline ml-3 align-bottom">SEBBES</h1>
                    </div>

                    <div class="mt-5">
                        <h3 class="m-0">Iniciar Sesión</h3>
                        <span class="text-mute">
                            Ingresa tu correo electrónico y contraseña para acceder a tu cuenta.
                        </span>
                    </div>

                    @if($errors->has('access-denied'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Acceso Denegado</strong> Usuario no tiene acceso a éste sitio.
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="my-3">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">

                            @if (Route::has('password.request'))
                            <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                {{ __('¿Olvidastes tu contraseña?') }}
                            </a>
                            @endif

                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-danger btn-block">
                                {{ __('Ingresar') }}
                            </button>
                        </div>


                    </form>


                    <div class="text-center my-5">
                        ¿No tienes una cuenta?
                        <a class="btn btn-link text-danger" href="/register-account">
                            {{ __('Registra tu tienda') }}
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-md-8 d-none d-md-block p-0">
                <div class="full-height">
                    <div class="login-bg d-flex flex-column">
                        <div class="text-center mt-auto mb-2" style="background-color: rgb(0,0,0,0.5);">
                            <h1 class="text-white mx-4"> Únete a <strong class="text-danger">somehuck</strong> y comienza a disfrutar de todos los servicios que tenemos especialmente para ti.</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>



    <!-- Vendor js -->
    <script src="{{ URL::asset('js/vendor.min.js') }}"></script>

    <!--<script src="{{ URL::asset('libs/moment/moment.min.js') }}"></script>-->
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

    <!-- Peity chart-->
    <script src="{{ URL::asset('libs/peity/jquery.peity.min.js') }}"></script>

    <!-- jquery.easypiechart -->
    <script src="{{ URL::asset('libs/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('js/app.min.js') }}"></script>

    <script>
        moment.locale('es');
    </script>

    @yield('js')

</body>

</html>