<?php

namespace App\Http\Controllers;

use App\Ciclo;
use App\Inscripcion;
use App\InscripcionDetalle;
use App\Materia;
use App\Periodo;
use App\PeriodoCicloDetalle;
use App\PeriodoCicloDetalleMateria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{

    public function __construct()
	{
	    $this->middleware('auth');
	}
    
    public function index()
    {
        return view('inscripciones.inscripcion-index');
    }

    public function getAll(Request $request)
    {
        if (!$request->ajax()) return '';

        $totalData = 0;
        $totalFiltered = 0;
        $dataResult = array();
        $offset = $request->start;
        $limit = $request->length;

        $searchValue = '%';

        if (isset($request->search['value'])) {
            $searchValue = '%' . trim($request->search['value']) . '%';
        }

        $totalData = Inscripcion::count();

        $inscripciones = Inscripcion::with('Estudiante')
        ->with('Periodo')
        ->with('Ciclo')
        ->offset($offset)
        ->limit($limit)
        ->orderBy('fecha', 'desc')        
        ->get();

        $totalFiltered = $inscripciones->count();

        foreach ($inscripciones as $inscripcion) {
            $nestedData = array();        

            $nestedData['id'] = $inscripcion->id;
            $nestedData['numero_inscripcion'] = $inscripcion->NumeroInscripcion;
            $nestedData['fecha'] = date_format($inscripcion->fecha, 'd/m/Y');
            $nestedData['estudiante'] = $inscripcion->estudiante->NombreCompleto;
            $nestedData['periodo'] = $inscripcion->periodo->anio;
            $nestedData['ciclo'] = $inscripcion->ciclo->nombre;

            $dataResult[] = $nestedData;
        }


        $json_data = array(
            'draw' => intval($request->draw),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $dataResult
        );

        return json_encode($json_data);
    }


    public function create()
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
        
        return view('inscripciones.inscripcion-nuevo', compact('periodo', 'ciclo', 'periodoDetalleCiclo', 'periodoDetalleCicloMaterias'));
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return '';

        $inscripcion = Inscripcion::where('periodo_id', $request->periodo_id)
        ->where('ciclo_id', $request->ciclo_id)
        ->where('estudiante_id', $request->estudiante_id)
        ->first();

        if($inscripcion)
        {
            return response()->json([
                'message' => 'El estudiante ya tiene una inscripción activa.',
                'status' => 'WARNING'
            ]);
        }

        $inscripcion = new Inscripcion();
        $inscripcion->fecha = $request->fecha;
        $inscripcion->estudiante_id = $request->estudiante_id;
        $inscripcion->ciclo_id = $request->ciclo_id;
        $inscripcion->periodo_id = $request->periodo_id;
        $inscripcion->save();

        $periodoDetalleCicloMaterias = PeriodoCicloDetalleMateria::where('periodo_id', $request->periodo_id)
        ->where('ciclo_id', $request->ciclo_id)
        ->get();

        foreach($periodoDetalleCicloMaterias as $itemMateria) {
            $inscripcionDetalle = new InscripcionDetalle();
            $inscripcionDetalle->estado = "NO INSCRITA";
            $inscripcionDetalle->materia_id = $itemMateria->materia_id;
            $inscripcionDetalle->inscripcion_id = $inscripcion->id;

            if(isset($request['chk_' . $itemMateria->id])){
                $inscripcionDetalle->estado = "INSCRITA";
            }

            $inscripcionDetalle->save();

        }

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }


    public function edit(Request $request, $inscripcion_id)
    {
        $inscripcion = Inscripcion::with('Detalle')->find($inscripcion_id);

        return view('inscripciones.incripcion-editar', compact('inscripcion'));
    }


    public function hojaAsistencia()
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

        return view('inscripciones.hoja-asistencia', compact('periodo', 'periodoDetalleCiclo', 'ciclo', 'periodoDetalleCicloMaterias'));
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
        ->where('inscripcion_detalle.estado', 'INSCRITA')
        ->orderBy('estudiante.primer_apellido')
        ->orderBy('estudiante.segundo_apellido')
        ->orderBy('estudiante.primer_nombre')
        ->orderBy('estudiante.segundo_nombre')
        ->get();
        
        return view('inscripciones.hoja-asistencia-partial', compact('periodo','ciclo','materia','estudiantes'));
    }


    public function listadoInscripciones(Request $request)
    {
        $periodo = isset($request->periodo) ? $request->periodo : -1;
        
        $inscripciones = Inscripcion::with('estudiante')
        ->where('periodo_id', $periodo)
        ->orderBy('fecha')
        ->get();

        $periodos = Periodo::orderBy('anio')->get();

        return view('inscripciones.inscripcion-listado', compact('inscripciones', 'periodos', 'periodo'));
    }
}
