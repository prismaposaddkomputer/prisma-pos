<!-- Modal add custom -->
<div id="modal_add_custom" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Item Kustom</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Item</label>
          <input class="form-control keyboard" name="add_custom_name" id="add_custom_name" type="text" value="">
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control num autonumeric" name="add_custom_price" id="add_custom_price" type="text" value="">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jumlah</label>
              <input class="form-control num autonumeric" name="add_custom_amount" id="add_custom_amount" type="text" value="">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-info" onclick="add_custom_action()"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit custom item -->
<div id="modal_edit_custom" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Item Kustom</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit_billing_detail_id" value="0" />
        <div class="form-group">
          <label>Nama Item</label>
          <input class="form-control keyboard" name="edit_custom_name" id="edit_custom_name" type="text" value="">
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control num autonumeric" name="edit_custom_price" id="edit_custom_price" type="text" value="">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jumlah</label>
              <input class="form-control num autonumeric" name="edit_custom_amount" id="edit_custom_amount" type="text" value="">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="edit_btn_action" type="button" class="btn btn-success" onclick="edit_custom_action()"><i class="fa fa-refresh"></i> Perbarui</button>
        <button id="delete_btn_action" type="button" class="btn btn-danger" onclick="delete_custom_action()"><i class="fa fa-trash"></i> Hapus</button>
      </div>
    </div>
  </div>
</div>