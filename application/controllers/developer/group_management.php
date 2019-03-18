<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group_management extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('group management', base_url('index.php/developer/group_management'));
		
		$this->load->model('sys_group');
	}
	
	public function index(){
		$this->template->add_content_view('developer/group_management/list', array(
			'q' => $this->sys_group->select_all(0, 0),
		), 'group list');
		$this->template->render();
	}
	
	public function add(){
		$notif = '';
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'trim|xss_clean|required');
		if($this->form_validation->run() === true){
			$group_id = $this->sys_group->insert(array(
				'name' => $this->input->post('name'),
			));
			
			$notif = 'group ' . $this->input->post('name') . ' added!';
			$this->template->add_notif($notif);
			$this->index();
			return;
		}
		
		$this->template->add_breadcrumb('add new');
		$this->template->add_content_view('developer/group_management/add', array(
			'group' => $this->sys_group->select_all(),
		), 'add group');
		$this->template->render();
	}
	
	public function edit(){
		$notif = '';
		$id = intval($this->uri->segment(4));
		$data = $this->sys_group->get($id);
		
		if(!is_object($data)){
			echo 'id not found!';
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'trim|xss_clean|required');
		if($this->form_validation->run() === true){
			$this->sys_group->update($id, array(
				'name' => $this->input->post('name'),
			));
			
			$notif = 'group ' . $data->name . ' updated to ' . $this->input->post('name');
			redirect(base_url('index.php/developer/group_management/?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('edit');
		$this->template->add_breadcrumb($data->name);
		$this->template->add_content_view('developer/group_management/edit', array(
			'data' => $data,
			'group' => $this->sys_group->select_all(),
		), 'edit: ' . $data->name);
		$this->template->render();
	}
	
	public function del(){
		$notif = '';
		
		$id = intval($this->uri->segment(4));
		$data = $this->sys_group->get($id);
		
		if(is_object($data)){
			$this->sys_group->delete($id);
			$notif = 'group ' . $data->name . ' deleted!';
		}else{
			$notif = 'error on deleting group ' . $data->name;
		}
		
		redirect(base_url('index.php/developer/group_management/?notif=' . $notif));
	}
}

/* End of file group_management.php */