<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_error extends MY_Error {

	public function error($code)
	{
    switch ($code) {
    	case '403':
    		$this->render('403');
    		break;

    	default:
    		# code...
    		break;
    }
	}

}
