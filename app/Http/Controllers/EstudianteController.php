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

        $estudiantes = Estudiante::where('codigo', 'like', $searchValue)
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

            $nestedData['fecha_nacimiento2'] = @date_format($estudiante->fecha_nacimiento, 'Y/m/d');

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
            "primer_nombre" => "required|max:50",
            "primer_apellido" => "required|max:50",
            "dui" => "required|max:10",
            "fecha_nacimiento" => "required",            
        ]);

        $cantidadEstudiante = Estudiante::count();
        $codigo = "E" . str_pad($cantidadEstudiante, 6, '0', STR_PAD_LEFT);

        $estudiante = new Estudiante();        

        $estudiante->codigo = $codigo;
        $estudiante->primer_nombre = $request->primer_nombre;
        $estudiante->segundo_nombre = $request->segundo_nombre;
        $estudiante->primer_apellido = $request->primer_apellido;
        $estudiante->segundo_apellido = $request->segundo_apellido;
        $estudiante->apellido_casada = $request->apellido_casada;
        $estudiante->dui = $request->dui;
        $estudiante->fecha_nacimiento = $request->fecha_nacimiento;
        $estudiante->genero = $request->genero;
        $estudiante->estado_civil_id = $request->estado_civil_id;
        $estudiante->direccion_domicilio = $request->direccion_domicilio;
        $estudiante->ciudad = $request->ciudad_id;
        $estudiante->departamento = $request->departamento_id;
        $estudiante->telefono = $request->telefono;
        $estudiante->celular = $request->celular;
        $estudiante->correo = $request->correo;
        $estudiante->nombre_conyugue = $request->nombre_conyugue;
        $estudiante->direccion_conyugue = $request->direccion_conyugue;
        $estudiante->ocupacion_conyugue = $request->ocupacion_conyugue;
        $estudiante->edad_conyugue = $request->edad_conyugue;
        $estudiante->conyugue_es_creyente = isset($request->conyugue_es_creyente) ? '1' : '0';
        $estudiante->telefono_conyugue = $request->telefono_conyugue;
        $estudiante->cantidad_hijos = $request->cantidad_hijos;
        $estudiante->cantidad_hijas = $request->cantidad_hijas;
        $estudiante->ultimo_grado_estudio = $request->ultimo_grado_estudio;
        $estudiante->es_graduado = isset($request->es_graduado) ? '1' : '0';
        $estudiante->institucion_estudio = $request->institucion_estudio;

        $estudiante->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }

    public function update(Request $request)
    {

        if (!$request->ajax()) return '';

        $this->validate($request, [            
            "primer_nombre" => "required|max:50",
            "primer_apellido" => "required|max:50",
            "dui" => "required|max:10",
            "fecha_nacimiento" => "required",            
        ]);        

        $estudiante = Estudiante::find($request->id);        
        
        $estudiante->primer_nombre = $request->primer_nombre;
        $estudiante->segundo_nombre = $request->segundo_nombre;
        $estudiante->primer_apellido = $request->primer_apellido;
        $estudiante->segundo_apellido = $request->segundo_apellido;
        $estudiante->apellido_casada = $request->apellido_casada;
        $estudiante->dui = $request->dui;
        $estudiante->fecha_nacimiento = $request->fecha_nacimiento;
        $estudiante->genero = $request->genero;
        $estudiante->estado_civil_id = $request->estado_civil_id;
        $estudiante->direccion_domicilio = $request->direccion_domicilio;
        $estudiante->ciudad = $request->ciudad_id;
        $estudiante->departamento = $request->departamento_id;
        $estudiante->telefono = $request->telefono;
        $estudiante->celular = $request->celular;
        $estudiante->correo = $request->correo;
        $estudiante->nombre_conyugue = $request->nombre_conyugue;
        $estudiante->direccion_conyugue = $request->direccion_conyugue;
        $estudiante->ocupacion_conyugue = $request->ocupacion_conyugue;
        $estudiante->edad_conyugue = $request->edad_conyugue;
        $estudiante->conyugue_es_creyente = isset($request->conyugue_es_creyente) ? '1' : '0';
        $estudiante->telefono_conyugue = $request->telefono_conyugue;
        $estudiante->cantidad_hijos = $request->cantidad_hijos;
        $estudiante->cantidad_hijas = $request->cantidad_hijas;
        $estudiante->ultimo_grado_estudio = $request->ultimo_grado_estudio;
        $estudiante->es_graduado = isset($request->es_graduado) ? '1' : '0';
        $estudiante->institucion_estudio = $request->institucion_estudio;

        $estudiante->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }
}
