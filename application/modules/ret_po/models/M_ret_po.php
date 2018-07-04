<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_po extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->join('ret_supplier','ret_po.supplier_id = ret_supplier.supplier_id')
				->order_by('tx_date','desc')
				->get('ret_po',$number,$offset)
				->result();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->join('ret_supplier','ret_po.supplier_id = ret_supplier.supplier_id')
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->order_by('tx_date','desc')
				->get('ret_po',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('ret_po')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('tx_id',$id)->get('ret_po')->row();
  }

  public function get_last()
  {
    return $this->db
			->order_by('tx_id','desc')
			->get('ret_po')->row();
  }

	public function get_detail($tx_id,$tx_type)
	{
    $result = $this->db
			->join('ret_supplier','ret_po.supplier_id = ret_supplier.supplier_id')
			->join('ret_tx_type','ret_po.tx_type = ret_tx_type.tx_type')
			->where('tx_id',$tx_id)
			->get('ret_po')->row();

		$result->po_detail = $this->get_po_detail($tx_id, $tx_type);
    return $result;
	}

	public function get_po_detail($tx_id,$tx_type)
	{
		$date = date('Y-m-d');

    return $this->db->query(
			"SELECT
				a.*,
				s.item_name,
				IFNULL(t.item_purchase, 0) AS item_purchase
      FROM ret_po_detail a
			LEFT JOIN(
				SELECT
					item_id,
					AVG(stock_price) AS item_purchase
				FROM ret_stock
				WHERE
					tx_date <= '$date' AND
					tx_type = 'TXI'
				GROUP BY item_id
			) t ON (a.item_id = t.item_id)
			JOIN(
				SELECT
					item_id,
					item_name
				FROM
					ret_item
			) s ON (a.item_id = s.item_id)
			WHERE a.tx_id = '$tx_id'"
		)->result();
			// ->join('ret_item','ret_po_detail.item_id = ret_item.item_id')
			// ->where('tx_id', $tx_id)
			// ->where('tx_type', $tx_type)
			// ->get('ret_po_detail')->result();
	}

  public function insert($data)
  {
    $this->db->insert('ret_po',$data);
  }

	public function insert_detail($data)
	{
		$this->db->insert('ret_po_detail',$data);
	}

	public function update_detail($stock_id,$data)
	{
		$this->db->where('stock_id',$stock_id)->update('ret_po_detail',$data);
	}

  public function update($id,$data)
  {
    $this->db->where('tx_id',$id)->update('ret_po',$data);
  }

  public function delete($id)
  {
    $this->db->where('tx_id',$id)->update('ret_po',array('is_deleted' => '1'));
  }

	public function cancel($tx_id)
	{
		$this->db->where('tx_id',$tx_id)->update('ret_po',array('tx_status' => '-1'));
	}

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_po')->num_rows();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->get('ret_po')->num_rows();
		}
	}

}
