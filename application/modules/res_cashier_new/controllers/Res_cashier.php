
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_cashier extends MY_Restaurant {

  var $access, $cashier_shift_id, $type_id;

  function __construct(){
    parent::__construct();

    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_cashier';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('res_category/m_res_category');
    $this->load->model('res_customer/m_res_customer');
    $this->load->model('res_bank/m_res_bank');
    $this->load->model('res_shift/m_res_shift');
    $this->load->model('m_res_cashier');
    $this->load->model('res_client/m_res_client');
    $this->load->model('res_tax/m_res_tax');
    $this->load->model('app_install/m_app_install');
  }

  public function index()
  {
    if ($this->access->_read == 1) {
      $client = $this->m_res_client->get_all();

      $data['access'] = $this->access;
      $data['category'] = $this->m_res_category->get_all();
      $data['customer'] = $this->m_res_customer->get_all();
      $data['customer_first'] = $this->m_res_customer->get_first();
      $data['bank'] = $this->m_res_bank->get_all();
      $data['keyboard'] = $client->client_keyboard_status;
      $data['client'] = $client;
      
      $this->load->view('res_cashier/index',$data);
    }

  }

}
