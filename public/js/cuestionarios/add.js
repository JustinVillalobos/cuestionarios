var antecedentesPersonales = document.getElementById('antecedentesPersonales');
var antecedentesFamiliares = document.getElementById('antecedentesFamiliares');
var motivo = document.getElementById('motivo');
var revision = document.getElementById('revision');

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
let indice=1;
function format (option) {
    if (!option.id) { return option.text; }
    var ob = option.text + '<img src="../assets/avatars/avatar'+indice+'.png" style="width:35px;"/>';	
    indice++;
    if(indice>3){
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
    if(localStorage.getItem('indice')!=undefined){
        if(localStorage.getItem('indice')!=''){
            indicePregunta = 1;
           
            preguntas = JSON.parse(localStorage.getItem('preguntas'));
            console.log("INGRESO INICIO",preguntas);
            preguntas.forEach(element => {
                addPregunta(indicePregunta,element.pregunta);
                indicePregunta++;
            });
            $("#preguntas").append(html);
            html="";
        }
    }
});
let indicePregunta=1;
let preguntas=[];
let html="";
function remove(indice){
    preguntas.splice(indice-1,1);
    let divs = $("#preguntas .pregunta");
    $("#pregunta"+indice).remove();

    console.log(preguntas);
    divs = $("#preguntas .pregunta");
    divs.each((i,element) => {
        let id=$(element).attr('id');
        $("#"+id+" .section .col-sm-11").html("Pregunta #"+(i+1)+":"+preguntas[i].pregunta);
    });   
    localStorage.setItem('indice',indicePregunta);
    localStorage.setItem('preguntas',JSON.stringify(preguntas));
}
function addPregunta(i,pregunta){
    html+="<div class='col-sm-12 pregunta' id='pregunta"+i+"' style='padding:10px 20px 0px 20px;margin-top:20px;'>";
        html+="<div class='row section'>";
            html+="<div class='col-sm-11'>";
                html+="<strong>Pregunta #"+i+":</strong>"+pregunta;
            html+="</div>";
            html+="<div class='col-sm-1 d-flex justify-content-end align-items-center'>";
                html+="<button class='btn btn-danger text-center d-flex justify-content-center align-items-center' style='height:25px;width:25px;' onclick='remove("+i+")'><i class='fa fa-trash'></i></button>";
            html+="</div>";
        html+="</div>";
        html+="<div class='row' style='width: 99%;margin-top:5px;'>";
            html+="<div class='col-sm-11'>";
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
        html+="</div>";
    html+="</div>";
}
function addResponse(indice){
    $('#respuestas'+indice).append("Hola");
}
$("#addPregunta").click(function(){
    let pregunta = $("#pregunta").val();
    preguntas.push({'pregunta':pregunta,respuestas:[],'indice':indicePregunta});
    console.log("Ingreso",preguntas);
    addPregunta(indicePregunta,pregunta);
    
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