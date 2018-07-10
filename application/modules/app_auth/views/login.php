<div id="login-container" class="col-md-4 col-md-offset-4">
  <form class="" action="<?=base_url()?>app_auth/login/action" method="post">
    <div class="panel panel-default">
      <div class="panel-heading text-center">MASUK UNTUK MENGAKSES</div>
      <div class="panel-body">
        <form action="<?=base_url()?>auth/login/login_action" method="post">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input class="form-control" type="text" name="user_name" value="" placeholder="Nama Pengguna" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input class="form-control" type="password" name="user_password" value="" placeholder="Kata Sandi" required>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-info btn-block" type="submit" name="button">Masuk</button>
          </div>
          <?php echo $this->session->flashdata('status'); ?>
        </form>
      </div>
    </div>
  </form>
</div>
