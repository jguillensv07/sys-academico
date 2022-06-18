<form id="notas-form">

    <input type="hidden" name="periodo_id" value="{{ $periodo->id }}">
    <input type="hidden" name="ciclo_id" value="{{ $ciclo->id }}">
    <input type="hidden" name="materia_id" value="{{ $materia->id }}">

    <table class="table table-hover dt-responsive nowrap" id="estudiantes-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Fecha:______________</th>
                <th>Fecha:______________</th>
                <th>Fecha:______________</th>
                <th>Fecha:______________</th>
            </tr>
        </thead>
        <tbody>
            @php $fila = 1 @endphp
            @foreach($estudiantes as $estudiante)
            <tr>
                <td>{{ $fila }}</td>
                <td>{{ $estudiante->codigo }}</td>
                <td>{{ $estudiante->primer_apellido }} {{ $estudiante->segundo_apellido }} {{ $estudiante->primer_nombre }} {{ $estudiante->segundo_nombre }}</td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            @php $fila++; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="button-list float-right d-print-none">
        @csrf
        <a href="/hojas-de-asistencia" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</a>
        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1">
            <i class="fa fa-print mr-1"></i>
            <span>Imprimir</span>
        </a>
    </div>

</form>