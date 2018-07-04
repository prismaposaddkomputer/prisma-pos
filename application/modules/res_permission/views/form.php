<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <form action="<?=base_url()?>res_permission/<?=$action?>" method="post">
          <input type="hidden" name="role_id" value="<?=$role_id?>">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="text-center" width="80">Kode</th>
                <th class="text-center">Nama Modul</th>
                <th class="text-center" width="80">Buat</th>
                <th class="text-center" width="80">Baca</th>
                <th class="text-center" width="80">Ubah</th>
                <th class="text-center" width="80">Hapus</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($permission != null): ?>
                <?php $i=1;foreach ($permission as $row): ?>
                  <tr>
                    <td><?=$row->module_id?></td>
                    <td><?=$row->module_name?></td>
                    <td class="text-center">
                      <input type="checkbox" name="_create[]" value="<?=$row->module_id?>" <?php if($row->_create == 1){echo 'checked';}?>>
                    </td>
                    <td class="text-center">
                      <input type="checkbox" name="_read[]" value="<?=$row->module_id?>" <?php if($row->_read == 1){echo 'checked';}?>>
                    </td>
                    <td class="text-center">
                      <input type="checkbox" name="_update[]" value="<?=$row->module_id?>" <?php if($row->_update == 1){echo 'checked';}?>>
                    </td>
                    <td class="text-center">
                      <input type="checkbox" name="_delete[]" value="<?=$row->module_id?>" <?php if($row->_delete == 1){echo 'checked';}?>>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td class="text-center" colspan="3">Tidak ada data!</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
          <div class="form-group pull-right">
            <a class="btn btn-default" href="<?=base_url()?>res_permission/index"><i class="fa fa-close"></i> Batal</a>
            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
