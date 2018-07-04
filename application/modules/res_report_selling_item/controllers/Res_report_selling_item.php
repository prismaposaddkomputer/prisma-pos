<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_report_selling_item extends MY_Restaurant {

  var $access, $report_selling_item_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_report_selling_item'){
      $this->session->set_userdata(array('menu' => 'res_report_selling_item'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling_item');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_report_selling_item';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_report_selling_item');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penjualan Per Item';

      $this->view('res_report_selling_item/index',$data);
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
        redirect(base_url().'res_report_selling_item/annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'res_report_selling_item/monthly/'.$month);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'res_report_selling_item/weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'res_report_selling_item/daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'res_report_selling_item/range/'.$range);
        break;

    }
  }

  public function annual($year)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Item Tahun '.$year;

    $data['annual'] = $this->m_res_report_selling_item->annual($year);
    $this->view('annual', $data);
  }

  public function monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Item Bulan '.month_name_ind($num_month);

    $data['monthly'] = $this->m_res_report_selling_item->monthly($month);
    $this->view('monthly', $data);
  }

  public function weekly($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Item Mingguan ('.$date_start.' - '.$date_end.')';

    $data['weekly'] = $this->m_res_report_selling_item->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('weekly', $data);
  }

  public function daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Item Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_res_report_selling_item->daily($date);
    $this->view('daily', $data);
  }

  public function range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Item Tanggal '.$date_start.' - '.$date_end;

    $data['range'] = $this->m_res_report_selling_item->range(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('range', $data);
  }

}
