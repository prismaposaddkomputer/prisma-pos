<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_reservation extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->where('billing_status!=','0')
				->order_by('billing_id','desc')
				->get('kar_billing',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('guest_name',$search_term,'both')
				->where('is_deleted','0')
				->where('billing_status!=','0')
				->order_by('billing_id','desc')
				->get('kar_billing',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_billing')->result();
	}

	public function get_billing($id)
	{
		$data = $this->db->where('billing_id',$id)->get('kar_billing')->row();
		$data->room = $this->db->where('billing_id',$id)->get('kar_billing_room')->result();
		$data->extra = $this->db->where('billing_id',$id)->get('kar_billing_extra')->result();
		$data->service = $this->db->where('billing_id',$id)->get('kar_billing_service')->result();
		$data->paket = $this->db->where('billing_id',$id)->get('kar_billing_paket')->result();
		$data->non_tax = $this->db->where('billing_id',$id)->get('kar_billing_non_tax')->result();
		$data->fnb = $this->db->where('billing_id',$id)->get('kar_billing_fnb')->result();
		$data->custom = $this->db->where('billing_id',$id)->get('kar_billing_custom')->result();
		
		return $data;
	}

	public function new_billing($billing_receipt_no)
	{
		$data = array(
			'billing_id' => NULL,
			'billing_receipt_no' => $billing_receipt_no
		);
		$this->db->insert('kar_billing', $data);
	}

	public function update($billing_id,$data)
	{
		$this->db->where('billing_id',$billing_id)->update('kar_billing',$data);
	}

	public function empty_detail($billing_id)
	{
		$this->db->where('billing_id',$billing_id)->delete('kar_billing_room');
		$this->db->where('billing_id',$billing_id)->delete('kar_billing_extra');
		$this->db->where('billing_id',$billing_id)->delete('kar_billing_service');
		$this->db->where('billing_id',$billing_id)->delete('kar_billing_paket');
		$this->db->where('billing_id',$billing_id)->delete('kar_billing_fnb');
		$this->db->where('billing_id',$billing_id)->delete('kar_billing_non_tax');
		$this->db->where('billing_id',$billing_id)->delete('kar_billing_custom');
	}

	public function room_detail($room_id)
	{
		$room = $this->db->query(
			"SELECT * FROM kar_room a
			JOIN kar_room_type b ON a.room_type_id = b.room_type_id
			WHERE a.room_id = '$room_id'"
		)->row();

		return $room;
	}

	public function add_room($data)
	{
		$this->db->insert('kar_billing_room', $data);
	}

	public function update_room($id,$data)
	{
		$this->db->where('billing_room_id',$id)->update('kar_billing_room', $data);
	}

	public function room_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_room')->result();
	}

	public function get_billing_room($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_room')->result();
	}

	public function update_billing_room($id,$data)
	{
		$this->db
			->where('billing_room_id',$id)
			->update('kar_billing_room',$data);
	}

	public function delete_room($id)
	{
		$this->db->where('billing_room_id',$id)->delete('kar_billing_room');
	}

	public function count_room($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_room 
			FROM kar_billing_room 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_room;
	}

	public function add_extra($data)
	{
		$this->db->insert('kar_billing_extra', $data);
	}

	public function extra_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_extra')->result();
	}

	public function get_billing_extra($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_extra')->result();
	}

	public function delete_extra($id)
	{
		$this->db->where('billing_extra_id',$id)->delete('kar_billing_extra');
	}

	public function count_extra($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_extra 
			FROM kar_billing_extra 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_extra;
	}

	public function add_service($data)
	{
		$this->db->insert('kar_billing_service', $data);
	}

	public function update_service($id,$data)
	{
		$this->db->where('billing_service_id',$id)->update('kar_billing_service', $data);
	}

	public function service_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_service')->result();
	}

	public function get_billing_service($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_service')->result();
	}

	public function delete_service($id)
	{
		$this->db->where('billing_service_id',$id)->delete('kar_billing_service');
	}

	public function count_service($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_service 
			FROM kar_billing_service 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_service;
	}




	public function add_paket($data)
	{
		$this->db->insert('kar_billing_paket', $data);
	}

	public function update_paket($id,$data)
	{
		$this->db->where('billing_paket_id',$id)->update('kar_billing_paket', $data);
	}

	public function paket_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_paket')->result();
	}

	public function get_billing_paket($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_paket')->result();
	}

	public function delete_paket($id)
	{
		$this->db->where('billing_paket_id',$id)->delete('kar_billing_paket');
	}

	public function count_paket($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_paket 
			FROM kar_billing_paket 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_paket;
	}




	public function add_fnb($data)
	{
		$this->db->insert('kar_billing_fnb', $data);
	}

	public function update_fnb($id,$data)
	{
		$this->db->where('billing_fnb_id',$id)->update('kar_billing_fnb', $data);
	}

	public function fnb_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_fnb')->result();
	}

	public function get_billing_fnb($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_fnb')->result();
	}

	public function delete_fnb($id)
	{
		$this->db->where('billing_fnb_id',$id)->delete('kar_billing_fnb');
	}

	public function count_fnb($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_fnb 
			FROM kar_billing_fnb 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_fnb;
	}

	public function get_by_id($id)
	{
	return $this->db->where('billing_non_tax_id',$id)->get('kar_billing_non_tax')->row();
	}

	public function add_non_tax($data)
	{
		$this->db->insert('kar_billing_non_tax', $data);
	}

	public function update_non_tax($id,$data)
	{
		$this->db->where('billing_non_tax_id',$id)->update('kar_billing_non_tax', $data);
	}

	public function non_tax_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_non_tax')->result();
	}

	public function get_billing_non_tax($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_non_tax')->result();
	}

	public function delete_non_tax($id)
	{
		$this->db->where('billing_non_tax_id',$id)->delete('kar_billing_non_tax');
	}

	public function count_non_tax($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_non_tax 
			FROM kar_billing_non_tax 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_non_tax;
	}

	public function discount_room()
	{
		return $this->db
			->where('discount_category',0)
			->or_where('discount_category',2)
			->get('kar_discount')->result();
	}

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_billing')->num_rows();
		}else{
			return $this->db->like('guest_name',$search_term,'both')->get('kar_billing')->num_rows();
		}
	}

	public function add_custom($data)
	{
		$this->db->insert('kar_billing_custom', $data);
	}

	public function update_custom($id,$data)
	{
		$this->db->where('billing_custom_id',$id)->update('kar_billing_custom', $data);
	}

	public function custom_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_custom')->result();
	}

	public function get_billing_custom($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing_custom')->result();
	}

	public function delete_custom($id)
	{
		$this->db->where('billing_custom_id',$id)->delete('kar_billing_custom');
	}

	public function count_custom($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_custom 
			FROM kar_billing_custom 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_custom;
	}

	public function get_billing_by_room_id($room_id=null)
	{
		return $this->db
			->where('room_id',$room_id)
			->get('kar_billing_room')->row();
	}

	public function get_billing_by_billing_id($billing_id=null)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('kar_billing')->row();
	}

    public function validate_room_id($room_id=null, $billing_date_in=null) {
		//
		$get_billing_by_room_id = $this->get_billing_by_room_id($room_id);
		$get_billing_by_billing_id = $this->get_billing_by_billing_id(@$get_billing_by_room_id->billing_id);
		$tgl_hari_ini = date('Y-m-d');
		//
		$date_akhir = date('Y-m-d H:i:s', strtotime('+'.round(@$get_billing_by_room_id->room_type_duration,0,PHP_ROUND_HALF_UP).' hours', strtotime(@$get_billing_by_billing_id->billing_date_in.' '.@$get_billing_by_billing_id->billing_time_in)));
		$date_hari_ini = date('Y-m-d H:i:s');

		//
        $sql = "SELECT 
        			a.room_id 
        		FROM kar_billing_room a 
        		LEFT JOIN kar_billing b ON a.billing_id=b.billing_id
        		WHERE a.room_id='$room_id' AND b.billing_status='1'";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0) {
        	return true;
        } else {
        	if ($get_billing_by_billing_id->billing_status == '-1') {
        		return false;
        	}elseif ($get_billing_by_billing_id->billing_status == '0') {
        		return true;
        	}else{
        		if ($date_hari_ini >= $date_akhir) {
	        		return false;
	        	}else{
	        		return true;
	        	}
        	}
        }
    }


}
