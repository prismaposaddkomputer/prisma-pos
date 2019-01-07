<div id="modal_extra_update" class="modal fade" role="dialog" aria-labelledby="modal_extra">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_extra_list">Ubah Extra</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Extra Nama</label>
          <input class="form-control" id="update_billing_extra_id" type="hidden" value="" readonly>
          <input class="form-control" id="update_extra_name" type="text" value="" readonly>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="update_extra_charge" type="text" value="0" readonly>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="update_extra_amount" type="text" value="0" onchange="calc_extra_update()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="update_extra_total" type="text" value="0" readonly>
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
            Pajak Hotel
          </small>
        </em>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-success" id="btn_update_extra"><i class="fa fa-refresh"></i> Ubah</button>
      </div>
    </div>
  </div>
</div>