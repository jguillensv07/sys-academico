<?php

namespace App\Http\Controllers;

use App\Ciclo;
use App\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{

    public function __construct()
	{
	    $this->middleware('auth');
	}
    
    public function index(Request $request)
    {
        $ciclos = Ciclo::all();
        return view ('materias.materias-index', compact('ciclos'));
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

        $totalData = Materia::count();

        $materias = Materia::select('id', 'nombre', 'descripcion', 'uv', 'ciclo_id')
            ->with('ciclo')
            ->where('nombre', 'LIKE', $searchValue)
            ->offset($offset)
            ->limit($limit)
            ->orderBy('nombre', 'asc')
            ->get();

        $totalFiltered = $materias->count();

        foreach ($materias as $materia) {
            $nestedData = $materia->toArray();

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
            "nombre" => "required",            
            "ciclo_id" => "required", 
        ]);

        $materia = new materia();

        $materia->nombre = $request->nombre;
        $materia->descripcion = $request->descripcion;
        $materia->uv = $request->uv;
        $materia->ciclo_id = $request->ciclo_id;
        $materia->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }


    public function update(Request $request)
    {
        if (!$request->ajax()) return '';

        $this->validate($request, [
            "nombre" => "required",            
            "ciclo_id" => "required", 
        ]);

        $materia = materia::find($request->id);        

        $materia->nombre = $request->nombre;
        $materia->descripcion = $request->descripcion;
        $materia->uv = $request->uv;
        $materia->ciclo_id = $request->ciclo_id;
        $materia->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }

    public function listadoMaterias()
    {
        $materias = DB::table('materia')
        ->join('ciclo', 'materia.ciclo_id', '=', 'ciclo.id')
        ->select('materia.nombre as materia', 'materia.descripcion', 'ciclo.nombre as ciclo', 'ciclo.orden')
        ->orderBy('ciclo.orden')
        ->orderBy('materia.nombre')
        ->get();

        return view('materias.materia-listado', compact('materias'));
    }
}
