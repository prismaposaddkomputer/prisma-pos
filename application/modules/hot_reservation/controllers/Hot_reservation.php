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
    $this->load->model('hot_extra/m_hot_extra');
    $this->load->model('hot_service/m_hot_service');
    $this->load->model('hot_fnb/m_hot_fnb');
    $this->load->model('hot_billing_room/m_hot_billing_room');
    $this->load->model('hot_billing_extra/m_hot_billing_extra');
    $this->load->model('hot_billing_service/m_hot_billing_service');
    $this->load->model('hot_billing_fnb/m_hot_billing_fnb');
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
    $data['member'] = $this->m_hot_member->get_all();
    $data['room_type'] = $this->m_hot_room_type->get_all();
    $data['extra'] = $this->m_hot_extra->get_all();
    $data['service'] = $this->m_hot_service->get_all();
    $data['fnb'] = $this->m_hot_fnb->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Data Reservasi';
        $data['action'] = 'insert';
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

    //get last billing
    $last = $this->m_hot_billing->get_last();
    if ($last == null) {
      $billing_id = 1;
    }else{
      $billing_id = $last->billing_id+1;
    }

    $tot_room = 0;
    if (isset($data['room_id'])) {
      foreach ($data['room_id'] as $key => $val) {
        $room = $this->m_hot_room->get_by_id($val);
        $data_room = array(
          'billing_id' => $billing_id,
          'room_id' => $room->room_id,
          'room_name' => $room->room_name,
          'room_type_id' => $room->room_type_id,
          'room_type_name' => $room->room_type_name,
          'room_type_charge' => $room->room_type_charge
        );
        $this->m_hot_billing_room->insert($data_room);
        $tot_room += $room->room_type_charge;
      }
    }

    $tot_extra = 0;
    if (isset($data['extra_id'])) {
      foreach ($data['extra_id'] as $key => $val) {
        $extra = $this->m_hot_extra->get_by_id($val);
        $data_extra = array(
          'billing_id' => $billing_id,
          'extra_id' => $extra->extra_id,
          'extra_name' => $extra->extra_name,
          'extra_charge' => $extra->extra_charge
        );
        $this->m_hot_billing_extra->insert($data_extra);
        $tot_extra += $extra->extra_charge;
      }
    }
    
    $tot_service = 0;
    if (isset($data['service_id'])) {
      foreach ($data['service_id'] as $key => $val) {
        $service = $this->m_hot_service->get_by_id($val);
        $data_service = array(
          'billing_id' => $billing_id,
          'service_id' => $service->service_id,
          'service_name' => $service->service_name,
          'service_charge' => $service->service_charge
        );
        $this->m_hot_billing_service->insert($data_service);
        $tot_service += $service->service_charge;
      }
    }

    $tot_fnb = 0;
    if (isset($data['fnb_id'])) {
      foreach ($data['fnb_id'] as $key => $val) {
        $fnb = $this->m_hot_fnb->get_by_id($val);
        $data_fnb = array(
          'billing_id' => $billing_id,
          'fnb_id' => $fnb->fnb_id,
          'fnb_name' => $fnb->fnb_name,
          'fnb_charge' => $fnb->fnb_charge
        );
        $this->m_hot_billing_fnb->insert($data_fnb);
        $tot_fnb += $fnb->fnb_charge;
      }
    }

    unset($data['room_id'],$data['extra_id'],$data['service_id'],$data['fnb_id']);

    $data['billing_date_in'] = ind_to_date($data['billing_date_in']);
    $data['billing_date_out'] = ind_to_date($data['billing_date_out']);
    $data['billing_down_payment'] = price_to_num($data['billing_down_payment']);
    $data['billing_sub_total'] = $tot_room + $tot_extra + $tot_service + $tot_fnb;
    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_realname'] = $this->session->userdata('user_realname');
    $data['created_by'] = $this->session->userdata('user_realname');

    $this->m_hot_billing->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'hot_reservation/index');
  }

  public function edit($id)
  {
    $data['billing']= $this->m_hot_billing->get_specific($id);
    $data['room_id'] = $this->m_hot_billing_room->get_by_billing_id($id);
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

    if ($raw == null) {
      array_push($data, array('id' => '0', 'text' => '-- Pilih --'));
    } else {
      array_push($data, array('id' => '0', 'text' => '-- Pilih --'));
      foreach ($raw as $row) {
        array_push($data, array('id' => $row->room_id, 'text' => $row->room_name));
      }
    }
    
    echo json_encode($data);
  }

}
