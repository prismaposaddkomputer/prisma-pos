<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_permission extends MY_Restaurant {

  var $access, $role_id, $type_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_permission'){
      $this->session->set_userdata(array('menu' => 'res_permission'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_permission';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('res_role/m_res_role');
    $this->load->model('m_res_permission');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Hak Akses';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'res_permission/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_res_role->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['role'] = $this->m_res_role->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_res_role->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['role'] = $this->m_res_role->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('res_permission/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'res_permission/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($this->access->_update == 1) {
      $data['role_id'] = $id;
      $data['title'] = 'Detail Hak Akses';
      $data['action'] = 'update';
      $this->load->model('m_res_permission');
      $data['permission'] = $this->m_res_permission->get_all($id);
      $this->view('res_permission/form', $data);
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['type_id'] = $this->session->userdata('type_id');
    $data['created_by'] = $this->session->userdata('user_realname');
    $this->m_res_permission->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'res_permission/index');
  }

  public function edit($id)
  {
    $data['permission']= $this->m_res_permission->get_specific($id);
    $this->load->view('res_permission/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $this->load->model('res_permission/m_res_permission');

    $this->m_res_permission->empty_list($data['role_id']);

    $data2 = array();

    if(isset($data['_create'])){
      foreach ($data['_create'] as $row) {
        $data2[$row]['_create'] = 1;
      }
    }

    if(isset($data['_read'])){
      foreach ($data['_read'] as $row) {
        $data2[$row]['_read'] = 1;
      }
    }

    if(isset($data['_update'])){
      foreach ($data['_update'] as $row) {
        $data2[$row]['_update'] = 1;
      }
    }

    if(isset($data['_delete'])){
      foreach ($data['_delete'] as $row) {
        $data2[$row]['_delete'] = 1;
      }
    }

    foreach ($data2 as $key => $val) {
      $val['module_id'] = $key;
      $val['role_id'] = $data['role_id'];
      $val['created_by'] = $this->session->userdata('user_realname');
      $this->m_res_permission->insert($val);
    }

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dirubah!</div>');
    redirect(base_url().'res_permission/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_res_permission->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'res_permission/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
