<div id="modal_paket_list" class="modal fade"  role="dialog" aria-labelledby="modal_paket_list">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title_paket_list">Pesanan Paket</h4>
      </div>
      <div class="modal-body">
        <button class="btn btn-info" id="btn_paket"><i class="fa fa-plus"></i> Tambah Paket</button>
        <br><br>
        <table id="tbl_paket_list" class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama Paket</th>
              <th class="text-center">Harga Satuan</th>
              <th class="text-center">Banyak</th>
              <th class="text-center" width="120">Total</th>
              <th class="text-center" width="100">Aksi</th>
            </tr>
          </thead>
          <tbody id="row_paket_list">

          </tbody>
        </table>
        <em>
          <small>
            NB: 
            <?php if ($client->client_is_taxed == 0): ?>
              Harga belum termasuk 
            <?php else: ?>
              Harga sudah termasuk 
            <?php endif;?>
            Pajak karaoke
          </small>
        </em>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>