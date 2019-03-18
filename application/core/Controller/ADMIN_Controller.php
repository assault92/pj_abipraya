<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ADMIN_Controller extends MY_Controller {
	protected $user;
	
	public function __construct(){
		parent::__construct();
		if(!$this->sys_user->is_logged()){
			redirect(base_url('index.php/router/login?redir=' . rawurlencode(current_url())));
			exit();
		}
		
		$this->load->model('sys_message');
		$this->template->set_template('template/admin/template');
		
		$this->template->add_menu('Home', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/home'));
		ADMIN_Controller::build_menu();
		
		// default allowed controller
		$allowed_controller = array('home', 'profile', 'message', 'security', 'pic');
		
		$this->load->model('sys_group_controller');
		$group_controller = $this->sys_group_controller->select_all(0, 0, $this->sys_user->user_data()->group);
		foreach($group_controller->result() as $item){
			$allowed_controller[] = $item->controller;
		}
		
		$this->template->append_title($this->sys_user->user_data()->group_name);
		
		if(!in_array($this->router->class, $allowed_controller) || $this->uri->segment(1) != $this->sys_user->user_data()->group_name){
			$this->template->add_breadcrumb('Access Not Prohibited!');
			$this->template->add_content('Access Not Prohibited!', 'Security Warning');
			$this->template->enable_echo();
			$this->template->render();
			exit();
		}
	}
	
	public static function build_menu(){
		if(get_instance()->sys_user->is_logged()){
			$menu = array();
			
			get_instance()->load->model('sys_menu');
			$menu_tmp = get_instance()->sys_menu->select_all(0, 0, get_instance()->sys_user->user_data()->group);
			
			foreach($menu_tmp->result() as $item){
				$controller_link = base_url('index.php/' . get_instance()->sys_user->user_data()->group_name . '/' . $item->controller);
				$menu = get_instance()->template->add_menu($item->alias, $controller_link);
				
				foreach(json_decode($item->method, true) as $child){
					$menu->add_child($child[0], $controller_link . '/' . $child[1]);
				}
			}
			
			return true;
		}else{
			return false;
		}
	}
	
}

/* End of file ADMIN_Controller.php */