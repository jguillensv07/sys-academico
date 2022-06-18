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

<body class="authentication-page">

    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-header text-center p-4 bg-primary">
                            <h4 class="text-white mb-0 mt-0">
                                SEBBES
                            </h4>
                            <h5 class="text-white font-13 mb-0">
                                INICIAR SESIÓN
                            </h5>
                        </div>

                        <div class="card-body">

                            @if($errors->has('access-denied'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Acceso Denegado</strong> Usuario no tiene acceso a éste sitio.
                            </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="email">
                                        {{ __('Correo Electrónico') }}
                                    </label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">
                                        {{ __('Contraseña') }}                                        
                                    </label>

                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Ingresar') }}
                                        </button>

                                        <!--<a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('¿Olvide mi contraseña?') }}
                                        </a>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ URL::asset('js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('js/app.min.js') }}"></script>

</body>

</html>