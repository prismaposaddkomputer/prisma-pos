<div id="modal_non_tax" class="modal fade" role="dialog" aria-labelledby="modal_non_tax">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_non_tax_list">Pilih Non Pajak</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Non Pajak</label>
          <select class="form-control select2" id="non_tax_id">
            <option value="0">-- Pilih Non Pajak --</option>
            <?php foreach ($non_tax as $row): ?>
              <option value="<?=$row->non_tax_id?>"><?=$row->non_tax_name?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="non_tax_charge" type="text" value="0" readonly>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="non_tax_amount" type="text" value="0" onchange="calc_non_tax()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="non_tax_total" type="text" value="0" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-info" id="btn_add_non_tax"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>