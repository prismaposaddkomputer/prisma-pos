<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_harian extends CI_Model {

	public function get_list($number,$offset,$search = null)
  {
		$where = "";
		if($search != null){
			$where = "WHERE tx_date LIKE '%".$search['tahun']."-".$search['bulan']."%' ";
		}

		$query = $this->db->query(
			"SELECT * FROM res_billing
			$where
			ORDER BY tx_date DESC
			LIMIT $offset,$number"
		);

		return $query->result();
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_billing')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('tx_id',$id)->get('res_billing')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('tx_id','desc')->get('res_billing')->row();
  }

  public function insert($data)
  {
		$client = $this->db->get('res_client')->row();
		
		if ($client->client_is_taxed == 1) {
			$d = array(
				'tx_receipt_no' => $data['tx_receipt_no'],
				'tx_status' => 1,
				'user_id' => $this->session->userdata('user_id'),
				'user_realname' => $this->session->userdata('user_realname'),
				'customer_id' => 0,
				'customer_name' => 'Global Harian',
				'tx_date' => $data['tx_date'],
				'tx_total_tax' => (10/110)*$data['total_transaksi'],
				'tx_total_before_tax' => (100/110)*$data['total_transaksi'],
				'tx_total_after_tax' => $data['total_transaksi'],
				'tx_total_grand' => $data['total_transaksi']
			);
		}else{
			$d = array(
				'tx_receipt_no' => $data['tx_receipt_no'],
				'tx_status' => 1,
				'user_id' => $this->session->userdata('user_id'),
				'user_realname' => $this->session->userdata('user_realname'),
				'customer_id' => 0,
				'customer_name' => 'Global Harian',
				'tx_date' => $data['tx_date'],
				'tx_total_tax' => (10/100)*$data['total_transaksi'],
				'tx_total_before_tax' => $data['total_transaksi'],
				'tx_total_after_tax' => ((10/100)*$data['total_transaksi'])+$data['total_transaksi'],
				'tx_total_grand' => ((10/100)*$data['total_transaksi'])+$data['total_transaksi']
			);
		}

		$exist = $this->db->where('tx_receipt_no',$d['tx_receipt_no'])->get('res_billing')->row();

		if($exist == null){
			//insert new
			$this->db->insert('res_billing',$d);
		}else{
			//update 
			$this->db->where('tx_receipt_no',$d['tx_receipt_no'])->update('res_billing',$d);
		}
  }

  public function update($id,$data)
  {
		$client = $this->db->get('res_client')->row();
		
		if ($client->client_is_taxed == 1) {
			$d = array(
				'tx_total_tax' => (10/110)*$data['total_transaksi'],
				'tx_total_before_tax' => (100/110)*$data['total_transaksi'],
				'tx_total_after_tax' => $data['total_transaksi'],
				'tx_total_grand' => $data['total_transaksi']
			);
		}else{
			$d = array(
				'tx_total_tax' => (10/100)*$data['total_transaksi'],
				'tx_total_before_tax' => $data['total_transaksi'],
				'tx_total_after_tax' => ((10/100)*$data['total_transaksi'])+$data['total_transaksi'],
				'tx_total_grand' => ((10/100)*$data['total_transaksi'])+$data['total_transaksi']
			);
		}

		$this->db->where('tx_id',$id)->update('res_billing',$d);
  }

  public function delete($id)
  {
    $this->db->where('tx_id',$id)->update('res_billing',array('is_deleted' => '1'));
  }

	function num_rows($search){
		$where = "";
		if($search != null){
			$where = "WHERE tx_date LIKE '%".$search['tahun']."-".$search['bulan']."%' ";
		}

		$query = $this->db->query(
			"SELECT * FROM res_billing
			$where
			ORDER BY tx_date DESC"
		);

		return $query->num_rows();
	}

}
