<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Par_parking_in extends MY_Parking {

  var $access, $parking_in_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'par_parking_in'){
      $this->session->set_userdata(array('menu' => 'par_parking_in'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_par_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'par_parking_in';
    $this->access = $this->m_par_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('par_shift/m_par_shift');
    $this->load->model('par_billing/m_par_billing');
    $this->load->model('par_category/m_par_category');
    $this->load->model('par_brand/m_par_brand');
    $this->load->model('par_client/m_par_client');
  }

  public function new_billing()
  {
    $data['billing'] = $this->m_par_billing->get_list_in();

    $last = $this->m_par_billing->get_last();
    if ($last == null) {
      $data['billing_id'] = 1;
      $data['receipt_no'] = date('ymd').'000001';
    }else{
      $data['billing_id'] = $last->billing_id+1;
      if ($last->billing_date_in != date('Y-m-d')) {
        $data['receipt_no'] = date('ymd').'000001';
      }else{
        $number = substr($last->receipt_no,6,12);
        $number = intval($number)+1;
        $data['receipt_no'] = date('ymd').str_pad($number, 6, '0', STR_PAD_LEFT);
      }
    }
    $data['lbl_receipt_no'] = 'TXP-'.$data['receipt_no'];

    echo json_encode($data);
  }

  public function get_list_in()
  {
    $data = $this->m_par_billing->get_list_in();
    echo json_encode($data);
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $last = $this->m_par_shift->get_last_in();

      if ($last == null) {
        redirect(base_url().'par_parking_in/shift/open');
      }else {
        if ($last->shift_out_status == 1) {
          redirect(base_url().'par_parking_in/shift/open');
        }else{
          $data['access'] = $this->access;
          $data['title'] = 'Parkir Masuk';
          $data['action'] = 'insert';
          $data['category'] = $this->m_par_category->get_all();
          $data['brand'] = $this->m_par_brand->get_all();

          $this->view('par_parking_in/index',$data);
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
      $data['title'] = 'Parkir Masuk (Masuk Shift)';
      $data['shift_type'] = '0';
    }else{
      $data['title'] = 'Parkir Masuk (Keluar Shift)';
      $data['shift_type'] = '1';
    }
    $this->view('par_parking_in/shift', $data);
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

      $last = $this->m_par_shift->get_last_in();

      $data['shift_out_status'] = 1;
      $data['shift_out_date'] = date('Y-m-d');
      $data['shift_out_time'] = date('H:i:s');
      $data['updated_by'] = $this->session->userdata('user_realname');
      $this->m_par_shift->update($last->shift_id, $data);
    }

    redirect(base_url().'par_parking_in/index');
  }

  public function insert()
  {
    $data = $_POST;

    $data['user_id_in'] = $this->session->userdata('user_id');
    $data['user_realname_in'] = $this->session->userdata('user_realname');
    $data['created_by'] = $this->session->userdata('user_realname');

    //timestamp
    $data['billing_date_in'] = date('Y-m-d');
    $data['billing_time_in'] = date('H:i:s');
    //data
    $data['billing_tnkb'] = strtoupper($data['billing_tnkb']);
    $data['billing_status_in'] = 1;
    //get category
    $this->load->model('par_category/m_par_category');
    $category = $this->m_par_category->get_by_id($data['category_id']);
    $data['category_name'] = $category->category_name;
    $data['category_rate'] = $category->category_rate;
    $data['category_is_flat'] = $category->category_is_flat;
    $data['category_per_hour'] = $category->category_per_hour;
    // get brand
    $this->load->model('par_brand/m_par_brand');
    $brand = $this->m_par_brand->get_by_id($data['brand_id']);
    $data['brand_name'] = $brand->brand_name;

    $this->m_par_billing->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');

    $billing_id = $data['billing_id'];
    $billing = $this->m_par_billing->get_by_id($billing_id);
    //load client
    $this->load->model('par_client/m_par_client');
    $billing->client = $this->m_par_client->get_all();

    echo json_encode($billing);
  }

  public function print_bill()
  {
    $billing_id = $this->input->post('billing_id');
    $billing = $this->m_par_billing->get_by_id($billing_id);
    $client = $this->m_par_client->get_all();

    $this->load->library("EscPos.php");

		try {
  	  $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");

			$printer = new Escpos\Printer($connector);
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> text($client->client_brand);
      $printer -> feed();
      $printer -> text($client->client_street.','.$client->client_district);
      $printer -> feed();
      $printer -> text($client->client_city);
      $printer -> feed();
      $printer -> text('NPWP : '.$client->client_npwp);
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> text('TXP-'.$billing->receipt_no);
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> setTextSize(3, 3);
      $printer -> text($billing->billing_tnkb);
      $printer -> feed();
      $printer -> setTextSize(1, 1);
      $printer -> text($billing->billing_date_in.' '.$billing->billing_time_out);
      $printer -> feed();
      $printer -> text('Petugas : '.$billing->user_realname_in);
      $printer -> feed();
      $printer -> text('Terimakasih atas kunjungan anda.');
			$printer -> feed(4);
			$printer -> pulse(0, 120, 240);

			/* Close printer */
			$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}
  }

}
