<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_module extends MY_Retail {

  var $access, $role_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'module'){
      $this->session->set_userdata(array('menu' => 'module'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_module';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_module');
  }

	public function index()
  {
    if($this->access->_read == 1){
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Modul';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'ret_module/index/';

      if($this->session->userdata('search_term') == null){
        $nuret_rows = $this->m_ret_module->num_rows();
        $data['module'] = $this->m_ret_module->get_list();
      }else{
        $search_term = $this->session->userdata('search_term');
        $data['module'] = $this->m_ret_module->get_list($search_term);
      }

      $this->view('index',$data);
    }else{
      redirect(base_url().'app_error/error/403');
    }
  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'ret_module/index');
  }

  public function form($id = null)
  {
    $data['module_all'] = $this->m_ret_module->get_all();
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Modul';
        $data['action'] = 'insert';
        $data['module'] = null;
        $this->view('form', $data);
      }else{
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Modul';
        $data['module'] = $this->m_ret_module->get_by_id($id);
        $data['action'] = 'update';
        $this->view('form', $data);
      }else{
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['created_by'] = $this->session->userdata('user_realname');
    unset($data['module_id_old']);
    $this->m_ret_module->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'ret_module/index');
  }

  public function edit($id)
  {
    $data['module']= $this->m_ret_module->get_specific($id);
    $this->load->view('update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['module_id_old'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    unset($data['module_id_old']);
    $this->m_ret_module->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'ret_module/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_ret_module->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'ret_module/index');
    }else{
      redirect(base_url().'app_error/error/403');
    }
  }

}
