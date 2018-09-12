<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style>
      *{
        margin:0;
        padding:0;
        font-family: 'Arial';
      }
      body{
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        padding: 30px;
      }
      table {
        border-collapse: collapse;
      }
      #main th {
        border: 1px solid black;
        padding: 3px;
        background-color: #eee;
      }

      #main td {
        border: 1px solid black;
        padding: 3px;
      }
      #main{
        width : 100%;
      }
      #header{
        width:100%;
      }
      #img-logo {
        width: 200px;
        height: 120px;
        float:left;
        margin-left: -20px;
        margin-top: -30px;
        margin-bottom: -10px;
      }
      .description-print {
        font-size: 14px;
        padding-top: 15px;
      }
      .bill-to th, .bill-to td{
        padding-bottom: 8px;
      }
      .bill-to {
        float: left;
      }
      .bill-desc th, .bill-desc td{
        padding-bottom: 8px;
      }
      .bill-desc {
        float: right;
      }
      .column-payment th {
        padding-bottom: 8px;
      }
      .column-payment {
        margin-top: 10px;
        float: right;
      }
      .text-center{
        text-align: center !important;
      }
      .text-left{
        text-align: left !important;
      }
      .text-right{
        text-align: right !important;
      }
      h1,h2,h3,h4,h5,h6{
        font-weight: normal;
      }
      h3{
        font-size: 16px;
      }
      h4{
        font-size: 14px;
      }
      .bolder{
        font-weight: bold;
      }
      .colon {
        padding-left: 30px; 
        padding-right: 30px;
      }
      .column-footer {
        margin-top: 270px;
        text-align: center;
      }
    </style>
    <title><?=$title?></title>
  </head>
  <body>
    <?php if ($client->client_logo !=''): ?>
      <div id="header" style="text-align: right;">
        <img id="img-logo" src="img/<?=$client->client_logo?>">
        <div><b><?=$client->client_name?></b></div>
        <div><?=$client->client_street.', '.$client->client_subdistrict.', '.$client->client_district?></div>
        <div><?=$client->client_city.', '.$client->client_province?></div>
        <div>Indonesia</div>
      </div>
    <?php else: ?>
      <div id="header" style="text-align: center;">
        <div><b><?=$client->client_name?></b></div>
        <div><?=$client->client_street.', '.$client->client_subdistrict.', '.$client->client_district?></div>
        <div><?=$client->client_city.', '.$client->client_province?></div>
        <div>Indonesia</div>
      </div>
    <?php endif; ?>
    <div style="border-bottom: double; margin-top: 15px;"></div>
    <div class="description-print">
      <div class="bill-to">
        <div>Detail Tamu : </div>
        <?php
        if ($billing->guest_gender == 'L') {
          $name_title = "Tn. ";
        }else if($billing->guest_gender == 'P'){
          $name_title = "Ny. ";
        }
        ?>
        <table>
          <tr>
            <th>Nama</th>
            <td>&nbsp;:&nbsp;</td>
            <td><b><?=$name_title?><?=$billing->guest_name?></b></td>
          </tr>
          <tr>
            <th>No Telp</th>
            <td>&nbsp;:&nbsp;</td>
            <td><?=($billing->guest_phone !='') ? $billing->guest_phone : "-"?></td>
          </tr>
          <tr>
            <th>Jenis Identitas</th>
            <td>&nbsp;:&nbsp;</td>
            <td>-</td>
          </tr>
        </table>
      </div>
      <div class="bill-desc">
        <table>
          <tr>
            <th>No. Nota</th>
            <td>&nbsp;:&nbsp;</td>
            <td>TXS-<?=$billing->billing_receipt_no?></td>
          </tr>
          <tr>
            <th>Tanggal</th>
            <td>&nbsp;:&nbsp;</td>
            <td><?=date("d-m-Y")?></td>
          </tr>
          <tr>
            <th>Check In</th>
            <td>&nbsp;:&nbsp;</td>
            <td><?=date_to_ind($billing->billing_date_in)?> <?=$billing->billing_time_in?></td>
          </tr>
          <tr>
            <th>Check Out</th>
            <td>&nbsp;:&nbsp;</td>
            <td><?=date_to_ind($billing->billing_date_out)?> <?=$billing->billing_time_out?></td>
          </tr>
          <tr>
            <th>Resepsionis</th>
            <td>&nbsp;:&nbsp;</td>
            <td><?=$billing->user_realname?></td>
          </tr>
        </table>
      </div>
    </div>
    <div style="padding-top: 150px;">
      <table id="main" class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Nama</th>
            <th class="text-center">Qty</th>
            <th class="text-right">Harga Unit</th>
            <th class="text-right">Jumlah</th>
          </tr>
        </thead>
        <tbody>

          <!-- Kamar -->
          <?php if ($billing->room != null): ?>
            <?php 
            foreach ($billing->room as $row): 
            //
            if ($client->client_is_taxed == 0) {
              $room_type_subtotal = num_to_price($row->room_type_charge);
            }else{
              $room_type_subtotal = num_to_price($row->room_type_total/$row->room_type_duration);
            }
            //
            if ($client->client_is_taxed == 0) {
              $room_type_total = num_to_price($row->room_type_subtotal);
            }else{
              $room_type_total = num_to_price($row->room_type_total);
            }
            //
            ?>
            <tr>
              <td>Kamar : <?=$row->room_name?></td>
              <td align="center"><?=round($row->room_type_duration,0,PHP_ROUND_HALF_UP)?> Hari</td>
              <td align="right"><?=$room_type_subtotal?></td>
              <td align="right"><?=$room_type_total?></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>

          <!-- Extra -->
          <?php if ($billing->extra != null): ?>
            <?php 
            foreach ($billing->extra as $row): 
            //
            if ($client->client_is_taxed == 0) {
              $extra_charge_sub_total = num_to_price($row->extra_charge);
            }else{
              $extra_charge_sub_total = num_to_price($row->extra_total/$row->extra_amount);
            }
            //
            if ($client->client_is_taxed == 0) {
              $extra_charge_total = num_to_price($row->extra_subtotal);
            }else{
              $extra_charge_total = num_to_price($row->extra_total);
            }
            //
            ?>
            <tr>
              <td>Extra : <?=$row->extra_name?></td>
              <td align="center"><?=$row->extra_amount?></td>
              <td align="right"><?=$extra_charge_sub_total?></td>
              <td align="right"><?=$extra_charge_total?></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>

          <!-- Pelayanan -->
          <?php if ($billing->service != null): ?>
            <?php 
            foreach ($billing->service as $row): 
            //
            if ($client->client_is_taxed == 0) {
              $service_charge_sub_total = num_to_price($row->service_charge);
            }else{
              $service_charge_sub_total = num_to_price($row->service_total/$row->service_amount);
            }
            //
            if ($client->client_is_taxed == 0) {
              $service_charge_total = num_to_price($row->service_subtotal);
            }else{
              $service_charge_total = num_to_price($row->service_total);
            }
            //
            ?>
            <tr>
              <td>Pelayanan : <?=$row->service_name?></td>
              <td align="center"><?=$row->service_amount?></td>
              <td align="right"><?=$service_charge_sub_total?></td>
              <td align="right"><?=$service_charge_total?></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>

          <!-- F&B -->
          <?php if ($billing->fnb != null): ?>
            <?php 
            foreach ($billing->fnb as $row): 
            //
            if ($client->client_is_taxed == 0) {
              $fnb_charge_sub_total = num_to_price($row->fnb_charge);
            }else{
              $fnb_charge_sub_total = num_to_price($row->fnb_total/$row->fnb_amount);
            }
            //
            if ($client->client_is_taxed == 0) {
              $fnb_charge_total = num_to_price($row->fnb_subtotal);
            }else{
              $fnb_charge_total = num_to_price($row->fnb_total);
            }
            //
            ?>
            <tr>
              <td>F&B : <?=$row->fnb_name?></td>
              <td align="center"><?=$row->fnb_amount?></td>
              <td align="right"><?=$fnb_charge_sub_total?></td>
              <td align="right"><?=$fnb_charge_total?></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>

        </tbody>
      </table>
    </div>

    <div class="column-payment">
      <table>
        <!-- <tr>
          <th>Subtotal</th>
          <th class="colon">:</th>
          <th><?=num_to_price($billing->billing_subtotal)?></th>
        </tr> -->
        <?php if ($client->client_is_taxed == 0): ?>  
          <?php 
            foreach ($charge_type as $row): 
            if ($row->charge_type_id == '1') {
              $charge_type_money = num_to_price($billing->billing_tax);
            }else if ($row->charge_type_id == '2') {
              $charge_type_money = num_to_price($billing->billing_service);
            }else if ($row->charge_type_id == '3') {
              $charge_type_money = num_to_price($billing->billing_other);
            }
            ?>
          <tr>
            <th><?=$row->charge_type_name?></th>
            <th class="colon">:</th>
            <th><?=$charge_type_money?></th>
          </tr>
          <?php endforeach; ?>
          <tr>
            <th><br></th>
          </tr>
        <?php endif; ?>
        <tr>
          <th>Diskon</th>
          <th class="colon">:</th>
          <th class="text-right"><?=num_to_price($billing->billing_discount)?></th>
        </tr>
        <tr>
          <?php
          if ($client->client_is_taxed == 0){
            $name_total = "Total";
          }else {
            $name_total = "Total Bersih";
          }
          ?>
          <th><?=$name_total?></th>
          <th class="colon">:</th>
          <th class="text-right"><?=num_to_price($billing->billing_total)?></th>
        </tr>
        <tr>
          <th>Uang Muka</th>
          <th class="colon">:</th>
          <?php if ($billing->billing_down_payment_type == 1): ?>
            <th class="text-right"><?=num_to_price($billing->billing_down_payment)?></th>
          <?php else: ?>
            <th class="text-right"><?=round($billing->billing_down_payment,0,PHP_ROUND_HALF_UP)?> %</th>
          <?php endif; ?>
        </tr>
        <tr>
          <th>Sisa Bayar</th>
          <th class="colon">:</th>
          <?php if ($billing->billing_down_payment > $billing->billing_total): ?>
            <th class="text-right"><?=num_to_price(0)?></th>
          <?php else: ?>
            <?php if ($billing->billing_down_payment_type == 1): ?>
              <th class="text-right"><?=num_to_price($billing->billing_total-$billing->billing_down_payment)?></th>
            <?php else: ?>
              <?php 
              $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100);
              ?>
              <?php if ($dp_prosen > $billing->billing_total): ?>
                <th class="text-right"><?=num_to_price(0)?></th>
              <?php else: ?>
                <th class="text-right"><?=num_to_price($billing->billing_total-$dp_prosen)?></th>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        </tr>
        <tr>
          <th><br></th>
        </tr>
        <tr>
          <th>Dibayar</th>
          <th class="colon">:</th>
          <th class="text-right"><?=num_to_price($billing->billing_payment)?></th>
        </tr>
        <tr>
          <th>Kembalian</th>
          <th class="colon">:</th>
          <th class="text-right"><?=num_to_price($billing->billing_change)?></th>
        </tr>
      </table>
    </div>
    <div class="column-footer">
      <div>Terimakasih atas kedatangan anda di <?=$client->client_name?></div>
    </div>
</html>