<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_dashboard extends MY_Hotel {

  var $access, $role_id, $type_id;

  function __construct(){
    parent::__construct();

    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_dashboard';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('hot_role/m_hot_role');
    $this->load->model('m_hot_dashboard');
    $this->load->model('m_hot_payment');

  }

	public function index()
  {
    if ($this->access->_read == 1) {

      $data['booking_today'] = $this->m_hot_dashboard->booking_today();
      $data['total_guest_today'] = $this->m_hot_dashboard->total_guest_today();
      $data['total_room_available'] = $this->m_hot_dashboard->total_room_available();
      $data['total_service_available'] = $this->m_hot_dashboard->total_service_available();
      $data['graph_sell_amount'] = $this->m_hot_dashboard->graph_sell_amount();
      $data['graph_profit_month'] = $this->m_hot_dashboard->graph_profit_month();
      $data['graph_profit_amount'] = $this->m_hot_dashboard->graph_profit_amount();
      $data['most_sell'] = $this->m_hot_dashboard->most_sell();
      $data['new_item'] = $this->m_hot_dashboard->new_item();

      $data['booking'] = $this->m_hot_payment->get_all_booking();
      $data['guest'] = $this->m_hot_payment->get_all_tamu();

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'hot_payment/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_hot_payment->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['payment'] = $this->m_hot_payment->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_hot_payment->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['payment'] = $this->m_hot_payment->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('index', $data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }
}
