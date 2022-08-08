function copyCode(codigo){
    navigator.clipboard.writeText(codigo)
    .then(() => {
        toastr["success"]("Código copiado")

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        console.log("Text copied to clipboard...")
    })
        .catch(err => {
        console.log('Something went wrong', err);
    });
}
function copyLink(codigo){
    navigator.clipboard.writeText(codigo)
    .then(() => {
        console.log("Text copied to clipboard...");
        toastr["success"]("Link copiado")

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    })
        .catch(err => {
        console.log('Something went wrong', err);
    });
}
let codigo = "";
function changeStatus(code,disponibilidad,titulo){
    codigo=code;
    console.log(code,disponibilidad,titulo);
    $("#case").text(titulo);
    $("#state").val(disponibilidad);
   
}
function updateState(){
    let disponible =$("#state").val();
    confirmacionEliminar("¿Desea Actualizar el estado del caso de estudio?", function(response) {
        if(response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
              $.ajax({
                type:'POST',
                url:'../cuestionarios/update',
                data:{codigo:codigo,disponible:disponible},
                success:function(data){
                    console.log(data);
                    let json = JSON.parse(data);
                    if(json){
                        let rsp=alertTimeCorrect("Caso de estudio actualizado exitosamente",function(response){
                           window.location="../cuestionarios";
                          });
                    }else{
                        alertError("Error inesperado al actualizar el estado del caso de estudio");
                    }
            
                },
                error:function(data){
                    console.log(data);
                    alertError("Error inesperado en el servidor");
                }
            
             });
        }
      });
}
function validate(e,form,id){
    e.preventDefault();
    confirmacionEliminar("¿Desea eliminar el registro?", function(response) {
        if(response) {
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:'./cuestionarios/destroy',
            data:{codigo:id},
            success:function(data){
                console.log(data,id);
              if(data=='true'){
                let rsp=alertTimeCorrect("Caso de estudio eliminado exitosamente",function(response){
                    window.location="../cuestionarios";
                  });
              }else{
                alertError("Error al eliminar el caso de estudio");
              }
        
            },
            error:function(data){
                console.log("ERROR",data);
                alertError("Error inesperado en el servidor");
            }
        
         });
        }
      });
      return false;
}