<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
session_start();
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $_SESSION['search'] = "";
        $_SESSION['limit']="";
        $usuarios=Usuario::where('idUsuario','!=','1')->paginate(10);
        $data = [
            'usuarios'=>$usuarios,
            'search'=>"",
            'limit'=>10
        ];
        return view('usuarios.index',$data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        //
        $input =   $request->all(); 
        if(empty($input['search']) && empty($input['limit'])){
            $input['search'] ="" ;
                $input['limit'] = $_SESSION['limit'];         
        }
        if(is_null($input['search'])){
            $input['search'] =$_SESSION['search'];
           
        }else{
            if($input['search']==""){
                $input['search'] =$_SESSION['search'];
            }else{
                $_SESSION['search'] =  $input['search'];
            }
           
        }
        if(is_null($input['limit'])){
            $input['limit'] = $_SESSION['limit'];
           
        }else{
            $_SESSION['limit'] = $input['limit'];
        }
        $limit = $input['limit'];
        $usuarios =Usuario::select('usuarios.*');
                  
        $usuarios =$usuarios->where("usuarios.usuario","LIKE","%{$input['search']}%")
                            ->where('idUsuario','!=','1');
         
        $usuarios =$usuarios->paginate($limit);
        $data = [
            'usuarios'=>$usuarios,
            'search'=>$input['search'],
            'limit'=>$limit
        ];
        return view('usuarios.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('usuarios.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input =$request->all();
        $datos = $input['usuario'];
        $usuario=Usuario::where('usuario','=',$datos['usuario'])->first();
        if(empty($usuario)){
            $usuario=new Usuario([
                'usuario'=>$datos['usuario'],
                'contrasenia'=>$datos['pass'],
                'autor'=>$datos['autor']
            ]);
            try{
                $usuario->save();
                echo json_encode(true);
            }catch(\Illuminate\Database\QueryException $e){
                echo json_encode(false);
            }
        }else{
            echo json_encode(false);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $usuario=Usuario::where('idUsuario','=',$id)->first();
        $data =[
            'usuario'=>$usuario
        ];
        return view('usuarios.edit',$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perfil()
    {
        //
        $usuario=Usuario::where('idUsuario','=',$_SESSION['id'])->first();
        $data =[
            'usuario'=>$usuario
        ];
        return view('usuarios.perfil',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $input =$request->all();
        $datos = $input['usuario'];
        $usuario=Usuario::where('usuario','=',$datos['usuario'])->where('idUsuario','!=',$datos['idUsuario'])->first();
        if(empty($usuario)){
            $usuario=Usuario::where('idUsuario','=',$datos['idUsuario'])->first();
            $usuario->usuario=$datos['usuario'];
            $usuario->contrasenia=$datos['pass'];
            $usuario->autor=$datos['autor'];
            try{
                $usuario->save();
                echo json_encode(true);
            }catch(\Illuminate\Database\QueryException $e){
                echo json_encode(false);
            }
        }else{
            echo json_encode(false);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $input =$request->all();
        $usuario=Usuario::where('idUsuario','=', $input['id'])->first();
        try{
            $usuario->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode(false);
        }
    }
}
