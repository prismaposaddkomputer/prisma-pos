<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_report_shift extends CI_Model {

	public function report_monthly($month)
  {
		$shift = $this->db
			->like('shift_in_date', $month)
			->order_by('shift_id','desc')
			->get('par_shift')->result();

		return $shift;
	}

	public function report_daily($date)
  {
		$shift = $this->db
			->where('shift_in_date', $date)
			->order_by('shift_id','desc')
			->get('par_shift')->result();

		return $shift;
	}

}
