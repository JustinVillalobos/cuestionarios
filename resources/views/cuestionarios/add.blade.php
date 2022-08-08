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
                <li class="breadcrumb-item active" aria-current="page">Agregar Caso de Estudio</li>
                
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
                 <input type="text" class="form-control" style="width:67%;" id="titulo"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Descripción del cuestionario:</label>
                 <textarea class="form-control" style="width:67%;" id="des"></textarea>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Edad:</label>
                 <input type="number" class="form-control" style="width:67%;" id="edad"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Género:</label>
                 <select class="form-select" style="width:67%;" id="genero">
                    <option value='0'>Hombre</option>
                    <option value='1'>Mujer</option>
                </select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Trabajo:</label>
                 <input type="text" class="form-control" style="width:67%;" id="trabajo"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Hijos:</label>
                 <input type="number" class="form-control" style="width:67%;" id="hijos" value="0"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Imagen:</label>
                 <select class="form-select" id="img" style="width:67%;">
                    <?php for($i=1;$i<24;$i++){ ?>
                    <option value="<?php echo $i;?>" data-active="0">Avatar <?php echo $i;?></option>
                    <?php } ?>
                 </select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        
    </div>
    <div class="col-sm-6 d-flex justify-content-center align-items-center">
        <div class="col-sm-12 d-flex justify-content-center align-items-center">
                        <img src="../assets/avatars/avatar1.png" id='profile' style="width:255px;"/>
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
                 <textarea class="form-control" style="width:100%;height:250px" id="antecedentesPersonales"></textarea>
                 <span id="antecedentePersonalSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">Antecedentes Familiares:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;height:350px">
                 <textarea class="form-control" style="width:100%;height:250px" id="antecedentesFamiliares"></textarea>
                 <span id="antecedentesFamiliaresSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">M&oacutetivo Consulta:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;height:350px">
                 <textarea class="form-control" style="width:100%;height:250px" id="motivo"></textarea>
                 <span id="motivoSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-2 form-inline text-end" style="padding-right:0px;">
                <label class="text-danger font-weight-bold" style="justify-content: end; margin-right: 5px;">Revisi&oacuten:</label>
            </div>
            <div class="col-sm-10 form-inline text-end" style="padding-left:0px;height:350px">
                 <textarea class="form-control" style="width:100%;height:250px" id="revision"></textarea>
                 <span id="revisionSpan" class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">PREGUNTAS</div>
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
<script src="{{ URL::asset('js/cuestionarios/add.js'); }}"></script>        
@stop
 