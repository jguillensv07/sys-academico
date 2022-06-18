<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\SolicitudAdmision;
use Illuminate\Http\Request;

class SolicitudAdmisionController extends Controller
{

    public function __construct()
	{
	    $this->middleware('auth');
	}
    
    public function index(Request $request)
    {
        return view('solicitud_admision.solicitud-admision-index');
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

        $totalData = SolicitudAdmision::count();

        $solicitudes = SolicitudAdmision::with('Estudiante')
        ->offset($offset)
        ->limit($limit)
        ->orderBy('fecha_solicitud', 'desc')        
        ->get();

        $totalFiltered = $solicitudes->count();

        foreach ($solicitudes as $solicitud) {
            $nestedData = array();        

            $nestedData['id'] = $solicitud->id;
            $nestedData['numero_solicitud'] = $solicitud->numero_solicitud;
            $nestedData['fecha_solicitud'] = date_format($solicitud->fecha_solicitud, 'd/m/Y');
            $nestedData['aprobada'] = $solicitud->aprobada;
            $nestedData['codigo_estudiante'] = $solicitud->estudiante->codigo;
            $nestedData['nombre_estudiante'] = $solicitud->estudiante->NombreCompleto;

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


    public function aprobarSolicitud(Request $request, $solicitud_id)
    {
        if (!$request->ajax()) return '';

        $solicitud = SolicitudAdmision::find($solicitud_id);
        $solicitud->aprobada = 'SI';
        $solicitud->save();

        $estudiante = Estudiante::find($solicitud->estudiante_id);
        $estudiante->admision_aprobada = 'SI';
        $estudiante->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }

    public function denegarSolicitud(Request $request, $solicitud_id)
    {
        if (!$request->ajax()) return '';

        $solicitud = SolicitudAdmision::find($solicitud_id);
        $solicitud->aprobada = 'NO';
        $solicitud->save();        

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }
}
