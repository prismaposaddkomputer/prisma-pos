<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_item extends MY_Retail {

  var $access, $item_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_item'){
      $this->session->set_userdata(array('menu' => 'ret_item'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_item';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_item');
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

      $config['base_url'] = base_url().'ret_item/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_ret_item->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['item'] = $this->m_ret_item->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_ret_item->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['item'] = $this->m_ret_item->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('ret_item/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'ret_item/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    $this->load->model('ret_category/m_ret_category');
    $data['category_list'] = $this->m_ret_category->get_all();
    $this->load->model('ret_unit/m_ret_unit');
    $data['unit_list'] = $this->m_ret_unit->get_all();
    $this->load->model('ret_tax/m_ret_tax');
    $data['tax_list'] = $this->m_ret_tax->get_all();
    $data['item_list'] = $this->m_ret_item->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Item';
        $data['action'] = 'insert';
        $data['item'] = null;
        $this->view('ret_item/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Item';
        $data['item'] = $this->m_ret_item->get_by_id($id);
        $data['action'] = 'update';
        $this->view('ret_item/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;

    $last_id = $this->m_ret_item->get_last();
    if ($last_id == null) {
      $item_id = 1;
    }else{
      $item_id = $last_id->item_id+1;
    };

    $data['created_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $data['item_price_before_tax'] = price_to_num($data['item_price_before_tax']);

    // clear package
    $this->m_ret_item->clear_package($item_id);
    // insert package
    if(isset($data['item_detail_id'])){
      foreach ($data['item_detail_id'] as $key => $val) {
        $data_package = null;
        $data_package = array(
          "item_id" => $item_id,
          "item_detail_id" => $val,
          "item_detail_price" => $data['item_detail_price'][$key]
        );
        $this->m_ret_item->insert_package($data_package);
      }
    }

    unset($data['item_detail_id'],$data['item_detail_price']);

    $this->m_ret_item->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'ret_item');
  }

  public function edit($id)
  {
    $data['item']= $this->m_ret_item->get_specific($id);
    $this->load->view('ret_item/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $item_id = $data['item_id'];

    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $data['item_price_before_tax'] = price_to_num($data['item_price_before_tax']);

    // clear package
    $this->m_ret_item->clear_package($item_id);
    // insert package
    if(isset($data['item_detail_id'])){
      foreach ($data['item_detail_id'] as $key => $val) {
        $data_package = null;
        $data_package = array(
          "item_id" => $item_id,
          "item_detail_id" => $val,
          "item_detail_price" => $data['item_detail_price'][$key]
        );
        $this->m_ret_item->insert_package($data_package);
      }
    }

    unset($data['item_detail_id'],$data['item_detail_price']);

    $this->m_ret_item->update($item_id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'ret_item');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      // clear package
      $this->m_ret_item->clear_package($id);
      $this->m_ret_item->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'ret_item');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
