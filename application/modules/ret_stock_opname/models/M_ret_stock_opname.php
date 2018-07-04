<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_stock_opname extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->join('ret_tx_type','ret_stock_opname.tx_type = ret_tx_type.tx_type')
				->order_by('tx_date','desc')
				->order_by('tx_id','desc')
				->get('ret_stock_opname',$number,$offset)
				->result();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->join('ret_tx_type','ret_stock_opname.tx_type = ret_tx_type.tx_type')
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->order_by('tx_date','desc')
				->order_by('tx_id','desc')
				->get('ret_stock_opname',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('ret_stock_opname')->result();
	}

  public function get_by_id($id)
  {
    $res = $this->db->
			where('tx_id',$id)
			->get('ret_stock_opname')->row();

		$res->item = $this->get_opname_detail($res->tx_id);

		return $res;
  }

	public function get_opname_detail($tx_id)
	{
		$date = date('Y-m_d');

		return $this->db->query(
			"SELECT
				a.*,
				s.item_name,
				IFNULL(t.item_purchase, 0) AS item_purchase
      FROM ret_stock_opname_detail a
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
			WHERE tx_id = '$tx_id'"
		)->result();
			// ->join('ret_item','ret_stock_opname_detail.item_id = ret_item.item_id')
			// ->where('tx_id', $tx_id)
			// ->get('ret_stock_opname_detail')->result();
	}

  public function get_last()
  {
    return $this->db
			->order_by('tx_id','desc')
			->get('ret_stock_opname')->row();
  }

	public function get_detail($tx_id,$tx_type)
	{
    $result = $this->db
			->join('ret_tx_type','ret_stock_opname.tx_type = ret_tx_type.tx_type')
			->where('tx_id',$tx_id)
			->get('ret_stock_opname')->row();
		$result->recap = $this->get_stock($tx_id,$tx_type);
    return $result;
	}

	public function get_stock($tx_id,$tx_type)
	{
    return $this->db
			->join('ret_item','ret_stock.item_id = ret_item.item_id')
			->where('tx_id', $tx_id)
			->where('tx_type', $tx_type)
			->get('ret_stock')->result();
	}

	public function get_stock_last()
	{
		$date = date('Y-m-d');
		$query = $this->db->query(
      "SELECT
        ret_item.item_id,
				ret_item.item_name,
        IFNULL(s.stock_last, 0) AS stock_last,
				IFNULL(t.item_purchase, 0) AS item_purchase
      FROM ret_item
      LEFT JOIN (
				SELECT
					item_id,
					(sum(stock_in)+sum(stock_out)+sum(stock_adjustment)) AS stock_last
				FROM ret_stock
				WHERE tx_date <= '$date'
				GROUP BY item_id
			) s ON (ret_item.item_id = s.item_id)
			LEFT JOIN(
				SELECT
					item_id,
					AVG(stock_price) AS item_purchase
				FROM ret_stock
				WHERE
					tx_date <= '$date' AND
					tx_type = 'TXI'
				GROUP BY item_id
			) t ON (ret_item.item_id = t.item_id)"
    );

		return $query->result();
	}

  public function insert($data)
  {
    $this->db->insert('ret_stock_opname',$data);
  }

	public function insert_detail($data)
  {
    $this->db->insert('ret_stock_opname_detail',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('tx_id',$id)->update('ret_stock_opname',$data);
  }

	public function update_detail($id,$data)
  {
    $this->db->where('stock_id',$id)->update('ret_stock_opname_detail',$data);
  }

  public function delete($id)
  {
    $this->db->where('stock_opname_id',$id)->update('ret_stock_opname',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_stock_opname')->num_rows();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->get('ret_stock_opname')->num_rows();
		}
	}

}
