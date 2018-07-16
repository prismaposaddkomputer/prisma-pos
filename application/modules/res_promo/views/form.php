<div class="content-header">
  <h4><i class="fa fa-ticket"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="<?=base_url()?>res_promo/<?=$action?>" method="post">
    <div class="row">
      <div class="col-md-6">
        <input type="hidden" name="promo_id" value="<?php if($promo != null){echo $promo->promo_id;}else{echo $new_id;}?>">
        <div class="form-group">
          <label>Nama Promo <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="promo_name" value="<?php if($promo != null){echo $promo->promo_name;}?>">
        </div>
        <div class="form-group">
          <label>Jenis Promo <small class="required-field">*</small></label>
          <select class="form-control keyboard select2" name="promo_type_id" <?php if($action == 'update'){echo 'disabled';} ?>>
            <?php foreach ($promo_type_list as $row): ?>
              <option value="<?=$row->promo_type_id?>" <?php if($promo != null){if($promo->promo_type_id == $row->promo_type_id){echo 'selected';};}?>><?=$row->promo_type_name?></option>
            <?php endforeach; ?>
          </select>
          <?php if ($action == 'update'): ?>
            <input type="hidden" name="promo_type_id" value="<?php if($promo != null){echo $promo->promo_type_id;}?>">
          <?php endif; ?>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Tanggal Mulai <small class="required-field">*</small></label>
              <div class="input-group">
                <input type="text" class="form-control date-picker" name="promo_date_start" value="<?php if($promo != null){echo date_to_ind($promo->promo_date_start);}else{echo date('d-m-Y');};?>">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
              </div>
            </div>
            <div class="col-md-6">
              <label>Tanggal Berakhir <small class="required-field">*</small></label>
              <div class="input-group">
                <input type="text" class="form-control date-picker" name="promo_date_end" value="<?php if($promo != null){echo date_to_ind($promo->promo_date_end);}else{echo date('d-m-Y');};?>">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Jam Mulai <small class="required-field">*</small></label>
              <div class="input-group bootstrap-timepicker">
                <input type="text" class="form-control time-picker" name="promo_time_start" value="<?php if($promo != null){echo $promo->promo_time_start;}else{echo '00:00:01';};?>">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-time"></i>
                </span>
              </div>
            </div>
            <div class="col-md-6">
              <label>Jam Berakhir <small class="required-field">*</small></label>
              <div class="input-group bootstrap-timepicker">
                <input type="text" class="form-control time-picker" name="promo_time_end" value="<?php if($promo != null){echo $promo->promo_time_end;}else{echo '23:59:59';};?>">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-time"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <h4>Ketentuan Promo</h4>
        <div id="type_1">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label>Jika membeli</label>
                <select class="form-control keyboard select2" name="buy_item_id1">
                  <?php foreach ($item as $row): ?>
                    <option value="<?=$row->item_id?>" <?php if($promo != null && $promo->promo_type_id == 1){if($promo->buy_item_id == $row->item_id){echo 'selected';}}?>><?=$row->item_name?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Sebanyak</label>
                <input class="form-control num" type="number" name="buy_amount1" dir="rtl" value="<?php if($promo != null && $promo->promo_type_id == 1){echo $promo->buy_amount;}?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label>Akan mendapatkan</label>
                <select class="form-control keyboard select2" name="get_item_id1">
                  <?php foreach ($item as $row): ?>
                    <option value="<?=$row->item_id?>" <?php if($promo != null && $promo->promo_type_id == 1){if($promo->get_item_id == $row->item_id){echo 'selected';}}?>><?=$row->item_name?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Sebanyak</label>
                <input class="form-control num" type="number" name="get_amount1" dir="rtl" value="<?php if($promo != null && $promo->promo_type_id == 1){echo $promo->get_amount;}?>">
              </div>
            </div>
          </div>
        </div>
        <div id="type_2">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label>Jika membeli</label>
                <select class="form-control keyboard select2" name="buy_item_id2">
                  <?php foreach ($item as $row): ?>
                    <option value="<?=$row->item_id?>" <?php if($promo != null && $promo->promo_type_id == 2){if($promo->buy_item_id == $row->item_id){echo 'selected';}}?>><?=$row->item_name?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Sebanyak</label>
                <input class="form-control num" type="number" name="buy_amount2" dir="rtl" value="<?php if($promo != null && $promo->promo_type_id == 2){echo $promo->buy_amount;}?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Mendapat diskon sebanyak (%)</label>
                <div class="row">
                  <div class="col-md-3">
                    <input class="form-control num" type="number" name="get_discount2" dir="rtl" value="<?php if($promo != null && $promo->promo_type_id == 2){echo $promo->get_discount;}?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="type_3">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jika total pemembelian sebanyak (Rp)</label>
                <div class="row">
                  <div class="col-md-4">
                    <input class="form-control num" type="number" name="buy_amount3" dir="rtl" value="<?php if($promo != null && $promo->promo_type_id == 3){echo $promo->buy_amount;}?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Mendapat diskon sebanyak (%)</label>
                <div class="row">
                  <div class="col-md-3">
                    <input class="form-control num" type="number" name="get_discount3" dir="rtl" value="<?php if($promo != null && $promo->promo_type_id == 3){echo $promo->get_discount;}?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <label>Promo ini berlaku pada hari</label><br>
        <?php
          $all = null;
          if(
            $promo != null &&
            $promo->promo_sunday == '1' &&
            $promo->promo_monday == '1' &&
            $promo->promo_tuesday == '1' &&
            $promo->promo_wednesday == '1' &&
            $promo->promo_thursday == '1' &&
            $promo->promo_friday == '1' &&
            $promo->promo_saturday == '1'
          ){
            $all = 1;
          }
        ?>
        <input class="all" type="checkbox" name="all" value="1" <?php if($promo != null){if($all == '1'){echo 'checked';}}?>> Setiap Hari<br/>
        <div style="margin-left:17px;">
          <input class="day" type="checkbox" name="promo_sunday" value="1" <?php if($promo != null){if($promo->promo_sunday == '1'){echo 'checked';}}?>> Minggu<br/>
          <input class="day" type="checkbox" name="promo_monday" value="1" <?php if($promo != null){if($promo->promo_monday == '1'){echo 'checked';}}?>> Senin<br/>
          <input class="day" type="checkbox" name="promo_tuesday" value="1" <?php if($promo != null){if($promo->promo_tuesday == '1'){echo 'checked';}}?>> Selasa<br/>
          <input class="day" type="checkbox" name="promo_wednesday" value="1" <?php if($promo != null){if($promo->promo_wednesday == '1'){echo 'checked';}}?>> Rabu<br/>
          <input class="day" type="checkbox" name="promo_thursday" value="1" <?php if($promo != null){if($promo->promo_thursday == '1'){echo 'checked';}}?>> Kamis<br/>
          <input class="day" type="checkbox" name="promo_friday" value="1" <?php if($promo != null){if($promo->promo_friday == '1'){echo 'checked';}}?>> Jum'at<br/>
          <input class="day" type="checkbox" name="promo_saturday" value="1" <?php if($promo != null){if($promo->promo_saturday == '1'){echo 'checked';}}?>> Sabtu<br/>
        </div>
      </div>
    </div>
    <div class="form-group pull-right">
      <a class="btn btn-default" href="<?=base_url()?>admin/promo"><i class="fa fa-close"></i> Batal</a>
      <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function () {

    // type section
    $("#type_1").show();
    $("#type_2").hide();
    $("#type_3").hide();
    $("select[name=promo_type_id]").on('change', function () {
      switch (this.value) {
        case '1':
          $("#type_1").show();
          $("#type_2").hide();
          $("#type_3").hide();
          break;

        case '2':
          $("#type_1").hide();
          $("#type_2").show();
          $("#type_3").hide();
          break;

        case '3':
          $("#type_1").hide();
          $("#type_2").hide();
          $("#type_3").show();
          break;
      }
    })

    <?php if ($action == 'update'): ?>
      var promo_type_id = $('select[name=promo_type_id]').find(":selected").val();
      switch (promo_type_id) {
        case '1':
          $("#type_1").show();
          $("#type_2").hide();
          $("#type_3").hide();
          break;

        case '2':
          $("#type_1").hide();
          $("#type_2").show();
          $("#type_3").hide();
          break;

        case '3':
          $("#type_1").hide();
          $("#type_2").hide();
          $("#type_3").show();
          break;
      }
    <?php endif; ?>


    // promo day section
    $('input[name=all]').click(function () {
      if(this.checked){
        $('.day').prop("checked",true);
      }else{
        $('.day').prop("checked",false);
      }
    })

    // form validate section
    $("#form").validate({
      rules: {
        'promo_name': {
          required: true
        },
        'promo_date_start': {
          required: true
        },
        'promo_date_end': {
          required: true
        },
        'promo_time_start': {
          required: true
        },
        'promo_time_end': {
          required: true
        }
      },
      messages: {
        'promo_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'promo_date_start': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'promo_date_end': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'promo_time_start': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'promo_time_end': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
