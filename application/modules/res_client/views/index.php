<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-warning" href="<?=base_url()?>res_client/form/<?=$client->client_id?>"><i class="fa fa-pencil"></i> Ubah Data</a>
      <br><br>
      <?php echo $this->session->flashdata('status'); ?>
      <div class="table-responsive">
        <table class="table table-striped table-condensed">
          <tbody>
            <tr>
              <td width="180">Nama</td>
              <td class="text-center" width="20">:</td>
              <td><?=$client->client_name?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td class="text-center">:</td>
              <td><?=$client->client_street?></td>
            </tr>
            <tr>
              <td>Kecamatan</td>
              <td class="text-center">:</td>
              <td><?=$client->client_district?></td>
            </tr>
            <tr>
              <td>Kota</td>
              <td class="text-center">:</td>
              <td><?=$client->client_city?></td>
            </tr>
            <tr>
              <td>Provinsi</td>
              <td class="text-center">:</td>
              <td><?=$client->client_province?></td>
            </tr>
            <tr>
              <td>Serial Number</td>
              <td class="text-center">:</td>
              <td><?=$client->client_serial_number?></td>
            </tr>
            <tr>
              <td>NPWP</td>
              <td class="text-center">:</td>
              <td><?=$client->client_npwp?></td>
            </tr>
            <tr>
              <td>Virtual Keyboard</td>
              <td class="text-center">:</td>
              <td>
                <?php if ($client->client_keyboard_status == 1): ?>
                  <b class="cl-success">Aktif</b>
                <?php else: ?>
                  <b class="cl-danger">Tidak Aktif</b>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
