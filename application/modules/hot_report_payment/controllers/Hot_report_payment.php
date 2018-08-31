<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_report_payment extends MY_Hotel {

  var $access, $report_selling_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_report_payment'){
      $this->session->set_userdata(array('menu' => 'hot_report_payment'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_report_payment';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_hot_report_payment');
    $this->load->model('hot_client/m_hot_client');
    //
    $this->load->model('hot_charge_type/m_hot_charge_type');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Reservasi';

      $this->view('hot_report_payment/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function action()
  {
    $data = $_POST;

    switch ($data['type']) {

      case 'annual':
        $year = $data['year'];
        redirect(base_url().'hot_report_payment/annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'hot_report_payment/monthly/'.$month);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'hot_report_payment/weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'hot_report_payment/daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'hot_report_payment/range/'.$range);
        break;

    }
  }

  public function annual($year)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Reservasi Tahun '.$year;
    $data['year'] = $year;
    //
    $data['annual'] = $this->m_hot_report_payment->annual($year);
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('annual', $data);
  }

  public function annual_pdf($year)
  {
    $data['title'] = 'Laporan Reservasi Tahun '.$year;
    $data['annual'] = $this->m_hot_report_payment->annual($year);
    $data['client'] = $this->m_hot_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function annual_print($year)
  {
    $title = 'Laporan Reservasi Tahun '.$year;
    $client = $this->m_hot_client->get_all();
    //
    $annual = $this->m_hot_report_payment->annual($year);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();
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
      $printer -> text('--------------------------------');
      //Judul
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text($title."\n");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');

      $billing_subtotal = 0;
      $billing_tax = 0;
      $billing_service = 0;
      $billing_other = 0;
      $total_tax = 0;
      $total_service = 0;
      $total_other = 0;
      $billing_total = 0;
      $i=1;
      foreach ($annual as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(month_name_ind($row->tx_month));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($row->billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = "0";
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $grand_total_tax = 0;
        foreach ($charge_type as $data){
          //
          if ($data['charge_type_id'] == '1') {
            $billing_charge_type = $row->billing_tax;
          }else if ($data['charge_type_id'] == '2') {
            $billing_charge_type = $row->billing_service;
          }else if ($data['charge_type_id'] == '3') {
            $billing_charge_type = $row->billing_other;
          }
          //
          $charge_type_left = $data['charge_type_name'];
          $charge_type_right = num_to_price($billing_charge_type);
          $printer -> text(print_justify($charge_type_left, $charge_type_right, 16, 13, 3));
        }
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->billing_total);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $billing_total += $row->billing_total;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Thn ".$year;
      $total_right = num_to_price($billing_total);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Dicetak : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'hot_report_payment/annual/'.$year);
  }

  public function monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];
    //
    $data['year'] = $raw[0];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Reservasi Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['month'] = $month;

    $data['monthly'] = $this->m_hot_report_payment->monthly($month);
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Reservasi Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_hot_report_payment->monthly($month);
    $data['client'] = $this->m_hot_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-bulan-".month_name_ind($num_month).' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function monthly_print($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];
    //
    $title = "Laporan Reservasi Bulan ".month_name_ind($num_month)."\n".$raw[0];
    $client = $this->m_hot_client->get_all();
    //
    $monthly = $this->m_hot_report_payment->monthly($month);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();
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
      $printer -> text('--------------------------------');
      //Judul
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text($title."\n");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');

      $billing_subtotal = 0;
      $billing_tax = 0;
      $billing_service = 0;
      $billing_other = 0;
      $total_tax = 0;
      $total_service = 0;
      $total_other = 0;
      $billing_total = 0;
      $i=1;
      foreach ($monthly as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->billing_date_in));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($row->billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = "0";
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $grand_total_tax = 0;
        foreach ($charge_type as $data){
          //
          if ($data['charge_type_id'] == '1') {
            $billing_charge_type = $row->billing_tax;
          }else if ($data['charge_type_id'] == '2') {
            $billing_charge_type = $row->billing_service;
          }else if ($data['charge_type_id'] == '3') {
            $billing_charge_type = $row->billing_other;
          }
          //
          $charge_type_left = $data['charge_type_name'];
          $charge_type_right = num_to_price($billing_charge_type);
          $printer -> text(print_justify($charge_type_left, $charge_type_right, 16, 13, 3));
        }
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->billing_total);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $billing_total += $row->billing_total;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Bln ".month_name_ind($num_month);
      $total_right = num_to_price($billing_total);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Dicetak : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'hot_report_payment/monthly/'.$month);
  }

  public function weekly($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Reservasi Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['weekly'] = $this->m_hot_report_payment->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start, $date_end)
  {
    $data['title'] = 'Laporan Reservasi Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_hot_report_payment->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $data['client'] = $this->m_hot_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function weekly_print($date_start, $date_end)
  {
    $title = "Laporan Reservasi Mingguan \n (".$date_start." - ".$date_end.")";
    $client = $this->m_hot_client->get_all();
    //
    $weekly = $this->m_hot_report_payment->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();
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
      $printer -> text('--------------------------------');
      //Judul
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text($title."\n");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');

      $billing_subtotal = 0;
      $billing_tax = 0;
      $billing_service = 0;
      $billing_other = 0;
      $total_tax = 0;
      $total_service = 0;
      $total_other = 0;
      $billing_total = 0;
      $i=1;
      foreach ($weekly as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->billing_date_in));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($row->billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = "0";
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $grand_total_tax = 0;
        foreach ($charge_type as $data){
          //
          if ($data['charge_type_id'] == '1') {
            $billing_charge_type = $row->billing_tax;
          }else if ($data['charge_type_id'] == '2') {
            $billing_charge_type = $row->billing_service;
          }else if ($data['charge_type_id'] == '3') {
            $billing_charge_type = $row->billing_other;
          }
          //
          $charge_type_left = $data['charge_type_name'];
          $charge_type_right = num_to_price($billing_charge_type);
          $printer -> text(print_justify($charge_type_left, $charge_type_right, 16, 13, 3));
        }
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->billing_total);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $billing_total += $row->billing_total;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Mingguan ".month_name_ind($num_month);
      $total_right = num_to_price($billing_total);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Dicetak : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'hot_report_payment/weekly/'.$date_start.'/'.$date_end);
  }

  public function daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Reservasi Tanggal '.date_to_ind($date);
    $data['date'] = $date;
    //
    $raw = $raw = explode("-", $date);
    $data['month'] = $raw[0].'-'.$raw[1];
    //

    $data['daily'] = $this->m_hot_report_payment->daily($date);
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('daily', $data);
  }

  public function daily_pdf($date)
  {
    $data['title'] = 'Laporan Reservasi Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_hot_report_payment->daily($date);
    $data['client'] = $this->m_hot_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function daily_print($date)
  {
    $title = "Laporan Reservasi Tanggal \n".date_to_ind($date);
    $client = $this->m_hot_client->get_all();
    //
    $daily = $this->m_hot_report_payment->daily($date);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();
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
      $printer -> text('--------------------------------');
      //Judul
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text($title."\n");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');

      $billing_subtotal = 0;
      $billing_tax = 0;
      $billing_service = 0;
      $billing_other = 0;
      $total_tax = 0;
      $total_service = 0;
      $total_other = 0;
      $billing_total = 0;
      $i=1;
      foreach ($daily as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("TRS - ".$row->billing_receipt_no);
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $nama_tamu_left = "Nama Tamu";
        $nama_tamu_right = substr($row->guest_name,0,13);
        $printer -> text(print_justify($nama_tamu_left, $nama_tamu_right, 16, 13, 3));
        //
        $status_left = "Status";
        switch ($row->billing_status) {
          case '-1':
            $status_right = "Batal";
            break;

          case '1':
            $status_right = "Proses";
            break;

          case '2':
            $status_right = "Selesai";
            break;
        }
        $printer -> text(print_justify($status_left, $status_right, 16, 13, 3));
        //
        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($row->billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = "0";
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $grand_total_tax = 0;
        foreach ($charge_type as $data){
          //
          if ($data['charge_type_id'] == '1') {
            $billing_charge_type = $row->billing_tax;
          }else if ($data['charge_type_id'] == '2') {
            $billing_charge_type = $row->billing_service;
          }else if ($data['charge_type_id'] == '3') {
            $billing_charge_type = $row->billing_other;
          }
          //
          $charge_type_left = $data['charge_type_name'];
          $charge_type_right = num_to_price($billing_charge_type);
          $printer -> text(print_justify($charge_type_left, $charge_type_right, 16, 13, 3));
        }
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->billing_total);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $billing_total += $row->billing_total;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Tgl ".date_to_ind($date);
      $total_right = num_to_price($billing_total);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date_now = date("Y-m-d");
      $time_now = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Dicetak : ".date_to_ind($date_now)." ".$time_now);
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
    redirect(base_url().'hot_report_payment/daily/'.$date);
  }

  public function range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Reservasi Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['range'] = $this->m_hot_report_payment->range(ind_to_date($date_start),ind_to_date($date_end));
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('range', $data);
  }

  public function range_pdf($date_start, $date_end)
  {
    $data['title'] = 'Laporan Reservasi Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_hot_report_payment->range(ind_to_date($date_start),ind_to_date($date_end));
    $data['client'] = $this->m_hot_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-rentang-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

  public function range_print($date_start, $date_end)
  {
    $title = "Laporan Reservasi Tanggal \n ".$date_start." - ".$date_end;
    $client = $this->m_hot_client->get_all();
    //
    $range = $this->m_hot_report_payment->range(ind_to_date($date_start),ind_to_date($date_end));
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();
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
      $printer -> text('--------------------------------');
      //Judul
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text($title."\n");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');

      $billing_subtotal = 0;
      $billing_tax = 0;
      $billing_service = 0;
      $billing_other = 0;
      $total_tax = 0;
      $total_service = 0;
      $total_other = 0;
      $billing_total = 0;
      $i=1;
      foreach ($range as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->billing_date_in));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($row->billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = "0";
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $grand_total_tax = 0;
        foreach ($charge_type as $data){
          //
          if ($data['charge_type_id'] == '1') {
            $billing_charge_type = $row->billing_tax;
          }else if ($data['charge_type_id'] == '2') {
            $billing_charge_type = $row->billing_service;
          }else if ($data['charge_type_id'] == '3') {
            $billing_charge_type = $row->billing_other;
          }
          //
          $charge_type_left = $data['charge_type_name'];
          $charge_type_right = num_to_price($billing_charge_type);
          $printer -> text(print_justify($charge_type_left, $charge_type_right, 16, 13, 3));
        }
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->billing_total);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $billing_total += $row->billing_total;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Semua ".month_name_ind($num_month);
      $total_right = num_to_price($billing_total);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Dicetak : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'hot_report_payment/range/'.$date_start.'/'.$date_end);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_hot_report_payment->detail($tx_id);
    $this->view('detail', $data);

  }

}
