<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_report_billing_member extends MY_Karaoke {

  var $access, $report_billing_member_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_report_billing_member'){
      $this->session->set_userdata(array('menu' => 'kar_report_billing_member'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_billing_member');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_report_billing_member';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_report_billing_member');
    $this->load->model('kar_member/m_kar_member');
  }

	public function index()
  {
    $data['member'] = $this->m_kar_report_billing_member->get_member();
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penyewaan';

      $this->view('kar_report_billing_member/index',$data);
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
        redirect(base_url().'kar_report_billing_member/annual/'.$year.'/'.$data['member_id']);
        break;

      case 'monthly':
        $month = ind_to_month($data['month']);
        redirect(base_url().'kar_report_billing_member/monthly/'.$month.'/'.$data['member_id']);
        break;

      case 'weekly':
        $week = $data['week'];
        $week = str_replace(' - ', '/', $week);
        redirect(base_url().'kar_report_billing_member/weekly/'.$week.'/'.$data['member_id']);
        break;

      case 'daily':
        $date = ind_to_date($data['date']);
        redirect(base_url().'kar_report_billing_member/daily/'.$date.'/'.$data['member_id']);
        break;

      case 'range':
        $range = $data['range'];
        $range = str_replace(' - ', '/', $range);
        redirect(base_url().'kar_report_billing_member/range/'.$range);
        break;

    }
  }

  public function annual($year,$member_id)
  {
    $data['access'] = $this->access;
    $member = $this->m_kar_member->get_by_id($member_id);

    $data['title'] = 'Laporan Penyewaan Kasir "'.$member->member_name.'" Tahun '.$year;

    $data['annual'] = $this->m_kar_report_billing_member->annual($year,$member_id);
    $this->view('annual', $data);
  }

  public function monthly($month,$member_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];
    $member = $this->m_kar_member->get_by_id($member_id);
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan "'.$member->member_name.'" Bulan '.month_name_ind($num_month);

    $data['monthly'] = $this->m_kar_report_billing_member->monthly($month,$member_id);
    $this->view('monthly', $data);
  }

  public function weekly($date_start, $date_end,$member_id)
  {
    $data['access'] = $this->access;
    $member = $this->m_kar_member->get_by_id($member_id);
    $data['title'] = 'Laporan Penyewaan "'.$member->member_name.'" Mingguan ('.$date_start.' - '.$date_end.')';

    $data['weekly'] = $this->m_kar_report_billing_member->weekly(ind_to_date($date_start),ind_to_date($date_end),$member_id);
    $this->view('weekly', $data);
  }

  public function daily($date,$member_id)
  {
    $data['access'] = $this->access;
    $member = $this->m_kar_member->get_by_id($member_id);
    $data['title'] = 'Laporan Penyewaan "'.$member->member_name.'" Tanggal '.date_to_ind($date);

    $data['daily'] = $this->m_kar_report_billing_member->daily($date,$member_id);
    $this->view('daily', $data);
  }

  public function range($date_start, $date_end,$member_id)
  {
    $data['access'] = $this->access;
    $member = $this->m_kar_member->get_by_id($member_id);
    $data['title'] = 'Laporan Penyewaan "'.$member->member_name.'" Tanggal '.$date_start.' - '.$date_end;

    $data['range'] = $this->m_kar_report_billing_member->range(ind_to_date($date_start),ind_to_date($date_end),$member_id);
    $this->view('range', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_kar_report_billing_member->detail($tx_id);
    $this->view('detail', $data);

  }

}
