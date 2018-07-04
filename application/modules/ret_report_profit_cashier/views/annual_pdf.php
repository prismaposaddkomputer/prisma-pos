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
      #header{
        border-bottom: 1px solid black;
        padding-bottom: 10px;
        margin-bottom: 10px;
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
    <title><?=$title?></title>
  </head>
  <body>
    <div id="header">
      <h5 class="text-center"><?=$client->client_name?></h5>
      <h4 class="text-center bolder"><?=$client->client_brand?></h4>
      <h5 class="text-center"><?=$client->client_street.', '.$client->client_subdistrict.', '.$client->client_district.', '.$client->client_city?></h5>
    </div>
    <div>
      <h4 class="text-center"><?=$title?></h4>
      <br>
      <h4>Nama Kasir : <?=$user->user_realname?></h4>
      <table id="main" class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="50">No.</th>
            <th class="text-center" width="85">Bulan</th>
            <th class="text-center">Pembelian</th>
            <th class="text-center">Penjualan<br><small>(Sebelum Pajak)</small></th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Penjualan<br><small>(Setelah Pajak)</small><br><small>(3+4)</small></th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Keuntungan<br><small>(Sebelum Pajak)</small><br><small>(3-2-6)</small></th>
            <th class="text-center">Keuntungan<br><small>(Setelah Pajak)</small><br><small>(7-4)</small></th>
          </tr>
          <tr>
            <td class="text-center" style="padding:0px;">1</td>
            <td class="text-center" style="padding:0px;">2</td>
            <td class="text-center" style="padding:0px;">3</td>
            <td class="text-center" style="padding:0px;">4</td>
            <td class="text-center" style="padding:0px;">5</td>
            <td class="text-center" style="padding:0px;">6</td>
            <td class="text-center" style="padding:0px;">7</td>
            <td class="text-center" style="padding:0px;">8</td>
            <td class="text-center" style="padding:0px;">9</td>
          </tr>
        </thead>
        <tbody>
          <?php
            $tx_total_buy_average = 0;
            $tx_total_before_tax = 0;
            $tx_total_tax = 0;
            $tx_total_after_tax = 0;
            $tx_total_discount = 0;
            $tx_total_profit_before_tax = 0;
            $tx_total_profit_after_tax = 0;
          ?>
          <?php if ($annual != null): ?>
            <?php $i=1;foreach ($annual as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td class="text-center"><?=month_name_ind($row->tx_month)?></td>
                <td class="text-right"><?=num_to_idr($row->tx_total_buy_average)?></td>
                  <?php $tx_total_buy_average += $row->tx_total_buy_average;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_before_tax)?></td>
                  <?php $tx_total_before_tax += $row->tx_total_before_tax;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_tax)?></td>
                  <?php $tx_total_tax += $row->tx_total_tax;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_after_tax)?></td>
                  <?php $tx_total_after_tax += $row->tx_total_after_tax;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_discount)?></td>
                  <?php $tx_total_discount += $row->tx_total_discount;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_profit_before_tax)?></td>
                  <?php $tx_total_profit_before_tax += $row->tx_total_profit_before_tax;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_profit_after_tax)?></td>
                  <?php $tx_total_profit_after_tax += $row->tx_total_profit_after_tax;?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="9">Tidak ada data!</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="2">Total</th>
            <th class="text-right"><?=num_to_idr($tx_total_buy_average)?></th>
            <th class="text-right"><?=num_to_idr($tx_total_before_tax)?></th>
            <th class="text-right"><?=num_to_idr($tx_total_tax)?></th>
            <th class="text-right"><?=num_to_idr($tx_total_after_tax)?></th>
            <th class="text-right"><?=num_to_idr($tx_total_discount)?></th>
            <th class="text-right"><?=num_to_idr($tx_total_profit_before_tax)?></th>
            <th class="text-right"><?=num_to_idr($tx_total_profit_after_tax)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </body>
</html>
