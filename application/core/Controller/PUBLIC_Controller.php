<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PUBLIC_Controller extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		
		
		
		$this->template->set_template('template/public/template');
	}
	
}

/* End of file PUBLIC_Controller.php */