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
    <a href='{{route("cuestionarios.show", [$cuestionario])}}' class="btn btn-warning text-white" style="margin-left:5px">
            <i class="fa fa-chevron-left"></i>
        </a>
    <select name="limit" id="type" class="form-select" style="width:185px;margin-left:5px">
        <option value="bar_h">Barras Horizontales</option>
        <option value="bar">Barras Verticales</option>
        <option value="pie">Pastel</option>
    </select>
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
       
   </div>
</div>
</div>
<div class="modal fade" id="modal" >
  <div class="modal-dialog modal-dialog-centered" style="width: 100%;max-width: 100%;height: 93vh;max-height: 93vh;">
    <div class="modal-content" style="height: 55vh;background: #edecf0;">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" onclick="closeModal()" style="font-size: 24px;">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="overflow-y: auto;overflow-x: hidden;    overflow-y: auto;width: 100%;justify-content: center;">
        <div class="row" id='modal-row' style="height:300px">
              
                
        </div>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 d-flex justify-content-end">
            <button class="btn btn-primary" onclick="beforeModal()" style="margin-right:5px;"><i class="fa fa-chevron-left"></i></button>
                <button class="btn btn-primary" onclick="nextModal()"><i class="fa fa-chevron-right"></i></button>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>
<?php $route2 = route("cuestionarios.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<input type="hidden" value="{{ json_encode($puntajes_preguntas)}}" id="values" />
<input type="hidden" value="{{ json_encode($preguntas)}}" id="preguntas" />
<input type="hidden" value="{{$cuestionario->idCuestionario}}" id="idCuestionario" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.0/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.js" ></script>
<script src="{{ URL::asset('js/cuestionarios/graficos.js'); }}"></script>        
@stop
 