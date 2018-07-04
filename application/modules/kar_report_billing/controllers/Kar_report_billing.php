<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_report_billing extends MY_Karaoke {

  var $access, $report_billing_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_report_billing'){
      $this->session->set_userdata(array('menu' => 'kar_report_billing'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_billing');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_report_billing';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_report_billing');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penyewaan';

      $this->view('kar_report_billing/index',$data);
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
        redirect(base_url().'kar_report_billing/annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'kar_report_billing/monthly/'.$month);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'kar_report_billing/weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'kar_report_billing/daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'kar_report_billing/range/'.$range);
        break;

    }
  }

  public function annual($year)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Tahun '.$year;

    $data['annual'] = $this->m_kar_report_billing->annual($year);
    $this->view('annual', $data);
  }

  public function monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Bulan '.month_name_ind($num_month);

    $data['monthly'] = $this->m_kar_report_billing->monthly($month);
    $this->view('monthly', $data);
  }

  public function weekly($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Mingguan ('.$date_start.' - '.$date_end.')';

    $data['weekly'] = $this->m_kar_report_billing->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('weekly', $data);
  }

  public function daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_kar_report_billing->daily($date);
    $this->view('daily', $data);
  }

  public function range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Tanggal '.$date_start.' - '.$date_end;

    $data['range'] = $this->m_kar_report_billing->range(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('range', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_kar_report_billing->detail($tx_id);
    $this->view('detail', $data);

  }

}
