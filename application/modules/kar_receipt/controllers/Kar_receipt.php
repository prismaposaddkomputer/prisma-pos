<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_receipt extends MY_Karaoke {

  var $access, $role_id;

  function __construct(){
    parent::__construct();

    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_receipt';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('kar_role/m_kar_role');
    $this->load->model('m_kar_receipt');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['title'] = 'Manajemen Struk';
      $data['access'] = $this->access;

      $data['receipt'] = $this->m_kar_receipt->get_all();

      $this->view('kar_receipt/index',$data);
    } else {
      redirect(base_url().'error/error_403');
    }
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($this->access->_update == 1) {
      $data['title'] = 'Ubah Struk';
      $data['receipt'] = $this->m_kar_receipt->get_by_id($id);
      $data['action'] = 'update';
      $this->view('kar_receipt/form', $data);
    } else {
      redirect(base_url().'error/error_403');
    }
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['receipt_id'];
    if(!isset($data['receipt_name'])){
      $data['receipt_name'] = 0;
    }
    if(!isset($data['receipt_street'])){
      $data['receipt_street'] = 0;
    }
    if(!isset($data['receipt_district'])){
      $data['receipt_district'] = 0;
    }
    if(!isset($data['receipt_city'])){
      $data['receipt_city'] = 0;
    }
    if(!isset($data['receipt_province'])){
      $data['receipt_province'] = 0;
    }
    if(!isset($data['receipt_npwp'])){
      $data['receipt_npwp'] = 0;
    }
    $data['updated_by'] = $this->session->userdata('user_realname');
    $this->m_kar_receipt->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'kar_receipt/index');
  }

}
