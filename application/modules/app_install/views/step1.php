<div class="col-md-8 col-md-offset-2">
  <form class="" action="<?=base_url()?>app_install/update_type" method="post">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Pilih Modul</strong></div>
      <div class="panel-body">
        <b class="cl-info">Prisma POS</b> menyediakan beberapa modul.
        Silakan pilih tipe modul yang sesuai dengan yang sesuai dengan tipe usaha anda.
        <br><br>
        <div class="row">
          <?php foreach ($type as $row): ?>
            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading text-center"><?=$row['type_name']?></div>
                <div class="panel-body text-center">
                  <i class="fa fa-<?=$row['type_icon']?> fa-3x cl-info"></i>
                </div>
                <div class="panel-footer text-center">
                  <input type="radio" name="type_id" value="<?=$row['type_id']?>" checked>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="panel-footer">
        <a class="btn btn-default" href="<?=base_url()?>app_install/index"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-info pull-right">Lanjut <i class="fa fa-arrow-right"></i></a>
      </div>
    </div>
  </form>
</div>
