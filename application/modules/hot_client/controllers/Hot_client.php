<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_client extends MY_Hotel {

  var $access, $role_id;

  function __construct(){
    parent::__construct();

    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_client';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('hot_role/m_hot_role');
    $this->load->model('m_hot_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['title'] = 'Manajemen Client';
      $data['access'] = $this->access;

      $data['client'] = $this->m_hot_client->get_all();

      $this->view('hot_client/index',$data);
    } else {
      redirect(base_url().'error/error_403');
    }
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($this->access->_update == 1) {
      $data['title'] = 'Ubah Client';
      $data['user'] = $this->m_hot_client->get_by_id($id);
      $data['action'] = 'update';
      $this->view('hot_client/form', $data);
    } else {
      redirect(base_url().'error/error_403');
    }
  }

  public function edit($id)
  {
    $data['user']= $this->m_hot_client->get_by_id($id);
    $this->load->view('hot_client/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['client_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    $this->m_hot_client->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'hot_client/index');
  }

}
