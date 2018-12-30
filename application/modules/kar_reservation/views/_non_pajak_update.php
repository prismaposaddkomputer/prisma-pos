<div id="modal_non_tax_update" class="modal fade" role="dialog" aria-labelledby="modal_non_tax">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_non_tax_list">Ubah Non Pajak</h4>
      </div>
      <div class="modal-body">
        <input class="form-control" id="update_billing_non_tax_id" type="hidden" value="" readonly>
        <div class="form-group">
          <label>Non Pajak</label>
          <input class="form-control" id="update_non_tax_name" type="text" value="" readonly>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="update_non_tax_charge" type="text" value="0" readonly>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="update_non_tax_amount" type="text" value="0" onchange="calc_non_tax_update()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="update_non_tax_total" type="text" value="0" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-success" id="btn_update_non_tax"><i class="fa fa-refresh"></i> Ubah</button>
      </div>
    </div>
  </div>
</div>