<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_user extends MY_Retail {

  var $access, $role_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_user'){
      $this->session->set_userdata(array('menu' => 'ret_user'));
      $this->session->unset_userdata('search_term');
    }

    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_user';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('ret_role/m_ret_role');
    $this->load->model('m_ret_user');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['title'] = 'Manajemen Pengguna';
      $data['access'] = $this->access;

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'ret_user/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_ret_user->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['user'] = $this->m_ret_user->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_ret_user->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['user'] = $this->m_ret_user->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('ret_user/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'ret_user/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    $data['role_list'] = $this->m_ret_role->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Pengguna';
        $data['action'] = 'insert';
        $data['user'] = null;
        $this->view('ret_user/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah user';
        $data['user'] = $this->m_ret_user->get_by_id($id);
        $data['action'] = 'update';
        $this->view('ret_user/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['created_by'] = $this->session->userdata('user_realname');
    $data['user_password'] = md5($data['user_password']);
    unset($data['user_password_repeat']);
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_ret_user->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'ret_user/index');
  }

  public function edit($id)
  {
    $data['user']= $this->m_ret_user->get_specific($id);
    $this->load->view('ret_user/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['user_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_ret_user->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'ret_user/index');
  }

  public function update_password()
  {
    $data = $_POST;
    $id = $data['user_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');

    $current = $this->m_ret_user->get_by_id($id);

    if(md5($data['user_password_old']) != $current->user_password){
      $this->session->set_flashdata('status', '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-close" aria-hidden="true"></span><span class="sr-only"> Gagal:</span> Kata sandi lama salah!</div>');
      redirect(base_url().'ret_user/form/'.$id);
    }else if($data['user_password_new'] != $data['user_password_new_repeat']){
      $this->session->set_flashdata('status', '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-close" aria-hidden="true"></span><span class="sr-only"> Gagal:</span> Kata sandi baru tidak sama!</div>');
      redirect(base_url().'ret_user/form/'.$id);
    }else{
      $data['user_password'] = md5($data['user_password_new']);
      unset($data['user_password_old'],$data['user_password_new'],$data['user_password_new_repeat']);
      $this->m_ret_user->update($id,$data);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Kata sandi berhasil diubah!</div>');
      redirect(base_url().'ret_user/index');
    }
  }

  public function delete($id)
  {
    if ($this->access->_read == 1) {
      $this->m_ret_user->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'ret_user/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

}
