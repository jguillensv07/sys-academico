<div class="row">
    <div class="col-md-12">
        <h4 class="card-title">
            MATERIAS DEL CICLO
        </h4>

        <div>
            <strong>Período: </strong>
            {{ $periodoCicloDetalle->periodo->anio }}
        </div>

        <div class="mb-4">
            <strong>Ciclo: </strong>
            {{ $periodoCicloDetalle->ciclo->nombre }}
        </div>

        <form id="aperturaCicloForm">

        <input type="hidden" name="periodo_id" value="{{ $periodoCicloDetalle->periodo_id }}">
        <input type="hidden" name="ciclo_id" value="{{ $periodoCicloDetalle->ciclo_id }}">

            <table class="table table-hover dt-responsive nowrap" id="periodos-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Materia</th>
                        <th>Docente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periodoCicloDetalleMateria as $itemMateria)
                    <tr>
                        <td>
                            {{ $itemMateria->materia->nombre }}
                            <input type="hidden" name="detale_materia[]" value="{{ $itemMateria->id }}">
                        </td>
                        <td>
                            <select name="docente[]" class="form-control">
                            @foreach($docentes as $docente)                            
                                <option value="{{ $docente->id }}">{{ $docente->name }}</option>                            
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @csrf
            <div class="button-list float-right">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="btnAperturarCiclo">Aperturar Ciclo</button>
            </div>
        </form>
    </div>
</div>