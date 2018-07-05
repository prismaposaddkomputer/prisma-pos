<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_report_parking_in extends CI_Model {

	public function report_annual($year)
  {
		$billing = $this->db
			->like('billing_date_in', $year)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

	public function report_monthly($month)
  {
		$billing = $this->db
			->like('billing_date_in', $month)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

	public function weekly($date_start, $date_end)
	{
		$billing = $this->db
		->where('billing_date_in >=', $date_start)
		->where('billing_date_in <=', $date_end)
		->order_by('billing_id','desc')
		->get('par_billing')->result();

		return $billing;
	}

	public function report_daily($date)
  {
		$billing = $this->db
			->where('billing_date_in', $date)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

	public function report_range($date_start, $date_end)
	{
		$billing = $this->db
			->where('billing_date_in >=', $date_start)
			->where('billing_date_in <=', $date_end)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

}
