<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ret_po extends MY_Retail {

  var $access, $role_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'ret_po'){
      $this->session->set_userdata(array('menu' => 'ret_po'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_ret_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'ret_po';
    $this->access = $this->m_ret_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_ret_po');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Purchase Order';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'ret_po/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_ret_po->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['po'] = $this->m_ret_po->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_ret_po->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['po'] = $this->m_ret_po->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('ret_po/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'ret_po/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    $this->load->model('ret_item/m_ret_item');
    $this->load->model('ret_supplier/m_ret_supplier');
    $data['supplier'] = $this->m_ret_supplier->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $last = $this->m_ret_po->get_last();
        if ($last == null) {
          $data['tx_id'] = 1;
          $data['tx_receipt_no'] = date('ymd').'000001';
        }else{
          $data['tx_id'] = $last->tx_id+1;
          if ($last->tx_date != date('Y-m-d')) {
            $data['tx_receipt_no'] = date('ymd').'000001';
          }else{
            $number = substr($last->tx_receipt_no,6,12);
            $number = intval($number)+1;
            $data['tx_receipt_no'] = date('ymd').str_pad($number, 6, '0', STR_PAD_LEFT);
          }
        }
        $data['title'] = 'Tambah Purchase Order';
        $data['action'] = 'insert';
        $data['po'] = null;
        $data['item'] = $this->m_ret_item->get_all();
        $this->view('ret_po/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Purchase Order';
        $data['action'] = 'update';
        $data['po'] = $this->m_ret_po->get_detail($id,'TXP');
        if($data['po']->tx_status == 0){
          $data['item'] = $this->m_ret_item->get_all();
          $this->view('ret_po/form', $data);
        }else{
          redirect(base_url().'ret_po/index');
        }
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function insert()
  {
    $data = $_POST;
    $data['created_by'] = $this->session->userdata('user_realname');
    $data_po = array(
      'tx_receipt_no' => $data['tx_receipt_no'],
      'tx_type' => $data['tx_type'],
      'supplier_id' => $data['supplier_id'],
      'tx_date' => ind_to_date($data['tx_date']),
      'tx_notes' => $data['tx_notes'],
      'tx_po_no' => $data['tx_po_no'],
      'tx_status' => 0,
      'created_by' => $data['created_by']
    );
    $this->m_ret_po->insert($data_po);
    foreach ($data['item_id'] as $key => $val) {
      $data_item = array(
        'item_id' => $val,
        'tx_id' => $data['tx_id'],
        'tx_type' => $data['tx_type'],
        'tx_date' => ind_to_date($data['tx_date']),
        'stock_demand' => $data['po'][$key],
        'stock_price' => price_to_num($data['stock_price'][$key]),
        'created_by' => $data['created_by']
      );
      $this->m_ret_po->insert_detail($data_item);
    }
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'ret_po/index');
  }

  public function update()
  {
    $data = $_POST;
    $tx_id = $_POST['tx_id'];
    if ($data['tx_status'] == -1) {
      $this->m_ret_po->cancel($tx_id);
    }else{
      //update po
      $data_po = array(
        'tx_po_receiver' => $data['tx_po_receiver'],
        'tx_status' => $data['tx_status']
      );
      $this->m_ret_po->update($tx_id,$data_po);
      //load model
      $this->load->model('ret_stock/m_ret_stock');
      //update po detail
      foreach ($data['item_id'] as $key => $val) {
        $stock_id = $data['stock_id'][$key];
        $data_item = array(
          'stock_receive' => $data['stock_receive'][$key],
          'updated_by' => $this->session->userdata('user_realname')
        );
        $this->m_ret_po->update_detail($stock_id,$data_item);
        //insert into stock
        if ($data['tx_status'] == 1) {
          $data_stock = array(
            'tx_id' => $data['tx_id'],
            'tx_type' => $data['tx_type'],
            'tx_date' => ind_to_date($data['tx_date']),
            'item_id' => $data['item_id'][$key],
            'po' => $data['stock_receive'][$key],
            'stock_price' => $data['stock_price'][$key],
            'created_by' => $this->session->userdata('user_realname')
          );
          echo '<pre>' . var_export($data_stock, true) . '</pre>';
          $this->m_ret_stock->insert($data_stock);
        }
      }
    }
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil disimpan!</div>');
    redirect(base_url().'ret_po/index');
  }

  public function detail($tx_id,$tx_type)
  {
    $data['access'] = $this->access;
    $data['title'] = 'Detail Purchase Order';
    $data['detail'] = $this->m_ret_po->get_detail($tx_id,$tx_type);

    $this->view('ret_po/detail',$data);
  }

}
