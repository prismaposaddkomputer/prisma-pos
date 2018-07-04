<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_time/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="time_id" value="<?php if($time != null){echo $time->time_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control" type="text" name="time_name" value="<?php if($time != null){echo $time->time_name;}?>" readonly>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu Mulai <small class="required-field">*</small></label>
              <input class="form-control time-picker" type="text" name="time_start" value="<?php if($time != null){echo $time->time_start;}else{echo '00:00:00';}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu Akhir <small class="required-field">*</small></label>
              <input class="form-control time-picker" type="text" name="time_end" value="<?php if($time != null){echo $time->time_end;}else{echo '23:59:00';}?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($time != null){if($time->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_time/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#time_per_hour').hide();
    $('input[name=time_is_flat]').change(function() {
      if($(this).is(":checked")) {
        $('input[name=time_per_hour]').val('0');
        $('#time_per_hour').show();
      }else{
        $('#time_per_hour').hide();
      }
    });

    <?php if ($action == 'update'): ?>
      $('#time_per_hour').show();
    <?php endif; ?>

    $("#form").validate({
      rules: {
        'time_id': {
          required: true
        },
        'time_name': {
          required: true
        },
        'time_rate': {
          required: true
        }
      },
      messages: {
        'time_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'time_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'time_rate': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
