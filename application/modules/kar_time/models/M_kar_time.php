<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_time extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_time',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('time_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_time',$number,$offset)
				->result();
		}
  }

	public function get_time($time)
	{
		return $this->db->query(
			"SELECT
				*
			FROM
				kar_time
			WHERE
				'$time' >= time_start AND
				'$time' <= time_end"
			)->row();
	}

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_time')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('time_id',$id)->get('kar_time')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('time_id','desc')->get('kar_time')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_time',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('time_id',$id)->update('kar_time',$data);
  }

  public function delete($id)
  {
    $this->db->where('time_id',$id)->update('kar_time',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_time')->num_rows();
		}else{
			return $this->db->like('time_name',$search_term,'both')->get('kar_time')->num_rows();
		}
	}

}
