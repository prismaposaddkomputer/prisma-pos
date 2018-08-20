<div id="login-container" class="col-md-4 col-md-offset-4">
  <form id="form" class="" action="<?=base_url()?>app_auth/login/action" method="post">
    <div class="panel panel-default">
      <div class="panel-heading text-center">MASUK UNTUK MENGAKSES</div>
      <div class="panel-body">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input class="form-control keyboard" type="text" name="user_name" value="superhotel" placeholder="Nama Pengguna" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input class="form-control keyboard" type="password" name="user_password" value="admin" placeholder="Kata Sandi" required>
          </div>
        </div>
        <div class="form-group">
          <button id="btn_action" class="btn btn-info btn-block" type="submit" name="button">Masuk</button>
          <button id="btn_progress" class="btn btn-info btn-block disabled" type="button"><i class="fa fa-spinner fa-spin"></i> Proses...</button>
        </div>
        <?php echo $this->session->flashdata('status'); ?>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#btn_action").show();
    $("#btn_progress").hide();

    $("#form").validate({
      rules: {
        'user_name': {
          required: true
        },
        'user_password': {
          required: true
        }
      },
      messages: {
        'user_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'user_password': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      },
      submitHandler: function(form) {
        $("#btn_action").hide();
        $("#btn_progress").show();
        form.submit();
      }
    });
  })
</script>
