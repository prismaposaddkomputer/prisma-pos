<div class="content-header">
  <a class="btn btn-success pull-right" target="" href="<?=base_url()?>hot_report_booking/report_daily_pdf/<?=$date?>"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <table class="table table-bordered table-condensed table-striped">
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
                  
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
        <tr>
          <td colspan="8" class="text-center">Tidak ada data!</td>
        </tr>
      <?php endif;?>
    </tbody>
  </table>
</div>
