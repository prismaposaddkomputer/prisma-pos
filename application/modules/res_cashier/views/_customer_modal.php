<div id="modal_customer" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ganti Pelanggan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Pelanggan</label>
            <select id="customer_list" class="form-control keyboard select2" name="">
              <?php foreach ($customer as $row): ?>
                <option value="<?=$row->customer_id?>"><?=$row->customer_name?></option>
              <?php endforeach; ?>
            </select>
            <div class="form-group">
              <div class="form-group">
                <label>Nama <small class="required-field">*</small></label>
                <input id="lbl_customer_name" class="form-control" type="text" name="customer_name" value="" readonly>
              </div>
              <div class="form-group">
                <label>Telepon <small class="required-field">*</small></label>
                <input id="lbl_customer_phone" class="form-control" type="text" name="customer_phone" value="" readonly>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input id="lbl_customer_email" class="form-control" type="text" name="customer_email" value="" readonly>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input id="lbl_customer_address" class="form-control" type="text" name="customer_address" value="" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="add_customer()"><i class="fa fa-plus"></i> Tambah</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button id="customer_btn_choose" type="button" class="btn btn-info"><i class="fa fa-check"></i> Pilih</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Customer -->
  <div id="modal_add_customer" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <form id="form_add_customer" action="<?=base_url()?>res_cashier/add_customer" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Pelanggan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-group">
                <label>Nama <small class="required-field">*</small></label>
                <input class="form-control keyboard" type="text" name="customer_name" value="">
              </div>
              <div class="form-group">
                <label>Telepon <small class="required-field">*</small></label>
                <input class="form-control num" type="text" name="customer_phone" value="">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input class="form-control keyboard" type="text" name="customer_email" value="">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input class="form-control keyboard" type="text" name="customer_address" value="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>