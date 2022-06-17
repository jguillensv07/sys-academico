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
                <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_1_computo_1 }}" class="form-control form-control-sm" >
            </td>
            <td>
                <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_2_computo_1 }}" class="form-control form-control-sm" >
            </td>
            <td>
                <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_1_computo_2 }}" class="form-control form-control-sm" >
            </td>
            <td>
                <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_2_computo_2 }}" class="form-control form-control-sm" >
            </td>
            <td>
                <input type="number" step="0.01" min="0" max="10" value="{{ $estudiante->nota_final }}" class="form-control form-control-sm" readonly >
            </td>
        </tr>
        @php $fila++; @endphp
        @endforeach
    </tbody>
</table>