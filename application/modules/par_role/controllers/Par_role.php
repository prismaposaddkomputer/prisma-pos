<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Par_role extends MY_Parking {

  var $access, $role_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'par_role'){
      $this->session->set_userdata(array('menu' => 'par_role'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_par_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'par_role';
    $this->access = $this->m_par_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_par_role');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Role';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'par_role/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_par_role->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['role'] = $this->m_par_role->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_par_role->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['role'] = $this->m_par_role->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('par_role/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'par_role/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Role';
        $data['action'] = 'insert';
        $data['role'] = null;
        $this->view('par_role/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Role';
        $data['role'] = $this->m_par_role->get_by_id($id);
        $data['action'] = 'update';
        $this->view('par_role/form', $data);
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
    $this->m_par_role->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'par_role/index');
  }

  public function edit($id)
  {
    $data['role']= $this->m_par_role->get_specific($id);
    $this->load->view('par_role/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['role_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_par_role->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'par_role/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_par_role->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'par_role/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
