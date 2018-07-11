<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_payment/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="booking_id" value="<?php if($booking != null){echo $booking->booking_id;}?>">
        <div class="form-group">
          <label>Check In<small class="required-field">*</small></label>
          <input class="form-control date-picker" type="text" id="check_in" value=" <?php if($booking != null){echo ind_to_date($booking->date_booking_from);}else{ echo date('d-m-y');}?>" readonly="true">
          
        </div>
        <div class="form-group">
          <label>Durasi<small class="required-field">*</small></label>
          <input readonly="true" class="form-control" type="number" min="1" max="7" id="number_of_days" name="number_of_days" value="<?php if($booking != null){echo $booking->number_of_days;}?>">
        </div>
        <div class="form-group">
          <label>Check Out<small class="required-field">*</small></label>
          <input class="form-control date-picker" id="date_booking_to" readonly="true" value="<?php if($booking != null){echo ind_to_date($booking->date_booking_to);}?>" readonly="true">
        </div>
        <div class="form-group">
             <label>Nama Tamu<small class="required-field">*</small></label>
             <?php
                                foreach($guest as $z){
                                  if($booking->guest_id==$z->guest_id){
                                    ?>
             <input readonly="true" class="form-control" type="text" min="1" max="7" id="number_of_days" name="number_of_days" value="<?=$z->guest_name?>">
                             <?php
                                  }
                                }
                              ?>
					</div>
					<div class="form-group" id="service1">
            <label>Pelayanan Kamar<small class="required-field">*</small></label>
                  <?php
                        foreach($service as $t){
                          if($booking->service_id==$t->service_id){
                            ?>
                        <input readonly="true" class="form-control" type="text" min="1" max="7" id="number_of_days" name="number_of_days" value="<?=$t->service_name?>">
                                  <?php
                              }
                            }
                            ?>
            </div>
          <div class="form-group">
            <label>Pilihan Kamar<small class="required-field">*</small></label>
                  <?php
                        foreach($room as $t){
                          if($booking->room_id==$t->room_id){
                            ?>
                            <?php
                              foreach($tipe as $s){
                                if($s->category_id==$t->category_id){
                                  ?>
                    <input readonly="true" class="form-control" type="text" min="1" max="7" id="number_of_days" name="number_of_days" value="<?=$s->category_name?> - <?=$t->room_name?>">
                                  <?php
                                }
                              }
                            ?>
                            
                            <?php
                          }
                        }
                      ?>
            
                  <?php
                        foreach($room as $t){
                          if($booking->room_id==$t->room_id){
                            ?>
                            <?php
                              foreach($tipe as $s){
                                if($s->category_id==$t->category_id){
                                  ?>
            <input readonly="true" class="form-control" type="hidden" name="room_id" value="<?=$t->room_id?>">
                                  <?php
                                }
                              }
                            ?>
                            
                            <?php
                          }
                        }
                      ?>


            
            <?php
                                foreach($payment as $z){
                                  if($booking->booking_id==$z->booking_id){
                                    ?>
             <input readonly="true" class="form-control" type="hidden" name="idx" value="<?=$z->id?>">
                             <?php
                                  }
                                }
                              ?>

          </div>
          <div class="form-group">
            <label>Biaya Pelayanan<small class="required-field">*</small></label>
            <?php
                        foreach($service as $t){
                          if($booking->service_id==$t->service_id){
                            ?>
            <input readonly="true" class="form-control" type="text" name="bea_service" value="<?=$t->service_price?>">
                                  <?php
                                }
                              }
                            ?>
                            
          </div>
          <div class="form-group">
            <label>Biaya Kamar<small class="required-field">*</small></label>
            <?php
                        foreach($room as $t){
                          if($booking->room_id==$t->room_id){
                            ?>
                            <?php
                              foreach($tipe as $s){
                                if($s->category_id==$t->category_id){
                                  ?>
            <input readonly="true" class="form-control" type="text" name="bea_room" value="<?=$s->category_price?>">
                                  <?php
                                }
                              }
                            ?>
                            
                            <?php
                          }
                        }
                      ?>
          </div>
          <div class="form-group">
            <label>Pilih Diskon<small class="required-field">*</small></label>
            <select class="form-control select2" name="disc">
              <option value="0">Tidak Ada</option>
              <?php foreach ($diskon as $row): ?>
                <option value="<?=$row->diskon_price?>"> <?=$row->diskon_name?> (<?=$row->diskon_price?>%)</option>
                
              <?php endforeach; ?>
            </select>
          </div>
          <?php
            $year = date('Y');
            $month = date('m');
            $tgl = date('d');
            $jam = date('h:i:sa');
            $split=explode(':', $jam);
            $kode=$split[2]+"as"+$split[2]+"-"+$split[1]+"-"+$tgl+"-"+$month+"-"+$year;
          ?>

          <input class="form-control" type="hidden" id="xsaa" name="booking_code" value="<?=$kode?>">

          <input class="form-control" type="hidden" id="xs" name="date_booking_from" value="">
          <input class="form-control" type="hidden" id="xsz" name="date_booking" value="">
          <input class="form-control" type="hidden" id="xz" name="date_booking_to" value="">
       

        <div class="form-group" style="display:none;">
          <label>Aktif?</label><br>
          <input class="" type="hidden" name="is_active" value="1" />
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_payment/index"><i class="fa fa-close"></i> Batal</a>

          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Bayar</button>

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
          var today = new Date();
			    var next = today.getDate()+value;
          var bulan = today.getMonth()+1;
			    $('#date_booking_to').val(next+"-"+bulan+"-"+today.getFullYear());
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
		var html = '<div class="form-group" id="service'+row+'">';
		html+= '<label"></label>';
		html+= '<input type="hidden"  name="service_id[]" id="service_id'+row+'" class="form-control service"required required/>';
		html+='<select class="form-control select2" id="service_id'+row+'" name="service_id[]">';
              <?php foreach ($service as $row): ?>
    html+=      '<option value="<?=$row->service_id?>" <?php if($booking != null){if($row->service_id == $bookings->service_id){echo 'selected';};}?>><?=$row->service_name?></option>';
              <?php endforeach; ?>
    html+='</select><br>';
    html+= '<a href="javascript:void(0)" onclick="javascript:DeleteService('+row+')" title="Delete Service" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
		html+= '</div>';
		$('#data-service').append(html);
		
	}

  function DeleteService(x){
		$('#service'+x).remove();
	}


</script>