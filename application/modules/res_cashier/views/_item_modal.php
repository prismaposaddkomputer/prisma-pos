<div id="modal_add_item" class="modal fade bs-example-modal-sm"  role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Item</h4>
      </div>
      <div class="modal-body">
        <input id="add_item_id" type="hidden" name="item_id" value="">
        <h4 class="cl-info text-center" id="add_item_name"></h4>
        <br>
        <table class="table table-condensed table-sstriped">
          <tr>
            <td>Barcode</td>
            <td>:</td>
            <td id="add_item_barcode"></td>
          </tr>
          <tr>
            <td>Kategori</td>
            <td>:</td>
            <td id="add_category_name"></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>:</td>
            <td>
              <input class="form-control num autonumeric" type="text" id="add_item_price_after_tax" value="0">
            </td>
          </tr>
          <tr>
            <td>Satuan</td>
            <td>:</td>
            <td id="add_unit_code"></td>
          </tr>
          <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td>
              <div class="input-group col-md-10">
                <span class="input-group-btn">
                  <button id="add_btn_decrement" class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                </span>
                <input id="add_tx_amount" type="text" class="form-control num" value="1">
                <span class="input-group-btn">
                  <button id="add_btn_increment" class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                </span>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="add_btn_action" type="button" class="btn btn-info" onclick="add_item_action()"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit item -->
<div id="modal_edit_item" class="modal fade bs-example-modal-sm"  role="dialog" aria-labelledby="mySmallModalLabel">
  <div style="width:310px;" class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Item</h4>
      </div>
      <div class="modal-body">
        <input id="edit_billing_detail_id" type="hidden" name="billing_detail_id" value="">
        <input id="edit_item_id" type="hidden" name="item_id" value="">
        <h4 class="cl-info text-center" id="edit_item_name"></h4>
        <br>
        <table class="table table-condensed table-sstriped">
          <tr>
            <td>Barcode</td>
            <td>:</td>
            <td id="edit_item_barcode"></td>
          </tr>
          <tr>
            <td>Kategori</td>
            <td>:</td>
            <td id="edit_category_name"></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>:</td>
            <td>
              <input class="form-control num autonumeric" type="text" id="edit_item_price_after_tax" value="0">
            </td>
          </tr>
          <tr>
            <td>Satuan</td>
            <td>:</td>
            <td id="edit_unit_code"></td>
          </tr>
          <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td>
              <div class="input-group col-md-10">
                <span class="input-group-btn">
                  <button id="edit_btn_decrement" class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                </span>
                <input id="edit_tx_amount" type="text" class="form-control num" value="1">
                <span class="input-group-btn">
                  <button id="edit_btn_increment" class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                </span>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="edit_btn_action" type="button" class="btn btn-success" onclick="edit_item_action()"><i class="fa fa-refresh"></i> Perbarui</button>
        <button id="delete_btn_action" type="button" class="btn btn-danger" onclick="delete_item_action()"><i class="fa fa-trash"></i> Hapus</button>
      </div>
    </div>
  </div>
</div>