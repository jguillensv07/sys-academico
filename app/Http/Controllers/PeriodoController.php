<?php

namespace App\Http\Controllers;

use App\Periodo;
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

        $periodos = Periodo::select('id', 'anio')
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
            "anio" => "required",            
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
            "anio" => "required",            
        ]);

        $periodo = Periodo::find($request->id);        

        $periodo->anio = $request->anio;
        $periodo->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }
}
