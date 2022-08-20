let estado=false;
var intervalId=null;
let preguntas=[];
$( document ).ready(function() {
    let idSala =$("#idCuestionario").val();
    preguntas= JSON.parse($("#preguntas").val());
    console.log(preguntas);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        url:$("#route").val()+'/../liveGraficos',
        data:{idSala:idSala},
        success:function(data){
            console.log(data);
            let values =JSON.parse($("#values").val());
            console.log(values);
            values.forEach((element,i) => {
                console.log(element.respuestas);
                let l = labels(element.respuestas);
                let d = getData(element.puntajes_preguntas,element.respuestas);
                let data_chart = {labels:l,data:d};
                chart(data_chart,i,2000);
            });

            $(".spin").css('display','none');
    
        },
        error:function(data){
            console.log(data);
            alertError("Error inesperado en el servidor");
        }
    
     });
   
});
function labels( long){
    let labels=[];
    let options="ABCD";
    for(let i=0;i<long;i++){
        labels.push(options.charAt(i));
    }
    return labels;
}
function getData(res,long){
    let data=[];
    let  p =[0,0,0,0];
   console.log(res,"*********************************");
   //p[indexP]=res[index].respuesta_count;
   for(let n=0;n<p.length;n++){
        let encontrado=0;
        for(let i=0;i<res.length;i++){
            if(n==res[i].respuesta){
                p[n]=res[i].respuesta_count;
                encontrado=1;
            }
        }
        if(encontrado==0){
            p[n]=0;
        }
    }
    let total=0;
    for(let j=0;j<p.length;j++){
        total=total+p[j];   
    }
    for(let k=0;k<long;k++){
      
        let v = ((p[k]*100)/total).toFixed(2);
        data.push(v);
        
    }
    console.log(data);
    return p;
}
function chart(graph,index,time){
    let new_index="";
    let i = index+1;
    if(index<9){
        new_index ="0"+(index+1);
    }else{
        new_index =""+(index+1);
    }
    if($("#type").val()=="bar_h"){
        console.log(graph.data);
        let html="";
        let total=0;
    for(let j=0;j<graph.data.length;j++){
        total=total+graph.data[j];   
    }
    
        html+="<div class='col-sm-6 d-flex justify-content-center' style='margin-top:25px;'>"
            html+="<div class='card'>";
                html+='<div class="card-body">';
                    html+='<div class="row">';
                        html+='<div class="col-sm-12">';
                                html+="<strong>Pregunta "+new_index+":"+preguntas[index].pregunta+"</strong>";
                        html+="</div>";
                       let percentaje= (((graph.data[0])*100)/total).toFixed(2);
                       if(isNaN(percentaje)){
                        percentaje=0;
                       }
                        html+='<div class="col-sm-12" style="margin-top:5px;">';
                                html+='<div class="progress" style="height:60px;background: white;">';
                                    html+='<div class="progress-bar bg-light2" style="width:'+percentaje+'%;position:;"></div>';
                                    html+='<div class="text-pregunta" style="position:absolute;"><div class="row"><div class="col-sm-10"><textarea rows="4" disabled>'+preguntas[index].respuesta1+'</textarea></div><div class="col-sm-2">'+percentaje+'%</div></div></div>';
                                html+=' </div>';
                        html+="</div>";
                        percentaje= (((graph.data[1])*100)/total).toFixed(2);
                        if(isNaN(percentaje)){
                            percentaje=0;
                           }
                        html+='<div class="col-sm-12" style="margin-top:5px;">';
                                html+='<div class="progress" style="height:60px;background: white;">';
                                    html+='<div class="progress-bar bg-light2" style="width:'+percentaje+'%;position:;"></div>';
                                    html+='<div class="text-pregunta" style="position:absolute;"><div class="row"><div class="col-sm-10"><textarea rows="4" disabled>'+preguntas[index].respuesta2+'</textarea></div><div class="col-sm-2">'+percentaje+'%</div></div></div>';
                                html+=' </div>';
                        html+="</div>";

                        if(preguntas[index].respuesta3!=""){
                            percentaje= (((graph.data[2])*100)/total).toFixed(2);
                            if(isNaN(percentaje)){
                                percentaje=0;
                               }
                            html+='<div class="col-sm-12" style="margin-top:5px;">';
                                html+='<div class="progress" style="height:60px;background: white;">';
                                    html+='<div class="progress-bar bg-light2" style="width:'+percentaje+'%;position:;"></div>';
                                    html+='<div class="text-pregunta" style="position:absolute;"><div class="row"><div class="col-sm-10"><textarea rows="4" disabled>'+preguntas[index].respuesta3+'</textarea></div><div class="col-sm-2">'+percentaje+'%</div></div></div>';
                                html+=' </div>';
                            html+="</div>"
                        }
                        console.log(graph.data.length);
                        if(preguntas[index].respuesta4!=""){
                            percentaje= (((graph.data[3])*100)/total).toFixed(2);
                            if(isNaN(percentaje)){
                                percentaje=0;
                               }
                            html+='<div class="col-sm-12" style="margin-top:5px;">';
                                html+='<div class="progress" style="height:60px;background: white;">';
                                    html+='<div class="progress-bar bg-light2" style="width:'+percentaje+'%;position:;"></div>';
                                    html+='<div class="text-pregunta" style="position:absolute;"><div class="row"><div class="col-sm-10"><textarea  rows="4" disabled>'+preguntas[index].respuesta4+'</textarea></div><div class="col-sm-2">'+percentaje+'%</div></div></div>';
                                html+=' </div>';
                            html+="</div>"
                        }
                html+="</div>";
                    html+="</div>";
                html+="</div>";
            html+="</div>";
        html+="</div>";
        $("#data_table").append(html);
        return;
    }
    let html="<div class='col-sm-3 d-flex justify-content-center'><div class='row w-100 d-flex justify-content-center'><div class='col-sm-12 d-flex justify-content-center'><strong>Pregunta "+new_index+"</strong></div><div style='width:300px!important;height:300px!important;'><canvas id='myChart"+index+"' width='200' height='200' style='width:200px!important;height:200px!important;'></canvas></div></div></div>";
    
    $("#data_table").append(html);

    const ctx = $('#myChart'+index);
    let ctx2 = document.getElementById('myChart'+index);
    ctx2.style.height = '128px';
    ctx2.style.width = '128px';
    const data = {
        labels: graph.labels,
        datasets: [{
          label: '',
          data: graph.data,
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(95,240,144)'
          ],
          hoverOffset: 4
        }]
      };
      const config = {
        type: 'chart',
        
      };
      const decimation = {
        enabled: true,
        algorithm: 'min-max',
      };
      var myChart1 = new Chart(ctx, {
        type: $("#type").val(),
        data: data,
        options: {
            animation: {
                duration: time
            },
          layout: {
            padding: {
              bottom: 25
            }
          },
          plugins: {
            tooltip: {
              enabled: true,
              callbacks: {
                footer: (ttItem) => {
                  let sum = 0;
                  let dataArr = ttItem[0].dataset.data;
                  dataArr.map(data => {
                    sum += Number(data);
                  });
                 if(ttItem[0].parsed.y!=undefined){
                    let percentage = (ttItem[0].parsed.y * 100 / sum).toFixed(2) + '%';
                    console.log(ttItem[0].parsed.y);
                    return ` ${percentage}`;
                 }
                  let percentage = (ttItem[0].parsed * 100 / sum).toFixed(2) + '%';
                  return ` ${percentage}`;
                }
              }
            },
            /** Imported from a question linked above. 
                Apparently Works for ChartJS V2 **/
            datalabels: {
              formatter: (value, dnct1) => {
                let sum = 0;
                let dataArr = dnct1.chart.data.datasets[0].data;
                dataArr.map(data => {
                  sum += Number(data);
                });
      
                let percentage = (value * 100 / sum).toFixed(2) + '%';
                return percentage;
              },
              color: '#fff',
            }
          }
        },
        plugins: [ChartDataLabels]
      });
}
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
    let idSala =$("#idCuestionario").val();
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
                url:$("#route").val()+'/../liveGraficos',
                data:{idSala:idSala},
                success:function(data){
                    $("#data_table").html("");
                    console.log(data);
                    let values =JSON.parse(data);
                    console.log(values);
                    values.forEach((element,i) => {
                        console.log(element.respuestas);
                        let l = labels(element.respuestas);
                        let d = getData(element.puntajes_preguntas,element.respuestas);
                        let data_chart = {labels:l,data:d};
                        chart(data_chart,i,0);
                    });
        
                    $(".spin").css('display','none');
            
                },
                error:function(data){
                    console.log(data);
                    alertError("Error inesperado en el servidor");
                }
            
             });
        }
       
      }, 2000);
}