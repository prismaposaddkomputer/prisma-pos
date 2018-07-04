<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_cashier extends MY_Karaoke {

  var $access, $cashier_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_cashier'){
      $this->session->set_userdata(array('menu' => 'kar_cashier'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_cashier';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_cashier');
    $this->load->model('kar_shift/m_kar_shift');
    $this->load->model('kar_billing/m_kar_billing');
    $this->load->model('kar_room/m_kar_room');
    $this->load->model('kar_room_type/m_kar_room_type');
    $this->load->model('kar_member/m_kar_member');
    $this->load->model('kar_time/m_kar_time');
    $this->load->model('kar_service_charge/m_kar_service_charge');
    $this->load->model('kar_receipt/m_kar_receipt');
  }

  // public function new_billing()
  // {
  //   $data['billing'] = $this->m_kar_billing->get_list_in();
  //
  //   $last = $this->m_kar_billing->get_last();
  //   if ($last == null) {
  //     $billing_id = 'TXP-'.'1';
  //   }else{
  //     $billing_id = 'TXP-'.($last->billing_id+1);
  //   }
  //   $data['billing_id'] = $billing_id;
  //
  //   echo json_encode($data);
  // }

  public function get_list_in()
  {
    $data = $this->m_kar_billing->get_list_in();
    echo json_encode($data);
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $last = $this->m_kar_shift->get_last();

      if ($last == null) {
        redirect(base_url().'kar_cashier/shift/open');
      }else {
        if ($last->shift_out_status == 1) {
          redirect(base_url().'kar_cashier/shift/open');
        }else{
          $data['access'] = $this->access;
          $data['title'] = 'Kasir ';
          $data['action'] = 'insert';
          $data['room_type'] = $this->m_kar_room_type->get_all();
          $data['member'] = $this->m_kar_member->get_all();
          $data['service_charge'] = $this->m_kar_service_charge->get_all();
          $last = $this->m_kar_billing->get_last();

          $this->view('kar_cashier/index',$data);
        }
      }
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function shift($shift_type)
  {
    $data['parking_type'] = '0';
    $data['access'] = $this->access;
    $data['action'] = 'shift_action/'.$shift_type;

    if ($shift_type == 'open') {
      $data['title'] = 'Kasir  (Masuk Shift)';
      $data['shift_type'] = '0';
    }else{
      $data['title'] = 'Kasir  (Keluar Shift)';
      $data['shift_type'] = '1';
    }
    $this->view('kar_cashier/shift', $data);
  }

  public function shift_action($shift_type)
  {
    $data = $_POST;

    if ($shift_type == 'open') {
      $data['money_in_total'] = $data['money_in_100k']*100000+$data['money_in_50k']*50000+
        $data['money_in_20k']*20000+$data['money_in_10k']*10000+
        $data['money_in_5k']*5000+$data['money_in_2k']*2000+$data['money_in_1k']*1000;
      $data['coin_in_total'] = $data['coin_in_1k']*1000+$data['coin_in_500']*500+
        $data['coin_in_200']*200+$data['coin_in_100']*100+$data['coin_in_50']*50+
        $data['coin_in_25']*25;
      $data['total_in'] = $data['money_in_total']+$data['coin_in_total'];

      $data['shift_in_status'] = 1;
      $data['shift_in_date'] = date('Y-m-d');
      $data['shift_in_time'] = date('H:i:s');
      $data['created_by'] = $this->session->userdata('user_realname');
      $this->m_kar_shift->insert($data);
    }else{
      $data['money_out_total'] = $data['money_out_100k']*100000+$data['money_out_50k']*50000+
        $data['money_out_20k']*20000+$data['money_out_10k']*10000+
        $data['money_out_5k']*5000+$data['money_out_2k']*2000+$data['money_out_1k']*1000;
      $data['coin_out_total'] = $data['coin_out_1k']*1000+$data['coin_out_500']*500+
        $data['coin_out_200']*200+$data['coin_out_100']*100+$data['coin_out_50']*50+
        $data['coin_out_25']*25;
      $data['total_out'] = $data['money_out_total']+$data['coin_out_total'];

      $last = $this->m_kar_shift->get_last();

      $data['shift_out_status'] = 1;
      $data['shift_out_date'] = date('Y-m-d');
      $data['shift_out_time'] = date('H:i:s');
      $data['updated_by'] = $this->session->userdata('user_realname');
      $this->m_kar_shift->update($last->shift_id, $data);
    }

    redirect(base_url().'kar_cashier/index');
  }

  public function get_all_room()
  {
    $data = $this->m_kar_cashier->get_all_room();
    echo json_encode($data);
  }

  public function get_room_by_type()
  {
    $id = $this->input->post('room_type_id');
    $data = $this->m_kar_cashier->get_room_by_type($id);
    echo json_encode($data);
  }

  public function get_room_by_id()
  {
    $id = $this->input->post('room_id');
    $day_now = date('N');
    $time_now = date('H:i:s');

    $time = $this->m_kar_time->get_time($time_now);

    $data = $this->m_kar_cashier->get_room_by_id($id);

    if ($day_now <=5) {
      //weekday
      if ($time->time_id == 1) {
        //happy hours
        $data->room_price = $data->weekday_happy_hours;
      }else {
        //bussiness hours
        $data->room_price = $data->weekday_business_hours;
      }
    }else{
      //weekend
      if ($time->time_id == 1) {
        //happy hours
        $data->room_price = $data->weekend_happy_hours;
      }else {
        //bussiness hours
        $data->room_price = $data->weekend_business_hours;
      }
    }

    echo json_encode($data);
  }

  public function insert()
  {
    $data = $_POST;

    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_realname'] = $this->session->userdata('user_realname');
    $data['created_by'] = $this->session->userdata('user_realname');

    //receipt_no
    $last = $this->m_kar_billing->get_last();
    if ($last == null) {
      $data['tx_receipt_no'] = date('ymd').'000001';
    }else{
      if ($last->tx_date != date('Y-m-d')) {
        $data['tx_receipt_no'] = date('ymd').'000001';
      }else{
        $number = substr($last->tx_receipt_no,6,12);
        $number = intval($number)+1;
        $data['tx_receipt_no'] = date('ymd').str_pad($number, 6, '0', STR_PAD_LEFT);
      }
    }

    //member
    $member = $this->m_kar_member->get_by_id($data['member_id']);
    $data['member_name'] = $member->member_name;
    //room
    $room = $this->m_kar_room->get_by_id($data['room_id']);
    $data['room_name'] = $room->room_name;

    //time
    $data['tx_date'] = date('Y-m-d');
    $time_start = date('H:i:s');
    $data['tx_time_start'] = $time_start;
    $time_end = date('H:i:s', strtotime($time_start)+($data['tx_duration']*3600));
    $data['tx_time_end'] = $time_end;

    if(isset($data['service_charge_id'])){
      $service_charge_id = $data['service_charge_id'];
      $service_charge_amount = $data['service_charge_amount'];

      unset($data['service_charge_id'],$data['service_charge_amount']);
    }

    //insert
    $this->m_kar_billing->insert($data);
    //get last
    $last_billing = $this->m_kar_billing->get_last();
    $tx_id = $last_billing->tx_id;

    $total_service = 0;
    if(isset($service_charge_id)){
      foreach ($service_charge_id as $key => $val) {
        $service_charge = $this->m_kar_service_charge->get_by_id($val);
        $data_service = null;
        $data_service = array(
          'tx_id' => $tx_id,
          'service_charge_id' => $service_charge->service_charge_id,
          'service_charge_name' => $service_charge->service_charge_name,
          'service_charge_price' => $service_charge->service_charge_price,
          'service_charge_amount' => $service_charge_amount[$key],
          'service_charge_total' => $service_charge->service_charge_price*$service_charge_amount[$key]
        );
        $total_service += $service_charge->service_charge_price*$service_charge_amount[$key];
        $this->m_kar_cashier->insert_service_charge($data_service);
      }
    }

    //update billing total
    $billing = $this->m_kar_billing->get_by_id($tx_id);

    $data_billing = array();
    $data_billing['tx_total_before_tax'] = $billing->tx_room_price_total + $total_service;
    $data_billing['tx_total_grand'] = $data_billing['tx_total_before_tax'] + $billing->tx_total_tax-$billing->tx_total_discount;

    $this->m_kar_billing->update($tx_id,$data_billing);

    echo json_encode($data);
  }

  public function finish_action()
  {
    $tx_id = $this->input->post('tx_id');
    $this->m_kar_cashier->finish_action($tx_id);
  }

  public function payment()
  {
    $tx_id = $this->input->post('tx_id');
    $billing = $this->m_kar_billing->get_by_id($tx_id);

    echo json_encode($billing);
  }

  public function payment_action()
  {
    $data = $_POST;

    $tx_id = $data['tx_id'];
    $data['tx_status'] = 2;
    $data['payment_type_id'] = 1;
    $this->m_kar_billing->update($tx_id, $data);
    $data = null;
    $this->load->model('kar_client/m_kar_client');
    $data['client'] = $this->m_kar_client->get_all();
    $data['receipt'] = $this->m_kar_receipt->get_all();
    $data['billing'] = $this->m_kar_billing->get_by_id($tx_id);
    $data['room'] = $this->m_kar_room->get_by_id($data['billing']->room_id);
    $data['room_type'] = $this->m_kar_room_type->get_by_id($data['room']->room_type_id);
    $data['service_charge'] = $this->m_kar_cashier->get_service_charge($tx_id);

    echo json_encode($data);
  }

}
