<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_report extends MY_Retail {

  var $access, $report_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_report'){
      $this->session->set_userdata(array('menu' => 'ret_report'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_report';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_report');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan-laporan';

      $this->view('ret_report/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function report_stock()
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Stok';

    if($this->input->post('search_stock')){
      $search_stock = $this->input->post('search_stock');
      $this->session->set_userdata(array('search_stock' => $search_stock));
    }

    if($this->session->userdata('search_stock') == null){
      $data['stock_recap'] = $this->m_ret_report->report_stock($search_stock = null);
    }else{
      $search_stock = $this->session->userdata('search_stock');

      $data['stock_recap'] = $this->m_ret_report->report_stock($search_stock);
    }

    $this->view('ret_report/report_stock',$data);
  }

  public function reset_stock()
  {
    $this->session->unset_userdata('search_stock');
    redirect(base_url().'ret_report/report_stock');
  }

  public function report_selling($type = null)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan';

    $this->view('ret_report/report_selling',$data);
  }

  public function report_selling_action()
  {
    $data = $_POST;

    switch ($data['type']) {

      case 'annual':
        $year = $data['year'];
        redirect(base_url().'ret_report/report_selling_annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'ret_report/report_selling_monthly/'.$month);
        break;

      case 'weekly':
        if($data['week'] == ''){
          redirect(base_url().'ret_report/report_selling/weekly');
        };
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'ret_report/report_selling_weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'ret_report/report_selling_daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'ret_report/report_selling_range/'.$range);
        break;

    }
  }

  public function report_selling_annual($year)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Tahun '.$year;

    $data['annual'] = $this->m_ret_report->report_selling_annual($year);
    $this->view('report_selling_annual', $data);
  }

  public function report_selling_monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Bulan '.month_name_ind($num_month);

    $data['monthly'] = $this->m_ret_report->report_selling_monthly($month);
    $this->view('report_selling_monthly', $data);
  }

  public function report_selling_weekly($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Mingguan ('.$date_start.' - '.$date_end.')';

    $data['weekly'] = $this->m_ret_report->report_selling_weekly(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('report_selling_weekly', $data);
  }

  public function report_selling_daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_ret_report->report_selling_daily($date);
    $this->view('report_selling_daily', $data);
  }

  public function report_selling_range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Tanggal '.$date_start.' - '.$date_end;

    $data['range'] = $this->m_ret_report->report_selling_range(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('report_selling_range', $data);
  }

  public function report_selling_detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_ret_report->report_selling_detail($tx_id);
    $this->view('report_selling_detail', $data);

  }

  public function reset_selling()
  {
    $this->session->unset_userdata('search_selling');
    redirect(base_url().'ret_report/report_selling');
  }

  public function report_selling_item()
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Produk';

    if($this->input->post('search_selling_item')){
      $search_selling_item = $this->input->post('search_selling_item');
      $this->session->set_userdata(array('search_selling_item' => $search_selling_item));
    }

    if($this->session->userdata('search_selling_item') == null){
      $data['selling_item'] = $this->m_ret_report->report_selling_item($search_selling_item = null);
    }else{
      $search_selling_item = $this->session->userdata('search_selling_item');

      $data['selling_item'] = $this->m_ret_report->report_selling_item($search_selling_item);
    }

    $this->view('ret_report/report_selling_item',$data);
  }

  public function reset_selling_item()
  {
    $this->session->unset_userdata('search_selling_item');
    redirect(base_url().'ret_report/report_selling_item');
  }

  public function report_profit_daily()
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Laba per Hari';

    if($this->input->post('search_profit_daily')){
      $search_profit_daily = $this->input->post('search_profit_daily');
      $this->session->set_userdata(array('search_profit_daily' => $search_profit_daily));
    }

    if($this->session->userdata('search_profit_daily') == null){
      $data['profit_daily'] = $this->m_ret_report->report_profit_daily($search_profit_daily = null);
    }else{
      $search_profit_daily = $this->session->userdata('search_profit_daily');

      $data['profit_daily'] = $this->m_ret_report->report_profit_daily($search_profit_daily);
    }

    $this->view('ret_report/report_profit_daily',$data);
  }

  public function reset_profit_daily()
  {
    $this->session->unset_userdata('search_profit_daily');
    redirect(base_url().'ret_report/report_profit_daily');
  }

  public function report_profit_item()
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Laba per Produk';

    if($this->input->post('search_profit_item')){
      $search_profit_item = $this->input->post('search_profit_item');
      $this->session->set_userdata(array('search_profit_item' => $search_profit_item));
    }

    if($this->session->userdata('search_profit_item') == null){
      $data['profit_item'] = $this->m_ret_report->report_profit_item($search_profit_item = null);
    }else{
      $search_profit_item = $this->session->userdata('search_profit_item');

      $data['profit_item'] = $this->m_ret_report->report_profit_item($search_profit_item);
    }

    $this->view('ret_report/report_profit_item',$data);
  }

  public function reset_profit_item()
  {
    $this->session->unset_userdata('search_profit_item');
    redirect(base_url().'ret_report/report_profit_item');
  }

}
