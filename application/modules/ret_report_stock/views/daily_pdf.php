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
            <th class="text-center" width="30">No</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center" width="50">Awal</th>
            <th class="text-center" width="50">Masuk</th>
            <th class="text-center" width="50">Keluar</th>
            <th class="text-center" width="50">Penyesuaian</th>
            <th class="text-center" width="50">Akhir</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($daily != null): ?>
            <?php $i=1;foreach ($daily as $key => $val): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$val['item_name']?></td>
                <td class="text-center"><?=$val['stock_last']?></td>
                <td class="text-center"><?=$val['stock_in']?></td>
                <td class="text-center"><?=$val['stock_out']?></td>
                <td class="text-center"><?=$val['stock_adjustment']?></td>
                <td class="text-center"><?=$val['stock_now']?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="4">Tidak ada data!</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
