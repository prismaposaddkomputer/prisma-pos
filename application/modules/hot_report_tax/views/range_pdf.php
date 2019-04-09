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
      <table id="main" class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="15">No</th>
            <th class="text-center" width="80">Tanggal</th>
            <th class="text-center" width="220">Total</th>
            <th class="text-center" width="220">Pajak</th>
          </tr>
          <tr>
            <td class="text-center" style="padding:0px;">1</td>
            <td class="text-center" style="padding:0px;">2</td>
            <td class="text-center" style="padding:0px;">3</td>
            <td class="text-center" style="padding:0px;">4</td>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_total_all = 0;
            $tax_total_all = 0;
          ?>
          <?php if ($range != null): ?>
            <?php $i=1;foreach ($range as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td class="text-center"><?=date_to_ind($row->billing_date_in)?></td>

                <?php
                $billing_total = $row->billing_total-$row->billing_discount_custom;
                $tax_total = $billing_total * ($charge_type->charge_type_ratio/100);
                ?>

                <?php if ($client->client_is_taxed == 0): ?>

                  <!-- Grand Total -->
                  <td class="text-right"><?=num_to_idr($billing_total)?></td>
                    <?php $billing_total_all += $billing_total;?>
                  <!-- End Grand Total -->

                  <!-- Tax Total -->
                  <td class="text-right"><?=num_to_idr($tax_total)?></td>
                    <?php $tax_total_all += $tax_total;?>
                  <!-- End Tax Total -->

                <?php else: ?>

                  <!-- Grand Total -->
                  <td class="text-right"><?=num_to_idr($billing_total)?></td>
                    <?php $billing_total_all += $billing_total;?>
                  <!-- End Grand Total -->

                  <!-- Tax Total -->
                  <td class="text-right"><?=num_to_idr($tax_total)?></td>
                    <?php $tax_total_all += $tax_total;?>
                  <!-- End Tax Total -->

                <?php endif; ?>


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
            <th class="text-right"><?=num_to_idr($billing_total_all)?></th> 
            <th class="text-right"><?=num_to_idr($tax_total_all)?></th>  
          </tr>
        </tfoot>
      </table>
    </div>
  </body>
</html>
