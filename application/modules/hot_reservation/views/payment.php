<div class="content-header">
  <h4><i class="fa fa-money"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <table class="table table-condensed">
        <tbody>  
          <tr>
            <td width="200">No. Nota</td>
            <td width="10">:</td>
            <td>TXS-<?=$billing->billing_receipt_no?></td>
          </tr>
          <tr>
            <td>Check In</td>
            <td>:</td>
            <td><?=date_to_ind($billing->billing_date_in)?> <?=$billing->billing_time_in?></td>
          </tr>
          <tr>
            <td>Check Out</td>
            <td>:</td>
            <td><?=date_to_ind($billing->billing_date_out)?> <?=$billing->billing_time_out?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <table class="table table-condensed">
        <tbody>  
          <tr>
            <td width="200">Tamu</td>
            <td width="10">:</td>
            <td>
              <?php if ($billing->guest_gender == 'L') {
                echo 'Tn. ';
              }else{
                echo 'Ny. ';
              } ?>
              <?=$billing->guest_name?>
            </td>
          </tr>
          <tr>
            <td>No. Telp</td>
            <td>:</td>
            <td><?php if ($billing->guest_phone == '') {echo '-';} else {echo $billing->guest_phone;}?></td>
          </tr>
          <tr>
            <td>Jenis Identitas</td>
            <td>:</td>
            <td>
              <?php                 
                switch ($billing->guest_id_type) {
                  case 2:
                    echo 'KTP';
                    break;
                  
                  case 3:
                    echo 'SIM';
                    break;
                  
                  case 4:
                    echo 'Lainnya';
                    break;
                  
                  default:
                    echo '-';
                    break;
                }
              ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <?php $tot_room = 0;if ($billing->room != null): ?>  
    <div class="row">
      <div class="col-md-12">
        <h4><b><i class="fa fa-bed"></i></b> A. Kamar</h4>
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="20">No.</th>
              <th class="text-center">Jenis Kamar</th>
              <th class="text-center">Kamar</th>
              <th class="text-center">Tarif</th>
              <th class="text-center">Durasi</th>
              <th class="text-center">Total</th>
            </tr>              
          </thead>
          <tbody>
            <?php $i=1;foreach ($billing->room as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->room_type_name?></td>
                <td><?=$row->room_name?></td>
                <td><?=num_to_idr($row->room_type_charge)?></td>
                <td class="text-center"><?=$billing->billing_num_day?> Hari</td>
                <td><?=num_to_idr($row->room_type_charge*$billing->billing_num_day)?></td>
                <?php $tot_room += $row->room_type_charge*$billing->billing_num_day;?>
              </tr>
            <?php endforeach;?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center" colspan="5">Total</th>
              <th><?=num_to_idr($tot_room)?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  <?php endif;?>
  <?php $tot_extra = 0;if ($billing->extra != null): ?>  
    <div class="row">
      <div class="col-md-12">
        <h4><b><i class="fa fa-bed"></i></b> A. Kamar</h4>
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="20">No.</th>
              <th class="text-center">Kamar</th>
              <th class="text-center">Tarif</th>
              <th class="text-center">Banyak</th>
              <th class="text-center">Total</th>
            </tr>              
          </thead>
          <tbody>
            <?php $i=1;foreach ($billing->extra as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->extra_name?></td>
                <td><?=num_to_idr($row->extra_charge)?></td>
                <td class="text-center"><?=$billing->billing_num_day?></td>
                <td><?=num_to_idr($row->extra_charge*$row->extra_amount)?></td>
                <?php $tot_extra += $row->extra_charge*$billing->billing_num_day;?>
              </tr>
            <?php endforeach;?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center" colspan="4">Total</th>
              <th><?=num_to_idr($tot_extra)?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  <?php endif;?>
</div>