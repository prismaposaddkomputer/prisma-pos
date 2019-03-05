<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_harian extends MY_Restaurant {

  var $access, $billing_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_harian'){
      $this->session->set_userdata(array('menu' => 'res_harian'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_harian';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_harian');
    $this->load->model('res_cashier/m_res_cashier');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Transaksi Harian';

      $search = $this->session->userdata('search');
      if($search == null){
        $search['bulan'] = date('m');
        $search['tahun'] = date('Y');
      }

      $config['base_url'] = base_url().'res_harian/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);
      if($from == '') $from = 0;

      $num_rows = $this->m_res_harian->num_rows($search);
      $config['total_rows'] = $num_rows;
      $this->pagination->initialize($config);

      $data['search'] = $search;
      $data['billing'] = $this->m_res_harian->get_list($config['per_page'],$from,$search);

      $this->view('res_harian/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function search()
  {
    $data = $_POST;
    $this->session->set_userdata(array('search' => $data));
    redirect(base_url().'res_harian/index');
  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'res_harian/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Data';
        $data['action'] = 'insert';
        $data['billing'] = null;
        $this->view('res_harian/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Data';
        $data['billing'] = $this->m_res_harian->get_by_id($id);
        $data['action'] = 'update';
        $this->view('res_harian/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['total_transaksi'] = price_to_num($data['total_transaksi']);
    $data['tx_date'] = date_to_ind($data['tx_date']);
    $data['created_by'] = $this->session->userdata('user_realname');

    //get 
    $data['tx_receipt_no'] = substr($data['tx_date'],2,2).substr($data['tx_date'],5,2).substr($data['tx_date'],8,2)."000001";

    $this->m_res_harian->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'res_harian/index');
  }

  public function edit($id)
  {
    $data['billing']= $this->m_res_harian->get_specific($id);
    $this->load->view('res_harian/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['billing_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    $data['total_transaksi'] = price_to_num($data['total_transaksi']);
    $data['tx_date'] = date_to_ind($data['tx_date']);
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_res_harian->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'res_harian/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_res_harian->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'res_harian/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
