<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_report_selling_user extends MY_Restaurant {

  var $access, $report_selling_user_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_report_selling_user'){
      $this->session->set_userdata(array('menu' => 'res_report_selling_user'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling_user');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_report_selling_user';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_report_selling_user');
    $this->load->model('res_user/m_res_user');
    $this->load->model('res_client/m_res_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penjualan Kasir';
      $data['user'] = $this->m_res_user->get_all();

      $this->view('res_report_selling_user/index',$data);
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
        redirect(base_url().'res_report_selling_user/annual/'.$year.'/'.$user_id);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'res_report_selling_user/monthly/'.$month.'/'.$user_id);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'res_report_selling_user/weekly/'.$week.'/'.$user_id);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'res_report_selling_user/daily/'.$date.'/'.$user_id);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'res_report_selling_user/range/'.$range.'/'.$user_id);
        break;

    }
  }

  public function annual($year,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Tahun '.$year;
    $data['annual'] = $this->m_res_report_selling_user->annual($year,$user_id);
    $data['year'] = $year;
    $data['user_id'] = $user_id;

    $this->view('annual', $data);
  }

  public function annual_pdf($year,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Tahun '.$year;
    $data['annual'] = $this->m_res_report_selling_user->annual($year,$user_id);
    $data['client'] = $this->m_res_client->get_all();
    $user = $this->m_res_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function annual_print($year, $user_id)
  {
    $user = $this->m_res_user->get_by_id($user_id);
    $title = "Laporan Penjualan Kasir\n'".$user->user_realname."' \nTahun ".$year;
    $client = $this->m_res_client->get_all();
    //
    $annual = $this->m_res_report_selling_user->annual($year,$user_id);
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

      $tx_total_buy_average = 0;
      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_profit_before_tax = 0;
      $tx_total_profit_after_tax = 0;
      $i=1;
      foreach ($annual as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(month_name_ind($row->tx_month));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        $pembelian_left = "Pembelian";
        $pembelian_right = num_to_price($row->tx_total_buy_average);
        $printer -> text(print_justify($pembelian_left, $pembelian_right, 16, 13, 3));
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
        $keuntungannontax_left = "Keuntungan(NonTax)";
        $keuntungannontax_right = num_to_price($row->tx_total_profit_before_tax);
        $printer -> text(print_justify($keuntungannontax_left, $keuntungannontax_right, 18, 13, 1));
        //
        $keuntungantax_left = "Keuntungan(Tax)";
        $keuntungantax_right = num_to_price($row->tx_total_profit_after_tax);
        $printer -> text(print_justify($keuntungantax_left, $keuntungantax_right, 16, 13, 3));
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
    redirect(base_url().'res_report_selling_user/annual/'.$year.'/'.$user_id);
  }

  public function monthly($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Bulan '.month_name_ind($num_month).' '.$raw[0];;
    $data['month'] = $month;
    $data['user_id'] = $user_id;

    $data['monthly'] = $this->m_res_report_selling_user->monthly($month,$user_id);
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Penjualan Kasir Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_res_report_selling_user->monthly($month,$user_id);
    $data['client'] = $this->m_res_client->get_all();
    $user = $this->m_res_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$user->user_realname.')-kasir-".$month.' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function monthly_print($month, $user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $user = $this->m_res_user->get_by_id($user_id);
    $title = "Laporan Penjualan Kasir\n'".$user->user_realname."'\nBulan ".month_name_ind($num_month)." ".$raw[0];
    $client = $this->m_res_client->get_all();
    //
    $monthly = $this->m_res_report_selling_user->monthly($month,$user_id);
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

      $tx_total_buy_average = 0;
      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_profit_before_tax = 0;
      $tx_total_profit_after_tax = 0;
      $i=1;
      foreach ($monthly as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->tx_date));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        $pembelian_left = "Pembelian";
        $pembelian_right = num_to_price($row->tx_total_buy_average);
        $printer -> text(print_justify($pembelian_left, $pembelian_right, 16, 13, 3));
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
        $keuntungannontax_left = "Keuntungan(NonTax)";
        $keuntungannontax_right = num_to_price($row->tx_total_profit_before_tax);
        $printer -> text(print_justify($keuntungannontax_left, $keuntungannontax_right, 18, 13, 1));
        //
        $keuntungantax_left = "Keuntungan(Tax)";
        $keuntungantax_right = num_to_price($row->tx_total_profit_after_tax);
        $printer -> text(print_justify($keuntungantax_left, $keuntungantax_right, 16, 13, 3));
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
    redirect(base_url().'res_report_selling_user/monthly/'.$month.'/'.$user_id);
  }

  public function weekly($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $data['weekly'] = $this->m_res_report_selling_user->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start,$date_end,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_res_report_selling_user->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_res_client->get_all();
    $user = $this->m_res_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function weekly_print($date_start, $date_end, $user_id)
  {
    $user = $this->m_res_user->get_by_id($user_id);
    $title = "Laporan Penjualan Kasir\n'".$user->user_realname."'\nMingguan\n(".$date_start." - ".$date_end.")";
    $client = $this->m_res_client->get_all();
    //
    $weekly = $this->m_res_report_selling_user->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
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

      $tx_total_buy_average = 0;
      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_profit_before_tax = 0;
      $tx_total_profit_after_tax = 0;
      $i=1;
      foreach ($weekly as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->tx_date));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        $pembelian_left = "Pembelian";
        $pembelian_right = num_to_price($row->tx_total_buy_average);
        $printer -> text(print_justify($pembelian_left, $pembelian_right, 16, 13, 3));
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
        $keuntungannontax_left = "Keuntungan(NonTax)";
        $keuntungannontax_right = num_to_price($row->tx_total_profit_before_tax);
        $printer -> text(print_justify($keuntungannontax_left, $keuntungannontax_right, 18, 13, 1));
        //
        $keuntungantax_left = "Keuntungan(Tax)";
        $keuntungantax_right = num_to_price($row->tx_total_profit_after_tax);
        $printer -> text(print_justify($keuntungantax_left, $keuntungantax_right, 16, 13, 3));
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
    redirect(base_url().'res_report_selling_user/weekly/'.$date_start.'/'.$date_end.'/'.$user_id);
  }

  public function daily($date, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Tanggal '.date_to_ind($date);
    $data['date'] = $date;
    $data['user_id'] = $user_id;

    $data['daily'] = $this->m_res_report_selling_user->daily($date, $user_id);
    $this->view('daily', $data);
  }

  public function daily_pdf($date,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_res_report_selling_user->daily($date, $user_id);
    $data['client'] = $this->m_res_client->get_all();
    $user = $this->m_res_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function daily_print($date, $user_id)
  {
    $user = $this->m_res_user->get_by_id($user_id);
    $title = "Laporan Penjualan Kasir\n'".$user->user_realname."'\nTanggal\n".date_to_ind($date);
    $client = $this->m_res_client->get_all();
    //
    $daily = $this->m_res_report_selling_user->daily($date, $user_id);
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
        $diskon_left = "Diskon";
        $diskon_right = num_to_price($row->tx_total_discount);
        $printer -> text(print_justify($diskon_left, $diskon_right, 16, 13, 3));
        //
        $pajak_left = "Pajak";
        $pajak_right = num_to_price($row->tx_total_tax);
        $printer -> text(print_justify($pajak_left, $pajak_right, 16, 13, 3));
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
      $total_left = "Total Tgl ".$date;
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
    redirect(base_url().'res_report_selling_user/daily/'.$date.'/'.$user_id);
  }

  public function daily_print_only_nominal($date, $user_id)
  {
    $user = $this->m_res_user->get_by_id($user_id);
    $title = "Laporan Penjualan Hanya Nominal\n'".$user->user_realname."'\nTanggal ".date_to_ind($date);
    $client = $this->m_res_client->get_all();
    //
    $daily = $this->m_res_report_selling_user->daily($date, $user_id);
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
        $tx_total_before_tax += $row->tx_total_before_tax;
        $tx_total_tax += $row->tx_total_tax;
        $tx_total_discount += $row->tx_total_discount;
        $tx_total_grand += $row->tx_total_grand;
      }

      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $total_left = "Subtotal ";
      $total_right = num_to_price($tx_total_before_tax);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $total_left = "Pajak ";
      $total_right = num_to_price($tx_total_tax);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $total_left = "Diskon ";
      $total_right = num_to_price($tx_total_discount);
      $printer -> text(print_justify($total_left, $total_right, 16, 13, 3));
      $printer -> text('--------------------------------');
      $total_left = "Total ";
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
    redirect(base_url().'res_report_selling_user/daily/'.$date.'/'.$user_id);
  }

  public function daily_print_per_item($date, $user_id)
  {
    $user = $this->m_res_user->get_by_id($user_id);
    $title = "Laporan Penjualan Per Item\n'".$user->user_realname."'\nTanggal ".date_to_ind($date);
    $client = $this->m_res_client->get_all();
    //
    $most_sell = $this->m_res_report_selling_user->most_sell($date, $user_id);
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

      $i=1;
      foreach ($most_sell as $row){

        $status_left = $row->item_name;
        $status_right = $row->tx_amount;
        $printer -> text(print_justify($status_left, $status_right, 16, 13, 3));

      }

      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);

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
    redirect(base_url().'res_report_selling_user/daily/'.$date.'/'.$user_id);
  }

  public function range($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $data['range'] = $this->m_res_report_selling_user->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('range', $data);
  }

  public function range_pdf($date_start,$date_end,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_res_report_selling_user->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_res_client->get_all();
    $user = $this->m_res_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-rentang-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

  public function range_print($date_start, $date_end, $user_id)
  {
    $user = $this->m_res_user->get_by_id($user_id);
    $title = "Laporan Penjualan Kasir\n'".$user->user_realname."'\nTanggal\n(".$date_start." - ".$date_end.")";
    $client = $this->m_res_client->get_all();
    //
    $range = $this->m_res_report_selling_user->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
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

      $tx_total_buy_average = 0;
      $tx_total_before_tax = 0;
      $tx_total_tax = 0;
      $tx_total_after_tax = 0;
      $tx_total_discount = 0;
      $tx_total_profit_before_tax = 0;
      $tx_total_profit_after_tax = 0;
      $i=1;
      foreach ($range as $row){
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text(date_to_ind($row->tx_date));
        $printer -> feed();
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();

        $pembelian_left = "Pembelian";
        $pembelian_right = num_to_price($row->tx_total_buy_average);
        $printer -> text(print_justify($pembelian_left, $pembelian_right, 16, 13, 3));
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
        $keuntungannontax_left = "Keuntungan(NonTax)";
        $keuntungannontax_right = num_to_price($row->tx_total_profit_before_tax);
        $printer -> text(print_justify($keuntungannontax_left, $keuntungannontax_right, 18, 13, 1));
        //
        $keuntungantax_left = "Keuntungan(Tax)";
        $keuntungantax_right = num_to_price($row->tx_total_profit_after_tax);
        $printer -> text(print_justify($keuntungantax_left, $keuntungantax_right, 16, 13, 3));
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
    redirect(base_url().'res_report_selling_user/range/'.$date_start.'/'.$date_end.'/'.$user_id);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_res_report_selling_user->detail($tx_id);
    $this->view('detail', $data);

  }

  public function frame_pdf()
  {
    $data = $_POST;
    $this->view('res_report_selling_user/frame_pdf', $data);
  }

}
