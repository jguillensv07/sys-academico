@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/inscripciones">Inscripciones</a></li>
        <li class="breadcrumb-item active">Consultar Inscripción</li>
    </ol>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    CONSULTAR INSCRIPCIÓN
                </h4>

                <div class="col-md-6 mx-auto">
                    <form method="post" id="incripcion-form">
                        <input type="hidden" name="estudiante_id" id="estudiante_id" value="{{ $inscripcion->id }}">

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="text" name="fecha" id="fecha" class="form-control" value="{{ date_format($inscripcion->fecha, 'd/m/Y') }}" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="periodo_id">Período</label>
                            <input type="text" name="periodo" id="periodo" class="form-control" value="{{ $inscripcion->periodo->anio }}" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="ciclo_id">Ciclo</label>
                            <input type="text" name="ciclo" id="ciclo" class="form-control" value="{{ $inscripcion->ciclo->nombre }}" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="estudiante">Estudiante</label>
                            <input type="text" class="form-control" name="estudiante" id="estudiante" value="{{ $inscripcion->estudiante->NombreCompleto }}" readonly required>
                        </div>

                        <table class="table table-hover dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        Inscrita
                                    </th>
                                    <th>
                                        Materia
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscripcion->detalle as $itemMateria)
                                <tr>
                                    <td>
                                        @if($itemMateria->estado == 'INSCRITA')
                                        <span class="badge badge-success">{{ $itemMateria->estado }}</span>
                                        @else
                                        <span class="badge badge-danger">{{ $itemMateria->estado }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $itemMateria->materia->nombre }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="button-list float-right">
                            @csrf
                            <a href="/inscripciones" class="btn btn-secondary waves-effect" data-dismiss="modal">Volver al Listado</a>                            
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="buscarEstudianteModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="_modalWindow" style="display:none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white text-uppercase componentTypeModalTitle" id="_modalWindow">Nuevo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <table class="table table-hover dt-responsive nowrap" id="incripciones-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; cursor: pointer;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombre Completo</th>
                            <th>DUI</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
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

        var dataTable = $('#incripciones-table').DataTable({
            // Design Assets
            stateSave: true,
            autoWidth: true,
            // ServerSide Setups
            processing: true,
            serverSide: true,
            // Paging Setups
            paging: true,
            // Searching Setups
            searching: {
                regex: true
            },
            // Ajax Filter
            ajax: {
                url: "/estudiantes/get-all-admision-aprobada",
                type: "GET",
                contentType: "application/json",
                dataType: "json"
            },
            // Columns Setups
            columns: [{
                    data: 'codigo',
                    orderable: false
                },
                {
                    data: 'nombre_completo',
                    orderable: false
                },
                {
                    data: 'dui',
                    orderable: false
                }
            ]
        });


        $("#incripciones-table tbody").on('click', 'tr', function() {
            var data = dataTable.row(this).data();

            $('#estudiante_id').val(data.id);
            $('#estudiante').val(data.nombre_completo);

            $('#buscarEstudianteModal').modal('hide');
        });


        let form = $('#incripcion-form');

        $('#saveChanges').on('click', async function() {


            if (!form.parsley().validate()) return;

            var dataForm = $('#incripcion-form').serialize();
            var urlTarget = '/incripciones/store';


            $.ajax({
                    method: "POST",
                    //url: urlTarget,
                    data: dataForm,
                    dataType: 'json'
                })
                .done(function(result) {

                    if (result.status == 'WARNING') {
                        toastr.warning(result.message, null, {
                            "closeButton": true
                        });
                        return;
                    }
                    location.replace('/inscripciones');

                })
                .fail(function(xhr, status, error) {

                    if (xhr.status == 422) {
                        toastr.error("Hay errores en los valores enviados.", null, {
                            "closeButton": true
                        });
                    } else {
                        toastr.error("Hubo un error interno, contacte a su Administrador de Sistemas.", null, {
                            "closeButton": true
                        });
                    }

                });

        });



    });
</script>

@endsection