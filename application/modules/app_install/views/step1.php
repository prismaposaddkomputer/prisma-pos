<div class="col-md-8 col-md-offset-2">
  <form class="" action="<?=base_url()?>app_install/update_type" method="post">
    <div class="panel panel-default">
      <div class="panel-heading">Pilih Modul</div>
      <div class="panel-body">
        <b class="cl-info">Prisma Point of Sales</b> menyediakan beberapa modul.
        Silakan pilih tipe modul yang sesuai dengan yang sesuai dengan tipe usaha Anda.
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
        <button type="submit" class="btn btn-info">Lanjutkan</a>
      </div>
    </div>
  </form>
</div>
