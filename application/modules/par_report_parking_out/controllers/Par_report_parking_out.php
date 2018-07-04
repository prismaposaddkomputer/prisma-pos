<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Par_report_parking_out extends MY_Parking {

  var $access, $brand_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'par_brand'){
      $this->session->set_userdata(array('menu' => 'par_brand'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_par_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'par_report_parking_out';
    $this->access = $this->m_par_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_par_report_parking_out');
  }

	public function index($type = null)
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Parkir Keluar';

      $this->view('par_report_parking_out/index',$data);
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
        redirect(base_url().'par_report_parking_out/report_annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'par_report_parking_out/report_monthly/'.$month);
        break;

      case 'weekly':
        if($data['week'] == ''){
          redirect(base_url().'par_report_parking_out/index/weekly');
        };
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'par_report_parking_out/report_weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'par_report_parking_out/report_daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'par_report_parking_out/report_range/'.$range);
        break;
    }
  }

  public function report_monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Parkir Keluar Bulan '.month_name_ind($num_month);
    $data['monthly'] = $this->m_par_report_parking_out->report_monthly($month);
    $data['month'] = $month;

    $this->view('report_monthly', $data);
  }

  public function report_monthly_pdf($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Parkir Keluar Bulan '.month_name_ind($num_month);
    $data['billing'] = $this->m_par_report_parking_out->report_monthly($month);
    // var_dump($data);
    $this->load->library('pdf');
    //
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "parkir-keluar-bulan-".$month.".pdf";
    $this->pdf->load_view('report_pdf', $data);
  }

  public function report_daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Parkir Keluar Tanggal '.date_to_ind($date);
    $data['billing'] = $this->m_par_report_parking_out->report_daily($date);
    $data['date'] = $date;

    $this->view('par_report_parking_out/report_daily', $data);
  }

  public function report_daily_pdf($date)
  {
    $data['title'] = 'Laporan Parkir Keluar Tanggal '.date_to_ind($date);
    $data['billing'] = $this->m_par_report_parking_out->report_daily($date);

    $this->load->library('pdf');

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "parkir-keluar-tanggal-".$date.".pdf";
    $this->pdf->load_view('report_pdf', $data);
  }

  public function report_range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Parkir Keluar Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['billing'] = $this->m_par_report_parking_out->report_range(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('report_range', $data);
  }

  public function report_range_pdf($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Parkir Keluar Tanggal '.$date_start.' - '.$date_end;

    $data['billing'] = $this->m_par_report_parking_out->report_range(ind_to_date($date_start),ind_to_date($date_end));
    $this->load->library('pdf');

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "parkir-keluar-".$date_start."-".$date_end.".pdf";
    $this->pdf->load_view('report_pdf', $data);
  }

}
