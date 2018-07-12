<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot_payment extends MY_Hotel {

  var $access, $payment_id;

  function __construct(){
    parent::__construct();
    if($this->session->userdata('menu') != 'hot_payment'){
      $this->session->set_userdata(array('menu' => 'hot_payment'));
      $this->session->unset_userdata('search_term');
    }
    $this->load->model('app_config/m_hot_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'hot_payment';
    $this->access = $this->m_hot_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('m_hot_payment');
    $this->load->model('m_hot_booking');
    $this->load->model('m_hot_room');
  }

	public function index()
  {
    if ($this->access->_read == 1) {
      $data['access'] = $this->access;
      $data['title'] = 'Manajemen Pembayaran Kamar';
      $data['booking'] = $this->m_hot_payment->get_all_booking();
      $data['guest'] = $this->m_hot_payment->get_all_tamu();

      if($this->input->post('search_term')){
        $search_term = $this->input->post('search_term');
        $this->session->set_userdata(array('search_term' => $search_term));
      }

      $config['base_url'] = base_url().'hot_payment/index/';
      $config['per_page'] = 10;

      $from = $this->uri->segment(3);

      if($this->session->userdata('search_term') == null){
        $num_rows = $this->m_hot_payment->num_rows();

        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['payment'] = $this->m_hot_payment->get_list($config['per_page'],$from,$search_term = null);
      }else{
        $search_term = $this->session->userdata('search_term');
        $num_rows = $this->m_hot_payment->num_rows($search_term);
        $config['total_rows'] = $num_rows;
        $this->pagination->initialize($config);

        $data['payment'] = $this->m_hot_payment->get_list($config['per_page'],$from,$search_term);
      }

      $this->view('hot_payment/index',$data);
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }

  public function reset_search()
  {
    $this->session->unset_userdata('search_term');
    redirect(base_url().'hot_payment/index');
  }

  public function form($id = null)
  {
    $data['access'] = $this->access;
    $data['guest'] = $this->m_hot_booking->get_all_tamu();
    $data['room'] = $this->m_hot_booking->get_all_room();
    $data['diskon'] = $this->m_hot_booking->get_all_diskon();
    $data['service'] = $this->m_hot_booking->get_all_service();
    $data['tipe'] = $this->m_hot_booking->get_tipe();

    if ($id == null) {
      if ($this->access->_create == 1) {
        $data['title'] = 'Tambah Pembayaran Kamar';
        $data['action'] = 'insert';
        $data['payment'] = null;
        $this->view('hot_payment/form', $data);
      } else {
        redirect(base_url().'app_error/error/403');
      }
    }else{
      if ($this->access->_update == 1) {
        $data['title'] = 'Check Out Pembayaran Kamar';
        $data['payment'] = $this->m_hot_payment->get_payment();
        $data['booking'] = $this->m_hot_booking->get_by_id($id);
        $data['bookings'] = $this->m_hot_booking->get_by_ids($id);
        $data['bookingr'] = $this->m_hot_booking->get_by_idr($id);
        $data['action'] = 'update';
        $this->view('hot_payment/form', $data);
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
    $this->m_hot_payment->insert($data);
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil ditambahkan!</div>');
    redirect(base_url().'hot_payment/index');
  }

  public function edit($id)
  {
    $data['booking']= $this->m_hot_booking->get_specific($id);
    $this->load->view('hot_payment/update', $data);
  }

  public function update()
  {
    $k= $this->input->post('bea_room');
    $p= $this->input->post('bea_service');
    $subtotal = $k+$p; 
    $disc = $this->input->post('disc');
    $pajak = $this->m_hot_booking->get_pajak();
		$total = ((($subtotal-(($subtotal*$disc)/100))*$pajak['tax_ratio'])/100)+($subtotal-(($subtotal*$disc)/100));
 
		$data = array(
			'subtotal' => $subtotal,
			'disc' => $disc,
      'grand_total' => $total,
      'cashed' => 1
      );
      
    $id = $this->input->post('idx');
    $data['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($data['is_active'])){
      $data['is_active'] = 0;
    }
    $this->m_hot_payment->update($id,$data);

    $idx = $this->input->post('room_id');
    $datax = array(
			'is_active' => 1
      );
    $this->m_hot_room->update($idx,$datax);
    
    $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil diubah!</div>');
    redirect(base_url().'hot_payment/index');
  }

  public function delete($id)
  {
    if ($this->access->_delete == 1) {
      $this->m_hot_payment->delete($id);
      $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="fa fa-check" aria-hidden="true"></span><span class="sr-only"> Sukses:</span> Data berhasil dihapus!</div>');
      redirect(base_url().'hot_payment/index');
    } else {
      redirect(base_url().'app_error/error/403');
    }

  }


  public function struk($id)
  {
    $title = 'Detail Pembayaran';
    $client = $this->m_hot_payment->get_client();
    $guest = $this->m_hot_booking->get_all_tamu();
    $room = $this->m_hot_booking->get_all_room();
    $diskon = $this->m_hot_booking->get_all_diskon();
    $service = $this->m_hot_booking->get_all_service();
    $tipe = $this->m_hot_booking->get_tipe();
    $pajak = $this->m_hot_booking->get_pajak();
    $payment = $this->m_hot_payment->get_payment();
    $booking = $this->m_hot_booking->get_by_id($id);

    $this->load->library("EscPos.php");

		try {
  	  $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");

			$printer = new Escpos\Printer($connector);
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> text($client->client_brand);
      $printer -> feed();
      $printer -> text($client->client_street.','.$client->client_district);
      $printer -> feed();
      $printer -> text($client->client_city);
      $printer -> feed();
      $printer -> text('NPWP : '.$client->client_npwp);
      $printer -> feed();
      $printer -> text('#'.$booking->booking_code);
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text(substr($booking->created_by,0,12).' '.date_to_ind($booking->date_booking));
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      foreach ($guest as $row) {
        if($booking->guest_id==$row->guest_id){
          $printer -> text('Nama Tamu : '.$row->guest_name);
          $printer -> feed();
      }};
      
      $printer -> text('Check In : '.$booking->date_booking);
      $printer -> feed();
      $printer -> text('Check Out : '.$booking->date_booking_to);
      $printer -> feed();
      $printer -> text('Durasi : '.$booking->number_of_days.' Hari');
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> text('Detail Pelayanan');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
  
      foreach($service as $t){
        if($booking->service_id==$t->service_id){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($t->service_name.' (1) X ');
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          $printer -> text(num_to_price($t->service_price).' = '.num_to_price($t->service_price));
          $printer -> feed();
      }};
      $printer -> text('--------------------------------');

      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> text('Detail Kamar');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
  
      foreach($room as $t){
        if($booking->room_id==$t->room_id){
          foreach($tipe as $s){
            if($s->category_id==$t->category_id){
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($s->category_name.' - '.$t->room_name.' (1) X ');
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          $printer -> text(num_to_price($s->category_price).' = '.num_to_price($s->category_price));
          $printer -> feed();
      }}}};
      $printer -> text('--------------------------------');

     

      foreach($payment as $t){
        if($booking->booking_id==$t->booking_id){
          $printer -> text('Subtotal = '.num_to_price($t->subtotal));
          $printer -> feed();
      }};

      foreach($payment as $t){
        if($booking->booking_id==$t->booking_id){
          $printer -> text('Diskon '.$t->disc.'%'.' = ');
      }};

      foreach($payment as $t){
        if($booking->booking_id==$t->booking_id){
            $s=$t->subtotal;
            $d=$t->disc;
            $tot=($s*$d)/100;
            $p=(($s-$tot)*$pajak['tax_ratio'])/100;
            $grand=($s-$tot)+$p;

            $printer -> text(num_to_price($tot));
            $printer -> feed();
            $printer -> text('Pajak Hotel ('.$pajak['tax_ratio'].'%) = '.num_to_price($p));
            $printer -> feed();
            $printer -> text('Total Pembayaran = '.num_to_price($grand));
            $printer -> feed();
      }};
      $printer -> text('--------------------------------');
     
      $printer -> feed(2);
    
      $printer -> text('Terimakasih atas kunjungan anda.');
			$printer -> feed(4);
			$printer -> pulse(0, 120, 240);

			/* Close printer */
			$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }
    
    redirect(base_url('hot_payment/index'));
  }

}
