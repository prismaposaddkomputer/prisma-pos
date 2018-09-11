<style>
  #frame_pdf {
    width : 100%;
    min-height : 500px;
  }
</style>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a href="<?=base_url()?>res_report_selling/index" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
      <br><br>
      <iframe id="frame_pdf" src="<?=$url?>" frameborder="0"></iframe>
    </div>
  </div>
</div>
