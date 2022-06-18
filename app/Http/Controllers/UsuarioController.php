<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        return view ('usuarios.usuario-index');
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

        $totalData = User::count();

        $usuarios = User::select('id', 'name', 'email', 'role')
            ->where('name', 'LIKE', $searchValue)
            ->where('id', '<>', '1')
            ->offset($offset)
            ->limit($limit)        
            ->get();

        $totalFiltered = $usuarios->count();

        foreach ($usuarios as $usuario) {
            $nestedData = $usuario->toArray();

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
            "name" => "required",            
            "email" => "required",            
        ]);

        $usuario = new User();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role;
        $usuario->password = Hash::make('password');
        $usuario->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }


    public function update(Request $request)
    {
        if (!$request->ajax()) return '';

        $this->validate($request, [
            "name" => "required", 
            "email" => "required"             
        ]);

        $usuario = User::find($request->id);        

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role;
        $usuario->save();

        return response()->json([
            'message' => 'La información se registro exitosamente.',
            'status' => 'OK'
        ]);
    }
}
