@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
</div>
@endsection



@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    USUARIOS
                </h4>

                <div class="text-right mb-4">
                    <button class="btn btn-sm btn-primary waves-effect waves-light text-white" id="add-category" data-title='Nuevo' data-action='new' data-toggle='modal' data-target='#FormEditModal'>
                        <i class="fas fa-plus"></i>
                        <span>Agregar Nuevo</span>
                    </button>
                </div>

                <table class="table table-hover dt-responsive nowrap" id="usuarios-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
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
                <form id="usuario-form" method="post">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <input type="hidden" name="id" id="id">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="mail" name="email" id="email" class="form-control" required>                        
                    </div>

                    <div class="form-group">
                        <label for="role">Rol</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                            <option value="DOCENTE">DOCENTE</option>
                            <option value="DOCENTE">ADMINISTRATIVO</option>
                        </select>
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

        var dataTable = $('#usuarios-table').DataTable({
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
                url: "/usuarios/get-all",
                type: "GET",
                contentType: "application/json",
                dataType: "json"
            },
            // Columns Setups
            columns: [
                {
                    data: 'name',
                    orderable: false
                },
                {
                    data: 'email',
                    orderable: false
                },
                {
                    data: 'role',
                    orderable: false
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, full, meta) {

                        if (type === 'display') {
                            var jsonData = JSON.stringify(data);

                            return `
                                <button class="btn btn-sm btn-primary waves-effect waves-light text-white edit-category" data-row='${jsonData}' data-title='Editar' data-action='edit' data-toggle='modal' data-target='#FormEditModal'>
                                    <i class="far fa-edit"></i>
                                    <!--<span class='pl-1'>Editar</span>-->
                                </button>`;
                        } else {
                            return data;
                        }

                    }
                }
            ]
        });


        let form = $('#usuario-form');
        let actionType = '';


        $('#FormEditModal').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);

            actionType = button.data('action');

            form.trigger("reset");
            form.parsley().reset();

            $('#id').val("");
            $('#name').val("");
            $('#email').val("");
            $('#rol').val("");

            if (actionType == "edit") {

                var dataRecord = button.data('row');

                $('#id').val(dataRecord.id);
                $('#name').val(dataRecord.name);
                $('#email').val(dataRecord.email);
                $('#rol').val(dataRecord.rol);
            }


            var modal = $(this);
            modal.find('.modal-title').text(button.data('title'));

        });


        $('#saveChanges').on('click', async function() {

           
            if (!form.parsley().validate()) return;

            var dataForm = $('#usuario-form').serialize();
            var urlTarget = '/usuarios/create';
            
            if(actionType == 'edit')
            {
                urlTarget = '/usuarios/update';
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

    });
</script>

@endsection