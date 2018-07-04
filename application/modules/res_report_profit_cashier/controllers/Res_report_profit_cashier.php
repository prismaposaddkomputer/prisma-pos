<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_report_profit_cashier extends MY_Restaurant {

  var $access, $report_profit_cashier_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_report_profit_cashier'){
      $this->session->set_userdata(array('menu' => 'res_report_profit_cashier'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_profit_cashier');
      $this->session->unset_userdata('search_profit_cashier_daily');
      $this->session->unset_userdata('search_profit_cashier_item');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_report_profit_cashier';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_report_profit_cashier');
    $this->load->model('res_user/m_res_user');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Omzet';
      $data['user'] = $this->m_res_user->get_all();

      $this->view('res_report_profit_cashier/index',$data);
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
        redirect(base_url().'res_report_profit_cashier/annual/'.$year.'/'.$user_id);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'res_report_profit_cashier/monthly/'.$month.'/'.$user_id);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'res_report_profit_cashier/weekly/'.$week.'/'.$user_id);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'res_report_profit_cashier/daily/'.$date.'/'.$user_id);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'res_report_profit_cashier/range/'.$range.'/'.$user_id);
        break;

    }
  }

  public function annual($year,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Omzet "'.$user->user_realname.'" Tahun '.$year;
    $data['user_id'] = $user_id;

    $data['annual'] = $this->m_res_report_profit_cashier->annual($year,$user_id);
    $this->view('annual', $data);
  }

  public function monthly($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Omzet "'.$user->user_realname.'" Bulan '.month_name_ind($num_month);
    $data['user_id']=$user_id;

    $data['monthly'] = $this->m_res_report_profit_cashier->monthly($month,$user_id);
    $this->view('monthly', $data);
  }

  public function weekly($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Omzet "'.$user->user_realname.'" Mingguan ('.$date_start.' - '.$date_end.')';
    $data['user_id'] = $user_id;

    $data['weekly'] = $this->m_res_report_profit_cashier->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('weekly', $data);
  }

  public function daily($date, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Omzet "'.$user->user_realname.'" Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_res_report_profit_cashier->daily($date,$user_id);
    $this->view('daily', $data);
  }

  public function range($date_start, $date_end, $user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_res_user->get_by_id($user_id);
    $data['title'] = 'Laporan Omzet "'.$user->user_realname.'" Tanggal '.$date_start.' - '.$date_end;
    $data['user_id'] = $user_id;

    $data['range'] = $this->m_res_report_profit_cashier->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('range', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_res_report_profit_cashier->detail($tx_id);
    $this->view('detail', $data);

  }

}
