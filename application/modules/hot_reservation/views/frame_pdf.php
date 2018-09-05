<style>
  #frame_pdf {
    width : 100%;
    min-height : 500px;
  }
</style>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <?php if ($url !=''): ?>
        <a href="<?=base_url()?><?=$url?>/detail/<?=$billing_id?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
      <?php else: ?>
        <a href="<?=base_url()?>hot_reservation/index" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
      <?php endif; ?>
      <br><br>
      <iframe id="frame_pdf" src="<?=base_url()?>hot_reservation/reservation_print_pdf/<?=$billing_id?>" frameborder="0"></iframe>
    </div>
  </div>
</div>
