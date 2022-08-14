let estado=false;
var intervalId=null;
$( document ).ready(function() {
    $(".spin").css('display','none');
});
function stop(){
    clearInterval(intervalId);
    console.log("TERMIAN");
    intervalId =null;$("#button").removeClass("btn-danger");
    $("#button").addClass("btn-info");
    $("#button").html("<i class='fa fa-play'></i>");
    console.log("TERMIAN");
}
$("#button").click(function(){
    if($("#button").hasClass('btn-danger')){
        stop();
    }else{
        estado=false;
        live();
    }   
   
});
function live(){
    if(estado==false){
        estado=true;
        $("#button").removeClass("btn-info");
        $("#button").addClass("btn-danger");
        $("#button").html("<i class='fa fa-stop'></i>");
    }else{
        estado=false;
        
    }
    let idSala =$("#idSala").val();
    let salaData =$("#salaData").val();
    let limit =$("#limit").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    intervalId=setInterval(() => {
        if(estado==false){
            console.log("Termino LIVE");
          
            

        }else{
            $.ajax({
                type:'POST',
                url:'../live',
                data:{idSala:idSala,salaData:salaData,limit:limit},
                success:function(data){
                    console.log(data);
                    $("#data_table").html(data);
                   
            
                },
                error:function(data){
                    console.log(data);
                    alertError("Error inesperado en el servidor");
                }
            
             });
        }
       
      }, 2000);
}