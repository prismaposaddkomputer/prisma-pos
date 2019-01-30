<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
        <i class="fa fa-bars"></i>
      </button>
      <span class="label " id="status_info"></span>
      <span class="label label-info">Call Center : 0812-1001-634 (Telp/SMS/WA)</span>
    </div>
    <button type="button" class="btn btn-danger navbar-btn pull-right" data-toggle="modal" data-target=".modal-power"><i class="fa fa-power-off"></i></button>
  </div>
</nav>
<div class="modal fade modal-power" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Prisma Point of Sales</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <a class="btn btn-danger btn-block" href="<?=base_url()?>app_system/shutdown"><i class="fa fa-circle-o"></i> Shutdown</a>
          </div>
          <div class="col-md-4">
            <a class="btn btn-success btn-block" href="<?=base_url()?>app_system/restart"><i class="fa fa-refresh"></i> Restart</a>
          </div>
          <div class="col-md-4">
            <a class="btn btn-default btn-block" href="<?=base_url()?>app_auth/logout/logout_action"><i class="fa fa-sign-out"></i> Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
