<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_system extends MX_Controller {

  public function shutdown()
  {
    system('shutdown -s -t 0');
  }

  public function restart()
  {
    system('shutdown -r -t 0');
  }
}
