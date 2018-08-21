<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="<?=base_url()?>hot_billing/<?=$action?>" method="post">
    <h4>Data Reservasi</h4>
    <div class="row">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="billing_id" id="billing_id" value="<?php if($billing != null){echo $billing_type->billing_id;}?>">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>No. Nota</label>
              <input class="form-control" type="text" name="billing_receipt_no" id="billing_receipt_no" value="<?php if($billing != null){echo $billing_type->billing_receipt_no;}else{echo $billing_receipt_no;}?>" readonly>
            </div>
          </div>
        </div>
        <h5 class="cl-success"><strong>Check In</strong></h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal <b class="required-field">*</b></small></label>
              <input class="form-control date-picker" type="text" name="billing_date_in" id="billing_date_in" value="<?php if($billing != null){echo date_to_ind($billing->billing_date_in);}else{echo date('d-m-Y');};?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu <b class="required-field">*</b></small></label>
              <input class="form-control time-picker" type="text" name="billing_time_in" id="billing_time_in" value="<?php if($billing != null){echo $billing->billing_time_start;}else{echo date('H:i:s');};?>">
            </div>
          </div>
        </div>
        <h5 class="cl-danger"><strong>Check Out</strong></h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal <b class="required-field">*</b></small></label>
              <input class="form-control date-picker" type="text" name="billing_date_out" id="billing_date_out" value="<?php if($billing != null){echo date_to_ind($billing->billing_date_in);}else{echo date('d-m-Y');};?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Waktu <b class="required-field">*</b></small></label>
              <input class="form-control time-picker" type="text" name="billing_time_out" id="billing_time_out" value="<?php if($billing != null){echo $billing->billing_time_start;}else{echo date('H:i:s');};?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Jenis Tamu <small class="required-field">*</small></label>
          <br>
          <label class="radio-inline">
            <input type="radio" name="guest_type" id="guest_type" value="0" <?php if($billing != null){if($billing->guest_type == '0'){echo 'checked';}}else{echo 'checked';}?>/> Tamu Baru
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="radio-inline">
            <input type="radio" name="guest_type" id="guest_type" value="1" <?php if($billing != null){if($billing->guest_type == '1'){echo 'checked';}}?>/> Tamu Langganan (guest)
          </label>
        </div>
        <div class="form-group" id="member_div"> 
          <label>Nama Member</label>
          <select class="form-control select2" id="member_list">
            <option value="0">--- Pilih Member ---</option>
            <?php foreach ($member as $row): ?>
              <option value="<?=$row->member_id?>"><?=$row->member_name?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="form-group" id="guest_name_div">
          <label>Nama Tamu / Plat Nomor Kendaraan <small class="required-field">*</small></label>
          <input class="form-control keyboard " type="text" name="guest_name" id="guest_name" value="">
        </div>
        <div class="form-group">
          <label>Jenis Kelamin <small class="required-field">*</small></label>
          <br>
            <label class="radio-inline">
               <input type="radio" name="guest_gender" value="L"/> Laki-laki
            </label>
            &nbsp;&nbsp;&nbsp;
            <label class="radio-inline">
               <input type="radio" name="guest_gender" value="P"/> Perempuan
            </label>
        </div>
        <div class="form-group">
          <label>No Telpon <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
          <input class="form-control num " type="text" name="guest_phone" id="guest_phone" value="">
        </div>
        <div class="form-group">
          <label>Pilih Identitas <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
          <select class="form-control select2 " name="guest_id_type" id="guest_id_type">
            <option value="1">Tidak Ada</option>
            <option value="2">KTP</option>
            <option value="3">SIM</option>
            <option value="4">Lainnya</option>
          </select>
        </div>
        <div class="form-group" id="no">
          <label>No Identitas <span id="label"></span> <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
          <input class="form-control num " type="text" name="guest_id_no" id="guest_id_no" value="">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h4>Kamar</h4>
        <div class="row">
          <div class="col-md-4">
            <label>Tipe Kamar</label>
            <select class="form-control select2" id="room_type_id">
              <?php foreach ($room_type as $row): ?>
                <option value="<?=$row->room_type_id?>"><?=$row->room_type_name;?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-5">
            <label>Kamar</label>
            <select class="form-control select2" id="room_id">
              
            </select>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    //initial on page is loaded
    $('#member_div').hide();
    
    $('#form #guest_type').on('change', function() {
      var guest_type = $('#guest_type:checked', '#form').val();
      if (guest_type == '0') {
        $('#member_div').hide();
        $('#guest_name').prop('readonly', false);
        $('#guest_name_div').show();
        $('#guest_phone').prop('readonly', false);
        // $("#guest_id_type").select2({'disabled':'readonly'});
        $('#guest_id_no').prop('readonly', false);
      }else if (guest_type == '1') {
        $('#member_div').show();
        $('#guest_name').prop('readonly', true);
        $('#guest_name_div').hide();
        $('#guest_phone').prop('readonly', true);
        // $("#guest_id_type").select2().readonly(true);
        $('#guest_id_no').prop('readonly', true);
      }
    });

    $('#member_list').on('change', function() {
      get_member(this.value);
    });

    $('#room_type_id').on('change', function() {
      get_room(this.value);
    });

    $("#form").validate({
      rules: {
        'billing_name': {
          required: true
        },
        'billing_charge': {
          required: true,
          number: true
        }
      },
      messages: {
        'billing_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_charge': {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        }
      }
    });
  })

 $('[name=status]').change(function(){
		if($(this).val()==1){
			$('[name=before_tax]').prop('readonly',true);
      $('[name=after_tax]').prop('readonly',false);
     
    }else{
			$('[name=before_tax]').prop('readonly',false);
      $('[name=after_tax]').prop('readonly',true);	
		}
  });
  
  function get_member(member_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_member',
      data : 'member_id='+member_id,
      dataType : 'json',
      success : function (data) {
        $('#guest_name').val(data.member_name);
        $('#guest_phone').val(data.member_phone);
        $('#form').find(':radio[name=guest_gender][value="'+data.member_gender+'"]').prop('checked', true);
        $('#guest_id_type').val(data.member_id_type).trigger('change');
        $('#guest_id_no').val(data.member_id_no);
      }
    })
  }

  function get_room(room_type_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_room',
      data : 'room_type_id='+room_type_id,
      dataType : 'json',
      success : function (data) {
        console.log(data);
        
        // $("#room_id").select2({
        //   data: data
        // });
      }
    })
  }
</script>
