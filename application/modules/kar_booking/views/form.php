<script type="text/javascript">
      $(function() {
          $('input[name="product_nm"]').bind('keyup',function(e) {
              e.preventDefault();
              $.get('<?=site_url("selling/ajax/permalink")?>?product_nm='+$(this).val(),null,function(data) {
                  $('input[name="product_url"]').val(data.permalink);
              },'json');      
          });

          $('#add_service').bind('click',function(e) {
              e.preventDefault();
              var image_no = $('#image_no').val();
              __get_image(image_no);
          });
          __get_image('0','<?=@$main["product_id"]?>','<?=count(@$main["product_image"])?>');
          function __get_image(image_no, product_id, count_image) {
              if(count_image == 0) {
                  var image_var = '';
              } else {
                  var image_var = '&product_id='+product_id;
              }
              //
              $.get('<?=site_url("selling/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
                  $('#box_image').append(data.html);
                  $('#image_no').val(data.image_no);
              },'json');
          }
          // autonumeric
          $("input[name='price']").autoNumeric({
              aSep: ".", aDec: ",", vMax: "999999999999999", vMin: "0"
          });
      });
</script>
<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_booking/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="booking_id" value="<?php if($booking != null){echo $booking->booking_id;}?>">
        <div class="form-group">
          <label>Check In<small class="required-field">*</small></label>
          <input class="form-control" type="text" id="check_in" value=" <?php if($booking != null){echo ind_to_date($booking->date_booking_from);}else{ echo date('d-m-y');}?>" readonly="true">
          
        </div>
        <div class="form-group">
          <label>Durasi (Hari)<small class="required-field">*</small></label>
          <input class="form-control num" type="number" min="0" max="7" id="number_of_days" name="number_of_days" value="<?php if($booking != null){echo $booking->number_of_days;}?>" required>
        </div>
        <div class="form-group">
          <label>Check Out<small class="required-field">*</small></label>
          <input class="form-control" type="text" id="date_booking_to" value="<?php if($booking != null){echo ind_to_date($booking->date_booking_to);}?>" readonly="true">
        </div>
        <div class="form-group">
             <label>Nama Tamu<small class="required-field">*</small></label>
             <select class="form-control select2" name="guest_id">
              <?php foreach ($guest as $row): ?>
                <option value="<?=$row->guest_id?>" <?php if($booking != null){if($row->guest_id == $booking->guest_id){echo 'selected';};}?>><?=$row->guest_name?></option>
              <?php endforeach; ?>
            </select>
					</div>
					<div class="form-group" id="service1">
            <label>Pelayanan Kamar<small class="required-field">*</small></label>
            <select class="form-control select2" name="service_id">
                      <option value="0">Tidak Ada</option>
                      <?php foreach ($service as $row): ?>
                        <option value="<?=$row->service_id?>" <?php if($booking != null){if($row->service_id == $booking->service_id){echo 'selected';};}?>><?=$row->service_name?></option>
                      <?php endforeach; ?>
                    </select>
            
          </div>
         

          <div class="form-group">
            <label>Pilih Kamar<small class="required-field">*</small></label>
            <select class="form-control select2" name="room_id">
                        <?php foreach ($room as $row): ?>
                          <option value="<?=$row->room_id?>" <?php if($booking != null){if($row->room_id == $booking->room_id){echo 'selected';};}?>><?=$row->room_name?></option>
                        <?php endforeach; ?>
                      </select>
          </div>
          
          <br>
          <?php
            $year = date('Y');
            $month = date('m');
            $tgl = date('d');
            $jam = date('h:i:sa');
            $split=explode(':', $jam);
            $kode=$split[2]+"as"+$split[2]+"-"+$split[1]+"-"+$tgl+"-"+$month+"-"+$year;
          ?>

          <input class="form-control" type="hidden" id="xsaa" name="booking_code" value="<?=$kode?>">

          <input class="form-control" type="hidden" id="xs" value="">
          <input class="form-control" type="hidden" id="xsz" value="">
          <input class="form-control" type="hidden" id="xz" name="date_booking_to" value="">
       

        <div class="form-group" style="display:none;">
          <label>Aktif?</label><br>
          <input class="" type="hidden" name="is_active" value="1" />
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_booking/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'booking_id': {
          required: true
        },
        'booking_name': {
          required: true
        }
      },
      messages: {
        'booking_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'booking_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });

         $('#number_of_days').change(function(){
        	var value = $(this).val();
        	value = parseInt(value);
          var next = Date.today().add(value).days();
          $('#date_booking_to').val(next.toString('dd-MM-yyyy'));
          var z=$('#date_booking_to').val();
          var s= $('#check_in').val();
          var res = s.split("-");
          var resz = z.split("-");
          $('#xs').val(res[2]+"-"+res[1]+"-"+res[0]);
          $('#xsz').val(res[2]+"-"+res[1]+"-"+res[0]);
          $('#xz').val(resz[2]+"-"+resz[1]+"-"+resz[0]);
        });

  })

  function AddService(){
		var row = $('.service').length;
		if(row>1){
			var index = $('.service').last().attr('id');
			index = index.substr(10);
			index = parseInt(index);
			row = parseInt(row);
			row = index+1;
		}
		var html = '<div class="form-group" id="service'+row+'" ><table width="100%"><tr><td width="80%"><select class="form-control select2" name="service_id[]">';
		html+= '<option value="0">Tidak Ada</option>';
	             <?php foreach ($service as $row): ?>
    html+=      '<option value="<?=$row->service_id?>" <?php if($booking != null){if($row->service_id == $bookings->service_id){echo 'selected';};}?>><?=$row->service_name?></option>';
              <?php endforeach; ?>
    html+='</select></td><td width="5%"></td><td width="15%">';
    html+= '<a href="javascript:void(0)" onclick="javascript:DeleteService('+row+')" title="Delete Service" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
		html+= '</td></tr></table></div>';
		$('#data-service').append(html);
		
	}

  function DeleteService(x){
		$('#service'+x).remove();
	}


  function AddRoom(){
		var row = $('.room').length;
		if(row>1){
			var index = $('.room').last().attr('id');
			index = index.substr(10);
			index = parseInt(index);
			row = parseInt(row);
			row = index+1;
		}
		var html = '<div class="form-group" id="room'+row+'" ><table width="100%"><tr><td width="80%"><select class="form-control select2" name="room_id[]">';
              <?php foreach ($room as $row): ?>
    html+='<option value="<?=$row->room_id?>" <?php if($booking != null){if($row->room_id == $booking->room_id){echo 'selected';};}?>><?=$row->room_name?></option>';
              <?php endforeach; ?>
    html+='</select></td><td width="5%"></td><td width="15%">';
    html+= '<a href="javascript:void(0)" onclick="javascript:DeleteRoom('+row+')" title="Delete Service" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
		html+= '</td></tr></table></div>';
		$('#data-room').append(html);
		
	}

  function DeleteRoom(x){
		$('#room'+x).remove();
	}


</script>
