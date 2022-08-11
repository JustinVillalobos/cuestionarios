<div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th style="width:300px;">Participante</th>
                    <th>Puntaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($puntajes as $nivel)
                    <tr>
                        <td class="d-flex justify-content-center align-items-center" style="width:300px;">
                            {{$nivel->nombre}}
                        </td>
                        
                        <td>
                            <div class="progress" style="height: 35px;font-size: 15px;font-weight: bold;">
                                    @if($nivel->puntajeCorrecto>0)
                                        <?php $puntaje =($nivel->puntajeCorrecto/($cantidad))*100; ?>
                                        <?php
                                            if($puntaje<45){
                                                $class="bg-danger text-start";
                                            }else if($puntaje<70){
                                                $class="bg-warning text-end";
                                            }else{
                                                $class="bg-primary text-end"; 
                                            }

                                        ?>
                                        <div class="progress-bar <?php echo $class;?>" role='progressbar' style='width:{{($nivel->puntajeCorrecto/($cantidad))*100 }}%'>
                                            
                                            <label>{{intVal(($nivel->puntajeCorrecto/($cantidad))*100) }}%

                                                @if($puntaje==100)
                                                    <span class="text-warning"><i class='i i-crown'></i></span>
                                                @endif
                                            </label>
                                        </div>
                                        
                                    @endif
                                    @if($nivel->puntajeCorrecto==0)
                                        <div class="progress-bar" role='progressbar' style='width:'>
                                            0%
                                        </div>
                                    @endif
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;">
        {{ $puntajes->links('vendor.pagination.bootstrap-4') }}
    </div>