$( document ).ready(function() {
  $(".spin").css('display','none');
});
function validate(e,form,id){
    confirmacionEliminar("¿Desea eliminar el registro?", function(response) {
        if(response) {
          $(".spin").css('display','block');
           // form.submit();
           // return true;
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:$("#route").val()+'/destroy',
            data:{id:id},
            success:function(data){
                console.log(data,id);
                $(".spin").css('display','none');
              if(data=='true'){
                let rsp=alertTimeCorrect("Usuario eliminado exitosamente",function(response){
                    window.location=$("#route").val();
                  });
              }else{
                alertError("Error al eliminar Usuario");
              }
        
            },
            error:function(data){
                console.log("ERROR",data);
                alertError("Error inesperado en el servidor");
            }
        
         });
        }
      });
      e.preventDefault();
}