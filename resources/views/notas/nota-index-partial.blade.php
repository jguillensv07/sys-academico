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
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota Final</th>
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
                    <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_1_computo_1 }}" class="form-control form-control-sm notas" name="nota_1_computo_1_{{ $estudiante->estudiante_id }}" id="nota_1_computo_1_{{ $estudiante->estudiante_id }}" data-line='{{ $estudiante->estudiante_id }}'>
                </td>
                <td>
                    <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_2_computo_1 }}" class="form-control form-control-sm notas" name="nota_2_computo_1_{{ $estudiante->estudiante_id }}" id="nota_2_computo_1_{{ $estudiante->estudiante_id }}" data-line='{{ $estudiante->estudiante_id }}'>
                </td>
                <td>
                    <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_1_computo_2 }}" class="form-control form-control-sm notas" name="nota_1_computo_2_{{ $estudiante->estudiante_id }}" id="nota_1_computo_2_{{ $estudiante->estudiante_id }}" data-line='{{ $estudiante->estudiante_id }}'>
                </td>
                <td>
                    <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_2_computo_2 }}" class="form-control form-control-sm notas" name="nota_2_computo_2_{{ $estudiante->estudiante_id }}" id="nota_2_computo_2_{{ $estudiante->estudiante_id }}" data-line='{{ $estudiante->estudiante_id }}'>
                </td>
                <td>
                    <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_final }}" class="form-control form-control-sm notas" readonly name="nota_final_{{ $estudiante->estudiante_id }}" id="nota_final_{{ $estudiante->estudiante_id }}" data-line='{{ $estudiante->estudiante_id }}'>
                </td>
            </tr>
            @php $fila++; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="button-list float-right d-print-none">
        @csrf
        <a href="/colector-de-notas" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</a>
        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
        <button type="button" class="btn btn-primary waves-effect waves-light" id="saveChanges">Guardar</button>
    </div>

</form>