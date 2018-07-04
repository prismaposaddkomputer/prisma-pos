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
    <table id="main">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Kategori</th>
          <th class="text-center">Merek</th>
          <th class="text-center">TNKB</th>
          <th class="text-center">Masuk</th>
          <th class="text-center">Petugas</th>
          <th class="text-center">Keluar</th>
          <th class="text-center">Petugas</th>
          <th class="text-center">Durasi</th>
          <th class="text-center">Biaya</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total_row = 0;
          $total_grand = 0;
        ?>
        <?php if ($billing != null): ?>
          <?php foreach ($billing as $row): ?>
            <tr>
              <td>TXP-<?=$row->billing_id?></td>
              <td><?=$row->category_name?></td>
              <td><?=$row->brand_name?></td>
              <td class="text-center"><?=$row->billing_tnkb?></td>
              <td class="text-center"><?=date_to_ind($row->billing_date_in).' '.$row->billing_time_in?></td>
              <td class="text-center"><?=$row->user_realname_in?></td>
              <td class="text-center"><?=date_to_ind($row->billing_date_out).' '.$row->billing_time_out?></td>
              <td class="text-center"><?=$row->user_realname_out?></td>
              <td class="text-center"><?=$row->billing_duration?> jam</td>
              <td><?=num_to_idr($row->billing_total)?></td>
              <?php
                $total_row++;
                $total_grand += $row->billing_total;
              ?>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">Tidak ada data!</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <div style="width:200px;margin-left:5px;">
      <table>
        <tr>
          <td width="100">Total Kendaraan</td>
          <td width="5">:</td>
          <td><?=$total_row?></td>
        </tr>
        <tr>
          <td>Total Biaya</td>
          <td>:</td>
          <td><?=num_to_idr($total_grand)?></td>
        </tr>
      </table>
    </div>
  </body>
</html>
