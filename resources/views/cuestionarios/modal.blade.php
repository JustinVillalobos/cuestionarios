<div class="modal fade" id="modal{{$key}}">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Información Adicional</h4>
        <button type="button" class="close" data-dismiss="modal" style="font-size: 24px;">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="overflow-y: auto;overflow-x: hidden;">
        <div class="row">
                <div class="col-sm-12 ayuda">{!! $p->ayuda !!}</div>
                
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-modal" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>