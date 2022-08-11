var antecedentesPersonales = document.getElementById('antecedentesPersonales');
var antecedentesFamiliares = document.getElementById('antecedentesFamiliares');
var motivo = document.getElementById('motivo');
var revision = document.getElementById('revision');
var detalles = document.getElementById('detalles');
var ayuda = document.getElementById('ayuda');
var definiciones = document.getElementById('definiciones');
let optionsSCeditor = {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|image|font,removeformat|copy,cut,paste|bulletlist,orderedlist',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
}
sceditor.create(antecedentesPersonales,optionsSCeditor);
sceditor.create(antecedentesFamiliares, optionsSCeditor);


sceditor.create(motivo,optionsSCeditor);


sceditor.create(revision, optionsSCeditor);
sceditor.create(detalles, optionsSCeditor);
sceditor.create(ayuda, optionsSCeditor);
sceditor.create(definiciones,optionsSCeditor);
let indice=1;
function format (option) {
    if (!option.id) { return option.text; }
    let text =option.text;
    let name = text.trim();
    name=name.toLowerCase();
    name=name.replace(" ","");
    var ob = option.text + '<img src="../assets/avatars/'+name+'.png" style="width:35px;"/>';	
    indice++;
    if(indice>23){
        indice=1;
    }
    return ob;
};


$( document ).ready(function() {
    $("#img").select2({
        placeholder: "Select something!!",
      width: "50%",
      allowClear: true,
      templateResult: format,
      templateSelection: function (option) {
          if (option.id.length > 0 ) {
              return option.text + "<i class='fa fa-dot-circle-o'></i>";
          } else {
              return option.text;
          }
      },
      escapeMarkup: function (m) {
              return m;
          }
    });
    let $eventSelect=$("#img");
    $eventSelect.on("select2:select", function (e) {  selectImg();});
    if(localStorage.getItem('indice')!=undefined){
        if(localStorage.getItem('indice')!=''){
            indicePregunta = 1;
           
            preguntas = JSON.parse(localStorage.getItem('preguntas'));
            
            console.log("INGRESO INICIO",preguntas);
            preguntas.forEach(element => {
                addPregunta(indicePregunta,element.pregunta,element.detalles,element.ayuda,element.definiciones);
                indicePregunta++;
               
            });
            $("#preguntas").append(html);
            console.log("HILO");
            indicePregunta = 1;
            preguntas.forEach(element => {
                if(element.respuestas.length!=0){
                    element.respuestas.forEach((resp,indexRespuesta) => {
                        respuesta((indicePregunta-1),indicePregunta,resp.respuesta,indexRespuesta);
                    });
                }
                indicePregunta++;
            });
           
            html="";
        }
    }
    desplaceTop();
    var $avatarImage,$avatarInput,$avatarForm;
    $avatarInput = $("#file");
    $avatarForm = $("#form");
    
    $avatarInput.on('change',function(){
        //uploadImage();
    });
});
let indicePregunta=1;
let preguntas=[];
let html="";
function uploadImage(cuestionario,cantidadErrores,isValid){
    var $avatarImage,$avatarInput,$avatarForm;
    $avatarInput = $("#file");
    $avatarForm = $("#form");
    var formData = new FormData();
        $avatarImage = $avatarInput[0].files[0];
        console.log($avatarImage.type);
        if( $avatarInput[0].files>1){
            $("#file + span").text("Solo se permite subir una imagen");
            $("#file").val("")
            return;
        }
        if($avatarImage.size>1000000){
            $("#file + span").text("Tamaño de la imagen muy grande");
            $("#file").val("")
            return;
        }
        if($avatarImage.type!="image/jpeg" && $avatarImage.type!="image/png" && $avatarImage.type!="image/jpg" && $avatarImage.type!="image/svg" && $avatarImage.type!="image/gif"){
            $("#file + span").text("Formato de archivo no aceptado, solo permitido PNG,JPG,JPEG,GIF,SVG");
            $("#file").val("")
            return;
        }
        $("#file + span").text("");
        formData.append('image',$avatarInput[0].files[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:'../cuestionarios/imagen',
            data:formData,
            processData:false,
            contentType:false,
            success:function(data){
                console.log(data);
                save(data,cuestionario,cantidadErrores,isValid);
        
            },
            error:function(data){
                console.log("ERROR",data);
                alertError("Error inesperado en el servidor");
            }
        
         });
}
function reload(){
    if(localStorage.getItem('indice')!=undefined){
        if(localStorage.getItem('indice')!=''){
            $("#preguntas").html("");
            indicePregunta = 1;
           
            preguntas = JSON.parse(localStorage.getItem('preguntas'));
            
            console.log("INGRESO INICIO",preguntas);
            preguntas.forEach((element,i) => {
                preguntas[i].indice = i;
                addPregunta(indicePregunta,element.pregunta,element.detalles,element.ayuda,element.definiciones);
                indicePregunta++;
               
            });
            $("#preguntas").append(html);
            console.log("HILO");
            indicePregunta = 1;
            preguntas.forEach(element => {
                if(element.respuestas.length!=0){
                    element.respuestas.forEach((resp,indexRespuesta) => {
                        respuesta((indicePregunta-1),indicePregunta,resp.respuesta,indexRespuesta);
                    });
                }
                indicePregunta++;
            });
           
            html="";
            localStorage.setItem('indice',indicePregunta);
            localStorage.setItem('preguntas',JSON.stringify(preguntas));
        }
    }
}
function remove(indice){
    if(preguntas.length==1){
        preguntas.splice(0,1);
    }
    preguntas.forEach((e,i) => {
        console.log(e.indice,indice);
        if((e.indice)==indice){
            preguntas.splice(i,1);
        }
    });
   
    let divs = $("#preguntas .pregunta");
    $("#pregunta"+indice).remove();

    console.log(preguntas,indice);
    divs = $("#preguntas .pregunta");
    divs.each((i,element) => {
        let id=$(element).attr('id');
        $("#"+id+" .section .col-sm-11").html("Pregunta #"+(i+1)+":"+preguntas[i].pregunta);
    });   
    localStorage.setItem('indice',indicePregunta);
    localStorage.setItem('preguntas',JSON.stringify(preguntas));
}
function addPregunta(i,pregunta,de,ay,def){
    console.log(de);
    html+="<div class='col-sm-12 pregunta' id='pregunta"+i+"' style='padding:10px 20px 10px 20px;margin-top:20px;'>";
        html+="<div class='row section'>";
            html+="<div class='col-sm-11 mouse-over' data-toggle='collapse' data-target='#collapseExample"+i+"' aria-expanded='false' aria-controls='collapseExample'>";
                html+="<strong>Pregunta #"+i+":</strong>"+pregunta;
            html+="</div>";
            html+="<div class='col-sm-1 d-flex justify-content-end align-items-center'>";
                html+="<button class='btn btn-danger text-center d-flex justify-content-center align-items-center' style='height:25px;width:25px;' onclick='remove("+i+")'><i class='fa fa-trash'></i></button>";
            html+="</div>";
        html+="</div>";
        html+="<div class='collapse' id='collapseExample"+i+"'><div class='row' style='width: 99%;margin-top:5px;'>";
            html+="<div class='col-sm-12'>";
            html+="<div class='row'><div class='col-sm-12'><h3>Detalles<h3></div></div>";
                html+="<div class='row'><div class='col-sm-12'>"+de+"</div></div>";
            html+="</div>";
            html+="<div class='row'><div class='col-sm-12'><h3>Información adicional<h3></div></div>";
                html+="<div class='row'><div class='col-sm-12'>"+ay+"</div></div>";
            html+="<div class='row'><div class='col-sm-12'><h3>Definiciones<h3></div></div>";
            html+="<div class='row'><div class='col-sm-12'>"+def+"</div></div>";
        html+="</div>";
            html+="<div class='row'><div class='col-sm-11'>";
                html+="<div class='row d-flex justify-content-center align-items-center'><div class='col-sm-4 d-flex justify-content-center align-items-center'><strong>Nueva Respuesta:</strong></div><div class='col-sm-8 d-flex justify-content-center align-items-center'><input type='text' class='form-control' id='respuesta"+i+"'/></div></div>";
            html+="</div>";
            html+="<div class='col-sm-1 d-flex justify-content-center align-items-center'>";
                html+="<button class='btn btn-success text-center d-flex justify-content-center align-items-center' style='height:25px;width:25px;' onclick='addResponse("+i+")'><i class='fa fa-plus'></i></button>";
            html+="</div>";
        html+="</div>";
        html+="<div class='row' style='width: 99%;margin-top:5px;margin-left: 10px;' id='respuestas"+i+"'>";
            html+="<div class='row section'>";
                html+="<div class='col-sm-12'>";
                    html+="<strong>Respuestas</strong>";
                html+="</div>";
            html+="</div>";
            html+="<div class='row append'>";
            html+="</div>"
            html+="<div class='row section' style='margin-top:15px;'>";
                html+="<div class='col-sm-12'>";
                    html+="<strong>Solución</strong>";
                html+="</div>";
            html+="</div>";
            html+="<div class='row solucion'>";
                html+="<div class='col-sm-12'><label>Solución de pregunta:</label></div>";
                html+="<div class='col-sm-12'><select class='form-select' id='solucion"+i+"'></select></div>";
            html+="</div>"
        html+="</div>";
    html+="</div></div>";
}
function respuesta(ind,indice,resp,i){
     let html2="";
    if(preguntas[(ind)].respuestas.length<=4){
        if(resp.length<=0){
            return;
        }
       
      
        html2+="<div class='r"+i+" col-sm-11' style='margin-top:5px;'><strong>Respuesta #"+(i+1)+":</strong>"+resp+"</div>";
        html2+="<div class='r"+i+" col-sm-1' style='margin-top:5px;'><button class='btn btn-danger' onclick='removeRespuesta("+indice+","+i+")'><i class='fa fa-trash'></i></button></div>";
        console.log( $('#respuestas'+indice+" .append"),'#respuestas'+indice);
        $('#respuestas'+indice+" .append").append(html2);
        html2="";
        html2="<option value='"+(i)+"'>"+resp+"</option>";
        $(".solucion #solucion"+indice).append(html2);
        html2="";
    }else{
        alertError("No se puede agregar mas respuestas a la pregunta");
    }
    localStorage.setItem('preguntas',JSON.stringify(preguntas));
}
function searchIndex(indice){
   for(let i=0;i<preguntas.length;i++){
    console.log(indice,preguntas[i].indice);
        if(preguntas[i].indice==indice){
            return i;
        }
    }
}
function removeRespuesta(indiceLista,indiceRespuesta){
    console.log(indiceLista,indiceRespuesta);
    let newindice=0;
    preguntas.forEach((e,i) => {
        if(e.indice==indiceLista){
            newindice=i;
            
        }
    });
    console.log("NEW INDICE "+newindice, preguntas[(indiceLista-1)]);
    preguntas[(indiceLista-1)].respuestas.splice(indiceRespuesta,1);
    console.log("NEW INDICE "+newindice, preguntas[(indiceLista-1)]);
   let options= $(".solucion #solucion"+indiceLista+" option");
   options.each((i,element) => {
     element.remove();
   });
   $('#respuestas'+indiceLista+" .append div").remove();
   indicePregunta = 1;
   console.log("NEW INDICE ", preguntas[(indiceLista-1)].respuestas);         
   preguntas[(indiceLista-1)].respuestas.forEach((resp,indexRespuesta) => {
                        respuesta((indiceLista-1),indiceLista,resp.respuesta,indexRespuesta);
                    });
                
                

   // localStorage.setItem('preguntas',JSON.stringify(preguntas));
}
function addResponse(indice){
    let index = searchIndex(indice);
    console.log(index,indice,preguntas[(indice-1)]);
    let newindice=0;
    let notIngres=false
    preguntas.forEach((e,i) => {
        if(e.indice==indice){
            newindice=i;
            notIngres=true;
        }
    });
    if(!notIngres){
        preguntas.forEach((e,i) => {
            if(i==(indice-1)){
                newindice=i;
                notIngres=true;
            }
        });
    }
    console.log("NEW INDICE "+newindice);
    let resp = $("#respuesta"+indice).val();
    if(preguntas[(newindice)].respuestas.length>=4){
        alertError("No se puede agregar mas respuestas a la pregunta");
        return;
    }
    if(resp.length==0){
        alertError("La respuesta no puede ser un campo vacío");
        return;
    }
    if(resp.length>=100){
        alertError("La respuesta no puede exceder los 100 caracteres");
        return;
    }
    if(wordsInvalid(resp) ){
        alertError("**Campo con palabras no permitidas");
        count++;
    }
    let i =preguntas[(newindice)].respuestas.length;
    preguntas[(newindice)].respuestas.push({id:i,respuesta:resp});
    respuesta(newindice,indice,resp,i);
    
}
$("#addPregunta").click(function(){
    let pregunta = $("#pregunta").val();
    detalles = document.getElementById('detalles');
    let detall = sceditor.instance(detalles).val();
    let ayud = sceditor.instance(ayuda).val();
    let def = sceditor.instance(definiciones).val();
    let count =0;
    let errores="";
    if(pregunta.length==0){
        errores+="Campo pregunta no puede estar vacío<br>";
        count++;
    }
    if(pregunta.length>=100){
        errores+="La pregunta no puede exceder los 100 caracteres";
        count++;
    }
    if(wordsInvalid(pregunta)){
        errores+="**Campo con palabras no permitidas";
        count++;
    }
    if(detall=='<p><br></p>'){
        errores+="Campo detalles no puede estar vacío<br>";
        count++;
    }
    if(detall.length>=300){
        errores+="Los detalles de la pregunta no puede exceder los 300 caracteres";
        count++;
    }
    if(wordsInvalid(detall) ){
        errores+="**Campo con palabras no permitidas";
        count++;
    }
    if(ayud=='<p><br></p>'){
        errores+="Campo ayuda no puede estar vacío<br>";
        count++;
    }
    if(ayud.length>=300){
        errores+="Los datos de ayuda de la pregunta no puede exceder los 300 caracteres";
        count++;
    }
    if(wordsInvalid(def) ){
        errores+="**Campo con palabras no permitidas";
        count++;
    }

    if(def.length>=300){
        errores+="Los datos de definiciones de la pregunta no puede exceder los 300 caracteres";
        count++;
    }
    if(wordsInvalid(def) ){
        errores+="**Campo con palabras no permitidas";
        count++;
    }
    if(count>0){
        alertError(errores);
        return;
    }
    preguntas.push({'pregunta':pregunta,respuestas:[],'indice':indicePregunta,detalles:detall,ayuda:ayud,definiciones:def});
    addPregunta(indicePregunta,pregunta,detall,ayud,def);
    
    $("#preguntas").append(html);
    let divs = $("#preguntas .pregunta");
    divs.each((i,element) => {
        let id=$(element).attr('id');
        $("#"+id+" .section .col-sm-11").html("Pregunta #"+(i+1)+":"+preguntas[i].pregunta);
    });  
    html="";
    indicePregunta++;
    localStorage.setItem('indice',indicePregunta);
    localStorage.setItem('preguntas',JSON.stringify(preguntas));
    $("#pregunta").val("");
   
    sceditor.instance(detalles).val('<p><br></p>');
    sceditor.instance(ayuda).val('<p><br></p>');
});
function desplaceTop(){
    $("html, body,.contenedor").animate({ scrollTop: 0 }, "fast");
  }
  function selectImg(){
    
    let value=$("#img").val();
    console.log("Ingreso",value);
    $("#profile").attr('src','../assets/avatars/avatar'+value+".png");
  }
  function  stringLength(value,max){
    if(value.length<=max){
        return true;
    }else{
        return false;
    }
}
function wordsInvalid(text){
    let count=0;
    if(text==""){
        return false;
    }
    let result = text.toLowerCase().match(/select/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/insert/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/delete/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/update/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/create procedure/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/create table/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/create trigger/g);
    if(result!=null && result!=undefined){
        count++;
    }
    console.log("RESULTADO MATCH:"+count);
    if(count==0){
        return false;
    }else{
        return true;
    }

}
function save(name,cuestionario,cantidadErrores,isValid){
   
            cuestionario.imagenSeccion=name;
            cuestionario.seccion = $("#seccion").val();
            console.log(cuestionario);
            if(cantidadErrores==0){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                  $.ajax({
                    type:'POST',
                    url:'../cuestionarios/store',
                    data:{cuestionario:cuestionario},
                    success:function(data){
                        console.log(data);
                        let json = JSON.parse(data);
                        if(json){
                            let rsp=alertTimeCorrect("Cuestionario creado exitosamente",function(response){
                               // limpiarFormulario();
                               localStorage.setItem('preguntas','[]');
                               localStorage.setItem('cuestionario','{}');
                               window.location ="../cuestionarios/create";
                              });
                        }else{
                            alertError("Error inesperado al guardar el cuestionario");
                        }
                
                    },
                    error:function(data){
                        console.log(data);
                        alertError("Error inesperado en el servidor");
                    }
                
                 });
                localStorage.setItem('cuestionario',JSON.stringify(cuestionario));
                console.log(cuestionario);
            }else{
                if(isValid){
                    alertError("Hay campos del formulario a corregir, por favor revisa y vuelve a intentarlo.");
                    setTimeout(function(){  desplaceTop(); }, 2500);
                   
                }
            }
}
$("#save").click(function(){
    confirmacionEliminar("¿Desea Crear el formulario?", function(response) {
        if(response) {
            let cantidadErrores=0;
            let soluciones = $(".solucion select");
            preguntas.forEach((e,i) => {
                console.log("#solucion"+ (i+1));
                console.log(soluciones[i]);
                preguntas[i].solucion =$(soluciones[i]).val();
                if(preguntas[i].respuestas.length<=1){
                    cantidadErrores++;
                }
                console.log($("#solucion1").val());
            });
            localStorage.setItem('preguntas',JSON.stringify(preguntas));
            let cuestionario ={preguntas:preguntas};
            cuestionario.titulo=$("#titulo").val();
            cuestionario.descripcion=$("#des").val();
            cuestionario.edad=$("#edad").val();
            cuestionario.autor=$("#autor").val();
            cuestionario.genero=$("#genero").val();
            cuestionario.trabajo=$("#trabajo").val();
            cuestionario.hijos=$("#hijos").val();
            cuestionario.imagen = $("#img").val();
           
            cuestionario.seccion = $("#seccion").val();
            cuestionario.antecedentesPersonales=sceditor.instance(antecedentesPersonales).val();
            cuestionario.antecedentesFamiliares=sceditor.instance(antecedentesFamiliares).val();
            cuestionario.motivo=sceditor.instance(motivo).val();
            cuestionario.revision=sceditor.instance(revision).val();

            console.log(cuestionario);
            cuestionario.fecha = new Date();
            
            let titulo = $('#titulo').val();
            let valid=false;
            let isValid=true;
            if(cantidadErrores!=0){
                alertError("Hay preguntas que les falta dar opciones de respuesta: Por lo menos <strong>dos</strong> respuestas por pregunta.");
                isValid=false;
            }
            /**********************************  Datos Personales ******************************************/
            if(!stringLength(titulo,50)){
                $('#titulo + span').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(titulo.length<=0){
                $('#titulo + span').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(titulo) && !valid){
                $('#titulo + span').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
        
            if(!valid){    
                $('#titulo + span').text("");
            }
            valid=false;

            let des = $('#des').val();
            if(!stringLength(des,200)){
                $('#des + span').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(des.length<=0){
                $('#des + span').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(des) && !valid){
                $('#des + span').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#des + span').text("");
            }
            valid=false;

            let edad = $('#edad').val();
            if(!stringLength(edad,2)){
                $('#edad + span').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(edad.length<=0){
                $('#edad + span').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(edad) && !valid){
                $('#edad + span').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#edad + span').text("");
            }
            valid=false;

            let trabajo = $('#trabajo').val();
            if(!stringLength(trabajo,50)){
                $('#trabajo + span').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(trabajo.length<=0){
                $('#trabajo + span').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(trabajo) && !valid){
                $('#trabajo + span').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#trabajo + span').text("");
            }
            valid=false;

            let hijos = $('#hijos').val();
            if(!stringLength(hijos,2)){
                $('#hijos + span').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(hijos) && !valid){
                $('#hijos + span').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#hijos + span').text("");
            }
            valid=false;

            /***************************************** */
            let ap = cuestionario.antecedentesPersonales;
            if(!stringLength(ap,500)){
                $('#antecedentePersonalSpan').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(ap=="<p><br></p>"){
                $('#antecedentePersonalSpan').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(ap) && !valid){
                $('#antecedentePersonalSpan').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#antecedentePersonalSpan').text("");
            }
            valid=false;

            let af = cuestionario.antecedentesFamiliares;
            if(!stringLength(af,500)){
                $('#antecedentesFamiliaresSpan').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(af=="<p><br></p>"){
                $('#antecedentesFamiliaresSpan').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(af) && !valid){
                $('#antecedentesFamiliaresSpan').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#antecedentesFamiliaresSpan').text("");
            }
            valid=false;

            let r = cuestionario.revision;
            if(!stringLength(r,500)){
                $('#revisionSpan').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(r=="<p><br></p>"){
                $('#revisionSpan').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(r) && !valid){
                $('#revisionSpan').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#revisionSpan').text("");
            }
            valid=false;

            let m = cuestionario.motivo;
            if(!stringLength(m,500)){
                $('#motivoSpan').text("**Demasiados caracteres");
                cantidadErrores++;
                valid=true;
            }
            if(m=="<p><br></p>"){
                $('#motivoSpan').text("**Campo Requerido");
                cantidadErrores++;
                valid=true;
            }
            if(wordsInvalid(m) && !valid){
                $('#motivoSpan').text("**Campo con palabras no permitidas");
                cantidadErrores++;
                valid=true;
            }
            if(!valid){    
                $('#motivoSpan').text("");
            }
            valid=false;
            if(cantidadErrores==0){
                uploadImage(cuestionario,cantidadErrores,isValid);
            }else{
                if(isValid){
                    alertError("Hay campos del formulario a corregir, por favor revisa y vuelve a intentarlo.");
                    setTimeout(function(){  desplaceTop(); }, 2500);
                   
                }
            }
           
            
        }
      });
    

});