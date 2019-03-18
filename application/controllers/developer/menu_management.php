<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu_management extends ADMIN_Controller {
	
	public $group;
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('menu management', base_url('index.php/developer/menu_management'));
		
		$this->load->model('sys_group');
		$this->load->model('sys_group_controller');
		$this->load->model('sys_menu');
		
		$tmp_name = $this->uri->segment(4) != false ? $this->uri->segment(4) : 'developer';
		$tmp_data = $this->sys_group->get_by_name($tmp_name);
		$this->group = is_object($tmp_data) ? $tmp_data : false;
		
		if($this->group == false){
			echo 'group not found';
			exit();
		}
	}
	
	public function index(){
		$this->template->add_content_view('developer/menu_management/list', array(
			'group' => $this->sys_group->select_all(0, 0),
			'q' => $this->sys_menu->select_all(0, 0, $this->group->id),
		), 'controller list');
		$this->template->render();
	}
	
	public function reorder(){
		$order_new = (array) $this->input->post('order');
		
		$this->sys_menu->reset_order($this->group->id);
		
		$i = 0;
		foreach($order_new as $id => $n){
			$this->sys_menu->set_order($id, $i);
			$i++;
		}
		
		$notif = 'menu has reordered!';
		redirect(base_url('index.php/developer/menu_management/index/' . $this->group->name . '?notif=' . $notif));
	}
	
	public function add(){
		$notif = '';
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('controller', 'controller', 'trim|xss_clean|required');
		$this->form_validation->set_rules('alias', 'alias', 'trim|xss_clean|required');
		if($this->form_validation->run() === true){
			$group_id = $this->sys_menu->insert(array(
				'controller' => $this->input->post('controller'),
				'alias' => $this->input->post('alias'),
				'method' => '[]',
				'group' => $this->group->id,
			));
			
			$notif = 'controller ' . $this->input->post('controller') . ' added!';
			redirect(base_url('index.php/developer/menu_management/index/' . $this->group->name . '?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('add new');
		$this->template->add_content_view('developer/menu_management/add', array(
			'controller' => $this->sys_group_controller->select_all(0, 0, $this->group->id),
		), 'add controller');
		$this->template->render();
	}
	
	public function edit(){
		$notif = '';
		$id = intval($this->uri->segment(5));
		$data = $this->sys_menu->get($id);
		
		if(!is_object($data)){
			echo 'id not found!';
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('controller', 'controller', 'trim|xss_clean|required');
		$this->form_validation->set_rules('alias', 'alias', 'trim|xss_clean|required');
		if($this->form_validation->run() === true){
			$this->sys_menu->update($id, array(
				'controller' => $this->input->post('controller'),
				'alias' => $this->input->post('alias'),
			));
			
			$notif = 'controller ' . $data->controller . ' updated to ' . $this->input->post('controller');
			redirect(base_url('index.php/developer/menu_management/index/' . $this->group->name . '?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('edit');
		$this->template->add_breadcrumb($data->controller);
		$this->template->add_content_view('developer/menu_management/edit', array(
			'controller' => $this->sys_group_controller->select_all(0, 0, $this->group->id),
			'data' => $data,
		), 'edit: ' . $data->controller);
		$this->template->render();
	}
	
	public function del(){
		$notif = '';
		
		$id = intval($this->uri->segment(5));
		$data = $this->sys_menu->get($id);
		
		if(is_object($data)){
			$this->sys_menu->delete($id);
			$notif = 'menu ' . $data->controller . ' deleted!';
		}else{
			$notif = 'error on deleting menu ' . $data->controller;
		}
		
		redirect(base_url('index.php/developer/menu_management/index/' . $this->group->name . '?notif=' . $notif));
	}
}

/* End of file menu_management.php */