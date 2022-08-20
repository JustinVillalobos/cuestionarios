@extends('./layouts.admin')
@section('content')  
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://unpkg.com/qrious@4.0.2/dist/qrious.js"></script>
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><h5><i class="fa fa-book" aria-hidden="true"></i>Casos De Estudio</h5></li>
                
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    <div class="col-sm-6" style="padding-left:15px;">
        <a href='{{route("cuestionarios.create")}}' class="btn btn-primary" style="margin-left:5px;height:35px;">
                <i class="fa fa-plus"></i> Agregar Caso De Estudio
        </a>
    </div>
    <div class="col-sm-6 d-flex justify-content-end" style="margin-bottom:20px;height:35px;padding:0px 20px 0px 20px;">
        <form action='{{route("cuestionarios.busqueda")}}' method="GET" class="d-flex"  style="margin: 0px;">
            @method("GET")
            @csrf
            <select name="limit" class="form-select" style="width:80px;">
                <option <?php if($limit == 10){ echo "selected";}?>>10</option>
                <option <?php if($limit == 15){ echo "selected";}?>>15</option>
                <option <?php if($limit == 25){ echo "selected";}?>>25</option>
                <option <?php if($limit == 50){ echo "selected";}?>>50</option>
                <option <?php if($limit == 100){ echo "selected";}?>>100</option>
            </select>
            <input type="text" name="search" value="<?php echo $search;?>" class="form-control"  placeholder="Buscar..." style="margin-left:5px;width:67%"/>
            <button type="submit" class="btn btn-success" style="margin-left:5px">
                <i class="fa fa-search"></i>
            </button>
                                        
        </form>
        <a href="./cuestionarios" class="btn btn-primary" style="margin-left:5px">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
    <div class="col-sm-12 d-flex justify-content-center table-responsive" style="width: 90%;padding-left: 200px;">
        <table class="table table-bordered " style="margin-bottom:3px;width:100%">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>titulo</th>
                    <th>Fecha Creación</th>
                    <th>Disponibilidad</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuestionarios as $nivel)
                    <tr>

                        <td class="d-flex justify-content-center align-items-center">
                            <?php $img=strlen($nivel->imagen);?>
                                    @if($img < 3)
                                        <img src="{{ URL::asset('assets/avatars/avatar'.$nivel->imagen.'.png'); }}" style="width:55px;height:55px;"/>
                                    @endif
                                    @if($img >= 3)
                                        <img src="{{ URL::asset($nivel->imagen); }}" style="width:55px;height:55px;"/>
                                    @endif
                        </td>
                        <td ><div class="d-flex align-items-center">{{$nivel->titulo}}</div></td>
                        <td ><div class="d-flex justify-content-center align-items-center"><?php echo date_format($nivel->fechaCreacion,"d-m-Y");?></div></td>
                        <td >
                            <div class="d-flex justify-content-center align-items-center">
                            @if($nivel->disponible==1)
                                Disponible
                            @endif
                            @if($nivel->disponible==2)
                                No Disponible
                            @endif
                            </div>
                        </td>
                        <td style="width:125px;" >
                            <div class="d-flex justify-content-center align-items-center" style="height: 55px">
                                <form action='{{route("cuestionarios.show", [$nivel])}}' method="post" >
                                    @method("get")
                                    @csrf
                                    <button type="submit" class="btn btn-primary text-white" style="margin-left:5px;width:25px;height:29px;" titel="SALA">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </form>
                                    <button type="submit" class="btn btn-warning text-white" style="margin-left:5px;width:25px;height:29px;" data-toggle="modal" data-target="#myModal" onclick="changeStatus('{{$nivel->codigo}}','{{$nivel->disponible}}','{{$nivel->titulo}}')">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <?php $route = route("cuestionarios.caso_estudio")."?code=".$nivel->codigo;?>
                                <button type="submit" class="btn btn-info text-white" style="margin-left:5px;width:25px;height:29px;" onclick='copyQR("<?php echo $route;?>")'>
                                    <i class="fa fa-qrcode"></i>
                                </button>
                                <button type="submit" class="btn btn-success" style="margin-left:5px;width:25px;height:29px;" onclick="copyCode('{{$nivel->codigo}}')">
                                    <i class="fa fa-clipboard"></i>
                                </button>
                               
                                <button type="submit" class="btn btn-primary" style="margin-left:5px;width:25px;height:29px;" onclick='copyLink("<?php echo $route;?>")'>
                                    <i class="fa fa-link"></i>
                                </button>
                                <button type="submit" class="btn bg-primary2 text-white" style="margin-left:5px;width:25px;height:29px;" onclick='copyIframe("<?php echo $route;?>")'>
                                    <i class="fa fa-picture-o"></i>
                                </button>
                                
                                    <button type="submit" class="btn btn-danger text-white" style="margin-left:5px;width:25px;height:29px;" onclick="return validate(event,this,'{{$nivel->codigo}}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;">
        {{ $cuestionarios->links('vendor.pagination.bootstrap-4') }}
    </div>
    <div class="col-sm-12 d-none" style="padding:0px 20px 10px 20px;" >
    <img alt="Código QR" id="codigo">
    </div>
</div>
<?php $route2 = route("cuestionarios.index");?>
<input type="hidden" value="{{$route2}}" id="route" />

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Cambiar Estado Caso de Estudio</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="row">
            <div class="col-sm-12"><h5>Caso De estudio</h5></div>
            <div class="col-sm-12"><h6 id='case'></h6></div>
            <div class="col-sm-12">
                <select id="state" class="form-select">
                    <option value="1">Disponible</option>
                    <option value="2">No Disponible</option>
                </select>
            </div>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  onclick="updateState()">Actualizar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{ URL::asset('js/cuestionarios/list.js'); }}"></script>     

@stop