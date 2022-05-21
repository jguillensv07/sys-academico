<?php

namespace App\Http\Controllers;

use App\Ciclo;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    public function index(Request $request)
    {
        return view ('ciclos.ciclos-index');
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

        $totalData = Ciclo::count();

        $ciclos = Ciclo::select('id', 'nombre', 'orden')
            ->where('nombre', 'LIKE', $searchValue)
            ->offset($offset)
            ->limit($limit)
            ->orderBy('orden', 'asc')
            ->get();

        $totalFiltered = $ciclos->count();

        foreach ($ciclos as $ciclo) {
            $nestedData = $ciclo->toArray();

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

        $ciclo = new Ciclo();

        $ciclo->nombre = $request->nombre;
        $ciclo->orden = $request->orden;
        $ciclo->save();

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

        $ciclo = Ciclo::find($request->id);        

        $ciclo->nombre = $request->nombre;
        $ciclo->orden = $request->orden;
        $ciclo->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }
}
