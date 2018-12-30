<div id="modal_custom_list" class="modal fade"  role="dialog" aria-labelledby="modal_custom_list">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_custom_list">Pesanan Kustom</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_custom"><i class="fa fa-plus"></i> Tambah Kustom</button>
        <br><br>
        <table id="tbl_custom_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama Kustom</th>
              <th class="text-center">Harga Satuan</th>
              <th class="text-center">Banyak</th>
              <th class="text-center" width="120">Total</th>
              <th class="text-center" width="100">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_custom_list">

          </tbody>
        </table>
        <em>
          <small>
            NB: 
            Harga tidak dikenakan Pajak Karaoke
          </small>
        </em>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>