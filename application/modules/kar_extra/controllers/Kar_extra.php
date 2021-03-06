<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kar_extra extends MY_Karaoke {

  var $access, $extra_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'kar_extra'){
      $this->session->set_userdata(array('menu' => 'kar_extra'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_kar_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'kar_extra';
    $this->access = $this->m_kar_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_kar_extra');
    $this->load->model('kar_client/m_kar_client');
    $this->load->model('kar_charge_type/m_kar_charge_type');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Extra';
      $data['tax'] = $this->m_kar_charge_type->get_by_id(1);
      
      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'kar_extra/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_kar_extra->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['extra'] = $this->m_kar_extra->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_kar_extra->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['extra'] = $this->m_kar_extra->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('kar_extra/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'kar_extra/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Data Extra';
        $data['action'] = 'insert';
        $data['extra'] = null;
        $this->view('kar_extra/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $client = $this->m_kar_client->get_all();
        $tax = $this->m_kar_charge_type->get_by_id(1);
        $data['title'] = 'Ubah Data Extra';
        $data['extra'] = $this->m_kar_extra->get_by_id($id);
        if ($client->client_is_taxed == 1) {
          $data['extra']->extra_charge = ((100+$tax->charge_type_ratio)/100)*$data['extra']->extra_charge;
        }
        $data['action'] = 'update';
        $this->view('kar_extra/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $client = $this->m_kar_client->get_all();
    $tax = $this->m_kar_charge_type->get_by_id(1);
    $data['created_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $data['extra_charge']=price_to_num($data['extra_charge']);
    if ($client->client_is_taxed == 1) {
      $data['extra_charge'] = (100/(100+$tax->charge_type_ratio))*$data['extra_charge'];
    }
    $this->m_kar_extra->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'kar_extra/index');
  }

  public function edit($id)
  {
    $data['extra']= $this->m_kar_extra->get_specific($id);
    $this->load->view('kar_extra/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['extra_id'];
    $client = $this->m_kar_client->get_all();
    $tax = $this->m_kar_charge_type->get_by_id(1);
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $data['extra_charge']=price_to_num($data['extra_charge']);
    if ($client->client_is_taxed == 1) {
      $data['extra_charge'] = (100/(100+$tax->charge_type_ratio))*$data['extra_charge'];
    }
    $this->m_kar_extra->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'kar_extra/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_kar_extra->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'kar_extra/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
