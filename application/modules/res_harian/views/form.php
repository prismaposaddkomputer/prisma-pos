<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <?php if($client->client_is_taxed == 1):?>
    <div class="badge bg-warning">INFO : Total Transaksi Sudah Termasuk Pajak</div>
  <?php else: ?>
    <div class="badge bg-warning">INFO : Total Transaksi Belum Termasuk Pajak</div>
  <?php endif; ?>
  <br><br>
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>res_harian/<?=$action?>" method="post" autocomplete="off">
      <div class="col-md-3">
        <input class="form-control" type="hidden" name="billing_id" value="<?php if($billing != null){echo $billing->tx_id;}?>">
        <div class="form-group">
          <label>Tanggal <small class="required-field">*</small></label>
          <input class="form-control date-picker" type="text" name="tx_date" value="<?php if($billing != null){echo date_to_ind($billing->tx_date);}?>" <?php if($action == 'update'){echo 'readonly';} ?> required>
        </div>
        <div class="form-group">
          <label>Total Transaksi <small class="required-field">*</small></label>
          <?php 
            $total_transaksi = 0;
            if ($billing != null) {
              if ($client->client_is_taxed == 1) {
                $total_transaksi = $billing->tx_total_grand;
              }else{
                $total_transaksi = $billing->tx_total_before_tax;
              }
            }
          ?>
          <input class="form-control num autonumeric" type="text" name="total_transaksi" value="<?php if($billing != null){echo $total_transaksi;}?>" required>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>res_harian/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'billing_id': {
          required: true
        },
        'billing_name': {
          required: true
        }
      },
      messages: {
        'billing_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
