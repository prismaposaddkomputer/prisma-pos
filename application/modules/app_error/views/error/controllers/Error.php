<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MY_Admin {

	public function error_403()
	{
    $this->view('403');
	}

}
