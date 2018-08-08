<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_category extends MY_Hotel {

  var $access, $category_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_category'){
      $this->session->set_userdata(array('menu' => 'hot_category'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_category';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_hot_category');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Tipe Kamar';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'hot_category/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_hot_category->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['category'] = $this->m_hot_category->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_hot_category->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['category'] = $this->m_hot_category->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('hot_category/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'hot_category/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Tipe Kamar';
        $data['action'] = 'insert';
        $data['category'] = null;
        $this->view('hot_category/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Tipe Kamar';
        $data['category'] = $this->m_hot_category->get_by_id($id);
        $data['action'] = 'update';
        $this->view('hot_category/form', $data);
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
    $data['category_price']=price_to_num($data['category_price']);
    $data['before_tax']=price_to_num($data['before_tax']);
    $data['tax']=price_to_num($data['tax']);
    $data['after_tax']=price_to_num($data['after_tax']);
    $this->m_hot_category->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'hot_category/index');
  }

  public function edit($id)
  {
    $data['category']= $this->m_hot_category->get_specific($id);
    $this->load->view('hot_category/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $id = $data['category_id'];
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $data['category_price']=price_to_num($data['category_price']);
    $data['before_tax']=price_to_num($data['before_tax']);
    $data['tax']=price_to_num($data['tax']);
    $data['after_tax']=price_to_num($data['after_tax']);
    $this->m_hot_category->update($id,$data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'hot_category/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_hot_category->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'hot_category/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
