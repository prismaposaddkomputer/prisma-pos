<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_report_selling_customer extends MY_Restaurant {

  var $access, $report_selling_customer_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_report_selling_customer'){
      $this->session->set_userdata(array('menu' => 'res_report_selling_customer'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling_customer');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_report_selling_customer';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_report_selling_customer');
    $this->load->model('res_customer/m_res_customer');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penjualan Pelanggan';
      $data['customer'] = $this->m_res_customer->get_all();

      $this->view('res_report_selling_customer/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function action()
  {
    $data = $_POST;
    $customer_id = $data['customer_id'];

    switch ($data['type']) {

      case 'annual':
        $year = $data['year'];
        redirect(base_url().'res_report_selling_customer/annual/'.$year.'/'.$customer_id);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'res_report_selling_customer/monthly/'.$month.'/'.$customer_id);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'res_report_selling_customer/weekly/'.$week.'/'.$customer_id);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'res_report_selling_customer/daily/'.$date.'/'.$customer_id);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'res_report_selling_customer/range/'.$range.'/'.$customer_id);
        break;

    }
  }

  public function annual($year,$customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_res_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Tahun '.$year;
    $data['annual'] = $this->m_res_report_selling_customer->annual($year,$customer_id);
    $data['customer_id'] = $customer_id;

    $this->view('annual', $data);
  }

  public function monthly($month,$customer_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $customer = $this->m_res_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Bulan '.month_name_ind($num_month);
    $data['customer_id'] = $customer_id;

    $data['monthly'] = $this->m_res_report_selling_customer->monthly($month,$customer_id);
    $this->view('monthly', $data);
  }

  public function weekly($date_start, $date_end, $customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_res_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Mingguan ('.$date_start.' - '.$date_end.')';
    $data['customer_id'] = $customer_id;

    $data['weekly'] = $this->m_res_report_selling_customer->weekly(ind_to_date($date_start),ind_to_date($date_end),$customer_id);
    $this->view('weekly', $data);
  }

  public function daily($date, $customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_res_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_res_report_selling_customer->daily($date, $customer_id);
    $this->view('daily', $data);
  }

  public function range($date_start, $date_end, $customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_res_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Tanggal '.$date_start.' - '.$date_end;
    $data['customer_id'] = $customer_id;

    $data['range'] = $this->m_res_report_selling_customer->range(ind_to_date($date_start),ind_to_date($date_end),$customer_id);
    $this->view('range', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_res_report_selling_customer->detail($tx_id);
    $this->view('detail', $data);

  }

}
