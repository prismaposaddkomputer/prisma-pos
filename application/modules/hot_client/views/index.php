<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-warning" href="<?=base_url()?>hot_client/form/<?=$client->client_id?>"><i class="fa fa-pencil"></i> Ubah Data</a>
      <br><br>
      <?php echo $this->session->flashdata('status'); ?>
      <div class="table-responsive">
        <table class="table table-striped table-condensed">
          <tbody>
            <tr>
              <th colspan="3">Profil Perusahaan</th>
            </tr>
            <tr>
              <td width="180">Nama Usaha</td>
              <td class="text-center" width="20">:</td>
              <td><?=$client->client_name?></td>
            </tr>
            <tr>
              <td>Nama Brand</td>
              <td class="text-center">:</td>
              <td><?=$client->client_brand?></td>
            </tr>
            <tr>
              <td>Status Usaha</td>
              <td class="text-center">:</td>
              <td><?=$client->client_status?></td>
            </tr>
            <tr>
              <th colspan="3">Alamat Perusahaan</th>
            </tr>
            <tr>
              <td>Alamat</td>
              <td class="text-center">:</td>
              <td><?=$client->client_street?></td>
            </tr>
            <tr>
              <td>Kelurahan</td>
              <td class="text-center">:</td>
              <td><?=$client->client_subdistrict?></td>
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
              <th colspan="3">Kontak</th>
            </tr>
            <tr>
              <td>Telepon 1</td>
              <td class="text-center">:</td>
              <td><?=$client->client_phone_1?></td>
            </tr>
            <tr>
              <td>Telepon 2</td>
              <td class="text-center">:</td>
              <td><?=$client->client_phone_2?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td class="text-center">:</td>
              <td><?=$client->client_email?></td>
            </tr>
            <tr>
              <th colspan="3">Wajib Pajak</th>
            </tr>
            <tr>
              <td>NPWP</td>
              <td class="text-center">:</td>
              <td><?=$client->client_npwp?></td>
            </tr>
            <tr>
              <td>NPWPD</td>
              <td class="text-center">:</td>
              <td><?=$client->client_npwpd?></td>
            </tr>
            <tr>
              <th colspan="3">Pemilik</th>
            </tr>
            <tr>
              <td>Nama Pemilik</td>
              <td class="text-center">:</td>
              <td><?=$client->client_owner_name?></td>
            </tr>
            <tr>
              <td>Alamat Pemilik</td>
              <td class="text-center">:</td>
              <td><?=$client->client_owner_address?></td>
            </tr>
            <tr>
              <th colspan="3">Data Lain</th>
            </tr>
            <tr>
              <td>Keterangan Tambahan</td>
              <td class="text-center">:</td>
              <td><?=$client->client_notes?></td>
            </tr>
            <tr>
              <td>Serial Number</td>
              <td class="text-center">:</td>
              <td><?=$client->client_serial_number?></td>
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
