<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class Hot_reservation extends MY_Hotel {

  var $access, $billing_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_reservation'){
      $this->session->set_userdata(array('menu' => 'hot_reservation'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_reservation';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('hot_client/m_hot_client');
    $this->load->model('hot_charge_type/m_hot_charge_type');
    $this->load->model('hot_billing/m_hot_billing');
    $this->load->model('m_hot_reservation');
    $this->load->model('hot_member/m_hot_member');
    $this->load->model('hot_room_type/m_hot_room_type');
    $this->load->model('hot_room/m_hot_room');
    $this->load->model('hot_extra/m_hot_extra');
    $this->load->model('hot_service/m_hot_service');
    $this->load->model('hot_fnb/m_hot_fnb');
    $this->load->model('hot_non_tax/m_hot_non_tax');
    $this->load->model('hot_denda/m_hot_denda');
    $this->load->model('hot_billing_room/m_hot_billing_room');
    $this->load->model('hot_billing_extra/m_hot_billing_extra');
    $this->load->model('hot_billing_service/m_hot_billing_service');
    $this->load->model('hot_billing_fnb/m_hot_billing_fnb');
    $this->load->model('hot_billing_custom/m_hot_billing_custom');
    $this->load->model('hot_discount/m_hot_discount');
    $this->load->model('hot_guest/m_hot_guest');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Pemesanan';

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'hot_reservation/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      // Proses Denda
      $data['billing_get_all'] = $this->m_hot_reservation->get_all();
      if ($data['billing_get_all'] != null) {
        foreach ($data['billing_get_all'] as $row) {
          if ($row->billing_status !='3') {
            $this->process_denda($row->billing_id);
            $this->update_all_billing($row->billing_id);
          }
        }
      }
      // End Proses Denda

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_hot_reservation->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['billing'] = $this->m_hot_reservation->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_hot_reservation->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['billing'] = $this->m_hot_reservation->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('hot_reservation/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'hot_reservation/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    $data['id'] = $id;
    $data['member'] = $this->m_hot_member->get_all();
    $data['room_type'] = $this->m_hot_room_type->get_all();
    $data['extra'] = $this->m_hot_extra->get_all();
    $data['service'] = $this->m_hot_service->get_all();
    $data['fnb'] = $this->m_hot_fnb->get_all();
    $data['non_tax'] = $this->m_hot_non_tax->get_all();
    $data['charge_type'] = $this->m_hot_charge_type->get_all();
    $data['discount_room'] = $this->m_hot_reservation->discount_room();
    $data['list_member'] = $this->m_hot_guest->get_all();
    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Data Pemesanan';
        $data['action'] = 'insert';
        $data['billing'] = null;
        //make receipt no
        // get last billing
        $last_billing = $this->m_hot_billing->get_last();
        //declare billing variable
        if ($last_billing == null) {
          $data['billing_id'] = 1;
          $data['billing_receipt_no'] = date('ymd').'000001';
          $this->m_hot_reservation->new_billing($data['billing_receipt_no']);
        }else{
          // status billing
          // -1 cancel
          // 0 empty
          // 1 proses
          // 2 complete          
          // 2 transaksi selesai       
          if ($last_billing->billing_status == 0) {
            $data['billing_id'] = $last_billing->billing_id;
            $data['billing_receipt_no'] = $last_billing->billing_receipt_no;
            // empty detail billing
            $this->m_hot_reservation->empty_detail($data['billing_id']);
          } else {
            // get new last billing
            $data['billing_id'] = $last_billing->billing_id+1;
            if (date('Y-m-d', strtotime($last_billing->created)) != date('Y-m-d')) {
              $data['billing_receipt_no'] = date('ymd').'000001';
            }else{
              $number = substr($last_billing->billing_receipt_no,6,12);
              $number = intval($number)+1;
              $data['billing_receipt_no'] = date('ymd').str_pad($number, 6, '0', STR_PAD_LEFT);
            }
            
            // insert new billing
            $this->m_hot_reservation->new_billing($data['billing_receipt_no']);
          }
        }
        $data['billing_id_name'] = 'TRS-'.$data['billing_receipt_no'];    

        $this->view('hot_reservation/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Ubah Data Reservasi';
        $data['billing'] = $this->m_hot_billing->get_by_id($id);
        $data['action'] = 'update';
        $data['billing_room'] = $this->m_hot_reservation->get_billing_room($id);
        $data['get_billing_room'] = $this->m_hot_reservation->get_billing_room_by_id($id);

        $this->view('hot_reservation/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }
  }

  public function process_denda($id) {

    $data['billing'] = $this->m_hot_billing->get_by_id($id);
    $data['billing_room'] = $this->m_hot_reservation->get_billing_room($id);
    $data['get_billing_room'] = $this->m_hot_reservation->get_billing_room_by_id($id);

    if ($data['billing']->billing_status !='3') {
          
      // Proses Denda
      $denda = $this->m_hot_denda->get_by_id('1');
      $jam_sekarang = date('Y-m-d H:i:s');
      
      foreach ($data['get_billing_room'] as $row) {

        if ($row->room_st_denda !='2') {
          
          if ($row->room_type_tarif_kamar == '1') {
            $billing_time_in = date('Y-m-d H:i:s', strtotime('+'.round($row->room_type_duration,0,PHP_ROUND_HALF_UP).' days', strtotime($data['billing']->billing_date_in.' '.$data['billing']->billing_time_in)));
            $jam_akhir = date('Y-m-d H:i:s', strtotime('+'.round($denda->denda_duration,0,PHP_ROUND_HALF_UP).' hours', strtotime($billing_time_in)));
          }else{
            $billing_time_in = date('Y-m-d H:i:s', strtotime('+'.round($row->room_type_duration,0,PHP_ROUND_HALF_UP).' hours', strtotime($data['billing']->billing_date_in.' '.$data['billing']->billing_time_in)));
            $jam_akhir = date('Y-m-d H:i:s', strtotime('+'.round($denda->denda_duration,0,PHP_ROUND_HALF_UP).' hours', strtotime($billing_time_in)));
          }

          $jam_akhir_hari_berikutnya = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($data['billing']->billing_date_in.' '.$data['billing']->billing_time_in)));

          // $billing_out = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($jam_akhir_hari_berikutnya)));
          // print("Jam Sekarang : ".$jam_sekarang." <br> Billing Time IN : ".$billing_time_in." <br> Jam Akhir : ".$jam_akhir." <br> Jam Akhir Hari Berikutnya ".$jam_akhir_hari_berikutnya." <br> Billing Out ".$billing_out);
          // exit();

          if ($jam_sekarang >= $jam_akhir) {

            // Hitung Selisih Waktu
            $awal  = new DateTime($jam_akhir);
            $akhir = new DateTime(); // Waktu sekarang
            $diff  = $awal->diff($akhir);
            $selisih_jam = $diff->h;
            // End Hitung Selisih Waktu

            if ($jam_sekarang >= $jam_akhir_hari_berikutnya) {

              if ($row->room_type_tarif_kamar == '2') {

                $get_hot_room_type = $this->m_hot_reservation->get_hot_room_type($row->room_type_id);
                
                // ----------------------------------- Update ke hot_billing_room ----------------------------------- //

                $client = $this->m_hot_client->get_all();
                $tax = $this->m_hot_charge_type->get_by_id_active(1);
                $service = $this->m_hot_charge_type->get_by_id_active(2);
                $other = $this->m_hot_charge_type->get_by_id_active(3);

                // Denda berubah jadi 0
                $data_update_billing_room['room_type_denda'] = 0;
                // room_type_tarif_kamar berubah jadi 1 = hari
                $data_update_billing_room['room_type_tarif_kamar'] = 1;
                // room_type_charga berubah jadi harga per hari
                $data_update_billing_room['room_type_charge'] = $get_hot_room_type->room_type_charge;
                // Durasi jadi tambah 1
                $data_update_billing_room['room_type_duration'] = 1;
                $data_update_billing_room['room_type_subtotal'] = round($get_hot_room_type->room_type_charge,0,PHP_ROUND_HALF_UP)*$data_update_billing_room['room_type_duration'];
                $data_update_billing_room['room_type_total'] = round($get_hot_room_type->room_type_charge,0,PHP_ROUND_HALF_UP)*$data_update_billing_room['room_type_duration']-$row->room_type_discount;

                if ($client->client_is_taxed == 0) {
                  // Hitung Pajak Sebelum Pajak
                  $room_type_tax = 0;
                  if ($tax != null) {
                    $room_type_tax += $data_update_billing_room['room_type_subtotal'] * ($tax->charge_type_ratio/100);
                  }
                  $room_type_service = 0;
                  if ($service != null) {
                    $room_type_service += $data_update_billing_room['room_type_subtotal'] * ($service->charge_type_ratio/100);
                  }
                  $room_type_other = 0;
                  if ($other) {
                    $room_type_other += $data_update_billing_room['room_type_subtotal'] * ($other->charge_type_ratio/100);
                  }

                  $data_update_billing_room['room_type_before_discount'] = $data_update_billing_room['room_type_subtotal'] + $room_type_tax + $room_type_service + $room_type_other;

                }else{
                  // Hitung Pajak Setelah Pajak

                  $data_update_billing_room['room_type_before_discount'] = $data_update_billing_room['room_type_total'];

                  $room_type_tax = 0;
                  if ($tax != null) {
                    $room_type_tax = ($tax->charge_type_ratio/(100 + $tax->charge_type_ratio))*$data_update_billing_room['room_type_before_discount'];
                  }
                  $room_type_service = 0;
                  if ($service != null) {
                    $room_type_service = ($service->charge_type_ratio/(100 + $service->charge_type_ratio))*$data_update_billing_room['room_type_before_discount'];
                  }
                  $room_type_other = 0;
                  if ($other != null) {
                    $room_type_other = ($other->charge_type_ratio/(100 + $other->charge_type_ratio))*$data_update_billing_room['room_type_before_discount'];
                  }

                }

                $data_update_billing_room['room_type_tax'] = $room_type_tax;
                $data_update_billing_room['room_type_service'] = $room_type_service;
                $data_update_billing_room['room_type_other'] = $room_type_other;
                $this->m_hot_reservation->update_billing_room($row->billing_id,$row->room_id,$data_update_billing_room);

                // ----------------------------------- Update ke hot_billing ----------------------------------- //

                $billing_out = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($jam_akhir_hari_berikutnya)));
                //

                if ($data['billing']->billing_down_payment =='0') {
                  $data_update_billing['billing_payment'] = 0;
                  $data_update_billing['billing_change'] = 0;
                  $data_update_billing['billing_down_payment'] = $data['billing']->billing_payment - $data['billing']->billing_change;
                }

                // $this->update_all_billing($id);

                $data_update_billing['billing_date_in'] = substr($jam_akhir_hari_berikutnya,0,-9);
                $data_update_billing['billing_time_in'] = substr($jam_akhir_hari_berikutnya,11);
                $data_update_billing['billing_date_out'] = substr($billing_out,0,-9);
                $data_update_billing['billing_time_out'] = substr($billing_out,11);
                $this->m_hot_reservation->update_billing($row->billing_id,$data_update_billing);

              }else{
                // ----------------------------------- Update ke hot_billing_room ----------------------------------- //

                $client = $this->m_hot_client->get_all();
                $tax = $this->m_hot_charge_type->get_by_id_active(1);
                $service = $this->m_hot_charge_type->get_by_id_active(2);
                $other = $this->m_hot_charge_type->get_by_id_active(3);

                // Denda berubah jadi 0
                $data_update_billing_room['room_type_denda'] = 0;
                // Durasi jadi tambah 1
                $data_update_billing_room['room_type_duration'] = round($row->room_type_duration,0,PHP_ROUND_HALF_UP)+1;
                $data_update_billing_room['room_type_subtotal'] = round($row->room_type_charge,0,PHP_ROUND_HALF_UP)*$data_update_billing_room['room_type_duration'];
                $data_update_billing_room['room_type_total'] = round($row->room_type_charge,0,PHP_ROUND_HALF_UP)*$data_update_billing_room['room_type_duration']-$row->room_type_discount;

                if ($client->client_is_taxed == 0) {
                  // Hitung Pajak Sebelum Pajak
                  $room_type_tax = 0;
                  if ($tax != null) {
                    $room_type_tax += $data_update_billing_room['room_type_subtotal'] * ($tax->charge_type_ratio/100);
                  }
                  $room_type_service = 0;
                  if ($service != null) {
                    $room_type_service += $data_update_billing_room['room_type_subtotal'] * ($service->charge_type_ratio/100);
                  }
                  $room_type_other = 0;
                  if ($other) {
                    $room_type_other += $data_update_billing_room['room_type_subtotal'] * ($other->charge_type_ratio/100);
                  }

                  $data_update_billing_room['room_type_before_discount'] = $data_update_billing_room['room_type_subtotal'] + $room_type_tax + $room_type_service + $room_type_other;

                }else{
                  // Hitung Pajak Setelah Pajak

                  $data_update_billing_room['room_type_before_discount'] = $data_update_billing_room['room_type_total'];

                  $room_type_tax = 0;
                  if ($tax != null) {
                    $room_type_tax = ($tax->charge_type_ratio/(100 + $tax->charge_type_ratio))*$data_update_billing_room['room_type_before_discount'];
                  }
                  $room_type_service = 0;
                  if ($service != null) {
                    $room_type_service = ($service->charge_type_ratio/(100 + $service->charge_type_ratio))*$data_update_billing_room['room_type_before_discount'];
                  }
                  $room_type_other = 0;
                  if ($other != null) {
                    $room_type_other = ($other->charge_type_ratio/(100 + $other->charge_type_ratio))*$data_update_billing_room['room_type_before_discount'];
                  }

                }

                $data_update_billing_room['room_type_tax'] = $room_type_tax;
                $data_update_billing_room['room_type_service'] = $room_type_service;
                $data_update_billing_room['room_type_other'] = $room_type_other;
                $this->m_hot_reservation->update_billing_room($row->billing_id,$row->room_id,$data_update_billing_room);

                // ----------------------------------- Update ke hot_billing ----------------------------------- //

                $billing_out = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($jam_akhir_hari_berikutnya)));
                //

                if ($data['billing']->billing_down_payment =='0') {
                  $data_update_billing['billing_payment'] = 0;
                  $data_update_billing['billing_change'] = 0;
                  $data_update_billing['billing_down_payment'] = $data['billing']->billing_payment - $data['billing']->billing_change;
                }

                $data_update_billing['billing_date_in'] = substr($jam_akhir_hari_berikutnya,0,-9);
                $data_update_billing['billing_time_in'] = substr($jam_akhir_hari_berikutnya,11);
                $data_update_billing['billing_date_out'] = substr($billing_out,0,-9);
                $data_update_billing['billing_time_out'] = substr($billing_out,11);
                $this->m_hot_reservation->update_billing($row->billing_id,$data_update_billing);
              }

            }else{
              if ($row->room_st_denda == '1') {
                $data_update_billing_room['room_type_denda'] = round($denda->denda_charge,0,PHP_ROUND_HALF_UP) * $selisih_jam;
                $data_update_billing_room['room_type_total'] = round($row->room_type_subtotal,0,PHP_ROUND_HALF_UP) + $data_update_billing_room['room_type_denda']-$row->room_type_discount;
                $this->m_hot_reservation->update_billing_room($row->billing_id,$row->room_id,$data_update_billing_room);
              }
            }

          }

        }
        
      }
      // End Proses Denda

    }

  }

  function get_arr_checked_value($data) {
      // format result : 01#02
      $result = '';
      foreach($data as $key => $val) {
          if($val != '') {
              $result .= $val;
          }
      }
      return $result;
  }

  public function insert()
  {
    $data = $_POST;   

    $data['billing_status'] = 1;
    $data['billing_date_in'] = ind_to_date($data['billing_date_in']);
    $data['billing_date_out'] = ind_to_date($data['billing_date_out']);
    $data['billing_down_payment'] = price_to_num($data['billing_down_payment']);

    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_realname'] = $this->session->userdata('user_realname');

    $guest_type = $data['guest_type'];

    // Tamu Baru
    // $guest_name = $data['guest_name'];
    // $guest_gender = $data['guest_gender'];
    // $guest_phone = $data['guest_phone'];
    // $guest_id_type = $data['guest_id_type'];
    // $guest_id_no = $data['guest_id_no'];

    //Member (Tamu Langganan)
    // $form_guest_name = $data['form_guest_name'];
    // $form_guest_gender = $data['form_guest_gender'];
    // $form_guest_phone = $data['form_guest_phone'];
    // $form_guest_id_type = $data['form_guest_id_type'];
    // $form_guest_id_no = $data['form_guest_id_no'];

    if ($data['form_guest_gender'] == "Laki-laki") {
      $form_guest_gender = "L";
    }else if($data['form_guest_gender'] == "Perempuan"){
      $form_guest_gender = "P";
    }

    if ($guest_type == '0') {
      unset($data['form_guest_id'], $data['form_guest_name'], $data['form_guest_gender'], $data['form_guest_phone'], $data['form_guest_id_type'], $data['form_guest_id_no']);
      //
      $data['guest_id'] = $data['guest_id'];
      $data['guest_name'] = $data['guest_name'];
      // $data['guest_gender'] = $data['guest_gender'];
      $data['guest_gender'] = ($data['guest_gender'] != '') ? $this->get_arr_checked_value($data['guest_gender']) : '';
      $data['guest_phone'] = $data['guest_phone'];
      $data['guest_id_type'] = $data['guest_id_type'];
      $data['guest_id_no'] = $data['guest_id_no'];
    }else if ($guest_type == '1') {
      $data['guest_id'] = $data['form_guest_id'];
      $data['guest_name'] = $data['form_guest_name'];
      $data['guest_gender'] = $data['form_guest_gender'];
      $data['guest_phone'] = $data['form_guest_phone'];
      $data['guest_id_type'] = $data['form_guest_id_type'];
      $data['guest_id_no'] = $data['form_guest_id_no'];
      //
      unset($data['form_guest_id'], $data['form_guest_name'], $data['form_guest_gender'], $data['form_guest_phone'], $data['form_guest_id_type'], $data['form_guest_id_no']);
    }

    $action = $data['action'];
    unset($data['action']);
    
    $this->m_hot_reservation->update($data['billing_id'],$data);

    $this->update_all_billing($data['billing_id']);

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    if ($action == 'save_payment') {
      redirect(base_url().'hot_reservation/payment/'.$data['billing_id']);
    } elseif ($action == 'cetak_struk_dp') {
      redirect(base_url().'hot_reservation/cetak_struk_dp/'.$data['billing_id']);
    } else {
      redirect(base_url().'hot_reservation/index');
    }
  }

  public function update_all_billing($billing_id)
  {
    $room = $this->m_hot_reservation->get_billing_room($billing_id);
    $extra = $this->m_hot_reservation->get_billing_extra($billing_id);
    $service = $this->m_hot_reservation->get_billing_service($billing_id);
    $fnb = $this->m_hot_reservation->get_billing_fnb($billing_id);
    $non_tax = $this->m_hot_reservation->get_billing_non_tax($billing_id);
    $custom = $this->m_hot_reservation->get_billing_custom($billing_id);

    $billing_subtotal = 0;
    $billing_tax = 0;
    $billing_service = 0;
    $billing_other = 0;
    $billing_total = 0;
    $billing_discount = 0;
    $billing_denda = 0;

    foreach ($room as $row) {
      // $billing_subtotal += $row->room_type_subtotal;
      $billing_subtotal += $row->room_type_subtotal + $row->room_type_denda - $row->room_type_discount;
      // hitung pajak 
      $billing_tax += $row->room_type_tax;
      $billing_service += $row->room_type_service;
      $billing_other += $row->room_type_other;
      //
      // $billing_total += $row->room_type_total;
      // $billing_total += $row->room_type_before_discount;
      $billing_total += $row->room_type_before_discount + $row->room_type_denda - $row->room_type_discount;
      $billing_discount += $row->room_type_discount;
      $billing_denda += $row->room_type_denda;
    }

    foreach ($extra as $row) {
      $billing_subtotal += $row->extra_subtotal;
      $billing_tax += $row->extra_tax;
      $billing_total += $row->extra_total;
    }

    foreach ($service as $row) {
      $billing_subtotal += $row->service_subtotal;
      $billing_tax += $row->service_tax;
      $billing_total += $row->service_total;
    }

    foreach ($fnb as $row) {
      $billing_subtotal += $row->fnb_subtotal;
      $billing_tax += $row->fnb_tax;
      $billing_total += $row->fnb_total;
    }

    foreach ($non_tax as $row) {
      $billing_subtotal += $row->non_tax_total;
      $billing_total += $row->non_tax_total;
    }

    foreach ($custom as $row) {
      $billing_subtotal += $row->custom_total;
      $billing_total += $row->custom_total;
    }

    $data['billing_subtotal'] = $billing_subtotal;
    $data['billing_tax'] = $billing_tax;
    $data['billing_service'] = $billing_service;
    $data['billing_other'] = $billing_other;
    $data['billing_discount'] = $billing_discount;
    $data['billing_denda'] = $billing_denda;
    $data['billing_total'] = $billing_total;

    $this->m_hot_reservation->update($billing_id,$data);
  }

  public function detail($id)
  {
    $data['access'] = $this->access;
    $data['id'] = $id;
    $data['title'] = 'Detail Pemesanan';

    $data['billing'] = $this->m_hot_reservation->get_billing($id);
    $data['charge_type'] = $this->m_hot_charge_type->get_all();

    $this->view('hot_reservation/detail',$data);
  }

  public function payment($id)
  {
    $data['access'] = $this->access;
    $data['id'] = $id;
    //
    $data['action'] = 'payment_action';
    //
    $data['title'] = 'Pembayaran';
    $data['billing'] = $this->m_hot_reservation->get_billing($id);
    $data['charge_type'] = $this->m_hot_charge_type->get_all();

    $this->view('hot_reservation/payment',$data);
  }

  public function payment_action()
  {
    $data = $_POST;
    $data['updated_by'] = $this->session->userdata('user_realname');
    //
    $id = $data['billing_id'];
    // $save_print = $data['save_print'];
    // unset($data['save_print']);
    //
    $data['billing_discount_custom'] = price_to_num($data['billing_discount_custom']);
    $billing = $this->m_hot_reservation->get_billing($id);
    $billing_total = $billing->billing_total - $billing->billing_down_payment - $data['billing_discount_custom'];
    //
    $data['billing_payment'] = price_to_num($data['billing_payment']);
    if ($billing->billing_down_payment_type == 1) {
      $data['billing_change'] = $data['billing_payment'] - $billing_total;
    }else {
      $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100);
      //
      if ($billing->billing_down_payment > $billing->billing_total) {
        $data['billing_change'] = $billing->billing_down_payment-$billing->billing_total;
      }else{
        if ($dp_prosen > $billing->billing_total) {
          $data['billing_change'] = $dp_prosen - $billing->billing_total;
        }else {
          $data['billing_change'] = $data['billing_payment'] - ($billing->billing_total - $dp_prosen);
        }
      }
    }
    $data['billing_status'] = 2;
    //
    $this->m_hot_billing->update($id,$data);
    // if ($save_print == 'print_pdf') {
    //   $this->frame_pdf($id, '');
    // }else if($save_print == 'print_struk'){
    //   $this->reservation_print_struk($id);
    // }

    $this->m_hot_reservation->update($data['billing_id'],$data);
    $id = $data['billing_id'];

    $client = $this->m_hot_client->get_all();
    $bill = $this->m_hot_reservation->get_billing($id);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $dashboard = array(
      'auth'=> 'prismapos.addkomputer',
      'apikey'=> '69f86eadd81650164619f585bb017316',
      'app_type_id'=> 4,
      'client_id'=> $client->client_id,
      'pos_sn'=> $client->client_serial_number,
      'npwpd'=> $client->client_npwpd,
      'customer_name'=> $bill->guest_name,
      'no_receipt'=> 'TRS-'.$bill->billing_receipt_no,
      'tx_id'=> $bill->billing_id,
      'tx_date'=> $bill->billing_date_in,
      'tx_time'=> $bill->billing_time_in,
      'tx_total_before_tax'=> $bill->billing_subtotal,
      'tax_code'=> $tax->charge_type_code,
      'tax_ratio'=> $tax->charge_type_ratio,
      'tx_total_tax'=> $bill->billing_tax,
      'tx_total_after_tax'=> $bill->billing_subtotal+$bill->billing_tax,
      'tx_total_grand'=> $bill->billing_subtotal+$bill->billing_tax,
      'user_id'=> $bill->user_id,
      'user_realname'=> $bill->user_realname,
      'created'=> $bill->created,
    );

    echo json_encode($dashboard);
  }

  public function edit($id)
  {
    $data['billing']= $this->m_hot_billing->get_specific($id);
    $data['room_id'] = $this->m_hot_billing_room->get_by_billing_id($id);
    $this->load->view('hot_billing/update', $data);
  }

  public function cancel($billing_id)
  {
    $data = array(
      'billing_status' => -1
    );
    $this->m_hot_reservation->update($billing_id,$data);
    redirect(base_url().'hot_reservation/index');
  }

  public function complete($billing_id)
  {
    $data = array(
      'billing_status' => 3
    );
    $this->m_hot_reservation->update($billing_id,$data);
    redirect(base_url().'hot_reservation/index');
  }

  public function update()
  {
    $data = $_POST;

    $data['billing_status'] = 1;
    $data['billing_date_in'] = ind_to_date($data['billing_date_in']);
    $data['billing_date_out'] = ind_to_date($data['billing_date_out']);
    $data['billing_down_payment'] = price_to_num($data['billing_down_payment']);

    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_realname'] = $this->session->userdata('user_realname');

    $guest_type = $data['guest_type'];

    // Tamu Baru
    // $guest_name = $data['guest_name'];
    // $guest_gender = $data['guest_gender'];
    // $guest_phone = $data['guest_phone'];
    // $guest_id_type = $data['guest_id_type'];
    // $guest_id_no = $data['guest_id_no'];

    //Member (Tamu Langganan)
    // $form_guest_name = $data['form_guest_name'];
    // $form_guest_gender = $data['form_guest_gender'];
    // $form_guest_phone = $data['form_guest_phone'];
    // $form_guest_id_type = $data['form_guest_id_type'];
    // $form_guest_id_no = $data['form_guest_id_no'];

    if ($data['form_guest_gender'] == "Laki-laki") {
      $form_guest_gender = "L";
    }else if($data['form_guest_gender'] == "Perempuan"){
      $form_guest_gender = "P";
    }

    if ($guest_type == '0') {
      unset($data['form_guest_id'], $data['form_guest_name'], $data['form_guest_gender'], $data['form_guest_phone'], $data['form_guest_id_type'], $data['form_guest_id_no']);
      //
      $data['guest_id'] = $data['guest_id'];
      $data['guest_name'] = $data['guest_name'];
      $data['guest_gender'] = ($data['guest_gender'] != '') ? $this->get_arr_checked_value($data['guest_gender']) : '';
      $data['guest_phone'] = $data['guest_phone'];
      $data['guest_id_type'] = $data['guest_id_type'];
      $data['guest_id_no'] = $data['guest_id_no'];
    }else if ($guest_type == '1') {
      $data['guest_id'] = $data['form_guest_id'];
      $data['guest_name'] = $data['form_guest_name'];
      $data['guest_gender'] = $data['form_guest_gender'];
      $data['guest_phone'] = $data['form_guest_phone'];
      $data['guest_id_type'] = $data['form_guest_id_type'];
      $data['guest_id_no'] = $data['form_guest_id_no'];
      //
      unset($data['form_guest_id'], $data['form_guest_name'], $data['form_guest_gender'], $data['form_guest_phone'], $data['form_guest_id_type'], $data['form_guest_id_no']);
    }

    $action = $data['action'];
    unset($data['action']);
    
    $this->m_hot_reservation->update($data['billing_id'],$data);

    $data_update = array(
      'billing_id' => $data['billing_id'],
      'billing_date_in' => $data['billing_date_in'],
      'billing_time_in' => $data['billing_time_in'],
      'billing_date_out' => $data['billing_date_out'],
      'billing_time_out' => $data['billing_time_out'],
    );
    
    // $this->update_billing_room($data_update);
    $this->update_all_billing($data['billing_id']);

    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    // redirect(base_url().'hot_reservation/index');
    if ($action == 'save_payment') {
      redirect(base_url().'hot_reservation/payment/'.$data['billing_id']);
    } elseif ($action == 'cetak_struk_dp') {
      redirect(base_url().'hot_reservation/cetak_struk_dp/'.$data['billing_id']);
    } else {
      redirect(base_url().'hot_reservation/index');
    }
  }

  public function reservation_print_pdf($billing_id)
  {
    $data['title'] = "Laporan Pemesanan Pembayaran";
    $data['client'] = $this->m_hot_client->get_all();
    //
    $data['billing'] = $this->m_hot_reservation->get_billing($billing_id);
    $data['charge_type'] = $this->m_hot_charge_type->get_all();
    $data['date_now'] = date("Y-m-d");
    $data['time_now'] = date("H:i:s");

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-Pemesanan-pembayaran-".$data['billing']->billing_receipt_no.".pdf";
    $this->pdf->load_view('print_pdf', $data);
  }

  public function frame_pdf($billing_id, $url = '')
  {
    $data['billing_id'] = $billing_id;
    $data['url'] = $url;

    $this->view('hot_reservation/frame_pdf', $data);
  }

  public function reservation_print_struk($billing_id, $url)
  {
    $title = "Laporan Pemesanan Pembayaran";
    $client = $this->m_hot_client->get_all();
    //
    $billing = $this->m_hot_reservation->get_billing($billing_id);
    $charge_type = $this->m_hot_charge_type->get_all();
    $date_now = date("Y-m-d");
    $time_now = date("H:i:s");
    //

    //print
    $this->load->library("EscPos.php");

    try {
      $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");
         
      $printer = new Escpos\Printer($connector);

      //print image
      if ($client->client_logo !='') {
        $img = Escpos\EscposImage::load("img/".$client->client_logo);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> bitImage($img);
        $printer -> feed();
      }
      //Keterangan Wajib Pajak
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);

      if ($client->client_logo == '') {
        $printer -> setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
        $printer -> text($client->client_name."\n");
        $printer -> setUnderline(Escpos\Printer::UNDERLINE_NONE);
      }

      $printer -> text($client->client_street.','.$client->client_district."\n");
      $printer -> text($client->client_city."\n");
      $printer -> text("NPWPD : ".$client->client_npwpd."\n"); 
      $printer -> text('TRS-'.$billing->billing_receipt_no."\n");
      //Judul
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      // $printer -> text(substr($billing->user_realname,0,12).' '.convert_date($billing->created));
      $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind(date("Y-m-d")).' '.date("H:i:s"));
      $printer -> feed();
      $printer -> text('--------------------------------');
      //
      $check_in_left = "IN/Masuk";
      $check_in_right = date_to_ind($billing->billing_date_in).' '.$billing->billing_time_in;
      $printer -> text(print_justify($check_in_left, $check_in_right, 10, 19, 3));
      $check_out_left = "OUT/Keluar";
      $check_out_right = date_to_ind($billing->billing_date_out).' '.$billing->billing_time_out;
      $printer -> text(print_justify($check_out_left, $check_out_right, 10, 19, 3));
      $printer -> text('--------------------------------');
      //Keterangan Tamu
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text("Detail Tamu :");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Nama    : ".substr($billing->guest_name,0,22));
      $printer -> feed();
      if ($billing->guest_phone !='') {
        $phone = $billing->guest_phone;
      }else {
        $phone = "-";
      }
      $printer -> text("No Telp : ".$phone);

      if ($billing->guest_id_type == '1') {
        $kategori_id = "-";
      }elseif ($billing->guest_id_type == '2') {
        $kategori_id = "KTP";
        $id_no = "(".$billing->guest_id_no.")";
      }elseif ($billing->guest_id_type == '3') {
        $kategori_id = "SIM";
        $id_no = "(".$billing->guest_id_no.")";
      }elseif ($billing->guest_id_type == '4') {
        $kategori_id = "Lainnya";
        $id_no = "(".$billing->guest_id_no.")";
      }

      $printer -> feed();
      $printer -> text("No ID   : ".$kategori_id.$id_no);
      $printer -> feed();
      $printer -> text('--------------------------------');
      //Keterangan Pemesanan
      // Kamar
      if ($billing->room != null){
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Room :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->room as $row){
          // Nama Room
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->room_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $room_type_subtotal = num_to_price($row->room_type_charge);
          }else{
            $room_type_subtotal = num_to_price($row->room_type_before_discount/$row->room_type_duration);
          }
          //
          if ($client->client_is_taxed == 0) {
            $room_type_total = num_to_price($row->room_type_subtotal);
          }else{
            $room_type_total = num_to_price($row->room_type_before_discount);
          }

          if ($row->room_type_tarif_kamar == '1') {
            $duration = 'Hari';
          }else{
            $duration = 'Jam';
          }
          //
          $printer -> text(round($row->room_type_duration,0,PHP_ROUND_HALF_UP)." ".$duration." X ".$room_type_subtotal." = ".$room_type_total);
          $printer -> feed();

          // Diskon Room
          if ($row->room_type_discount !='0') {
            $printer -> text("Diskon = (".num_to_price($row->room_type_discount).")");
            $printer -> feed();
          }

          // Denda
          if ($row->room_type_denda !='0') {
            $printer -> text("Denda = ".num_to_price($row->room_type_denda));
            $printer -> feed();
          }
        }
      }
      // Extra
      if ($billing->extra != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Extra :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->extra as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->extra_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $extra_charge_sub_total = num_to_price($row->extra_charge);
          }else{
            $extra_charge_sub_total = num_to_price($row->extra_total/$row->extra_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $extra_charge_total = num_to_price($row->extra_subtotal);
          }else{
            $extra_charge_total = num_to_price($row->extra_total);
          }
          //
          $printer -> text(round($row->extra_amount,0,PHP_ROUND_HALF_UP)." X ".$extra_charge_sub_total." = ".$extra_charge_total);
          $printer -> feed();
        }
      }
      // Pelayanan
      if ($billing->service != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Pelayanan :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->service as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->service_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $service_charge_sub_total = num_to_price($row->service_charge);
          }else{
            $service_charge_sub_total = num_to_price($row->service_total/$row->service_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $service_charge_total = num_to_price($row->service_subtotal);
          }else{
            $service_charge_total = num_to_price($row->service_total);
          }
          //
          $printer -> text(round($row->service_amount,0,PHP_ROUND_HALF_UP)." X ".$service_charge_sub_total." = ".$service_charge_total);
          $printer -> feed();
        }
      }
      // F&B
      if ($billing->fnb != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("F&B :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->fnb as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->fnb_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $fnb_charge_sub_total = num_to_price($row->fnb_charge);
          }else{
            $fnb_charge_sub_total = num_to_price($row->fnb_total/$row->fnb_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $fnb_charge_total = num_to_price($row->fnb_subtotal);
          }else{
            $fnb_charge_total = num_to_price($row->fnb_total);
          }
          //
          $printer -> text(round($row->fnb_amount,0,PHP_ROUND_HALF_UP)." X ".$fnb_charge_sub_total." = ".$fnb_charge_total);
          $printer -> feed();
        }
      }
      // Non Pajak
      if ($billing->non_tax != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Non Pajak :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->non_tax as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->non_tax_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          $printer -> text(round($row->non_tax_amount,0,PHP_ROUND_HALF_UP)." X ".num_to_price($row->non_tax_charge)." = ".num_to_price($row->non_tax_total));
          $printer -> feed();
        }
      }
      // Custom
      if ($billing->custom != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Kustom :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->custom as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->custom_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          $printer -> text(round($row->custom_amount,0,PHP_ROUND_HALF_UP)." X ".num_to_price($row->custom_charge)." = ".num_to_price($row->custom_total));
          $printer -> feed();
        }
      }
      $printer -> text('--------------------------------');
      //
      if ($billing->billing_down_payment_type == 1){
        $uang_muka = num_to_price($billing->billing_down_payment);
      }
      else{
        $uang_muka = round($billing->billing_down_payment,0,PHP_ROUND_HALF_UP)." %";
      }

      if ($billing->billing_down_payment > $billing->billing_total){
        $sisa_bayar = num_to_price(0);
      }
      else{
        if ($billing->billing_down_payment_type == 1){
          $sisa_bayar = num_to_price($billing->billing_total-$billing->billing_down_payment-$billing->billing_discount_custom);
        }
        else{
          $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100);

          if ($dp_prosen > $billing->billing_total){
            $sisa_bayar = num_to_price(0);
          }
          else{
            $sisa_bayar = num_to_price($billing->billing_total-$dp_prosen);
          }
        }
      }
      //
      $space_array = array(
        strlen(num_to_price($billing->billing_total)),
        strlen($uang_muka),
        strlen($sisa_bayar),
        strlen(num_to_price($billing->billing_payment)),
        strlen(num_to_price($billing->billing_change)),
        strlen(num_to_price($billing->billing_discount_custom)),
      );
      $l_max = max($space_array);
      $l_1 = $l_max - strlen(num_to_price($billing->billing_total));
      $s_1 = '';
      for ($i=0; $i < $l_1; $i++) {
        $s_1 .= ' ';
      };
      $l_2 = $l_max - strlen(num_to_price($billing->billing_down_payment));
      $s_2 = '';
      for ($i=0; $i < $l_2; $i++) {
        $s_2 .= ' ';
      };
      $l_3 = $l_max - strlen($sisa_bayar);
      $s_3 = '';
      for ($i=0; $i < $l_3; $i++) {
        $s_3 .= ' ';
      };
      $l_4 = $l_max - strlen(num_to_price($billing->billing_payment));
      $s_4 = '';
      for ($i=0; $i < $l_4; $i++) {
        $s_4 .= ' ';
      };
      $l_5 = $l_max - strlen(num_to_price($billing->billing_change));
      $s_5 = '';
      for ($i=0; $i < $l_5; $i++) {
        $s_5 .= ' ';
      };
      $l_6 = $l_max - strlen(num_to_price($billing->billing_subtotal));
      $s_6 = '';
      for ($i=0; $i < $l_6; $i++) {
        $s_6 .= ' ';
      };
      $l_7 = $l_max - strlen(num_to_price($billing->billing_discount_custom));
      $s_7 = '';
      for ($i=0; $i < $l_7; $i++) {
        $s_7 .= ' ';
      };

      foreach ($charge_type as $row){

        if ($row->charge_type_id == '1') {
          $numb = "7";
          $charge_type_money = num_to_price($billing->billing_tax);
        }else if ($row->charge_type_id == '2') {
          $numb = "8";
          $charge_type_money = num_to_price($billing->billing_service);
        }else if ($row->charge_type_id == '3') {
          $numb = "9";
          $charge_type_money = num_to_price($billing->billing_other);
        }

        $l_[$numb] = $l_max - strlen($charge_type_money);
        $s_[$numb] = '';
        for ($i=0; $i < $l_[$numb]; $i++) {
          $s_[$numb] .= ' ';
        };
      }

      if ($client->client_is_taxed == 0){
        // Sebelum pajak
        $printer -> text("Subtotal = ".$s_6.num_to_price($billing->billing_subtotal));
        $printer -> feed();

        foreach ($charge_type as $row){
          //
          if ($row->charge_type_id == '1') {
            $numb = "7";
            $charge_type_money = num_to_price($billing->billing_tax);
          }else if ($row->charge_type_id == '2') {
            $numb = "8";
            $charge_type_money = num_to_price($billing->billing_service);
          }else if ($row->charge_type_id == '3') {
            $numb = "9";
            $charge_type_money = num_to_price($billing->billing_other);
          }
          //
          $printer -> text($row->charge_type_name." = ".$s_[$numb].$charge_type_money);
          $printer -> feed();
        }
      }

      //
      $printer -> feed();
      if ($client->client_is_taxed == 0){
        $name_total = "Total";
      }else {
        $name_total = "Total Bersih";
      }
      $printer -> text('Diskon Kustom = '.$s_7.num_to_price($billing->billing_discount_custom));
      $printer -> feed();
      $printer -> text($name_total.' = '.$s_1.num_to_price($billing->billing_total));
      $printer -> feed();
      $printer -> text('Uang Muka = '.$s_2.$uang_muka);
      $printer -> feed();
      $printer -> text('Sisa Bayar = '.$s_3.$sisa_bayar);
      $printer -> feed();
      $printer -> feed();
      $printer -> text('Dibayar = '.$s_4.num_to_price($billing->billing_payment));
      $printer -> feed();
      $printer -> text('Kembalian = '.$s_5.num_to_price($billing->billing_change));
      $printer -> feed();
      $printer -> feed();
      $printer -> text('Terimakasih atas kunjungan anda.');
      //
      $printer -> feed();
      $printer -> feed();
      $printer -> feed();
      $printer -> feed();

      /* Close printer */
      $printer -> close();
    } catch (Exception $e) {
      echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }
    //
    if ($url !='') {
      redirect(base_url().$url.'/detail/'.$billing_id);
    }else {
      redirect(base_url().'hot_reservation');
    }
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_hot_billing->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'hot_reservation/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }
  }

  public function get_member()
  {
    $member_id = $this->input->post('member_id');
    $data = $this->m_hot_member->get_by_id($member_id);

    echo json_encode($data);
  }

  public function get_room()
  {
    $client = $this->m_hot_client->get_all();
    $room_type_id = $this->input->post('room_type_id');
    $raw = $this->m_hot_room->get_by_room_type_id($room_type_id);
    $room_type = $this->m_hot_room_type->get_by_id($room_type_id);
    
    $add = 0;
    $add_hour = 0;
    if ($client->client_is_taxed == 1) {
      $charge_type = $this->m_hot_charge_type->get_all();
      foreach ($charge_type as $row) {
        $add += $room_type->room_type_charge*$row->charge_type_ratio/100;
        $add_hour += $room_type->room_type_charge_hour*$row->charge_type_ratio/100;
      }
    }

    // Per Hari
    $room_type->room_type_charge += $add;
    $room_type->room_type_charge = round($room_type->room_type_charge,0,PHP_ROUND_HALF_UP);

    // Per Jam
    $room_type->room_type_charge_hour += $add_hour;
    $room_type->room_type_charge_hour = round($room_type->room_type_charge_hour,0,PHP_ROUND_HALF_UP);

    $data = array(
      'room' => array(),
      'room_type' => $room_type
    );

    if ($raw == null) {
      array_push($data['room'], array('id' => '0', 'text' => '-- Pilih Room --'));
    } else {
      array_push($data['room'], array('id' => '0', 'text' => '-- Pilih Room --'));
      foreach ($raw as $row) {
        array_push($data['room'], array('id' => $row->room_id, 'text' => $row->room_name));
      }
    }
    
    echo json_encode($data);
  }

  public function get_room_type_denda()
  {
    $client = $this->m_hot_client->get_all();
    $billing_id = $this->input->post('billing_id');
    $room_id = $this->input->post('room_id');
    //
    $hot_billing = $this->m_hot_reservation->get_billing_by_billing_id($billing_id);
    $hot_billing_room = $this->m_hot_reservation->get_billing_room_by_billing_id_and_room_id($billing_id, $room_id);
    $denda = $this->m_hot_denda->get_by_id('1');
    //
    $jam_sekarang = date('Y-m-d H:i:s');

    $billing_time_in = date('Y-m-d H:i:s', strtotime('+'.round($hot_billing_room->room_type_duration,0,PHP_ROUND_HALF_UP).' hours', strtotime($hot_billing->billing_date_in.' '.$hot_billing->billing_time_in)));
    $jam_akhir = date('Y-m-d H:i:s', strtotime('+'.round($denda->denda_duration,0,PHP_ROUND_HALF_UP).' hours', strtotime($billing_time_in)));

    // print("Jam Sekarang : ".$jam_sekarang." - Billing Time IN : ".$billing_time_in." - Jam Akhir : ".$jam_akhir."\n");

    if ($jam_sekarang >= $jam_akhir) {

      // Hitung Selisih Waktu
      $awal  = new DateTime($jam_akhir);
      $akhir = new DateTime(); // Waktu sekarang
      $diff  = $awal->diff($akhir);
      $selisih_jam = $diff->h;
      // End Hitung Selisih Waktu

      print($selisih_jam);
      exit();

      if ($selisih_jam > 0) {
        if ($hot_billing_room->room_st_denda == '2') {
          $room_type_denda = round($denda->denda_charge,0,PHP_ROUND_HALF_UP) * $selisih_jam;
        }
      }

      $data = array(
        'room_type_denda' => $room_type_denda
      );
    }
    
    echo json_encode($data);
  }

  public function get_validate_room()
  {
    $room_id = $this->input->get('room_id');
    $billing_date_in = $this->input->get('billing_date_in');
    $validate = $this->m_hot_reservation->validate_room_id($room_id, $billing_date_in);
    //
    $result = "true";
    if($validate == true) $result = "false";
    //
    echo json_encode(array(
      'result' => $result
    ));
  }

  public function get_tamu_langganan()
  {
    $client = $this->m_hot_client->get_all();
    $guest_id = $this->input->post('guest_id');
    $guest = $this->m_hot_guest->get_by_id($guest_id);

    $guest->guest_name = $guest->guest_name;
    if ($guest->guest_gender == 'L') {
      $guest_gender = "Laki-laki";
    }else{
      $guest_gender = "Perempuan";
    }
    $guest->guest_gender = $guest_gender;
    $guest->guest_phone = $guest->guest_phone;
    $guest->guest_id_type = $guest->guest_id_type;
    $guest->guest_id_no = $guest->guest_id_no;
    if ($guest->guest_id_type == '1') {
      $guest_name = "(Tidak Ada)";
    }elseif ($guest->guest_id_type == '2') {
      $guest_name = "(KTP)";
    }elseif ($guest->guest_id_type == '3') {
      $guest_name = "(SIM)";
    }elseif ($guest->guest_id_type == '4') {
      $guest_name = "(Lainnya)";
    }
    $guest->guest_id_type_name = $guest_name;

    $data = array(
      'guest' => $guest
    );
    
    echo json_encode($data);
  }

  public function add_room()
  {
    $data = $_POST;

    $client = $this->m_hot_client->get_all();
    // Biaya Lain-lain
    $tax = $this->m_hot_charge_type->get_by_id_active(1);
    $service = $this->m_hot_charge_type->get_by_id_active(2);
    $other = $this->m_hot_charge_type->get_by_id_active(3);

    $room = $this->m_hot_reservation->room_detail($data['room_id']);
    $discount = $this->m_hot_discount->get_by_id($data['discount_id_room']);
    
    if ($client->client_is_taxed == 0) {
      // Setingan harga sebelum pajak
      $room_type_charge = price_to_num($data['room_type_charge']);
      // Hitung maju
      // $room_type_subtotal = price_to_num($data['room_type_total']);
      $room_type_subtotal = price_to_num($data['room_type_total']);
      // $room_type_tax += $room_type_subtotal * $tax->charge_type_ratio;
      $room_type_tax = 0;
      if ($tax != null) {
        $room_type_tax += $room_type_subtotal * ($tax->charge_type_ratio/100);
      }
      $room_type_service = 0;
      if ($service != null) {
        $room_type_service += $room_type_subtotal * ($service->charge_type_ratio/100);
      }
      $room_type_other = 0;
      if ($other) {
        $room_type_other += $room_type_subtotal * ($other->charge_type_ratio/100);
      }

      $room_type_before_discount = $room_type_subtotal + $room_type_tax + $room_type_service + $room_type_other;

      // Diskon
      if ($discount->discount_type == '1') {
        if ($discount->discount_id == '1') {
          $room_type_discount = $discount->discount_amount;
          $room_type_total = $room_type_before_discount - $room_type_discount - $room_type_tax - $room_type_service - $room_type_other + price_to_num($data['room_type_denda']);
        }else{
          $room_type_discount = ($discount->discount_amount/100);
          $room_type_total = $room_type_before_discount * $room_type_discount - $room_type_tax - $room_type_service - $room_type_other + price_to_num($data['room_type_denda']);
        }
      }else{
        $room_type_discount = $discount->discount_amount;
        $room_type_total = $room_type_before_discount - $room_type_discount - $room_type_tax - $room_type_service - $room_type_other + price_to_num($data['room_type_denda']);
      }
    } else {
      // Settingan harga setelah pajak
      $room_type_before_discount = price_to_num($data['room_type_total']);
      // hitung persen semua setelah pajak/ hitung mundur
      $room_type_tax = 0;
      if ($tax != null) {
        $room_type_tax = ($tax->charge_type_ratio/(100 + $tax->charge_type_ratio))*$room_type_before_discount;
      }
      $room_type_service = 0;
      if ($service != null) {
        $room_type_service = ($service->charge_type_ratio/(100 + $service->charge_type_ratio))*$room_type_before_discount;
      }
      $room_type_other = 0;
      if ($other != null) {
        $room_type_other = ($other->charge_type_ratio/(100 + $other->charge_type_ratio))*$room_type_before_discount;
      }

      $room_type_subtotal = $room_type_before_discount - $room_type_tax - $room_type_service - $room_type_other;
      $room_type_charge = $room_type_subtotal / $data['room_type_duration'];

      // Diskon
      if ($discount->discount_type == '1') {
        if ($discount->discount_id == '1') {
          $room_type_discount = $discount->discount_amount;
          $room_type_total = $room_type_before_discount - $room_type_discount + price_to_num($data['room_type_denda']);
        }else{
          $room_type_discount = ($discount->discount_amount/100);
          $room_type_total = $room_type_before_discount * $room_type_discount + price_to_num($data['room_type_denda']);
        }
      }else{
        $room_type_discount = $discount->discount_amount;
        $room_type_total = $room_type_before_discount - $room_type_discount + price_to_num($data['room_type_denda']);
      }
    }

    // $room_type_discount = $discount->discount_amount*$room_type_before_discount/100;
    // if ($discount->discount_type == '1') {
    //   if ($discount->discount_id == '1') {
    //     $room_type_discount = $discount->discount_amount;
    //     $room_type_total = $room_type_before_discount-$room_type_discount;
    //   }else{
    //     $room_type_discount = ($discount->discount_amount/100);
    //     $room_type_total = $room_type_before_discount * $room_type_discount;
    //   }
    // }else{
    //   $room_type_discount = $discount->discount_amount;
    //   $room_type_total = $room_type_before_discount-$room_type_discount;
    // }

    $data_room = array(
      'billing_id' => $data['billing_id'],
      'room_id' => $room->room_id,
      'room_name' => $room->room_name,
      'room_type_id' => $room->room_type_id,
      'room_type_name' => $room->room_type_name,
      'room_type_tarif_kamar' => $data['room_type_tarif_kamar'],
      'room_type_charge' => $room_type_charge,
      'discount_id' => $discount->discount_id,
      'discount_type' => $discount->discount_type,
      'discount_amount' => $discount->discount_amount,
      'room_type_subtotal' => $room_type_subtotal,
      'room_type_tax' => $room_type_tax,
      'room_type_service' => $room_type_service,
      'room_type_other' => $room_type_other,
      'room_type_before_discount' => $room_type_before_discount,
      'room_type_discount' => $room_type_discount,
      'room_type_total' => $room_type_total,
      'room_type_denda' => price_to_num($data['room_type_denda']),
      'room_st_denda' => $data['room_st_denda'],
      'room_keterangan' => $data['room_keterangan'],
      'room_type_duration' => $data['room_type_duration'],
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_room($data_room);
  }

  public function update_room()
  {
    $data = $_POST;
    $id = $data['billing_room_id'];

    $client = $this->m_hot_client->get_all();
    // Pajak
    $tax = $this->m_hot_charge_type->get_by_id_active(1);
    $service = $this->m_hot_charge_type->get_by_id_active(2);
    $other = $this->m_hot_charge_type->get_by_id_active(3);

    $room = $this->m_hot_reservation->room_detail($data['room_id']);
    $discount = $this->m_hot_discount->get_by_id($data['discount_id_room']);
    
    if ($client->client_is_taxed == 0) {
      // Setingan harga sebelum pajak
      $room_type_charge = price_to_num($data['room_type_charge']);
      // Hitung maju
      $room_type_subtotal = price_to_num($data['room_type_total']);
      // $room_type_tax += $room_type_subtotal * $tax->charge_type_ratio;
      $room_type_tax = 0;
      if ($tax != null) {
        $room_type_tax += $room_type_subtotal * ($tax->charge_type_ratio/100);
      }
      $room_type_service = 0;
      if ($service != null) {
        $room_type_service += $room_type_subtotal * ($service->charge_type_ratio/100);
      }
      $room_type_other = 0;
      if ($other) {
        $room_type_other += $room_type_subtotal * ($other->charge_type_ratio/100);
      }

      $room_type_before_discount = $room_type_subtotal + $room_type_tax + $room_type_service + $room_type_other;

      // Diskon
      if ($discount->discount_type == '1') {
        if ($discount->discount_id == '1') {
          $room_type_discount = $discount->discount_amount;
          $room_type_total = $room_type_before_discount - $room_type_discount - $room_type_tax - $room_type_service - $room_type_other + price_to_num($data['room_type_denda']);
        }else{
          $room_type_discount = ($discount->discount_amount/100);
          $room_type_total = $room_type_before_discount * $room_type_discount - $room_type_tax - $room_type_service - $room_type_other + price_to_num($data['room_type_denda']);
        }
      }else{
        $room_type_discount = $discount->discount_amount;
        $room_type_total = $room_type_before_discount - $room_type_discount - $room_type_tax - $room_type_service - $room_type_other + price_to_num($data['room_type_denda']);
      }
    } else {
      // Settingan harga setelah pajak
      $room_type_before_discount = price_to_num($data['room_type_total']);
      // hitung persen semua setelah pajak/ hitung mundur
      $room_type_tax = ($tax->charge_type_ratio/(100 + $tax->charge_type_ratio))*$room_type_before_discount;
      $room_type_service = ($service->charge_type_ratio/(100 + $service->charge_type_ratio))*$room_type_before_discount;
      $room_type_other = ($other->charge_type_ratio/(100 + $other->charge_type_ratio))*$room_type_before_discount;

      $room_type_tax = 0;
      if ($tax != null) {
        $room_type_tax = ($tax->charge_type_ratio/(100 + $tax->charge_type_ratio))*$room_type_before_discount;
      }
      $room_type_service = 0;
      if ($service != null) {
        $room_type_service = ($service->charge_type_ratio/(100 + $service->charge_type_ratio))*$room_type_before_discount;
      }
      $room_type_other = 0;
      if ($other != null) {
        $room_type_other = ($other->charge_type_ratio/(100 + $other->charge_type_ratio))*$room_type_before_discount;
      }

      $room_type_subtotal = $room_type_before_discount - $room_type_tax - $room_type_service - $room_type_other;
      $room_type_charge = $room_type_subtotal / $data['room_type_duration'];

      // Diskon
      if ($discount->discount_type == '1') {
        if ($discount->discount_id == '1') {
          $room_type_discount = $discount->discount_amount;
          $room_type_total = $room_type_before_discount - $room_type_discount + price_to_num($data['room_type_denda']);
        }else{
          $room_type_discount = ($discount->discount_amount/100);
          $room_type_total = $room_type_before_discount * $room_type_discount + price_to_num($data['room_type_denda']);
        }
      }else{
        $room_type_discount = $discount->discount_amount;
        $room_type_total = $room_type_before_discount - $room_type_discount + price_to_num($data['room_type_denda']);
      }
    }

    // $room_type_discount = $discount->discount_amount*$room_type_before_discount/100;
    // if ($discount->discount_type == '1') {
    //   if ($discount->discount_id == '1') {
    //     $room_type_discount = $discount->discount_amount;
    //     $room_type_total = $room_type_before_discount - $room_type_discount + price_to_num($data['room_type_denda']);
    //   }else{
    //     $room_type_discount = ($discount->discount_amount/100);
    //     $room_type_total = $room_type_before_discount * $room_type_discount + price_to_num($data['room_type_denda']);
    //   }
    // }else{
    //   $room_type_discount = $discount->discount_amount;
    //   $room_type_total = $room_type_before_discount - $room_type_discount + price_to_num($data['room_type_denda']);
    // }

    $data_room = array(
      'billing_id' => $data['billing_id'],
      'room_type_charge' => $room_type_charge,
      'discount_id' => $discount->discount_id,
      'discount_type' => $discount->discount_type,
      'discount_amount' => $discount->discount_amount,
      'room_type_subtotal' => $room_type_subtotal,
      'room_type_tax' => $room_type_tax,
      'room_type_service' => $room_type_service,
      'room_type_other' => $room_type_other,
      'room_type_before_discount' => $room_type_before_discount,
      'room_type_discount' => $room_type_discount,
      'room_type_total' => $room_type_total,
      'room_type_duration' => $data['room_type_duration'],
      'room_keterangan' => $data['room_keterangan'],
      'room_type_denda' => price_to_num($data['room_type_denda']),
      'room_type_tarif_kamar' => $data['room_type_tarif_kamar'],
      'room_st_denda' => $data['room_st_denda'],
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->update_room($id,$data_room);
  }

  public function room_list()
  {
    $billing_id = $this->input->post('billing_id');
    $data = $this->m_hot_reservation->room_list($billing_id);

    echo json_encode($data);  
  }

  public function get_billing_room()
  {
    $data = $_POST;
    
    $client = $this->m_hot_client->get_all();
    $billing_id = $this->input->post('billing_id');
    $data2['room'] = $this->m_hot_reservation->get_billing_room($billing_id);
    $data2['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data2);
  }

  public function update_room_show()
  {
    $data['tax'] = $this->m_hot_charge_type->get_by_id(1);
    //
    $id = $this->input->post('billing_room_id');
    $data = $this->m_hot_billing_room->get_by_id($id);
    echo json_encode($data);
  }

  public function delete_room() 
  {
    $id = $this->input->post('billing_room_id');
    $this->m_hot_reservation->delete_room($id);
  }

  public function get_extra()
  {
    $extra_id = $this->input->post('extra_id');
    $client = $this->m_hot_client->get_all();
    $data = $this->m_hot_extra->get_by_id($extra_id);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 1) {
      $data->extra_charge += $data->extra_charge*$tax->charge_type_ratio/100;
    }

    $data->extra_charge = round($data->extra_charge,0,PHP_ROUND_HALF_UP);

    echo json_encode($data);
  }

  public function add_extra()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $extra = $this->m_hot_extra->get_by_id($data['extra_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) {
      $extra_charge = price_to_num($data['extra_charge']);
      $extra_subtotal = $data['extra_amount']*$extra_charge;
      $extra_tax = $extra_subtotal*$tax->charge_type_ratio/100;
      $extra_total = $extra_subtotal+$extra_tax;
    }else{
      $extra_total = $data['extra_amount']*price_to_num($data['extra_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $extra_tax = ($tax->charge_type_ratio/$tot_ratio)*$extra_total;
      $extra_subtotal = $extra_total-$extra_tax;
      $extra_charge = $extra_subtotal/$data['extra_amount'];
    }

    $data_extra = array(
      'billing_id' => $data['billing_id'],
      'extra_id' => $extra->extra_id,
      'extra_name' => $extra->extra_name,
      'extra_charge' => $extra_charge,
      'extra_amount' => $data['extra_amount'],
      'extra_subtotal' => $extra_subtotal,
      'extra_tax' => $extra_tax,
      'extra_total' => $extra_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_extra($data_extra);
  }

  public function update_extra()
  {
    $data = $_POST;
    $id = $data['billing_extra_id'];

    $client = $this->m_hot_client->get_all();
    // $extra = $this->m_hot_extra->get_by_id($data['extra_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) {
      $extra_charge = price_to_num($data['extra_charge']);
      $extra_subtotal = $data['extra_amount']*$extra_charge;
      $extra_tax = $extra_subtotal*$tax->charge_type_ratio/100;
      $extra_total = $extra_subtotal+$extra_tax;
    }else{
      $extra_total = $data['extra_amount']*price_to_num($data['extra_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $extra_tax = ($tax->charge_type_ratio/$tot_ratio)*$extra_total;
      $extra_subtotal = $extra_total-$extra_tax;
      $extra_charge = $extra_subtotal/$data['extra_amount'];
    }

    $data_extra = array(
      'billing_id' => $data['billing_id'],
      'extra_charge' => $extra_charge,
      'extra_amount' => $data['extra_amount'],
      'extra_subtotal' => $extra_subtotal,
      'extra_tax' => $extra_tax,
      'extra_total' => $extra_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->update_extra($id,$data_extra);
  }

  public function get_billing_extra()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['extra'] = $this->m_hot_reservation->get_billing_extra($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function update_extra_show()
  {
    $id = $this->input->post('billing_extra_id');
    $data = $this->m_hot_billing_extra->get_by_id($id);
    echo json_encode($data);
  }

  public function delete_extra()
  {
    $id = $this->input->post('billing_extra_id');
    $this->m_hot_reservation->delete_extra($id);
  }

  public function get_service()
  {
    $service_id = $this->input->post('service_id');
    $client = $this->m_hot_client->get_all();
    $data = $this->m_hot_service->get_by_id($service_id);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 1) {
      $data->service_charge += $data->service_charge*$tax->charge_type_ratio/100;
    }

    $data->service_charge = round($data->service_charge,0,PHP_ROUND_HALF_UP);

    echo json_encode($data);
  }

  public function add_service()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $service = $this->m_hot_service->get_by_id($data['service_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) {
      $service_charge = price_to_num($data['service_charge']);
      $service_subtotal = $data['service_amount']*$service_charge;
      $service_tax = $service_subtotal*$tax->charge_type_ratio/100;
      $service_total = $service_subtotal+$service_tax;
    }else{
      $service_total = $data['service_amount']*price_to_num($data['service_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $service_tax = ($tax->charge_type_ratio/$tot_ratio)*$service_total;
      $service_subtotal = $service_total-$service_tax;
      $service_charge = $service_subtotal/$data['service_amount'];
    }

    $data_service = array(
      'billing_id' => $data['billing_id'],
      'service_id' => $service->service_id,
      'service_name' => $service->service_name,
      'service_charge' => $service_charge,
      'service_amount' => $data['service_amount'],
      'service_subtotal' => $service_subtotal,
      'service_tax' => $service_tax,
      'service_total' => $service_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_service($data_service);
  }

  public function update_service_show()
  {
    $id = $this->input->post('billing_service_id');
    $data = $this->m_hot_billing_service->get_by_id($id);
    echo json_encode($data);
  }

  public function update_service()
  {
    $data = $_POST;
    $id = $data['billing_service_id'];

    $client = $this->m_hot_client->get_all();
    // $service = $this->m_hot_service->get_by_id($data['service_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) {
      $service_charge = price_to_num($data['service_charge']);
      $service_subtotal = $data['service_amount']*$service_charge;
      $service_tax = $service_subtotal*$tax->charge_type_ratio/100;
      $service_total = $service_subtotal+$service_tax;
    }else{
      $service_total = $data['service_amount']*price_to_num($data['service_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $service_tax = ($tax->charge_type_ratio/$tot_ratio)*$service_total;
      $service_subtotal = $service_total-$service_tax;
      $service_charge = $service_subtotal/$data['service_amount'];
    }

    $data_service = array(
      'billing_id' => $data['billing_id'],
      'service_charge' => $service_charge,
      'service_amount' => $data['service_amount'],
      'service_subtotal' => $service_subtotal,
      'service_tax' => $service_tax,
      'service_total' => $service_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->update_service($id,$data_service);
  }

  public function get_billing_service()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['service'] = $this->m_hot_reservation->get_billing_service($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_service()
  {
    $id = $this->input->post('billing_service_id');
    $this->m_hot_reservation->delete_service($id);
  }

  public function get_fnb()
  {
    $fnb_id = $this->input->post('fnb_id');
    $data = $this->m_hot_fnb->get_by_id($fnb_id);    
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 1) {
      $data->fnb_charge += $data->fnb_charge*$tax->charge_type_ratio/100;
    }

    $data->fnb_charge = round($data->fnb_charge,0,PHP_ROUND_HALF_UP);

    echo json_encode($data);
  }

  public function add_fnb()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $fnb = $this->m_hot_fnb->get_by_id($data['fnb_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) { //Harga Sebelum Pajak
      $fnb_charge = price_to_num($data['fnb_charge']);
      $fnb_subtotal = $data['fnb_amount']*$fnb_charge;
      $fnb_tax = $fnb_subtotal*$tax->charge_type_ratio/100;
      $fnb_total = $fnb_subtotal+$fnb_tax;
    }else{ //Harga Sesudah Pajak
      $fnb_total = $data['fnb_amount']*price_to_num($data['fnb_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $fnb_tax = ($tax->charge_type_ratio/$tot_ratio)*$fnb_total;
      $fnb_subtotal = $fnb_total-$fnb_tax;
      $fnb_charge = $fnb_subtotal/$data['fnb_amount'];
    }

    $data_fnb = array(
      'billing_id' => $data['billing_id'],
      'fnb_id' => $fnb->fnb_id,
      'fnb_name' => $fnb->fnb_name,
      'fnb_charge' => $fnb_charge,
      'fnb_amount' => $data['fnb_amount'],
      'fnb_subtotal' => $fnb_subtotal,
      'fnb_tax' => $fnb_tax,
      'fnb_total' => $fnb_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_fnb($data_fnb);
  }

  public function update_fnb_show()
  {
    $id = $this->input->post('billing_fnb_id');
    $data = $this->m_hot_billing_fnb->get_by_id($id);
    echo json_encode($data);
  }

  public function update_fnb()
  {
    $data = $_POST;
    $id = $data['billing_fnb_id'];

    $client = $this->m_hot_client->get_all();
    // $fnb = $this->m_hot_fnb->get_by_id($data['fnb_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) {
      $fnb_charge = price_to_num($data['fnb_charge']);
      $fnb_subtotal = $data['fnb_amount']*$fnb_charge;
      $fnb_tax = $fnb_subtotal*$tax->charge_type_ratio/100;
      $fnb_total = $fnb_subtotal+$fnb_tax;
    }else{
      $fnb_total = $data['fnb_amount']*price_to_num($data['fnb_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $fnb_tax = ($tax->charge_type_ratio/$tot_ratio)*$fnb_total;
      $fnb_subtotal = $fnb_total-$fnb_tax;
      $fnb_charge = $fnb_subtotal/$data['fnb_amount'];
    }

    $data_fnb = array(
      'billing_id' => $data['billing_id'],
      'fnb_charge' => $fnb_charge,
      'fnb_amount' => $data['fnb_amount'],
      'fnb_subtotal' => $fnb_subtotal,
      'fnb_tax' => $fnb_tax,
      'fnb_total' => $fnb_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->update_fnb($id,$data_fnb);
  }

  public function get_billing_fnb()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['fnb'] = $this->m_hot_reservation->get_billing_fnb($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);

  }
  public function delete_fnb()
  {
    $id = $this->input->post('billing_fnb_id');
    $this->m_hot_reservation->delete_fnb($id);
  }

  public function get_non_tax()
  {
    $non_tax_id = $this->input->post('non_tax_id');
    $data = $this->m_hot_non_tax->get_by_id($non_tax_id);    
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);

    echo json_encode($data);
  }

  public function add_non_tax()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $non_tax = $this->m_hot_non_tax->get_by_id($data['non_tax_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $non_tax_charge = price_to_num($data['non_tax_charge']);
    $non_tax_total = $non_tax_charge*$data['non_tax_amount'];
    
    $data_non_tax = array(
      'billing_id' => $data['billing_id'],
      'non_tax_id' => $non_tax->non_tax_id,
      'non_tax_name' => $non_tax->non_tax_name,
      'non_tax_charge' => $non_tax_charge,
      'non_tax_amount' => $data['non_tax_amount'],
      'non_tax_total' => $non_tax_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_non_tax($data_non_tax);
  }

  public function update_non_tax_show()
  {
    $client = $this->m_hot_client->get_all();
    $data['client_is_taxed'] = $client->client_is_taxed;
    //
    $id = $this->input->post('billing_non_tax_id');
    $data = $this->m_hot_reservation->get_by_id($id);
    echo json_encode($data);
  }

  public function update_non_tax()
  {
    $data = $_POST;
    $id = $data['billing_non_tax_id'];

    $client = $this->m_hot_client->get_all();
    // $non_tax = $this->m_hot_non_tax->get_by_id($data['non_tax_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    $non_tax_charge = price_to_num($data['non_tax_charge']);
    $non_tax_total = $non_tax_charge*$data['non_tax_amount'];

    $data_non_tax = array(
      'billing_non_tax_id' => $data['billing_non_tax_id'],
      'billing_id' => $data['billing_id'],
      'non_tax_charge' => $non_tax_charge,
      'non_tax_amount' => $data['non_tax_amount'],
      'non_tax_total' => $non_tax_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->update_non_tax($id,$data_non_tax);
  }

  public function get_billing_non_tax()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['non_tax'] = $this->m_hot_reservation->get_billing_non_tax($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_non_tax()
  {
    $id = $this->input->post('billing_non_tax_id');
    $this->m_hot_reservation->delete_non_tax($id);
  }

  public function get_custom()
  {
    $custom_id = $this->input->post('custom_id');
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 1) {
      $data->custom_charge += $data->custom_charge*$tax->charge_type_ratio/100;
    }

    $data->custom_charge = round($data->custom_charge,0,PHP_ROUND_HALF_UP);

    echo json_encode($data);
  }

  public function add_custom()
  {
    $data = $_POST;
    $client = $this->m_hot_client->get_all();
    $tax = $this->m_hot_charge_type->get_by_id(1);

    if ($client->client_is_taxed == 0) {
      $custom_charge = price_to_num($data['custom_charge']);
      $custom_subtotal = $data['custom_amount']*$custom_charge;
      $custom_tax = 0;//$custom_subtotal*$tax->charge_type_ratio/100;
      $custom_total = $custom_subtotal+$custom_tax;
    }else{
      $custom_total = $data['custom_amount']*price_to_num($data['custom_charge']);
      $tot_ratio = 100+$tax->charge_type_ratio;
      $custom_tax = 0;//($tax->charge_type_ratio/$tot_ratio)*$custom_total;
      $custom_subtotal = $custom_total-$custom_tax;
      $custom_charge = $custom_subtotal/$data['custom_amount'];
    }

    $data_custom = array(
      'billing_id' => $data['billing_id'],
      'custom_id' => '99',
      'custom_name' => $data['custom_name'],
      'custom_charge' => $custom_charge,
      'custom_amount' => $data['custom_amount'],
      'custom_subtotal' => $custom_subtotal,
      'custom_tax' => $custom_tax,
      'custom_total' => $custom_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->add_custom($data_custom);
  }

  public function update_custom_show()
  {
    $client = $this->m_hot_client->get_all();
    $data['client_is_taxed'] = $client->client_is_taxed;
    //
    $id = $this->input->post('billing_custom_id');
    $data = $this->m_hot_billing_custom->get_by_id($id);
    echo json_encode($data);
  }

  public function update_custom()
  {
    $data = $_POST;
    $id = $data['billing_custom_id'];

    $client = $this->m_hot_client->get_all();
    // $custom = $this->m_hot_custom->get_by_id($data['custom_id']);
    $tax = $this->m_hot_charge_type->get_by_id(1);

    // if ($client->client_is_taxed == 0) {
    //   $custom_charge = price_to_num($data['custom_charge']);
    //   $custom_subtotal = $data['custom_amount']*$custom_charge;
    //   $custom_tax = $custom_subtotal*$tax->charge_type_ratio/100;
    //   $custom_total = $custom_subtotal+$custom_tax;
    // }else{
    //   $custom_total = $data['custom_amount']*price_to_num($data['custom_charge']);
    //   $tot_ratio = 100+$tax->charge_type_ratio;
    //   $custom_tax = ($tax->charge_type_ratio/$tot_ratio)*$custom_total;
    //   $custom_subtotal = $custom_total-$custom_tax;
    //   $custom_charge = $custom_subtotal/$data['custom_amount'];
    // }

      $custom_charge = price_to_num($data['custom_charge']);
      $custom_subtotal = $data['custom_amount']*$custom_charge;
      $custom_tax = 0;
      $custom_total = $custom_subtotal+$custom_tax;

    $data_custom = array(
      'billing_id' => $data['billing_id'],
      'custom_charge' => $custom_charge,
      'custom_amount' => $data['custom_amount'],
      'custom_subtotal' => $custom_subtotal,
      'custom_tax' => $custom_tax,
      'custom_total' => $custom_total,
      'created_by' => $this->session->userdata('user_realname')
    );
    $this->m_hot_reservation->update_custom($id,$data_custom);
  }

  public function get_billing_custom()
  {
    $billing_id = $this->input->post('billing_id');
    $client = $this->m_hot_client->get_all();
    $data['custom'] = $this->m_hot_reservation->get_billing_custom($billing_id);
    $data['client_is_taxed'] = $client->client_is_taxed;

    echo json_encode($data);
  }

  public function delete_custom()
  {
    $id = $this->input->post('billing_custom_id');
    $this->m_hot_reservation->delete_custom($id);
  }

  public function get_count()
  {
    $billing_id = $this->input->post('billing_id');
    
    $data['count_room'] = $this->m_hot_reservation->count_room($billing_id);
    $data['count_extra'] = $this->m_hot_reservation->count_extra($billing_id);
    $data['count_service'] = $this->m_hot_reservation->count_service($billing_id);
    $data['count_fnb'] = $this->m_hot_reservation->count_fnb($billing_id);
    $data['count_non_tax'] = $this->m_hot_reservation->count_non_tax($billing_id);
    $data['count_custom'] = $this->m_hot_reservation->count_custom($billing_id);

    echo json_encode($data);
  }

  public function cetak_struk_dp($billing_id)
  {
    $title = "Cetak Struk DP";
    $client = $this->m_hot_client->get_all();
    //
    $billing = $this->m_hot_reservation->get_billing($billing_id);
    $charge_type = $this->m_hot_charge_type->get_all();
    $date_now = date("Y-m-d");
    $time_now = date("H:i:s");
    //

    //print
    $this->load->library("EscPos.php");

    try {
      $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");
         
      $printer = new Escpos\Printer($connector);

      //print image
      if ($client->client_logo !='') {
        $img = Escpos\EscposImage::load("img/".$client->client_logo);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> bitImage($img);
        $printer -> feed();
      }
      //Keterangan Wajib Pajak
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);

      if ($client->client_logo == '') {
        $printer -> setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
        $printer -> text($client->client_name."\n");
        $printer -> setUnderline(Escpos\Printer::UNDERLINE_NONE);
      }

      $printer -> text($client->client_street.','.$client->client_district."\n");
      $printer -> text($client->client_city."\n");
      $printer -> text("NPWPD : ".$client->client_npwpd."\n"); 
      $printer -> text('TRS-'.$billing->billing_receipt_no."\n");
      //Judul
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      // $printer -> text(substr($billing->user_realname,0,12).' '.convert_date($billing->created));
      $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind(date("Y-m-d")).' '.date("H:i:s"));
      $printer -> feed();
      $printer -> text('--------------------------------');
      //
      $check_in_left = "IN/Masuk";
      $check_in_right = date_to_ind($billing->billing_date_in).' '.$billing->billing_time_in;
      $printer -> text(print_justify($check_in_left, $check_in_right, 10, 19, 3));
      $check_out_left = "OUT/Keluar";
      $check_out_right = date_to_ind($billing->billing_date_out).' '.$billing->billing_time_out;
      $printer -> text(print_justify($check_out_left, $check_out_right, 10, 19, 3));
      $printer -> text('--------------------------------');
      //Keterangan Tamu
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
      $printer -> text("Detail Tamu :");
      $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text("Nama    : ".substr($billing->guest_name,0,22));
      $printer -> feed();
      if ($billing->guest_phone !='') {
        $phone = $billing->guest_phone;
      }else {
        $phone = "-";
      }
      $printer -> text("No Telp : ".$phone);

      if ($billing->guest_id_type == '1') {
        $kategori_id = "-";
      }elseif ($billing->guest_id_type == '2') {
        $kategori_id = "KTP";
        $id_no = "(".$billing->guest_id_no.")";
      }elseif ($billing->guest_id_type == '3') {
        $kategori_id = "SIM";
        $id_no = "(".$billing->guest_id_no.")";
      }elseif ($billing->guest_id_type == '4') {
        $kategori_id = "Lainnya";
        $id_no = "(".$billing->guest_id_no.")";
      }

      $printer -> feed();
      $printer -> text("No ID   : ".$kategori_id.$id_no);
      $printer -> feed();
      $printer -> text('--------------------------------');
      //Keterangan Pemesanan
      // Kamar
      if ($billing->room != null){
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Room :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->room as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->room_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $room_type_subtotal = num_to_price($row->room_type_charge);
          }else{
            $room_type_subtotal = num_to_price($row->room_type_before_discount/$row->room_type_duration);
          }
          //
          if ($client->client_is_taxed == 0) {
            $room_type_total = num_to_price($row->room_type_subtotal);
          }else{
            $room_type_total = num_to_price($row->room_type_before_discount);
          }
          //
          $printer -> text(round($row->room_type_duration,0,PHP_ROUND_HALF_UP)." Jam X ".$room_type_subtotal." = ".$room_type_total);
          $printer -> feed();
        }
      }
      // Pelayanan
      if ($billing->service != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Pelayanan :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->service as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->service_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $service_charge_sub_total = num_to_price($row->service_charge);
          }else{
            $service_charge_sub_total = num_to_price($row->service_total/$row->service_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $service_charge_total = num_to_price($row->service_subtotal);
          }else{
            $service_charge_total = num_to_price($row->service_total);
          }
          //
          $printer -> text(round($row->service_amount,0,PHP_ROUND_HALF_UP)." X ".$service_charge_sub_total." = ".$service_charge_total);
          $printer -> feed();
        }
      }
      // F&B
      if ($billing->fnb != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("F&B :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->fnb as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->fnb_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          if ($client->client_is_taxed == 0) {
            $fnb_charge_sub_total = num_to_price($row->fnb_charge);
          }else{
            $fnb_charge_sub_total = num_to_price($row->fnb_total/$row->fnb_amount);
          }
          //
          if ($client->client_is_taxed == 0) {
            $fnb_charge_total = num_to_price($row->fnb_subtotal);
          }else{
            $fnb_charge_total = num_to_price($row->fnb_total);
          }
          //
          $printer -> text(round($row->fnb_amount,0,PHP_ROUND_HALF_UP)." X ".$fnb_charge_sub_total." = ".$fnb_charge_total);
          $printer -> feed();
        }
      }
      // Non Pajak
      if ($billing->non_tax != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Non Pajak :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->non_tax as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->non_tax_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          $printer -> text(round($row->non_tax_amount,0,PHP_ROUND_HALF_UP)." X ".num_to_price($row->non_tax_charge)." = ".num_to_price($row->non_tax_total));
          $printer -> feed();
        }
      }
      // Custom
      if ($billing->custom != null){
        $printer -> text('--------------------------------');
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        $printer -> text("Kustom :");
        $printer -> selectPrintMode(Escpos\Printer::MODE_FONT_A);
        $printer -> feed();
        foreach ($billing->custom as $row){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->custom_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          //
          $printer -> text(round($row->custom_amount,0,PHP_ROUND_HALF_UP)." X ".num_to_price($row->custom_charge)." = ".num_to_price($row->custom_total));
          $printer -> feed();
        }
      }
      $printer -> text('--------------------------------');
      //
      if ($billing->billing_down_payment_type == 1){
        $uang_muka = num_to_price($billing->billing_down_payment);
      }
      else{
        $uang_muka = round($billing->billing_down_payment,0,PHP_ROUND_HALF_UP)." %";
      }

      if ($billing->billing_down_payment > $billing->billing_total){
        $sisa_bayar = num_to_price(0);
      }
      else{
        if ($billing->billing_down_payment_type == 1){
          $sisa_bayar = num_to_price($billing->billing_total-$billing->billing_down_payment);
        }
        else{
          $dp_prosen = $billing->billing_total*($billing->billing_down_payment/100);

          if ($dp_prosen > $billing->billing_total){
            $sisa_bayar = num_to_price(0);
          }
          else{
            $sisa_bayar = num_to_price($billing->billing_total-$dp_prosen);
          }
        }
      }
      //
      $space_array = array(
        strlen(num_to_price($billing->billing_total)),
        strlen($uang_muka),
        strlen($sisa_bayar),
        strlen(num_to_price($billing->billing_payment)),
        strlen(num_to_price($billing->billing_change)),
        strlen(num_to_price($billing->billing_discount)),
      );
      $l_max = max($space_array);
      $l_1 = $l_max - strlen(num_to_price($billing->billing_total));
      $s_1 = '';
      for ($i=0; $i < $l_1; $i++) {
        $s_1 .= ' ';
      };
      $l_2 = $l_max - strlen(num_to_price($billing->billing_down_payment));
      $s_2 = '';
      for ($i=0; $i < $l_2; $i++) {
        $s_2 .= ' ';
      };
      $l_3 = $l_max - strlen($sisa_bayar);
      $s_3 = '';
      for ($i=0; $i < $l_3; $i++) {
        $s_3 .= ' ';
      };
      $l_4 = $l_max - strlen(num_to_price($billing->billing_payment));
      $s_4 = '';
      for ($i=0; $i < $l_4; $i++) {
        $s_4 .= ' ';
      };
      $l_5 = $l_max - strlen(num_to_price($billing->billing_change));
      $s_5 = '';
      for ($i=0; $i < $l_5; $i++) {
        $s_5 .= ' ';
      };
      $l_6 = $l_max - strlen(num_to_price($billing->billing_subtotal));
      $s_6 = '';
      for ($i=0; $i < $l_6; $i++) {
        $s_6 .= ' ';
      };
      $l_7 = $l_max - strlen(num_to_price($billing->billing_discount));
      $s_7 = '';
      for ($i=0; $i < $l_7; $i++) {
        $s_7 .= ' ';
      };

      foreach ($charge_type as $row){

        if ($row->charge_type_id == '1') {
          $numb = "7";
          $charge_type_money = num_to_price($billing->billing_tax);
        }else if ($row->charge_type_id == '2') {
          $numb = "8";
          $charge_type_money = num_to_price($billing->billing_service);
        }else if ($row->charge_type_id == '3') {
          $numb = "9";
          $charge_type_money = num_to_price($billing->billing_other);
        }

        $l_[$numb] = $l_max - strlen($charge_type_money);
        $s_[$numb] = '';
        for ($i=0; $i < $l_[$numb]; $i++) {
          $s_[$numb] .= ' ';
        };
      }

      if ($client->client_is_taxed == 0){
        // Sebelum pajak
        $printer -> text("Subtotal = ".$s_6.num_to_price($billing->billing_subtotal));
        $printer -> feed();

        foreach ($charge_type as $row){
          //
          if ($row->charge_type_id == '1') {
            $numb = "7";
            $charge_type_money = num_to_price($billing->billing_tax);
          }else if ($row->charge_type_id == '2') {
            $numb = "8";
            $charge_type_money = num_to_price($billing->billing_service);
          }else if ($row->charge_type_id == '3') {
            $numb = "9";
            $charge_type_money = num_to_price($billing->billing_other);
          }
          //
          $printer -> text($row->charge_type_name." = ".$s_[$numb].$charge_type_money);
          $printer -> feed();
        }
      }

      //
      $printer -> feed();
      if ($client->client_is_taxed == 0){
        $name_total = "Total";
      }else {
        $name_total = "Total Bersih";
      }

      $printer -> text('Uang Muka (DP) = '.$s_2.$uang_muka);
      $printer -> feed();
      //
      $printer -> feed();
      $printer -> feed();
      $printer -> feed();
      $printer -> feed();

      /* Close printer */
      $printer -> close();
    } catch (Exception $e) {
      echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }
    //
    if ($url !='') {
      redirect(base_url().$url.'/detail/'.$billing_id);
    }else {
      redirect(base_url().'hot_reservation/form/'.$billing_id);
    }
  }


}
