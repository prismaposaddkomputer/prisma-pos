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
      <h4>Nama Pelanggan : <?=$customer->customer_name?></h4>
      <table id="main" class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th class="text-center">No. Kwitansi</th>
            <th class="text-center">Waktu</th>
            <th class="text-center">Kasir</th>
            <th class="text-center">Pelangan</th>
            <th class="text-center">Status</th>
            <th class="text-center">Pembayaran</th>
            <th class="text-center">Subtotal</th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $total_before_tax = 0;
            $total_discount = 0;
            $total_tax = 0;
            $total_grand = 0;
          ?>
          <?php if ($daily != null): ?>
            <?php $i=1;foreach ($daily as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td class="text-center"><?=$row->tx_type.'-'.$row->tx_receipt_no?></td>
                <td class="text-center"><?=$row->tx_time?></td>
                <td><?=$row->user_realname?></td>
                <td><?=$row->customer_name?></td>
                <td class="text-center">
                  <?php switch ($row->tx_status) {
                    case '-2':
                      echo 'Batal';
                      break;

                    case '-1':
                      echo 'Tahan';
                      break;

                    case '0':
                      echo 'Proses';
                      break;

                    case '1':
                      echo 'Sukses';
                      break;
                  } ?>
                </td>
                <td><?=$row->payment_type_name?></td>
                <td class="text-right"><?=num_to_idr($row->tx_total_before_tax)?></td>
                  <?php $total_before_tax += $row->tx_total_before_tax;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_tax)?></td>
                  <?php $total_tax += $row->tx_total_tax;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_discount)?></td>
                  <?php $total_discount += $row->tx_total_discount;?>
                <td class="text-right"><?=num_to_idr($row->tx_total_grand)?></td>
                  <?php $total_grand += $row->tx_total_grand;?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="10">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="7" class="text-center">Total</th>
            <th class="text-right"><?=num_to_idr($total_before_tax)?></th>
            <th class="text-right"><?=num_to_idr($total_discount)?></th>
            <th class="text-right"><?=num_to_idr($total_tax)?></th>
            <th class="text-right"><?=num_to_idr($total_grand)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </body>
</html>
