<div id="modal_cancel" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Batalkan Billing</h4>
      </div>
      <div class="modal-body">
        Apakah Anda ingin membatalkan billing ini?
        <div class="form-group">
          <label>Alasan Pembatalan</label>
          <textarea id="cancel_tx_cancel_notes" class="form-control keyboard" name="" row="2"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="cancel_btn_action" type="button" class="btn btn-info" onclick="cancel_action()"><i class="fa fa-check"></i> Ya</button>
      </div>
    </div>
  </div>
</div>