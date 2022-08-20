<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Pregunta;
use App\Models\Cuestionario;
use App\Models\Puntaje;
use App\Models\PuntajePreguntum;
use Illuminate\Support\Facades\DB;
session_start();
class CuestionariosController extends Controller
{
    public function __construct(){
        $uri = request()->route()->uri;
        if(empty($_SESSION['id']) && $uri!="caso_estudio" && $uri!="insertUser" && $uri!="updatePuntaje" && $uri!="sala"){
            return redirect('inicio_sesion')->send();
        }else{
            
            if(!empty($_SESSION['id'])){
                
                if($_SESSION['id']==""  && $uri!="caso_estudio" && $uri!="insertUser" && $uri!="updatePuntaje" && $uri!="sala"){
                   
                    return redirect('inicio_sesion')->send();
                }
            }
        }
    }
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
            $cuestionarios =Cuestionario::where('autor','!=','1')->paginate(10);
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
            if(empty($_SESSION['search'])){
                $_SESSION['search'] ="";
            }
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
        if($_SESSION['id']==1){
            $cuestionarios =Cuestionario::select('cuestionarios.*');
        }else{
            $cuestionarios =Cuestionario::where('autor','!=','1');
        }
                  
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
    public function caso_estudio(Request $request)
    {
        //
        $input = $request->all();
        $cuestionario= Cuestionario::where("codigo",'=',$input['code'])->first();
        if(empty($cuestionario)){
            return redirect()->to('./');
        }
        if($cuestionario->disponible != 1){
            return redirect()->to('./');
        }
        $preguntas=Pregunta::where('preguntas.idCuestionario','=',$cuestionario->idCuestionario)->get();
        $randomName = $this->generarCadenaAleatoria(75);
        $data = [
            'cuestionario'=>$cuestionario,
            'preguntas'=>$preguntas,
            'randomCodigo'=>$randomName
        ];
        return view('cuestionarios.caso_estudio',$data);
    }
    public function sala(Request $request){
        $input = $request->all();
        $cuestionario= Cuestionario::where("codigo",'=',$input['code'])->first();
        if(empty($cuestionario)){
            $data = [
                'errors'=>"Caso de Estudio no encontrado"
            ];
            return view("home.index",$data);
        }else{
            if($cuestionario->disponible == 1){
                return redirect()->to('./caso_estudio?code='.$input['code']);
            }else{
                $data = [
                    'errors'=>"Caso de Estudio no disponible"
                ]; 
                return view("home.index",$data);
            }
            
        }
    }
    public function graficos($id)
    {
        //

        $cuestionario= Cuestionario::where("idCuestionario",'=',$id)->first();
        $preguntas = Pregunta::where("idCuestionario",'=',$id)->get();
        $cantidad = count($preguntas);
        if($cantidad==0){
            $cantidad=1;
        }
        $puntajes =Puntaje::select('puntajes.*')->where('idCuestionario','=',$id)->orderBy('puntajeCorrecto', 'desc')->paginate(10);
        $pr=[];
        for($i=0;$i<count( $preguntas);$i++){
            $puntajes_preguntas =PuntajePreguntum::select(DB::raw('respuesta, COUNT(respuesta) AS respuesta_count'))
                                                    ->where('idPregunta','=',$i)
                                                    ->where('idCuestionario','=',$id)
                                                    ->groupBy('respuesta')
                                                    ->get();
            $cantidadRespuestas=2;
            if($preguntas[$i]->respuesta3!=""){
                if($preguntas[$i]->respuesta4!=""){
                    $cantidadRespuestas=4;
                }else{
                    $cantidadRespuestas=3;
                }
            }
            $pr[]=array('respuestas'=>$cantidadRespuestas,'puntajes_preguntas'=>$puntajes_preguntas);
        }
        $data = [
            'cuestionario'=>$cuestionario,
            'search'=>"",
            'limit'=>10,
            'salaData'=>"0",
            'preguntas'=>$preguntas,
            'idSala'=>$cuestionario->idCuestionario,
            'cantidad'=>$cantidad,
            'puntajes'=>$puntajes,
            'puntajes_preguntas'=>$pr
        ];
       
        
        return view("cuestionarios.graficos",$data);
    }

    
    public function insertUser(Request $request){
        $input = $request->all();
        $data = $input['puntaje'];
        $puntajeSearch= Puntaje::where('nombre','=',$input['puntaje']['usuario']);
        $puntajeSearch=$puntajeSearch->first();
        if(!empty($puntajeSearch)){
            $fecha = date_create($puntajeSearch->fechaCreacion);
            $fecha2 = date("Y-m-d");
            if($fecha->format('Y-m-d') == $fecha2){
                echo json_encode(false);
                return;
            }
        }
        
        $cuestionario= Cuestionario::where("codigo",'=',$data['idCuestionario'])->first();
        $puntaje = new Puntaje([
            'codigo'=>$data['codigo'],
            'nombre'=>$data['usuario'],
            'fechaCreacion'=>date('Y-m-d H:i:s'),
            'puntajeCorrecto'=>0,
            'puntajeIncorrecto'=>0,
            'idCuestionario'=>$cuestionario->idCuestionario
        ]);
        try{
            $puntaje->save();
          
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
    public function updatePuntaje(Request $request){
        $input = $request->all();
        $puntaje= Puntaje::where('codigo','=',$input['puntaje']['codigo'])->first();
        $correcto = $puntaje->puntajeCorrecto;
        $incorrecto = $puntaje->puntajeIncorrecto;
        if($input['puntaje']['isCorrecto']=='true'){
            $puntaje->puntajeCorrecto = $correcto+1;
        }else{
            $puntaje->puntajeIncorrecto = $incorrecto+1;
        }

        $pregunta_puntaje = new PuntajePreguntum([
            'idPuntajes'=>$puntaje->idPuntaje,
            'idPregunta'=>$input['puntaje']['pregunta'],
            'respuesta'=>$input['puntaje']['respuesta'],
            'idCuestionario'=>$puntaje->idCuestionario
        ]);
        try{
            $puntaje->save();
            $pregunta_puntaje->save();
            $id=$puntaje->idCuestionario;
            $i =$input['puntaje']['pregunta'];
            $preguntas = Pregunta::where("idCuestionario",'=',$id)->get();
            $preguntast[] = $preguntas[$i];
            $preguntas = $preguntast;
            $puntajes =Puntaje::select('puntajes.*')->where('idCuestionario','=',$id)->orderBy('puntajeCorrecto', 'desc')->paginate(10);
            $pr=[];
            $puntajes_preguntas =PuntajePreguntum::select(DB::raw('respuesta, COUNT(respuesta) AS respuesta_count'))
                                        ->where('idPregunta','=',$i)
                                        ->where('idCuestionario','=',$id)
                                        ->groupBy('respuesta')
                                        ->get();
                $cantidadRespuestas=2;
                if($preguntas[0]->respuesta3!=""){
                    if($preguntas[0]->respuesta4!=""){
                        $cantidadRespuestas=4;
                    }else{
                        $cantidadRespuestas=3;
                    }
                }
                $pr[]=array('respuestas'=>$cantidadRespuestas,'puntajes_preguntas'=>$puntajes_preguntas);
                $result = array('res'=>true,'pr'=>$pr,'preguntas'=>$preguntas);
            echo json_encode($result);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
    function refreshData(Request $request){
        try{
            $input = $request->all();
            $puntaje= Puntaje::where('codigo','=',$input['puntaje']['codigo'])->first();
            $id=$puntaje->idCuestionario;
            $i =$input['puntaje']['pregunta'];
            $preguntas = Pregunta::where("idCuestionario",'=',$id)->get();
            $preguntast[] = $preguntas[$i];
            $preguntas = $preguntast;
            $puntajes =Puntaje::select('puntajes.*')->where('idCuestionario','=',$id)->orderBy('puntajeCorrecto', 'desc')->paginate(10);
            $pr=[];
            $puntajes_preguntas =PuntajePreguntum::select(DB::raw('respuesta, COUNT(respuesta) AS respuesta_count'))
                                        ->where('idPregunta','=',$i)
                                        ->where('idCuestionario','=',$id)
                                        ->groupBy('respuesta')
                                        ->get();
                $cantidadRespuestas=2;
                if($preguntas[0]->respuesta3!=""){
                    if($preguntas[0]->respuesta4!=""){
                        $cantidadRespuestas=4;
                    }else{
                        $cantidadRespuestas=3;
                    }
                }
                $pr[]=array('respuestas'=>$cantidadRespuestas,'puntajes_preguntas'=>$puntajes_preguntas);
                $result = array('res'=>true,'pr'=>$pr,'preguntas'=>$preguntas);
            echo json_encode($result);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
    public function imagen(Request $request){
        
        $imagen = $request->file('image');
        if(empty($imagen)){
            return "";
        }
        $extension = $imagen->getClientOriginalExtension();
        $randomName = $this->generarCadenaAleatoria(15);
        $filename= "Img ".$randomName.".".$extension;
        
        $public_path = public_path('assets/cuestionarios');
        while(file_exists($public_path."/".$filename)){
            $filename= "Img ".$randomName.".".$extension;
        }
        $path = 'assets/cuestionarios/'.$filename;
        $imagen->move($public_path,$filename);
        return $path;
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
        $datos= json_decode($input['cuestionario'],true);
        $imagen = $request->file('imagen');
        if(empty($imagen)){
            return "No hay";
        }
        $extension = $imagen->getClientOriginalExtension();
        $randomName = $this->generarCadenaAleatoria(15);
        $filename= "Img ".$randomName.".".$extension;
        
        $public_path = public_path('assets/avatars');
        while(file_exists($public_path."/".$filename)){
            $filename= "Img ".$randomName.".".$extension;
        }
        $path = 'assets/avatars/'.$filename;
        $imagen->move($public_path,$filename);
        $datos['imagen']=$path;
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
        $path = $datos['imagenSeccion'];
        
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
            'hijos'=>$datos['hijos'],
            'imagenSeccion'=>$path,
            'seccion'=>$datos['seccion']
        ]);
        try{
            $cuestionario->save();
            $cuestionaro_insertado = Cuestionario::where('codigo','=',$code)->first();
            if(!empty($cuestionaro_insertado)){
                $preguntas = $datos['preguntas'];
                for($i=0;$i<count($preguntas);$i++){
                    $pregunta = $preguntas[$i];
                    if(count($pregunta['respuestas'])==3){
                        $respuesta3 = $pregunta['respuestas'][2]['respuesta'];
                        $respuesta4="";
                    }else if(count($pregunta['respuestas'])==4){
                        $respuesta3 = $pregunta['respuestas'][2]['respuesta'];
                        $respuesta4=$pregunta['respuestas'][3]['respuesta'];
                    }else{
                        $respuesta3="";
                        $respuesta4="";
                    }
                    $p = new Pregunta([
                        'pregunta'=>$pregunta['pregunta'],
                        'respuesta1'=>$pregunta['respuestas'][0]['respuesta'],
                        'respuesta2'=>$pregunta['respuestas'][1]['respuesta'],
                        'respuesta3'=>$respuesta3,
                        'respuesta4'=>$respuesta4,
                        'solucion'=>$pregunta['solucion'],
                        'detalles'=>$pregunta['detalles'],
                        'ayuda'=>$pregunta['ayuda'],
                        'definiciones'=>$pregunta['definiciones'],
                        'idCuestionario'=>$cuestionaro_insertado->idCuestionario,
                    ]);
                    $p->save();
                    
                }
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }
            
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
        
    }

    public function busquedaSala(Request $request){
        $input =   $request->all(); 
        
        if(is_null($input['limit'])){
            $input['limit'] = $_SESSION['limit'];
            $input['salaData'] = $_SESSION['salaData'];
            $input['idSala'] = $_SESSION['idSala'];
        }else{
            $_SESSION['limit'] = $input['limit'];
            $_SESSION['salaData'] = $input['salaData'];
            $_SESSION['idSala'] = $input['idSala'];
        }
        $limit = $input['limit'];
        $salaData = $input['salaData'];
        $cuestionario= Cuestionario::where("idCuestionario",'=',$input['idSala'])->first();
        $puntajes =Puntaje::select('puntajes.*')->where('idCuestionario','=',$input['idSala']);
        if($salaData=="1"){
            $d = (new \DateTime())->modify('-1 day')->format('Y-m-d');
            $puntajes->whereDate('fechaCreacion','>=',$d);
            
        }
        $puntajes->orderBy('puntajeCorrecto', 'desc');
        $puntajes =$puntajes->paginate($limit);
        $preguntas = Pregunta::where("idCuestionario",'=',$input['idSala'])->get();
        $cantidad = count($preguntas);
        $data = [
            'cuestionario'=>$cuestionario,
            'search'=>"",
            'limit'=>$limit,
            'salaData'=>$salaData,
            'idSala'=>$input['idSala'],
            'cantidad'=>$cantidad,
            'puntajes'=>$puntajes
        ];
        return view('cuestionarios.sala',$data);
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

        $cuestionario= Cuestionario::where("idCuestionario",'=',$id)->first();
        $preguntas = Pregunta::where("idCuestionario",'=',$id)->get();
        $cantidad = count($preguntas);
        if($cantidad==0){
            $cantidad=1;
        }
        $puntajes =Puntaje::select('puntajes.*')->where('idCuestionario','=',$id)->orderBy('puntajeCorrecto', 'desc')->paginate(10);
        $data = [
            'cuestionario'=>$cuestionario,
            'search'=>"",
            'limit'=>10,
            'salaData'=>"0",
            'idSala'=>$cuestionario->idCuestionario,
            'cantidad'=>$cantidad,
            'puntajes'=>$puntajes
        ];
        $percentajes=[];
        
        return view("cuestionarios.sala",$data);
    }
    
    public function ajaxFetchG(Request $request){
        $input =   $request->all(); 
        $id = $input['idSala'];
        $cuestionario= Cuestionario::where("idCuestionario",'=',$id)->first();
        $preguntas = Pregunta::where("idCuestionario",'=',$id)->get();
        $cantidad = count($preguntas);
        if($cantidad==0){
            $cantidad=1;
        }
        $puntajes =Puntaje::select('puntajes.*')->where('idCuestionario','=',$id)->orderBy('puntajeCorrecto', 'desc')->paginate(10);
        $pr=[];
        for($i=0;$i<count( $preguntas);$i++){
            $puntajes_preguntas =PuntajePreguntum::select(DB::raw('respuesta, COUNT(respuesta) AS respuesta_count'))
                                                    ->where('idPregunta','=',$i)
                                                    ->where('idCuestionario','=',$id)
                                                    ->groupBy('respuesta')
                                                    ->get();
            $cantidadRespuestas=2;
            if($preguntas[$i]->respuesta3!=""){
                if($preguntas[$i]->respuesta4!=""){
                    $cantidadRespuestas=4;
                }else{
                    $cantidadRespuestas=3;
                }
            }
            $pr[]=array('respuestas'=>$cantidadRespuestas,'puntajes_preguntas'=>$puntajes_preguntas);
        }
        echo json_encode($pr);
    }
    public function ajaxFetch(Request $request){
        $input =   $request->all(); 
        
        $limit = $input['limit'];
        $salaData = $input['salaData'];
        $puntajes =Puntaje::select('puntajes.*')->where('idCuestionario','=',$input['idSala']);
        if($salaData=="1"){
            $d = (new \DateTime())->modify('-1 day')->format('Y-m-d');
            $puntajes->whereDate('fechaCreacion','>=',$d);
        }
        $puntajes =$puntajes->orderBy('puntajeCorrecto', 'desc');
        $puntajes =$puntajes->paginate($limit);
        $preguntas = Pregunta::where("idCuestionario",'=',$input['idSala'])->get();
        $cantidad = count($preguntas);
        if($cantidad==0){
            $cantidad=1;
        }
        $data = [
            'cantidad'=>$cantidad,
            'puntajes'=>$puntajes
        ];
        return view('cuestionarios.table',$data)->render();
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
    public function update(Request $request)
    {
        //
        $input = $request->all();

        $codigo = $input['codigo'];
        $disponible=$input['disponible'];
        $cuestionario =Cuestionario::where('codigo','=',$codigo)->first();
        try{
            $cuestionario->disponible =$disponible;
            $cuestionario->save();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
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
        $input = $request->all();

        $codigo = $input['codigo'];
        $cuestionario =Cuestionario::where('codigo','=',$codigo)->first();
        $puntajes =Puntaje::where('idCuestionario','=',$cuestionario->idCuestionario);
        $preguntas =Pregunta::where('idCuestionario','=',$cuestionario->idCuestionario);
        $puntajes_preguntas =PuntajePreguntum::where('idCuestionario','=',$cuestionario->idCuestionario);
        try{
            $imagen = public_path($cuestionario->imagen);
            unlink($imagen);
            if(!empty($cuestionario->imagenSeccion)){
                $imagen = public_path($cuestionario->imagenSeccion);
                unlink($imagen);
            }
            $puntajes_preguntas->delete();
            $puntajes->delete();
            $preguntas->delete();
            $cuestionario->delete();
            
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
    public function destroyPointer(Request $request)
    {
        //
        $input = $request->all();

        $codigo = $input['codigo'];
       
        $puntajes =Puntaje::where('idCuestionario','=',$cuestionario->idCuestionario);
        $puntajes_preguntas =PuntajePreguntum::where('idCuestionario','=',$cuestionario->idCuestionario);
        try{
            $puntajes_preguntas->delete();
            $puntajes->delete();
            
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
}
