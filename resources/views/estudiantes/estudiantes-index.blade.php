@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item active">Estudiantes</li>
    </ol>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    ESTUDIANTES
                </h4>

                <div class="text-right mb-4">
                    <button class="btn btn-sm btn-primary waves-effect waves-light text-white" id="add-category" data-title='Nuevo' data-action='new' data-toggle='modal' data-target='#FormEditModal'>
                        <i class="fas fa-plus"></i>
                        <span>Agregar Nuevo</span>
                    </button>
                </div>

                <table class="table table-hover dt-responsive nowrap" id="estudiantes-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Código</th>
                            <th>Primer Nombre</th>
                            <th>Segundo Nombre</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Apellido Casada</th>
                            <th>DUI</th>
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
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white text-uppercase componentTypeModalTitle" id="_modalWindow">Nuevo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="estudiantes-form" method="post">

                    <input type="hidden" name="id" id="id">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="primer_nombre" class="col-form-label">Primer Nombre</label>
                            <input type="text" name="primer_nombre" id="primer_nombre" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="segundo_nombre" class="col-form-label">Segundo Nombre</label>
                            <input type="text" name="segundo_nombre" id="segundo_nombre" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="primer_apellido" class="col-form-label">Primer Apellido</label>
                            <input type="text" name="primer_apellido" id="primer_apellido" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="segundo_apellido" class="col-form-label">Segundo Apellido</label>
                            <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="apellido_casada" class="col-form-label">Apellido Casada</label>
                            <input type="text" name="apellido_casada" id="apellido_casada" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="dui" class="col-form-label">DUI</label>
                            <input type="text" name="dui" id="dui" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="fecha_nacimiento" class="col-form-label">Fecha Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="mt-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genero_m" name="genero" class="custom-control-input" value="M" checked>
                                    <label class="custom-control-label text-xs" for="genero_m">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genero_f" name="genero" class="custom-control-input" value="F">
                                    <label class="custom-control-label text-xs" for="genero_f">Femenino</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="estado_civil_id" class="col-form-label">Estado Civil</label>
                            <select name="estado_civil_id" id="estado_civil_id" class="form-control form-control-sm" required>
                                <option value="1">Soltero(a)</option>
                                <option value="2">Casado(a)</option>
                            </select>
                        </div>
                    </div>

                    <h6>Domicilio</h6>
                    <hr />

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="direccion_domicilio" class="col-form-label">Dirección</label>
                            <textarea rows="2" name="direccion_domicilio" id="direccion_domicilio" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="ciudad" class="col-form-label">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="departamento" class="col-form-label">Departamento</label>
                            <input type="text" name="departamento" id="departamento" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="telefono" class="col-form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="celular" class="col-form-label">Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="correo" class="col-form-label">Correo</label>
                            <input type="text" name="correo" id="correo" class="form-control form-control-sm">
                        </div>
                    </div>

                    <h6>Información del Conyugue</h6>
                    <hr />

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nombre_conyugue" class="col-form-label">Nombre</label>
                            <input type="text" name="nombre_conyugue" id="nombre_conyugue" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="direccion_conyugue" class="col-form-label">Dirección</label>
                            <textarea rows="3" name="direccion_conyugue" id="direccion_conyugue" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="ocupacion_conyugue" class="col-form-label">Ocupación</label>
                            <input type="text" name="ocupacion_conyugue" id="ocupacion_conyugue" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="edad_conyugue" class="col-form-label">Edad</label>
                            <input type="text" name="edad_conyugue" id="edad_conyugue" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="telefono_conyugue" class="col-form-label">Telefóno</label>
                            <input type="text" name="telefono_conyugue" id="telefono_conyugue" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-3">
                            <div class="mt-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="conyugue_es_creyente" name="conyugue_es_creyente" value="1">
                                    <label class="custom-control-label text-xs" for="conyugue_es_creyente">Es Creyente</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="cantidad_hijos" class="col-form-label">Cant. Hijos</label>
                            <input type="text" name="cantidad_hijos" id="cantidad_hijos" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cantidad_hijas" class="col-form-label">Cant. Hijas</label>
                            <input type="text" name="cantidad_hijas" id="cantidad_hijas" class="form-control form-control-sm">
                        </div>
                    </div>

                    <h6>Información Adicional</h6>
                    <hr />

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="ultimo_grado_estudio" class="col-form-label">Ult. Grado de Estudios</label>
                            <input type="text" name="ultimo_grado_estudio" id="ultimo_grado_estudio" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="institucion_estudio" class="col-form-label">Institución de Estudio</label>
                            <input type="text" name="institucion_estudio" id="institucion_estudio" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-2">
                            <div class="mt-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="es_graduado" name="es_graduado" value="1">
                                    <label class="custom-control-label text-xs" for="es_graduado">Es Graduado</label>
                                </div>
                            </div>
                        </div>
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



@endsection



@section('custom-scripts')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        var dataTable = $('#estudiantes-table').DataTable({
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
                url: "/estudiantes/get-all",
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
                    data: 'primer_nombre',
                    orderable: false
                },
                {
                    data: 'segundo_nombre',
                    orderable: false
                },
                {
                    data: 'primer_apellido',
                    orderable: false
                },
                {
                    data: 'segundo_apellido',
                    orderable: false
                },
                {
                    data: 'apellido_casada',
                    orderable: false
                },
                {
                    data: 'dui',
                    orderable: false
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, full, meta) {

                        if (type === 'display') {
                            var jsonData = JSON.stringify(data);

                            let button = `
                                <button class="btn btn-sm btn-primary waves-effect waves-light text-white edit-category" data-row='${jsonData}' data-title='Editar' data-action='edit' data-toggle='modal' data-target='#FormEditModal'>
                                    <i class="far fa-edit"></i>
                                    <span class='pl-1'>Editar</span>
                                </button>
                                <!--<a href="/ciclos/detalle" class="btn btn-sm btn-success waves-effect waves-light text-white" data-row='${jsonData}'>
                                    <i class="far fa-file"></i>
                                    <span class='pl-1'>Materias</span>
                                </a>-->`;

                            if (data.admision_aprobada == 'NO') {
                                button += `
                                <button class="btn btn-sm btn-success waves-effect waves-light text-white generar-solicitud" data-row='${jsonData}'>
                                    <i class="far fa-address-card"></i>
                                    <span class='pl-1'>Generar Solicitud</span>
                                </button>
                                `;
                            }

                            return button;
                        } else {
                            return data;
                        }

                    }
                }
            ]
        });


        let form = $('#estudiantes-form');
        let actionType = '';


        $('#FormEditModal').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);

            actionType = button.data('action');

            form.trigger("reset");
            form.parsley().reset();

            $('#id').val("");
            $('#primer_nombre').val("");
            $('#segundo_nombre').val("");
            $('#primer_apellido').val("");
            $('#segundo_apellido').val("");
            $('#apellido_casada').val("");
            $('#dui').val("");
            $('#fecha_nacimiento').val("");
            $('#genero').val("");
            $('#estado_civil_id').val("");
            $('#direccion_domicilio').val("");
            $('#ciudad').val("");
            $('#departamento').val("");
            $('#telefono').val("");
            $('#celular').val("");
            $('#correo').val("");
            $('#nombre_conyugue').val("");
            $('#direccion_conyugue').val("");
            $('#ocupacion_conyugue').val("");
            $('#edad_conyugue').val("");
            $('#conyugue_es_creyente').prop('checked', false);
            $('#telefono_conyugue').val("");
            $('#cantidad_hijos').val("");
            $('#cantidad_hijas').val("");
            $('#ultimo_grado_estudio').val("");
            $('#es_graduado').prop('checked', false);
            $('#institucion_estudio').val("");

            if (actionType == "edit") {

                var dataRecord = button.data('row');

                $('#id').val(dataRecord.id);
                $('#primer_nombre').val(dataRecord.primer_nombre);
                $('#segundo_nombre').val(dataRecord.segundo_nombre);
                $('#primer_apellido').val(dataRecord.primer_apellido);
                $('#segundo_apellido').val(dataRecord.segundo_apellido);
                $('#apellido_casada').val(dataRecord.apellido_casada);
                $('#dui').val(dataRecord.dui);
                $('#fecha_nacimiento').val(moment(dataRecord.fecha_nacimiento).format('YYYY-MM-DD'));
                $("input[name=genero][value=" + dataRecord.genero + "]").attr('checked', 'checked');
                $('#estado_civil_id').val(dataRecord.estado_civil_id);
                $('#direccion_domicilio').val(dataRecord.direccion_domicilio);
                $('#ciudad').val(dataRecord.ciudad);
                $('#departamento').val(dataRecord.departamento);
                $('#telefono').val(dataRecord.telefono);
                $('#celular').val(dataRecord.celular);
                $('#correo').val(dataRecord.correo);
                $('#nombre_conyugue').val(dataRecord.nombre_conyugue);
                $('#direccion_conyugue').val(dataRecord.direccion_conyugue);
                $('#ocupacion_conyugue').val(dataRecord.ocupacion_conyugue);
                $('#edad_conyugue').val(dataRecord.edad_conyugue);
                $('#conyugue_es_creyente').prop('checked', dataRecord.conyugue_es_creyente == '1');
                $('#telefono_conyugue').val(dataRecord.telefono_conyugue);
                $('#cantidad_hijos').val(dataRecord.cantidad_hijos);
                $('#cantidad_hijas').val(dataRecord.cantidad_hijas);
                $('#ultimo_grado_estudio').val(dataRecord.ultimo_grado_estudio);
                $('#es_graduado').prop('checked', dataRecord.es_graduado == '1');
                $('#institucion_estudio').val(dataRecord.institucion_estudio);

            }


            var modal = $(this);
            modal.find('.modal-title').text(button.data('title'));

        });


        $('#saveChanges').on('click', async function() {


            if (!form.parsley().validate()) return;

            var dataForm = $('#estudiantes-form').serialize();
            var urlTarget = '/estudiantes/create';

            if (actionType == 'edit') {
                urlTarget = '/estudiantes/update';
            }

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


        $(document).on('click', '.generar-solicitud', function() {
            let datos = $(this).data('row');

            Swal.fire({
                title: 'Advertencia',
                text: "¿Esta seguro(a) de generar la solicitud de admisión para el estudiante seleccionado?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                            method: "POST",
                            url: `/estudiantes/${datos.id}/generar-solicitud-admision`,
                            data: {},
                            dataType: 'json'
                        })
                        .done(function(result) {

                            dataTable.ajax.reload();

                            toastr.success(result.message, null, {
                                "closeButton": true
                            });

                            dataTable.reload();

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

                }
            })

        });

    });
</script>

@endsection