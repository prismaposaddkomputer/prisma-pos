<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      *{
        margin:0;
        padding:0;
        font-size: 10px;
        font-family: 'Arial';
      }
      body{
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        padding: 30px;
      }
      table {
        border-collapse: collapse;
      }
      #main,#main th,#main td {
        border: 1px solid black;
        padding: 3px;
      }
      #main{
        width : 100%;
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
    </style>
  </head>
  <body>
    <div id="header">
      <h5 class="text-center"><?=$client->client_name?></h5>
      <h4 class="text-center bolder"><?=$client->client_brand?></h4>
      <h5 class="text-center"><?=$client->client_street.', '.$client->client_subdistrict.', '.$client->client_district.', '.$client->client_city?></h5>
    </div>
    <br>
    <hr>
    <br>
    <h4 class="text-center bolder"><?=$title?></h4>
    <br>
    <table id="main" class="table table-bordered table-condensed table-striped">
      <thead>
        <tr>
          <th class="text-center">Tanggal</th>
          <th class="text-center">Nama Petugas</th>
          <th class="text-center">Jumlah Kendaraan</th>
          <th class="text-center">Subtotal</th>
          <th class="text-center">Pajak</th>
          <th class="text-center">Total Pendapatan</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $billing_count = 0;
          $billing_total_subtotal = 0;
          $billing_total_tax = 0;
          $billing_total_total_grand = 0;
        ?>
        <?php if($billing != null):?>
          <?php foreach ($billing as $row): ?>
            <tr>
              <td class="text-center"><?=date_to_ind($row->billing_date)?></td>
              <td class="text-center"><?=$row->user_realname_out?></td>
              <td class="text-center"><?=$row->billing_count?></td>
              <td class="text-right"><?=num_to_idr($row->billing_subtotal)?></td>
              <td class="text-right"><?=num_to_idr($row->billing_tax)?></td>
              <td class="text-right"><?=num_to_idr($row->billing_total_grand)?></td>
              <?php
                $billing_count += $row->billing_count;
                $billing_total_subtotal += $row->billing_subtotal;
                $billing_total_tax += $row->billing_tax;
                $billing_total_total_grand += $row->billing_total_grand;
              ?>
            </tr>
          <?php endforeach; ?>
        <?php else:?>
          <tr>
            <td colspan="6" class="text-center">Tidak ada data!</td>
          </tr>
        <?php endif;?>
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center" colspan="2">Total</th>
          <th class="text-center"><?=$billing_count?></th>
          <th class="text-right"><?=num_to_idr($billing_total_subtotal)?></th>
          <th class="text-right"><?=num_to_idr($billing_total_tax)?></th>
          <th class="text-right"><?=num_to_idr($billing_total_total_grand)?></th>
        </tr>
      </tfoot>
    </table>
  </body>
</html>
