<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index(Request $request)
    {
        return view('estudiantes.estudiantes-index');
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

        $totalData = Estudiante::count();

        $estudiantes = Estudiante::select('id', 'codigo', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'apellido_casada', 'dui')
            ->where('codigo', 'like', $searchValue)
            ->whereOr('primer_nombre', 'like', $searchValue)
            ->whereOr('segundo_nombre', 'like', $searchValue)
            ->whereOr('primer_apellido', 'like', $searchValue)
            ->whereOr('segundo_apellido', 'like', $searchValue)
            ->whereOr('dui', 'like', $searchValue)
            ->offset($offset)
            ->limit($limit)            
            ->get();
        
        $totalFiltered = $estudiantes->count();

        foreach ($estudiantes as $estudiante) {
            $nestedData = $estudiante->toArray();

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
}
