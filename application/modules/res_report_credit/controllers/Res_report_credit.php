<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_report_credit extends MY_Restaurant {

  var $access, $report_credit_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_report_credit'){
      $this->session->set_userdata(array('menu' => 'res_report_credit'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_credit');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_report_credit';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_report_credit');
    $this->load->model('res_client/m_res_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Piutang';

      $this->view('res_report_credit/index',$data);
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
        redirect(base_url().'res_report_credit/annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'res_report_credit/monthly/'.$month);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'res_report_credit/weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'res_report_credit/daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'res_report_credit/range/'.$range);
        break;

    }
  }

  public function annual($year)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Piutang Tahun '.$year;
    $data['year'] = $year;

    $data['annual'] = $this->m_res_report_credit->annual($year);
    $this->view('annual', $data);
  }

  public function annual_pdf($year)
  {
    $data['title'] = 'Laporan Piutang Tahun '.$year;
    $data['annual'] = $this->m_res_report_credit->annual($year);
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-piutang-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function annual_print($year)
  {
    $title = "Laporan Piutang\nTahun ".$year;
    $client = $this->m_res_client->get_all();
    //
    $annual = $this->m_res_report_credit->annual($year);
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

      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_grand = 0;
      $i=1;
      foreach ($annual as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(month_name_ind($row->tx_month));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $before_left = "Penjualan(NonTax)";
        $before_right = num_to_price($row->tx_total_before_tax);
        $printer -> text(print_justify($before_left, $before_right, 17, 13, 2));
        //
        $pajak_left = "Pajak";
        $pajak_right = num_to_price($row->tx_total_tax);
        $printer -> text(print_justify($pajak_left, $pajak_right, 16, 13, 3));
        //
        $after_left = "Penjualan(Tax)";
        $after_right = num_to_price($row->tx_total_after_tax);
        $printer -> text(print_justify($after_left, $after_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->tx_total_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->tx_total_grand);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $tx_total_grand += $row->tx_total_grand;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Thn ".$year;
      $total_right = num_to_price($tx_total_grand);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      //
      $printer -> text("(NonTax) : Sebelum Pajak");
      $printer -> feed();
      $printer -> text("(Tax)    : Setelah Pajak");
      $printer -> feed(2);
      //
      $printer -> text("Dicetak  : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'res_report_credit/annual/'.$year);
  }

  public function monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Piutang Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['month'] = $month;

    $data['monthly'] = $this->m_res_report_credit->monthly($month);
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Piutang Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_res_report_credit->monthly($month);
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-piutang-bulan-".month_name_ind($num_month).' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function monthly_print($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];
    //
    $data['title'] = "Laporan Piutang\nBulan ".month_name_ind($num_month)." ".$raw[0];
    $client = $this->m_res_client->get_all();
    //
    $monthly = $this->m_res_report_credit->monthly($month);
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

      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_grand = 0;
      $i=1;
      foreach ($monthly as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->tx_date));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $before_left = "Penjualan(NonTax)";
        $before_right = num_to_price($row->tx_total_before_tax);
        $printer -> text(print_justify($before_left, $before_right, 17, 13, 2));
        //
        $pajak_left = "Pajak";
        $pajak_right = num_to_price($row->tx_total_tax);
        $printer -> text(print_justify($pajak_left, $pajak_right, 16, 13, 3));
        //
        $after_left = "Penjualan(Tax)";
        $after_right = num_to_price($row->tx_total_after_tax);
        $printer -> text(print_justify($after_left, $after_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->tx_total_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->tx_total_grand);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $tx_total_grand += $row->tx_total_grand;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Bln ".month_name_ind($num_month);
      $total_right = num_to_price($tx_total_grand);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      //
      $printer -> text("(NonTax) : Sebelum Pajak");
      $printer -> feed();
      $printer -> text("(Tax)    : Setelah Pajak");
      $printer -> feed(2);
      //
      $printer -> text("Dicetak  : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'res_report_credit/monthly/'.$month);
  }

  public function weekly($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Piutang Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['weekly'] = $this->m_res_report_credit->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start, $date_end)
  {
    $data['title'] = 'Laporan Penjualan Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_res_report_credit->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function weekly_print($date_start, $date_end)
  {
    $title = "Laporan Penjualan Mingguan\n(".$date_start." - ".$date_end.")";
    $client = $this->m_res_client->get_all();
    //
    $weekly = $this->m_res_report_credit->weekly(ind_to_date($date_start),ind_to_date($date_end));
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

      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_grand = 0;
      $i=1;
      foreach ($weekly as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->tx_date));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $before_left = "Penjualan(NonTax)";
        $before_right = num_to_price($row->tx_total_before_tax);
        $printer -> text(print_justify($before_left, $before_right, 17, 13, 2));
        //
        $pajak_left = "Pajak";
        $pajak_right = num_to_price($row->tx_total_tax);
        $printer -> text(print_justify($pajak_left, $pajak_right, 16, 13, 3));
        //
        $after_left = "Penjualan(Tax)";
        $after_right = num_to_price($row->tx_total_after_tax);
        $printer -> text(print_justify($after_left, $after_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->tx_total_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->tx_total_grand);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $tx_total_grand += $row->tx_total_grand;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Mingguan";
      $total_right = num_to_price($tx_total_grand);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      //
      $printer -> text("(NonTax) : Sebelum Pajak");
      $printer -> feed();
      $printer -> text("(Tax)    : Setelah Pajak");
      $printer -> feed(2);
      //
      $printer -> text("Dicetak  : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'res_report_credit/weekly/'.$date_start.'/'.$date_end);
  }

  public function daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Piutang Tanggal '.date_to_ind($date);
    $data['date'] = $date;

    $data['daily'] = $this->m_res_report_credit->daily($date);
    $this->view('daily', $data);
  }

  public function daily_pdf($date)
  {
    $data['title'] = 'Laporan Piutang Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_res_report_credit->daily($date);
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-piutang-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function daily_print($date)
  {
    $title = "Laporan Piutang\nTanggal ".date_to_ind($date);
    $client = $this->m_res_client->get_all();
    //
    $daily = $this->m_res_report_credit->daily($date);
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

      $total_before_tax = 0;
      $total_discount = 0;
      $total_tax = 0;
      $total_grand = 0;
      $i=1;
      foreach ($daily as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text($row->tx_type.'-'.$row->tx_receipt_no);
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $waktu_left = "Waktu";
        $waktu_right = $row->tx_time;
        $printer -> text(print_justify($waktu_left, $waktu_right, 16, 13, 3));
        //
        if ($row->tx_status == -2) {
          $status = "Batal";
        }else if ($row->tx_status == -1) {
          $status = "Tahan";
        }else if ($row->tx_status == 0) {
          $status = "Proses";
        }else if ($row->tx_status == 1) {
          $status = "Sukses";
        }
        //
        $status_left = "Status";
        $status_right = $status;
        $printer -> text(print_justify($status_left, $status_right, 16, 13, 3));
        //
        $subtotal_left = "Subtotal";
        $subtotal_right = num_to_price($row->tx_total_before_tax);
        $printer -> text(print_justify($subtotal_left, $subtotal_right, 16, 13, 3));
        //
        $pajak_left = "Pajak";
        $pajak_right = num_to_price($row->tx_total_tax);
        $printer -> text(print_justify($pajak_left, $pajak_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->tx_total_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->tx_total_grand);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $tx_total_grand += $row->tx_total_grand;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Tgl ".date_to_ind($date);
      $total_right = num_to_price($tx_total_grand);
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
    redirect(base_url().'res_report_credit/daily/'.$date);
  }

  public function range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Piutang Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['range'] = $this->m_res_report_credit->range(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('range', $data);
  }

  public function range_pdf($date_start, $date_end)
  {
    $data['title'] = 'Laporan Piutang Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_res_report_credit->range(ind_to_date($date_start),ind_to_date($date_end));
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-piutang-rentang-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

  public function range_print($date_start, $date_end)
  {
    $title = "Laporan Piutang Tanggal\n(".$date_start." - ".$date_end.")";
    $client = $this->m_res_client->get_all();
    //
    $range = $this->m_res_report_credit->range(ind_to_date($date_start),ind_to_date($date_end));
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

      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_grand = 0;
      $i=1;
      foreach ($range as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->tx_date));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        //
        $before_left = "Penjualan(NonTax)";
        $before_right = num_to_price($row->tx_total_before_tax);
        $printer -> text(print_justify($before_left, $before_right, 17, 13, 2));
        //
        $pajak_left = "Pajak";
        $pajak_right = num_to_price($row->tx_total_tax);
        $printer -> text(print_justify($pajak_left, $pajak_right, 16, 13, 3));
        //
        $after_left = "Penjualan(Tax)";
        $after_right = num_to_price($row->tx_total_after_tax);
        $printer -> text(print_justify($after_left, $after_right, 16, 13, 3));
        //
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->tx_total_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $printer -> text('--------------------------------');
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $total_left = "Total";
        $total_right = num_to_price($row->tx_total_grand);
        $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> text('--------------------------------');
        //
        $tx_total_grand += $row->tx_total_grand;
      }

      $printer -> text('--------------------------------');
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Total Semua";
      $total_right = num_to_price($tx_total_grand);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> text('--------------------------------');
      $printer -> feed();
      //
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      //
      $printer -> text("(NonTax) : Sebelum Pajak");
      $printer -> feed();
      $printer -> text("(Tax)    : Setelah Pajak");
      $printer -> feed(2);
      //
      $printer -> text("Dicetak  : ".date_to_ind($date)." ".$time);
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
    redirect(base_url().'res_report_credit/range/'.$date_start.'/'.$date_end);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_res_report_credit->detail($tx_id);
    $this->view('detail', $data);

  }

  public function frame_pdf()
  {
    $data = $_POST;
    $this->view('res_report_credit/frame_pdf', $data);
  }

}
