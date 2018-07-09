<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_report_billing_member extends MY_Karaoke {

  var $access, $report_billing_member_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_report_billing_member'){
      $this->session->set_userdata(array('menu' => 'kar_report_billing_member'));
      $this->session->unset_userdata('search_stock');
      $this->session->unset_userdata('search_billing');
      $this->session->unset_userdata('search_profit_daily');
      $this->session->unset_userdata('search_profit_item');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_report_billing_member';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_report_billing_member');
    $this->load->model('kar_client/m_kar_client');
    $this->load->model('kar_member/m_kar_member');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Laporan Penyewaan';
      $data['member'] = $this->m_kar_member->get_all();

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
        redirect(base_url().'kar_report_billing_member/range/'.$range.'/'.$data['member_id']);
        break;

    }
  }

  public function annual($year,$member_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Tahun '.$year;
    $data['member_id'] = $member_id;
    $data['year'] = $year;

    $data['annual'] = $this->m_kar_report_billing_member->annual($year,$member_id);
    $this->view('annual', $data);
  }

  public function annual_pdf($year,$member_id)
  {
    $data['title'] = 'Laporan Penyewaan Tahun '.$year;
    $data['annual'] = $this->m_kar_report_billing_member->annual($year,$member_id);
    $data['member_id'] = $member_id;
    $data['client'] = $this->m_kar_client->get_all();
    $data['member'] = $this->m_kar_member->get_by_id($member_id);

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penyewaan-tahun-".$year.".pdf";
    $this->pdf->load_view('annual_pdf', $data);
  }

  public function monthly($month,$member_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['month'] = $month;
    $data['member_id'] = $member_id;

    $data['monthly'] = $this->m_kar_report_billing_member->monthly($month,$member_id);
    $this->view('monthly', $data);
  }

  public function monthly_pdf($month,$member_id)
  {
    $raw = $raw = explode("-", $month);
    $num_month = $raw[1];

    $data['title'] = 'Laporan Penyewaan Bulan '.month_name_ind($num_month).' '.$raw[0];
    $data['monthly'] = $this->m_kar_report_billing_member->monthly($month,$member_id);
    $data['client'] = $this->m_kar_client->get_all();
    $data['member'] = $this->m_kar_member->get_by_id($member_id);

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penyewaan-bulan-".month_name_ind($num_month).' '.$raw[0].".pdf";
    $this->pdf->load_view('monthly_pdf', $data);
  }

  public function weekly($date_start, $date_end,$member_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Mingguan ('.$date_start.' - '.$date_end.')';
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['member_id'] = $member_id;

    $data['weekly'] = $this->m_kar_report_billing_member->weekly(ind_to_date($date_start),ind_to_date($date_end),$member_id);
    $this->view('weekly', $data);
  }

  public function weekly_pdf($date_start, $date_end,$member_id)
  {
    $data['title'] = 'Laporan Penyewaan Mingguan ('.$date_start.' - '.$date_end.')';
    $data['weekly'] = $this->m_kar_report_billing_member->weekly(ind_to_date($date_start),ind_to_date($date_end),$member_id);
    $data['client'] = $this->m_kar_client->get_all();
    $data['member'] = $this->m_kar_member->get_by_id($member_id);

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penyewaan-penyewaan-tanggal".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('weekly_pdf', $data);
  }

  public function daily($date,$member_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Tanggal '.date_to_ind($date);
    $data['date'] = $date;
    $data['member_id'] = $member_id;

    $data['daily'] = $this->m_kar_report_billing_member->daily($date,$member_id);
    $this->view('daily', $data);
  }

  public function daily_pdf($date,$member_id)
  {
    $data['title'] = 'Laporan Penyewaan Tanggal '.date_to_ind($date);
    $data['daily'] = $this->m_kar_report_billing_member->daily($date,$member_id);
    $data['client'] = $this->m_kar_client->get_all();
    $data['member'] = $this->m_kar_member->get_by_id($member_id);

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penyewaan-tanggal-".date_to_ind($date).".pdf";
    $this->pdf->load_view('daily_pdf', $data);
  }

  public function range($date_start, $date_end,$member_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Laporan Penyewaan Tanggal '.$date_start.' - '.$date_end;
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['member_id'] = $member_id;
    $data['member'] = $this->m_kar_member->get_by_id($member_id);

    $data['range'] = $this->m_kar_report_billing_member->range(ind_to_date($date_start),ind_to_date($date_end),$member_id);
    $this->view('range', $data);
  }

  public function range_pdf($date_start, $date_end,$member_id)
  {
    $data['title'] = 'Laporan Penyewaan Tanggal ('.$date_start.' - '.$date_end.')';
    $data['range'] = $this->m_kar_report_billing_member->range(ind_to_date($date_start),ind_to_date($date_end),$member_id);
    $data['client'] = $this->m_kar_client->get_all();
    $data['member'] = $this->m_kar_member->get_by_id($member_id);

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-penyewaan-rentang".$date_start.'-'.$date_end.".pdf";
    $this->pdf->load_view('range_pdf', $data);
  }

  public function detail($tx_id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Transaksi';

    $data['billing'] = $this->m_kar_report_billing_member->detail($tx_id);
    $this->view('detail', $data);

  }

}
