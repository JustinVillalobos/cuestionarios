<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Pregunta;
use App\Models\Cuestionario;
session_start();
class CuestionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if($_SESSION['id']==1){
            $cuestionarios =Cuestionario::select('cuestionarios.*')->paginate(10);
        }else{
            $cuestionarios =Cuestionario::where('idCuestionario','!=','1')->paginate(10);
        }
        $data = [
            'cuestionarios'=>$cuestionarios,
            'search'=>"",
            'limit'=>10
        ];
        
        return view('cuestionarios.index',$data);
    }
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
        $cuestionarios =Cuestionario::select('cuestionarios.*');
                  
        $cuestionarios =$cuestionarios->where("cuestionarios.titulo","LIKE","%{$input['search']}%");
         
        $cuestionarios =$cuestionarios->paginate($limit);
        $data = [
            'cuestionarios'=>$cuestionarios,
            'search'=>$input['search'],
            'limit'=>$limit
        ];
        return view('cuestionarios.index',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cuestionarios.add');
    }
    public function caso_estudio($codigo)
    {
        //
        return view('cuestionarios.add');
    }

    function generarCadenaAleatoria($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
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
        $input = $request->all();
        $datos= $input['cuestionario'];
        $code = $this->generarCadenaAleatoria(24);
        $codeSearch=true;
        while($codeSearch){
            $cuestionarios=Cuestionario::where('codigo','=',$code)->get();
            if(count($cuestionarios)>0){
                $code = $this->generarCadenaAleatoria(24);
            }else{
                $codeSearch=false;
            }
        }
        $_SESSION['autor']=$_SESSION['id'];
        $datos['hijos']="0";
        $datos['fecha'] = date("y-m-d");
        $cuestionario = new Cuestionario([
            'codigo'=>$code,
            'titulo'=>$datos['titulo'],
            'descripcion'=>$datos['descripcion'],
            'fechaCreacion'=>$datos['fecha'],
            'disponible'=>1,
            'autor'=>$_SESSION['autor'],
            'antecedentesPersonales'=>$datos['antecedentesPersonales'],
            'antecedentesFamiliares'=>$datos['antecedentesFamiliares'],
            'motivoConsulta'=>$datos['motivo'],
            'revision'=>$datos['revision'],
            'edad'=>$datos['edad'],
            'imagen'=>$datos['imagen'],
            'genero'=>$datos['genero'],
            'trabajo'=>$datos['trabajo'],
            'hijos'=>$datos['hijos']
        ]);
        try{
            $cuestionario->save();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
