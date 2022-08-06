var antecedentesPersonales = document.getElementById('antecedentesPersonales');
var antecedentesFamiliares = document.getElementById('antecedentesFamiliares');
var motivo = document.getElementById('motivo');
var revision = document.getElementById('revision');
var detalles = document.getElementById('detalles');
var ayuda = document.getElementById('ayuda');

sceditor.create(antecedentesPersonales, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|source|font,removeformat|copy,cut,paste|bulletlist,orderedlist',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});
sceditor.create(antecedentesFamiliares, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|source|font,removeformat|copy,cut,paste|bulletlist,orderedlist',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});


sceditor.create(motivo, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|source|font,removeformat|copy,cut,paste|bulletlist,orderedlist',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});


sceditor.create(revision, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|source|font,removeformat|copy,cut,paste|bulletlist,orderedlist',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});
sceditor.create(detalles, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|source|font,removeformat|copy,cut,paste|bulletlist,orderedlist',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});
sceditor.create(ayuda, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|source|font,removeformat|copy,cut,paste|bulletlist,orderedlist',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});
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
                addPregunta(indicePregunta,element.pregunta,element.detalles,element.ayuda);
                indicePregunta++;
               
            });
            $("#preguntas").append(html);
            console.log("HILO");
            indicePregunta = 1;
            preguntas.forEach(element => {
                if(element.respuestas.length!=0){
                    element.respuestas.forEach((resp,indexRespuesta) => {
                        respuesta(indicePregunta,resp.respuesta,indexRespuesta);
                    });
                }
                indicePregunta++;
            });
           
            html="";
        }
    }
    desplaceTop();
});
let indicePregunta=1;
let preguntas=[];
let html="";
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
function addPregunta(i,pregunta,de,ay){
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
            html+="<div class='row'><div class='col-sm-12'><h3>Ayuda<h3></div></div>";
                html+="<div class='row'><div class='col-sm-12'>"+ay+"</div></div>";
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
function respuesta(indice,resp,i){
     let html2="";
    if(preguntas[(indice-1)].respuestas.length<=4){
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
    preguntas[(indiceLista-1)].respuestas.splice(indiceRespuesta,1);
   let options= $(".solucion #solucion"+indiceLista+" option");
   options.each((i,element) => {
     element.remove();
   });
   console.log('#respuestas'+indiceLista+" .append .r"+indiceRespuesta);
   $('#respuestas'+indiceLista+" .append div").remove();
   indicePregunta = 1;
                
   preguntas[(indiceLista-1)].respuestas.forEach((resp,indexRespuesta) => {
                        respuesta(indiceLista,resp.respuesta,indexRespuesta);
                    });
                
                

    localStorage.setItem('preguntas',JSON.stringify(preguntas));
}
function addResponse(indice){
    let index = searchIndex(indice);
    console.log(index,indice,preguntas[(indice-1)]);
    let resp = $("#respuesta"+indice).val();
    if(preguntas[(indice-1)].respuestas.length>=4){
        alertError("No se puede agregar mas respuestas a la pregunta");
        return;
    }
    let i =preguntas[(indice-1)].respuestas.length;
    preguntas[(indice-1)].respuestas.push({id:i,respuesta:resp});
    respuesta(indice,resp,i);
    
}
$("#addPregunta").click(function(){
    let pregunta = $("#pregunta").val();
    detalles = document.getElementById('detalles');
    let detall = sceditor.instance(detalles).val();
    let ayud = sceditor.instance(ayuda).val();
    console.log(detall);
    let count =0;
    let errores="";
    if(pregunta.length==0){
        errores+="Campo pregunta no puede estar vacío<br>";
        count++;
    }
    if(detall=='<p><br></p>'){
        errores+="Campo detalles no puede estar vacío<br>";
        count++;
    }
    if(ayud=='<p><br></p>'){
        errores+="Campo ayuda no puede estar vacío<br>";
        count++;
    }
    if(count>0){
        alertError(errores);
        return;
    }
    preguntas.push({'pregunta':pregunta,respuestas:[],'indice':indicePregunta,detalles:detall,ayuda:ayud});
    console.log("Ingreso",preguntas);
    addPregunta(indicePregunta,pregunta,detall,ayud);
    
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
});
function desplaceTop(){
    $("html, body,.contenedor").animate({ scrollTop: 0 }, "fast");
  }
  function selectImg(){
    
    let value=$("#img").val();
    console.log("Ingreso",value);
    $("#profile").attr('src','../assets/avatars/avatar'+value+".png");
  }

$("#save").click(function(){
    confirmacionEliminar("¿Desea Crear el formulario?", function(response) {
        if(response) {
            preguntas.forEach((e,i) => {
                console.log("#solucion"+ (i+1));
                preguntas[i].solucion =$("#solucion"+(i+1)).val();
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
            cuestionario.imagen=$("#img").val();
        
            cuestionario.antecedentesPersonales=sceditor.instance(antecedentesPersonales).val();
            cuestionario.antecedentesFamiliares=sceditor.instance(antecedentesFamiliares).val();
            cuestionario.motivo=sceditor.instance(motivo).val();
            cuestionario.revision=sceditor.instance(revision).val();

            
            cuestionario.fecha = new Date();
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
        }
      });
    

});