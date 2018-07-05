<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_report_parking_out extends CI_Model {

	public function report_annual($year)
  {
		$billing = $this->db
			->where('billing_status_out',1)
			->like('billing_date_out', $year)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

	public function report_monthly($month)
  {
		$billing = $this->db
			->where('billing_status_out',1)
			->like('billing_date_out', $month)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

	public function report_weekly($date_start,$date_end)
  {
		$billing = $this->db
			->where('billing_status_out',1)
			->where('billing_date_out >=', $date_start)
			->where('billing_date_out <=', $date_end)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

	public function report_daily($date)
  {
		$billing = $this->db
			->where('billing_status_out', 1)
			->where('billing_date_out', $date)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

	public function report_range($date_start, $date_end)
	{
		$billing = $this->db
			->where('billing_status_out',1)
			->where('billing_date_out >=', $date_start)
			->where('billing_date_out <=', $date_end)
			->order_by('billing_id','desc')
			->get('par_billing')->result();

		return $billing;
	}

}
