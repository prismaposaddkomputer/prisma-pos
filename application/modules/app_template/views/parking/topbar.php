<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
        <i class="fa fa-bars"></i>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <div class="btn-group pull-right" role="group">
        <button type="button" class="btn btn-danger navbar-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-power-off"></i> Power
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="<?=base_url()?>app_system/shutdown"><i class="fa fa-circle-o"></i> Shutdown</a></li>
          <li><a href="<?=base_url()?>app_system/shutdown"><i class="fa fa-refresh"></i> Restart</a></li>
          <li><a href="<?=base_url()?>app_auth/logout/logout_action"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
