<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_booking extends MY_Karaoke {

  var $access, $booking_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_booking'){
      $this->session->set_userdata(array('menu' => 'kar_booking'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_booking';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_booking');
    $this->load->model('m_kar_room');
  }

  public function getGuest(){
      $q = $this->input->get('q');
      $s = $this->m_kar_booking->cari_tamu($q);
      $array = array();
      foreach($s as $row){
        $array[] = array(
          'id'=>$row->id,
          'text'=>$row->full_name
        );
      }
      echo json_encode($array);
  }
  
	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Pemesanan Kamar';
      $data['guest'] = $this->m_kar_booking->get_all_tamu();
      $data['room'] = $this->m_kar_booking->get_room();
      $data['tipe'] = $this->m_kar_booking->get_tipe();
      $data['payment'] = $this->m_kar_booking->get_payment();


      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'kar_booking/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_kar_booking->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['booking'] = $this->m_kar_booking->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_kar_booking->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['booking'] = $this->m_kar_booking->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('kar_booking/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'kar_booking/index');
  }

  function ajax($id = null) {
		if($id == 'get_image') {
        	$config = $this->config_model->get_config();
        	//
        	$product_id  = $this->input->get('product_id');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($product_id != '' && $product_id != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_product($product_id);
        		$html = '';
        		$image_no = 1;
        		foreach($arr_image as $row) {
        			$html.= '<tr id="tr_image_'.$row['image_id'].'">
								<td valign="top" colspan="3">
									<table width="100%" class="table-no-border">
									<tr>
										<td valign="top">
											<div class="form-group">
												<label>Gambar '.$image_no.'</label>
												<div>
													<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image"><img class="img-thumbnail img-edit-product" src="'.base_url().$row['image_path'].$row['image_name'].'" style="border: 2px dotted blue;"></a>
													<div>
														<a class="btn btn-sm btn-primary btn-edit-product-img" href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank"><i class="fa fa-eye"></i> Lihat Gambar</a>
														<a href="javascript:void(0)" class="remove_image btn btn-sm btn-danger btn-edit-product-img" data-id="'.$row['image_id'].'"><i class="fa fa-times"></i> Hapus Gambar</a>
													</div>
												</div>
												<input type="file" class="form-control" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'">
												<span class="alert-product">* Isikan kolom diatas jika ingin mengganti Gambar</span>
												<input type="hidden" name="image_pos_'.$image_no.'" value="2">
												<input type="hidden" name="image_id_'.$image_no.'" value="'.$row['image_id'].'">
											</div>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<script>
							$(function() {
								var id = "image_source_'.$image_no.'";
								$("#"+id).bind("change",function() {
									var size = this.files[0].size;
									validate_image_size(size,"#"+id);
								});
							});
							</script>';
					$image_no++;
        		}        		
        		$image_no = $image_no-1;
        		//
        		$html.= '<script>
        					$(function() {
        						$(".remove_image").bind("click",function() {
        							$(this).each(function() {
        								var i = $(this).attr("data-id");
        								if(confirm("Apakah anda yakin akan menghapus gambar ini ?")) {
        									$.get("'.site_url("selling/delete_image").'/"+i,null,function(data) {
	        									if(data.result == "true") {
	        										//location.reload(true);
	        										$("#tr_image_"+i).remove();
	        									}
	        								},"json");
        								}        								
        							});
        						});
        					});
        				</script>';
        	} else {
        		$html = '<tr>
							<td valign="top" colspan="3">
								<div class="form-group" style="margin-bottom:-10px!important">
									<label>Gambar '.$image_no.'</label>';
							if($image_no == '1'){
				$html .='			<label style="color:red;" class="pull-right">*Gambar '.$image_no.' akan dijadikan Utama</label>';
								}
				$html .='			<input type="file" class="form-control" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'"><br>
									<input type="hidden" name="image_pos_'.$image_no.'" value="2">
								</div>
							</td>
						</tr>
						<script>
						$(function() {
							var id = "image_source_'.$image_no.'";
							$("#"+id).bind("change",function() {
								var size = this.files[0].size;
								validate_image_size(size,"#"+id);
							});
						});
						</script>
						';
        	}
        	//
			echo json_encode(array(
				'html' 		=> $html,
				'image_no' 	=> $image_no,
			));
        }else if($id == 'permalink') {
			$product_nm = $this->input->get('product_nm');
			$permalink = clean_url($product_nm);
			//
			echo json_encode(array(
				'permalink'	=> $permalink
			));
		}
  }
  
  public function form($id = null)
  {
    $data['access'] = $this->access;
    $data['guest'] = $this->m_kar_booking->get_all_tamu();
    
    $data['service'] = $this->m_kar_booking->get_all_service();
    if ($id == null) {
      if ($this->access->_create == 1) {
        
        $data['title'] = 'Tambah Pemesanan Kamar';
        $data['action'] = 'insert';
        $data['booking'] = null;
        $data['room'] = $this->m_kar_booking->get_all_room();
        $this->view('kar_booking/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Pemesanan Kamar';
        $data['booking'] = $this->m_kar_booking->get_by_id($id);
        $data['bookings'] = $this->m_kar_booking->get_by_ids($id);
        $data['bookingr'] = $this->m_kar_booking->get_by_idr($id);
        $data['room'] = $this->m_kar_booking->get_all_noroom();
        $data['action'] = 'update';
        $this->view('kar_booking/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['created_by'] = $this->session->userdata('user_realname');
    $data['date_booking'] = date('y-m-d');
    $data['date_booking_from'] = date('y-m-d');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_kar_booking->insert($data);
    $id = $this->db->insert_id();

    $aaa = array(
			'booking_id' => $id,
			'cashed' => 0
      );
      
		$this->m_kar_booking->insert_payment($aaa);
    
    $idx = $this->input->post('room_id');
    $datax = array(
			'is_active' => 0
      );
    $this->m_kar_room->update($idx,$datax);

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'kar_booking/index');
  }

  public function edit($id)
  {
    $data['booking']= $this->m_kar_booking->get_specific($id);
    $this->load->view('kar_booking/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['booking_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_kar_booking->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'kar_booking/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_kar_booking->delete($id);
      $this->m_kar_booking->deletePay($id);
      $room = $this->m_kar_booking->get_by_id($id);
      $this->m_kar_booking->deleteRoom($room->room_id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'kar_booking/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
