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
      <table id="main" class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">No Nota</th>
            <th class="text-center">Nama Tamu</th>
            <th class="text-center">Status</th>
            <th class="text-center">Sub Total</th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Denda</th>

            <?php 
            foreach ($charge_type as $data): 
            //
            $no = $data['charge_type_id'];
            $grand_down_total_tax[$no] = 0;
            //
            ?>
            <th class="text-center"><?=$data['charge_type_name']?></th>
            <?php endforeach ?>

            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_subtotal = 0;
            $billing_tax = 0;
            $billing_service = 0;
            $billing_other = 0;
            $billing_discount = 0;
            $billing_denda = 0;
            $total_tax = 0;
            $total_service = 0;
            $total_other = 0;
            $billing_total = 0;
          ?>
          <?php if ($daily != null): ?>
            <?php $i=1;foreach ($daily as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td class="text-center">TRS - <?=$row->billing_receipt_no?></td>
                <td class="text-center"><?=$row->guest_name?></td>
                <td class="text-center">
                  <?php switch ($row->billing_status) {
                    case '-1':
                      echo '<span class="badge bg-danger">Batal</span>';
                      break;

                    case '1':
                      echo '<span class="badge bg-warning">Proses</span>';
                      break;

                    case '2':
                      echo '<span class="badge bg-success">Selesai</span>';
                      break;
                  } ?>
                </td>
                
                <?php if ($client->client_is_taxed == 0): ?>

                  <td><?=num_to_idr($row->billing_subtotal)?></td>
                  <?php $billing_subtotal += $row->billing_subtotal;?>

                <?php else: ?>

                  <?php
                  $after_billing_subtotal = ($row->billing_subtotal) + ($row->billing_tax + $row->billing_service + $row->billing_other) + ($row->billing_discount);
                  ?>

                  <td><?=num_to_idr($after_billing_subtotal)?></td>
                  <?php $billing_subtotal += $after_billing_subtotal;?>

                <?php endif; ?>

                <td><?=num_to_idr($row->billing_discount)?></td>
                  <?php $billing_discount += $row->billing_discount;?>

                <td><?=num_to_idr($row->billing_denda)?></td>
                  <?php $billing_denda += $row->billing_denda;?>
                
                <!-- Charge Type -->
                <?php 
                  foreach ($charge_type as $data): 
                  if ($data['charge_type_id'] == '1') {
                    $billing_charge_type = $row->billing_tax;
                  }else if ($data['charge_type_id'] == '2') {
                    $billing_charge_type = $row->billing_service;
                  }else if ($data['charge_type_id'] == '3') {
                    $billing_charge_type = $row->billing_other;
                  }
                ?>
                <td><?=num_to_idr($billing_charge_type)?></td>
                <?php 
                endforeach; 
                $total_tax += $row->billing_tax;
                $total_service += $row->billing_service;
                $total_other += $row->billing_other;
                ?>  
                <!-- End Charge Type -->

                <!-- Grand Total -->
                <td><?=num_to_idr($row->billing_total)?></td>
                  <?php $billing_total += $row->billing_total;?>
                <!-- End Grand Total -->
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="11">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="4">Total</th>
            <th><?=num_to_idr($billing_subtotal)?></th>
            <th><?=num_to_idr($billing_discount)?></th>
            <th><?=num_to_idr($billing_denda)?></th>
            <?php 
            foreach ($charge_type as $data): 
            if ($data['charge_type_id'] == '1') {
              $total_charge_type = $total_tax;
            }else if ($data['charge_type_id'] == '2') {
              $total_charge_type = $total_service;
            }else if ($data['charge_type_id'] == '3') {
              $total_charge_type = $total_other;
            }
            ?>
            <th><?=num_to_idr($total_charge_type)?></th>
            <?php endforeach; ?> 
            <th><?=num_to_idr($billing_total)?></th> 
          </tr>
        </tfoot>
      </table>
    </div>
  </body>
</html>
