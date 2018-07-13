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
    $this->load->model('kar_client/m_kar_client');
    $this->load->model('kar_tax/m_kar_tax');
    $this->load->model('app_install/m_app_install');
  }

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
    $tax = $this->m_kar_tax->get_by_id(1);
    $billing = $this->m_kar_billing->get_by_id($tx_id);

    $data_billing = array();
    $data_billing['tx_total_after_tax'] = $billing->tx_room_price_total + $total_service;
    $data_billing['tx_total_tax'] = ($tax->tax_ratio/(100+$tax->tax_ratio))*$data_billing['tx_total_after_tax'];
    $data_billing['tx_total_before_tax'] = $data_billing['tx_total_after_tax'] - $data_billing['tx_total_tax'];
    $data_billing['tx_total_grand'] = $data_billing['tx_total_after_tax'] - $billing->tx_total_discount;

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
    //$data = null;
    $this->load->model('kar_client/m_kar_client');
    $data['client'] = $this->m_kar_client->get_all();
    $data['tx_id'] = $tx_id;

    $bill = $this->m_kar_billing->get_by_id($tx_id);
    $client = $this->m_kar_client->get_all();
    $app_install = $this->m_app_install->get_install();
    $tax = $this->m_kar_tax->get_by_id(1);

    $dashboard = array(
      'auth'=> 'prismapos.addkomputer',
      'apikey'=> '69f86eadd81650164619f585bb017316',
      'app_type_id'=> $app_install['type_id'],
      'client_id'=> $client->client_id,
      'pos_sn'=> $client->client_serial_number,
      'npwpd'=> $client->client_npwpd,
      'customer_name'=> $bill->member_name,
      'no_receipt'=> 'TRS-'.$bill->tx_receipt_no,
      'tx_id'=> $bill->tx_id,
      'tx_date'=> $bill->tx_date,
      'tx_time'=> $bill->tx_time_end,
      'tx_total_before_tax'=> $bill->tx_total_before_tax,
      'tax_code'=> $tax->tax_code,
      'tax_ratio'=> $tax->tax_ratio,
      'tx_total_tax'=> $bill->tx_total_tax,
      'tx_total_after_tax'=> $bill->tx_total_after_tax,
      'tx_total_grand'=> $bill->tx_total_grand,
      'user_id'=> $bill->user_id,
      'user_realname'=> $bill->user_realname,
      'created'=> $bill->created,
    );

    echo json_encode($dashboard);
  }

  public function print_bill()
  {
    $tx_id = $this->input->post('tx_id');
    //$billing = $this->m_kar_cashier->get_receipt($tx_id);
    $billing = $this->m_kar_billing->get_by_id($tx_id);
    $room = $this->m_kar_room->get_by_id($billing->room_id);
    $room_type = $this->m_kar_room_type->get_by_id($room->room_type_id);
    $service_charge = $this->m_kar_cashier->get_service_charge($tx_id);

    $client = $this->m_kar_client->get_all();

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
      $printer -> text('TXS-'.$billing->tx_receipt_no);
      $printer -> feed();
      $printer -> text('Member : '.$billing->member_name);
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind($billing->tx_date).' '.date('H:i:s'));
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> text($room_type->room_type_name.' Room');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
      $printer -> text($billing->tx_duration.' jam x '.num_to_price($billing->tx_room_price).' = '.num_to_price($billing->tx_room_price_total));
      $printer -> feed();
      if ($service_charge != null) {
        foreach ($service_charge as $row) {
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->service_charge_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          $printer -> text($row->service_charge_amount.' x '.num_to_price($row->service_charge_price).' = '.num_to_price($row->service_charge_total));
          $printer -> feed();
        }
      }
      $space_array = array(
        strlen(num_to_price($billing->tx_total_before_tax)),
        strlen(num_to_price($billing->tx_total_discount)),
        strlen(num_to_price($billing->tx_total_tax)),
        strlen(num_to_price($billing->tx_total_grand)),
        strlen(num_to_price($billing->tx_payment)),
        strlen(num_to_price($billing->tx_change))
      );
      $l_max = max($space_array);
      $l_1 = $l_max - strlen(num_to_price($billing->tx_total_before_tax));
      $s_1 = '';
      for ($i=0; $i < $l_1; $i++) {
        $s_1 .= ' ';
      };
      $l_2 = $l_max - strlen(num_to_price($billing->tx_total_discount));
      $s_2 = '';
      for ($i=0; $i < $l_2; $i++) {
        $s_2 .= ' ';
      };
      $l_3 = $l_max - strlen(num_to_price($billing->tx_total_tax));
      $s_3 = '';
      for ($i=0; $i < $l_3; $i++) {
        $s_3 .= ' ';
      };
      $l_4 = $l_max - strlen(num_to_price($billing->tx_total_grand));
      $s_4 = '';
      for ($i=0; $i < $l_4; $i++) {
        $s_4 .= ' ';
      };
      $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
      $printer -> text('--------------------------------');
      $printer -> text('Subtotal = '.$s_1.num_to_price($billing->tx_total_before_tax));
      $printer -> feed();
      $printer -> text('Diskon = '.$s_2.num_to_price($billing->tx_total_discount));
      $printer -> feed();
      $printer -> text('Pajak = '.$s_3.num_to_price($billing->tx_total_tax));
      $printer -> feed();
      $printer -> text('Total = '.$s_4.num_to_price($billing->tx_total_grand));
      $printer -> feed(2);
      $l_5 = $l_max - strlen(num_to_price($billing->tx_payment));
      $s_5 = '';
      for ($i=0; $i < $l_5; $i++) {
        $s_5 .= ' ';
      };
      $printer -> text('Bayar = '.$s_5.num_to_price($billing->tx_payment));
      $printer -> feed();
      $l_6 = $l_max - strlen(num_to_price($billing->tx_change));
      $s_6 = '';
      for ($i=0; $i < $l_6; $i++) {
        $s_6 .= ' ';
      };
      $printer -> text('Kembali = '.$s_6.num_to_price($billing->tx_change));
      $printer -> feed(2);
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
