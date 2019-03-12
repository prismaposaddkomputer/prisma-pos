<div id="modal_discount" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Diskon</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Tipe</label>
          <select class="select2" name="tx_discount_type" id="tx_discount_type">
            <option value="0">Rupiah</option>
            <option value="1">Persen</option>
          </select>
        </div>
        <div class="form-group discount_percent">
          <div class="row">
            <div class="col-md-6">
              <label>Persen</label>
              <div class="input-group">
                <input class="form-control num" name="tx_discount_percent" id="tx_discount_percent" type="text" value="" onchange="calc_percent_discount()" oninput="calc_percent_discount()">
                <span class="input-group-addon">%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Nominal</label>
          <input class="form-control num autonumeric" name="tx_total_discount" id="tx_total_discount" type="text" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-info" onclick="edit_discount()"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>