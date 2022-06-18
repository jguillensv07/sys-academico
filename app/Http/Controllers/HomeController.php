<?php

namespace App\Http\Controllers;

use App\Ciclo;
use App\Inscripcion;
use App\Periodo;
use App\PeriodoCicloDetalle;
use App\PeriodoCicloDetalleMateria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $periodo = Periodo::where('estado', 'APERTURADO')->firstOrNew();
        
        $periodoDetalleCiclo = PeriodoCicloDetalle::where('periodo_id', $periodo->id)
        ->where('estado', 'APERTURADO')       
        ->firstOrNew();

        $ciclo = Ciclo::findOrNew($periodoDetalleCiclo->ciclo_id);

        $periodoDetalleCicloMaterias = PeriodoCicloDetalleMateria::with('materia')
        ->where('periodo_id', $periodo->id)
        ->where('ciclo_id', $ciclo->id)
        ->get();

        $estudiantesInscritos = Inscripcion::with('estudiante')
        ->where('periodo_id', $periodo->id)
        ->where('ciclo_id', $ciclo->id)
        ->orderBy('fecha', 'desc')
        ->take(10)
        ->get();

        return view('home', compact('periodo', 'periodoDetalleCiclo', 'ciclo', 'periodoDetalleCicloMaterias', 'estudiantesInscritos'));
    }
}
