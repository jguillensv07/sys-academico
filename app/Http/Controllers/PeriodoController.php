<?php

namespace App\Http\Controllers;

use App\Ciclo;
use App\Materia;
use App\Periodo;
use App\PeriodoCicloDetalle;
use App\PeriodoCicloDetalleMateria;
use App\User;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index(Request $request)
    {
        return view ('periodos.periodo-index');
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

        $totalData = Periodo::count();

        $periodos = Periodo::select('id', 'anio', 'estado')
            ->offset($offset)
            ->limit($limit)
            ->orderBy('anio', 'DESC')
            ->get();

        $totalFiltered = $totalData;

        foreach ($periodos as $periodo) {
            $nestedData = $periodo->toArray();

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


    public function create(Request $request)
    {
        if (!$request->ajax()) return '';

        $this->validate($request, [
            "anio" => "required|unique",            
        ]);       

        $periodo = new Periodo();

        $periodo->anio = $request->anio;
        $periodo->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }


    public function update(Request $request)
    {
        if (!$request->ajax()) return '';

        $this->validate($request, [
            "anio" => "required|unique",            
        ]);

        $periodo = Periodo::find($request->id);        

        $periodo->anio = $request->anio;
        $periodo->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }

    public function cambiarEstado(Request $request, $periodo_id)
    {
        if (!$request->ajax()) return '';

        if($request->siguienteEstado == 'APERTURADO') {
            
            $validarPeriodo = Periodo::where('estado', 'APERTURADO')
            ->where('id', '<>', $periodo_id)
            ->first();
    
            if($validarPeriodo) {
                return response()->json([
                    'message' => 'Ya existe un período aperturado.',
                    'status' => 'WARNING'
                ]);
            }
        }

        $periodo = Periodo::find($periodo_id);
        $periodo->estado = strtoupper($request->siguienteEstado);
        $periodo->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
        
    }


    public function detail(Request $request, $periodo)
    {
        $periodo = Periodo::find($periodo);
        $ciclos = Ciclo::all();

        return view('periodos.detalle', compact('periodo', 'ciclos'));
    }


    public function ciclosGetAll(Request $request, $periodo)
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

        $totalData = PeriodoCicloDetalle::where('periodo_id', $periodo)->count();

        $detalleCiclos = PeriodoCicloDetalle::where('periodo_id', $periodo)
            ->with('Ciclo')
            ->offset($offset)
            ->limit($limit)            
            ->get();

        $totalFiltered = $totalData;

        foreach ($detalleCiclos as $periodo) {
            $nestedData = $periodo->toArray();

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


    public function agregarCiclo(Request $request, $periodo)
    {
        if (!$request->ajax()) return '';

        $this->validate($request, [
            "periodo_id" => "required",  
            "ciclo_id" => "required",            
        ]);

        // Validamos si existe
        $periodoCicloDetalle = PeriodoCicloDetalle::where('periodo_id', $periodo)->where('ciclo_id', $request->ciclo_id)->first();

        if($periodoCicloDetalle == null)
        {
            $periodoCicloDetalle = new PeriodoCicloDetalle();
            $periodoCicloDetalle->periodo_id = $request->periodo_id;
            $periodoCicloDetalle->ciclo_id = $request->ciclo_id;
            $periodoCicloDetalle->estado = 'NO APERTURADO';
            $periodoCicloDetalle->save();

            // Agregamos las materias al periodo - ciclo
            $materias = Materia::where('ciclo_id', $request->ciclo_id)->get();
            
            foreach($materias as $materia)
            {
                $periodoCicloMateria = new PeriodoCicloDetalleMateria();
                $periodoCicloMateria->materia_id = $materia->id;
                $periodoCicloMateria->ciclo_id = $request->ciclo_id;
                $periodoCicloMateria->periodo_id = $request->periodo_id;
                $periodoCicloMateria->save();
            }
        }

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }


    public function aperturarCicloPartial(Request $request)
    {
        if (!$request->ajax()) return '';

        $periodoCicloDetalle = PeriodoCicloDetalle::with('periodo')
            ->with('ciclo')
            ->find($request->periodo_ciclo_detalle_id);

        $periodoCicloDetalleMateria = PeriodoCicloDetalleMateria::with('materia')
            ->where('periodo_id', $periodoCicloDetalle->periodo_id)
            ->where('ciclo_id', $periodoCicloDetalle->ciclo_id)
            ->get();

        $docentes = User::all();
        
        return view('periodos.detalle-materias', compact('periodoCicloDetalle', 'periodoCicloDetalleMateria', 'docentes'));

    }


    public function aperturarCiclo(Request $request)
    {
        if (!$request->ajax()) return '';

        $periodoCicloDetalleValidar = PeriodoCicloDetalle::where('estado', 'APERTURADO')
        ->first();

        if($periodoCicloDetalleValidar)
        {
            return response()->json([
                'message' => 'Ya existe un ciclo aperturado, por favor verifique.',
                'status' => 'WARNING'
            ]);            
        }

        $periodoCicloDetalle = PeriodoCicloDetalle::where('periodo_id', $request->periodo_id)
        ->where('ciclo_id', $request->ciclo_id)
        ->first();

        for ($i=0; $i < count($request->detale_materia); $i++) { 
            $periodoCicloDetalleMateria = PeriodoCicloDetalleMateria::where('periodo_id', $periodoCicloDetalle->periodo_id)
            ->where('ciclo_id', $periodoCicloDetalle->ciclo_id)
            ->where('id', $request->detale_materia[$i])
            ->first();

            $periodoCicloDetalleMateria->docente_id = $request->docente[$i];

            $periodoCicloDetalleMateria->save();
        }

        $periodoCicloDetalle->estado = 'APERTURADO';
        $periodoCicloDetalle->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);

    }
}
