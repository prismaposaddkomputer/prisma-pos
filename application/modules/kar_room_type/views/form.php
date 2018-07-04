<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_room_type/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="room_type_id" value="<?php if($room_type != null){echo $room_type->room_type_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="room_type_name" value="<?php if($room_type != null){echo $room_type->room_type_name;}?>">
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Kapasitas <small class="required-field">*</small></label>
              <div class="input-group">
                <input class="form-control keyboard" type="number" name="room_type_capacity" value="<?php if($room_type != null){echo $room_type->room_type_capacity;}?>">
                <span class="input-group-addon">Orang</span>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($room_type != null){if($room_type->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Weekday (Happy Hours) <small class="required-field">*</small></label>
              <input class="form-control keyboard autonumeric" type="text" name="weekday_happy_hours" value="<?php if($room_type != null){echo $room_type->weekday_happy_hours;}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Weekday (Business Hours) <small class="required-field">*</small></label>
              <input class="form-control keyboard autonumeric" type="text" name="weekday_business_hours" value="<?php if($room_type != null){echo $room_type->weekday_business_hours;}?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Weekend (Happy Hours) <small class="required-field">*</small></label>
              <input class="form-control keyboard autonumeric" type="text" name="weekend_happy_hours" value="<?php if($room_type != null){echo $room_type->weekend_happy_hours;}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Weekend (Business Hours) <small class="required-field">*</small></label>
              <input class="form-control keyboard autonumeric" type="text" name="weekend_business_hours" value="<?php if($room_type != null){echo $room_type->weekend_business_hours;}?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Holiday (Happy Hours) <small class="required-field">*</small></label>
              <input class="form-control keyboard autonumeric" type="text" name="holiday_happy_hours" value="<?php if($room_type != null){echo $room_type->holiday_happy_hours;}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Holiday (Business Hours) <small class="required-field">*</small></label>
              <input class="form-control keyboard autonumeric" type="text" name="holiday_business_hours" value="<?php if($room_type != null){echo $room_type->holiday_business_hours;}?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_room_type/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
    <div class="col-md-12">
      Keterangan :
      <ul>
        <li>Weekday (Mon - Friday)</li>
        <li>Weekend (Saturday - Sunday)</li>
        <?php foreach ($time as $row): ?>
          <li><?=$row->time_name?> (<?=$row->time_start.' - '.$row->time_end?>)</li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'room_type_id': {
          required: true
        },
        'room_type_name': {
          required: true
        }
      },
      messages: {
        'room_type_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'room_type_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
