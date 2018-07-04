<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_stock_recap extends MY_Retail {

  var $access, $stock_recap_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_stock_recap'){
      $this->session->set_userdata(array('menu' => 'ret_stock_recap'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_stock_recap';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_stock_recap');
  }

  public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Rekap Stok';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      if($this->session->userdata('search_term') == null){
        $data['stock_recap'] = $this->m_ret_stock_recap->get_stock_recap($search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');

        $data['stock_recap'] = $this->m_ret_stock_recap->get_stock_recap($search_term);
      }

      $this->view('ret_stock_recap/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'ret_stock_recap/index');
  }

}
