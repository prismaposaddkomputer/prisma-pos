<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_report_receptionist extends MY_Hotel {

  var $access, $report_selling_user_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_report_receptionist'){
      $this->session->set_userdata(array('menu' => 'hot_report_receptionist'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling_user');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_report_receptionist';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_hot_report_receptionist');
    $this->load->model('hot_user/m_hot_user');
    $this->load->model('hot_client/m_hot_client');
    $this->load->model('hot_charge_type/m_hot_charge_type');
    $this->load->model('hot_reservation/m_hot_reservation');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Reservasi Resepsionis';
      $data['user'] = $this->m_hot_user->get_all();

      $this->view('hot_report_receptionist/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function action()
  {
    $data = $_POST;
    $user_id = $data['user_id'];

    switch ($data['type']) {

      case 'annual':
        $year = $data['year'];
        redirect(base_url().'hot_report_receptionist/annual/'.$year.'/'.$user_id);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'hot_report_receptionist/monthly/'.$month.'/'.$user_id);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'hot_report_receptionist/weekly/'.$week.'/'.$user_id);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'hot_report_receptionist/daily/'.$date.'/'.$user_id);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'hot_report_receptionist/range/'.$range.'/'.$user_id);
        break;

    }
  }

  public function annual($year,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['title'] = 'Laporan Reservasi Resepsionis "'.$user->user_realname.'" Tahun '.$year;
    $data['annual'] = $this->m_hot_report_receptionist->annual($year,$user_id);
    $data['year'] = $year;
    $data['user_id'] = $user_id;

    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    $data['client'] = $this->m_hot_client->get_all();
    //

    $this->view('annual', $data);
  }

  public function annual_pdf($year,$user_id)
  {
    $data['title'] = 'Laporan Reservasi Resepsionis Tahun '.$year;
    $data['annual'] = $this->m_hot_report_receptionist->annual($year,$user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['user'] = $user;
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function annual_print($year,$user_id)
  { 
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $title = "Laporan Reservasi Resepsionis\n'".$user->user_realname."'\nTahun ".$year;
    $client = $this->m_hot_client->get_all();
    //
    $annual = $this->m_hot_report_receptionist->annual($year,$user_id);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();

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
      $billing_discount = 0;
      $billing_denda = 0;
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
        if ($client->client_is_taxed == 0){
          $after_billing_subtotal = $row->billing_subtotal;
        }else{
          $after_billing_subtotal = ($row->billing_subtotal) + ($row->billing_tax + $row->billing_service + $row->billing_other) + ($row->billing_discount);
        }

        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($after_billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->billing_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $denda_left = "Denda";
        $denda_right = num_to_price($row->billing_denda);
        $printer -> text(print_justify($denda_left, $denda_right, 16, 13, 3));
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
      $total_left = "Total Kasir\n'".$user->user_realname."'";
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
    redirect(base_url().'hot_report_receptionist/annual/'.$year.'/'.$user_id);
  }

  public function monthly($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['year'] = $raw[0];

    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['title'] = 'Laporan Reservasi Resepsionis "'.$user->user_realname.'" Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['month'] = $month;
    $data['user_id'] = $user_id;

    $data['monthly'] = $this->m_hot_report_receptionist->monthly($month,$user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Reservasi Resepsionis Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_hot_report_receptionist->monthly($month,$user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['user'] = $user;
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$user->user_realname.')-kasir-".$month.' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function monthly_print($month,$user_id)
  { 
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];
    //
    $title = "Laporan Reservasi Resepsionis\n'".$user->user_realname."'\nBulan ".month_name_ind($num_month)." ".$raw[0];
    $client = $this->m_hot_client->get_all();
    //
    $monthly = $this->m_hot_report_receptionist->monthly($month,$user_id);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();

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
      $billing_discount = 0;
      $billing_denda = 0;
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
        if ($client->client_is_taxed == 0){
          $after_billing_subtotal = $row->billing_subtotal;
        }else{
          $after_billing_subtotal = ($row->billing_subtotal) + ($row->billing_tax + $row->billing_service + $row->billing_other) + ($row->billing_discount);
        }

        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($after_billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->billing_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $denda_left = "Denda";
        $denda_right = num_to_price($row->billing_denda);
        $printer -> text(print_justify($denda_left, $denda_right, 16, 13, 3));
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
      $total_left = "Total Kasir\n'".$user->user_realname."'";
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
    redirect(base_url().'hot_report_receptionist/monthly/'.$month.'/'.$user_id);
  }

  public function weekly($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['title'] = 'Laporan Reservasi Resepsionis "'.$user->user_realname.'" Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $data['weekly'] = $this->m_hot_report_receptionist->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start,$date_end,$user_id)
  {
    $data['title'] = 'Laporan Reservasi Resepsionis Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_hot_report_receptionist->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['user'] = $user;
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function weekly_print($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $title = "Laporan Reservasi Resepsionis\n'".$user->user_realname."'\nMingguan ".$date_start." - ".$date_end;
    $client = $this->m_hot_client->get_all();
    //
    $weekly = $this->m_hot_report_receptionist->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();

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
      $billing_discount = 0;
      $billing_denda = 0;
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
        if ($client->client_is_taxed == 0){
          $after_billing_subtotal = $row->billing_subtotal;
        }else{
          $after_billing_subtotal = ($row->billing_subtotal) + ($row->billing_tax + $row->billing_service + $row->billing_other) + ($row->billing_discount);
        }

        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($after_billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->billing_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $denda_left = "Denda";
        $denda_right = num_to_price($row->billing_denda);
        $printer -> text(print_justify($denda_left, $denda_right, 16, 13, 3));
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
          }          //
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
      $total_left = "Total Kasir\n'".$user->user_realname."'";
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
    redirect(base_url().'hot_report_receptionist/weekly/'.$date_start.'/'.$date_end.'/'.$user_id);
  }

  public function daily($date, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['title'] = 'Laporan Reservasi Resepsionis "'.$user->user_realname.'" Tanggal '.date_to_ind($date);
    $data['date'] = $date;
    $data['user_id'] = $user_id;

    $raw = $raw = explode("-", $date);
    $data['month'] = $raw[0].'-'.$raw[1];

    $data['daily'] = $this->m_hot_report_receptionist->daily($date, $user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('daily', $data);
  }

  public function daily_pdf($date,$user_id)
  {
    $data['title'] = 'Laporan Reservasi Resepsionis Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_hot_report_receptionist->daily($date, $user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['user'] = $user;
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function daily_print($date, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $title = "Laporan Reservasi Resepsionis\n'".$user->user_realname."'\nTanggal ".date_to_ind($date);
    $client = $this->m_hot_client->get_all();
    //
    $daily = $this->m_hot_report_receptionist->daily($date, $user_id);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();

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
      $billing_discount = 0;
      $billing_denda = 0;
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
        if ($client->client_is_taxed == 0){
          $after_billing_subtotal = $row->billing_subtotal;
        }else{
          $after_billing_subtotal = ($row->billing_subtotal) + ($row->billing_tax + $row->billing_service + $row->billing_other) + ($row->billing_discount);
        }

        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($after_billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->billing_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $denda_left = "Denda";
        $denda_right = num_to_price($row->billing_denda);
        $printer -> text(print_justify($denda_left, $denda_right, 16, 13, 3));
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
      $total_left = "Total Kasir\n'".$user->user_realname."'";
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
    redirect(base_url().'hot_report_receptionist/daily/'.$date.'/'.$user_id);
  }

  public function range($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['title'] = 'Laporan Reservasi Resepsionis "'.$user->user_realname.'" Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $data['range'] = $this->m_hot_report_receptionist->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();
    //
    $this->view('range', $data);
  }

  public function range_pdf($date_start,$date_end,$user_id)
  {
    $data['title'] = 'Laporan Reservasi Resepsionis Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_hot_report_receptionist->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_hot_client->get_all();
    $user = $this->m_hot_user->get_by_id($user_id);
    $data['user'] = $user;
    $data['charge_type'] = $this->m_hot_charge_type->list_data_except_tax_hotel();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-rentang-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';
    $data['id'] = $tx_id;

    $data['billing'] = $this->m_hot_reservation->get_billing($tx_id);
    $data['charge_type'] = $this->m_hot_charge_type->get_all();
    $this->view('detail', $data);

  }

  public function range_print($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_hot_user->get_by_id($user_id);
    $title = "Laporan Reservasi Resepsionis\n".$user->user_realname."\nTanggal ".$date_start." - ".$date_end;
    $client = $this->m_hot_client->get_all();
    //
    $range = $this->m_hot_report_receptionist->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $charge_type = $this->m_hot_charge_type->list_data_except_tax_hotel();

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
      $billing_discount = 0;
      $billing_denda = 0;
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
        if ($client->client_is_taxed == 0){
          $after_billing_subtotal = $row->billing_subtotal;
        }else{
          $after_billing_subtotal = ($row->billing_subtotal) + ($row->billing_tax + $row->billing_service + $row->billing_other) + ($row->billing_discount);
        }

        $sub_total_left = "Sub Total";
        $sub_total_right = num_to_price($after_billing_subtotal);
        $printer -> text(print_justify($sub_total_left, $sub_total_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->billing_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $denda_left = "Denda";
        $denda_right = num_to_price($row->billing_denda);
        $printer -> text(print_justify($denda_left, $denda_right, 16, 13, 3));
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
      $total_left = "Total Kasir\n'".$user->user_realname."'";
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
    redirect(base_url().'hot_report_receptionist/range/'.$date_start.'/'.$date_end.'/'.$user_id);
  }

  public function frame_pdf()
  {
    $data = $_POST;
    $this->view('hot_report_receptionist/frame_pdf', $data);
  }

}
