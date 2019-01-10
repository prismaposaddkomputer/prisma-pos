<?php
	function digit($inp = 0)
	{
	    return number_format($inp, 0, ',', '.');
	}
?>
<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-4">
      <a class="btn btn-default" href="<?=base_url()?>kar_reservation/index"><i class="fa fa-list"></i></a>
    </div>
  </div>
  <br>
  <div class="row" id="room_all">
    
  </div>
</div>
<style>
  .panel-danger .panel-heading{
    background-color:red;
  }
</style>
<script>
  $(document).ready(function () {
    //append room all
    room_all();
    //get room interval
    setInterval(function () {
      room_all();
    }, 1000);
  });

  function room_all() {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>kar_reservation/room_all',
      dataType : 'json',
      success : function (data) {
        $("#room_all").html('');
        $.each(data, function(i, item) {
          var color,status;
          switch (item.billing_status) {
            case null:
              color = 'success';
              status = 'Tersedia';
              break;
          
            case '1':
              color = 'danger';
              status = 'Sedang Dipakai';
              break;
          }
          if (parseFloat(item.sisa_detik) < 0) {
            color = 'info';
            item.guest_name = null;
            item.created = null;
            item.room_type_duration = null;
            status = 'Tersedia';
            item.sisa = null;
          }
          var row;
          row = '<div class="col-md-3">'+
            '<div class="panel panel-'+color+'">'+
              '<div class="panel-heading">'+
                '<h5 class="panel-title">'+item.room_name+'</h5>'+
              '</div>'+
              '<div class="panel-body">'+
                '<dl>'+
                  '<dt>Tamu</dt>'+
                  '<dd>'+item.guest_name+'</dd>'+
                  '<dt>Waktu Pesan</dt>'+
                  '<dd>'+item.created+'</dd>'+
                  '<dt>Durasi</dt>'+
                  '<dd>'+item.room_type_duration+'</dd>'+
                  '<dt>Status</dt>'+
                  '<dd>'+status+'</dd>'+
                  '<dt>Sisa Waktu</dt>'+
                  '<dd><h4 style="color:blue">'+item.sisa+'</h4></dd>'+
                '</dl>'+
              '</div>'+
              '<div class="panel-footer">'+
                // '<a class="btn btn-sm btn-'+color+' btn-block" href="<?=base_url()?>kar_reservation/form2/'+item.room_id+'"><i class="fa fa-plus"></i> Baru</a>'
              '</div>'+
            '</div>'+
          '</div>';
          $("#room_all").append(row);
        })
      }
    })  
  }
</script>