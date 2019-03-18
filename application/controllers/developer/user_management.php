<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_management extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('user management', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/user_management'));
		
		$this->load->model('sys_group');
	}
	
	public function index(){
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/user_management/list', array(
			'q' => $this->sys_user->select_all_except(0, 0, 1),
		), 'user list');
		$this->template->render();
	}
	
	public function add(){
		$notif = '';
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('username', 'username', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'email', 'trim|xss_clean|valid_email|required');
		$this->form_validation->set_rules('password', 'password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('group', 'group', 'numeric|required');
		if($this->form_validation->run() === true){
			$user_id = $this->sys_user->insert(array(
				'group' => $this->input->post('group'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'token' => '-',
				'name' => $this->input->post('name'),
			));
			
			$notif = 'user ' . $this->input->post('username') . ' added!';
			$this->template->add_notif($notif);
			$this->index();
			return;
		}
		
		$this->template->add_breadcrumb('add new');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/user_management/add', array(
			'group' => $this->sys_group->select_all(),
		), 'add user');
		$this->template->render();
	}
	
	public function edit(){
		$notif = '';
		$id = intval($this->uri->segment(4));
		$data = $this->sys_user->get($id);
		
		if(!is_object($data)){
			echo 'id not found!';
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('username', 'username', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'email', 'trim|xss_clean|valid_email|required');
		$this->form_validation->set_rules('password', 'password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('group', 'group', 'numeric|required');
		if($this->form_validation->run() === true){
			$this->sys_user->update($id, array(
				'group' => $this->input->post('group'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'name' => $this->input->post('name'),
			));
			
			$notif = 'user ' . $data->username . ' updated to ' . $this->input->post('username');
			redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/user_management/?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('edit');
		$this->template->add_breadcrumb($data->name);
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/user_management/edit', array(
			'data' => $data,
			'group' => $this->sys_group->select_all(),
		), 'edit: ' . $data->name);
		$this->template->render();
	}
	
	public function del(){
		$notif = '';
		
		$id = intval($this->uri->segment(4));
		$data = $this->sys_user->get($id);
		
		if(is_object($data)){
			$this->sys_user->delete($id);
			$notif = 'user ' . $data->username . ' deleted!';
		}else{
			$notif = 'error on deleting user ' . $data->username;
		}
		
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/user_management/?notif=' . $notif));
	}
}

/* End of file user_management.php */