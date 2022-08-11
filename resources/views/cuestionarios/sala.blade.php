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
                <li class="breadcrumb-item active" aria-current="page">Sala {{$cuestionario->titulo}}</li>
                
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;padding-left:5px;">
    <div class="col-sm-12 d-flex">
    <form action='{{route("cuestionarios.busquedaSala")}}' method="GET" class="d-flex"  style="margin: 0px;">
            @method("GET")
            @csrf
            <select name="limit" id="limit" class="form-select" style="width:80px;">
                <option <?php if($limit == 10){ echo "selected";}?>>10</option>
                <option <?php if($limit == 15){ echo "selected";}?>>15</option>
                <option <?php if($limit == 25){ echo "selected";}?>>25</option>
                <option <?php if($limit == 50){ echo "selected";}?>>50</option>
                <option <?php if($limit == 100){ echo "selected";}?>>100</option>
            </select>
            <select name="salaData" id="salaData" class="form-select" style="width:150px;">
                <option <?php if($salaData == 0){ echo "selected";}?> value="0">Todos</option>
                <option <?php if($salaData ==1){ echo "selected";}?> value="1">Actuales</option>
            </select>
            <input type="hidden"  id="idSala" value="{{$idSala}}" name="idSala" />
            <button type="submit" class="btn btn-success" style="margin-left:5px">
                <i class="fa fa-search"></i>
            </button>
                                        
        </form>
        <a href="../cuestionarios/{{$cuestionario->idCuestionario}}" class="btn btn-primary" style="margin-left:5px">
            <i class="fa fa-refresh"></i>
        </a>
        <button id="button" class="btn btn-info text-white" style="margin-left:5px">
            <i class="fa fa-play" aria-hidden="true"></i>
        </button>
    </div>
</div>
<div class="row" style="margin-top:15px;padding-left:5px;padding-bottom:15px;">
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Puntajes</div>
    </div>
   <div class="row" id="data_table">
        @include('../cuestionarios/table')
   </div>
</div>
</div>
<script src="{{ URL::asset('js/cuestionarios/sala.js'); }}"></script>        
@stop
 