@extends('./layouts.home')
@section('content')  

 <canvas id="projector">Your browser does not support the Canvas element.</canvas>
 <div class="flex-container" style="width:100%;height:100vh;padding-top:50px;">
    <div class="header d-flex justify-content-center">
      <img src="{{ URL::asset('assets/logo.png'); }}"/>
    </div>
    <div class="pseudo-body">
      <div class="row justify-content-center">
        <div class="col-sm-12 d-flex justify-content-center text-center text-danger text-error">
             {{$errors}}
        </div>
        <form method="POST" action="{{route('cuestionarios.sala')}}" id="search-form" name="search-form">
                            @method("POST")
                                @csrf
            <div class="col-sm-12 d-flex justify-content-center text-center">
              <input type="text" class="form-control input" style="width:230px;" name="code" placeholder="Ingresa el código" />
            </div>
            <div class="col-sm-12 d-flex justify-content-center" style="margin-top:15px;">
              <div type="submit" class="btn btn-three" id="demo" onclick="submit()">
                <span>Ingresar</span>
              </div>
            </div>
          </form>
      </div>
      
      
    </div>
 </div>
 <script>
  function submit(){
    document.forms['search-form'].submit();
  }
 </script>
 @stop