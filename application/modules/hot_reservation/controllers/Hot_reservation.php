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

    $this->load->model('hot_client/m_hot_client');
    $this->load->model('hot_charge_type/m_hot_charge_type');
    $this->load->model('hot_billing/m_hot_billing');
    $this->load->model('m_hot_reservation');
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
    $data['charge_type'] = $this->m_hot_charge_type->get_all();
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
          $this->m_hot_reservation->new_billing($data['billing_receipt_no']);
        }else{
          // status billing
          // -1 cancel
          // 0 empty
          // 1 proses
          // 2 complete          
          if ($last_billing->billing_status == 0) {
            $data['billing_id'] = $last_billing->billing_id;
            $data['billing_receipt_no'] = $last_billing->billing_receipt_no;
            // empty detail billing
            $this->m_hot_reservation->empty_detail($data['billing_id']);
          } else {
            // get new last billing
            $data['billing_id'] = $last_billing->billing_id+1;
            if (date('Y-m-d', strtotime($last_billing->created)) != date('Y-m-d')) {
              $data['billing_receipt_no'] = date('ymd').'000001';
            }else{
              $number = substr($last_billing->billing_receipt_no,6,12);
              $number = intval($number)+1;
              $data['billing_receipt_no'] = date('ymd').str_pad($number, 6, '0', STR_PAD_LEFT);
            }
            
            // insert new billing
            $this->m_hot_reservation->new_billing($data['billing_receipt_no']);
          }
        }
        $data['billing_id_name'] = 'TXS-'.$data['billing_receipt_no'];    

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
    $data['billing_status'] = 1;
    $data['billing_date_in'] = ind_to_date($data['billing_date_in']);
    $data['billing_date_out'] = ind_to_date($data['billing_date_out']);
    $data['billing_num_day'] = dateDiff($data['billing_date_out'],$data['billing_date_in'])+1;
    
    $this->m_hot_reservation->update($data['billing_id'],$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'hot_reservation/payment/'.$data['billing_id']);
  }

  public function payment($id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Pembayaran';
    $data['billing'] = $this->m_hot_reservation->get_billing($id);

    $this->view('hot_reservation/payment',$data);
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
    $client = $this->m_hot_client->get_all();
    $room_type_id = $this->input->post('room_type_id');
    $raw = $this->m_hot_room->get_by_room_type_id($room_type_id);
    $room_type = $this->m_hot_room_type->get_by_id($room_type_id);
    
    $add = 0;
    if ($client->client_is_taxed == 1) {
      $charge_type = $this->m_hot_charge_type->get_all();
      foreach ($charge_type as $row) {
        $add += $room_type->room_type_charge*$row->charge_type_ratio/100;
      }
    }

    $room_type->room_type_charge += $add;

    $data = array(
      'room' => array(),
      'room_type' => $room_type
    );

    if ($raw == null) {
      array_push($data['room'], array('id' => '0', 'text' => '-- Pilih Kamar --'));
    } else {
      array_push($data['room'], array('id' => '0', 'text' => '-- Pilih Kamar --'));
      foreach ($raw as $row) {
        array_push($data['room'], array('id' => $row->room_id, 'text' => $row->room_name));
      }
    }
    
    echo json_encode($data);
  }

  public function add_room()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    
    $room = $this->m_hot_reservation->room_detail($data['room_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);
    $service = $this->m_hot_charge_type->get_by_id(2);
    $other = $this->m_hot_charge_type->get_by_id(3);
    
    if ($client->client_is_taxed == 0) {
      // Setingan harga sebelum pajak
      $room_type_charge = price_to_num($data['room_type_charge']);
      $room_type_tax = $tax->charge_type_ratio*$room_type_charge/100;
  
      $room_type_service = 0;
      if ($service->is_active == 1) {
        $sub_service = $service->charge_type_ratio*$room_type_charge/100;
      }
  
      $room_type_other = 0;
      if ($other->is_active == 1) {
        $sub_other = $other->charge_type_ratio*$room_type_charge/100;
      }
  
      $room_type_total = $data['room_type_charge']+$room_type_tax+$room_type_service+$room_type_other;
    } else {
      // Settingan harga setelah pajak
      $room_type_total = price_to_num($data['room_type_charge']);
      // hitung persen semua setelah pajak
      $tot_ratio = 100+$tax->charge_type_ratio;
      if ($service->is_active == 1) {
        $tot_ratio += $service->charge_type_ratio;
      }
      if ($other->is_active == 1) {
        $tot_ratio += $other->charge_type_ratio;
      }
      
      $room_type_tax = ($tax->charge_type_ratio/$tot_ratio)*$room_type_total;
      $room_type_service = 0;
      if ($service->is_active == 1) {
        $room_type_service = ($service->charge_type_ratio/$tot_ratio)*$room_type_total;
      }
      $room_type_other = 0;
      if ($other->is_active == 1) {
        $room_type_other = ($other->charge_type_ratio/$tot_ratio)*$room_type_total;
      }
      $room_type_charge = (100/$tot_ratio)*$room_type_total;
    }

    $data_room = array(
      'billing_id' => $data['billing_id'],
      'room_id' => $room->room_id,
      'room_name' => $room->room_name,
      'room_type_id' => $room->room_type_id,
      'room_type_name' => $room->room_type_name,
      'room_type_charge' => $room_type_charge,
      'room_type_tax' => $room_type_tax,
      'room_type_service' => $room_type_service,
      'room_type_other' => $room_type_other,
      'room_type_total' => $room_type_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_room($data_room);
  }

  public function room_list()
  {
    $billing_id = $this->input->post('billing_id');
    $data = $this->m_hot_reservation->room_list($billing_id);

    echo json_encode($data);  
  }

  public function get_billing_room()
  {
    $client = $this->m_hot_client->get_all();
    $billing_id = $this->input->post('billing_id');
    $data['room'] = $this->m_hot_reservation->get_billing_room($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_room()
  {
    $id = $this->input->post('billing_room_id');
    $this->m_hot_reservation->delete_room($id);
  }

  public function get_extra()
  {
    $extra_id = $this->input->post('extra_id');
    
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $data = $this->m_hot_extra->get_by_id($extra_id);

    if ($client->client_is_taxed == 1) {
      $data->extra_charge += $data->extra_charge*$tax->charge_type_ratio/100;
    }

    echo json_encode($data);
  }

  public function add_extra()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $extra = $this->m_hot_extra->get_by_id($data['extra_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $extra_subtotal = $data['extra_amount']*$extra->extra_charge;
    $extra_tax = $extra_subtotal*$tax->charge_type_ratio/100;
    $extra_total = $extra_subtotal+$extra_tax;

    $data_extra = array(
      'billing_id' => $data['billing_id'],
      'extra_id' => $extra->extra_id,
      'extra_name' => $extra->extra_name,
      'extra_charge' => $extra->extra_charge,
      'extra_amount' => $data['extra_amount'],
      'extra_subtotal' => $extra_subtotal,
      'extra_tax' => $extra_tax,
      'extra_total' => $extra_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_extra($data_extra);
  }

  public function get_billing_extra()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['extra'] = $this->m_hot_reservation->get_billing_extra($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_extra()
  {
    $id = $this->input->post('billing_extra_id');
    $this->m_hot_reservation->delete_extra($id);
  }

  public function get_service()
  {
    $service_id = $this->input->post('service_id');
    $client = $this->m_hot_client->get_all();
    $data = $this->m_hot_service->get_by_id($service_id);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 1) {
      $data->service_charge += $data->service_charge*$tax->charge_type_ratio/100;
    }

    echo json_encode($data);
  }

  public function add_service()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $service = $this->m_hot_service->get_by_id($data['service_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $service_subtotal = $data['service_amount']*$service->service_charge;
    $service_tax = $service_subtotal*$tax->charge_type_ratio/100;
    $service_total = $service_subtotal+$service_tax;

    $data_service = array(
      'billing_id' => $data['billing_id'],
      'service_id' => $service->service_id,
      'service_name' => $service->service_name,
      'service_charge' => $service->service_charge,
      'service_amount' => $data['service_amount'],
      'service_subtotal' => $service_subtotal,
      'service_tax' => $service_tax,
      'service_total' => $service_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_service($data_service);
  }

  public function get_billing_service()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['service'] = $this->m_hot_reservation->get_billing_service($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_service()
  {
    $id = $this->input->post('billing_service_id');
    $this->m_hot_reservation->delete_service($id);
  }

  public function get_fnb()
  {
    $fnb_id = $this->input->post('fnb_id');
    
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $data = $this->m_hot_fnb->get_by_id($fnb_id);

    if ($client->client_is_taxed == 1) {
      $data->fnb_charge += $data->fnb_charge*$tax->charge_type_ratio/100;
    }

    echo json_encode($data);
  }

  public function add_fnb()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $fnb = $this->m_hot_fnb->get_by_id($data['fnb_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $fnb_subtotal = $data['fnb_amount']*$fnb->fnb_charge;
    $fnb_tax = $fnb_subtotal*$tax->charge_type_ratio/100;
    $fnb_total = $fnb_subtotal+$fnb_tax;

    $data_fnb = array(
      'billing_id' => $data['billing_id'],
      'fnb_id' => $fnb->fnb_id,
      'fnb_name' => $fnb->fnb_name,
      'fnb_charge' => $fnb->fnb_charge,
      'fnb_amount' => $data['fnb_amount'],
      'fnb_subtotal' => $fnb_subtotal,
      'fnb_tax' => $fnb_tax,
      'fnb_total' => $fnb_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_fnb($data_fnb);
  }

  public function get_billing_fnb()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['fnb'] = $this->m_hot_reservation->get_billing_fnb($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_fnb()
  {
    $id = $this->input->post('billing_fnb_id');
    $this->m_hot_reservation->delete_fnb($id);
  }

  public function get_count()
  {
    $billing_id = $this->input->post('billing_id');
    
    $data['count_room'] = $this->m_hot_reservation->count_room($billing_id);
    $data['count_extra'] = $this->m_hot_reservation->count_extra($billing_id);
    $data['count_service'] = $this->m_hot_reservation->count_service($billing_id);
    $data['count_fnb'] = $this->m_hot_reservation->count_fnb($billing_id);

    echo json_encode($data);
  }

}
