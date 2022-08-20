<div class="swiper-slide" id="slide{{$key}}" style="overflow-y: auto;overflow-x:none;">
                                    <div class="row div-slide-{{$key}}" style="margin-top: 1%;width: 97%;">
                                        <div class="col-sm-12">
                                            <?php if($key<9){$zero="0";}else{$zero="";}?>
                                            <h3 class="pregunta">Pregunta <span class="text-primary">{{$zero."".($key+1)}}</span></h3>
                                            <h3 class="preguntaText">{{$p->pregunta}}</h3>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:25px;">
                                            <div class="row response" onclick="response({{$key}},0)">
                                                <div class=" col-sm-1 number-response bg-primary">A</div>
                                                <div class=" col-sm-10 text-response  response{{$key}}0" id="response{{$key}}0">{{$p->respuesta1}}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:35px;">
                                            <div class="row response" onclick="response({{$key}},1)" >
                                                <div class=" col-sm-1 number-response bg-primary">B</div>
                                                <div class=" col-sm-10 text-response response{{$key}}1"id="response{{$key}}1">{{$p->respuesta2}}</div>
                                            </div>
                                        </div>
                                        @if($p->respuesta3!="")
                                        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:35px;">
                                            <div class="row response" onclick="response({{$key}},2)">
                                                <div class=" col-sm-1 number-response bg-primary">C</div>
                                                <div class=" col-sm-10 text-response response{{$key}}2" id="response{{$key}}2">{{$p->respuesta3}}</div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($p->respuesta4!="")
                                        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:35px;">
                                            <div class="row response" onclick="response({{$key}},3)">
                                                <div class=" col-sm-1 number-response bg-primary">D</div>
                                                <div class=" col-sm-10 text-response response{{$key}}3" id="response{{$key}}3">{{$p->respuesta4}}</div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-sm-12 d-flex justify-content-center" style="margin-top:35px;">
                                            <button id="demo{{$key}}" class="btn btn-primary btn-response btn-res btn-res{{$key}}" disabled onclick="responseQuestion({{$key}},{{$p->solucion}})">Comprobar</button>
                                        </div>
                                        <div class="col-sm-12 details-div" >
                                            <div class="row" style="width: 95%;">
                                                <div class="col-sm-9 definiciones">
                                                    {!! $p->definiciones!!}
                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-primary btn-response btn-informacion " data-toggle="modal" data-target="#modal{{$key}}">Información Adicional</button>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row div-det div-punt-{{$key}}" style="margin-top: 12%;display:none;width: 97%;">
                                     <div class="col-sm-12 "><h3 class="pregunta"><strong>Puntajes</strong></h3></div>
                                        <div class="col-sm-12">
                                            <div class="row data_table" id="data_table"></div>
       
        
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-center" style="margin-top: 10px;">
                                            <button class="btn btn-primary btn-hecho" style="width:200px!important;"onclick="showDetails({{$key}})">Ver Detalles</button>
                                        </div>
                                    </div>
                                    <div class="row div-det div-det-{{$key}}" style="margin-top: 12%;display:none;width: 97%;">
                                     <div class="col-sm-12 "><h3 class="pregunta"><strong>Detalles</strong></h3></div>
                                        <div class="col-sm-12">
                                            {!! $p->detalles !!}
                                        </div>
                                    </div>
                                </div>