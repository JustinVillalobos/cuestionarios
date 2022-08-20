@extends('./layouts.home')
@section('content')  
<link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<link href="{{ URL::asset('css/caso.css'); }}" rel="stylesheet">

<style>
 
</style>
 <canvas id="projector">Your browser does not support the Canvas element.</canvas>
 <div class="flex-container custom" style="width:100%;height:100vh;padding-left:25px;">
    <div class="header d-flex justify-content-start header2" style="margin-top:55px;">
      <div class="row" style="width: 100%;"> 
        <div class="col-sm-12 d-flex justify-content-center">
            <img src="{{ URL::asset('assets/logo.png'); }}" style="width:350px;"/>
        </div>
      </div>
    </div>
    <div class="pseudo-body">
      <div class="row">
         <div class="col-sm-12 d-flex justify-content-center text-center text-white" style="margin-bottom:25px;">
          <h2 style="max-width:550px;">{{$cuestionario->titulo}}</h2>
        </div>
        <div class="col-sm-12"></div>
        <div class="col-sm-12 d-flex justify-content-center text-center">
          <input type="text" class="form-control input" id="usuario" style="width:230px;" placeholder="Ingresa un usuario" />
        </div>
        <div class="col-sm-12"></div>
        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:15px;">
           <div class="btn btn-three" id="demo" style="width:130px;">
            <span>Iniciar</span>
          </div>
        </div>
      </div>
      
      
    </div>
    <div class="" id="case" style="display:none;">
        <div class="header">
           <div class="row">
                <div class="col-sm-3">
                    <img src="{{ URL::asset('assets/logo.png'); }}" style="width:200px;"/>
                </div>
                <div class="col-sm-6"></div>
                <div class="col-sm-3 d-flex justify-content-end align-items-center" style="padding-right:25px;">
                <div class=" control2 dropdown" >
                    <div class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-music"></i></div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="    left: -100px!important;">
                      <input type="range" min="0" max="1" value="1" step="0.1" id="mislider"><span id="valor"></span>
                    </div>
                </div>
                    <div class=" control right-control" id="btn-next" onclick="next()">
                        <svg class="spinnerDiv" viewBox="0 0 50 50">
                            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                        </svg>
                        <span><i class="fa fa-arrow-right"></i></span>
                    </div>
                </div>
           </div>
        </div>
                <div class='swiper-bg'>

                </div>
                <div class='swiper-fe'>
                   <div class="row swip">
                        <div class="col-sm-4 d-flex align-items-center">
                            <div class="row row-data-info" style="height: 75vh;">
                                <div class="col-sm-12 d-flex justify-content-start" style="padding-top:0px;padding-left:55px;">
                                    <h3 id="title"><i class="fa fa-user-md text-primary" aria-hidden="true"></i>Net<span class="text-primary2">Challenge</span></h3>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-start c-i" style="margin-top:5%;width:250px;height: 250px;    padding-left: 50px;">
                                    <?php $img=strlen($cuestionario->imagen);?>
                                    @if($img < 3)
                                        <img src="{{ URL::asset('assets/avatars/avatar'.$cuestionario->imagen.'.png'); }}" style="width:250px;height: 250px;"/>
                                    @endif
                                    @if($img >= 3)
                                        <img src="{{ URL::asset($cuestionario->imagen); }}" style="width:250px;height: 250px;"/>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 d-flex justify-content-start moreInfoTitle" style="margin-top:5%;padding-left:65px;">
                                        <label><strong>Información Adicional:</strong></label>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0x;padding-left:65px;">
                                        <label><strong>Género:</strong>
                                            @if($cuestionario->genero=="0")
                                                Hombre
                                            @endif
                                            @if($cuestionario->genero!="0")
                                                Mujer
                                            @endif

                                        </label>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0px;padding-left:65px;">
                                        <label><strong>Edad:</strong>{{$cuestionario->edad}}</label>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0px;padding-left:65px;">
                                        <label><strong>Trabajo:</strong>{{$cuestionario->trabajo}}</label>
                                    </div>
                                    @if($cuestionario->genero=="0")
                                                
                                            @endif
                                            @if($cuestionario->genero!="0")
                                            <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0px;padding-left:60px;">
                                                <label><strong>¿Tiene Hijos?:</strong>
                                                    @if($cuestionario->hijos=="" || $cuestionario->hijos=="0")
                                                        No
                                                    @endif
                                                    @if($cuestionario->hijos!="" && $cuestionario->hijos!="0")
                                                        $cuestionario->hijos
                                                    @endif
                                                </label>
                                            </div>
                                            @endif
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8" id="body-slide">
                            
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide"  style="overflow-y: auto;overflow-x:none;">
                                    <div class="row div-row-slid-init" style="">
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary btn-hecho" onclick="showData(0)">Antecedentes Personales</button>
                                            <div class="div-icon data0" id="data0" >
                                                <span class="icon-check "><i class="fa fa-check-circle text-success"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary btn-hecho" onclick="showData(1)">Antecedentes Familiares</button>
                                            <div class="div-icon data1" id="data1" style="display:none">
                                                <span class="icon-check "><i class="fa fa-check-circle text-success"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary btn-hecho" onclick="showData(2)">Motivo De Consulta</button>
                                            <div class="div-icon data2" id="data2" style="display:none">
                                                <span class="icon-check "><i class="fa fa-check-circle text-success"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary btn-hecho" onclick="showData(3)">Revisión</button>
                                            <div class="div-icon data3" id="data3" style="display:none">
                                                <span class="icon-check "><i class="fa fa-check-circle text-success"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row card-data show0" id="show0" style="margin-top: 10%;display:none" >
                                        <div class="col-sm-12"><h3 class="subtitle">Antecedentes Personales</h3></div>
                                        @if($cuestionario->seccion==1)
                                        <div class="col-sm-12 bodyData">
                                            <div class="row">
                                                <div class="col-sm-5"><img src="{{URL::asset($cuestionario->imagenSeccion)}}" style="width:100%;"></div>
                                                <div class="col-sm-7">{!! $cuestionario->antecedentesPersonales !!}</div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($cuestionario->seccion!=1)
                                            <div class="col-sm-12 bodyData">{!! $cuestionario->antecedentesPersonales !!}</div>
                                        @endif
                                    </div>
                                    <div class="row card-data show1" id="show1" style="margin-top: 10%;display:none">
                                        <div class="col-sm-12"><h3 class="subtitle">Antecedentes Familiares</h3></div>
                                        @if($cuestionario->seccion==2)
                                        <div class="col-sm-12 bodyData">
                                            <div class="row">
                                                <div class="col-sm-5"><img src="{{URL::asset($cuestionario->imagenSeccion)}}" style="width:100%;"></div>
                                                <div class="col-sm-7">{!! $cuestionario->antecedentesFamiliares !!}</div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($cuestionario->seccion!=2)
                                            <div class="col-sm-12 bodyData">{!! $cuestionario->antecedentesFamiliares !!}</div>
                                        @endif
                                    </div>
                                    <div class="row card-data show2" id="show2" style="margin-top: 10%;display:none">
                                        <div class="col-sm-12"><h3 class="subtitle">Motivos De Consulta</h3></div>
                                        @if($cuestionario->seccion==3)
                                        <div class="col-sm-12 bodyData">
                                            <div class="row">
                                                <div class="col-sm-5"><img src="{{URL::asset($cuestionario->imagenSeccion)}}" style="width:100%;"></div>
                                                <div class="col-sm-7">{!! $cuestionario->motivoConsulta !!}</div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($cuestionario->seccion!=3)
                                            <div class="col-sm-12 bodyData">{!! $cuestionario->motivoConsulta !!}</div>
                                        @endif
                                    </div>
                                    <div class="row card-data show3" id="show3" style="margin-top: 10%;display:none">
                                        <div class="col-sm-12"><h3 class="subtitle">Revisi&oacuten</h3></div>
                                        @if($cuestionario->seccion==4)
                                        <div class="col-sm-12 bodyData">
                                            <div class="row">
                                                <div class="col-sm-5"><img src="{{URL::asset($cuestionario->imagenSeccion)}}" style="width:100%;"></div>
                                                <div class="col-sm-7">{!! $cuestionario->revision !!}</div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($cuestionario->seccion!=4)
                                            <div class="col-sm-12 bodyData">{!! $cuestionario->revision !!}</div>
                                        @endif
                                    </div>
                            </div>
                            @foreach($preguntas as $key =>$p)
                             @include('../cuestionarios/pregunta')
                            @endforeach
                            <div class="swiper-slide" id="slideFinal">
                                <div class="row final" style="margin-top: 12%;">
                                    <div class="col-sm-12 "><strong>Resultado</strong></div>
                                    <div class="col-sm-12 final-col"></div>
                                    <div class="col-sm-12 d-flex justify-content-center" style="margin-top:25px;">
                                    <button class="btn btn-primary btn-hecho" style="width:200px!important;"onclick="reinitSala()">Salir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
 <input type="hidden" value="{{$cuestionario->codigo}}" id="codigo" />
 <input type="hidden" value="{{$randomCodigo}}" id="randomCodigo" />
 <input type="hidden" value="{{$cuestionario->codigo}}" id="idCuestionario" />
 <audio src="{{ URL::asset('assets/acierto.mp3'); }}" id="correct"></audio>
 <audio src="{{ URL::asset('assets/incorrecto.mp3'); }}" id="incorrect"></audio>
 @foreach($preguntas as $key =>$p)
 @include('../cuestionarios/modal')
 @endforeach
 <div class="modal fade" id="visor">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Visor</h4>
        <button type="button" class="close" data-dismiss="modal" style="font-size: 24px;">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="overflow-y: auto;overflow-x: hidden;">
        <div class="row">
                <div class="col-sm-12 ayuda">
                    <img src="" id="visorI" style="    width: 100%;">
                </div>
                
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-modal" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
 <input type="hidden" value="{{count($preguntas)}}" id="cantidad"/>
 <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
 <script type="module">
  import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js'

  const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'vertical',
  loop: false,
  slidesPerView: 1,
  allowTouchMove:false,
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
  on: {
    reachEnd: function () {
      let html="";
        html = setCards(preguntas);
        $(".final-col").html(html);
    },
}

});
//let swiper2 = document.querySelector('.swiper').swiper;

// Now you can use all slider methods like
//swiper2.slideNext();
</script>
 <script src="{{ URL::asset('js/cuestionarios/caso.js'); }}"></script>    
 @stop