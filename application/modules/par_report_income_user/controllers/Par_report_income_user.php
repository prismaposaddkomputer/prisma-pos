<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Par_report_income_user extends MY_Parking {

  var $access, $brand_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'par_brand'){
      $this->session->set_userdata(array('menu' => 'par_brand'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_par_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'par_report_income_user';
    $this->access = $this->m_par_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_par_report_income_user');
    $this->load->model('par_user/m_par_user');
  }

	public function index($type = null)
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Pendapatan';
      $data['user'] = $this->m_par_user->get_all();

      $this->view('par_report_income_user/index',$data);
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
        redirect(base_url().'par_report_income_user/report_annual/'.$year.'/'.$data['user_id']);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'par_report_income_user/report_monthly/'.$month.'/'.$data['user_id']);
        break;

      case 'weekly':
        if($data['week'] == ''){
          redirect(base_url().'par_report_income_user/index/weekly');
        };
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'par_report_income_user/report_weekly/'.$week.'/'.$data['user_id']);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'par_report_income_user/report_daily/'.$date.'/'.$data['user_id']);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'par_report_income_user/report_range/'.$range.'/'.$data['user_id']);
        break;
    }
  }

  public function report_annual($year, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Tahun '.$year;
    $data['billing'] = $this->m_par_report_income_user->report_annual($year,$user_id);
    $data['year'] = $year;
    $data['user_id'] = $user_id;

    $this->view('report_annual', $data);
  }

  public function report_annual_pdf($year, $user_id)
  {
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Tahun '.$year;
    $data['billing'] = $this->m_par_report_income_user->report_annual($year,$user_id);

    $this->load->library('pdf');
    //
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "pedapatan-tahun-".$year.".pdf";
    $this->pdf->load_view('report_annual_pdf', $data);
  }

  public function report_monthly($month, $user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Bulan '.month_name_ind($num_month);
    $data['billing'] = $this->m_par_report_income_user->report_monthly($month,$user_id);
    $data['month'] = $month;
    $data['user_id'] = $user_id;

    $this->view('report_monthly', $data);
  }

  public function report_monthly_pdf($month, $user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Bulan '.month_name_ind($num_month);
    $data['billing'] = $this->m_par_report_income_user->report_monthly($month,$user_id);

    $this->load->library('pdf');
    //
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "pendapatan-bulan-".$month.".pdf";
    $this->pdf->load_view('report_monthly_pdf', $data);
  }

  public function report_weekly($date_start,$date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Mingguan ('.$date_start.' - '.$date_start.')';
    $data['billing'] = $this->m_par_report_income_user->report_weekly(date_to_ind($date_start),date_to_ind($date_end),$user_id);
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $this->view('report_weekly', $data);
  }

  public function report_weekly_pdf($date_start,$date_end, $user_id)
  {
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Mingguan ('.$date_start.' - '.$date_start.')';
    $data['billing'] = $this->m_par_report_income_user->report_weekly(date_to_ind($date_start),date_to_ind($date_end),$user_id);

    $this->load->library('pdf');
    //
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "pendapatan-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('report_weekly_pdf', $data);
  }

  public function report_daily($date,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Tanggal '.date_to_ind($date);
    $data['billing'] = $this->m_par_report_income_user->report_daily($date,$user_id,$user_id);
    $data['date'] = $date;
    $data['user_id'] = $user_id;

    $this->view('report_daily', $data);
  }

  public function report_daily_pdf($date,$user_id)
  {
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Tanggal '.date_to_ind($date);
    $data['billing'] = $this->m_par_report_income_user->report_daily($date,$user_id,$user_id);

    $this->load->library('pdf');
    //
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "pendapatan-tanggal-".$date.".pdf";
    $this->pdf->load_view('report_daily_pdf', $data);
  }

  public function report_range($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Tanggal ('.$date_start.' - '.$date_start.')';
    $data['billing'] = $this->m_par_report_income_user->report_range(date_to_ind($date_start),date_to_ind($date_end),$user_id);
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $this->view('report_range', $data);
  }

  public function report_range_pdf($date_start, $date_end, $user_id)
  {
    $user = $this->m_par_user->get_by_id($user_id);
    $data['title'] = 'Laporan Pendapatan "'.$user->user_realname.'" Tanggal ('.$date_start.' - '.$date_start.')';
    $data['billing'] = $this->m_par_report_income_user->report_range(date_to_ind($date_start),date_to_ind($date_end),$user_id);

    $this->load->library('pdf');
    //
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "pendapatan-tanggal-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('report_range_pdf', $data);
  }

}
