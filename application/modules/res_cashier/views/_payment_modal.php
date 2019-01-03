<div id="modal_payment" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pembayaran</h4>
      </div>
      <div class="modal-body">
        <div id="change_section">
          <div id="change_label"></div>
          <button type="button" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-flag-checkered"></i> Selesai</button>
        </div>
        <div id="payment_section">
          <div class="form-group">
            <label>Total</label>
            <input class="form-control" id="payment_tx_total_grand" type="text" val="0" readonly>
          </div>
          <div class="form-group">
            <label>Uang Muka</label>
            <input class="form-control" id="payment_down_payment" type="text" val="0" readonly>
          </div>
          <div class="form-group">
            <label>Sisa Bayar</label>
            <input class="form-control" id="payment_nominal" type="text" val="0" readonly>
          </div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#cash" aria-controls="cash" role="tab" data-toggle="tab">Tunai</a></li>
            <li role="presentation"><a href="#card" aria-controls="card" role="tab" data-toggle="tab">Kartu</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="cash">
              <div class="form-group">
                <label>Pembayaran</label>
                <input id="payment_tx_payment" class="form-control autonumeric num" type="text" name="tx_payment" value="" autofocus onkeyup="calc_change()" onchange="calc_change()">
              </div>
              <div class="form-group">
                <label>Kembali</label>
                <input id="payment_tx_change" class="form-control" type="text" name="" value="" readonly>
              </div>
              <div id="payment_cash_status" class="">

              </div>
              <br>
              <div class="">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                <button type="button" class="btn btn-success pull-right" onclick="payment_cash_action()"><i class="fa fa-check"></i> Ok</button>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="card">
              <div class="form-group">
                <label>Bank</label>
                <select id="payment_card_bank_id" class="form-control keyboard select2" name="">
                  <?php foreach ($bank as $row): ?>
                    <option value="<?=$row->bank_id?>"><?=$row->bank_name?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Nomor Kartu</label>
                <input id="payment_card_bank_card_no" class="form-control num" type="text" name="" value="">
              </div>
              <div class="form-group">
                <label>Nomor Referensi</label>
                <input id="payment_card_bank_reference_no" class="form-control num" type="text" name="" value="">
              </div>
              <div id="payment_card_status" class="">

              </div>
              <div class="">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                <button type="button" class="btn btn-success pull-right" onclick="payment_card_action()"><i class="fa fa-check"></i> Ok</button>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div id="buyget_section">

        </div>
        </div>
      </div>
    </div>
  </div>
</div>