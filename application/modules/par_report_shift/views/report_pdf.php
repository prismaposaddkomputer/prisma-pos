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
          <th class="text-center">No.</th>
          <th class="text-center">Nama Pengguna</th>
          <th class="text-center">Tipe</th>
          <th class="text-center">Masuk</th>
          <th class="text-center">Jam Masuk</th>
          <th class="text-center">Total Uang</th>
          <th class="text-center">Keluar</th>
          <th class="text-center">Jam Keluar</th>
          <th class="text-center">Total Uang</th>
        </tr>
      </thead>
      <tbody>
        <?php if($shift != null):?>
          <?php $i=1; foreach ($shift as $row): ?>
            <tr>
              <td class="text-center"><?=$i++?></td>
              <td><?=$row->user_realname?></td>
              <td class="text-center">
                <?php if($row->parking_type == 0):?>
                  <span class="badge bg-success"><i class="fa fa-sign-in"></i> Parkir Masuk</span>
                <?php else:?>
                  <span class="badge bg-danger"><i class="fa fa-sign-out"></i> Parkir Keluar</span>
                <?php endif;?>
              </td>
              <td class="text-center">
                <?php if($row->shift_in_status == 1):?>
                  V
                <?php else:?>
                  X
                <?php endif;?>
              </td>
              <td class="text-center"><?=$row->shift_in_date.' '.$row->shift_in_time?></td>
              <td class="text-right"><?=num_to_idr($row->total_in)?></td>
              <td class="text-center">
                <?php if($row->shift_out_status == 1):?>
                  V
                <?php else:?>
                  X
                <?php endif;?>
              </td>
              <td class="text-center"><?=$row->shift_out_date.' '.$row->shift_out_time?></td>
              <td class="text-right"><?=num_to_idr($row->total_out)?></td>
            </tr>
          <?php endforeach; ?>
        <?php else:?>
          <tr>
            <td colspan="6" class="text-center">Tidak ada data!</td>
          </tr>
        <?php endif;?>
      </tbody>
    </table>
  </body>
</html>
