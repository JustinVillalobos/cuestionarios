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
function copyQR(link){
    const $imagen = document.querySelector("#codigo");
		new QRious({
			element: $imagen,
			value: link, // La URL o el texto
			size: 500,
			backgroundAlpha: 0, // 0 para fondo transparente
			foreground: "#000", // Color del QR
			level: "H", // Puede ser L,M,Q y H (L es el de menor nivel, H el mayor)
		});
		const enlace = document.createElement("a");
			enlace.href = $imagen.src;
			enlace.download = "code.png";
			enlace.click();
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
function copyIframe(codigo){
    navigator.clipboard.writeText("<iframe style='width:100%;height:100vh;' src='"+codigo+"'></iframe>")
    .then(() => {
        console.log("Text copied to clipboard...");
        toastr["success"]("IFrame copiado")

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
                url:'./cuestionarios/update',
                data:{codigo:codigo,disponible:disponible},
                success:function(data){
                    console.log(data);
                    let json = JSON.parse(data);
                    if(json){
                        let rsp=alertTimeCorrect("Caso de estudio actualizado exitosamente",function(response){
                           window.location=$("#route").val();
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
              if(data=='true'){
                let rsp=alertTimeCorrect("Caso de estudio eliminado exitosamente",function(response){
                    window.location=$("#route").val();
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
$( document ).ready(function() {
    $(".spin").css('display','none');
    localStorage.setItem('indice',"");
});
