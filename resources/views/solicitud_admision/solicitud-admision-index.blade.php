@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item active">Solicitudes de Admisión</li>
    </ol>
</div>
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    SOLICITUDES DE ADMISION
                </h4>

                <!--<div class="text-right mb-4">
                    <a href="solicitud-de-admision/nuevo" class="btn btn-sm btn-primary waves-effect waves-light text-white" id="add-category" data-title='Nuevo' data-action='new' data-toggle='modal' data-target='#FormEditModal'>
                        <i class="fas fa-plus"></i>
                        <span>Agregar Nuevo</span>
                    </a>
                </div>-->

                <table class="table table-hover dt-responsive nowrap" id="solicitudes-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Número de Solicitud</th>
                            <th>Fecha de Solicitud</th>
                            <th>Código del Estudiante</th>
                            <th>Nombre del Estudiante</th>
                            <th>Estado</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="FormEditModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="_modalWindow" style="display:none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white text-uppercase componentTypeModalTitle" id="_modalWindow">Nuevo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="solicitudes-form" method="post">

                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="numero_solicitud" class="col-form-label">Número de Solicitud</label>
                        <input type="text" name="numero_solicitud" id="numero_solicitud" class="form-control form-control-sm" disabled>
                    </div>

                    <div class="form-group">
                        <label for="fecha_solicitud" class="col-form-label">Fecha de Solicitud</label>
                        <input type="date" name="fecha_solicitud" id="fecha_solicitud" class="form-control form-control-sm" disabled>
                    </div>

                    <div class="form-group">
                        <label for="codigo_estudiante" class="col-form-label">Código del Estudiante</label>
                        <input type="text" name="codigo_estudiante" id="codigo_estudiante" class="form-control form-control-sm" disabled>
                    </div>

                    <div class="form-group">
                        <label for="nombre_estudiante" class="col-form-label">Nombre del Estudiante</label>
                        <input type="text" name="nombre_estudiante" id="nombre_estudiante" class="form-control form-control-sm" disabled>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                @csrf
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" id="denegarSolicitud">Denegar</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="aprobarSolicitud">Aprobar</button>
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

        var dataTable = $('#solicitudes-table').DataTable({
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
                url: "/solicitudes-de-admision/get-all",
                type: "GET",
                contentType: "application/json",
                dataType: "json"
            },
            // Columns Setups
            columns: [{
                    data: 'numero_solicitud',
                    orderable: false
                },
                {
                    data: 'fecha_solicitud',
                    orderable: false
                },
                {
                    data: 'codigo_estudiante',
                    orderable: false
                },
                {
                    data: 'nombre_estudiante',
                    orderable: false
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, full, meta) {

                        if (type === 'display') {
                            var jsonData = JSON.stringify(data);

                            if (data.aprobada == 'PE') {
                                return `
                                    <span class="badge badge-warning">PENDIENTE</span>
                                `;
                            } else if (data.aprobada == 'NO') {
                                return `
                                    <span class="badge badge-danger">DENEGADA</span>
                                `;
                            } else {
                                return `
                                    <span class="badge badge-info">APROBADA</span>
                                `;
                            }
                        } else {
                            return data;
                        }

                    }
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, full, meta) {

                        if (type === 'display') {
                            var jsonData = JSON.stringify(data);

                            if (data.aprobada == 'PE') {
                                return `
                                <button class="btn btn-sm btn-primary waves-effect waves-light text-white edit-category" data-row='${jsonData}' data-title='Editar' data-action='edit' data-toggle='modal' data-target='#FormEditModal'>
                                    <i class="fas fa-check"></i>
                                    <span class='pl-1'>Aprobar</span>
                                </button>
                                `;
                            } else {
                                return '';
                            }
                        } else {
                            return data;
                        }

                    }
                }
            ]
        });

        let form = $('#solicitudes-form');

        $('#FormEditModal').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);

            actionType = button.data('action');

            form.trigger("reset");
            form.parsley().reset();

            $('#id').val("");
            $('#numero_solicitud').val("");
            $('#fecha_solicitud').val("");
            $('#codigo_estudiante').val("");
            $('#nombre_estudiante').val("");


            if (actionType == "edit") {

                var dataRecord = button.data('row');

                $('#id').val(dataRecord.id);
                $('#numero_solicitud').val(dataRecord.numero_solicitud);
                $('#fecha_solicitud').val(dataRecord.fecha_solicitud);
                $('#codigo_estudiante').val(dataRecord.codigo_estudiante);
                $('#nombre_estudiante').val(dataRecord.nombre_estudiante);

                //$('#fecha_nacimiento').val(moment(dataRecord.fecha_nacimiento).format('YYYY-MM-DD'));                

            }


            var modal = $(this);
            modal.find('.modal-title').text(button.data('title'));

        });


        $('#aprobarSolicitud').click(function() {

            $.ajax({
                    method: "POST",
                    url: `/solicitudes-de-admision/${$('#id').val()}/aprobar`,
                    data: {
                        aprobar: 'SI'
                    },
                    dataType: 'json'
                })
                .done(function(result) {

                    dataTable.ajax.reload();

                    toastr.success(result.message, null, {
                        "closeButton": true
                    });

                    $('#FormEditModal').modal('hide');
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


        $('#denegarSolicitud').click(function() {

            $.ajax({
                    method: "POST",
                    url: `/solicitudes-de-admision/${$('#id').val()}/denegar`,
                    data: {
                        aprobar: 'NO'
                    },
                    dataType: 'json'
                })
                .done(function(result) {

                    dataTable.ajax.reload();

                    toastr.success(result.message, null, {
                        "closeButton": true
                    });

                    $('#FormEditModal').modal('hide');
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