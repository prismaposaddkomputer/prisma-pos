<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_dashboard extends MY_Karaoke {

  var $access, $role_id, $type_id;

  function __construct(){
    parent::__construct();

    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_dashboard';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_app_client');
    $this->load->model('m_kar_dashboard');
  }

	public function index()
  {
    if ($this->access->_read == 1) {

      $data['billing_today'] = $this->m_kar_dashboard->billing_today();
      $data['total_billing_today'] = $this->m_kar_dashboard->total_billing_today();
      $data['graph_sell_date'] = $this->m_kar_dashboard->graph_sell_date();
      $data['graph_sell_amount'] = $this->m_kar_dashboard->graph_sell_amount();
      $data['graph_sell_month'] = $this->m_kar_dashboard->graph_sell_month();
      $data['graph_sell_amount'] = $this->m_kar_dashboard->graph_sell_amount();
      // $data['most_sell'] = $this->m_kar_dashboard->most_sell();
      // $data['new_item'] = $this->m_kar_dashboard->new_item();

      $this->view('index', $data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

}
