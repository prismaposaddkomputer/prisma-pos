<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_client extends MY_Karaoke {

  var $access, $role_id;

  function __construct(){
    parent::__construct();
    $this->load->helper(array('form', 'url'));

    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_client';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('kar_role/m_kar_role');
    $this->load->model('m_kar_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['title'] = 'Manajemen Client';
      $data['access'] = $this->access;

      $data['client'] = $this->m_kar_client->get_all();

      $this->view('kar_client/index',$data);
    } else {
      redirect(base_url().'error/error_403');
    }
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($this->access->_update == 1) {
      $data['title'] = 'Ubah Client';
      $data['client'] = $this->m_kar_client->get_by_id($id);
      $data['action'] = 'update';
      $this->view('kar_client/form', $data);
    } else {
      redirect(base_url().'error/error_403');
    }
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['client_id'];

    $config['upload_path']          = './img/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('client_logo')){
      $file = array('upload_data' => $this->upload->data());
      $data['client_logo'] = $file['upload_data']['file_name'];
		}

    if(!isset($data['client_keyboard_status'])){
      $data['client_keyboard_status'] = 0;
    }

    $data['updated_by'] = $this->session->userdata('user_realname');
    $this->m_kar_client->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'kar_client/index');
  }

}
