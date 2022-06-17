@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item active">Inscripciones</li>
    </ol>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    INSCRIPCIONES
                </h4>

                <div class="text-right mb-4">
                    <a href="/inscripciones/nuevo" class="btn btn-sm btn-primary waves-effect waves-light text-white">
                        <i class="fas fa-plus"></i>
                        <span>Agregar Nuevo</span>
                    </a>
                </div>

                <table class="table table-hover dt-responsive nowrap" id="estudiantes-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Numero de Inscripción</th>
                            <th>Fecha</th>
                            <th>Estudiante</th>
                            <th>Período</th>
                            <th>Ciclo</th>                            
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
                url: "/inscripciones/get-all",
                type: "GET",
                contentType: "application/json",
                dataType: "json"
            },
            // Columns Setups
            columns: [{
                    data: 'numero_inscripcion',
                    orderable: false
                },
                {
                    data: 'fecha',
                    orderable: false
                },
                {
                    data: 'estudiante',
                    orderable: false
                },
                {
                    data: 'periodo',
                    orderable: false
                },
                {
                    data: 'ciclo',
                    orderable: false
                },               
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, full, meta) {

                        if (type === 'display') {
                            var jsonData = JSON.stringify(data);

                            let button = `
                                <a href='/inscripciones/editar/${data.id}' class="btn btn-sm btn-primary waves-effect waves-light text-white edit-category" data-row='${jsonData}'>
                                    <i class="far fa-edit"></i>
                                    <span class='pl-1'>Ver</span>
                                </a>`;     

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