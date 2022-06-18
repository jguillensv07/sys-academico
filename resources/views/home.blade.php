@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>
@endsection




@section('content')

<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body widget-style-2">
                <div class="media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0"><span data-plugin="counterup">{{ $periodo->anio }}</span></h2>
                        <p class="mb-0">Período Actual</p>
                    </div>
                    <i class="mdi mdi-bullhorn text-pink bg-light"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body widget-style-2">
                <div class="media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0"><span data-plugin="counterup1">{{ $ciclo->nombre }}</span></h2>
                        <p class="mb-0">Ciclo Actual</p>
                    </div>
                    <i class="mdi mdi-calendar-today text-purple bg-light"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body widget-style-2">
                <div class="media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0"><span data-plugin="counterup">{{ $periodoDetalleCicloMaterias->count() }}</span></h2>
                        <p class="mb-0">Materias</p>
                    </div>
                    <i class="mdi mdi-book text-info bg-light"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body widget-style-2">
                <div class="media">
                    <div class="media-body align-self-center">
                        <h2 class="my-0"><span data-plugin="counterup">{{ $estudiantesInscritos->count() }}</span></h2>
                        <p class="mb-0">Estudiantes Inscritos</p>
                    </div>
                    <i class="mdi mdi-account-multiple text-primary bg-light"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">

        <div class="card">
            <div class="card-header py-3 bg-transparent">                
                <h5 class="header-title mb-0"> Materias</h5>
            </div>
            <div id="cardCollpase4" class="collapse show">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Materia</th>
                                    <th>Docente</th>          
                                </tr>
                            </thead>
                            <tbody>
                                @php $fila = 1; @endphp
                                @foreach($periodoDetalleCicloMaterias as $itemMateria)
                                <tr>
                                    <td>{{ $fila }}</td>
                                    <td>{{ $itemMateria->materia->nombre }}</td>
                                    <td>{{ $itemMateria->docente->name }}</td>
                                </tr>
                                @php $fila++; @endphp
                                @endforeach                                

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- end card-->

    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header py-3 bg-transparent">     
                <h5 class="header-title mb-0"> Utl. Estudiantes Inscritos</h5>
            </div>
            <div id="cardCollpase4" class="collapse show">
                <div class="card-body">
                    <div class="table-responsive">                        
                        <table class="table table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Fecha Inscripción</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php $fila = 1; @endphp
                                @foreach($estudiantesInscritos as $inscripcion)
                                <tr>
                                    <td>{{$fila}}</td>
                                    <td>{{ $inscripcion->estudiante->codigo }}</td>
                                    <td>{{ $inscripcion->estudiante->NombreCompleto }}</td>
                                    <td>{{ date_format($inscripcion->fecha, 'd/m/Y') }}</td>                                    
                                </tr>          
                                @php $fila++; @endphp                     
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- end card-->

    </div>
</div>

@endsection