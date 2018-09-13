<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_guest extends MY_Karaoke {

  var $access, $guest_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_guest'){
      $this->session->set_userdata(array('menu' => 'kar_guest'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_guest';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_guest');
  }

	public function index($guest_type='')
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Member (Tamu Langganan)';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'kar_guest/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_kar_guest->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['guest_type'] = $this->m_kar_guest->get_list($config['per_page'],$from,$search_term = null,$guest_type);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_kar_guest->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['guest_type'] = $this->m_kar_guest->get_list($config['per_page'],$from,$search_term,$guest_type);
      }

      $this->view('kar_guest/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'kar_guest/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Member (Tamu Langganan)';
        $data['action'] = 'insert';
        $data['guest_type'] = null;
        $this->view('kar_guest/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Member (Tamu Langganan)';
        $data['guest_type'] = $this->m_kar_guest->get_by_id($id);
        $data['action'] = 'update';
        $this->view('kar_guest/form', $data);
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
    $this->m_kar_guest->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'kar_guest/index');
  }

  public function edit($id)
  {
    $data['guest_type']= $this->m_kar_guest->get_specific($id);
    $this->load->view('kar_guest/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['guest_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_kar_guest->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'kar_guest/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_kar_guest->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'kar_guest/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
