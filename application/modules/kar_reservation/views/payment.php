<div class="content-header">
  <h4><i class="fa fa-money"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <table class="table table-condensed">
        <tbody>  
          <tr>
            <td width="200">No. Nota</td>
            <td width="10">:</td>
            <td>TXS-<?=$billing->billing_receipt_no?></td>
          </tr>
          <tr>
            <td>Check In</td>
            <td>:</td>
            <td><?=date_to_ind($billing->billing_date_in)?> <?=$billing->billing_time_in?></td>
          </tr>
          <tr>
            <td>Check Out</td>
            <td>:</td>
            <td><?=date_to_ind($billing->billing_date_out)?> <?=$billing->billing_time_out?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <table class="table table-condensed">
        <tbody>  
          <tr>
            <td width="200">Tamu</td>
            <td width="10">:</td>
            <td>
              <?php if ($billing->guest_gender == 'L') {
                echo 'Tn. ';
              }else{
                echo 'Ny. ';
              } ?>
              <?=$billing->guest_name?>
            </td>
          </tr>
          <tr>
            <td>No. Telp</td>
            <td>:</td>
            <td><?php if ($billing->guest_phone == '') {echo '-';} else {echo $billing->guest_phone;}?></td>
          </tr>
          <tr>
            <td>Jenis Identitas</td>
            <td>:</td>
            <td>
              <?php                 
                switch ($billing->guest_id_type) {
                  case 2:
                    echo 'KTP';
                    echo ' ('.$billing->guest_id_no.')';
                    break;
                  
                  case 3:
                    echo 'SIM';
                    echo ' ('.$billing->guest_id_no.')';
                    break;
                  
                  case 4:
                    echo 'Lainnya';
                    echo ' ('.$billing->guest_id_no.')';
                    break;
                  
                  default:
                    echo '-';
                    break;
                }
              ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h4><b><i class="fa fa-bed"></i></b> A. Kamar</h4>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="20">No.</th>
            <th class="text-center">Kamar</th>
            <th class="text-center" width="150">Tarif</th>
            <th class="text-center" width="100">Durasi</th>
            <th class="text-center" width="150">Subtotal</th>
            <th class="text-center" width="150">Diskon</th>
            <th class="text-center" width="150">Total</th>
          </tr>              
        </thead>
        <tbody>
          <?php $tot_room=0; if ($billing->room != null): ?>
            <?php $i=1;foreach ($billing->room as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->room_name?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->room_type_charge);
                    }else{
                      echo num_to_idr($row->room_type_before_discount/$row->room_type_duration);
                    }
                  ?>
                </td>
                <td class="text-center"><?=round($row->room_type_duration,0,PHP_ROUND_HALF_UP)?> Hari</td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->room_type_subtotal);
                    }else{
                      echo num_to_idr($row->room_type_before_discount);
                    }
                  ?>
                </td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->room_type_discount);
                    }else{
                      echo num_to_idr($row->room_type_discount);
                    }
                  ?>
                </td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->room_type_subtotal);
                    }else{
                      echo num_to_idr($row->room_type_total);
                    }
                  ?>
                </td>
                <?php 
                  if ($client->client_is_taxed == 0) {
                    $tot_room += $row->room_type_subtotal;
                  }else{
                    $tot_room += $row->room_type_total;
                  }
                ?>
              </tr>
            <?php endforeach;?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="7"><i>Tidak ada data!</i></td>
            </tr>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="6">Total</th>
            <th><?=num_to_idr($tot_room)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <h4><b><i class="fa fa-plus-square"></i></b> B. Ekstra</h4>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="20">No.</th>
            <th class="text-center">Ekstra</th>
            <th class="text-center" width="120">Tarif</th>
            <th class="text-center" width="20">Banyak</th>
            <th class="text-center" width="120">Total</th>
          </tr>              
        </thead>
        <tbody>
          <?php $tot_extra=0; if ($billing->extra != null): ?>
            <?php $tot_extra=0;$i=1;foreach ($billing->extra as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->extra_name?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->extra_charge);
                    }else{
                      echo num_to_idr($row->extra_total/$row->extra_amount);
                    }
                  ?>
                </td>
                <td class="text-center"><?=round($row->extra_amount,0,PHP_ROUND_HALF_UP)?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->extra_subtotal);
                    }else{
                      echo num_to_idr($row->extra_total);
                    }
                  ?>
                </td>
                <?php 
                  if ($client->client_is_taxed == 0) {
                    $tot_extra += $row->extra_subtotal;
                  }else{
                    $tot_extra += $row->extra_total;
                  }
                ?>
              </tr>
            <?php endforeach;?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="5"><i>Tidak ada data!</i></td>
            </tr>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="4">Total</th>
            <th><?=num_to_idr($tot_extra)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="col-md-6">
      <h4><b><i class="fa fa-bell"></i></b> C. Pelayanan</h4>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="20">No.</th>
            <th class="text-center">Layanan</th>
            <th class="text-center" width="120">Tarif</th>
            <th class="text-center" width="20">Banyak</th>
            <th class="text-center" width="120">Total</th>
          </tr>              
        </thead>
        <tbody>
          <?php $tot_service=0; if ($billing->service != null): ?>
            <?php $i=1;foreach ($billing->service as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->service_name?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->service_charge);
                    }else{
                      echo num_to_idr($row->service_total/$row->service_amount);
                    }
                  ?>
                </td>
                <td class="text-center"><?=round($row->service_amount,0,PHP_ROUND_HALF_UP)?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->service_subtotal);
                    }else{
                      echo num_to_idr($row->service_total);
                    }
                  ?>
                </td>
                <?php 
                  if ($client->client_is_taxed == 0) {
                    $tot_service += $row->service_subtotal;
                  }else{
                    $tot_service += $row->service_total;
                  }
                ?>
              </tr>
            <?php endforeach;?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="5"><i>Tidak ada data!</i></td>
            </tr>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="4">Total</th>
            <th><?=num_to_idr($tot_service)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="col-md-6">
      <h4><b><i class="fa fa-cutlery"></i></b> D. F&B</h4>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="20">No.</th>
            <th class="text-center">F&B</th>
            <th class="text-center" width="120">Tarif</th>
            <th class="text-center" width="20">Banyak</th>
            <th class="text-center" width="120">Total</th>
          </tr>              
        </thead>
        <tbody>
          <?php $tot_fnb=0; if ($billing->fnb != null): ?>
            <?php $i=1; foreach ($billing->fnb as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->fnb_name?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->fnb_charge);
                    }else{
                      echo num_to_idr($row->fnb_total/$row->fnb_amount);
                    }
                  ?>
                </td>
                <td class="text-center"><?=round($row->fnb_amount,0,PHP_ROUND_HALF_UP)?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->fnb_subtotal);
                    }else{
                      echo num_to_idr($row->fnb_total);
                    }
                  ?>
                </td>
                <?php 
                  if ($client->client_is_taxed == 0) {
                    $tot_fnb += $row->fnb_subtotal;
                  }else{
                    $tot_fnb += $row->fnb_total;
                  }
                ?>
              </tr>
            <?php endforeach;?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="5"><i>Tidak ada data!</i></td>
            </tr>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="4">Total</th>
            <th><?=num_to_idr($tot_fnb)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="col-md-6">
      <h4><b><i class="fa fa-cutlery"></i></b> E. Non Pajak</h4>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="20">No.</th>
            <th class="text-center">Non Pajak</th>
            <th class="text-center" width="120">Tarif</th>
            <th class="text-center" width="20">Banyak</th>
            <th class="text-center" width="120">Total</th>
          </tr>              
        </thead>
        <tbody>
          <?php $tot_non_tax=0; if ($billing->non_tax != null): ?>
            <?php $i=1; foreach ($billing->non_tax as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->non_tax_name?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->non_tax_charge);
                    }else{
                      echo num_to_idr($row->non_tax_total/$row->non_tax_amount);
                    }
                  ?>
                </td>
                <td class="text-center"><?=round($row->non_tax_amount,0,PHP_ROUND_HALF_UP)?></td>
                <td>
                  <?php 
                    echo num_to_idr($row->non_tax_total);
                  ?>
                </td>
                <?php 
                  $tot_non_tax += $row->non_tax_total;
                ?>
              </tr>
            <?php endforeach;?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="5"><i>Tidak ada data!</i></td>
            </tr>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="4">Total</th>
            <th><?=num_to_idr($tot_non_tax)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div style="border-bottom: 1px solid #333333; margin-bottom: 10px; margin-top: 5px;"></div>
  <div class="row">
    <div class="col-md-6">
      <h4><b><i class="fa fa-list"></i></b> Total</h4>
      <table class="table table-condensed">
        <tbody>
          <?php if ($client->client_is_taxed == 0): ?>  
            <tr>
              <td width="300">Subtotal</td>
              <td width="20">:</td>
              <td><?=num_to_idr($billing->billing_subtotal)?></td>
            </tr>

            <?php 
            foreach ($charge_type as $row): 
            if ($row->charge_type_id == '1') {
              $charge_type_money = num_to_idr($billing->billing_tax);
            }else if ($row->charge_type_id == '2') {
              $charge_type_money = num_to_idr($billing->billing_service);
            }else if ($row->charge_type_id == '3') {
              $charge_type_money = num_to_idr($billing->billing_other);
            }
            ?>
            <tr>
              <td width="300"><?=$row->charge_type_name?></td>
              <td width="20">:</td>
              <td><?=$charge_type_money?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
              <td width="300">Diskon</td>
              <td width="20">:</td>
              <td><?=num_to_idr($billing->billing_discount)?></td>
            </tr>
            <tr>
              <th width="300">Total</th>
              <th width="20">:</th>
              <th><?=num_to_idr($billing->billing_total)?></th>
            </tr>
          <?php else: ?>
            <tr>
              <td width="300">Diskon</td>
              <td width="20">:</td>
              <td><?=num_to_idr($billing->billing_discount)?></td>
            </tr>
            <tr>
              <th width="300">Total</th>
              <th width="20">:</th>
              <th><?=num_to_idr($billing->billing_total)?></th>
            </tr>
          <?php endif;?>
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
    <div class="col-md-6">
      <h4><b><i class="fa fa-money"></i></b> Pembayaran</h4>
      <table class="table table-condensed">
        <input type="hidden" name="billing_id" id="billing_id" value="<?=$id?>">
        <tbody>
          <tr>
            <td width="300">Total</td>
            <td width="20">:</td>
            <td><?=num_to_idr($billing->billing_total)?></td>
            <input id="billing_total" type="hidden" value="<?=$billing->billing_total-$billing->billing_down_payment?>">
          </tr>
          <tr>
            <td width="300">Uang Muka</td>
            <td width="20">:</td>
            <?php if ($billing->billing_down_payment_type == 1): ?>
              <td><?=num_to_idr($billing->billing_down_payment)?></td>
            <?php else: ?>
              <td align="right"><?=round($billing->billing_down_payment,0,PHP_ROUND_HALF_UP)?> %</td>
            <?php endif; ?>
          </tr>
          <tr>
            <td width="300">Kekurangan</td>
            <td width="20">:</td>
            <?php if ($billing->billing_down_payment > $billing->billing_total): ?>
              <td><?=num_to_idr(0)?></td>
            <?php else: ?>
              <?php if ($billing->billing_down_payment_type == 1): ?>
                <td><?=num_to_idr($billing->billing_total-$billing->billing_down_payment)?></td>
                <input type="hidden" name="" id="total_payment" value="<?=$billing->billing_total-$billing->billing_down_payment?>">
              <?php else: ?>
                <?php 
                $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100);
                ?>
                <?php if ($dp_prosen > $billing->billing_total): ?>
                  <td><?=num_to_idr(0)?></td>
                <?php else: ?>
                  <td><?=num_to_idr($billing->billing_total-$dp_prosen)?></td>
                <?php endif; ?>
                <input type="hidden" name="" id="total_payment" value="<?=$billing->billing_total-$dp_prosen?>">
              <?php endif; ?>
            <?php endif; ?>
          </tr>
          <tr>
            <td width="300">Pembayaran</td>
            <td width="20">:</td>
            <td>
              <?php if ($billing->billing_payment == 0) {
                $echo = "";
              }else{
                $echo = $billing->billing_payment; 
              }
              ?>
              <?php if ($billing->billing_down_payment > $billing->billing_total || $billing->billing_down_payment == $billing->billing_total): ?>
                <input style="width:100%; border: none; font-size: 18px; text-align: right;" type="text" name="billing_payment" value="" readonly>
              <?php else: ?>
                <?php if (@$dp_prosen > $billing->billing_total || @$dp_prosen == $billing->billing_total): ?>
                  <input style="width:100%; border: none; font-size: 18px; text-align: right;" type="text" name="billing_payment" value="" readonly>
                <?php else: ?>
                  <input id="billing_payment" name="billing_payment" style="width:100%; height: 40px; border: 2px solid green; font-size: 20px; font-weight: bold; text-align: right; padding-right: 10px;" class="autonumeric num" type="text" value="<?=$echo?>" dir="rtl" onchange="calc_change()">
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th width="300">Kembalian</th>
            <th width="20">:</th>
            <th>
              <?php if ($billing->billing_change == 0) {
                if ($billing->billing_down_payment > $billing->billing_total) {
                  $billing_change_echo = num_to_price($billing->billing_down_payment-$billing->billing_total);
                }else{
                  if (@$dp_prosen > $billing->billing_total) {
                    $billing_change_echo = num_to_price($dp_prosen - $billing->billing_total);
                  }else {
                    $billing_change_echo = 0;
                  }
                }
              }else{
                $billing_change_echo = num_to_price($billing->billing_change); 
              }
              ?>
              <input id="billing_change" style="width:100%; border: none; font-size: 18px; text-align: right;" type="text" value="<?=$billing_change_echo?>" readonly>
            </th>
          </tr>
          <tr>
            <td colspan="3" class="text-right">
              <button type="button" id="print_pdf" class="btn btn-primary">Simpan & Cetak PDF <i class="fa fa-file-pdf-o"></i></button>
              <button type="button" id="print_struk" class="btn btn-success">Simpan & Cetak Struk <i class="fa fa-print"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  $("#print_struk").click(function () {
    var billing_id = $('#billing_id').val();
    var billing_payment = ind_to_sys($('#billing_payment').val());
    <?php if ($billing->billing_down_payment_type == 1): ?>
      var total_payment = <?=$billing->billing_total-$billing->billing_down_payment?>;
    <?php else: ?>
      <?php $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100); ?>
      var total_payment = <?=$billing->billing_total-$dp_prosen?>;
    <?php endif; ?>

    if (billing_payment == "") {
        swal({
          text: "Pembayaran Belum Diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (billing_payment < total_payment) {
      swal({
          text: "Pembayaran Kurang",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else{
      $.ajax({
        type : 'POST',
        url : '<?=base_url()?>kar_reservation/payment_action',
        data : 'billing_id='+billing_id+'&billing_payment='+billing_payment,
        dataType : 'json',
        success : function (data) {
          send_dashboard(data);
          window.location.replace("<?=base_url()?>kar_reservation/reservation_print_struk/"+billing_id);
        },
      })
    }
  })

  $("#print_pdf").click(function () {
    var billing_id = $('#billing_id').val();
    var billing_payment = ind_to_sys($('#billing_payment').val());
    <?php if ($billing->billing_down_payment_type == 1): ?>
      var total_payment = <?=$billing->billing_total-$billing->billing_down_payment?>;
    <?php else: ?>
      <?php $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100); ?>
      var total_payment = <?=$billing->billing_total-$dp_prosen?>;
    <?php endif; ?>

    if (billing_payment == "") {
        swal({
          text: "Pembayaran Belum Diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (billing_payment < total_payment) {
      swal({
          text: "Pembayaran Kurang",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else{
      $.ajax({
        type : 'POST',
        url : '<?=base_url()?>kar_reservation/payment_action',
        data : 'billing_id='+billing_id+'&billing_payment='+billing_payment,
        dataType : 'json',
        success : function (data) {
          send_dashboard(data);
          window.location.replace("<?=base_url()?>kar_reservation/frame_pdf/"+billing_id);
        },
      })
    }
  })

  function send_dashboard(data) {
    $.ajax({
      type : 'GET',
      // url : 'http://addkomputer.com/prismapos/index.php/api/json/store',
      url : 'http://182.253.114.52/dashboard_pos/index.php/api/json/store',
      data : data,
      dataType : 'json',
      success : function (data) {
        if(data.resp_code == '00'){
          update_data(data.tx_id);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) { // if error occured
        console.log(jqXHR.status);
        console.log(errorThrown);
      }
    })
    // console.log(data);
  }

  function update_data(id) {
    $.ajax({
      type : 'post',
      url : '<?=$prismapos_base_url?>update_data.php',
      data : 'id='+id,
      dataType : 'json',
      success : function (data) {
        console.log('ok');
      }
    })
  }

  function calc_change() {
    var total_payment = $('#total_payment').val();
    var billing_payment = ind_to_sys($('#billing_payment').val());
    var billing_change = billing_payment-total_payment;
    console.log(billing_change);
    $('#billing_change').val(sys_to_ind(billing_change.toFixed(2)));
  }
</script>
<style type="text/css">
    .swal-text {
        font-weight: bold;
    }
    .swal-button--confirm {
      background-color: #2e86de;
    }
</style>