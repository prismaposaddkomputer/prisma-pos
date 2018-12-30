<div id="modal_custom" class="modal fade" role="dialog" aria-labelledby="modal_custom">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_custom_list">Pilih custom</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Item</label>
          <input class="form-control keyboard" id="custom_name" type="text" value="">
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="custom_charge" type="text" value="0">
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="custom_amount" type="text" value="0" onchange="calc_custom()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="custom_total" type="text" value="0" readonly>
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
        <button type="button" class="btn btn-info" id="btn_add_custom"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>