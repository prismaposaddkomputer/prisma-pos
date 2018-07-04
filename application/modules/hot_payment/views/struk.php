<!DOCTYPE html>
<?php
// for several class or function
    function Terbilang($x)
    {
        $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if ($x < 12) {
            return " " . $abil[$x];
        }
        elseif ($x < 20) {
            return Terbilang($x - 10) . "Belas";
        }
        elseif ($x < 100) {
            return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
        }
        elseif ($x < 200) {
            return " seratus" . Terbilang($x - 100);
        }
        elseif ($x < 1000) {
            return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
        }
        elseif ($x < 2000) {
            return " Seribu" . Terbilang($x - 1000);
        }
        elseif ($x < 1000000) {
            return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
        }
        elseif ($x < 1000000000) {
            return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
        }
    }

    function digit($inp = 0)
    {
        return number_format($inp, 0, ',', '.');
    }
   

?>


<html lang="en" dir="ltr">
  <head>
  <title>PRINT OUT DETAIL PEMBAYARAN</title>
    <style media="screen">
      *{
        margin:0;
        padding:0;
        font-size: 16px;
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
    <h1 style="font-size:26px;" align="center">
    <?=$client->client_name?> <br> <?=$client->client_street?>, <?=$client->client_district?>, <?=$client->client_city?>, <?=$client->client_province?> <?=$client->client_serial_number?>
    </h1>
    <hr>
    <br>
    <h1 style="font-size:20px;" align="center">
    Detail Pembayaran
    </h1>
    <br>
    <table width="100%">
        <tbody>
            <tr>
              <td width="180" style="font-size:16px;">Resepsionis</td>
              <td class="text-center" width="20" style="font-size:16px;">:</td>
              <td style="font-size:16px;"><?=$booking->created_by?></td>
            </tr>
            <tr>
              <td style="font-size:16px;">Kode Booking</td>
              <td class="text-center" style="font-size:16px;">:</td>
              <td style="font-size:16px;">#<?=$booking->booking_code?></td>
            </tr>
            <tr>
              <td style="font-size:16px;">Tanggal Pemesanan</td>
              <td class="text-center" style="font-size:16px;">:</td>
              <td style="font-size:16px;"><?=$booking->date_booking?></td>
            </tr>
            <tr>
              <td style="font-size:16px;">Durasi</td>
              <td class="text-center" style="font-size:16px;">:</td>
              <td style="font-size:16px;"><?=$booking->number_of_days?> Hari</td>
            </tr>
            <tr>
              <td style="font-size:16px;">Tanggal Check Out</td>
              <td class="text-center">:</td>
              <td style="font-size:16px;"><?=$booking->date_booking_to?></td>
            </tr>
            <tr>
              <td style="font-size:16px;">Nama Tamu</td>
              <td class="text-center" style="font-size:16px;">:</td>
              <?php
                                foreach($guest as $z){
                                  if($booking->guest_id==$z->guest_id){
                                    ?>
             <td style="font-size:16px;"><?=$z->guest_name?></td>
                             <?php
                                  }
                                }
                              ?>
              
            </tr>
          </tbody>
    </table>
    <br>
    <h1 style="font-size:20px;" align="center">
    Detail Pelayanan
    </h1>
    <table id="main">
        <thead>
            <tr>
                <th class="text-center" width="80">No</th>
                <th class="text-center">Nama Pelayanan</th>
                <th class="text-center">Harga</th>
            </tr>
        </thead>
        <tbody>
        <tr>
                    <td class="text-center">1</td>
                    <td>
                        <?php
                            foreach($service as $t){
                            if($booking->service_id==$t->service_id){
                                ?>
                                <?=$t->service_name?>
                                <?php
                            }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($service as $t){
                            if($booking->service_id==$t->service_id){
                                ?>
                                Rp <?=digit($t->service_price)?>
                                <?php
                            }
                            }
                        ?>
                    </td>
                    
                </tr>
        </tbody>
    </table>
    <br>
    <h1 style="font-size:20px;" align="center">
    Detail Kamar
    </h1>
    <table id="main">
        <thead>
            <tr>
                <th class="text-center" width="80">#</th>
                <th class="text-center">No Kamar</th>
                <th class="text-center">Nama Kamar</th>
                <th class="text-center">Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                    <td class="text-center">1</td>
                    <td>
                    <?php
                            foreach($room as $t){
                            if($booking->room_id==$t->room_id){
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
                            if($booking->room_id==$t->room_id){
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
                    <td>
                    <?php
                            foreach($room as $t){
                            if($booking->room_id==$t->room_id){
                                ?>
                                <?php
                                foreach($tipe as $s){
                                    if($s->category_id==$t->category_id){
                                    ?>
                                    Rp <?=digit($s->category_price)?>
                                    <?php
                                    }
                                }
                                ?>
                                
                                <?php
                            }
                            }
                        ?>
                    </td>
                </tr>
                
        </tbody>
    </table>
    <br>
    <table width="100%">
        <tbody>
            <tr>
              <td width="180" style="font-size:16px;">Subtotal</td>
              <td class="text-center" width="20" style="font-size:16px;">:</td>
              <td style="font-size:16px;">
                        <?php
                          foreach($payment as $t){
                            if($booking->booking_id==$t->booking_id){
                              ?>
                              Rp <?=digit($t->subtotal)?> 
                              <?php
                            }
                          }
                        ?>
                </td>
            </tr>
            <tr>
              <td style="font-size:16px;">Diskon
                        <?php
                          foreach($payment as $t){
                            if($booking->booking_id==$t->booking_id){
                              ?>
                              (<?=$t->disc?>%)
                              <?php
                            }
                          }
                        ?>
              </td>
              <td class="text-center" style="font-size:16px;">:</td>
              <td style="font-size:16px;">
                    <?php
                          foreach($payment as $t){
                            if($booking->booking_id==$t->booking_id){
                                $s=$t->subtotal;
                                $d=$t->disc;
                                $tot=($s*$d)/100;
                                $p=($s-$tot)/10;
                                $grand=($s-$tot)+$p;
                              ?>
                              Rp <?=digit($tot)?>
                              
                             
              </td>
            </tr>
            <tr>
              <td style="font-size:16px;">Pajak Hotel (10%)</td>
              <td class="text-center" style="font-size:16px;">:</td>
              <td style="font-size:16px;">Rp <?=digit($p)?></td>
            </tr>
            <tr>
              <td style="font-size:16px;">Total Pembayaran</td>
              <td class="text-center" style="font-size:16px;">:</td>
              <td style="font-size:16px;">Rp <?=digit($grand)?></td>
            </tr>
            <tr>
              <td style="font-size:16px;">Terbilang</td>
              <td class="text-center" style="font-size:16px;">:</td>
              <td style="font-size:16px;"><?=terbilang($grand)?> Rupiah</td>
                            <?php
                            }
                          }
                        ?>
            </tr>
          </tbody>
    </table>
    <br>
    </div>
  </body>
</html>
