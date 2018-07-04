<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_report_payment extends MY_Hotel {

  var $access, $brand_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_report_payment'){
      $this->session->set_userdata(array('menu' => 'hot_report_payment'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_report_payment';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_hot_report_payment');
  }

	public function index($type = null)
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Pembayaran Masuk';

      $this->view('hot_report_payment/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function report_action($value='')
  {
    $data = $_POST;

    switch ($data['type']) {

      case 'annual':
        $year = $data['year'];
        redirect(base_url().'hot_report_payment/report_annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'hot_report_payment/report_monthly/'.$month);
        break;

      case 'weekly':
        if($data['week'] == ''){
          redirect(base_url().'hot_report_payment/index/weekly');
        };
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'hot_report_payment/report_weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'hot_report_payment/report_daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'hot_report_payment/report_range/'.$range);
        break;
    }
  }

  public function report_monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Pembayaran Masuk Bulan '.month_name_ind($num_month);
    $data['booking'] = $this->m_hot_report_payment->report_monthly($month);
    $data['payment'] = $this->m_hot_report_payment->get_all_payment();
    $data['guest'] = $this->m_hot_report_payment->get_all_tamu();
    $data['room'] = $this->m_hot_report_payment->get_all_room();
    $data['service'] = $this->m_hot_report_payment->get_all_service();
    $data['tipe'] = $this->m_hot_report_payment->get_tipe();
    $data['month'] = $month;

    $this->view('report_monthly', $data);
  }

  public function report_monthly_pdf($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Pembayaran Masuk Bulan '.month_name_ind($num_month);
    $data['booking'] = $this->m_hot_report_payment->report_monthly($month);
    $data['payment'] = $this->m_hot_report_payment->get_all_payment();
    $data['guest'] = $this->m_hot_report_payment->get_all_tamu();
    $data['room'] = $this->m_hot_report_payment->get_all_room();
    $data['service'] = $this->m_hot_report_payment->get_all_service();
    $data['tipe'] = $this->m_hot_report_payment->get_tipe();
    // var_dump($data);
    $this->load->library('pdf');
    //
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "Pembayaran-keluar-bulan-".$month.".pdf";
    $this->pdf->load_view('report_pdf', $data);
  }

  public function report_daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Pembayaran Masuk Tanggal '.date_to_ind($date);
    $data['booking'] = $this->m_hot_report_payment->report_daily($date);
    $data['date'] = $date;
    $data['guest'] = $this->m_hot_report_payment->get_all_tamu();
    $data['payment'] = $this->m_hot_report_payment->get_all_payment();
    $data['room'] = $this->m_hot_report_payment->get_all_room();
    $data['service'] = $this->m_hot_report_payment->get_all_service();
    $data['tipe'] = $this->m_hot_report_payment->get_tipe();

    $this->view('hot_report_payment/report_daily', $data);
  }

  public function report_daily_pdf($date)
  {
    $data['title'] = 'Laporan Pembayaran Masuk Tanggal '.date_to_ind($date);
    $data['booking'] = $this->m_hot_report_payment->report_daily($date);
    $data['payment'] = $this->m_hot_report_payment->get_all_payment();
    $data['date'] = $date;
    $data['guest'] = $this->m_hot_report_payment->get_all_tamu();
    $data['room'] = $this->m_hot_report_payment->get_all_room();
    $data['service'] = $this->m_hot_report_payment->get_all_service();
    $data['tipe'] = $this->m_hot_report_payment->get_tipe();


    $this->load->library('pdf');

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "Pembayaran-keluar-tanggal-".$date.".pdf";
    $this->pdf->load_view('report_pdf', $data);
  }

  public function report_range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Pembayaran Masuk Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['booking'] = $this->m_hot_report_payment->report_range(ind_to_date($date_start),ind_to_date($date_end));    
    $data['payment'] = $this->m_hot_report_payment->get_all_payment();
    $data['guest'] = $this->m_hot_report_payment->get_all_tamu();
    $data['room'] = $this->m_hot_report_payment->get_all_room();
    $data['service'] = $this->m_hot_report_payment->get_all_service();
    $data['tipe'] = $this->m_hot_report_payment->get_tipe();

    $this->view('report_range', $data);
  }

  public function report_range_pdf($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Pembayaran Masuk Tanggal '.$date_start.' - '.$date_end;

    $data['booking'] = $this->m_hot_report_payment->report_range(ind_to_date($date_start),ind_to_date($date_end));    
    $data['payment'] = $this->m_hot_report_payment->get_all_payment();
    $data['guest'] = $this->m_hot_report_payment->get_all_tamu();
    $data['room'] = $this->m_hot_report_payment->get_all_room();
    $data['service'] = $this->m_hot_report_payment->get_all_service();
    $data['tipe'] = $this->m_hot_report_payment->get_tipe();
    $this->load->library('pdf');

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "Pembayaran-keluar-".$date_start."-".$date_end.".pdf";
    $this->pdf->load_view('report_pdf', $data);
  }

}
