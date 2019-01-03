<!-- Modal return -->
<div id="modal_return" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Retur Penjualan</h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-addon">TXS-</span>
          <input id="return_tx_receipt_no" type="text" class="form-control num" aria-label="Masukkan ID Struk">
          <div class="input-group-btn">
            <button class="btn btn-info" onclick="return_action()"> Ok</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit return -->
<div id="modal_edit_return" class="modal fade bs-example-modal-sm"  role="dialog" aria-labelledby="mySmallModalLabel">
  <div style="width:310px;" class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Retur Item</h4>
      </div>
      <div class="modal-body">
        <input id="edit_return_billing_detail_id" type="hidden" name="billing_detail_id" value="">
        <input id="edit_return_item_id" type="hidden" name="item_id" value="">
        <h4 class="cl-info text-center" id="edit_return_item_name"></h4>
        <br>
        <table class="table table-condensed table-sstriped">
          <tr>
            <td>Barcode</td>
            <td>:</td>
            <td id="edit_return_item_barcode"></td>
          </tr>
          <tr>
            <td>Kategori</td>
            <td>:</td>
            <td id="edit_return_category_name"></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>:</td>
            <td id="edit_return_item_price_after_tax"></td>
          </tr>
          <tr>
            <td>Satuan</td>
            <td>:</td>
            <td id="edit_return_unit_code"></td>
          </tr>
          <tr>
            <td>Jumlah yang di beli</td>
            <td>:</td>
            <td id="edit_return_buy_amount"></td>
          </tr>
          <tr>
            <td>Jumlah yang di retur</td>
            <td>:</td>
            <td>
              <div class="input-group col-md-10">
                <span class="input-group-btn">
                  <button id="return_btn_decrement" class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                </span>
                <input id="edit_return_tx_amount" type="text" class="form-control num" value="0">
                <span class="input-group-btn">
                  <button id="return_btn_increment" class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                </span>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="edit_return_btn_action" type="button" class="btn btn-info" onclick="edit_return_item_action()"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal edit return -->
<div id="modal_delete_return" class="modal fade bs-example-modal-sm"  role="dialog" aria-labelledby="mySmallModalLabel">
  <div style="width:310px;" class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Retur Item</h4>
      </div>
      <div class="modal-body">
        <input id="delete_return_billing_detail_id" type="hidden" name="billing_detail_id" value="">
        <p>Apakah anda yakin menghapus item ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="edit_return_btn_action" type="button" class="btn btn-danger" onclick="delete_return_item_action()"><i class="fa fa-trash"></i> Hapus</button>
      </div>
    </div>
  </div>
</div>