<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Par_dashboard extends MY_Parking {

  var $access, $role_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'dashboard'){
      $this->session->set_userdata(array('menu' => 'dashboard'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_par_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->dashboard_controller = 'par_dashboard';
    $this->access = $this->m_par_config->get_permission($this->role_id, $this->dashboard_controller);

    $this->load->model('m_par_dashboard');
  }

  public function index()
  {
    $data['num_in'] = $this->m_par_dashboard->num_in();
    $data['num_out'] = $this->m_par_dashboard->num_out();
    $data['income_today'] = $this->m_par_dashboard->income_today();
    $data['income_month'] = $this->m_par_dashboard->graph_income_month();
    $data['income_month_amount'] = $this->m_par_dashboard->graph_income_month_amount();
    $data['income_date'] = $this->m_par_dashboard->graph_income_date();
    $data['income_date_amount'] = $this->m_par_dashboard->graph_income_date_amount();
    $data['last_park_in'] = $this->m_par_dashboard->last_park_in();
    $data['last_park_out'] = $this->m_par_dashboard->last_park_out();

    $this->view('index', $data);
  }

}
