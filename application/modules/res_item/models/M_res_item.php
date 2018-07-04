<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_item extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->select('res_item.*')
				->select('res_category.category_name')
				->select('res_unit.unit_code')
				->join('res_category','res_item.category_id = res_category.category_id', 'left')
				->join('res_unit','res_item.unit_id = res_unit.unit_id', 'left')
				->where('res_item.is_deleted','0')
				->get('res_item',$number,$offset)
				->result();
		}else{
			return $this->db
				->select('res_item.*')
				->select('res_category.category_name')
				->select('res_unit.unit_code')
				->like('item_name',$search_term,'both')
				->join('res_category','res_item.category_id = res_category.category_id','left')
				->join('res_unit','res_item.unit_id = res_unit.unit_id','left')
				->where('res_item.is_deleted','0')
				->get('res_item',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_item')->result();
	}

  public function get_by_id($id)
  {
		$data = $this->db->where('item_id',$id)->get('res_item')->row();
		$data->package = $this->get_package($id);
    return $data;
  }

	public function get_package($item_id)
	{
		return $this->db->where('item_id',$item_id)->get('res_item_package')->result();
	}

  public function get_last()
  {
    return $this->db->order_by('item_id','desc')->get('res_item')->row();
  }

  public function insert($data)
  {
    $this->db->insert('res_item',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('item_id',$id)->update('res_item',$data);
  }

  public function delete($id)
  {
    $this->db->where('item_id',$id)->update('res_item',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_item')->num_rows();
		}else{
			return $this->db->like('item_name',$search_term,'both')->get('res_item')->num_rows();
		}
	}

	public function clear_package($item_id)
	{
		$this->db
			->where('item_id',$item_id)
			->delete('res_item_package');
	}

	public function insert_package($data)
	{
		$this->db
			->insert('res_item_package', $data);
	}

}
