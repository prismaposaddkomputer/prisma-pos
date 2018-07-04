<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_promo extends MY_Retail {

  var $access, $promo_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_promo'){
      $this->session->set_userdata(array('menu' => 'ret_promo'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_promo';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_promo');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Promo';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'ret_promo/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_ret_promo->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['promo'] = $this->m_ret_promo->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_ret_promo->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['promo'] = $this->m_ret_promo->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('ret_promo/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'ret_promo/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    $this->load->model('ret_promo_type/m_ret_promo_type');
    $data['promo_type_list'] = $this->m_ret_promo_type->get_all();
    $this->load->model('ret_item/m_ret_item');
    $data['item'] = $this->m_ret_item->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $last = $this->m_ret_promo->get_last();
        if($last == null){
          $data['new_id'] = 1;
        }else{
          $data['new_id'] = $last->promo_id+1;
        }
        $data['title'] = 'Tambah Promo';
        $data['action'] = 'insert';
        $data['promo'] = null;
        $this->view('ret_promo/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Promo';
        $data['promo'] = $this->m_ret_promo->get_by_id($id);
        $data['action'] = 'update';
        $this->view('ret_promo/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $created_by = $this->session->userdata('user_realname');

    $data_promo = $data;
    $data_promo['promo_date_start'] = ind_to_date($data_promo['promo_date_start']);
    $data_promo['promo_date_end'] = ind_to_date($data_promo['promo_date_end']);
    $data_promo['created_by'] = $created_by;

    if ($data_promo['promo_type_id'] == 1) {
      $data_buyget = array(
        'promo_id' => $data['promo_id'],
        'buy_item_id' => $data['buy_item_id1'],
        'buy_amount' => $data['buy_amount1'],
        'get_item_id' => $data['get_item_id1'],
        'get_amount' => $data['get_amount1'],
        'created_by' => $created_by
      );

      $this->load->model('ret_promo_buyget/m_ret_promo_buyget');
      $this->m_ret_promo_buyget->insert($data_buyget);
    }else if ($data_promo['promo_type_id'] == 2) {
      $data_buyitem = array(
        'promo_id' => $data['promo_id'],
        'buy_item_id' => $data['buy_item_id2'],
        'buy_amount' => $data['buy_amount2'],
        'get_discount' => $data['get_discount2'],
        'created_by' => $created_by
      );

      $this->load->model('ret_promo_buyitem/m_ret_promo_buyitem');
      $this->m_ret_promo_buyitem->insert($data_buyitem);
    }
    if ($data_promo['promo_type_id'] == 3) {
      $data_buyall = array(
        'promo_id' => $data['promo_id'],
        'buy_amount' => $data['buy_amount3'],
        'get_discount' => $data['get_discount3'],
        'created_by' => $created_by
      );

      $this->load->model('ret_promo_buyall/m_ret_promo_buyall');
      $this->m_ret_promo_buyall->insert($data_buyall);
    }

    unset($data_promo['all'],
      $data_promo['buy_item_id1'],$data_promo['buy_amount1'],$data_promo['get_item_id1'],$data_promo['get_amount1'],
      $data_promo['buy_item_id2'],$data_promo['buy_amount2'],$data_promo['get_discount2'],
      $data_promo['buy_amount3'],$data_promo['get_discount3']);

    $this->m_ret_promo->insert($data_promo);

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'ret_promo/index');
  }

  public function edit($id)
  {
    $data['promo']= $this->m_ret_promo->get_specific($id);
    $this->load->view('ret_promo/update', $data);
  }

  public function update()
  {
    $data = $_POST;
    $updated_by = $this->session->userdata('user_realname');

    $promo_id = $data['promo_id'];

    if(!isset($data['promo_sunday'])){$data['promo_sunday'] = 0;};
    if(!isset($data['promo_monday'])){$data['promo_monday'] = 0;};
    if(!isset($data['promo_tuesday'])){$data['promo_tuesday'] = 0;};
    if(!isset($data['promo_wednesday'])){$data['promo_wednesday'] = 0;};
    if(!isset($data['promo_thursday'])){$data['promo_thursday'] = 0;};
    if(!isset($data['promo_friday'])){$data['promo_friday'] = 0;};
    if(!isset($data['promo_saturday'])){$data['promo_saturday'] = 0;};

    $data_promo = $data;
    $data_promo['promo_date_start'] = ind_to_date($data_promo['promo_date_start']);
    $data_promo['promo_date_end'] = ind_to_date($data_promo['promo_date_end']);
    $data_promo['updated_by'] = $updated_by;

    if ($data_promo['promo_type_id'] == 1) {
      $data_buyget = array(
        'promo_id' => $data['promo_id'],
        'buy_item_id' => $data['buy_item_id1'],
        'buy_amount' => $data['buy_amount1'],
        'get_item_id' => $data['get_item_id1'],
        'get_amount' => $data['get_amount1'],
        'updated_by' => $updated_by
      );

      $this->load->model('ret_promo_buyget/m_ret_promo_buyget');
      $this->m_ret_promo_buyget->update($promo_id, $data_buyget);
    }else if ($data_promo['promo_type_id'] == 2) {
      $data_buyitem = array(
        'promo_id' => $data['promo_id'],
        'buy_item_id' => $data['buy_item_id2'],
        'buy_amount' => $data['buy_amount2'],
        'get_discount' => $data['get_discount2'],
        'updated_by' => $updated_by
      );

      $this->load->model('ret_promo_buyitem/m_ret_promo_buyitem');
      $this->m_ret_promo_buyitem->update($promo_id, $data_buyitem);
    }else if ($data_promo['promo_type_id'] == 3) {
      $data_buyall = array(
        'promo_id' => $data['promo_id'],
        'buy_amount' => $data['buy_amount3'],
        'get_discount' => $data['get_discount3'],
        'updated_by' => $updated_by
      );

      $this->load->model('ret_promo_buyall/m_ret_promo_buyall');
      $this->m_ret_promo_buyall->update($promo_id, $data_buyall);
    }

    unset($data_promo['all'],
      $data_promo['buy_item_id1'],$data_promo['buy_amount1'],$data_promo['get_item_id1'],$data_promo['get_amount1'],
      $data_promo['buy_item_id2'],$data_promo['buy_amount2'],$data_promo['get_discount2'],
      $data_promo['buy_amount3'],$data_promo['get_discount3']);

    $this->m_ret_promo->update($promo_id, $data_promo);

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diperbarui!</div>');
    redirect(base_url().'ret_promo/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_ret_promo->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'ret_promo/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

}
