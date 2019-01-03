<div id="modal_print_receipt" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Cetak Struk</h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-addon">TXS-</span>
          <input id="print_receipt_no" type="text" class="form-control keyboard" aria-label="Masukkan ID Struk">
          <div class="input-group-btn">
            <button class="btn btn-info" onclick="print_receipt_action()"><i class="fa fa-print"></i> Cetak</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
      </div>
    </div>
  </div>
</div>