$("#demo").click(function(){
    let usuario = $("#usuario").val();
    let codigo =$("#randomCodigo").val();
    let idCuestionario =$("#idCuestionario").val();
    if(usuario==""){
        alertError("Usuario Requerido");
        return;
    }
    if(usuario.length>=100){
        alertError("Usuario con demasiadios caracteres");
        return;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
        type:'POST',
        url:'./insertUser',
        data:{puntaje:{usuario:usuario,codigo:codigo,idCuestionario:idCuestionario}},
        success:function(data){
            console.log(data);
            if(data=='false')
            {
                alertError("Usuario ya registrado en sala");
                return;
            }
            localStorage.setItem('usuario',usuario);
            localStorage.setItem('codigo',codigo);
            localStorage.setItem('idCuestionario',idCuestionario);
            $("#projector").remove();
            $(".header2").remove();
            $(".pseudo-body").remove();
            $("#case").css("display","block");
            $("body").css("background","white");
            $("html").css("background","white");
        },
        error:function(data){
            console.log(data);
            alertError("Error inesperado en el servidor");
        }
    
     });
    
  
});
let clicks=[];
let isValidNext=false;
let cantidad=0;
let indice=0;
function desplaceTop(){
    $(".swip").animate({ scrollBottom: 0 }, "fast");
    $('.swip').scrollTop($('.swip')[0].scrollHeight);
  }
function showData(id){
    
    console.log("INGRESO",id,isReponse);
    
    $("#data"+id).css("display","block");
    $(".data"+id).css("display","block");
    $(".card-data").css("display","none");
    $('.card-data').fadeOut(); //fade out
    $("#show"+id).fadeIn(); //fade in div
    $(".show"+id).fadeIn();
    desplaceTop();
    let valid=true;
    clicks.forEach(element => {
        if(element==id){
            valid=false;
        }
    });
    if(valid){
        clicks.push(id);
    }
    if(clicks.length==4){
        //let swiper2 = document.querySelector('.swiper').swiper;
        //swiper2.slideNext();
        isValidNext=true;
        $(".control").css("pointer-events","all");
        $(".spinnerDiv").css("display","block");
    }
}
function prev(){
    if(isValidNext){
        let swiper2 = document.querySelector('.swiper').swiper;
        swiper2.slidePrevious();
    }
}
function confettiAnimacionNext(){
   /* let confetti = new Confetti('btn-next');
    confetti.setCount(75);
    confetti.setSize(1);
    confetti.setPower(25);
    confetti.setFade(false);
    confetti.destroyTarget(false);*/
  
}
function confettiAnimacionDemo(){
    /*let confetti = new Confetti('demo');
    confetti.setCount(75);
    confetti.setSize(1);
    confetti.setPower(25);
    confetti.setFade(false);
    confetti.destroyTarget(false);*/
  
}
function setCards(preguntas){
    let dom="<div class='row'>";
    preguntas.forEach((element,i) => {
        dom+="<div class='col-sm-3 d-flex justify-content-center' style='margin-top:15px;'>";
            dom+="<div class='card-custom'>";
            let it=i+1;
            let index=it+"";
            if(it<9){
                index="0"+it;
            }
            let resp="A";
            switch(element.respuesta){
                case 0:
                    resp="A";
                    break;
                case 1:
                    resp="B";
                    break;
                case 2:
                    resp="C";
                    break;
                case 3:
                    resp="D";
                    break;
            }
                dom+="<div class='icon-card-correct bg-primary'>"+resp+"</div>";
                dom+="<label>"+index+"</label>";
            dom+="</div>";
        dom+="</div>";
    });
    
    dom+="</div>";
    return dom;
}
function next(){
    isReponse=false;
    console.log("NEXT",isValidNext);
    if(isValidNext && indice<cantidad){
        let swiper2 = document.querySelector('.swiper').swiper;
        swiper2.slideNext();
        indice++;

    }else{
        $(".btn-res").prop('disabled',true);
      /*  localStorage.setItem("preguntasContestadas","[]");
        localStorage.setItem('usuario',"");
        localStorage.setItem('codigo',"");
        localStorage.setItem("randomCodigo","");*/
        let html="";
        html = setCards(preguntas);
        $(".final-col").html(html);
        let swiper2 = document.querySelector('.swiper').swiper;
        swiper2.slideNext();
        indice++;
        localStorage.setItem("preguntasContestadas","[]");
        localStorage.setItem('usuario',"");
        localStorage.setItem('codigo',"");
        localStorage.setItem("randomCodigo",""); 
    }
    if(indice>cantidad){
        $(".btn-res").prop('disabled',true);
       /* localStorage.setItem("preguntasContestadas","[]");
        localStorage.setItem('usuario',"");
        localStorage.setItem('codigo',"");
        localStorage.setItem("randomCodigo","");  */
    }
    console.log(indice,cantidad);
    isValidNext=false;
    $(".control").css("pointer-events","none");
    $(".spinnerDiv").css("display","none");
    confettiAnimacionNext();
}
let preguntas=[];
let respuesta=0;
function response(pregunta,res){
    if(isReponse){
        return;
    }
    
     $(".text-response").removeClass("bg-primary");
     $(".response"+pregunta+""+res).addClass("bg-primary");
     $(".btn-res"+pregunta).prop('disabled',false);
     respuesta=res;
   
}
let isReponse = false;
function confettiAnimacion(id,res){
   /* let confetti = new Confetti('response'+id+""+res);
    confetti.setCount(75);
    confetti.setSize(1);
    confetti.setPower(25);
    confetti.setFade(false);
    confetti.destroyTarget(false);
    document.getElementsByClassName('response'+id+""+res)[0].click();*/
}
function responseQuestion(pregunta,solucion){
    if(isReponse){
        return;
    }
    let p ={pregunta:pregunta,respuesta:respuesta,isCorrecto:false,codigo: localStorage.getItem('codigo')};
    if(respuesta==solucion){
       confettiAnimacion(pregunta,solucion);
        let element = document.getElementById("correct");
        element.volume = document.getElementById("mislider").value;
        console.log(element);
        element.play();
         p ={pregunta:pregunta,respuesta:respuesta,isCorrecto:true,codigo: localStorage.getItem('codigo')};
        let rsp=alertTimeCorrect("¡Muchas gracias!<br> Respuesta recibida",function(response){
           });
        preguntas.push(p);
    }else{
        let element = document.getElementById("correct");
        element.volume = document.getElementById("mislider").value;
        element.play();
        let rsp=alertTimeCorrect("¡Muchas gracias!<br> Respuesta recibida",function(response){
        });
        p ={pregunta:pregunta,respuesta:respuesta,isCorrecto:false,codigo: localStorage.getItem('codigo')};
        preguntas.push(p);
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log(p);
      $.ajax({
        type:'POST',
        url:'./updatePuntaje',
        data:{puntaje:p},
        success:function(data){
            console.log(data);
            respuesta=0;
            if(indice<cantidad){
               isValidNext=true;
                $(".control").css("pointer-events","all");
                $(".spinnerDiv").css("display","block");
                $(".btn-res"+pregunta).prop('disabled',true);
                $(".spinnerDiv").css("display","block");
                $(".div-slide-"+pregunta).css("display","none");
                $('.div-det').fadeOut(); //fade out//fade in div
                $(".div-det-"+pregunta).fadeIn();
                localStorage.setItem("preguntasContestadas",JSON.stringify(preguntas));
            }else{
                $(".btn-res"+pregunta).prop('disabled',true);
               /* localStorage.setItem("preguntasContestadas","[]");
                localStorage.setItem('usuario',"");
                localStorage.setItem('codigo',"");
                localStorage.setItem("randomCodigo","");*/
                $(".div-slide-"+pregunta).css("display","none");
                $('.div-det').fadeOut(); //fade out//fade in div
                $(".div-det-"+pregunta).fadeIn();
                $(".control").css("pointer-events","all");
                $(".spinnerDiv").css("display","block");
            }
            isReponse=true;
        },
        error:function(data){
            console.log(data);
            alertError("Error inesperado en el servidor");
        }
    
     });
    
    
}
$( document ).ready(function() {
    confettiAnimacionDemo();
   cantidad = parseInt($("#cantidad").val());
   confettiAnimacionNext();
   let randomCodigo = $("#randomCodigo").val();
   localStorage.setItem("randomCodigo",randomCodigo);
   let swiper2 = document.querySelector('.swiper').swiper;
   let isEntered=false;
   if(localStorage.getItem("preguntasContestadas")!=undefined){
    if(localStorage.getItem("preguntasContestadas")!="[]"){
        if(localStorage.getItem("preguntasContestadas")!=""){
            if(localStorage.getItem('idCuestionario')!=$("#idCuestionario").val()){
                localStorage.setItem('codigo','');
                localStorage.setItem('usuario','');
                localStorage.setItem('idCuestionario',$("#idCuestionario").val());
                localStorage.setItem('preguntasContestadas','[]');
                window.location ="./caso_estudio?code="+$("#idCuestionario").val();
            } 
            $("#projector").remove();
            $(".header2").remove();
            $(".pseudo-body").remove();
            $("#case").css("display","block");
            $("body").css("background","white");
            $("html").css("background","white");
            isEntered=true;
            preguntas = JSON.parse(localStorage.getItem("preguntasContestadas"));
            console.log(preguntas,cantidad,(preguntas.length+1));
            if((preguntas.length+1)<=cantidad){
                swiper2.slideTo(preguntas.length+1);
            }
            
        }
    }
   }
   if(isEntered==false){
    if(localStorage.getItem("usuario")!=undefined){
        if(localStorage.getItem("usuario")!=""){
            
            if(localStorage.getItem('idCuestionario')!=$("#idCuestionario").val()){
                localStorage.setItem('codigo','');
                localStorage.setItem('usuario','');
                localStorage.setItem('idCuestionario',$("#idCuestionario").val());
                localStorage.setItem('preguntasContestadas','[]');
                window.location ="./caso_estudio?code="+$("#idCuestionario").val();
            } 
            $("#projector").remove();
            $(".header2").remove();
            $(".pseudo-body").remove();
            $("#case").css("display","block");
            $("body").css("background","white");
            $("html").css("background","white");
        }
    }
   }

});
function reinitSala(){
    localStorage.setItem('codigo','');
    localStorage.setItem('usuario','');
    localStorage.setItem('idCuestionario',$("#idCuestionario").val());
    localStorage.setItem('preguntasContestadas','[]');
    window.location ="./caso_estudio?code="+$("#idCuestionario").val();
}

$(".swiper img").click(function(e){
    console.log(e);
    console.log($(this).attr('src'));
    $("#visorI").attr('src',$(this).attr('src'));
    $("#visor").modal("show");
})