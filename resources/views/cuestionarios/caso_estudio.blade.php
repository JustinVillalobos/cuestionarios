@extends('./layouts.home')
@section('content')  
<link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<link href="{{ URL::asset('css/caso.css'); }}" rel="stylesheet">

<style>
 
</style>
 <canvas id="projector">Your browser does not support the Canvas element.</canvas>
 <div class="flex-container" style="width:100%;height:100vh;padding-left:25px;">
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
          <h2 style="max-width:550px;">Caso de estudio: {{$cuestionario->titulo}}</h2>
        </div>
        <div class="col-sm-12"></div>
        <div class="col-sm-12 d-flex justify-content-center text-center">
          <input type="text" class="form-control input" style="width:230px;" placeholder="Ingresa un usuario" />
        </div>
        <div class="col-sm-12"></div>
        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:15px;">
           <div class="btn btn-three" id="demo" style="width:130px;">
            <span>Iniciar Caso</span>
          </div>
        </div>
      </div>
      
      
    </div>
    <div class="" id="case" style="display:none;">
        <div class="header d-flex justify-content-start">
            <img src="{{ URL::asset('assets/logo.png'); }}" style="width:150px;"/>
        </div>
        <!-- Slider main container -->
        <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <div class='swiper-bg'>

                </div>
                <div class='swiper-fe'>
                   <div class="row swip">
                        <div class="col-sm-4 d-flex align-items-center">
                            <div class="row " style="height: 75vh;">
                                <div class="col-sm-12 d-flex justify-content-start" style="padding-top:0px;padding-left:55px;">
                                    <h3><i class="fa fa-file"></i> Caso Estudio</h3>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-center" style="margin-top:5%;width:250px;height: 250px;">
                                    <img src="{{ URL::asset('assets/avatars/avatar'.$cuestionario->imagen.'.png'); }}" style="width:250px;height: 250px;"/>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 d-flex justify-content-start moreInfoTitle" style="margin-top:5%;padding-left:65px;">
                                        <label><strong>Información Adicional:</strong></label>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0x;padding-left:65px;">
                                        <label><strong>Género:</strong></label>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0px;padding-left:65px;">
                                        <label><strong>Edad:</strong></label>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0px;padding-left:65px;">
                                        <label><strong>Trabajo:</strong></label>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-start moreInfo" style="padding-top:0px;padding-left:60px;">
                                        <label><strong>¿Tiene Hijos?:</strong></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row" style="margin-top:15%;">
                                <div class="col-sm-3">
                                    <button class="btn btn-primary">Antecedentes</button>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary">Antecedentes</button>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary">Antecedentes</button>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary">Antecedentes</button>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
             </div>
            <div class="swiper-slide">Slide 2</div>
            <div class="swiper-slide">Slide 3</div>
            ...
        </div>
        
        
        </div>
    </div>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
 <script type="module">
  import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js'

  const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'vertical',
  loop: true,
  slidesPerView: 1,
  allowTouchMove:false,




});
//let swiper2 = document.querySelector('.swiper').swiper;

// Now you can use all slider methods like
//swiper2.slideNext();
</script>
 <script src="{{ URL::asset('js/cuestionarios/caso.js'); }}"></script>    
 @stop