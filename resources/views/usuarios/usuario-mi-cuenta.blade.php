@extends('layouts.main')

@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item active">Mi Cuenta</li>
    </ol>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">
                    MI CUENTA
                </h4>

                <div class="row">

                    <div class="col-md-2">

                        <div class="text-center">                            
                            <img src="{{ URL::asset('images/users/profile.png') }}" class="rounded-circle my-auto" height="128" />                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h5>Información Personal</h5>

                        <table class="table table-condensed table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Nombre
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Email
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">
                    CAMBIAR CONTRASEÑA
                </h4>

                <div class="row">
                    <div class="col-md-4">

                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Error</strong> {{ Session::get('error') }}
                        </div>
                        @endif

                        @if(Session::has('user-password-changed-ok'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>INFORME</strong> Tu clave ha sido actualizada satisfactoriamente.
                        </div>
                        @endif

                        <form id="user-change-password-form" method="POST" action="{{ route('user.change-password') }}">
                            <div class="form-group">
                                <label for="old_password">Clave Actual</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" required />
                            </div>

                            <div class="form-group">
                                <label for="new_password">Nuev Clave</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required />
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirmar Clave</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required data-parsley-equalto="#new_password" />
                            </div>

                            <div class="float-right">
                                @csrf
                                <button type="submit" class="btn btn-primary">Cambiar Clave</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection


@section('custom-scripts')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        var form = $('#user-change-password-form');

        $('#user-change-password-form').submit(function(event) {

            if (!form.parsley().validate()) {
                event.preventDefault();
                return false;
            }

        });

    });
</script>

@endsection