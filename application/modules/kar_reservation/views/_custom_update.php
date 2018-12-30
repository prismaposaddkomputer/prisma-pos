<div id="modal_custom_update" class="modal fade" role="dialog" aria-labelledby="modal_custom">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_custom_list">Ubah custom</h4>
      </div>
      <div class="modal-body">
        <input class="form-control" id="update_billing_custom_id" type="hidden" value="" readonly>
        <div class="form-group">
          <label>Nama Item</label>
          <input class="form-control keyboard" id="update_custom_name" type="text" value="">
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="update_custom_charge" type="text" value="0">
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="update_custom_amount" type="text" value="0" onchange="calc_custom_update()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="update_custom_total" type="text" value="0" readonly>
        </div>
        <br>
        <em>
          <small>
            NB: 
            Harga tidak dikenakan Pajak Karaoke
          </small>
        </em>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-success" id="btn_update_custom"><i class="fa fa-refresh"></i> Ubah</button>
      </div>
    </div>
  </div>
</div>