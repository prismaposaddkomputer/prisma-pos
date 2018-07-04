<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-8 col-lg-7 pull-right">
      <form class="" action="<?=base_url()?>ret_report/report_selling_item" method="post">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control daterange-picker" name="search_selling_item" value="<?php echo $this->session->userdata('search_selling_item');?>">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              <a class="btn btn-default" href="<?=base_url()?>ret_report/reset_selling_item"><i class="fa fa-refresh"></i></a>
            </span>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php if ($this->session->userdata('search_selling_item')): ?>
        <i class="search_result">Hasil pencarian dengan kata kunci: <b><?=$this->session->userdata('search_selling_item');?></b></i><br><br>
      <?php endif; ?>
      <?php echo $this->session->flashdata('status'); ?>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="30">No.</th>
              <th class="text-center">Nama Item</th>
              <th class="text-center" width="120">Jumlah Terjual</th>
              <th class="text-center" width="150">Jumlah Nominal</th>
              <th class="text-center" width="150">Rata-rata</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $selling_amount = 0;
              $selling_subtotal = 0;
              $item_price_average = 0;
            ?>
            <?php if ($selling_item != null): ?>
              <?php $i=1;foreach ($selling_item as $row): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$row->item_name?></td>
                  <td class="text-right"><?=$row->selling_amount?></td>
                  <?php $selling_amount += $row->selling_amount; ?>
                  <td><?=num_to_idr($row->selling_subtotal)?></td>
                  <?php $selling_subtotal += $row->selling_subtotal; ?>
                  <td><?=num_to_idr($row->item_price_average)?></td>
                  <?php $item_price_average += $row->item_price_average; ?>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="9">Tidak ada data!</td>
              </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <th class="text-center" colspan="2">Total</th>
            <th class="text-right"><?=$selling_amount?></th>
            <th><?=num_to_idr($selling_subtotal)?></th>
            <th><?=num_to_idr($item_price_average)?></th>
          </tfoot>
        </table>
        <div class="pull-right">
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
