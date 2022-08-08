@extends('./layouts.home')
@section('content')  

 <canvas id="projector">Your browser does not support the Canvas element.</canvas>
 <div class="flex-container" style="width:100%;height:100vh;padding-top:50px;">
    <div class="header d-flex justify-content-center">
      <img src="{{ URL::asset('assets/logo.png'); }}"/>
    </div>
    <div class="pseudo-body">
      <div class="row">
        <div class="col-sm-12 d-flex justify-content-center text-center">
          <input type="text" class="form-control input" style="width:230px;" placeholder="Ingresa el código" />
        </div>
        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:15px;">
           <div class="btn btn-three" id="demo">
            <span>Ingresar</span>
          </div>
        </div>
      </div>
      
      
    </div>
 </div>
 @stop