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
                <td class="text-center"><?=$billing->billing_num_day?> Hari</td>
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
                <td class="text-center"><?=$row->extra_amount?></td>
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
                <td class="text-center"><?=$row->service_amount?></td>
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
                <td class="text-center"><?=$row->fnb_amount?></td>
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
  </div>
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
            <tr>
              <td width="300">Pajak Hotel</td>
              <td width="20">:</td>
              <td><?=num_to_idr($billing->billing_tax)?></td>
            </tr>
            <tr>
              <td width="300">Service Charge</td>
              <td width="20">:</td>
              <td><?=num_to_idr($billing->billing_service)?></td>
            </tr>
            <tr>
              <td width="300">Biaya Lain-lain</td>
              <td width="20">:</td>
              <td><?=num_to_idr($billing->billing_other)?></td>
            </tr>
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
        <form id="form" class="" action="<?=base_url()?>hot_reservation/<?=$action?>" method="post">
        <input type="hidden" name="billing_id" value="<?=$id?>">
        <tbody>
          <tr>
            <td width="300">Total</td>
            <td width="20">:</td>
            <td><?=num_to_idr($billing->billing_total)?></td>
            <input id="billing_total" type="hidden" value="<?=$billing->billing_total?>">
          </tr>
          <tr>
            <td width="300">Uang Muka</td>
            <td width="20">:</td>
            <td><?=num_to_idr($billing->billing_down_payment)?></td>
          </tr>
          <tr>
            <td width="300">Kekurangan</td>
            <td width="20">:</td>
            <td><?=num_to_idr($billing->billing_total-$billing->billing_down_payment)?></td>
          </tr>
          <tr>
            <td width="300">Pembayaran</td>
            <td width="20">:</td>
            <td>
              <input id="billing_payment" name="billing_payment" style="width:100%" class="autonumeric" type="text" value="0" dir="rtl" onchange="calc_change()">
            </td>
          </tr>
          <tr>
            <th width="300">Kembalian</th>
            <th width="20">:</th>
            <th>
              <input id="billing_change" style="width:100%" class="autonumeric" type="text" value="0" dir="rtl" readonly>
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
  function calc_change() {
    var billing_total = $('#billing_total').val();
    var billing_payment = ind_to_sys($('#billing_payment').val());
    var billing_change = billing_payment-billing_total;
    console.log(billing_change);
    $('#billing_change').val(sys_to_ind(billing_change.toFixed(2)));
  }
</script>