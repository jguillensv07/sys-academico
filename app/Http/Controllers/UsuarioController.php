<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function __construct()
	{
	    $this->middleware('auth');
	}
    
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


    public function miCuenta()
    {
        $userLoggedId = Auth::user()->id;
        $user = User::find($userLoggedId);
        return view('usuarios.usuario-mi-cuenta', compact('user'));
    }

    public function cambiarClave(Request $request)
    {

        if (Auth::check()) {
            $currUserPassword = Auth::user()->password;
            if (!Hash::check($request->old_password, $currUserPassword)) {
                return redirect()->back()->with(['error' => 'Tu clave actual no es válida.']);
            }

            $objUser = User::find(Auth::user()->id);
            $objUser->password = hash::make($request->new_password);
            $objUser->save();

            return redirect()->to('/mi-cuenta')->with(['user-password-changed-ok' => true]);
        } else {
            return redirect()->to('/');
        }
    }
}
