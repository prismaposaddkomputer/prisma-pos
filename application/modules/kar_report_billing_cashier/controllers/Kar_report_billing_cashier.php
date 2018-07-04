<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_report_billing_cashier extends MY_Karaoke {

  var $access, $report_billing_cashier_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_report_billing_cashier'){
      $this->session->set_userdata(array('menu' => 'kar_report_billing_cashier'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_billing_cashier');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_report_billing_cashier';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_report_billing_cashier');
    $this->load->model('kar_user/m_kar_user');
  }

	public function index()
  {
    $data['cashier'] = $this->m_kar_report_billing_cashier->get_cashier();
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penyewaan';

      $this->view('kar_report_billing_cashier/index',$data);
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
        redirect(base_url().'kar_report_billing_cashier/annual/'.$year.'/'.$data['user_id']);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'kar_report_billing_cashier/monthly/'.$month.'/'.$data['user_id']);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'kar_report_billing_cashier/weekly/'.$week.'/'.$data['user_id']);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'kar_report_billing_cashier/daily/'.$date.'/'.$data['user_id']);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'kar_report_billing_cashier/range/'.$range);
        break;

    }
  }

  public function annual($year,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_kar_user->get_by_id($user_id);

    $data['title'] = 'Laporan Penyewaan Kasir "'.$user->user_realname.'" Tahun '.$year;

    $data['annual'] = $this->m_kar_report_billing_cashier->annual($year,$user_id);
    $this->view('annual', $data);
  }

  public function monthly($month,$user_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];
    $user = $this->m_kar_user->get_by_id($user_id);
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan "'.$user->user_realname.'" Bulan '.month_name_ind($num_month);

    $data['monthly'] = $this->m_kar_report_billing_cashier->monthly($month,$user_id);
    $this->view('monthly', $data);
  }

  public function weekly($date_start, $date_end,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_kar_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penyewaan "'.$user->user_realname.'" Mingguan ('.$date_start.' - '.$date_end.')';

    $data['weekly'] = $this->m_kar_report_billing_cashier->weekly(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('weekly', $data);
  }

  public function daily($date,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_kar_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penyewaan "'.$user->user_realname.'" Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_kar_report_billing_cashier->daily($date,$user_id);
    $this->view('daily', $data);
  }

  public function range($date_start, $date_end,$user_id)
  {
    $data['access'] = $this->access;
    $user = $this->m_kar_user->get_by_id($user_id);
    $data['title'] = 'Laporan Penyewaan "'.$user->user_realname.'" Tanggal '.$date_start.' - '.$date_end;

    $data['range'] = $this->m_kar_report_billing_cashier->range(ind_to_date($date_start),ind_to_date($date_end),$user_id);
    $this->view('range', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_kar_report_billing_cashier->detail($tx_id);
    $this->view('detail', $data);

  }

}
