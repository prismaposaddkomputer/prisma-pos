<div id="modal_room" class="modal fade"  role="dialog" aria-labelledby="modal_room">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_room_list">Tambah Kamar</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tipe Kamar</label>
              <select class="form-control select2" id="room_type_id">
                <option value="0">-- Pilih Tipe Kamar --</option>
                <?php foreach ($room_type as $row): ?>
                  <option value="<?=$row->room_type_id?>"><?=$row->room_type_name?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Kamar</label>
              <select class="form-control select2" id="room_id">
                <option value="0">-- Pilih Kamar --</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pilih Tipe Tarif Kamar</label>
              <br>
                <label class="radio-inline">
                   <input type="radio" name="room_type_tarif_kamar" class="room_type_tarif_kamar" id="room_type_tarif_kamar_1" value="1" checked=""/> Per Hari
                </label>
                &nbsp;&nbsp;&nbsp;
                <label class="radio-inline">
                   <input type="radio" name="room_type_tarif_kamar" class="room_type_tarif_kamar" id="room_type_tarif_kamar_2" value="2"/> Per Jam
                </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label id="label_room_type_charge">Harga Per Hari</label>
              <input class="form-control autonumeric num" id="room_type_charge" type="text" value="0" onchange="calc_room()">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label id="label_room_type_duration">Durasi Per Hari</label>
              <div class="input-group">
                <input class="form-control autonumeric num" id="room_type_duration" type="text" value="0" onchange="calc_room()">
                <div class="input-group-addon" id="group_addon_room_type_duration"><b>Hari</b></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Total</label>
              <input class="form-control autonumeric num" id="room_type_total" type="text" value="0" readonly="">
            </div>
          </div>
          <div class="col-md-6">  
            <div class="form-group">
              <label>Diskon</label>
              <select class="form-control select2" id="discount_id_room">
                <?php foreach ($discount_room as $row): ?>
                  <option value="<?=$row->discount_id?>">
                    <?=$row->discount_name?> (<?php if($row->discount_type == 1){echo $row->discount_amount." %";}else{echo num_to_price($row->discount_amount);}?>)
                  </option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Keterangan</label> <em><small>(tidak wajib diisi)</small></em>
          <textarea class="form-control keyboard" id="billing_keterangan" style="height: 70px;"></textarea>
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
        <button type="button" class="btn btn-info" id="btn_add_room"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>