<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_extra extends MY_Hotel {

  var $access, $extra_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_extra'){
      $this->session->set_userdata(array('menu' => 'hot_extra'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_extra';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_hot_extra');
    $this->load->model('hot_client/m_hot_client');
    $this->load->model('hot_charge_type/m_hot_charge_type');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Extra';
      $data['tax'] = $this->m_hot_charge_type->get_by_id(1);
      
      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'hot_extra/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_hot_extra->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['extra'] = $this->m_hot_extra->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_hot_extra->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['extra'] = $this->m_hot_extra->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('hot_extra/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'hot_extra/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Data Extra';
        $data['action'] = 'insert';
        $data['extra'] = null;
        $this->view('hot_extra/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $client = $this->m_hot_client->get_all();
        $tax = $this->m_hot_charge_type->get_by_id(1);
        $data['title'] = 'Ubah Data Extra';
        $data['extra'] = $this->m_hot_extra->get_by_id($id);
        if ($client->client_is_taxed == 1) {
          $data['extra']->extra_charge = ((100+$tax->charge_type_ratio)/100)*$data['extra']->extra_charge;
        }
        $data['action'] = 'update';
        $this->view('hot_extra/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);
    $data['created_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $data['extra_charge']=price_to_num($data['extra_charge']);
    if ($client->client_is_taxed == 1) {
      $data['extra_charge'] = (100/(100+$tax->charge_type_ratio))*$data['extra_charge'];
    }
    $this->m_hot_extra->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'hot_extra/index');
  }

  public function edit($id)
  {
    $data['extra']= $this->m_hot_extra->get_specific($id);
    $this->load->view('hot_extra/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['extra_id'];
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $data['extra_charge']=price_to_num($data['extra_charge']);
    if ($client->client_is_taxed == 1) {
      $data['extra_charge'] = (100/(100+$tax->charge_type_ratio))*$data['extra_charge'];
    }
    $this->m_hot_extra->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'hot_extra/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_hot_extra->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'hot_extra/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
