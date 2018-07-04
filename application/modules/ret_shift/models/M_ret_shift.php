<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_shift extends CI_Model {

	public function shift_in()
	{
		$user_id = $this->session->userdata('user_id');

		return $this->db
			->where('user_id',$user_id)
			->where('parking_type','0')
			->where('shift_type','0')
			->where('shift_in_date', date('Y-m-d'))
			->order_by('shift_id','desc')
			->get('ret_shift')->row();
	}

	public function shift_out()
	{
		$user_id = $this->session->userdata('user_id');

		return $this->db
			->where('user_id',$user_id)
			->where('parking_type','0')
			->where('shift_type','1')
			->where('shift_out_date', date('Y-m-d'))
			->order_by('shift_id','desc')
			->get('ret_shift')->row();
	}

	public function insert($data)
	{
		$this->db->insert('ret_shift',$data);
	}

	public function update($id,$data)
	{
		$this->db->where('shift_id',$id)->update('ret_shift',$data);
	}

	public function get_last()
	{
		$user_id = $this->session->userdata('user_id');

		return $this->db
			->where('user_id',$user_id)
			->order_by('shift_id', 'desc')
			->get('ret_shift')->row();
	}

}
