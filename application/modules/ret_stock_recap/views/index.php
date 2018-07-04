<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    
    <div class="col-md-8 col-lg-7 pull-right">
      <form class="" action="<?=base_url()?>ret_stock_recap/index" method="post">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control daterange-picker" name="search_term" value="<?php echo $this->session->userdata('search_term');?>">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              <a class="btn btn-default" href="<?=base_url()?>ret_stock_recap/reset_search"><i class="fa fa-refresh"></i></a>
            </span>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php if ($this->session->userdata('search_term')): ?>
        <i class="search_result">Hasil pencarian dengan kata kunci: <b><?=$this->session->userdata('search_term');?></b></i><br><br>
      <?php endif; ?>
      <?php echo $this->session->flashdata('status'); ?>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="50">No</th>
              <th class="text-center">Nama Barang</th>
              <th class="text-center" width="50">Awal</th>
              <th class="text-center" width="50">Masuk</th>
              <th class="text-center" width="50">Keluar</th>
              <th class="text-center" width="50">Penyesuaian</th>
              <th class="text-center" width="50">Akhir</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($stock_recap != null): ?>
              <?php $i=1;foreach ($stock_recap as $key => $val): ?>
                <tr>
                  <td class="text-center"><?=$this->uri->segment('3')+$i++?></td>
                  <td><?=$val['item_name']?></td>
                  <td class="text-center"><?=$val['stock_last']?></td>
                  <td class="text-center"><?=$val['stock_in']?></td>
                  <td class="text-center"><?=$val['stock_out']?></td>
                  <td class="text-center"><?=$val['stock_adjustment']?></td>
                  <td class="text-center"><?=$val['stock_now']?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="4">Tidak ada data!</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="pull-right">
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
