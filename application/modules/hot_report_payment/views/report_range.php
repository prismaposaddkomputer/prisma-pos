<div class="content-header">
  <a class="btn btn-success pull-right" target="" href="<?=base_url()?>hot_report_payment/report_range_pdf/<?=$date_start?>/<?=$date_end?>"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
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
        <th class="text-center">Lama Hari</th>
        <th class="text-center">Total Pembayaran</th>
        <th class="text-center">Nama Resepsionis</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($booking != null): ?>
              <?php $i=1;foreach ($booking as $row): ?>
                <tr>
                  <td class="text-center"><?=$i++?></td>
                  <td><?=$row->booking_code?></td>
                  <td><?=$row->date_booking_from?></td>
                  <td><?=$row->date_booking_to?></td>
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
                  <td><?=$row->number_of_days?> Hari</td>
                  <td>
                  <?php
                        foreach($payment as $t){
                          if($row->booking_id==$t->booking_id){
                            ?>
                                 Rp <?=$t->grand_total?> 
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
