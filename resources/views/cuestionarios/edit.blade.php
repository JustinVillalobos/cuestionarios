@extends('./layouts.admin')
@section('content')  
<link rel="stylesheet" href="{{ URL::asset('plugins/sceditor/minified/themes/default.min.css'); }}" />

<script src="{{ URL::asset('plugins/sceditor/minified/sceditor.min.js'); }}"></script>
<script src="{{ URL::asset('plugins/sceditor/minified/icons/monocons.js'); }}"></script>
<div class="container">
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href='{{route("cuestionarios.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Casos De Estudio</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Caso de Estudio</li>
                
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;padding-left:5px;">
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DATOS CUESTIONARIO</div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Título:</label>
                 <input type="text" class="form-control" style="width:67%;" id="titulo" value="{{$cuestionario->titulo}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Descripción del cuestionario:</label>
                 <textarea class="form-control" style="width:67%;" id="des">{{$cuestionario->descripcion}}</textarea>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Edad:</label>
                 <input type="number" class="form-control" style="width:67%;" id="edad" value="{{$cuestionario->edad}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Género:</label>
                 <select class="form-select" style="width:67%;" id="genero" value="{{$cuestionario->genero}}">
                    <option value='0' <?php if($cuestionario->genero==0){echo "selected";}?>>Hombre</option>
                    <option value='1' <?php if($cuestionario->genero==1){echo "selected";}?>>Mujer</option>
                </select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Trabajo:</label>
                 <input type="text" class="form-control" style="width:67%;" id="trabajo" value="{{$cuestionario->trabajo}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Hijos:</label>
                 <input type="number" class="form-control" style="width:67%;" id="hijos" value="{{$cuestionario->hijos}}" />
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Imagen:</label>
                <input type="file" class="form-control" id="avatar"  style="width:67%;" onchange="selectImg()"/>
                <input type="hidden" id="avatarValue" value="{{$cuestionario->imagen}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        
    </div>
    <div class="col-sm-6 d-flex justify-content-center align-items-center">
        <div class="col-sm-12 d-flex justify-content-center align-items-center">
                        <img src="{{ URL::asset($cuestionario->imagen); }}" id='profile' style="width:255px;"/>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">CASO</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">Antecedentes Personales:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;height:350px">
                 <textarea class="form-control" style="width:100%;height:250px" id="antecedentesPersonales">{!! $cuestionario->antecedentesPersonales !!}</textarea>
                 <span id="antecedentePersonalSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">Antecedentes Familiares:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;height:350px">
                 <textarea class="form-control" style="width:100%;height:250px" id="antecedentesFamiliares">{!! $cuestionario->antecedentesFamiliares !!}</textarea>
                 <span id="antecedentesFamiliaresSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">M&oacutetivo Consulta:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;height:350px">
                 <textarea class="form-control" style="width:100%;height:250px" id="motivo">{!! $cuestionario->motivoConsulta !!}</textarea>
                 <span id="motivoSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">Revisi&oacuten:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;height:350px">
                 <textarea class="form-control" style="width:100%;height:250px" id="revision">{!! $cuestionario->revision !!}</textarea>
                 <span id="revisionSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">Adjuntar Imágen:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;">
                    <input type="file" class="form-control" id="file"  style="width:100%;"/>
                    <input type="hidden" id="fileValue" value="{{$cuestionario->imagenSeccion}}"/>
                    <span id="revisionSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">Secci&oacuten Imágen:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;">
                    <select class="form-select" id="seccion"  style="width:100%;" value="{{ $cuestionario->seccion }}">
                        <option value="0" <?php if($cuestionario->seccion==0){echo "selected";}?>>Ninguna</option>
                        <option value="3" <?php if($cuestionario->seccion==3){echo "selected";}?>>M&oacutetivo Consulta</option>
                        <option value="4" <?php if($cuestionario->seccion==4){echo "selected";}?>>Revisi&oacuten</option>
                        <option value="2" <?php if($cuestionario->seccion==2){echo "selected";}?>>Antecedentes Familiares</option>
                        <option value="1" <?php if($cuestionario->seccion==1){echo "selected";}?>>Antecedentes Personales</option>
                    </select>
                    <span id="revisionSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">
            <div class="row">
                <div class="col-sm-11">PREGUNTAS</div>
                <div class="col-sm-1 d-flex text-center justify-content-center align-items-center">
                    <button class="btn btn-primary d-flex text-center justify-content-center align-items-center" onclick="reload()" style="width:20px;height:20px;"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Pregunta:</label>
                 <input type="text" class="form-control" style="width:67%;" id="pregunta"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
             <div class="col-sm-12 form-inline text-end" style="margin-top:5px;">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Detalles:</label>
                 <textarea class="form-control" style="width:67%;height:120px;" id="detalles"></textarea>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
             <div class="col-sm-12 form-inline text-end" style="margin-top:5px;">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Informaci&oacuten adicional:</label>
                 <textarea  class="form-control" style="width:67%;height:120px;" id="ayuda"></textarea>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
             <div class="col-sm-12 form-inline text-end" style="margin-top:5px;">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Comentarios o definiciones:</label>
                 <textarea  class="form-control" style="width:67%;height:120px;" id="definiciones"></textarea>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
             <div class="col-sm-12 d-flex justify-content-end" style="margin-top:5px;">
                <button class="btn btn-success" id="addPregunta">Agregar Pregunta</button>
             </div>
             <div class="col-sm-12 " style="margin-top:5px;" id="preguntas">

             </div>
        </div>
    </div>
    <div class="col-sm-6"></div>
    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <button class="btn btn-success" id="save">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
</div>
</div>
<?php $route2 = route("cuestionarios.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<input type="hidden" value="{{$cuestionario->idCuestionario}}" id="id"/>
<input type="hidden" value="{{json_encode($preguntas)}}" id="preguntasValores"/>
<script src="{{ URL::asset('js/cuestionarios/edit.js'); }}"></script>        
@stop
 