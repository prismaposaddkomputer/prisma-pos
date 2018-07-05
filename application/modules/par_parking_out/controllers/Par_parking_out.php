<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Par_parking_out extends MY_Parking {

  var $access, $parking_out_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'par_parking_out'){
      $this->session->set_userdata(array('menu' => 'par_parking_out'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_par_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'par_parking_out';
    $this->access = $this->m_par_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('par_billing/m_par_billing');
    $this->load->model('par_category/m_par_category');
    $this->load->model('par_brand/m_par_brand');
    $this->load->model('par_shift/m_par_shift');
    $this->load->model('par_tax/m_par_tax');
  }

  public function get_list_out()
  {
    $data = $this->m_par_billing->get_list_out();
    echo json_encode($data);
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $last = $this->m_par_shift->get_last_out();

      if ($last == null) {
        redirect(base_url().'par_parking_out/shift/open');
      }else {
        if ($last->shift_out_status == 1) {
          redirect(base_url().'par_parking_out/shift/open');
        }else{
          $data['access'] = $this->access;
          $data['title'] = 'Parkir Keluar';
          $data['action'] = 'update';
          $data['category'] = $this->m_par_category->get_all();
          $data['brand'] = $this->m_par_brand->get_all();

          $this->view('par_parking_out/index',$data);
        }
      }
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function shift($shift_type)
  {
    $data['parking_type'] = '1';
    $data['access'] = $this->access;
    $data['action'] = 'shift_action/'.$shift_type;

    if ($shift_type == 'open') {
      $data['title'] = 'Parkir Keluar (Masuk Shift)';
      $data['shift_type'] = '0';
    }else{
      $data['title'] = 'Parkir Keluar (Keluar Shift)';
      $data['shift_type'] = '1';
    }
    $this->view('par_parking_out/shift', $data);
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
      $this->m_par_shift->insert($data);
    }else{
      $data['money_out_total'] = $data['money_out_100k']*100000+$data['money_out_50k']*50000+
        $data['money_out_20k']*20000+$data['money_out_10k']*10000+
        $data['money_out_5k']*5000+$data['money_out_2k']*2000+$data['money_out_1k']*1000;
      $data['coin_out_total'] = $data['coin_out_1k']*1000+$data['coin_out_500']*500+
        $data['coin_out_200']*200+$data['coin_out_100']*100+$data['coin_out_50']*50+
        $data['coin_out_25']*25;
      $data['total_out'] = $data['money_out_total']+$data['coin_out_total'];

      $last = $this->m_par_shift->get_last_out();

      $data['shift_out_status'] = 1;
      $data['shift_out_date'] = date('Y-m-d');
      $data['shift_out_time'] = date('H:i:s');
      $data['updated_by'] = $this->session->userdata('user_realname');
      $this->m_par_shift->update($last->shift_id, $data);
    }

    redirect(base_url().'par_parking_out/index');
  }

  public function update()
  {
    $data = $_POST;

    $billing_id = $data['billing_id'];

    $data['user_id_out'] = $this->session->userdata('user_id');
    $data['user_realname_out'] = $this->session->userdata('user_realname');
    $data['updated_by'] = $this->session->userdata('user_realname');

    $data['billing_tnkb'] = strtoupper($data['billing_tnkb']);
    $data['billing_subtotal'] = price_to_num($data['billing_subtotal']);
    $data['billing_tax'] = price_to_num($data['billing_tax']);
    $data['billing_total_grand'] = price_to_num($data['billing_total_grand']);
    $data['billing_payment'] = price_to_num($data['billing_payment']);
    $data['billing_change'] = price_to_num($data['billing_change']);

    $data['billing_status_out'] = 1;
    unset($data['billing_id']);

    $this->m_par_billing->update($billing_id, $data);

    echo json_encode($data);
  }

  public function get_billing()
  {
    $tax = $this->m_par_tax->get_by_id(1);
    $billing_tnkb = $this->input->post('billing_tnkb');
    $billing = $this->m_par_billing->get_by_tnkb($billing_tnkb);

    $date_now = date('Y-m-d');
    $time_now = date('H:i:s');
    $timestamp_now = $date_now.' '.$time_now;

    $timestamp_in = Carbon\Carbon::parse($billing->billing_date_in.' '.$billing->billing_time_in);
    $duration = $timestamp_in->diffInHours($timestamp_now);

    $billing->billing_duration = $duration;
    $billing->billing_date_out = $date_now;
    $billing->billing_time_out = $time_now;

    if ($billing->category_not_flat == 1) {
      $billing->not_flat = 1;
      $billing->billing_total_grand = $billing->category_rate+(($duration-1)*$billing->category_per_hour);
      $billing->billing_tax = round(($tax->tax_ratio/(100+$tax->tax_ratio)) * $billing->billing_total_grand);
      $billing->billing_subtotal = $billing->billing_total_grand-$billing->billing_tax;
    } else {
      $billing->not_flat = 0;
      $billing->billing_total_grand = $billing->category_rate;
      $billing->billing_tax = round(($tax->tax_ratio/(100+$tax->tax_ratio)) * $billing->billing_total_grand);
      $billing->billing_subtotal = $billing->billing_total_grand-$billing->billing_tax;
    }

    echo json_encode($billing);
  }

}
