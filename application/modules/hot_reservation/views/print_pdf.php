<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
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
      #main,#main th,#main td {
        border: 1px solid black;
        padding: 3px;
      }
      #main{
        width : 100%;
      }
      #header{
        text-align:right; width:100%;
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
      <img id="img-logo" src="img/<?=$client->client_logo?>">
      <div><b><?=$client->client_name?></b></div>
      <div><?=$client->client_street.', '.$client->client_subdistrict.', '.$client->client_district?></div>
      <div><?=$client->client_city.', '.$client->client_province?></div>
      <div>Indonesia</div>
    </div>
    <div style="border-bottom: 1px solid black; margin-top: 15px;"></div>
    <div class="description-print">
      <div class="bill-to">
        <div>Pembayaran Kepada : </div>
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
      <div style="border-bottom: 1px solid black; margin-top: 110px;"></div>
    </div>
    <div style="padding-top: 150px;">
      <table id="main" class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">No Nota</th>
            <th class="text-center">Nama Tamu</th>
            <th class="text-center">Status</th>
            <th class="text-center">Sub Total</th>
            <th class="text-center">Diskon</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td class="text-center" colspan="6">Tidak ada data</td>
            </tr>
        </tbody>
      </table>
    </div>
</html>