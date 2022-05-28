<?php

namespace App\Http\Controllers;

use App\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index(Request $request)
    {
        return view ('materias.materias-index');
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

        $materias = Materia::select('id', 'nombre', 'descripcion', 'uv')
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
        ]);

        $materia = new materia();

        $materia->nombre = $request->nombre;
        $materia->descripcion = $request->descripcion;
        $materia->uv = $request->uv;
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
        ]);

        $materia = materia::find($request->id);        

        $materia->nombre = $request->nombre;
        $materia->descripcion = $request->descripcion;
        $materia->uv = $request->uv;
        $materia->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }
}
