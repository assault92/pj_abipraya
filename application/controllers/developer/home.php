<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('home', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/home'));
	}
	
	public function index(){
		$this->template->add_breadcrumb('dashboard');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/home/dashboard');
		$this->template->render();
	}
}

/* End of file home.php */