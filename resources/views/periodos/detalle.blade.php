@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/periodos">Períodos</a></li>
        <li class="breadcrumb-item active">Período Detalle</li>
    </ol>
</div>
@endsection



@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    PERIODO DETALLE
                </h4>

                <div>
                    <strong>Período: </strong>
                    {{ $periodo->anio }}
                </div>

                <div class="text-right mb-4">
                    <button class="btn btn-sm btn-primary waves-effect waves-light text-white" id="add-category" data-title='Nuevo' data-action='new' data-toggle='modal' data-target='#FormEditModal'>
                        <i class="fas fa-plus"></i>
                        <span>Agregar Nuevo</span>
                    </button>
                </div>

                <table class="table table-hover dt-responsive nowrap" id="periodos-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ciclo</th>
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
                <form id="periodos-form" method="post">

                    <div class="form-group">
                        <label for="ciclo_id">Ciclo:</label>
                        <select name="ciclo_id" id="ciclo_id" class="form-control" required>
                            @foreach($ciclos as $ciclo)
                            <option value="{{ $ciclo->id }}">{{ $ciclo->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="periodo_id" name="periodo_id" value="{{ $periodo->id }}" />
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                @csrf
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="saveChanges">Guardar</button>
            </div>
        </div>

    </div>
</div>



<div class="modal fade" id="aperturarCicloModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="_modalWindow" style="display:none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white text-uppercase componentTypeModalTitle" id="_modalWindow">Apertura de Ciclo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="aperturarCicloContainer"></div>
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

        var periodo_id = $('#periodo_id').val();

        var dataTable = $('#periodos-table').DataTable({
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
                url: `/periodos/${periodo_id}/detalle/get-all`,
                type: "GET",
                contentType: "application/json",
                dataType: "json"
            },
            // Columns Setups
            columns: [{
                    data: 'ciclo.nombre',
                    orderable: false
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, full, meta) {

                        if (type === 'display') {
                            var jsonData = JSON.stringify(data);

                            if (data.estado == 'NO APERTURADO') {
                                return `
                                    <span class="badge badge-warning">NO APERTURADO</span>
                                `;
                            } else if (data.estado == 'CERRADO') {
                                return `
                                    <span class="badge badge-danger">CERRADO</span>
                                `;
                            } else {
                                return `
                                    <span class="badge badge-info">APERTURADO</span>
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

                            if (data.estado == "NO APERTURADO") {
                                return `
                                <button class="btn btn-sm btn-info waves-effect waves-light text-white cambiar-estado-aperturar" data-row='${jsonData}' data-estado='APERTURAR'>
                                    <i class="far fa-edit"></i>
                                    <span class='pl-1'>Aperturar</span>
                                </button>`;
                            } else if (data.estado == "APERTURADO") {
                                return `
                                <button class="btn btn-sm btn-danger waves-effect waves-light text-white edit-estado" data-row='${jsonData}' data-estado='CERRAR'>
                                    <i class="far fa-edit"></i>
                                    <span class='pl-1'>Cerrar</span>
                                </button>`;
                            } else {
                                return ``;
                            }

                        } else {
                            return data;
                        }

                    }
                }
            ]
        });



        let form = $('#periodos-form');


        $('#saveChanges').on('click', async function() {


            if (!form.parsley().validate()) return;

            var dataForm = $('#periodos-form').serialize();
            var urlTarget = `/periodos/${periodo_id}/detalle/agregar-ciclo`;

            $.ajax({
                    method: "POST",
                    url: urlTarget,
                    data: dataForm,
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

        $(document).on('click', '.cambiar-estado-aperturar', function() {
            var btn = $(this);
            var data = btn.data('row');

            $('#aperturarCicloContainer').html('Cargado...');

            $.ajax({
                    method: "GET",
                    url: `/periodos/${periodo_id}/detalle/aperturar-ciclo-partial`,
                    data: {
                        periodo_ciclo_detalle_id: data.id
                    }
                })
                .done(function(result) {

                    $('#aperturarCicloContainer').html(result);
                    $('#aperturarCicloModal').modal('show');
                })
                .fail(function(xhr, status, error) {
                    console.log(xhr.status);
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


        $(document).on('click', '#btnAperturarCiclo', function() {

            var dataForm = $('#aperturaCicloForm').serialize();
            var urlTarget = `/periodos/${periodo_id}/detalle/aperturar-ciclo-partial`;

            $.ajax({
                    method: "POST",
                    url: urlTarget,
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

                    dataTable.ajax.reload();

                    toastr.success(result.message, null, {
                        "closeButton": true
                    });

                    $('#aperturarCicloModal').modal('hide');
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