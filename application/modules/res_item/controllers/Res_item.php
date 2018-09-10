<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_item extends MY_Restaurant {

  var $access, $item_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_item'){
      $this->session->set_userdata(array('menu' => 'res_item'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_item';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_item');
    $this->load->model('res_tax/m_res_tax');
    $this->load->model('res_client/m_res_client');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Item';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'res_item/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_res_item->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['item'] = $this->m_res_item->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_res_item->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['item'] = $this->m_res_item->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('res_item/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'res_item/index');
  }

  public function form($id = null)
  {
    $client = $this->m_res_client->get_all();
    $data['access'] = $this->access;
    $this->load->model('res_category/m_res_category');
    $data['category_list'] = $this->m_res_category->get_all();
    $this->load->model('res_unit/m_res_unit');
    $data['unit_list'] = $this->m_res_unit->get_all();
    $this->load->model('res_tax/m_res_tax');
    $data['item_list'] = $this->m_res_item->get_all();
    $data['tax_list'] = $this->m_res_tax->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Item';
        $data['action'] = 'insert';
        $data['item'] = null;
        $this->view('res_item/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Item';
        $data['item'] = $this->m_res_item->get_by_id($id);
        $data['action'] = 'update';
        if ($client->client_is_taxed == 0) {
          $data['item']->item_price = $data['item']->item_price_before_tax;
        }else{
          $data['item']->item_price = $data['item']->item_price_after_tax;
        }
        $this->view('res_item/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $client = $this->m_res_client->get_all();
    $tax = $this->m_res_tax->get_by_id($data['tax_id']);

    $last_id = $this->m_res_item->get_last();
    if ($last_id == null) {
      $item_id = 1;
    }else{
      $item_id = $last_id->item_id+1;
    };

    $data['created_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }

    $item_price = price_to_num($data['item_price']);
    if ($client->client_is_taxed == 0) {
      $data['item_price_before_tax'] = $item_price;
      $data['item_tax'] = ($tax->tax_ratio/100)*$item_price;
      $data['item_price_after_tax'] = $data['item_price_before_tax']+$data['item_tax'];
    }else{
      $data['item_price_after_tax'] = $item_price;
      $data['item_tax'] = ($tax->tax_ratio/(100+$tax->tax_ratio))*$data['item_price_after_tax'];
      $data['item_price_before_tax'] = $data['item_price_after_tax']-$data['item_tax'];
    }
    $data['tax_name'] = $tax->tax_name;
    $data['tax_ratio'] = $tax->tax_ratio;
    unset($data['item_price']);

    // clear package
    $this->m_res_item->clear_package($item_id);
    // insert package
    if(isset($data['item_detail_id'])){
      foreach ($data['item_detail_id'] as $key => $val) {
        $data_package = null;
        $data_package = array(
          "item_id" => $item_id,
          "item_detail_id" => $val,
          "item_detail_price" => $data['item_detail_price'][$key]
        );
        $this->m_res_item->insert_package($data_package);
      }
    }

    unset($data['item_detail_id'],$data['item_detail_price']);

    $this->m_res_item->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'res_item');
  }

  public function edit($id)
  {
    $data['item']= $this->m_res_item->get_specific($id);
    $this->load->view('res_item/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $item_id = $data['item_id'];
    $client = $this->m_res_client->get_all();
    $tax = $this->m_res_tax->get_by_id($data['tax_id']);

    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    
    $item_price = price_to_num($data['item_price']);
    if ($client->client_is_taxed == 0) {
      $data['item_price_before_tax'] = $item_price;
      $data['item_tax'] = ($tax->tax_ratio/100)*$item_price;
      $data['item_price_after_tax'] = $data['item_price_before_tax']+$data['item_price_after_tax'];
    }else{
      $data['item_price_after_tax'] = $item_price;
      $data['item_tax'] = ($tax->tax_ratio/(100+$tax->tax_ratio))*$data['item_price_after_tax'];
      $data['item_price_before_tax'] = $data['item_price_after_tax']-$data['item_tax'];
    }
    $data['tax_name'] = $tax->tax_name;
    $data['tax_ratio'] = $tax->tax_ratio;
    unset($data['item_price']);
    // clear package
    $this->m_res_item->clear_package($item_id);
    // insert package
    if(isset($data['item_detail_id'])){
      foreach ($data['item_detail_id'] as $key => $val) {
        $data_package = null;
        $data_package = array(
          "item_id" => $item_id,
          "item_detail_id" => $val,
          "item_detail_price" => $data['item_detail_price'][$key]
        );
        $this->m_res_item->insert_package($data_package);
      }
    }

    unset($data['item_detail_id'],$data['item_detail_price']);

    $this->m_res_item->update($item_id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'res_item');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      // clear package
      $this->m_res_item->clear_package($id);
      $this->m_res_item->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'res_item');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
