<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends PUBLIC_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('home', base_url('index.php/public/home'));

		$this->load->model('t_cabor');
	}

	public function index(){
		$this->template->add_content_view('public/home/list', array(
			'q' => $this->t_cabor->select_cabor_public(0, 0),
		), '');
		$this->template->render();
	}
}

/* End of file home.php */