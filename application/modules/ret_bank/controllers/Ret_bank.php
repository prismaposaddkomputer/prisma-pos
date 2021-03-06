<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_bank extends MY_Retail {

  var $access, $bank_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_bank'){
      $this->session->set_userdata(array('menu' => 'ret_bank'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_bank';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_bank');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Bank';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'ret_bank/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_ret_bank->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['bank'] = $this->m_ret_bank->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_ret_bank->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['bank'] = $this->m_ret_bank->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('ret_bank/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'ret_bank/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    $this->load->model('ret_payment_type/m_ret_payment_type');
    $data['payment_type_list'] = $this->m_ret_payment_type->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Bank';
        $data['action'] = 'insert';
        $data['bank'] = null;
        $this->view('ret_bank/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Bank';
        $data['bank'] = $this->m_ret_bank->get_by_id($id);
        $data['action'] = 'update';
        $this->view('ret_bank/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['created_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_ret_bank->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'ret_bank/index');
  }

  public function edit($id)
  {
    $data['bank']= $this->m_ret_bank->get_specific($id);
    $this->load->view('ret_bank/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['bank_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_ret_bank->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'ret_bank/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_ret_bank->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'ret_bank/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
