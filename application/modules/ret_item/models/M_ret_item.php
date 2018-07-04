<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_item extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->select('ret_item.*')
				->select('ret_category.category_name')
				->select('ret_unit.unit_code')
				->join('ret_category','ret_item.category_id = ret_category.category_id', 'left')
				->join('ret_unit','ret_item.unit_id = ret_unit.unit_id', 'left')
				->where('ret_item.is_deleted','0')
				->get('ret_item',$number,$offset)
				->result();
		}else{
			return $this->db
				->select('ret_item.*')
				->select('ret_category.category_name')
				->select('ret_unit.unit_code')
				->like('item_name',$search_term,'both')
				->join('ret_category','ret_item.category_id = ret_category.category_id','left')
				->join('ret_unit','ret_item.unit_id = ret_unit.unit_id','left')
				->where('ret_item.is_deleted','0')
				->get('ret_item',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('ret_item')->result();
	}

  public function get_by_id($id)
  {
		$data = $this->db->where('item_id',$id)->get('ret_item')->row();
		$data->package = $this->get_package($id);
    return $data;
  }

	public function get_package($item_id)
	{
		return $this->db->where('item_id',$item_id)->get('ret_item_package')->result();
	}

  public function get_last()
  {
    return $this->db->order_by('item_id','desc')->get('ret_item')->row();
  }

  public function insert($data)
  {
    $this->db->insert('ret_item',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('item_id',$id)->update('ret_item',$data);
  }

  public function delete($id)
  {
    $this->db->where('item_id',$id)->update('ret_item',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_item')->num_rows();
		}else{
			return $this->db->like('item_name',$search_term,'both')->get('ret_item')->num_rows();
		}
	}

	public function clear_package($item_id)
	{
		$this->db
			->where('item_id',$item_id)
			->delete('ret_item_package');
	}

	public function insert_package($data)
	{
		$this->db
			->insert('ret_item_package', $data);
	}

}
