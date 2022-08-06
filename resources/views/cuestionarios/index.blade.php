@extends('./layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><h5><i class="fa fa-book" aria-hidden="true"></i>Cuestionarios</h5></li>
                
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
<div class="col-sm-6" style="padding-left:15px;">
        <a href="/cuestionarios/create" class="btn btn-primary" style="margin-left:5px;height:35px;">
                <i class="fa fa-plus"></i> Agregar Cuestionario
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
        <a href="/cuestionarios" class="btn btn-primary" style="margin-left:5px">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th>titulo</th>
                    <th>Fecha Creación</th>
                    <th>Disponibilidad</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuestionarios as $nivel)
                    <tr>
                        <td>{{$nivel->titulo}}</td>
                        <td><?php echo date_format($nivel->fechaCreacion,"d-m-Y");?></td>
                        <td>
                            @if($nivel->disponible==1)
                                Disponible
                            @endif
                            @if($nivel->disponible==2)
                                No Disponible
                            @endif
                        </td>
                        <td style="width:125px;" class="d-flex justify-content-center">
                            
                            <form action='{{route("cuestionarios.edit", [$nivel])}}' method="post" >
                                @method("get")
                                @csrf
                                <button type="submit" class="btn btn-warning text-white" style="margin-left:5px;width:25px;height:29px;">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>
                            <button type="submit" class="btn btn-success" style="margin-left:5px;" onclick="copyCode('{{$nivel->codigo}}')">
                                 <i class="fa fa-clipboard"></i>
                            </button>
                            <?php $route = route("cuestionarios.caso_estudio",[$nivel->codigo]);?>
                            <button type="submit" class="btn btn-primary" style="margin-left:5px;" onclick='copyLink("<?php echo $route;?>")'>
                                 <i class="fa fa-link"></i>
                            </button>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;">
        {{ $cuestionarios->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
   
</div>
 
<script src="{{ URL::asset('js/cuestionarios/list.js'); }}"></script>     
@stop