<style>
  #frame_pdf {
    width : 100%;
    min-height : 500px;
  }
</style>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a href="<?=base_url()?>hot_reservation/index" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
      <br><br>
      <iframe id="frame_pdf" src="<?=base_url()?>hot_reservation/reservation_print_pdf/<?=$billing_id?>" frameborder="0"></iframe>
    </div>
  </div>
</div>
