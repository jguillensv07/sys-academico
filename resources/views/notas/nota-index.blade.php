@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item active">Colector de Notas</li>
    </ol>
</div>
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    COLECTOR DE NOTAS
                </h4>

                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-condensed table-borderless mb-4">

                            <tbody>
                                <tr>
                                    <th scope="row">Período</th>
                                    <td>
                                        <a href="javascript:void(0);" class="ng-binding">
                                            {{ $periodo->anio }}
                                            <input type="hidden" id="periodo_id" value="{{ $periodo->id }}">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Ciclo</th>
                                    <td>
                                        <a href="javascript:void(0);" class="ng-binding">
                                            {{ $ciclo->nombre }}
                                            <input type="hidden" id="ciclo_id" value="{{ $ciclo->id }}">
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Materia</th>
                                    <td>
                                        <select name="materia" id="materia" class="form-control">
                                            @foreach($periodoDetalleCicloMaterias as $itemMateria)
                                            <option value="{{ $itemMateria->materia->id }}">{{ $itemMateria->materia->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Computo</th>
                                    <td>
                                        <select name="computo" id="computo" class="form-control">
                                            <option value="1">Computo 1</option>
                                            <option value="2">Computo 2</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <button type="button" class="btn btn-primary btn-block waves-effect waves-light" id="btnCargarListado">Cargar Listado</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="listado-table">
                    <table class="table table-hover dt-responsive nowrap" id="estudiantes-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Código</th>
                                <th rowspan="2">Nombre</th>
                                <th colspan="2">Computo 1</th>
                                <th colspan="2">Computo 2</th>
                                <th rowspan="2">Nota Final</th>
                            </tr>
                            <tr>
                                <th>Nota 1</th>
                                <th>Nota 2</th>
                                <th>Nota 1</th>
                                <th>Nota 2</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

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

        $('#btnCargarListado').click(function() {

            let periodo = $('#periodo_id').val();
            let ciclo = $('#ciclo_id').val();
            let materia = $('#materia').val();

            $.ajax({
                    method: "GET",
                    url: `/colector-de-notas/listar-estudiantes`,
                    data: {periodo_id: periodo, ciclo_id: ciclo, materia_id: materia},                    
                })
                .done(function(result) {

                    $('#listado-table').html(result);

                })
                .fail(function(xhr, status, error) {

                    if (xhr.status == 422) {
                        toastr.error("Hay valores que no son v&aacute;lidos", null, {
                            "closeButton": true
                        });
                    } else {
                        toastr.error("Hubo un problema interno al registrar la informaci&oacute;n", null, {
                            "closeButton": true
                        });
                    }

                });

        });

    });
</script>

@endsection