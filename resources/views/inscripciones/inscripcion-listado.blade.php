@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/inscripciones">Inscripciones</a></li>
        <li class="breadcrumb-item active">Listado de Inscripciones</li>
    </ol>
</div>
@endsection



@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    LISTADO DE INSCRIPCIONES
                </h4>

                <div class="row mb-4 ">
                    <div class="col-md-12">
                        <form class="form-inline" method="get">
                            <div class="form-group mr-3">
                                <label for="periodo" class="sr-only">Período</label>
                                <select class="form-control" id="periodo" name="periodo">
                                    @foreach($periodos as $itemPeriodo)
                                    <option value="{{ $itemPeriodo->id }}" {{ ($itemPeriodo->id == $periodo) ? 'selected' : '' }} >{{ $itemPeriodo->anio }}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <button type="submit" class="btn btn-primary">Consultar</button>
                        </form>
                    </div>

                </div>

                <div class="text-right mb-4 d-print-none">
                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                </div>
                
                @php $fila = 1; @endphp                
                <table class="table table-hover dt-responsive nowrap" id="materias-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Número de Inscripción</th>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Estudiante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscripciones as $inscripcion)
                        <tr>
                            <td>
                                {{ $fila }}
                            </td>
                            <td>
                                {{ $inscripcion->NumeroInscripcion }}
                            </td>
                            <td>
                                {{ date_format($inscripcion->fecha, 'd/m/Y') }}
                            </td>
                            <td>
                                {{ $inscripcion->estudiante->codigo }}
                            </td>
                            <td>
                                {{ $inscripcion->estudiante->NombreCompleto }}
                            </td>
                        </tr>
                        
                        @php $fila++; @endphp                        
                        @endforeach
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
</script>

@endsection