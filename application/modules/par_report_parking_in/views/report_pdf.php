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
    <title><?=$title?></title>
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
    <table id="main">
      <thead>
        <tr>
          <th class="text-center" width="30">No.</th>
          <th class="text-center" width="80">No. Karcis</th>
          <th class="text-center">Kategori</th>
          <th class="text-center">Merek</th>
          <th class="text-center">TNKB</th>
          <th class="text-center">Masuk</th>
          <th class="text-center">Petugas</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total_row = 0;
        ?>
        <?php if ($billing != null): ?>
          <?php $i=1;foreach ($billing as $row): ?>
            <tr>
              <td class="text-center"><?=$i++?></td>
              <td class="text-center">TXP-<?=$row->receipt_no?></td>
              <td><?=$row->category_name?></td>
              <td><?=$row->brand_name?></td>
              <td class="text-center"><?=$row->billing_tnkb?></td>
              <td class="text-center"><?=date_to_ind($row->billing_date_in).' '.$row->billing_time_in?></td>
              <td class="text-center"><?=$row->user_realname_in?></td>
              <?php
                $total_row++;
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
      </table>
    </div>
  </body>
</html>
