
function alertError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: '¡Hubo un error!',
        html: mensaje,
        confirmButtonColor: '#3085d6'
    });
}
function confirmacionEliminar(mensaje, callback) {

  Swal.fire({
      title: mensaje,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar',
      cancelButtonText:'Cancelar'
  }).then((result) => {
      if (result.value) {
          callback(true);
      }else {
        callback(false);
      }
  });
}
function alertTimeCorrect(mensaje,callback) {

  let timerInterval;
  Swal.fire({
    icon: 'success',
    title:'¡Excelente!',
    html:mensaje,
    timer: 2500,
    showConfirmButton:false,
    timerProgressBar: false,
    willOpen: () => {
      Swal.showLoading()
      timerInterval = setInterval(() => {
        
      }, 100)
    },
    willClose: () => {
      clearInterval(timerInterval)
    }
  }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
      return callback(true);
    }
  })
}
