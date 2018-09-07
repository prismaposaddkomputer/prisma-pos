<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_report_booking extends CI_Model {

	
	public function get_all_tamu()
	{
		return $this->db
			->where('is_deleted','0')
			->get('kar_guest')->result();
	}

	public function get_all_service()
	{
		return $this->db
			->where('is_deleted','0')
			->get('kar_service')->result();
	}

	public function get_all_room()
	{
		return $this->db
			->get('kar_room')->result();
	}

	
	public function get_tipe()
	{
		return $this->db
			->get('kar_category')->result();
	}

	
	public function report_monthly($month)
	{
		  $billing = $this->db
			  ->like('date_booking', $month)
			  ->where('is_deleted','0')
			  ->where('is_active','1')
			  ->order_by('booking_id','desc')
			  ->get('kar_booking')->result();
  
		  return $billing;
	  }
  
	  public function report_daily($date)
	{
		  $billing = $this->db
			  ->where('date_booking', $date)
			  ->where('is_deleted','0')
			  ->where('is_active','1')
			  ->order_by('booking_id','desc')
			  ->get('kar_booking')->result();
  
		  return $billing;
	  }
  
	  public function report_range($date_start, $date_end)
	  {
		  $billing = $this->db
			  ->where('date_booking >=', $date_start)
			  ->where('date_booking <=', $date_end)
			  ->where('is_deleted','0')
			  ->where('is_active','1')
			  ->order_by('booking_id','desc')
			  ->get('kar_booking')->result();
  
		  return $billing;
	  }
  
}
