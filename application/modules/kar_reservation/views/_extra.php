<div id="modal_extra" class="modal fade" role="dialog" aria-labelledby="modal_extra">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_extra_list">Pilih Extra</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Ekstra</label>
          <select class="form-control select2" id="extra_id">
            <option value="0">-- Pilih Ekstra --</option>
            <?php foreach ($extra as $row): ?>
              <option value="<?=$row->extra_id?>"><?=$row->extra_name?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="extra_charge" type="text" value="0" readonly>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="extra_amount" type="text" value="0" onchange="calc_extra()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="extra_total" type="text" value="0" readonly>
        </div>
        <br>
        <em>
          <small>
            NB: 
            <?php if ($client->client_is_taxed == 0): ?>
              Harga belum termasuk 
            <?php else: ?>
              Harga sudah termasuk 
            <?php endif;?>
            Pajak karaoke
          </small>
        </em>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-info" id="btn_add_extra"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>