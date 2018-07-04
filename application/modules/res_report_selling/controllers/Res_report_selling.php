<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_report_selling extends MY_Restaurant {

  var $access, $report_selling_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_report_selling'){
      $this->session->set_userdata(array('menu' => 'res_report_selling'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_report_selling';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_report_selling');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penjualan';

      $this->view('res_report_selling/index',$data);
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
        redirect(base_url().'res_report_selling/annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'res_report_selling/monthly/'.$month);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'res_report_selling/weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'res_report_selling/daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'res_report_selling/range/'.$range);
        break;

    }
  }

  public function annual($year)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Tahun '.$year;

    $data['annual'] = $this->m_res_report_selling->annual($year);
    $this->view('annual', $data);
  }

  public function monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Bulan '.month_name_ind($num_month);

    $data['monthly'] = $this->m_res_report_selling->monthly($month);
    $this->view('monthly', $data);
  }

  public function weekly($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Mingguan ('.$date_start.' - '.$date_end.')';

    $data['weekly'] = $this->m_res_report_selling->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('weekly', $data);
  }

  public function daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_res_report_selling->daily($date);
    $this->view('daily', $data);
  }

  public function range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Tanggal '.$date_start.' - '.$date_end;

    $data['range'] = $this->m_res_report_selling->range(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('range', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_res_report_selling->detail($tx_id);
    $this->view('detail', $data);

  }

}
