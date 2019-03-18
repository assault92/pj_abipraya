<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller_management extends ADMIN_Controller {
	
	public $group;
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('controller management', base_url('index.php/developer/controller_management'));
		
		$this->load->model('sys_group');
		$this->load->model('sys_group_controller');
		
		$tmp_name = $this->uri->segment(4) != false ? $this->uri->segment(4) : 'developer';
		$tmp_data = $this->sys_group->get_by_name($tmp_name);
		$this->group = is_object($tmp_data) ? $tmp_data : false;
		
		if($this->group == false){
			echo 'group not found';
			exit();
		}
	}
	
	public function index(){
		$this->template->add_content_view('developer/controller_management/list', array(
			'group' => $this->sys_group->select_all(0, 0),
			'q' => $this->sys_group_controller->select_all(0, 0, $this->group->id),
		), 'controller list');
		$this->template->render();
	}
	
	public function add(){
		$notif = '';
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('controller', 'controller', 'trim|xss_clean|required');
		if($this->form_validation->run() === true){
			$group_id = $this->sys_group_controller->insert(array(
				'controller' => $this->input->post('controller'),
				'group' => $this->group->id,
			));
			
			$notif = 'controller ' . $this->input->post('controller') . ' added!';
			redirect(base_url('index.php/developer/controller_management/index/' . $this->group->name . '?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('add new');
		$this->template->add_content_view('developer/controller_management/add', array(
		), 'add controller');
		$this->template->render();
	}
	
	public function edit(){
		$notif = '';
		$id = intval($this->uri->segment(5));
		$data = $this->sys_group_controller->get($id);
		
		if(!is_object($data)){
			echo 'id not found!';
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('controller', 'controller', 'trim|xss_clean|required');
		if($this->form_validation->run() === true){
			$this->sys_group_controller->update($id, array(
				'controller' => $this->input->post('controller'),
			));
			
			$notif = 'controller ' . $data->controller . ' updated to ' . $this->input->post('controller');
			redirect(base_url('index.php/developer/controller_management/index/' . $this->group->name . '?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('edit');
		$this->template->add_breadcrumb($data->controller);
		$this->template->add_content_view('developer/controller_management/edit', array(
			'data' => $data,
		), 'edit: ' . $data->controller);
		$this->template->render();
	}
	
	public function del(){
		$notif = '';
		
		$id = intval($this->uri->segment(5));
		$data = $this->sys_group_controller->get($id);
		
		if(is_object($data)){
			$this->sys_group_controller->delete($id);
			$notif = 'controller ' . $data->controller . ' deleted!';
		}else{
			$notif = 'error on deleting controller ' . $data->controller;
		}
		
		redirect(base_url('index.php/developer/controller_management/index/' . $this->group->name . '?notif=' . $notif));
	}
}

/* End of file controller_management.php */