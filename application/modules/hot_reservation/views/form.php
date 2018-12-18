<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="<?=base_url()?>hot_reservation/<?=$action?>" method="post">
    <h4><i class="fa fa-file-o"></i> Data Reservasi</h4>
    <div class="row">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="billing_id" id="billing_id" value="<?php if($billing != null){echo $billing->billing_id;}else{echo $billing_id;}?>">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>No. Nota</label>
              <input class="form-control" type="text" name="billing_receipt_no" id="billing_receipt_no" value="<?php if($billing != null){echo $billing->billing_receipt_no;}else{echo $billing_receipt_no;}?>" readonly>
            </div>
          </div>
        </div>
        <h5 class="cl-success"><strong>Check In</strong></h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal <b class="required-field">*</b></small></label>
              <input class="form-control date-picker" type="text" name="billing_date_in" id="billing_date_in" value="<?php if($billing != null){echo date_to_ind($billing->billing_date_in);}else{echo date('d-m-Y');}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu <b class="required-field">*</b></small></label>
              <input class="form-control time-picker" type="text" name="billing_time_in" id="billing_time_in" value="<?php if($billing != null){echo $billing->billing_time_in;}else{echo date('H:i:s');}?>">
            </div>
          </div>
        </div>
        <h5 class="cl-danger"><strong>Check Out</strong></h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal <b class="required-field">*</b></small></label>
              <input class="form-control date-picker" type="text" name="billing_date_out" id="billing_date_out" value="<?php if($billing != null){echo date_to_ind($billing->billing_date_out);}else{echo date('d-m-Y');}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu <b class="required-field">*</b></small></label>
              <input class="form-control time-picker" type="text" name="billing_time_out" id="billing_time_out" value="<?php if($billing != null){echo $billing->billing_time_out;}else{echo date('H:i:s');}?>">
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Uang Muka</label>
              <input class="form-control autonumeric keyboard " type="text" name="billing_down_payment" id="billing_down_payment" value="<?php if($billing != null){echo $billing->billing_down_payment;}else{echo 0;}?>">
            </div>
          </div>
        </div> -->
        <div class="form-group">
          <label>Pilih Jenis Uang Muka</label>
          <br>
            <label class="radio-inline">
               <input type="radio" name="billing_down_payment_type" value="1" <?php if($billing != null){if($billing->billing_down_payment_type == '1'){echo 'checked';}}else{echo 'checked';}?>/> Nominal (Rp)
            </label>
            &nbsp;&nbsp;&nbsp;
            <label class="radio-inline">
               <input type="radio" name="billing_down_payment_type" value="2" <?php if($billing != null){if($billing->billing_down_payment_type == '2'){echo 'checked';}}?>/> Presentase (%)
            </label>
        </div>
        <div class="row" id="discountAmmount">
          <div class="col-md-4">
            <div class="form-group">
              <label><span id="name_field"></span> </label>
              <div class="input-group">
                <div class="input-group-addon" id="rp_icon"></div>
                <input class="form-control autonumeric num " type="text" name="billing_down_payment" id="billing_down_payment" value="<?php if($billing != null){echo $billing->billing_down_payment;}else{echo 0;}?>">
                <div class="input-group-addon" id="prosen_icon"></div>
              </div>
            </div>
          </div>
        </div>

        <button class="btn btn-info" id="btn_room_list" type="button"><i class="fa fa-bed"></i> Kamar <span class="badge" id="lbl_count_room">0</span></button>
        <button class="btn btn-info" id="btn_extra_list" type="button"><i class="fa fa-plus-square"></i> Ekstra <span class="badge" id="lbl_count_extra">0</span></button>
        <button class="btn btn-info" id="btn_service_list" type="button"><i class="fa fa-plus-square"></i> Pelayanan <span class="badge" id="lbl_count_service">0</span></button>
        <button class="btn btn-info" id="btn_fnb_list" type="button"><i class="fa fa-cutlery"></i> F&B <span class="badge" id="lbl_count_fnb">0</span></button>
        <button style="margin-top: 4px;" class="btn btn-info" id="btn_non_tax_list" type="button"><i class="fa fa-ban"></i> Non Pajak <span class="badge" id="lbl_count_non_tax">0</span></button>
        <button style="margin-top: 4px;" class="btn btn-info" id="btn_custom_list" type="button"><i class="fa fa-list"></i> Item Kustom <span class="badge" id="lbl_count_custom">0</span></button>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Jenis Tamu <small class="required-field">*</small></label>
          <br>
          <label class="radio-inline">
            <input type="radio" name="guest_type" value="0" <?php if($billing != null){if($billing->guest_type == '0'){echo 'checked';}}else{echo 'checked';}?>/> Tamu Baru
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="radio-inline">
            <input type="radio" name="guest_type" value="1" <?php if($billing != null){if($billing->guest_type == '1'){echo 'checked';}}?>/> Member (Tamu Langganan)
          </label>
        </div>
        <div id="tamu_baru">
          <div class="form-group" id="guest_name_div">
            <label>Nama Tamu / Plat Nomor Kendaraan <small class="required-field">*</small></label>
            <input class="form-control keyboard " type="text" name="guest_name" id="guest_name" value="<?php if($billing != null){echo $billing->guest_name;} ?>">
          </div>
          <div class="form-group">
            <label>Jenis Kelamin <small class="required-field">*</small></label>
            <br>
              <!-- <label class="radio-inline">
                <input type="radio" name="guest_gender" value="L" <?php if($billing != null){if($billing->guest_gender == 'L'){echo 'checked';}}else{echo 'checked';}?>/> Laki-laki
              </label>
              &nbsp;&nbsp;&nbsp;
              <label class="radio-inline">
                <input type="radio" name="guest_gender" value="P" <?php if($billing != null){if($billing->guest_gender == 'P'){echo 'checked';}}?> /> Perempuan
              </label> -->
              <div class="row">
                <label class="radio-inline">
                  <input type="checkbox" class="cb_guest_gender" name="guest_gender[]" value="L" <?php if($billing != null){if($billing->guest_gender == 'L'){echo 'checked';}}else{echo 'checked';}?>> <span>Laki-laki</span>
                </label>
                <label class="radio-inline">
                  <input type="checkbox" class="cb_guest_gender" name="guest_gender[]" value="P" <?php if($billing != null){if($billing->guest_gender == 'P'){echo 'checked';}}?>> <span>Perempuan</span>
                </label>
              </div>
          </div>
          <div class="form-group">
            <label>No Telpon <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
            <input class="form-control num " type="text" name="guest_phone" id="guest_phone" value="<?php if($billing != null){echo $billing->guest_phone;} ?>">
          </div>
          <div class="form-group">
            <label>Pilih Identitas <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
            <select class="form-control select2 " name="guest_id_type" id="guest_id_type">
              <option value="1" <?php if($billing != null){if($billing->guest_id_type == '1'){echo 'selected';}}else{echo 'selected';}?>>Tidak Ada</option>
              <option value="2" <?php if($billing != null){if($billing->guest_id_type == '2'){echo 'selected';}}?>>KTP</option>
              <option value="3" <?php if($billing != null){if($billing->guest_id_type == '3'){echo 'selected';}}?>>SIM</option>
              <option value="4" <?php if($billing != null){if($billing->guest_id_type == '4'){echo 'selected';}}?>>Lainnya</option>
            </select>
          </div>
          <div class="form-group" id="no">
            <label>No Identitas <span id="label"></span> <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
            <input class="form-control num " type="text" name="guest_id_no" id="guest_id_no" value="<?php if($billing != null){echo $billing->guest_id_no;} ?>">
          </div>
        </div>


        <div id="tamu_langganan">
          <div class="form-group">
            <label>Pilih Tamu Langganan / Plat Nomor Kendaraan</label>
            <select class="form-control select2 required" name="form_guest_id" id="jenis_tamu_langganan">
              <option value="">Kosong</option>
              <?php foreach ($list_member as $data): ?>
              <option value="<?=$data->guest_id?>" <?php if($billing != null){if($billing->guest_id == $data->guest_id){echo 'selected';}}?>><?=$data->guest_name?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- <div class="form-group"> -->
            <!-- <label>Nama Tamu / Plat Nomor Kendaraan</label> -->
            <input class="form-control" id="form_guest_name" name="form_guest_name" type="hidden" value="<?php if($billing != null){echo $billing->guest_name;} ?>" readonly="">
          <!-- </div> -->

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <input class="form-control" type="text" name="form_guest_gender" id="form_guest_gender" value="<?php if($billing != null){if($billing->guest_gender == 'L'){echo 'Laki-laki';}else{echo 'Perempuan';}} ?>" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No Telpon</label>
                <input class="form-control" type="text" name="form_guest_phone" id="form_guest_phone" value="<?php if($billing != null){echo $billing->guest_phone;} ?>" readonly>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>No Identitas <span id="label_guest_id_type"></span></label>
            <input class="form-control" id="form_guest_id_no" name="form_guest_id_no" type="text" value="<?php if($billing != null){echo $billing->guest_id_no;} ?>" readonly="">
            <input class="form-control" id="form_guest_id_type" name="form_guest_id_type" type="hidden" value="<?php if($billing != null){echo $billing->guest_id_type;} ?>" readonly="">
          </div>
        </div>


      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_reservation/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-warning" type="submit" name="action" value="save_temp">Simpan Sementara <i class="fa fa-save"></i></button>
          <button class="btn btn-success" type="submit" name="action" value="save_payment">Simpan & Lanjut Pembayaran <i class="fa fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modals -->
<!-- Room List -->
<div id="modal_room_list" class="modal fade"  role="dialog" aria-labelledby="modal_room_list">
  <div style="width:800px;" class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_room_list">Pesanan Kamar</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_room"><i class="fa fa-plus"></i> Tambah Kamar</button>
        <br><br>
        <table id="tbl_room_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Jenis Kamar</th>
              <th class="text-center">Kamar</th>
              <th class="text-center" width="150">Harga</th>
              <th class="text-center" width="150">Diskon</th>
              <th class="text-center" width="150">Total</th>
              <th class="text-center" width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_room_list">
          </tbody>
        </table>
        <em>
          <small>
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
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Room -->
<div id="modal_room" class="modal fade"  role="dialog" aria-labelledby="modal_room">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_room_list">Pilih Kamar</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Tipe Kamar</label>
          <select class="form-control select2" id="room_type_id">
            <option value="0">-- Pilih Tipe Kamar --</option>
            <?php foreach ($room_type as $row): ?>
              <option value="<?=$row->room_type_id?>"><?=$row->room_type_name?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="form-group">
          <label>Kamar</label>
          <select class="form-control select2" id="room_id">
            <option value="0">-- Pilih Kamar --</option>
          </select>
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input class="form-control autonumeric num" id="room_type_charge" type="text" value="0">
        </div>
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
        <br>
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

<!-- Extra List -->
<div id="modal_extra_list" class="modal fade"  role="dialog" aria-labelledby="modal_extra_list">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_extra_list">Pesanan Ekstra</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_extra"><i class="fa fa-plus"></i> Tambah Ekstra</button>
        <br><br>
        <table id="tbl_extra_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama Extra</th>
              <th class="text-center">Harga Satuan</th>
              <th class="text-center">Banyak</th>
              <th class="text-center" width="150">Total</th>
              <th class="text-center" width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_extra_list">

          </tbody>
        </table>
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
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Extra -->
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
            Pajak Hotel
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

<!-- Service List -->
<div id="modal_service_list" class="modal fade"  role="dialog" aria-labelledby="modal_service_list">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_service_list">Pesanan Layanan</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_service"><i class="fa fa-plus"></i> Tambah Layanan</button>
        <br><br>
        <table id="tbl_service_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama Layanan</th>
              <th class="text-center">Harga Satuan</th>
              <th class="text-center">Banyak</th>
              <th class="text-center" width="150">Total</th>
              <th class="text-center" width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_service_list">

          </tbody>
        </table>
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
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Service -->
<div id="modal_service" class="modal fade" role="dialog" aria-labelledby="modal_service">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_service_list">Pilih Layanan</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Layanan</label>
          <select class="form-control select2" id="service_id">
            <option value="0">-- Pilih Layanan --</option>
            <?php foreach ($service as $row): ?>
              <option value="<?=$row->service_id?>"><?=$row->service_name?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="service_charge" type="text" value="0" readonly>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="service_amount" type="text" value="0" onchange="calc_service()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="service_total" type="text" value="0" readonly>
        </div>
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
        <button type="button" class="btn btn-info" id="btn_add_service"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>
<!-- Fnb List -->
<div id="modal_fnb_list" class="modal fade"  role="dialog" aria-labelledby="modal_fnb_list">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_fnb_list">Pesanan F&B</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_fnb"><i class="fa fa-plus"></i> Tambah F&B</button>
        <br><br>
        <table id="tbl_fnb_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama F&B</th>
              <th class="text-center">Harga Satuan</th>
              <th class="text-center">Banyak</th>
              <th class="text-center" width="150">Total</th>
              <th class="text-center" width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_fnb_list">

          </tbody>
        </table>
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
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- FnB -->
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
            Pajak Hotel
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

<!-- Non Pajak List -->
<div id="modal_non_tax_list" class="modal fade"  role="dialog" aria-labelledby="modal_non_tax_list">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_non_tax_list">Pesanan Non Pajak</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_non_tax"><i class="fa fa-plus"></i> Tambah Non Pajak</button>
        <br><br>
        <table id="tbl_non_tax_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama Non Pajak</th>
              <th class="text-center">Harga Satuan</th>
              <th class="text-center">Banyak</th>
              <th class="text-center" width="150">Total</th>
              <th class="text-center" width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_non_tax_list">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Custom -->
<div id="modal_custom" class="modal fade" role="dialog" aria-labelledby="modal_custom">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_custom_list">Tambah</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Item</label>
          <input class="form-control keyboard" id="custom_name" type="text" value="">
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Harga</label>
              <input class="form-control autonumeric num" id="custom_charge" type="text" value="0">
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label>Banyak</label>
              <input class="form-control autonumeric num" id="custom_amount" type="text" value="0" onchange="calc_custom()">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Total</label>
          <input class="form-control autonumeric num" id="custom_total" type="text" value="0" readonly>
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
        <button type="button" class="btn btn-info" id="btn_add_custom"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>
<!-- Custom List -->
<div id="modal_custom_list" class="modal fade"  role="dialog" aria-labelledby="modal_custom_list">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_custom_list">Pesanan Kustom</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_custom"><i class="fa fa-plus"></i> Tambah Kustom</button>
        <br><br>
        <table id="tbl_custom_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama Non Pajak</th>
              <th class="text-center">Harga Satuan</th>
              <th class="text-center">Banyak</th>
              <th class="text-center" width="150">Total</th>
              <th class="text-center" width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_custom_list">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- FnB -->
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

<script type="text/javascript">
  $(document).ready(function () {

    $(".cb_guest_gender").change(function() {
      $(".cb_guest_gender").prop('checked',false);
      $(this).prop('checked',true);
    });

    $('#name_field').html('Nominal');
    $('#rp_icon').html('Rp');
    $('#prosen_icon').hide();
    //
    <?php
      if($billing != null){if($billing->billing_down_payment_type == '1'){
    ?>
    $('#name_field').html('Nominal');
    $('#rp_icon').html('Rp');
    $('#prosen_icon').hide();
    $('#rp_icon').show();
    <?php
      }else if($billing->billing_down_payment_type == '2'){
    ?>
    $('#name_field').html('Persentase');
    $('#prosen_icon').html('%');
    $('#rp_icon').hide();
    $('#prosen_icon').show();
    <?php
      }}
    ?>
    //
    <?php
      if(@$billing != null){if(@$billing->guest_type == '0'){
    ?>
    $('#tamu_langganan').hide();
    <?php 
      }else if(@$billing->guest_type == '1'){
    ?>
    $('#tamu_baru').hide();
    $('#tamu_langganan').show();
    <?php
      }}
    ?>

    <?php if (@$billing == '') { ?>
    $('#tamu_langganan').hide();
    <?php } ?>
    //
    $('#form input[type=radio]').on('change', function() {
      var billing_down_payment_type = $('input[name=billing_down_payment_type]:checked', '#form').val();
      if (billing_down_payment_type == '1') {
        $('#name_field').html('Nominal');
        $('#rp_icon').html('Rp');
        $('#prosen_icon').hide();
        $('#rp_icon').show();
      }else if (billing_down_payment_type == '2') {
        $('#name_field').html('Persentase');
        $('#prosen_icon').html('%');
        $('#prosen_icon').show();
        $('#rp_icon').hide();
      }

      var guest_type = $('input[name=guest_type]:checked', '#form').val();
      if (guest_type == '0') {

        <?php if (@$billing->guest_type == '1'): ?>
          $('input[name=guest_name]').val('');
          $('input[name=guest_gender]').val('');
          $('input[name=guest_phone]').val('');
          $('select[name=guest_id_type]').val('');
          $('input[name=guest_id_no]').val('');
        <?php endif; ?>

        $('#tamu_baru').show();
        $('#tamu_langganan').hide();
      }else if (guest_type == '1') {

        <?php if (@$billing->guest_type == '0'): ?>
          $('input[name=form_guest_name]').val('');
          $('input[name=form_guest_gender]').val('');
          $('input[name=form_guest_phone]').val('');
          $('input[name=form_guest_id_type]').val('');
          $('input[name=form_guest_id_no]').val('');
        <?php endif; ?>

        $('#tamu_baru').hide();
        $('#tamu_langganan').show();
      }
    });
    
    $("#form").validate({
      rules: {
        'billing_date_in': {
          required: true
        },
        'billing_time_in': {
          required: true
        },
        'billing_date_out': {
          required: true
        },
        'billing_time_out': {
          required: true
        },
        'billing_down_payment': {
          required: true
        },
        'guest_name': {
          required: true
        },
        'billing_charge': {
          required: true,
          number: true
        },
        'form_guest_id': {
          required: true
        }
      },
      messages: {
        'billing_date_in': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_time_in': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_date_out': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_time_out': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_down_payment': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'guest_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_charge': {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        },
        'form_guest_id': {
          required: '<i style="color:red">Wajib dipilih, Tidak boleh Kosong!</i>'
        }
      }
    });

    //
    get_count();
    
    //Room
    $('#btn_room_list').click(function () {
      get_billing_room();
      $('#modal_room_list').modal('show');
    });

    $('#btn_room').click(function () {
      $('#room_type_id').val('0').trigger('change');
      get_room(0);
      $('#room_id').val(0).trigger('change');
      $('#discount_id_room').val(1).trigger('change');
      $('#room_type_charge').val(0);
      $('#modal_room').modal('show');
      $('#modal_room_list').modal('hide');
    });
    
    $('#room_type_id').on('change', function() {
      get_room(this.value);
    });

    $('#btn_add_room').click(function () {
      add_room();
    });

    //Extra
    $('#btn_extra_list').click(function () {
      get_billing_extra();
      $('#modal_extra_list').modal('show');
    });

    $('#btn_extra').click(function () {
      $('#extra_id').val(0).trigger('change');
      $('#extra_charge').val(0);
      $('#extra_amount').val(0);
      $('#extra_total').val(0);
      $('#modal_extra').modal('show');
      $('#modal_extra_list').modal('hide');
    });

    $('#extra_id').on('change', function() {
      get_extra(this.value);
    });

    $('#btn_add_extra').click(function () {
      add_extra();
    });

    //Custom
    $('#btn_custom_list').click(function () {
      get_billing_custom();
      $('#modal_custom_list').modal('show');
    });

    $('#btn_custom').click(function () {
      $('#custom_id').val(0).trigger('change');
      $('#custom_charge').val(0);
      $('#custom_amount').val(0);
      $('#custom_total').val(0);
      $('#modal_custom').modal('show');
      $('#modal_custom_list').modal('hide');
    });

    $('#custom_id').on('change', function() {
      get_custom(this.value);
    });
    

    $('#btn_add_custom').click(function () {
      add_custom();
    });

    // Service
    $('#btn_service_list').click(function () {
      get_billing_service();
      $('#modal_service_list').modal('show');
    });

    $('#btn_service').click(function () {
      $('#service_id').val(0).trigger('change');
      $('#service_charge').val(0);
      $('#service_amount').val(0);
      $('#service_total').val(0);
      $('#modal_service').modal('show');
      $('#modal_service_list').modal('hide');
    });

    // Service
    $('#service_id').on('change', function() {
      get_service(this.value);
    });

    $('#btn_add_service').click(function () {
      add_service();
    });
    
    $('#btn_fnb_list').click(function () {
      get_billing_fnb();
      $('#modal_fnb_list').modal('show');
    });

    $('#btn_fnb').click(function () {
      $('#fnb_id').val(0).trigger('change');
      $('#fnb_charge').val(0);
      $('#fnb_amount').val(0);
      $('#fnb_total').val(0);
      $('#modal_fnb').modal('show');
      $('#modal_fnb_list').modal('hide');
    });

    $('#fnb_id').on('change', function() {
      get_fnb(this.value);
    });

    $('#btn_add_fnb').click(function () {
      add_fnb();
    });

    $('#btn_non_tax_list').click(function () {
      get_billing_non_tax();
      $('#modal_non_tax_list').modal('show');
    });

    $('#btn_non_tax').click(function () {
      $('#non_tax_id').val(0).trigger('change');
      $('#non_tax_charge').val(0);
      $('#non_tax_amount').val(0);
      $('#non_tax_total').val(0);
      $('#modal_non_tax').modal('show');
      $('#modal_non_tax_list').modal('hide');
    });

    $('#non_tax_id').on('change', function() {
      get_non_tax(this.value);
    });

    $('#btn_add_non_tax').click(function () {
      add_non_tax();
    });

  });

  function get_room(room_type_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_room',
      data : 'room_type_id='+room_type_id,
      dataType : 'json',
      success : function (data) {
        $("#room_id option").each(function() {
          $(this).remove();
        });
        $("#room_id").select2({
          data: data.room
        }).trigger('change');
        // console.log(data.room_type.room_type_charge);
        $('#room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge)));
      }
    })
  }



  $('#jenis_tamu_langganan').on('change', function() {
    if (this.value !='') {
      get_member(this.value);
    }else{
      $('#form_guest_name').val('');
      $('#form_guest_gender').val('');
      $('#form_guest_phone').val('');
      $('#form_guest_id_type').val('');
      $('#form_guest_id_no').val('');
      $('#label_guest_id_type').html('');
    }
  });

  function get_member(guest_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_tamu_langganan',
      data : 'guest_id='+guest_id,
      dataType : 'json',
      success : function (data) {
        $('#form_guest_name').val(data.guest.guest_name);
        $('#form_guest_gender').val(data.guest.guest_gender);
        $('#form_guest_phone').val(data.guest.guest_phone);
        $('#form_guest_id_type').val(data.guest.guest_id_type);
        $('#form_guest_id_no').val(data.guest.guest_id_no);
        $('#label_guest_id_type').html(data.guest.guest_id_type_name);
      }
    })
  }



  function add_room() {
    var room_id = $('#room_id').val();
    var billing_date_in = $('#billing_date_in').val();
    var billing_date_out = $('#billing_date_out').val();
    var billing_time_in = $('#billing_time_in').val();
    var billing_time_out = $('#billing_time_out').val();
    var room_type_charge = $('#room_type_charge').val();
    var discount_id_room = $('#discount_id_room').val();
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_room',
      data : 'billing_id='+billing_id+'&room_id='+room_id+'&room_type_charge='+room_type_charge+
              '&billing_date_in='+billing_date_in+'&billing_date_out='+billing_date_out+
              '&billing_time_in='+billing_time_in+'&billing_time_out='+billing_time_out+
              '&discount_id_room='+discount_id_room,
      success : function (data) {
        $('#modal_room_list').modal('show');
        $('#modal_room').modal('hide');
        get_billing_room();
      }
    })
  }

  function get_billing_room() {
    var billing_id = $('#billing_id').val();
    var billing_date_in = $('#billing_date_in').val();
    var billing_date_out = $('#billing_date_out').val();
    var billing_time_in = $('#billing_time_in').val();
    var billing_time_out = $('#billing_time_out').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_room',
      data : 'billing_id='+billing_id+'&billing_date_in='+billing_date_in+'&billing_date_out='+billing_date_out+
              '&billing_time_in='+billing_time_in+'&billing_time_out='+billing_time_out,
      dataType : 'json',
      success : function (data) {
        $("#row_room_list").html('');
        if (data.room == null || data.room == '') {
          var row = '<tr>'+
            '<td class="text-center" colspan="6">Data tidak ada!</td>'+
          '</tr>';
          $("#row_room_list").append(row);
        } else {
          if (data.client_is_taxed == 0) {  
            $.each(data.room, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.room_type_name+'</td>'+
                '<td>'+item.room_name+'</td>'+
                '<td>'+sys_to_cur(item.room_type_subtotal)+'</td>'+
                '<td>'+sys_to_cur(item.room_type_discount)+'</td>'+
                '<td>'+sys_to_cur(item.room_type_subtotal-item.room_type_discount)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_room('+item.billing_room_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_room_list").append(row);
            })
          }else{
             $.each(data.room, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.room_type_name+'</td>'+
                '<td>'+item.room_name+'</td>'+
                '<td>'+sys_to_cur(item.room_type_before_discount)+'</td>'+
                '<td>'+sys_to_cur(item.room_type_discount)+'</td>'+
                '<td>'+sys_to_cur(item.room_type_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_room('+item.billing_room_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_room_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_room(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_room',
      data : 'billing_room_id='+id,
      success : function () {
        get_billing_room();
      }
    })
  }

  function get_extra(extra_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_extra',
      data : 'extra_id='+extra_id,
      dataType : 'json',
      success : function (data) {
        $('#extra_charge').val(sys_to_ind(data.extra_charge));
      }
    })
  }

  function calc_extra() {
    var extra_charge = ind_to_sys($('#extra_charge').val());
    var extra_amount = $('#extra_amount').val();
    $('#extra_total').val(sys_to_ind(extra_amount*extra_charge));
  }

  function add_extra() {
    var billing_id = $('#billing_id').val();
    var extra_id = $('#extra_id').val();
    var extra_amount = $('#extra_amount').val();
    var extra_charge = $('#extra_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_extra',
      data : 'billing_id='+billing_id+'&extra_id='+extra_id+'&extra_amount='+extra_amount+
              '&extra_charge='+extra_charge,
      success : function (data) {
        $('#modal_extra_list').modal('show');
        $('#modal_extra').modal('hide');
        get_billing_extra();
      }
    })
  }

  function get_billing_extra() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_extra',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.extra == null || data.extra == '') {
          $("#row_extra_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_extra_list").append(row);
        } else {
          $("#row_extra_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.extra, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.extra_name+'</td>'+
                '<td>'+sys_to_cur(item.extra_charge)+'</td>'+
                '<td class="text-right">'+item.extra_amount+'</td>'+
                '<td>'+sys_to_cur(item.extra_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_extra('+item.billing_extra_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_extra_list").append(row);
            })
          }else{
            $.each(data.extra, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.extra_name+'</td>'+
                '<td>'+sys_to_cur(item.extra_total/item.extra_amount)+'</td>'+
                '<td class="text-right">'+item.extra_amount+'</td>'+
                '<td>'+sys_to_cur(item.extra_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_extra('+item.billing_extra_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_extra_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_extra(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_extra',
      data : 'billing_extra_id='+id,
      success : function () {
        get_billing_extra();
      }
    })
  }

  //Custom

  function calc_custom() {
    var custom_charge = ind_to_sys($('#custom_charge').val());
    var custom_amount = $('#custom_amount').val();
    $('#custom_total').val(sys_to_ind(custom_amount*custom_charge));
  }
  
  function add_custom() {
    var billing_id = $('#billing_id').val();
    var custom_id = $('#custom_id').val();
    var custom_name = $('#custom_name').val();
    var custom_amount = $('#custom_amount').val();
    var custom_charge = $('#custom_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_custom',
      data : 'billing_id='+billing_id+'&custom_id='+custom_id+'&custom_amount='+custom_amount+
              '&custom_charge='+custom_charge+'&custom_name='+custom_name,
      success : function (data) {
        $('#modal_custom_list').modal('show');
        $('#modal_custom').modal('hide');
        get_billing_custom();
      }
    })
  }

  function get_custom(custom_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_custom',
      data : 'custom_id='+custom_id,
      dataType : 'json',
      success : function (data) {
        $('#custom_charge').val(sys_to_ind(data.custom_charge));
      }
    })
  }

  function get_billing_custom() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_custom',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.custom == null || data.custom == '') {
          $("#row_custom_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_custom_list").append(row);
        } else {
          $("#row_custom_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.custom, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.custom_name+'</td>'+
                '<td>'+sys_to_cur(item.custom_charge)+'</td>'+
                '<td class="text-right">'+item.custom_amount+'</td>'+
                '<td>'+sys_to_cur(item.custom_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_custom('+item.billing_custom_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_custom_list").append(row);
            })
          }else{
            $.each(data.custom, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.custom_name+'</td>'+
                '<td>'+sys_to_cur(item.custom_total/item.custom_amount)+'</td>'+
                '<td class="text-right">'+item.custom_amount+'</td>'+
                '<td>'+sys_to_cur(item.custom_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_custom('+item.billing_custom_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_custom_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_custom(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_custom',
      data : 'billing_custom_id='+id,
      success : function () {
        get_billing_custom();
      }
    })
  }

  function get_service(service_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_service',
      data : 'service_id='+service_id,
      dataType : 'json',
      success : function (data) {
        $('#service_charge').val(sys_to_ind(data.service_charge));
      }
    })
  }

  function calc_service() {
    var service_charge = ind_to_sys($('#service_charge').val());
    var service_amount = $('#service_amount').val();
    $('#service_total').val(sys_to_ind(service_amount*service_charge));
  }

  function add_service() {
    var billing_id = $('#billing_id').val();
    var service_id = $('#service_id').val();
    var service_amount = $('#service_amount').val();
    var service_charge = $('#service_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_service',
      data : 'billing_id='+billing_id+'&service_id='+service_id+'&service_amount='+service_amount+
              '&service_charge='+service_charge,
      success : function (data) {
        $('#modal_service_list').modal('show');
        $('#modal_service').modal('hide');
        get_billing_service();
      }
    })
  }

  function get_billing_service() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_service',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.service == null || data.service == '') {
          $("#row_service_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_service_list").append(row);
        } else {
          $("#row_service_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.service, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.service_name+'</td>'+
                '<td>'+sys_to_cur(item.service_charge)+'</td>'+
                '<td class="text-right">'+item.service_amount+'</td>'+
                '<td>'+sys_to_cur(item.service_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_service('+item.billing_service_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_service_list").append(row);
            })
          }else{
            $.each(data.service, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.service_name+'</td>'+
                '<td>'+sys_to_cur(item.service_total/item.service_amount)+'</td>'+
                '<td class="text-right">'+item.service_amount+'</td>'+
                '<td>'+sys_to_cur(item.service_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_service('+item.billing_service_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_service_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_service(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_service',
      data : 'billing_service_id='+id,
      success : function () {
        get_billing_service();
      }
    })
  }

  function get_fnb(fnb_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_fnb',
      data : 'fnb_id='+fnb_id,
      dataType : 'json',
      success : function (data) {
        $('#fnb_charge').val(sys_to_ind(data.fnb_charge));
      }
    })
  }

  function calc_fnb() {
    var fnb_charge = ind_to_sys($('#fnb_charge').val());
    var fnb_amount = $('#fnb_amount').val();
    $('#fnb_total').val(sys_to_ind(fnb_amount*fnb_charge));
  }

  function add_fnb() {
    var billing_id = $('#billing_id').val();
    var fnb_id = $('#fnb_id').val();
    var fnb_amount = $('#fnb_amount').val();
    var fnb_charge = $('#fnb_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_fnb',
      data : 'billing_id='+billing_id+'&fnb_id='+fnb_id+'&fnb_amount='+fnb_amount+
              '&fnb_charge='+fnb_charge,
      success : function (data) {
        $('#modal_fnb_list').modal('show');
        $('#modal_fnb').modal('hide');
        get_billing_fnb();
      }
    })
  }

  function get_billing_fnb() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_fnb',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.fnb == null || data.fnb == '') {
          $("#row_fnb_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_fnb_list").append(row);
        } else {
          $("#row_fnb_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.fnb, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.fnb_name+'</td>'+
                '<td>'+sys_to_cur(item.fnb_charge)+'</td>'+
                '<td class="text-right">'+item.fnb_amount+'</td>'+
                '<td>'+sys_to_cur(item.fnb_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_fnb('+item.billing_fnb_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_fnb_list").append(row);
            })
          }else{
            $.each(data.fnb, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.fnb_name+'</td>'+
                '<td>'+sys_to_cur(item.fnb_total/item.fnb_amount)+'</td>'+
                '<td class="text-right">'+item.fnb_amount+'</td>'+
                '<td>'+sys_to_cur(item.fnb_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-xs btn-danger" onclick="delete_fnb('+item.billing_fnb_id+')"><i class="fa fa-trash"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_fnb_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_fnb(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_fnb',
      data : 'billing_fnb_id='+id,
      success : function () {
        get_billing_fnb();
      }
    })
  }

  function get_non_tax(non_tax_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_non_tax',
      data : 'non_tax_id='+non_tax_id,
      dataType : 'json',
      success : function (data) {
        $('#non_tax_charge').val(sys_to_ind(data.non_tax_charge));
      }
    })
  }

  function calc_non_tax() {
    var non_tax_charge = ind_to_sys($('#non_tax_charge').val());
    var non_tax_amount = $('#non_tax_amount').val();
    $('#non_tax_total').val(sys_to_ind(non_tax_amount*non_tax_charge));
  }

  function add_non_tax() {
    var billing_id = $('#billing_id').val();
    var non_tax_id = $('#non_tax_id').val();
    var non_tax_amount = $('#non_tax_amount').val();
    var non_tax_charge = $('#non_tax_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_non_tax',
      data : 'billing_id='+billing_id+'&non_tax_id='+non_tax_id+'&non_tax_amount='+non_tax_amount+
              '&non_tax_charge='+non_tax_charge,
      success : function (data) {
        $('#modal_non_tax_list').modal('show');
        $('#modal_non_tax').modal('hide');
        get_billing_non_tax();
      }
    })
  }

  function get_billing_non_tax() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_non_tax',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.non_tax == null || data.non_tax == '') {
          $("#row_non_tax_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_non_tax_list").append(row);
        } else {
          $("#row_non_tax_list").html('');
          $.each(data.non_tax, function(i, item) {
            var row = '<tr>'+
              '<td>'+item.non_tax_name+'</td>'+
              '<td>'+sys_to_cur(item.non_tax_charge)+'</td>'+
              '<td class="text-right">'+item.non_tax_amount+'</td>'+
              '<td>'+sys_to_cur(item.non_tax_total)+'</td>'+
              '<td class="text-center">'+
                '<button class="btn btn-xs btn-danger" onclick="delete_non_tax('+item.billing_non_tax_id+')"><i class="fa fa-trash"></i></button>'+
              '</td>'+
            '</tr>';
            $("#row_non_tax_list").append(row);
          })
        }
        get_count();
      }
    })
  }

  function delete_non_tax(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_non_tax',
      data : 'billing_non_tax_id='+id,
      success : function () {
        get_billing_non_tax();
      }
    })
  }

  function get_count() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_count',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        $('#lbl_count_room').html(data.count_room);
        $('#lbl_count_extra').html(data.count_extra);
        $('#lbl_count_service').html(data.count_service);
        $('#lbl_count_fnb').html(data.count_fnb);
        $('#lbl_count_non_tax').html(data.count_non_tax);
        $('#lbl_count_custom').html(data.count_custom);
      }
    })
  }
</script>
