<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="<?=base_url()?>hot_reservation/<?=$action?>" method="post">
    <h4><i class="fa fa-file-o"></i> Data Reservasi</h4>
    <div class="row">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="billing_id" id="billing_id" value="<?php if($billing != null){echo $billing->billing_id;}?>">
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
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Uang Muka</label>
              <input class="form-control autonumeric keyboard " type="text" name="billing_down_payment" id="billing_down_payment" value="<?php if($billing != null){echo $billing->billing_down_payment;}else{echo 0;}?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Jenis Tamu <small class="required-field">*</small></label>
          <br>
          <label class="radio-inline">
            <input type="radio" name="guest_type" id="guest_type" value="0"/> Tamu Baru
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="radio-inline">
            <input type="radio" name="guest_type" id="guest_type" value="1"/> Tamu Langganan (guest)
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
               <input type="radio" name="guest_gender" value="L" checked/> Laki-laki
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
    <hr>
    <div class="row">
      <div class="col-md-6">
        <h4><i class="fa fa-bed"></i> Kamar</h4>
        <div class="row">
          <div class="col-md-6">
            <label>Tipe Kamar</label>
            <select class="form-control select2" id="room_type_id">
              <option value="0">-- Pilih --</option>
              <?php foreach ($room_type as $row): ?>
                <option value="<?=$row->room_type_id?>"><?=$row->room_type_name;?> (<?=num_to_price($row->room_type_charge)?>)</option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-4">
            <label>Kamar</label>
            <select class="form-control select2" id="room_id">
              <option value="0">-- Pilih --</option>
            </select>
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <button class="btn btn-info form-control" type="button" id="btn_add_room"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
        <table id="tbl_room" class="table table-bordered table-striped table-condensed">
          <thead>
            <tr>
              <th>Jenis Kamar</th>
              <th>Kamar</th>
              <th width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="room_list">

          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h4><i class="fa fa-plus-square"></i> Ekstra</h4>
        <div class="row">
          <div class="col-md-10">
            <label>Item Ekstra</label>
            <select class="form-control select2" id="extra_id">
              <option value="0">-- Pilih --</option>
              <?php foreach ($extra as $row): ?>
                <option value="<?=$row->extra_id?>"><?=$row->extra_name;?> (<?=num_to_price($row->extra_charge)?>)</option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <button class="btn btn-info form-control" type="button" id="btn_add_extra"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
        <table id="tbl_extra" class="table table-bordered table-striped table-condensed">
          <thead>
            <tr>
              <th>Item Ekstra</th>
              <th width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="extra_list">

          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h4><i class="fa fa-bell"></i> Pelayanan (Biaya Lain-lain)</h4>
        <div class="row">
          <div class="col-md-10">
            <label>Item Pelayanan (Biaya Lain-lain)</label>
            <select class="form-control select2" id="service_id">
              <option value="0">-- Pilih --</option>
              <?php foreach ($service as $row): ?>
                <option value="<?=$row->service_id?>"><?=$row->service_name;?> (<?=num_to_price($row->service_charge)?>)</option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <button class="btn btn-info form-control" type="button" id="btn_add_service"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
        <table id="tbl_service" class="table table-bordered table-striped table-condensed">
          <thead>
            <tr>
              <th>Item Pelayanan (Biaya Lain-lain)</th>
              <th width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="service_list">

          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h4><i class="fa fa-cutlery"></i> Food and Beverage</h4>
        <div class="row">
          <div class="col-md-10">
            <label>Item FnB</label>
            <select class="form-control select2" id="fnb_id">
              <option value="0">-- Pilih --</option>
              <?php foreach ($fnb as $row): ?>
                <option value="<?=$row->fnb_id?>"><?=$row->fnb_name;?> (<?=num_to_price($row->fnb_charge)?>)</option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label>
            <button class="btn btn-info form-control" type="button" id="btn_add_fnb"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
        <table id="tbl_fnb" class="table table-bordered table-striped table-condensed">
          <thead>
            <tr>
              <th>Item FnB</th>
              <th width="50">Aksi</th>
            </tr>
          </thead>
          <tbody id="fnb_list">

          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_room/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
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

    $('#btn_add_room').click(function () {
      add_room();
    });

    $("#tbl_room").on('click', '.btn_remove_room', function () {
      $(this).closest('tr').remove();
    });

    $('#btn_add_extra').click(function () {
      add_extra();
    });

    $("#tbl_extra").on('click', '.btn_remove_extra', function () {
      $(this).closest('tr').remove();
    });

    $('#btn_add_service').click(function () {
      add_service();
    });

    $("#tbl_service").on('click', '.btn_remove_service', function () {
      $(this).closest('tr').remove();
    });

    $('#btn_add_fnb').click(function () {
      add_fnb();
    });

    $("#tbl_fnb").on('click', '.btn_remove_fnb', function () {
      $(this).closest('tr').remove();
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
        }
      }
    });
  });

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
        $("#room_id option").each(function() {
          $(this).remove();
        });
        $("#room_id").select2({
          data: data
        }).trigger('change');
      }
    })
  }

  function add_room() {
    var room_type_id = $("#room_type_id").val();
    var room_type_name = $('#room_type_id option:selected').text();
    var room_id = $("#room_id").val();
    var room_name = $('#room_id option:selected').text();
    
    if (room_type_id == 0) {
      alert('Pilih Tipe Kamar!');
    } else if(room_id == 0) {
      alert('Pilih Kamar!');
    } else {
      var row = '<tr>'+
          '<td>'+room_type_name+'</td>'+
          '<td>'+room_name+'</td>'+
          '<td class="text-center">'+
            '<input type="hidden" name="room_id[]" value="'+room_id+'">'+
            '<button class="btn btn-xs btn-danger btn_remove_room" type="button"><i class="fa fa-trash"></i></button>'+
          '</td>'+
        '</tr>';
    }
    
    $('#room_list').append(row);
  }

  function add_extra() {
    var extra_id = $("#extra_id").val();
    var extra_name = $('#extra_id option:selected').text();
    
    if(extra_id == 0) {
      alert('Pilih Ekstra!');
    } else {
      var row = '<tr>'+
          '<td>'+extra_name+'</td>'+
          '<td class="text-center">'+
            '<input type="hidden" name="extra_id[]" value="'+extra_id+'">'+
            '<button class="btn btn-xs btn-danger btn_remove_extra" type="button"><i class="fa fa-trash"></i></button>'+
          '</td>'+
        '</tr>';
    }
    
    $('#extra_list').append(row);
  }

  function add_service() {
    var service_id = $("#service_id").val();
    var service_name = $('#service_id option:selected').text();
    
    if(service_id == 0) {
      alert('Pilih Pelayanan (Biaya Lain-lain)!');
    } else {
      var row = '<tr>'+
          '<td>'+service_name+'</td>'+
          '<td class="text-center">'+
            '<input type="hidden" name="service_id[]" value="'+service_id+'">'+
            '<button class="btn btn-xs btn-danger btn_remove_service" type="button"><i class="fa fa-trash"></i></button>'+
          '</td>'+
        '</tr>';
    }
    
    $('#service_list').append(row);
  }

  function add_fnb() {
    var fnb_id = $("#fnb_id").val();
    var fnb_name = $('#fnb_id option:selected').text();
    
    if(fnb_id == 0) {
      alert('Pilih Pelayanan (Biaya Lain-lain)!');
    } else {
      var row = '<tr>'+
          '<td>'+fnb_name+'</td>'+
          '<td class="text-center">'+
            '<input type="hidden" name="fnb_id[]" value="'+fnb_id+'">'+
            '<button class="btn btn-xs btn-danger btn_remove_fnb" type="button"><i class="fa fa-trash"></i></button>'+
          '</td>'+
        '</tr>';
    }
    
    $('#fnb_list').append(row);
  }
</script>
