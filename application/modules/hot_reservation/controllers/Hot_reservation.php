<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_reservation extends MY_Hotel {

  var $access, $billing_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_reservation'){
      $this->session->set_userdata(array('menu' => 'hot_reservation'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_reservation';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('hot_billing/m_hot_billing');
    $this->load->model('hot_member/m_hot_member');
    $this->load->model('hot_room_type/m_hot_room_type');
    $this->load->model('hot_room/m_hot_room');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Reservasi';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'hot_reservation/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_hot_billing->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['billing'] = $this->m_hot_billing->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_hot_billing->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['billing'] = $this->m_hot_billing->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('hot_reservation/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'hot_reservation/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Data Reservasi';
        $data['action'] = 'insert';
        $data['member'] = $this->m_hot_member->get_all();
        $data['room_type'] = $this->m_hot_room_type->get_all();
        $data['billing'] = null;
        //make receipt no
        // get last billing
        $last_billing = $this->m_hot_billing->get_last();
        //declare billing variable
        if ($last_billing == null) {
          $data['billing_id'] = 1;
          $data['billing_receipt_no'] = date('ymd').'000001';
          $data['billing_id_name'] = 'TXS-'.$data['billing_receipt_no'];
        }else{
          $data['billing_id'] = $last_billing->billing_id+1;
          if ($last_billing->billing_date_in != date('Y-m-d')) {
            $data['billing_receipt_no'] = date('ymd').'000001';
          }else{
            $number = substr($last_billing->billing_receipt_no,6,12);
            $number = intval($number)+1;
            $data['billing_receipt_no'] = date('ymd').str_pad($number, 6, '0', STR_PAD_LEFT);
          }
          $data['billing_id_name'] = 'TXS-'.$data['billing_receipt_no'];
        }

        $this->view('hot_reservation/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Data Extra';
        $data['billing'] = $this->m_hot_billing->get_by_id($id);
        $data['action'] = 'update';
        $this->view('hot_reservation/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['created_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    //
    $data['billing_charge'] = price_to_num($data['billing_charge']);
    //
    $this->m_hot_billing->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'hot_reservation/index');
  }

  public function edit($id)
  {
    $data['billing']= $this->m_hot_billing->get_specific($id);
    $this->load->view('hot_billing/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['billing_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    //
    $data['billing_charge'] = price_to_num($data['billing_charge']);
    //
    $this->m_hot_billing->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'hot_reservation/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_hot_billing->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'hot_reservation/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function get_member()
  {
    $member_id = $this->input->post('member_id');
    $data = $this->m_hot_member->get_by_id($member_id);

    echo json_encode($data);
  }

  public function get_room()
  {
    $room_type_id = $this->input->post('room_type_id');
    $raw = $this->m_hot_room->get_by_room_type_id($room_type_id);
    $data = array();

    foreach ($raw as $row) {
      array_push($data, array('id' => $row->room_type_id, 'value' => $row->room_type_name));
    }

    echo json_encode($data);
  }

}
