<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('RAND_CODE', rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));
define('RAND_CODE1', rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));
define('RAND_CODE2', rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));

class MY_Controller extends CI_Controller {
	const VERSION = 'ci_tpl v3.0 rev02 - Default Edition';
	protected $paging_style;
	
	// old compatibility
	const RELEASE = false;
	const SITE_NAME = self::VERSION;
	
	public function __construct(){
		parent::__construct();
		
		if(file_exists('../install')){
			header('Location: ../install');
			exit();
		}
		
		$this->load->database();
		$this->load->library('session');
		
		$this->load->model('sys_setting');
		$this->load->model('sys_user');
		$this->load->library('template');
		
		$this->template->set_title($this->sys_setting->value('site name'));
		
		
		$this->paging_style = array(
			'full_tag_open' => '<div class="pagination"><ul>',
			'full_tag_close' => '</ul></div>',
			'first_link' => 'First',
			'first_tag_open' => '<li>',
			'first_tag_close' => '</li>',
			'last_link' => 'Last',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'next_link' => 'Next',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_link' => 'Prev',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'cur_tag_open' => '<li class="disabled"><a>',
			'cur_tag_close' => '</a></li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
		);
		
	}
}

require __DIR__ . '/Controller/ADMIN_Controller.php';
require __DIR__ . '/Controller/PUBLIC_Controller.php';

/* End of file MY_Controller.php */