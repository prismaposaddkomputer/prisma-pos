<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="<?=base_url()?>kar_reservation/<?=$action?>" method="post">
    <h4><i class="fa fa-file-o"></i> Data Pemesanan</h4>
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
        <h5 class="cl-success"><strong><i class="fa fa-arrow-down"></i> In (Masuk)</strong></h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal <b class="required-field">*</b></small></label>
              <input class="form-control date-picker" type="text" name="billing_date_in" id="billing_date_in" value="<?php if($billing != null){echo ($billing->billing_date_in == 0) ? date("d-m-Y") : date_to_ind($billing->billing_date_in) ;}else{echo date('d-m-Y');}?>" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu <b class="required-field">*</b></small></label>
              <input class="form-control time-picker" type="text" name="billing_time_in" id="billing_time_in" value="<?php if($billing != null){echo ($billing->billing_time_in == 0) ? date("H:i:s") : $billing->billing_time_in ;}else{echo date('H:i:s');}?>" readonly>
            </div>
          </div>
        </div>

        <!-- <?php if ($billing != null): ?>
        <h5 class="cl-danger"><strong><i class="fa fa-arrow-up"></i> Out (Keluar)</strong></h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal <b class="required-field">*</b></small></label>
              <input class="form-control date-picker" type="text" name="" value="<?=date("d-m-Y")?>" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu <b class="required-field">*</b></small></label>
              <input class="form-control time-picker" type="text" name="" value="<?=date("H:i:s")?>" readonly>
            </div>
          </div>
        </div>
      <?php endif; ?> -->

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

        <button class="btn btn-info" id="btn_room_list" type="button"><i class="fa fa-home"></i> Room <span class="badge" id="lbl_count_room">0</span></button>
        <button class="btn btn-info" id="btn_paket_list" type="button"><i class="fa fa-cubes"></i> Paket <span class="badge" id="lbl_count_paket">0</span></button>
        <!-- <button class="btn btn-info" id="btn_extra_list" type="button"><i class="fa fa-plus-square"></i> Ekstra <span class="badge" id="lbl_count_extra">0</span></button> -->
        <button class="btn btn-info" id="btn_service_list" type="button"><i class="fa fa-plus-square"></i> Pelayanan <span class="badge" id="lbl_count_service">0</span></button>
        <button class="btn btn-info" id="btn_fnb_list" type="button"><i class="fa fa-cutlery"></i> F&B <span class="badge" id="lbl_count_fnb">0</span></button>
        <button style="margin-top: 4px;" class="btn btn-info" id="btn_non_tax_list" type="button"><i class="fa fa-ban"></i> Non Pajak <span class="badge" id="lbl_count_non_tax">0</span></button>
        <button style="margin-top: 4px;" class="btn btn-info" id="btn_custom_list" type="button"><i class="fa fa-list"></i> Kustom <span class="badge" id="lbl_count_custom">0</span></button>
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
            <select class="form-control select2" name="form_guest_id" id="jenis_tamu_langganan">
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
          <a class="btn btn-default" href="<?=base_url()?>kar_reservation/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-warning" type="submit" name="action" value="save_temp">Simpan Sementara <i class="fa fa-save"></i></button>
          <button class="btn btn-success" type="submit" name="action" value="save_payment">Simpan & Lanjut Pembayaran <i class="fa fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modals -->
<!-- Room List -->
<?php $this->view('kar_reservation/_room_list'); ?>

<!-- Room -->
<?php $this->view('kar_reservation/_room'); ?>

<!-- Room Update -->
<?php $this->view('kar_reservation/_room_update'); ?>

<!-- Extra List -->
<?php $this->view('kar_reservation/_extra_list'); ?>

<!-- Extra -->
<?php $this->view('kar_reservation/_extra'); ?>

<!-- custom List -->
<?php $this->view('kar_reservation/_custom_list'); ?>

<!-- custom -->
<?php $this->view('kar_reservation/_custom'); ?>

<!-- custom update -->
<?php $this->view('kar_reservation/_custom_update'); ?>

<!-- Service List -->
<?php $this->view('kar_reservation/_service_list'); ?>

<!-- Service -->
<?php $this->view('kar_reservation/_service'); ?>

<!-- Service Update -->
<?php $this->view('kar_reservation/_service_update'); ?>

<!-- Paket List -->
<?php $this->view('kar_reservation/_paket_list'); ?>

<!-- Paket -->
<?php $this->view('kar_reservation/_paket'); ?>

<!-- Paket Update -->
<?php $this->view('kar_reservation/_paket_update'); ?>

<!-- Fnb List -->
<?php $this->view('kar_reservation/_fnb_list'); ?>

<!-- FnB -->
<?php $this->view('kar_reservation/_fnb'); ?>

<!-- FnB Update -->
<?php $this->view('kar_reservation/_fnb_update'); ?>

<!-- Non Pajak List -->
<?php $this->view('kar_reservation/_non_pajak_list'); ?>

<!-- Non Pajak -->
<?php $this->view('kar_reservation/_non_pajak'); ?>

<!-- Non Pajak Update -->
<?php $this->view('kar_reservation/_non_pajak_update'); ?>

<!-- Javascript -->
<?php $this->view('kar_reservation/_js'); ?>

