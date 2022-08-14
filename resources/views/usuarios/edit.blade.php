@extends('./layouts.admin')
@section('content')  
<div class="container">
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href='{{route("usuarios.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Usuarios</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
                
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;padding-left:5px;">
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Usuario:</label>
                 <input type="text" class="form-control" style="width:67%;" id="usuario" value="{{$usuario->usuario}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Contraseña:</label>
                 <input type="text" class="form-control" style="width:67%;" id="pass" value="{{$usuario->contrasenia}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Autor:</label>
                 <input type="text" class="form-control" style="width:67%;" id="autor" value="{{$usuario->autor}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6"></div>
    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <input type="hidden" value="{{$usuario->idUsuario}}" id="id"/>
        <button class="btn btn-success">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
</div>
</div>
<?php $route2 = route("usuarios.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/usuarios/edit.js'); }}"></script>        
@stop
 