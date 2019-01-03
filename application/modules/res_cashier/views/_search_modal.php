<div id="modal_search" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pencarian Barang</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Berdasarkan</label>
              <select id="search_type" class="form-control" name="search_type">
                <option value="item_name">Nama</option>
                <option value="item_barcode">Barcode</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Pencarian</label>
              <input id="search_name" class="form-control keyboard" type="text" name="search_name" value="">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>&nbsp;</label>
              <button class="btn btn-info" type="button" name="button" onclick="action_search()"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
        <table id="search_table" class="table table-bordered table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th>Barcode</th>
              <th>Nama Item</th>
              <th>Kategori</th>
              <th>Harga</th>
            </tr>
          </thead>
          <tbody id="search_row">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="cancel_btn_action" type="button" class="btn btn-info" onclick="cancel_action()"><i class="fa fa-check"></i> Ya</button>
      </div>
    </div>
  </div>
</div>