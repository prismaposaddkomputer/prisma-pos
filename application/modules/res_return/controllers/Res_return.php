<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_return extends MY_Restaurant {

  var $access, $tx_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'res_return'){
      $this->session->set_userdata(array('menu' => 'res_return'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_return';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_res_return');
    $this->load->model('res_stock/m_res_stock');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Retur Penjualan';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'res_return/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_res_return->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['return'] = $this->m_res_return->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_res_return->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['return'] = $this->m_res_return->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('res_return/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'res_return/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Retur Penjualan';
        $data['action'] = 'insert';
        $data['return'] = null;
        $this->view('res_return/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Retur Penjualan';
        $data['return'] = $this->m_res_return->get_by_id($id);
        $data['action'] = 'update';
        $this->view('res_return/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['created_by'] = $this->session->userdata('user_realname');

    $data_return = $data;
    $data_return['user_id'] = $this->session->userdata('user_id');
    $data_return['user_realname'] = $this->session->userdata('user_realname');
    $data_return['tx_date'] = date('Y-m-d');
    $data_return['tx_time'] = date('H:i:s');
    unset($data_return['item_id'],$data_return['item_price_after_tax'],
      $data_return['tx_amount'],$data_return['receipt_amount'],
      $data_return['item_name'],$data_return['return_amount']);

    $this->m_res_return->insert($data_return);
    $last = $this->m_res_return->get_last();

    foreach ($data['item_id'] as $key => $val) {
      $data_detail = null;
      $data_detail = array(
        'tx_id' => $last->tx_id,
        'item_id' => $data['item_id'][$key],
        'item_name' => $data['item_name'][$key],
        'item_price_after_tax' => $data['item_price_after_tax'][$key],
        'tx_amount' => $data['tx_amount'][$key],
        'return_amount' => $data['return_amount'][$key],
        'created_by' => $data['created_by']
      );
      $this->m_res_return->insert_detail($data_detail);
      $data_stock = array(
        'tx_id' => $last->tx_id,
        'tx_type' => 'TXR',
        'tx_date' => date('Y-m-d'),
        'item_id' => $data['item_id'][$key],
        'stock_in' => $data['return_amount'][$key]
      );
      $this->m_res_stock->insert($data_stock);
    }

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'res_return/index');
  }

  public function get_billing()
  {
    $tx_id_source = $this->input->post('tx_receipt_no');
    $data = $this->m_res_return->get_billing($tx_id_source);

    echo json_encode($data);
  }

  public function detail($id)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Retur Penjualan';
    $data['return'] = $this->m_res_return->get_detail($id);

    $this->view('detail',$data);
  }

}
