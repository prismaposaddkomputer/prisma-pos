<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_report_selling_customer extends MY_Retail {

  var $access, $report_selling_customer_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_report_selling_customer'){
      $this->session->set_userdata(array('menu' => 'ret_report_selling_customer'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling_customer');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_report_selling_customer';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_report_selling_customer');
    $this->load->model('ret_customer/m_ret_customer');
    $this->load->model('ret_client/m_ret_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penjualan Pelanggan';
      $data['customer'] = $this->m_ret_customer->get_all();

      $this->view('ret_report_selling_customer/index',$data);
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
        redirect(base_url().'ret_report_selling_customer/annual/'.$year.'/'.$customer_id);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'ret_report_selling_customer/monthly/'.$month.'/'.$customer_id);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'ret_report_selling_customer/weekly/'.$week.'/'.$customer_id);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'ret_report_selling_customer/daily/'.$date.'/'.$customer_id);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'ret_report_selling_customer/range/'.$range.'/'.$customer_id);
        break;

    }
  }

  public function annual($year,$customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Tahun '.$year;
    $data['annual'] = $this->m_ret_report_selling_customer->annual($year,$customer_id);
    $data['year'] = $year;
    $data['customer_id'] = $customer_id;

    $this->view('annual', $data);
  }

  public function annual_pdf($year,$customer_id)
  {
    $data['title'] = 'Laporan Penjualan Pelanggan Tahun '.$year;
    $data['annual'] = $this->m_ret_report_selling_customer->annual($year,$customer_id);
    $data['client'] = $this->m_ret_client->get_all();
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['customer'] = $customer;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$customer->customer_name.')-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function monthly($month,$customer_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['month'] = $month;
    $data['customer_id'] = $customer_id;

    $data['monthly'] = $this->m_ret_report_selling_customer->monthly($month,$customer_id);
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month,$customer_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Penjualan Pelanggan Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_ret_report_selling_customer->monthly($month,$customer_id);
    $data['client'] = $this->m_ret_client->get_all();
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['customer'] = $customer;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$customer->customer_name.')-bulan-".$month.' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function weekly($date_start, $date_end, $customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['customer_id'] = $customer_id;

    $data['weekly'] = $this->m_ret_report_selling_customer->weekly(ind_to_date($date_start),ind_to_date($date_end),$customer_id);
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start,$date_end,$customer_id)
  {
    $data['title'] = 'Laporan Penjualan Pelanggan Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_ret_report_selling_customer->weekly(ind_to_date($date_start),ind_to_date($date_end),$customer_id);
    $data['client'] = $this->m_ret_client->get_all();
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['customer'] = $customer;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$customer->customer_name.')-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function daily($date, $customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Tanggal '.date_to_ind($date);
    $data['date'] = $date;
    $data['customer_id'] = $customer_id;

    $data['daily'] = $this->m_ret_report_selling_customer->daily($date, $customer_id);
    $this->view('daily', $data);
  }

  public function daily_pdf($date,$customer_id)
  {
    $data['title'] = 'Laporan Penjualan Pelanggan Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_ret_report_selling_customer->daily($date, $customer_id);
    $data['client'] = $this->m_ret_client->get_all();
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['customer'] = $customer;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$customer->customer_name.')-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function range($date_start, $date_end, $customer_id)
  {
    $data['access'] = $this->access;
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['title'] = 'Laporan Penjualan Pelanggan "'.$customer->customer_name.'" Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['customer_id'] = $customer_id;

    $data['range'] = $this->m_ret_report_selling_customer->range(ind_to_date($date_start),ind_to_date($date_end),$customer_id);
    $this->view('range', $data);
  }

  public function range_pdf($date_start,$date_end,$customer_id)
  {
    $data['title'] = 'Laporan Penjualan Pelanggan Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_ret_report_selling_customer->range(ind_to_date($date_start),ind_to_date($date_end),$customer_id);
    $data['client'] = $this->m_ret_client->get_all();
    $customer = $this->m_ret_customer->get_by_id($customer_id);
    $data['customer'] = $customer;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$customer->customer_name.')-rentang-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_ret_report_selling_customer->detail($tx_id);
    $this->view('detail', $data);

  }

}
