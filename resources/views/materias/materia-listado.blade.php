@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item"><a href="/#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/materias">Materias</a></li>
        <li class="breadcrumb-item active">Listado de Materias</li>
    </ol>
</div>
@endsection



@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    MATERIAS DEL PENSUM SEBBES
                </h4>

                <div class="text-right mb-4 d-print-none">
                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                </div>

                @php $fila = 1; @endphp
                @php $ciclo = ''; @endphp
                <table class="table table-hover dt-responsive nowrap" id="materias-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materias as $materia)
                        @if($materia->ciclo != $ciclo)
                        @php $ciclo = $materia->ciclo; @endphp
                        <tr>
                            <td colspan="3" class="table-success">
                                <strong>{{ $materia->ciclo }}</strong>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td>
                                {{ $fila }}
                            </td>
                            <td>
                                {{ $materia->materia }}
                            </td>
                            <td>
                                {{ $materia->descripcion }}
                            </td>
                        </tr>
                        @php $fila++; @endphp
                        @endif                       
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