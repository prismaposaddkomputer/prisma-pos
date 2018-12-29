<div id="modal_fnb" class="modal fade" role="dialog" aria-labelledby="modal_fnb">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_fnb_list">Pilih F&B</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>F&B</label>
          <select class="form-control select2" id="fnb_id">
            <option value="0">-- Pilih F&B --</option>
            <?php foreach ($fnb as $row): ?>
              <option value="<?=$row->fnb_id?>"><?=$row->fnb_name?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="fnb_charge" type="text" value="0" readonly>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="fnb_amount" type="text" value="0" onchange="calc_fnb()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="fnb_total" type="text" value="0" readonly>
        </div>
        <em>
          <small>
            NB: 
            <?php if ($client->client_is_taxed == 0): ?>
              Harga belum termasuk 
            <?php else: ?>
              Harga sudah termasuk 
            <?php endif;?>
            <?php foreach ($charge_type as $row){
              echo $row->charge_type_name.',';
            }?>
          </small>
        </em>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-info" id="btn_add_fnb"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>