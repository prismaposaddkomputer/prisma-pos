<script>
  function open_search() {
    $("#modal_search").modal('show');
  }

  function action_search() {
    var search_type = $("#search_type").val();
    var search_name = $("#search_name").val();

    if (search_name != '') {
      $.ajax({
        type: 'post',
        url : '<?=base_url()?>res_cashier/search_action',
        data : 'search_type='+search_type+'&search_name='+search_name,
        dataType : 'json',
        success : function (data) {
          console.log(data);
          $("#search_row").html('');
          $.each(data, function(i, item) {
            var row;
            row = '<tr onclick="add_item_show('+item.item_id+')" style="cursor:pointer">'+
            '<td class="lbl-barcode">'+item.item_barcode+'</td>'+
            '<td class="lbl-item_name">'+item.item_name+'</td>'+
            '<td class="lbl-category_name">'+item.category_name+'</td>'+
            '<td class="lbl-item_price_after_tax text-right">'+sys_to_ind(item.item_price_after_tax)+'</td>'+
            '</tr>';
            $("#search_row").append(row);
          })
        }
      });
    }
  }
</script>