<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

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
        $data['billing_room'] = $this->m_hot_reservation->get_billing_room($id);
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
    $data['billing_down_payment'] = price_to_num($data['billing_down_payment']);

    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_realname'] = $this->session->userdata('user_realname');
    
    $this->m_hot_reservation->update($data['billing_id'],$data);

    $this->update_all_billing($data['billing_id']);

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'hot_reservation/payment/'.$data['billing_id']);
  }

  public function update_all_billing($billing_id)
  {
    $room = $this->m_hot_reservation->get_billing_room($billing_id);
    $extra = $this->m_hot_reservation->get_billing_extra($billing_id);
    $service = $this->m_hot_reservation->get_billing_service($billing_id);
    $fnb = $this->m_hot_reservation->get_billing_fnb($billing_id);

    $billing_subtotal = 0;
    $billing_tax = 0;
    $billing_service = 0;
    $billing_other = 0;
    $billing_total = 0;

    foreach ($room as $row) {
      $billing_subtotal += $row->room_type_subtotal;
      $billing_tax += $row->room_type_tax;
      $billing_service += $row->room_type_service;
      $billing_other += $row->room_type_other;
      $billing_total += $row->room_type_total;
    }

    foreach ($extra as $row) {
      $billing_subtotal += $row->extra_subtotal;
      $billing_tax += $row->extra_tax;
      $billing_total += $row->extra_total;
    }

    foreach ($service as $row) {
      $billing_subtotal += $row->service_subtotal;
      $billing_tax += $row->service_tax;
      $billing_total += $row->service_total;
    }

    foreach ($fnb as $row) {
      $billing_subtotal += $row->fnb_subtotal;
      $billing_tax += $row->fnb_tax;
      $billing_total += $row->fnb_total;
    }

    $data['billing_subtotal'] = $billing_subtotal;
    $data['billing_tax'] = $billing_tax;
    $data['billing_service'] = $billing_service;
    $data['billing_other'] = $billing_other;
    $data['billing_total'] = $billing_total;

    $this->m_hot_reservation->update($billing_id,$data);
  }

  public function detail($id)
  {
    $data['access'] = $this->access;
    $data['id'] = $id;
    $data['title'] = 'Detail Reservasi';

    $data['billing'] = $this->m_hot_reservation->get_billing($id);
    $data['charge_type'] = $this->m_hot_charge_type->get_all();

    $this->view('hot_reservation/detail',$data);
  }

  public function payment($id)
  {
    $data['access'] = $this->access;
    $data['id'] = $id;
    //
    $data['action'] = 'payment_action';
    //
    $data['title'] = 'Pembayaran';
    $data['billing'] = $this->m_hot_reservation->get_billing($id);
    $data['charge_type'] = $this->m_hot_charge_type->get_all();

    $this->view('hot_reservation/payment',$data);
  }

  public function payment_action()
  {
    $data = $_POST;
    $id = $data['billing_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    //
    $save_print = $data['save_print'];
    unset($data['save_print']);
    //
    $billing = $this->m_hot_reservation->get_billing($id);
    $billing_total = $billing->billing_total - $billing->billing_down_payment;
    //
    $data['billing_payment'] = price_to_num($data['billing_payment']);
    $data['billing_change'] = $data['billing_payment'] - $billing_total;
    $data['billing_status'] = 2;
    //
    $this->m_hot_billing->update($id,$data);
    if ($save_print == 'print_pdf') {
      $this->frame_pdf($id);
    }else if($save_print == 'print_struk'){
      $this->reservation_print_struk($id);
    }

    $this->m_hot_reservation->update($data['billing_id'],$data);
  }

  public function edit($id)
  {
    $data['billing']= $this->m_hot_billing->get_specific($id);
    $data['room_id'] = $this->m_hot_billing_room->get_by_billing_id($id);
    $this->load->view('hot_billing/update', $data);
  }

  public function cancel($billing_id)
  {
    $data = array(
      'billing_status' => -1
    );
    $this->m_hot_reservation->update($billing_id,$data);
    redirect(base_url().'hot_reservation/index');
  }

  public function update()
  {
    $data = $_POST;

    $data['billing_status'] = 1;
    $data['billing_date_in'] = ind_to_date($data['billing_date_in']);
    $data['billing_date_out'] = ind_to_date($data['billing_date_out']);
    $data['billing_num_day'] = dateDifference($data['billing_date_out'].' '.$data['billing_time_out'],$data['billing_date_in'].' '.$data['billing_time_out'])+1;
    $data['billing_down_payment'] = price_to_num($data['billing_down_payment']);

    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_realname'] = $this->session->userdata('user_realname');
    
    $this->m_hot_reservation->update($data['billing_id'],$data);

    $data_update = array(
      'billing_id' => $data['billing_id'],
      'billing_date_in' => $data['billing_date_in'],
      'billing_time_in' => $data['billing_time_in'],
      'billing_date_out' => $data['billing_date_out'],
      'billing_time_out' => $data['billing_time_out'],
    );
    
    $this->update_billing_room($data_update);
    $this->update_all_billing($data['billing_id']);

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    // redirect(base_url().'hot_reservation/index');
    redirect(base_url().'hot_reservation/payment/'.$data['billing_id']);
  }

  public function reservation_print_pdf($billing_id)
  {
    $data['title'] = "Laporan Reservasi Pembayaran";
    $data['client'] = $this->m_hot_client->get_all();
    //
    $data['billing'] = $this->m_hot_reservation->get_billing($billing_id);
    $data['charge_type'] = $this->m_hot_charge_type->get_all();
    $data['date_now'] = date("Y-m-d");
    $data['time_now'] = date("H:i:s");

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-reservasi-pembayaran-".$data['billing']->billing_receipt_no.".pdf";
    $this->pdf->load_view('print_pdf', $data);
  }

  public function frame_pdf($billing_id)
  {
    $data['billing_id'] = $billing_id;

    $this->view('hot_reservation/frame_pdf', $data);
  }

  public function reservation_print_struk($billing_id)
  {
    $title = "Laporan Reservasi Pembayaran";
    $client = $this->m_hot_client->get_all();
    //
    $billing = $this->m_hot_reservation->get_billing($billing_id);
    $charge_type = $this->m_hot_charge_type->get_all();
    $date_now = date("Y-m-d");
    $time_now = date("H:i:s");
    //

    //print
    $this->load->library("EscPos.php");

    try {
      $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");
         
      $printer = new Escpos\Printer($connector);

      //print image
      if ($client->client_logo !='') {
        $img = Escpos\EscposImage::load("img/".$client->client_logo);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> bitImage($img);
        $printer -> feed();
      }
      //Keterangan Wajib Pajak
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);

      if ($client->client_logo == '') {
        $printer -> setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
        $printer -> text($client->client_name."\n");
        $printer -> setUnderline(Escpos\Printer::UNDERLINE_NONE);
      }

      $printer -> text($client->client_street.','.$client->client_district."\n");
      $printer -> text($client->client_city."\n");
      $printer -> text("NPWPD : ".$client->client_npwpd."\n"); 
      $printer -> text('TXS-'.$billing->billing_receipt_no."\n");
      //Judul
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text(substr($billing->user_realname,0,12).' '.convert_date($billing->created));
      $printer -> feed();
      $printer -> text('--------------------------------');
      //
      $check_in_left = "CHECK IN";
      $check_in_right = date_to_ind($billing->billing_date_in).' '.$billing->billing_time_in;
      $printer -> text(print_justify($check_in_left, $check_in_right, 10, 19, 3));
      $check_out_left = "CHECK OUT";
      $check_out_right = date_to_ind($billing->billing_date_out).' '.$billing->billing_time_out;
      $printer -> text(print_justify($check_out_left, $check_out_right, 10, 19, 3));
      $printer -> text('--------------------------------');
      //Keterangan Tamu
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text("Detail Tamu :");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Nama : ".$billing->guest_name);
      $printer -> feed();
      if ($billing->guest_phone !='') {
        $phone = $billing->guest_phone;
      }else {
        $phone = "-";
      }
      $printer -> text("No Telp : ".$phone);
      if ($billing->guest_id_no !='') {
        $id_no = $billing->guest_id_no;
      }else {
        $id_no = "-";
      }
      $printer -> feed();
      $printer -> text("No Identitas : ".$id_no);
      $printer -> feed();
      $printer -> text('--------------------------------');
      //Keterangan Pemesanan
      // Kamar
      if ($billing->room != null){
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Kamar :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->room as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->room_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $room_type_subtotal = num_to_price($row->room_type_charge);
          }else{
            $room_type_subtotal = num_to_price($row->room_type_total/$row->room_type_duration);
          }
          //
          if ($client->client_is_taxed == 0) {
            $room_type_total = num_to_price($row->room_type_subtotal);
          }else{
            $room_type_total = num_to_price($row->room_type_total);
          }
          //
          $printer -> text($billing->billing_num_day." X ".$room_type_subtotal." = ".$room_type_total);
          $printer -> feed();
        }
      }
      // Extra
      if ($billing->extra != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Extra :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->extra as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->extra_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $extra_charge_sub_total = num_to_price($row->extra_charge);
          }else{
            $extra_charge_sub_total = num_to_price($row->extra_total/$row->extra_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $extra_charge_total = num_to_price($row->extra_subtotal);
          }else{
            $extra_charge_total = num_to_price($row->extra_total);
          }
          //
          $printer -> text($row->extra_amount." X ".$extra_charge_sub_total." = ".$extra_charge_total);
          $printer -> feed();
        }
      }
      // Pelayanan
      if ($billing->service != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Pelayanan :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->service as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->service_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $service_charge_sub_total = num_to_price($row->service_charge);
          }else{
            $service_charge_sub_total = num_to_price($row->service_total/$row->service_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $service_charge_total = num_to_price($row->service_subtotal);
          }else{
            $service_charge_total = num_to_price($row->service_total);
          }
          //
          $printer -> text($row->service_amount." X ".$service_charge_sub_total." = ".$service_charge_total);
          $printer -> feed();
        }
      }
      // F&B
      if ($billing->fnb != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("F&B :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->fnb as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->fnb_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $fnb_charge_sub_total = num_to_price($row->fnb_charge);
          }else{
            $fnb_charge_sub_total = num_to_price($row->fnb_total/$row->fnb_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $fnb_charge_total = num_to_price($row->fnb_subtotal);
          }else{
            $fnb_charge_total = num_to_price($row->fnb_total);
          }
          //
          $printer -> text($row->fnb_amount." X ".$fnb_charge_sub_total." = ".$fnb_charge_total);
          $printer -> feed();
        }
      }
      $printer -> text('--------------------------------');
      //
      $space_array = array(
        strlen(num_to_price($billing->billing_total)),
        strlen(num_to_price($billing->billing_down_payment)),
        strlen(num_to_price($billing->billing_total-$billing->billing_down_payment)),
        strlen(num_to_price($billing->billing_payment)),
        strlen(num_to_price($billing->billing_change)),
      );
      $l_max = max($space_array);
      $l_1 = $l_max - strlen(num_to_price($billing->billing_total));
      $s_1 = '';
      for ($i=0; $i < $l_1; $i++) {
        $s_1 .= ' ';
      };
      $l_2 = $l_max - strlen(num_to_price($billing->billing_down_payment));
      $s_2 = '';
      for ($i=0; $i < $l_2; $i++) {
        $s_2 .= ' ';
      };
      $l_3 = $l_max - strlen(num_to_price($billing->billing_total-$billing->billing_down_payment));
      $s_3 = '';
      for ($i=0; $i < $l_3; $i++) {
        $s_3 .= ' ';
      };
      $l_4 = $l_max - strlen(num_to_price($billing->billing_payment));
      $s_4 = '';
      for ($i=0; $i < $l_4; $i++) {
        $s_4 .= ' ';
      };
      $l_5 = $l_max - strlen(num_to_price($billing->billing_change));
      $s_5 = '';
      for ($i=0; $i < $l_5; $i++) {
        $s_5 .= ' ';
      };
      $l_6 = $l_max - strlen(num_to_price($billing->billing_subtotal));
      $s_6 = '';
      for ($i=0; $i < $l_6; $i++) {
        $s_6 .= ' ';
      };

      foreach ($charge_type as $row){

        if ($row->charge_type_id == '1') {
          $numb = "7";
          $charge_type_money = num_to_price($billing->billing_tax);
        }else if ($row->charge_type_id == '2') {
          $numb = "8";
          $charge_type_money = num_to_price($billing->billing_service);
        }else if ($row->charge_type_id == '3') {
          $numb = "9";
          $charge_type_money = num_to_price($billing->billing_other);
        }

        $l_[$numb] = $l_max - strlen($charge_type_money);
        $s_[$numb] = '';
        for ($i=0; $i < $l_[$numb]; $i++) {
          $s_[$numb] .= ' ';
        };
      }

      // Sebelum pajak
      $printer -> text("Subtotal = ".$s_6.num_to_price($billing->billing_subtotal));
      $printer -> feed();

      foreach ($charge_type as $row){
        //
        if ($row->charge_type_id == '1') {
          $numb = "7";
          $charge_type_money = num_to_price($billing->billing_tax);
        }else if ($row->charge_type_id == '2') {
          $numb = "8";
          $charge_type_money = num_to_price($billing->billing_service);
        }else if ($row->charge_type_id == '3') {
          $numb = "9";
          $charge_type_money = num_to_price($billing->billing_other);
        }
        //
        $printer -> text($row->charge_type_name." = ".$s_[$numb].$charge_type_money);
        $printer -> feed();
      }

      //
      $printer -> feed();
      if ($client->client_is_taxed == 0){
        $name_total = "Total";
      }else {
        $name_total = "Total Bersih";
      }
      $printer -> text($name_total.' = '.$s_1.num_to_price($billing->billing_total));
      $printer -> feed();
      $printer -> text('Uang Muka = '.$s_2.num_to_price($billing->billing_down_payment));
      $printer -> feed();
      $printer -> text('Sisa Bayar = '.$s_3.num_to_price($billing->billing_total-$billing->billing_down_payment));
      $printer -> feed();
      $printer -> feed();
      $printer -> text('Dibayar = '.$s_4.num_to_price($billing->billing_payment));
      $printer -> feed();
      $printer -> text('Kembalian = '.$s_5.num_to_price($billing->billing_change));
      $printer -> feed();
      $printer -> feed();
      $printer -> text('Terimakasih atas kunjungan anda.');
      //
      $printer -> feed();
      $printer -> feed();
      $printer -> feed();
      $printer -> feed();

      /* Close printer */
      $printer -> close();
    } catch (Exception $e) {
      echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }
    //
    redirect(base_url().'hot_reservation');
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
    $room_type->room_type_charge = round($room_type->room_type_charge,0,PHP_ROUND_HALF_UP);

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
    $data['billing_date_in'] = ind_to_date($data['billing_date_in']);
    $data['billing_date_out'] = ind_to_date($data['billing_date_out']);

    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);
    $service = $this->m_hot_charge_type->get_by_id(2);
    $other = $this->m_hot_charge_type->get_by_id(3);
    $room = $this->m_hot_reservation->room_detail($data['room_id']);
    
    if ($client->client_is_taxed == 0) {
      // Setingan harga sebelum pajak
      $room_type_charge = price_to_num($data['room_type_charge']);
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
      
      $room_type_charge = (100/$tot_ratio)*$room_type_total;
    }

    $data_room = array(
      'billing_id' => $data['billing_id'],
      'room_id' => $room->room_id,
      'room_name' => $room->room_name,
      'room_type_id' => $room->room_type_id,
      'room_type_name' => $room->room_type_name,
      'room_type_charge' => $room_type_charge,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_room($data_room);

    $data_update = array(
      'billing_id' => $data['billing_id'],
      'billing_date_in' => $data['billing_date_in'],
      'billing_time_in' => $data['billing_time_in'],
      'billing_date_out' => $data['billing_date_out'],
      'billing_time_out' => $data['billing_time_out'],
    );
    $this->update_billing_room($data_update);
  }

  public function update_billing_room($data)
  {
    $in = $data['billing_date_in'].' '.$data['billing_time_in'];
    $out = $data['billing_date_out'].' '.$data['billing_time_out'];

    $client = $this->m_hot_client->get_all();
    $room = $this->m_hot_reservation->get_billing_room($data['billing_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);
    $service = $this->m_hot_charge_type->get_by_id(2);
    $other = $this->m_hot_charge_type->get_by_id(3);
    $room_type_duration = dateDifference($in,$out)+1;

    foreach ($room as $row) {
      $room_type_charge = $row->room_type_charge;
      $room_type_subtotal = $room_type_charge*$room_type_duration;
      $room_type_tax = $tax->charge_type_ratio*$room_type_subtotal/100;
  
      $room_type_service = 0;
      if ($service->is_active == 1) {
        $room_type_service = $service->charge_type_ratio*$room_type_subtotal/100;
      }
  
      $room_type_other = 0;
      if ($other->is_active == 1) {
        $room_type_other = $other->charge_type_ratio*$room_type_subtotal/100;
      }
  
      $room_type_total = $room_type_subtotal+$room_type_tax+$room_type_service+$room_type_other;

      $data_room = array(
        'room_type_duration' => $room_type_duration,
        'room_type_subtotal' => $room_type_subtotal,
        'room_type_tax' => $room_type_tax,
        'room_type_service' => $room_type_service,
        'room_type_other' => $room_type_other,
        'room_type_total' => $room_type_total,
        'created_by' => $this->session->userdata('user_realname')
      );

      $this->m_hot_reservation->update_billing_room($row->billing_room_id,$data_room);
    }
  }

  public function room_list()
  {
    $billing_id = $this->input->post('billing_id');
    $data = $this->m_hot_reservation->room_list($billing_id);

    echo json_encode($data);  
  }

  public function get_billing_room()
  {
    $data = $_POST;
    $data['billing_date_in'] = ind_to_date($data['billing_date_in']);
    $data['billing_date_out'] = ind_to_date($data['billing_date_out']);
    $this->update_billing_room($data);
    
    $client = $this->m_hot_client->get_all();
    $billing_id = $this->input->post('billing_id');
    $data2['room'] = $this->m_hot_reservation->get_billing_room($billing_id);
    $data2['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data2);
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

    $data->service_charge = round($data->service_charge,0,PHP_ROUND_HALF_UP);

    echo json_encode($data);
  }

  public function add_service()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $service = $this->m_hot_service->get_by_id($data['service_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) {
      $service_charge = price_to_num($data['service_charge']);
      $service_subtotal = $data['service_amount']*$service_charge;
      $service_tax = $service_subtotal*$tax->charge_type_ratio/100;
      $service_total = $service_subtotal+$service_tax;
    }else{
      $service_total = $data['service_amount']*price_to_num($data['service_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $service_tax = ($tax->charge_type_ratio/$tot_ratio)*$service_total;
      $service_subtotal = $service_total-$service_tax;
      $service_charge = $service_subtotal/$data['service_amount'];
    }

    $data_service = array(
      'billing_id' => $data['billing_id'],
      'service_id' => $service->service_id,
      'service_name' => $service->service_name,
      'service_charge' => $service_charge,
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

  public function get_non_tax()
  {
    $non_tax_id = $this->input->post('non_tax_id');
    
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $data = $this->m_hot_non_tax->get_by_id($non_tax_id);

    if ($client->client_is_taxed == 1) {
      $data->non_tax_charge += $data->non_tax_charge*$tax->charge_type_ratio/100;
    }

    echo json_encode($data);
  }

  public function add_non_tax()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $non_tax = $this->m_hot_non_tax->get_by_id($data['non_tax_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $non_tax_subtotal = $data['non_tax_amount']*$non_tax->non_tax_charge;
    $non_tax_tax = $non_tax_subtotal*$tax->charge_type_ratio/100;
    $non_tax_total = $non_tax_subtotal+$non_tax_tax;

    $data_non_tax = array(
      'billing_id' => $data['billing_id'],
      'non_tax_id' => $non_tax->non_tax_id,
      'non_tax_name' => $non_tax->non_tax_name,
      'non_tax_charge' => $non_tax->non_tax_charge,
      'non_tax_amount' => $data['non_tax_amount'],
      'non_tax_subtotal' => $non_tax_subtotal,
      'non_tax_tax' => $non_tax_tax,
      'non_tax_total' => $non_tax_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_non_tax($data_non_tax);
  }

  public function get_billing_non_tax()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['non_tax'] = $this->m_hot_reservation->get_billing_non_tax($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_non_tax()
  {
    $id = $this->input->post('billing_non_tax_id');
    $this->m_hot_reservation->delete_non_tax($id);
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
