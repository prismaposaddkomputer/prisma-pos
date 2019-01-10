<script type="text/javascript">
  $(document).ready(function () {

    $(".cb_guest_gender").change(function() {
      $(".cb_guest_gender").prop('checked',false);
      $(this).prop('checked',true);
    });

    $('#name_field').html('Nominal');
    $('#rp_icon').html('Rp');
    $('#prosen_icon').hide();
    //
    <?php
      if($billing != null){if($billing->billing_down_payment_type == '1'){
    ?>
    $('#name_field').html('Nominal');
    $('#rp_icon').html('Rp');
    $('#prosen_icon').hide();
    $('#rp_icon').show();
    <?php
      }else if($billing->billing_down_payment_type == '2'){
    ?>
    $('#name_field').html('Persentase');
    $('#prosen_icon').html('%');
    $('#rp_icon').hide();
    $('#prosen_icon').show();
    <?php
      }}
    ?>
    //
    <?php
      if(@$billing != null){if(@$billing->guest_type == '0'){
    ?>
    $('#tamu_langganan').hide();
    <?php 
      }else if(@$billing->guest_type == '1'){
    ?>
    $('#tamu_baru').hide();
    $('#tamu_langganan').show();
    <?php
      }}
    ?>

    <?php if (@$billing == '') { ?>
    $('#tamu_langganan').hide();
    <?php } ?>
    //
    $('#form input[type=radio]').on('change', function() {
      var billing_down_payment_type = $('input[name=billing_down_payment_type]:checked', '#form').val();
      if (billing_down_payment_type == '1') {
        $('#name_field').html('Nominal');
        $('#rp_icon').html('Rp');
        $('#prosen_icon').hide();
        $('#rp_icon').show();
      }else if (billing_down_payment_type == '2') {
        $('#name_field').html('Persentase');
        $('#prosen_icon').html('%');
        $('#prosen_icon').show();
        $('#rp_icon').hide();
      }

      var guest_type = $('input[name=guest_type]:checked', '#form').val();
      if (guest_type == '0') {

        <?php if (@$billing->guest_type == '1'): ?>
          $('input[name=guest_name]').val('');
          $('input[name=guest_gender]').val('');
          $('input[name=guest_phone]').val('');
          $('select[name=guest_id_type]').val('');
          $('input[name=guest_id_no]').val('');
        <?php endif; ?>

        $('#tamu_baru').show();
        $('#tamu_langganan').hide();
      }else if (guest_type == '1') {

        <?php if (@$billing->guest_type == '0'): ?>
          $('input[name=form_guest_name]').val('');
          $('input[name=form_guest_gender]').val('');
          $('input[name=form_guest_phone]').val('');
          $('input[name=form_guest_id_type]').val('');
          $('input[name=form_guest_id_no]').val('');
        <?php endif; ?>

        $('#tamu_baru').hide();
        $('#tamu_langganan').show();
      }
    });
    
    $("#form").validate({
      rules: {
        'billing_date_in': {
          required: true
        },
        'billing_time_in': {
          required: true
        },
        'billing_date_out': {
          required: true
        },
        'billing_time_out': {
          required: true
        },
        'billing_down_payment': {
          required: true
        },
        'guest_name': {
          required: true
        },
        'billing_charge': {
          required: true,
          number: true
        },
        'form_guest_id': {
          required: true
        }
      },
      messages: {
        'billing_date_in': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_time_in': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_date_out': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_time_out': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_down_payment': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'guest_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'billing_charge': {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        },
        'form_guest_id': {
          required: '<i style="color:red">Wajib dipilih, Tidak boleh Kosong!</i>'
        }
      }
    });

    //
    get_count();
    
    //Kamar
    $('#btn_room_list').click(function () {
      get_billing_room();
      $('#modal_room_list').modal('show');
    });

    $('#btn_room').click(function () {
      $('#room_type_id').val('0').trigger('change');
      get_room(0);
      $('#room_id').val(0).trigger('change');
      $("#room_type_tarif_kamar_1").prop("checked", true);
      $('#room_type_charge').val(0);
      $('#room_type_duration').val(0);
      $('#room_type_total').val(0);
      $('#discount_id_room').val(1).trigger('change');
      $('#modal_room').modal('show');
      $('#modal_room_list').modal('hide');
    });
    
    $('#room_type_id').on('change', function() {
      get_room(this.value);
    });

    $('#room_id').on('change', function() {
      get_validate_room(this.value);
    });

    $('#btn_add_room').click(function () {
      var room_type_duration = $('#room_type_duration').val();
      var room_type_id = $('#room_type_id').val();
      var room_id = $('#room_id').val();
      //
      if (room_type_id == 0) {
        swal({
          text: "Tipe Kamar belum dipilih",
          icon: "warning",
          button: "OK",
        });
      }else if (room_id == 0) {
        swal({
          text: "Kamar belum dipilih",
          icon: "warning",
          button: "OK",
        });
      }else if (room_type_duration == 0) {
        swal({
          text: "Durasi masih kosong",
          icon: "warning",
          button: "OK",
        });
      }else {
        add_room();
      }
    });

    $('#btn_update_room').click(function () {
      var room_type_duration = $('#update_room_type_duration').val();
      var room_type_id = $('#update_room_type_id').val();
      var room_id = $('#update_room_id').val();
      //
      if (room_type_id == 0) {
        swal({
          text: "Tipe Kamar belum dipilih",
          icon: "warning",
          button: "OK",
        });
      }else if (room_id == 0) {
        swal({
          text: "Kamar belum dipilih",
          icon: "warning",
          button: "OK",
        });
      }else if (room_type_duration == 0) {
        swal({
          text: "Durasi masih kosong",
          icon: "warning",
          button: "OK",
        });
      }else {
        update_room();
      }
    });

    //Extra
    $('#btn_extra_list').click(function () {
      get_billing_extra();
      $('#modal_extra_list').modal('show');
    });

    $('#btn_extra').click(function () {
      $('#extra_id').val(0).trigger('change');
      $('#extra_charge').val(0);
      $('#extra_amount').val(0);
      $('#extra_total').val(0);
      $('#modal_extra').modal('show');
      $('#modal_extra_list').modal('hide');
    });

    $('#extra_id').on('change', function() {
      get_extra(this.value);
    });

    $('#btn_add_extra').click(function () {
      var extra_amount = $('#extra_amount').val();
      //
      if (extra_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        add_extra();
      }
    });

     $('#btn_update_extra').click(function () {
      var extra_amount = $('#update_extra_amount').val();
      //
      if (extra_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        update_extra();
      }
    });

    //Custom
    $('#btn_custom_list').click(function () {
      get_billing_custom();
      $('#modal_custom_list').modal('show');
    });

    $('#btn_custom').click(function () {
      $('#custom_id').val(0).trigger('change');
      $('#custom_name').val('');
      $('#custom_charge').val(0);
      $('#custom_amount').val(0);
      $('#custom_total').val(0);
      $('#modal_custom').modal('show');
      $('#modal_custom_list').modal('hide');
    });

    $('#custom_id').on('change', function() {
      get_custom(this.value);
    });

    $('#btn_add_custom').click(function () {
      var custom_amount = $('#custom_amount').val();
      //
      if (custom_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        add_custom();
      }
    });

    $('#btn_update_custom').click(function () {
      var custom_amount = $('#update_custom_amount').val();
      //
      if (custom_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        update_custom();
      }
    });

    // Service
    $('#btn_service_list').click(function () {
      get_billing_service();
      $('#modal_service_list').modal('show');
    });

    $('#btn_service').click(function () {
      $('#service_id').val(0).trigger('change');
      $('#service_charge').val(0);
      $('#service_amount').val(0);
      $('#service_total').val(0);
      $('#modal_service').modal('show');
      $('#modal_service_list').modal('hide');
    });

    // Service
    $('#service_id').on('change', function() {
      get_service(this.value);
    });

    $('#btn_add_service').click(function () {
      var service_amount = $('#service_amount').val();
      //
      if (service_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        add_service();
      }
    });

    $('#btn_update_service').click(function () {
      var service_amount = $('#update_service_amount').val();
      //
      if (service_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        update_service();
      }
    });

    // Paket
    $('#btn_paket_list').click(function () {
      get_billing_paket();
      $('#modal_paket_list').modal('show');
    });

    $('#btn_paket').click(function () {
      $('#paket_id').val(0).trigger('change');
      $('#paket_charge').val(0);
      $('#paket_amount').val(0);
      $('#paket_total').val(0);
      $('#modal_paket').modal('show');
      $('#modal_paket_list').modal('hide');
    });

    // Paket
    $('#paket_id').on('change', function() {
      get_paket(this.value);
    });

    $('#btn_add_paket').click(function () {
      add_paket();
    });

    
    $('#btn_fnb_list').click(function () {
      get_billing_fnb();
      $('#modal_fnb_list').modal('show');
    });

    $('#btn_fnb').click(function () {
      $('#fnb_id').val(0).trigger('change');
      $('#fnb_charge').val(0);
      $('#fnb_amount').val(0);
      $('#fnb_total').val(0);
      $('#modal_fnb').modal('show');
      $('#modal_fnb_list').modal('hide');
    });

    $('#fnb_id').on('change', function() {
      get_fnb(this.value);
    });

    $('#btn_add_fnb').click(function () {
      var fnb_amount = $('#fnb_amount').val();
      //
      if (fnb_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        add_fnb();
      }
    });

    $('#btn_update_fnb').click(function () {
      var fnb_amount = $('#update_fnb_amount').val();
      //
      if (fnb_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        update_fnb();
      }
    });

    $('#btn_non_tax_list').click(function () {
      get_billing_non_tax();
      $('#modal_non_tax_list').modal('show');
    });

    $('#btn_non_tax').click(function () {
      $('#non_tax_id').val(0).trigger('change');
      $('#non_tax_charge').val(0);
      $('#non_tax_amount').val(0);
      $('#non_tax_total').val(0);
      $('#modal_non_tax').modal('show');
      $('#modal_non_tax_list').modal('hide');
    });

    $('#non_tax_id').on('change', function() {
      get_non_tax(this.value);
    });

    $('#btn_add_non_tax').click(function () {
      var non_tax_amount = $('#non_tax_amount').val();
      //
      if (non_tax_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        add_non_tax();
      }
    });

    $('#btn_update_non_tax').click(function () {
      var non_tax_amount = $('#update_non_tax_amount').val();
      //
      if (non_tax_amount == 0) {
        swal({
          text: "Form Banyak minimal harus 1",
          icon: "warning",
          button: "OK",
        });
      }else {
        update_non_tax();
      }
    });

  });

  $('.room_type_tarif_kamar').on('change', function() {
      var value_tarif_kamar = this.value;
      var room_type_id = $('#room_type_id').val();
      //
      if (value_tarif_kamar == '1') {
        $('#label_room_type_charge').text('Harga Per Hari');
        $('#label_room_type_duration').text('Durasi Per Hari');
        $('#group_addon_room_type_duration').html('<b>Hari</b>');
        get_room(room_type_id, value_tarif_kamar);
      }else{
        $('#label_room_type_charge').text('Harga Per Jam');
        $('#label_room_type_duration').text('Durasi Per Jam');
        $('#group_addon_room_type_duration').html('<b>Jam</b>');
        get_room(room_type_id, value_tarif_kamar);
      }
  });

  $('.room_st_denda').on('change', function() {
      var value_st_denda = this.value;
      //
      if (value_st_denda == '1') {
        $("#room_type_denda").attr("readonly", true);
      }else{
        $("#room_type_denda").attr("readonly", false); 
      }
  });

  function get_room(room_type_id, room_type_tarif_kamar='') {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_room',
      data : 'room_type_id='+room_type_id,
      dataType : 'json',
      success : function (data) {
        $("#room_id option").each(function() {
          $(this).remove();
        });
        $("#room_id").select2({
          data: data.room
        }).trigger('change');
        // console.log(data.room_type.room_type_charge);
        if (room_type_tarif_kamar == '1') {
          $('#room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge)));
          //
          calc_room();
        }else if (room_type_tarif_kamar == '2'){
          $('#room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge_hour)));
          //
          calc_room();
        }else if (room_type_tarif_kamar =='') {
          $('#room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge)));
        }
      }
    })
  }

  function get_validate_room(room_id) {
    var billing_date_in = $('#billing_date_in').val();
    //
    $.get('<?=base_url()?>hot_reservation/get_validate_room?room_id='+room_id+'&billing_date_in='+billing_date_in,null,function(data) {
      if(data.result == 'false') {
        swal({
          text: "Kamar ini sudah digunakan ",
          icon: "warning",
          button: "OK",
        });
        $('#room_id').val(0).trigger('change');
      }
    },'json');
  }



  $('#jenis_tamu_langganan').on('change', function() {
    get_member(this.value);
  });

  function get_member(guest_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_tamu_langganan',
      data : 'guest_id='+guest_id,
      dataType : 'json',
      success : function (data) {
        console.log(data.guest.guest_id_no);
        $('#form_guest_name').val(data.guest.guest_name);
        $('#form_guest_gender').val(data.guest.guest_gender);
        $('#form_guest_phone').val(data.guest.guest_phone);
        $('#form_guest_id_type').val(data.guest.guest_id_type);
        $('#form_guest_id_no').val(data.guest.guest_id_no);
        $('#label_guest_id_type').html(data.guest.guest_id_type_name);
      }
    })
  }

  function add_room() {
    var room_id = $('#room_id').val();
    var room_type_charge = $('#room_type_charge').val();
    var room_type_duration = $('#room_type_duration').val();
    var room_type_total = $('#room_type_total').val();
    var discount_id_room = $('#discount_id_room').val();
    var billing_id = $('#billing_id').val();
    var room_type_tarif_kamar = $('input[name=room_type_tarif_kamar]:checked').val();
    var room_type_denda = $('#room_type_denda').val();
    var room_st_denda = $('input[name=room_st_denda]:checked').val();
    var room_keterangan = $('#room_keterangan').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_room',
      data : 'billing_id='+billing_id+'&room_id='+room_id+'&room_type_tarif_kamar='+room_type_tarif_kamar+'&room_type_charge='+room_type_charge+'&room_type_duration='+room_type_duration+'&room_type_total='+room_type_total+'&discount_id_room='+discount_id_room+'&room_keterangan='+room_keterangan+'&room_type_denda='+room_type_denda+'&room_st_denda='+room_st_denda,
      success : function (data) {
        $('#modal_room_list').modal('show');
        $('#modal_room').modal('hide');
        get_billing_room();
      }
    })
  }

  function update_room() {
    var billing_room_id = $('#update_billing_room_id').val();
    var room_type_charge = $('#update_room_type_charge').val();
    var room_type_duration = $('#update_room_type_duration').val();
    var room_type_total = $('#update_room_type_total').val();
    var discount_id_room = $('#update_discount_id_room').val();
    var room_keterangan = $('#update_room_keterangan').val();
    var room_type_tarif_kamar = $('input[name=update_room_type_tarif_kamar]:checked').val();
    var room_type_denda = $('#update_room_type_denda').val();
    var room_st_denda = $('input[name=update_room_st_denda]:checked').val();
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_room',
      data : 'billing_room_id='+billing_room_id+'&billing_id='+billing_id+'&room_id='+room_id+'&room_type_charge='+room_type_charge+
              '&room_type_duration='+room_type_duration+'&room_type_total='+room_type_total+
              '&discount_id_room='+discount_id_room+'&room_keterangan='+room_keterangan+'&room_type_denda='+room_type_denda+'&room_type_tarif_kamar='+room_type_tarif_kamar+'&room_st_denda='+room_st_denda,
      success : function (data) {
        $('#modal_room_list').modal('show');
        $('#modal_room_update').modal('hide');
        get_billing_room();
      }
    })
  }

  function get_billing_room() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_room',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        $("#row_room_list").html('');
        if (data.room == null || data.room == '') {
          var row = '<tr>'+
            '<td class="text-center" colspan="8">Data tidak ada!</td>'+
          '</tr>';
          $("#row_room_list").append(row);
        } else {
          if (data.client_is_taxed == 0) {  
            $.each(data.room, function(i, item) {

              if (item.discount_type == '1') {
                if (item.discount_id == '1') {
                  var discount_amount = sys_to_cur(item.discount_amount);
                }else{
                  var discount_amount = sys_to_prosen(item.discount_amount);
                }
              }else{
                var discount_amount = sys_to_cur(item.discount_amount);
              }

              if (item.room_type_tarif_kamar == '1') {
                var room_type_tarif_kamar = 'Hari';
              }else{
                var room_type_tarif_kamar = 'Jam';
              }
               var room_type_total = parseFloat(item.room_type_total)-(parseFloat(item.room_type_tax)+parseFloat(item.room_type_service)+parseFloat(item.room_type_other));
              var row = '<tr>'+
                // '<td>'+item.room_type_name+'</td>'+
                '<td>'+item.room_name+'</td>'+
                '<td>'+sys_to_cur(Math.round(item.room_type_charge))+'</td>'+
                // '<td class="text-center">'+Math.round(item.room_type_duration)+' '+room_type_tarif_kamar+' </td>'+
                '<td class="text-center">'+item.room_type_duration+' '+room_type_tarif_kamar+' </td>'+
                '<td>'+sys_to_cur(Math.round(item.room_type_subtotal))+'</td>'+
                '<td>'+discount_amount+'</td>'+
                '<td>'+sys_to_cur(item.room_type_denda)+'</td>'+
                '<td>'+sys_to_cur(Math.round(room_type_total))+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_room_show('+item.billing_room_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_room('+item.billing_room_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_room_list").append(row);
            })
          }else{
             $.each(data.room, function(i, item) {

              if (item.discount_type == '1') {
                if (item.discount_id == '1') {
                  var discount_amount = sys_to_cur(item.discount_amount);
                }else{
                  var discount_amount = sys_to_prosen(item.discount_amount);
                }
              }else{
                var discount_amount = sys_to_cur(item.discount_amount);
              }

              if (item.room_type_tarif_kamar == '1') {
                var room_type_tarif_kamar = 'Hari';
              }else{
                var room_type_tarif_kamar = 'Jam';
              }
              var room_type_charge = parseFloat(item.room_type_charge)+((parseFloat(item.room_type_tax)+parseFloat(item.room_type_service)+parseFloat(item.room_type_other))/parseFloat(item.room_type_duration));
              var row = '<tr>'+
                // '<td>'+item.room_type_name+'</td>'+
                '<td>'+item.room_name+'</td>'+
                '<td>'+sys_to_cur(Math.ceil(room_type_charge))+'</td>'+
                // '<td class="text-center">'+Math.ceil(item.room_type_duration)+' '+room_type_tarif_kamar+' </td>'+
                '<td class="text-center">'+item.room_type_duration+' '+room_type_tarif_kamar+' </td>'+
                // '<td>'+sys_to_cur(item.room_type_total/item.room_type_duration)+'</td>'+
                // '<td>'+sys_to_cur(parseFloat(item.room_type_subtotal)+(parseFloat(item.room_type_tax)+parseFloat(item.room_type_service)+parseFloat(item.room_type_other)))+'</td>'+
                '<td>'+sys_to_cur(Math.ceil(item.room_type_before_discount))+'</td>'+
                '<td>'+discount_amount+'</td>'+
                '<td>'+sys_to_cur(item.room_type_denda)+'</td>'+
                '<td>'+sys_to_cur(Math.ceil(item.room_type_total))+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_room_show('+item.billing_room_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_room('+item.billing_room_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_room_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function get_room_update(room_type_id, room_type_tarif_kamar='') {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_room',
      data : 'room_type_id='+room_type_id,
      dataType : 'json',
      success : function (data) {
        // $("#update_room_id option").each(function() {
        //   $(this).remove();
        // });
        // $("#update_room_id").select2({
        //   data: data.room
        // }).trigger('change');
        // console.log(data.room_type.room_type_charge);
        // $('#room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge)));

        if (room_type_tarif_kamar == '1') {
          $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge)));
          //
          calc_room_update();
        }else if (room_type_tarif_kamar == '2'){
          $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge_hour)));
          //
          calc_room_update();
        }else if (room_type_tarif_kamar =='') {
          $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type.room_type_charge)));
        }

      }
    })
  }

  $('.update_room_type_tarif_kamar').on('change', function() {
      var value_tarif_kamar = this.value;
      var update_room_type_id = $('#update_room_type_id').val();
      //
      if (value_tarif_kamar == '1') {
        $('#update_label_room_type_charge').text('Harga Per Hari');
        $('#update_label_room_type_duration').text('Durasi Per Hari');
        $('#update_group_addon_room_type_duration').html('<b>Hari</b>');
        get_room_update(update_room_type_id, value_tarif_kamar);
      }else{
        $('#update_label_room_type_charge').text('Harga Per Jam');
        $('#update_label_room_type_duration').text('Durasi Per Jam');
        $('#update_group_addon_room_type_duration').html('<b>Jam</b>');
        get_room_update(update_room_type_id, value_tarif_kamar);
      }
  });

  $('.update_room_st_denda').on('change', function() {
      var value_st_denda = this.value;
      var billing_id = $('#update_billing_id').val();
      var room_id = $('#update_room_id').val();
      //
      if (value_st_denda == '1') {
        $("#update_room_type_denda").attr("readonly", true);
        get_room_type_denda(billing_id, room_id, value_st_denda); 
      }else{
        $("#update_room_type_denda").attr("readonly", false); 
      }
  });

  function get_room_type_denda(billing_id, room_id, update_room_st_denda) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_room_type_denda',
      data : 'billing_id='+billing_id+'&room_id='+room_id,
      dataType : 'json',
      success : function (data) {

        if (update_room_st_denda == '1') {
          $('#update_room_type_denda').val(sys_to_ind(Math.ceil(data.room_type_denda)));
        }

      }
    })
  }

  function update_room_show(id, update_room_type_tarif_kamar='') {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_room_show',
      dataType : 'json',
      data : 'billing_room_id='+id,
      success : function (data) {
        $("#update_billing_room_id").val(data.billing_room_id);
        $("#update_room_type_id").val(data.room_type_id);
        $("#update_billing_id").val(data.billing_id);
        $("#update_room_id").val(data.room_id);
        $("#update_room_type_name").val(data.room_type_name);
        $("#update_room_name").val(data.room_name);

        if (data.room_type_tarif_kamar == '1') {
          $("#update_room_type_tarif_kamar_1").prop("checked", true);
          $('#update_label_room_type_charge').text('Harga Per Hari');
          $('#update_label_room_type_duration').text('Durasi Per Hari');
          $('#update_group_addon_room_type_duration').html('<b>Hari</b>');
        }else{
          $("#update_room_type_tarif_kamar_2").prop("checked", true);
          $('#update_label_room_type_charge').text('Harga Per Jam');
          $('#update_label_room_type_duration').text('Durasi Per Jam');
          $('#update_group_addon_room_type_duration').html('<b>Jam</b>');
        }

        if (data.room_st_denda == '1') {
          $("#update_room_st_denda_1").prop("checked", true);
          $("#update_room_type_denda").attr("readonly", true);
        }else{
          $("#update_room_st_denda_2").prop("checked", true);
          $("#update_room_type_denda").attr("readonly", false);
        }

        if (data.client_is_taxed == 0) {
          // $('#update_room_type_charge').val(sys_to_ind(data.room_type_charge));

          if (update_room_type_tarif_kamar == '1') {
            $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type_charge)));
            //
            calc_room_update();
          }else if (update_room_type_tarif_kamar == '2'){
            $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type_charge_hour)));
            //
            calc_room_update();
          }else if (update_room_type_tarif_kamar =='') {
            $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type_charge)));
          }

        }else{
          // $('#update_room_type_charge').val(sys_to_ind(data.room_type_total/data.room_type_duration));
          // $('#update_room_type_charge').val(sys_to_ind(data.room_type_before_discount/data.room_type_duration));

          if (update_room_type_tarif_kamar == '1') {
            $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type_before_discount/data.room_type_duration)));
            //
            calc_room_update();
          }else if (update_room_type_tarif_kamar == '2'){
            $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type_before_discount/data.room_type_duration)));
            //
            calc_room_update();
          }else if (update_room_type_tarif_kamar =='') {
            $('#update_room_type_charge').val(sys_to_ind(Math.ceil(data.room_type_before_discount/data.room_type_duration)));
          }
        }
        // $("#update_room_type_duration").val(sys_to_ind(data.room_type_duration));
        $("#update_room_type_duration").val(data.room_type_duration);
        calc_room_update();
        $("#update_discount_id_room").val(data.discount_id).trigger('change');
        $("#update_room_keterangan").val(data.room_keterangan);
        $("#update_room_type_denda").val(sys_to_ind(data.room_type_denda));
        $("#modal_room_list").modal('hide');
        $("#modal_room_update").modal('show');

      }
    })
  }

  function delete_room(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_room',
      data : 'billing_room_id='+id,
      success : function () {
        get_billing_room();
      }
    })
  }

  function get_extra(extra_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_extra',
      data : 'extra_id='+extra_id,
      dataType : 'json',
      success : function (data) {
        $('#extra_charge').val(sys_to_ind(data.extra_charge));
      }
    })
  }

  function calc_extra() {
    var extra_charge = ind_to_sys($('#extra_charge').val());
    var extra_amount = $('#extra_amount').val();
    $('#extra_total').val(sys_to_ind(extra_amount*extra_charge));
  }

  function calc_extra_update() {
    var extra_charge = ind_to_sys($('#update_extra_charge').val());
    var extra_amount = $('#update_extra_amount').val();
    $('#update_extra_total').val(sys_to_ind(extra_amount*extra_charge));
  }

  function calc_room() {
    var room_type_charge = ind_to_sys($('#room_type_charge').val());
    var room_type_duration = $('#room_type_duration').val();
    $('#room_type_total').val(sys_to_ind(room_type_charge*room_type_duration));
  }

  function calc_room_update() {
    var update_room_type_charge = ind_to_sys($('#update_room_type_charge').val());
    var update_room_type_duration = $('#update_room_type_duration').val();
    $('#update_room_type_total').val(sys_to_ind(update_room_type_charge*update_room_type_duration));
  }

  function add_extra() {
    var billing_id = $('#billing_id').val();
    var extra_id = $('#extra_id').val();
    var extra_amount = $('#extra_amount').val();
    var extra_charge = $('#extra_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_extra',
      data : 'billing_id='+billing_id+'&extra_id='+extra_id+'&extra_amount='+extra_amount+
              '&extra_charge='+extra_charge,
      success : function (data) {
        $('#modal_extra_list').modal('show');
        $('#modal_extra').modal('hide');
        get_billing_extra();
      }
    })
  }

  function update_extra() {
    var billing_extra_id = $('#update_billing_extra_id').val();
    var billing_id = $('#billing_id').val();
    var extra_amount = $('#update_extra_amount').val();
    var extra_charge = $('#update_extra_charge').val();
    var extra_total = $('#update_extra_total').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_extra',
      data : 'billing_extra_id='+billing_extra_id+'&billing_id='+billing_id+'&extra_amount='+extra_amount+
              '&extra_charge='+extra_charge+'&extra_total='+extra_total,
      success : function (data) {
        $('#modal_extra_list').modal('show');
        $('#modal_extra_update').modal('hide');
        get_billing_extra();
      }
    })
  }

  function update_extra_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_extra_show',
      dataType : 'json',
      data : 'billing_extra_id='+id,
      success : function (data) {
        $('#update_billing_extra_id').val(data.billing_extra_id);
        $('#update_extra_name').val(data.extra_name);
        if (data.client_is_taxed == 0) {
          $('#update_extra_charge').val(sys_to_ind(data.extra_charge));
        }else{
          $('#update_extra_charge').val(sys_to_ind(data.extra_total/data.extra_amount));
        }
        $('#update_extra_amount').val(sys_to_ind(data.extra_amount));
        calc_extra_update();
        $('#modal_extra_list').modal('hide');
        $('#modal_extra_update').modal('show');
        get_billing_extra();
      }
    })
  }

  function get_billing_extra() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_extra',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.extra == null || data.extra == '') {
          $("#row_extra_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_extra_list").append(row);
        } else {
          $("#row_extra_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.extra, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.extra_name+'</td>'+
                '<td>'+sys_to_cur(item.extra_charge)+'</td>'+
                '<td class="text-center">'+Math.round(item.extra_amount)+'</td>'+
                '<td>'+sys_to_cur(item.extra_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_extra_show('+item.billing_extra_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_extra('+item.billing_extra_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_extra_list").append(row);
            })
          }else{
            $.each(data.extra, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.extra_name+'</td>'+
                '<td>'+sys_to_cur(item.extra_total/item.extra_amount)+'</td>'+
                '<td class="text-center">'+Math.round(item.extra_amount)+'</td>'+
                '<td>'+sys_to_cur(item.extra_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_extra_show('+item.billing_extra_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_extra('+item.billing_extra_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_extra_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_extra(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_extra',
      data : 'billing_extra_id='+id,
      success : function () {
        get_billing_extra();
      }
    })
  }

  function get_custom(custom_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_custom',
      data : 'custom_id='+custom_id,
      dataType : 'json',
      success : function (data) {
        $('#custom_charge').val(sys_to_ind(data.custom_charge));
      }
    })
  }

  function calc_custom() {
    var custom_charge = ind_to_sys($('#custom_charge').val());
    var custom_amount = $('#custom_amount').val();
    $('#custom_total').val(sys_to_ind(custom_amount*custom_charge));
  }

  function calc_custom_update() {
    var custom_charge = ind_to_sys($('#update_custom_charge').val());
    var custom_amount = $('#update_custom_amount').val();
    $('#update_custom_total').val(sys_to_ind(custom_amount*custom_charge));
  }

  function add_custom() {
    var billing_id = $('#billing_id').val();
    var custom_id = $('#custom_id').val();
    var custom_amount = $('#custom_amount').val();
    var custom_charge = $('#custom_charge').val();
    var custom_name = $('#custom_name').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_custom',
      data : 'billing_id='+billing_id+'&custom_id='+custom_id+'&custom_amount='+custom_amount+
              '&custom_charge='+custom_charge+'&custom_name='+custom_name,
      success : function (data) {
        $('#modal_custom_list').modal('show');
        $('#modal_custom').modal('hide');
        get_billing_custom();
      }
    })
  }

  function update_custom() {
    var billing_custom_id = $('#update_billing_custom_id').val();
    var custome_name = $('#update_custome_name').val();
    var billing_id = $('#billing_id').val();
    var custom_charge = $('#update_custom_charge').val();
    var custom_amount = $('#update_custom_amount').val();
    var custom_total = $('#update_custom_total').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_custom',
      data : 'billing_custom_id='+billing_custom_id+'&custome_name='+custome_name+'&billing_id='+billing_id+'&custom_amount='+custom_amount+
              '&custom_charge='+custom_charge+'&custom_total='+custom_total,
      success : function (data) {
        $('#modal_custom_list').modal('show');
        $('#modal_custom_update').modal('hide');
        get_billing_custom();
      }
    })
  }

  function update_custom_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_custom_show',
      dataType : 'json',
      data : 'billing_custom_id='+id,
      success : function (data) {
        $('#update_billing_custom_id').val(data.billing_custom_id);
        $('#update_custom_name').val(data.custom_name);
        $('#update_custom_charge').val(sys_to_ind(data.custom_charge));
        // if (data.client_is_taxed == 0) {
        //   $('#update_custom_charge').val(sys_to_ind(data.custom_charge));
        // }else{
        //   $('#update_custom_charge').val(sys_to_ind(data.custom_total/data.custom_amount));
        // }
        $('#update_custom_amount').val(sys_to_ind(data.custom_amount));
        // $('#update_custom_total').val(sys_to_ind(data.custom_total));
        calc_custom_update();
        $('#modal_custom_list').modal('hide');
        $('#modal_custom_update').modal('show');
        get_billing_custom();
      }
    })
  }

  function get_billing_custom() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_custom',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.custom == null || data.custom == '') {
          $("#row_custom_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_custom_list").append(row);
        } else {
          $("#row_custom_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.custom, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.custom_name+'</td>'+
                '<td>'+sys_to_cur(item.custom_charge)+'</td>'+
                '<td class="text-center">'+Math.round(item.custom_amount)+'</td>'+
                '<td>'+sys_to_cur(item.custom_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_custom_show('+item.billing_custom_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_custom('+item.billing_custom_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_custom_list").append(row);
            })
          }else{
            $.each(data.custom, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.custom_name+'</td>'+
                '<td>'+sys_to_cur(item.custom_total/item.custom_amount)+'</td>'+
                '<td class="text-center">'+Math.round(item.custom_amount)+'</td>'+
                '<td>'+sys_to_cur(item.custom_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_custom_show('+item.billing_custom_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_custom('+item.billing_custom_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_custom_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_custom(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_custom',
      data : 'billing_custom_id='+id,
      success : function () {
        get_billing_custom();
      }
    })
  }

  function get_service(service_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_service',
      data : 'service_id='+service_id,
      dataType : 'json',
      success : function (data) {
        $('#service_charge').val(sys_to_ind(data.service_charge));
      }
    })
  }

  function calc_service() {
    var service_charge = ind_to_sys($('#service_charge').val());
    var service_amount = $('#service_amount').val();
    $('#service_total').val(sys_to_ind(service_amount*service_charge));
  }

  function calc_service_update() {
    var service_charge = ind_to_sys($('#update_service_charge').val());
    var service_amount = $('#update_service_amount').val();
    $('#update_service_total').val(sys_to_ind(service_amount*service_charge));
  }

  function add_service() {
    var billing_id = $('#billing_id').val();
    var service_id = $('#service_id').val();
    var service_amount = $('#service_amount').val();
    var service_charge = $('#service_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_service',
      data : 'billing_id='+billing_id+'&service_id='+service_id+'&service_amount='+service_amount+
              '&service_charge='+service_charge,
      success : function (data) {
        $('#modal_service_list').modal('show');
        $('#modal_service').modal('hide');
        get_billing_service();
      }
    })
  }

  function update_service() {
    var billing_service_id = $('#update_billing_service_id').val();
    var billing_id = $('#billing_id').val();
    var service_amount = $('#update_service_amount').val();
    var service_charge = $('#update_service_charge').val();
    var service_total = $('#update_service_total').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_service',
      data : 'billing_service_id='+billing_service_id+'&billing_id='+billing_id+'&service_amount='+service_amount+
              '&service_charge='+service_charge+'&service_total='+service_total,
      success : function (data) {
        $('#modal_service_list').modal('show');
        $('#modal_service_update').modal('hide');
        get_billing_service();
      }
    })
  }

  function get_billing_service() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_service',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.service == null || data.service == '') {
          $("#row_service_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_service_list").append(row);
        } else {
          $("#row_service_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.service, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.service_name+'</td>'+
                '<td>'+sys_to_cur(item.service_charge)+'</td>'+
                '<td class="text-center">'+Math.round(item.service_amount)+'</td>'+
                '<td>'+sys_to_cur(item.service_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_service_show('+item.billing_service_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_service('+item.billing_service_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_service_list").append(row);
            })
          }else{
            $.each(data.service, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.service_name+'</td>'+
                '<td>'+sys_to_cur(item.service_total/item.service_amount)+'</td>'+
                '<td class="text-center">'+Math.round(item.service_amount)+'</td>'+
                '<td>'+sys_to_cur(item.service_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_service_show('+item.billing_service_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_service('+item.billing_service_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_service_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_service(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_service',
      data : 'billing_service_id='+id,
      success : function () {
        get_billing_service();
      }
    })
  }

  function update_service_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_service_show',
      dataType : 'json',
      data : 'billing_service_id='+id,
      success : function (data) {
        $('#update_billing_service_id').val(data.billing_service_id);
        $('#update_service_name').val(data.service_name);
        if (data.client_is_taxed == 0) {
          $('#update_service_charge').val(sys_to_ind(data.service_charge));
        }else{
          $('#update_service_charge').val(sys_to_ind(data.service_total/data.service_amount));
        }
        $('#update_service_amount').val(sys_to_ind(data.service_amount));
        calc_service_update();
        $('#modal_service_list').modal('hide');
        $('#modal_service_update').modal('show');
        get_billing_service();
      }
    })
  }

  function get_paket(paket_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_paket',
      data : 'paket_id='+paket_id,
      dataType : 'json',
      success : function (data) {
        $('#paket_charge').val(sys_to_ind(data.paket_charge));
      }
    })
  }

  function calc_paket() {
    var paket_charge = ind_to_sys($('#paket_charge').val());
    var paket_amount = $('#paket_amount').val();
    $('#paket_total').val(sys_to_ind(paket_amount*paket_charge));
  }

  function add_paket() {
    var billing_id = $('#billing_id').val();
    var paket_id = $('#paket_id').val();
    var paket_amount = $('#paket_amount').val();
    var paket_charge = $('#paket_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_paket',
      data : 'billing_id='+billing_id+'&paket_id='+paket_id+'&paket_amount='+paket_amount+
              '&paket_charge='+paket_charge,
      success : function (data) {
        $('#modal_paket_list').modal('show');
        $('#modal_paket').modal('hide');
        get_billing_paket();
      }
    })
  }

  function get_billing_paket() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_paket',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.paket == null || data.paket == '') {
          $("#row_paket_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_paket_list").append(row);
        } else {
          $("#row_paket_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.paket, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.paket_name+'</td>'+
                '<td>'+sys_to_cur(item.paket_charge)+'</td>'+
                '<td class="text-center">'+Math.round(item.paket_amount)+'</td>'+
                '<td>'+sys_to_cur(item.paket_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-danger" onclick="delete_paket('+item.billing_paket_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_paket_list").append(row);
            })
          }else{
            $.each(data.paket, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.paket_name+'</td>'+
                '<td>'+sys_to_cur(item.paket_total/item.paket_amount)+'</td>'+
                '<td class="text-center">'+Math.round(item.paket_amount)+'</td>'+
                '<td>'+sys_to_cur(item.paket_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-danger" onclick="delete_paket('+item.billing_paket_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_paket_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_paket(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_paket',
      data : 'billing_paket_id='+id,
      success : function () {
        get_billing_paket();
      }
    })
  }






  function get_fnb(fnb_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_fnb',
      data : 'fnb_id='+fnb_id,
      dataType : 'json',
      success : function (data) {
        $('#fnb_charge').val(sys_to_ind(data.fnb_charge));
      }
    })
  }

  function calc_fnb() {
    var fnb_charge = ind_to_sys($('#fnb_charge').val());
    var fnb_amount = $('#fnb_amount').val();
    $('#fnb_total').val(sys_to_ind(fnb_amount*fnb_charge));
  }

  function calc_fnb_update() {
    var fnb_charge = ind_to_sys($('#update_fnb_charge').val());
    var fnb_amount = $('#update_fnb_amount').val();
    $('#update_fnb_total').val(sys_to_ind(fnb_amount*fnb_charge));
  }

  function add_fnb() {
    var billing_id = $('#billing_id').val();
    var fnb_id = $('#fnb_id').val();
    var fnb_amount = $('#fnb_amount').val();
    var fnb_charge = $('#fnb_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_fnb',
      data : 'billing_id='+billing_id+'&fnb_id='+fnb_id+'&fnb_amount='+fnb_amount+
              '&fnb_charge='+fnb_charge,
      success : function (data) {
        $('#modal_fnb_list').modal('show');
        $('#modal_fnb').modal('hide');
        get_billing_fnb();
      }
    })
  }

  function update_fnb() {
    var billing_fnb_id = $('#update_billing_fnb_id').val();
    var billing_id = $('#billing_id').val();
    var fnb_amount = $('#update_fnb_amount').val();
    var fnb_charge = $('#update_fnb_charge').val();
    var fnb_total = $('#update_fnb_total').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_fnb',
      data : 'billing_fnb_id='+billing_fnb_id+'&billing_id='+billing_id+'&fnb_amount='+fnb_amount+
              '&fnb_charge='+fnb_charge+'&fnb_total='+fnb_total,
      success : function (data) {
        $('#modal_fnb_list').modal('show');
        $('#modal_fnb_update').modal('hide');
        get_billing_fnb();
      }
    })
  }

  function update_fnb_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_fnb_show',
      dataType : 'json',
      data : 'billing_fnb_id='+id,
      success : function (data) {
        $('#update_billing_fnb_id').val(data.billing_fnb_id);
        $('#update_fnb_name').val(data.fnb_name);
        if (data.client_is_taxed == 0) {
          $('#update_fnb_charge').val(sys_to_ind(data.fnb_charge));
        }else{
          $('#update_fnb_charge').val(sys_to_ind(data.fnb_total/data.fnb_amount));
        }
        $('#update_fnb_amount').val(sys_to_ind(data.fnb_amount));
        calc_fnb_update();
        $('#modal_fnb_list').modal('hide');
        $('#modal_fnb_update').modal('show');
        get_billing_fnb();
      }
    })
  }

  function get_billing_fnb() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_fnb',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.fnb == null || data.fnb == '') {
          $("#row_fnb_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_fnb_list").append(row);
        } else {
          $("#row_fnb_list").html('');
          if (data.client_is_taxed == 0) {
            $.each(data.fnb, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.fnb_name+'</td>'+
                '<td>'+sys_to_cur(item.fnb_charge)+'</td>'+
                '<td class="text-center">'+Math.round(item.fnb_amount)+'</td>'+
                '<td>'+sys_to_cur(item.fnb_subtotal)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_fnb_show('+item.billing_fnb_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_fnb('+item.billing_fnb_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_fnb_list").append(row);
            })
          }else{
            $.each(data.fnb, function(i, item) {
              var row = '<tr>'+
                '<td>'+item.fnb_name+'</td>'+
                '<td>'+sys_to_cur(item.fnb_total/item.fnb_amount)+'</td>'+
                '<td class="text-center">'+Math.round(item.fnb_amount)+'</td>'+
                '<td>'+sys_to_cur(item.fnb_total)+'</td>'+
                '<td class="text-center">'+
                  '<button class="btn btn-sm btn-warning" onclick="update_fnb_show('+item.billing_fnb_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                  '<button class="btn btn-sm btn-danger" onclick="delete_fnb('+item.billing_fnb_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
                '</td>'+
              '</tr>';
              $("#row_fnb_list").append(row);
            })
          }
        }
        get_count();
      }
    })
  }

  function delete_fnb(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_fnb',
      data : 'billing_fnb_id='+id,
      success : function () {
        get_billing_fnb();
      }
    })
  }

  function get_non_tax(non_tax_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_non_tax',
      data : 'non_tax_id='+non_tax_id,
      dataType : 'json',
      success : function (data) {
        $('#non_tax_charge').val(sys_to_ind(data.non_tax_charge));
      }
    })
  }

  function calc_non_tax() {
    var non_tax_charge = ind_to_sys($('#non_tax_charge').val());
    var non_tax_amount = $('#non_tax_amount').val();
    $('#non_tax_total').val(sys_to_ind(non_tax_amount*non_tax_charge));
  }

  function calc_non_tax_update() {
    var non_tax_charge = ind_to_sys($('#update_non_tax_charge').val());
    var non_tax_amount = $('#update_non_tax_amount').val();
    $('#update_non_tax_total').val(sys_to_ind(non_tax_amount*non_tax_charge));
  }

  function add_non_tax() {
    var billing_id = $('#billing_id').val();
    var non_tax_id = $('#non_tax_id').val();
    var non_tax_amount = $('#non_tax_amount').val();
    var non_tax_charge = $('#non_tax_charge').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/add_non_tax',
      data : 'billing_id='+billing_id+'&non_tax_id='+non_tax_id+'&non_tax_amount='+non_tax_amount+
              '&non_tax_charge='+non_tax_charge,
      success : function (data) {
        $('#modal_non_tax_list').modal('show');
        $('#modal_non_tax').modal('hide');
        get_billing_non_tax();
      }
    })
  }

  function update_non_tax() {
    var billing_non_tax_id = $('#update_billing_non_tax_id').val();
    var billing_id = $('#billing_id').val();
    var non_tax_amount = $('#update_non_tax_amount').val();
    var non_tax_charge = $('#update_non_tax_charge').val();
    var non_tax_total = $('#update_non_tax_total').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_non_tax',
      data : 'billing_non_tax_id='+billing_non_tax_id+'&billing_id='+billing_id+'&non_tax_amount='+non_tax_amount+
              '&non_tax_charge='+non_tax_charge+'&non_tax_total='+non_tax_total,
      success : function (data) {
        $('#modal_non_tax_list').modal('show');
        $('#modal_non_tax_update').modal('hide');
        get_billing_non_tax();
      }
    })
  }

  function update_non_tax_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/update_non_tax_show',
      dataType : 'json',
      data : 'billing_non_tax_id='+id,
      success : function (data) {
        $('#update_billing_non_tax_id').val(data.billing_non_tax_id);
        $('#update_non_tax_name').val(data.non_tax_name);
        $('#update_non_tax_charge').val(sys_to_ind(data.non_tax_charge));
        $('#update_non_tax_amount').val(sys_to_ind(data.non_tax_amount));
        // $('#update_non_tax_total').val(sys_to_ind(data.non_tax_total));
        calc_non_tax_update();
        $('#modal_non_tax_list').modal('hide');
        $('#modal_non_tax_update').modal('show');
        get_billing_non_tax();
      }
    })
  }

  function get_billing_non_tax() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_billing_non_tax',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        if (data.non_tax == null || data.non_tax == '') {
          $("#row_non_tax_list").html('');
          var row = '<tr>'+
            '<td class="text-center" colspan="5">Data tidak ada!</td>'+
          '</tr>';
          $("#row_non_tax_list").append(row);
        } else {
          $("#row_non_tax_list").html('');
          $.each(data.non_tax, function(i, item) {
            var row = '<tr>'+
              '<td>'+item.non_tax_name+'</td>'+
              '<td>'+sys_to_cur(item.non_tax_total/item.non_tax_amount)+'</td>'+
              '<td class="text-center">'+Math.round(item.non_tax_amount)+'</td>'+
              '<td>'+sys_to_cur(item.non_tax_total)+'</td>'+
              '<td class="text-center">'+
                '<button class="btn btn-sm btn-warning" onclick="update_non_tax_show('+item.billing_non_tax_id+')"><i class="fa fa-pencil fa-lg"></i></button> '+
                '<button class="btn btn-sm btn-danger" onclick="delete_non_tax('+item.billing_non_tax_id+')"><i class="fa fa-trash fa-lg"></i></button>'+
              '</td>'+
            '</tr>';
            $("#row_non_tax_list").append(row);
          })
        }
        get_count();
      }
    })
  }

  function delete_non_tax(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/delete_non_tax',
      data : 'billing_non_tax_id='+id,
      success : function () {
        get_billing_non_tax();
      }
    })
  }

  function get_count() {
    var billing_id = $('#billing_id').val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>hot_reservation/get_count',
      data : 'billing_id='+billing_id,
      dataType : 'json',
      success : function (data) {
        $('#lbl_count_room').html(data.count_room);
        $('#lbl_count_extra').html(data.count_extra);
        $('#lbl_count_service').html(data.count_service);
        $('#lbl_count_paket').html(data.count_paket);
        $('#lbl_count_fnb').html(data.count_fnb);
        $('#lbl_count_non_tax').html(data.count_non_tax);
        $('#lbl_count_custom').html(data.count_custom);
      }
    })
  }

  <?php if ($id !=''): ?>
  var value_dp_php = <?=($billing->billing_down_payment !=0) ? num_to_price($billing->billing_down_payment) : '0' ?>;
  if (value_dp_php !='') {
    $("#cetak_struk_dp").removeClass("hidden");
  }
  <?php endif ?>

  $('#billing_down_payment').on('change', function() {
    var value_dp = this.value;
    //
    if (value_dp !=0) {
      $("#cetak_struk_dp").removeClass("hidden");
    }else{
      $("#cetak_struk_dp").addClass("hidden");
    }
  });
</script>