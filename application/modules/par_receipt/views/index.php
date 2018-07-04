<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <a class="btn btn-warning" href="<?=base_url()?>par_receipt/form/<?=$receipt->receipt_id?>"><i class="fa fa-pencil"></i> Ubah Data</a>
      <br><br>
      <?php echo $this->session->flashdata('status'); ?>
      <div class="table-responsive">
        <h4>Header</h4>
        <table class="table table-striped table-condensed">
          <tbody>
            <tr>
              <td width="180">Nama Perusahaan</td>
              <td class="text-center" width="20">:</td>
              <td>
                <?php if ($receipt->receipt_name == 1): ?>
                  <i class="fa fa-check cl-success"></i>
                <?php else: ?>
                  <i class="fa fa-close cl-danger"></i>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td width="180">Alamat</td>
              <td class="text-center" width="20">:</td>
              <td>
                <?php if ($receipt->receipt_street == 1): ?>
                  <i class="fa fa-check cl-success"></i>
                <?php else: ?>
                  <i class="fa fa-close cl-danger"></i>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td width="180">Kecamatan</td>
              <td class="text-center" width="20">:</td>
              <td>
                <?php if ($receipt->receipt_district == 1): ?>
                  <i class="fa fa-check cl-success"></i>
                <?php else: ?>
                  <i class="fa fa-close cl-danger"></i>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td width="180">Kota</td>
              <td class="text-center" width="20">:</td>
              <td>
                <?php if ($receipt->receipt_city == 1): ?>
                  <i class="fa fa-check cl-success"></i>
                <?php else: ?>
                  <i class="fa fa-close cl-danger"></i>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td width="180">Provinsi</td>
              <td class="text-center" width="20">:</td>
              <td>
                <?php if ($receipt->receipt_province == 1): ?>
                  <i class="fa fa-check cl-success"></i>
                <?php else: ?>
                  <i class="fa fa-close cl-danger"></i>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td width="180">NPWP</td>
              <td class="text-center" width="20">:</td>
              <td>
                <?php if ($receipt->receipt_npwp == 1): ?>
                  <i class="fa fa-check cl-success"></i>
                <?php else: ?>
                  <i class="fa fa-close cl-danger"></i>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        </table>
        <h4>Footer</h4>
        <table class="table table-striped table-condensed">
          <tbody>
            <tr>
              <td width="180">Footer</td>
              <td class="text-center" width="20">:</td>
              <td><?=$receipt->receipt_footer;?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
