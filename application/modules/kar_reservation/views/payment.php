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
            <td class="cl-success"><i class="fa fa-arrow-down"></i> In (Masuk)</td>
            <td>:</td>
            <td><?=date_to_ind($billing->billing_date_in)?> <?=$billing->billing_time_in?></td>
          </tr>
          <!-- <tr>
            <td class="cl-danger"><i class="fa fa-arrow-up"></i> Out (Keluar)</td>
            <td>:</td>
            <td><?=date_to_ind(date("Y-m-d"))?> <?=date("H:i:s")?></td>
          </tr> -->
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
                    break;
                  
                  case 3:
                    echo 'SIM';
                    break;
                  
                  case 4:
                    echo 'Lainnya';
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
    <div class="col-md-6">
      <h4><b><i class="fa fa-bed"></i></b> A. Kamar</h4>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="20">No.</th>
            <th class="text-center">Kamar</th>
            <th class="text-center" width="120">Tarif</th>
            <th class="text-center" width="20">Durasi</th>
            <th class="text-center" width="120">Total</th>
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
                      echo num_to_idr($row->room_type_total/$row->room_type_duration);
                    }
                  ?>
                </td>
                <td class="text-center"><?=round($row->room_type_duration,0,PHP_ROUND_HALF_UP)?> Jam</td>
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
              <td class="text-center" colspan="5"><i>Tidak ada data!</i></td>
            </tr>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="4">Total</th>
            <th><?=num_to_idr($tot_room)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="col-md-6">
      <h4><b><i class="fa fa-cubes"></i></b> B. Paket</h4>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="20">No.</th>
            <th class="text-center">Paket</th>
            <th class="text-center" width="120">Tarif</th>
            <th class="text-center" width="20">Banyak</th>
            <th class="text-center" width="120">Total</th>
          </tr>              
        </thead>
        <tbody>
          <?php $tot_paket=0; if ($billing->paket != null): ?>
            <?php $i=1;foreach ($billing->paket as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->paket_name?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->paket_charge);
                    }else{
                      echo num_to_idr($row->paket_total/$row->paket_amount);
                    }
                  ?>
                </td>
                <td class="text-center"><?=round($row->paket_amount,0,PHP_ROUND_HALF_UP)?></td>
                <td>
                  <?php 
                    if ($client->client_is_taxed == 0) {
                      echo num_to_idr($row->paket_subtotal);
                    }else{
                      echo num_to_idr($row->paket_total);
                    }
                  ?>
                </td>
                <?php 
                  if ($client->client_is_taxed == 0) {
                    $tot_paket += $row->paket_subtotal;
                  }else{
                    $tot_paket += $row->paket_total;
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
            <th><?=num_to_idr($tot_paket)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="row">
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
                    echo num_to_idr($row->non_tax_charge);
                  ?>
                </td>
                <td class="text-center"><?=round($row->non_tax_amount,0,PHP_ROUND_HALF_UP)?></td>
                <td>
                  <?=num_to_idr($row->non_tax_total);?>
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
              <th width="300">Total</th>
              <th width="20">:</th>
              <th><?=num_to_idr($billing->billing_total)?></th>
            </tr>
          <?php else: ?>
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
        <form class="" action="<?=base_url()?>kar_reservation/<?=$action?>" method="post" name="myForm" onsubmit="return validateForm()">
        <input type="hidden" name="billing_id" value="<?=$id?>">
        <!-- <input type="hidden" name="billing_date_out" value="<?=date("Y-m-d")?>"> -->
        <!-- <input type="hidden" name="billing_time_out" value="<?=date("H:i:s")?>"> -->
        <tbody>
          <tr>
            <td width="300">Total</td>
            <td width="20">:</td>
            <td><?=num_to_idr($billing->billing_total)?></td>
            <!-- <input id="billing_total" type="hidden" value="<?=$billing->billing_total?>"> -->
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
              <button type="submit" name="save_print" value="print_pdf" class="btn btn-primary">Simpan & Cetak PDF <i class="fa fa-file-pdf-o"></i></button>
              <button type="submit" name="save_print" value="print_struk" class="btn btn-success">Simpan & Cetak Struk <i class="fa fa-print"></i></button>
            </td>
          </tr>
        </tbody>
        </form>
      </table>
    </div>
  </div>
</div>
<script>
  function validateForm() {
    var billing_payment = ind_to_sys($('#billing_payment').val());
    <?php if ($billing->billing_down_payment_type == 1): ?>
      var total_payment = <?=$billing->billing_total-$billing->billing_down_payment?>;
    <?php else: ?>
      <?php $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100); ?>
      var total_payment = <?=$billing->billing_total-$dp_prosen?>;
    <?php endif; ?>
    console.log(total_payment);
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
    }
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