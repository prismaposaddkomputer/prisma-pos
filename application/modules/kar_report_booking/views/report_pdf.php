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
            <th class="text-center" width="80">#</th>
            <th class="text-center">Kode Booking</th>
            <th class="text-center">Check In</th>
            <th class="text-center">Check Out</th>
            <th class="text-center">Nama Tamu</th>
            <th class="text-center">No Kamar</th>
            <th class="text-center">Nama Kamar</th>
            <th class="text-center">Nama Resepsionis</th>
          </tr>
      </thead>
      <tbody>
        <?php
          $total_row = 0;
        ?>
        <?php if ($booking != null): ?>
              <?php $i=1;foreach ($booking as $row): ?>
                <tr>
                  <td class="text-center"><?=$i++?></td>
                  <td><?=$row->booking_code?></td>
                  <td><?=date_to_ind($row->date_booking_from)?></td>
                  <td><?=date_to_ind($row->date_booking_to)?></td>
                  <td>
                  <?php
                        foreach($guest as $t){
                          if($row->guest_id==$t->guest_id){
                            ?>
                            <?=$t->guest_name?>
                            <?php
                          }
                        }
                      ?>
                  </td>
                  <td>
                  <?php
                        foreach($room as $t){
                          if($row->room_id==$t->room_id){
                            ?>
                            <?=$t->room_number?>
                            <?php
                          }
                        }
                      ?>
                  </td>
                  <td>
                  <?php
                        foreach($room as $t){
                          if($row->room_id==$t->room_id){
                            ?>
                            <?php
                              foreach($tipe as $s){
                                if($s->category_id==$t->category_id){
                                  ?>
                                  <?=$s->category_name?> - 
                                  <?php
                                }
                              }
                            ?>
                            <?=$t->room_name?>
                            <?php
                          }
                        }
                      ?>
                  </td>
                  <td><?=$row->created_by?></td>
                    <?php
                      $total_row++;
                    ?>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
        <tr>
          <td colspan="8" class="text-center">Tidak ada data!</td>
        </tr>
      <?php endif;?>
      </tbody>
    </table>
    <div style="width:200px;margin-left:5px;">
      <table>
        <tr>
          <td width="100">Total Pemesanan</td>
          <td width="5">:</td>
          <td><?=$total_row?></td>
        </tr>
      </table>
    </div>
  </body>
</html>
