<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_dashboard extends MY_Retail {

  var $access, $role_id, $type_id;

  function __construct(){
    parent::__construct();

    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_dashboard';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_app_client');
    $this->load->model('m_ret_dashboard');
  }

	public function index()
  {
    if ($this->access->_read == 1) {

      $data['selling_today'] = $this->m_ret_dashboard->selling_today();
      $data['total_item_today'] = $this->m_ret_dashboard->total_item_today();
      $data['graph_sell_date'] = $this->m_ret_dashboard->graph_sell_date();
      $data['graph_sell_amount'] = $this->m_ret_dashboard->graph_sell_amount();
      $data['graph_profit_month'] = $this->m_ret_dashboard->graph_profit_month();
      $data['graph_profit_amount'] = $this->m_ret_dashboard->graph_profit_amount();
      $data['most_sell'] = $this->m_ret_dashboard->most_sell();
      $data['new_item'] = $this->m_ret_dashboard->new_item();

      $this->view('index', $data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

}
