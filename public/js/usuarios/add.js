function  stringLength(value,max){
    if(value.length<=max){
        return true;
    }else{
        return false;
    }
}
function save(){
    let cantidadErrores=0;
    let nombre = $('#usuario').val();
    let valid=false;
    /**********************************  Datos Personales ******************************************/
    if(!stringLength(nombre,50)){
        $('#usuario + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(nombre.length<=0){
        $('#usuario + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#usuario + span').text("");
    }
    valid=false;

    let pass = $('#pass').val();
    /**********************************  Datos Personales ******************************************/
    if(!stringLength(pass,50)){
        $('#pass + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(pass.length<=0){
        $('#pass + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#pass + span').text("");
    }
    valid=false;

    let autor = $('#autor').val();
    /**********************************  Datos Personales ******************************************/
    if(!stringLength(autor,50)){
        $('#autor + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(autor.length<=0){
        $('#autor + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#autor + span').text("");
    }
    valid=false;
    if(cantidadErrores==0){
        let form = {};
        form.usuario=nombre;
        form.pass=pass;
        form.autor=autor;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:'../usuarios/store',
            data:{usuario:form},
            success:function(data){
                let json = JSON.parse(data);
                if(json){
                    let rsp=alertTimeCorrect("Usuario Registrado exitosamente",function(response){
                        limpiarFormulario();
                      });
                }else{
                    alertError("Error inesperado al guardar el Usuario:El usuario ya existe");
                }
        
            },
            error:function(data){
                console.log(data);
                alertError("Error inesperado en el servidor");
            }
        
         });
    }
}
function limpiarFormulario(){
    $('#usuario').val("");
    $('#pass').val("");
    $('#autor').val("");

    $('#usuario + span').text("");
    $('#pass + span').text("");
    $('#autor + span').text("");
   
}

$('.btn-primary').click(function(){
    confirmacionEliminar("¿Desea reiniciar el formulario?", function(response) {
        if(response) {
            limpiarFormulario();
        }
      });
    
});
$('.btn-warning').click(function(){
    confirmacionEliminar("¿Desea Salir?", function(response) {
        if(response) {
          window.location ="../usuarios";
        }
      });
});

$('.btn-success').click(save);