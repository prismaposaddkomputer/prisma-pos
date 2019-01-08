<div id="modal_hold" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">Billing Tertahan</div>
      <div class="modal-body">
        <div class="input-group">
          <input type="text" nama="search_pending" id="search_pending" class="form-control keyboard" placeholder="Cari berdasar no struk atau nama..." onchange="search_pending_action()">
          <span class="input-group-btn">
            <button id="btn_search_pending" class="btn btn-info" type="button" onclick="search_pending_action()"><i class="fa fa-search"></i> Cari</button>
          </span>
        </div>
        <br>
        <div style="height:400px !important; overflow-y: scroll;overflow-x: hidden;">
          <table class="table table-condensed table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">No. Struk</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Jam</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody id="hold_list">

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
      </div>
    </div>
  </div>
</div>