<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_report_selling_category extends MY_Restaurant {

  var $access, $report_selling_category_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_report_selling_category'){
      $this->session->set_userdata(array('menu' => 'res_report_selling_category'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling_category');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_report_selling_category';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_report_selling_category');
    $this->load->model('res_client/m_res_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penjualan Per Kategori';

      $this->view('res_report_selling_category/index',$data);
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
        redirect(base_url().'res_report_selling_category/annual/'.$year);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'res_report_selling_category/monthly/'.$month);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'res_report_selling_category/weekly/'.$week);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'res_report_selling_category/daily/'.$date);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'res_report_selling_category/range/'.$range);
        break;

    }
  }

  public function annual($year)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Kategori Tahun '.$year;
    $data['year'] = $year;

    $data['annual'] = $this->m_res_report_selling_category->annual($year);
    $this->view('annual', $data);
  }

  public function annual_pdf($year)
  {
    $data['title'] = 'Laporan Penjualan Per Kategori Tahun '.$year;
    $data['annual'] = $this->m_res_report_selling_category->annual($year);
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-per-kategori-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function monthly($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Kategori Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['month'] = $month;

    $data['monthly'] = $this->m_res_report_selling_category->monthly($month);
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Penjualan Per Kategori Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_res_report_selling_category->monthly($month);
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-per-kategori-bulan-".month_name_ind($num_month).' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function weekly($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Kategori Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['weekly'] = $this->m_res_report_selling_category->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start, $date_end)
  {
    $data['title'] = 'Laporan Penjualan Per Kategori Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_res_report_selling_category->weekly(ind_to_date($date_start),ind_to_date($date_end));
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-per-kategori-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function daily($date)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Kategori Tanggal '.date_to_ind($date);
    $data['date'] = $date;

    $data['daily'] = $this->m_res_report_selling_category->daily($date);
    $this->view('daily', $data);
  }

  public function daily_pdf($date)
  {
    $data['title'] = 'Laporan Penjualan Per Kategori Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_res_report_selling_category->daily($date);
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-per-kategori-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function range($date_start, $date_end)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penjualan Per Kategori Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;

    $data['range'] = $this->m_res_report_selling_category->range(ind_to_date($date_start),ind_to_date($date_end));
    $this->view('range', $data);
  }

  public function range_pdf($date_start, $date_end)
  {
    $data['title'] = 'Laporan Penjualan Per Kategori Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_res_report_selling_category->range(ind_to_date($date_start),ind_to_date($date_end));
    $data['client'] = $this->m_res_client->get_all();

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-per-kategori-rentang-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

}
