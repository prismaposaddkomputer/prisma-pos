<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_report_selling_user extends MY_Retail {

  var $access, $report_selling_user_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_report_selling_user'){
      $this->session->set_userdata(array('menu' => 'ret_report_selling_user'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_selling_user');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_report_selling_user';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_report_selling_user');
    $this->load->model('ret_user/m_ret_user');
    $this->load->model('ret_client/m_ret_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penjualan Kasir';
      $data['user'] = $this->m_ret_user->get_all();

      $this->view('ret_report_selling_user/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function action()
  {
    $data = $_POST;
    $user_id = $data['user_id'];

    switch ($data['type']) {

      case 'annual':
        $year = $data['year'];
        redirect(base_url().'ret_report_selling_user/annual/'.$year.'/'.$user_id);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'ret_report_selling_user/monthly/'.$month.'/'.$user_id);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'ret_report_selling_user/weekly/'.$week.'/'.$user_id);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'ret_report_selling_user/daily/'.$date.'/'.$user_id);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'ret_report_selling_user/range/'.$range.'/'.$user_id);
        break;

    }
  }

  public function annual($year,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Tahun '.$year;
    $data['annual'] = $this->m_ret_report_selling_user->annual($year,$user_id);
    $data['year'] = $year;
    $data['user_id'] = $user_id;

    $this->view('annual', $data);
  }

  public function annual_pdf($year,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Tahun '.$year;
    $data['annual'] = $this->m_ret_report_selling_user->annual($year,$user_id);
    $data['client'] = $this->m_ret_client->get_all();
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function monthly($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Bulan '.month_name_ind($num_month).' '.$raw[0];;
    $data['month'] = $month;
    $data['user_id'] = $user_id;

    $data['monthly'] = $this->m_ret_report_selling_user->monthly($month,$user_id);
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Penjualan Kasir Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_ret_report_selling_user->monthly($month,$user_id);
    $data['client'] = $this->m_ret_client->get_all();
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-pelanggan('.$user->user_realname.')-kasir-".$month.' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function weekly($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $data['weekly'] = $this->m_ret_report_selling_user->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start,$date_end,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_ret_report_selling_user->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_ret_client->get_all();
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-mingguan-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function daily($date, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Tanggal '.date_to_ind($date);
    $data['date'] = $date;
    $data['user_id'] = $user_id;

    $data['daily'] = $this->m_ret_report_selling_user->daily($date, $user_id);
    $this->view('daily', $data);
  }

  public function daily_pdf($date,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_ret_report_selling_user->daily($date, $user_id);
    $data['client'] = $this->m_ret_client->get_all();
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function range($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penjualan Kasir "'.$user->user_realname.'" Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['user_id'] = $user_id;

    $data['range'] = $this->m_ret_report_selling_user->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('range', $data);
  }

  public function range_pdf($date_start,$date_end,$user_id)
  {
    $data['title'] = 'Laporan Penjualan Kasir Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_ret_report_selling_user->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $data['client'] = $this->m_ret_client->get_all();
    $user = $this->m_ret_user->get_by_id($user_id);
    $data['user'] = $user;

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penjualan-kasir('.$user->user_realname.')-rentang-".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_ret_report_selling_user->detail($tx_id);
    $this->view('detail', $data);

  }

}
