<div id="modal_down_payment" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Uang Muka</h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <input id="tx_down_payment" type="text" class="form-control autonumeric num" aria-label="Masukkan ID Struk">
          <div class="input-group-btn">
            <button class="btn btn-info" onclick="down_payment_action()"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info pull-left" onclick="print_receipt_dp()"><i class="fa fa-print"></i> Cetak Struk DP</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
      </div>
    </div>
  </div>
</div>