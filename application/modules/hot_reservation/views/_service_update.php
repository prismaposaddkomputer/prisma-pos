<div id="modal_service_update" class="modal fade" role="dialog" aria-labelledby="modal_service">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_service_list">Ubah Layanan</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Pelayanan</label>
          <input class="form-control" id="update_billing_service_id" type="hidden" value="" readonly>
          <input class="form-control" id="update_service_name" type="text" value="" readonly>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="update_service_charge" type="text" value="0" readonly>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="update_service_amount" type="text" value="0" onchange="calc_service_update()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="update_service_total" type="text" value="0" readonly>
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
        <button type="button" class="btn btn-success" id="btn_update_service"><i class="fa fa-refresh"></i> Ubah</button>
      </div>
    </div>
  </div>
</div>