<?php

namespace App\Http\Controllers;

use App\Ciclo;
use App\Materia;
use App\Periodo;
use App\PeriodoCicloDetalle;
use App\PeriodoCicloDetalleMateria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{
    public function index()
    {
        $periodo = Periodo::where('estado', 'APERTURADO')->first();
        $periodoDetalleCiclo = PeriodoCicloDetalle::where('periodo_id', $periodo->id)
        ->where('estado', 'APERTURADO')       
        ->first();

        $ciclo = Ciclo::find($periodoDetalleCiclo->ciclo_id);

        $periodoDetalleCicloMaterias = PeriodoCicloDetalleMateria::with('materia')
        ->where('periodo_id', $periodo->id)
        ->where('ciclo_id', $ciclo->id)
        ->get();

        return view('notas.nota-index', compact('periodo', 'periodoDetalleCiclo', 'ciclo', 'periodoDetalleCicloMaterias'));
    }

    public function listadoEstudiantesPartial(Request $request)
    {
        if (!$request->ajax()) return '';

        $periodo = Periodo::find($request->periodo_id);
        $ciclo = Ciclo::find($request->ciclo_id);
        $materia = Materia::find($request->materia_id);

        $estudiantes = DB::table('estudiante')
        ->join('inscripcion', 'estudiante.id', 'inscripcion.estudiante_id')
        ->join('inscripcion_detalle', 'inscripcion.id', 'inscripcion_detalle.inscripcion_id')
        ->where('inscripcion.periodo_id', $request->periodo_id)
        ->where('inscripcion.periodo_id', $request->periodo_id)
        ->where('inscripcion_detalle.materia_id', $request->materia_id)
        ->orderBy('estudiante.primer_apellido')
        ->orderBy('estudiante.segundo_apellido')
        ->orderBy('estudiante.primer_nombre')
        ->orderBy('estudiante.segundo_nombre')
        ->get();
        
        return view('notas.nota-index-partial', compact('periodo','ciclo','materia','estudiantes'));
    }
}
