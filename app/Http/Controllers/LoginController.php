<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
session_start();
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.index');
    }
    public function loginValidator(Request $request){
        $input = $request->all();
        $usuario = Usuario::where('usuario','=',$input['user'])
                            ->where('contrasenia','=',$input['pass'])
                            ->first();
        
        if(empty($usuario)){
            $_SESSION["errorBD"] = "Usuario no encontrado.";
            return view('login.index');
        }else{
            $_SESSION["errorBD"] = "";
            $_SESSION['id'] = $usuario->idUsuario;
            return redirect()->to('./casos_estudio');
        }
        
       
    }
}
