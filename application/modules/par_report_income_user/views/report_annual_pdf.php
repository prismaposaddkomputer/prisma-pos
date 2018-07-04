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
      h3{
        font-size: 16px;
      }
      h4{
        font-size: 14px;
      }
    </style>
  </head>
  <body>
    <h4 class="text-center"><?=$title?></h4>
    <br>
    <table id="main" class="table table-bordered table-condensed table-striped">
    <thead>
      <tr>
        <th class="text-center">Bulan</th>
        <th class="text-center">Jumlah Kendaraan</th>
        <th class="text-center" width="200">Total Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $billing_count = 0;
        $billing_total = 0;
      ?>
      <?php if($billing != null):?>
        <?php foreach ($billing as $row): ?>
          <tr>
            <td class="text-center"><?=month_name_ind($row->billing_month)?></td>
            <td class="text-center"><?=$row->billing_count?></td>
            <td class="text-right"><?=num_to_idr($row->billing_total)?></td>
            <?php 
              $billing_count += $row->billing_count;
              $billing_total += $row->billing_total;
            ?>
          </tr>
        <?php endforeach; ?>
      <?php else:?>
        <tr>
          <td colspan="3" class="text-center">Tidak ada data!</td>
        </tr>
      <?php endif;?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center">Total</th>
        <th class="text-center"><?=$billing_count?></th>
        <th class="text-right"><?=num_to_idr($billing_total)?></th>
      </tr>
    </tfoot>
  </table>
  </body>
</html>
