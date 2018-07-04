<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <form id="form" class="" action="<?=base_url()?>ret_cashier/<?=$action?>" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Pengguna</label>
              <input class="form-control keyboard" type="hidden" name="user_id" value="<?=$this->session->userdata('user_id')?>">
              <input class="form-control keyboard" type="text" name="user_realname" value="<?=$this->session->userdata('user_realname')?>" readonly>
            </div>
          </div>
        </div>
        <?php if ($shift_type == 0): ?>
          <div class="row">
            <div class="col-md-6">
              <h4>Uang Kertas (Lembar)</h4>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>100.000</label>
                    <input class="form-control keyboard" type="number" name="money_in_100k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>50.000</label>
                    <input class="form-control keyboard" type="number" name="money_in_50k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>20.000</label>
                    <input class="form-control keyboard" type="number" name="money_in_20k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>10.000</label>
                    <input class="form-control keyboard" type="number" name="money_in_10k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>5.000</label>
                    <input class="form-control keyboard" type="number" name="money_in_5k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>2.000</label>
                    <input class="form-control keyboard" type="number" name="money_in_2k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>1.000</label>
                    <input class="form-control keyboard" type="number" name="money_in_1k" value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <h4>Uang Koin (Keping)</h4>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>1.000</label>
                    <input class="form-control keyboard" type="number" name="coin_in_1k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>500</label>
                    <input class="form-control keyboard" type="number" name="coin_in_500" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>200</label>
                    <input class="form-control keyboard" type="number" name="coin_in_200" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>100</label>
                    <input class="form-control keyboard" type="number" name="coin_in_100" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>50</label>
                    <input class="form-control keyboard" type="number" name="coin_in_50" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>25</label>
                    <input class="form-control keyboard" type="number" name="coin_in_25" value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group pull-right">
                <?php if ($shift_type == '0'): ?>
                  <button class="btn btn-info" type="submit"><i class="fa fa-sign-in"></i> Shift Masuk</button>
                <?php else: ?>
                  <button class="btn btn-info" type="submit"><i class="fa fa-sign-out"></i> Shift Masuk</button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="row">
            <div class="col-md-6">
              <h4>Uang Kertas (Lembar)</h4>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>100.000</label>
                    <input class="form-control keyboard" type="number" name="money_out_100k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>50.000</label>
                    <input class="form-control keyboard" type="number" name="money_out_50k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>20.000</label>
                    <input class="form-control keyboard" type="number" name="money_out_20k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>10.000</label>
                    <input class="form-control keyboard" type="number" name="money_out_10k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>5.000</label>
                    <input class="form-control keyboard" type="number" name="money_out_5k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>2.000</label>
                    <input class="form-control keyboard" type="number" name="money_out_2k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>1.000</label>
                    <input class="form-control keyboard" type="number" name="money_out_1k" value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <h4>Uang Koin (Keping)</h4>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>1.000</label>
                    <input class="form-control keyboard" type="number" name="coin_out_1k" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>500</label>
                    <input class="form-control keyboard" type="number" name="coin_out_500" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>200</label>
                    <input class="form-control keyboard" type="number" name="coin_out_200" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>100</label>
                    <input class="form-control keyboard" type="number" name="coin_out_100" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>50</label>
                    <input class="form-control keyboard" type="number" name="coin_out_50" value="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>25</label>
                    <input class="form-control keyboard" type="number" name="coin_out_25" value="0">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group pull-right">
                <?php if ($shift_type == '0'): ?>
                  <button class="btn btn-green" type="submit"><i class="fa fa-sign-in"></i> Shift Masuk</button>
                <?php else: ?>
                  <a class="btn btn-default" href="<?=base_url()?>ret_cashier"><i class="fa fa-close"></i>Batal</a>
                  <button class="btn btn-warning" type="submit"><i class="fa fa-sign-out"></i> Shift Keluar</button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>
