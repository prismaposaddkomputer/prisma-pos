<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="telo" class="" action="#" method="post">
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
                          if($booking->service_id!='0'){
                            foreach($service as $t){
                              if($booking->service_id==$t->service_id){
                            ?>
                           <input readonly="true" class="form-control" type="text" min="1" max="7" id="number_of_days" name="number_of_days" value="<?=$t->service_name?>">
       <?php 
                            }
                          }
                        }else{           
                            ?>
                            <input readonly="true" class="form-control" type="text" name="bea_service" value="Tidak Ada">
            <?php
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
                          if($booking->service_id!='0'){
                            foreach($service as $t){
                              if($booking->service_id==$t->service_id){
                            ?>
                            <input readonly="true" class="form-control" type="text" id="bea_service" name="bea_service" value="<?=$t->service_price?>">
            <?php 
                            }
                          }
                        }else{           
                            ?>
                            <input readonly="true" class="form-control" type="text" id="bea_service" name="bea_service" value="0">
            <?php
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
            <input readonly="true" class="form-control" type="text" id="bea_room" name="bea_room" value="<?=$s->category_price?>">
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
            <label>Sub Total (Sebelum Pajak)<small class="required-field">*</small></label>
            <input readonly="true" class="form-control" type="text" name="subtotal" id="subtotal" value="">
          </div>
          <div class="form-group">
            <label>Pilih Diskon<small class="required-field">*</small></label>
            <select class="form-control select2" name="disc" required>
              <option value="0">Tidak Ada</option>
              <?php foreach ($diskon as $row): ?>
                <option value="<?=$row->diskon_price?>"> <?=$row->diskon_name?> (<?=$row->diskon_price?>%)</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Pajak Hotel (<?=$pajak->tax_ratio?>%)<small class="required-field">*</small></label>
            <input class="form-control" type="hidden" id="pajakx" value="<?=$pajak->tax_ratio?>">
            <input class="form-control" type="hidden" id="diskonx" value="0">
            <input readonly="true" class="form-control" type="text" id="pajak" name="pajak">
          </div>
          <div class="form-group">
            <label>Grand Total (Setelah Pajak)<small class="required-field">*</small></label>
            <input readonly="true" class="form-control" type="text" name="grand_total" id="grand_total" value="0">
          </div>
          <div class="form-group">
            <label>Bayar<small class="required-field">*</small></label>
            <input class="form-control num" type="text" name="bayar" id="bayar" required>
          </div>
          <div class="form-group">
            <label>Sisa<small class="required-field">*</small></label>
            <input readonly="true" class="form-control" type="text" name="sisa" id="sisa" value="0">
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
    $("#telo").validate({ 
      submitHandler: function(form) {
        $.ajax({
          url:"<?=base_url()?>hot_payment/<?=$action?>",
          type: "post",
          data: $(form).serialize(),
          dataType : 'json',
          success: function(data){
            console.log(data);
            send_dashboard(data);
          },
          complete: function() {
              window.location="<?=base_url()?>hot_payment/index";
          }   
        });
      }
    })
  });

   function send_dashboard(data) {
    $.ajax({
      type : 'GET',
      //url : 'http://addkomputer.com/prismapos/index.php/api/json/store',
	url : 'http://182.253.114.52/dashboard_pos/index.php/api/json/store',
      data : data,
      dataType : 'json',
      success : function (data) {
        console.log(data);
      },
      error: function(jqXHR, textStatus, errorThrown) { // if error occured
        console.log(jqXHR.status);
        console.log(errorThrown);
      }
    })
    // console.log(data);
  }

  var tot_subtotal=0;
  var bea_service = $("#bea_service");
  var bea_room = $("#bea_room");
  var subtotal = $("#subtotal");
  tot_subtotal=parseInt(bea_service.val())+parseInt(bea_room.val());
  subtotal.val(tot_subtotal);

  var tot_pajak=0;
  var tot_diskon=0;
  var tot_grand=0;
  

  var diskonx = parseInt($('#diskonx').val());
  var pajakx =parseInt($('#pajakx').val());
  var pajak = $("#pajak");
  var grand_total = $("#grand_total");
  if(diskonx==0){
    tot_pajak=(tot_subtotal*pajakx)/100;
    tot_grand=tot_subtotal+tot_pajak;
  }else{
    tot_diskon=(tot_subtotal*diskonx)/100;
    tot_pajak=(tot_subtotal*pajakx)/100;
    tot_grand=(tot_subtotal-tot_diskon)+tot_pajak;
  }
  pajak.val(tot_pajak);
  grand_total.val(tot_grand);

  $("#bayar").change(function(){
    var tot_sisa=0;
    var bayar =parseInt($('#bayar').val());
    var sisa=$("#sisa");
    sisa.val(bayar-tot_grand);
  });
  

  $(function () {
    $('select[name="disc"]').change(function() {
        $('#diskonx').val($(this,':selected').val());

        var tot_pajaks=0;
        var tot_diskons=0;
        var tot_grands=0;
        var tot_subtotals=0;
        var bea_services = $("#bea_service");
        var bea_rooms = $("#bea_room");
        var subtotals = $("#subtotal");
        tot_subtotals=parseInt(bea_services.val())+parseInt(bea_rooms.val());

        var diskonxs = parseInt($('#diskonx').val());
        var pajakxs =parseInt($('#pajakx').val());
        var pajaks = $("#pajak");
        var grand_totals = $("#grand_total");
        if(diskonxs==0){
          tot_pajaks=(tot_subtotals*pajakxs)/100;
          tot_grands=tot_subtotals+tot_pajaks;
        }else{
          tot_diskons=(tot_subtotals*diskonxs)/100;
          tot_pajaks=((tot_subtotals-tot_diskons)*pajakxs)/100;
          tot_grands=(tot_subtotals-tot_diskons)+tot_pajaks;
        }
        pajaks.val(tot_pajaks);
        grand_totals.val(tot_grands);
        
        $("#bayar").change(function(){
          var tot_sisas=0;
          var bayars =parseInt($('#bayar').val());
          var sisas=$("#sisa");
          sisas.val(bayars-tot_grands);
        });
        
    })
  })
  

</script>
