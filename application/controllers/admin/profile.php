<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('profile', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/profile'));
	}
	
	public function index(){
		$data = $this->sys_user->user_data();
		
		$this->template->add_breadcrumb('update');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/profile/update', array(
			'data' => $data,
		));
		$this->template->render();
	}
	
	public function d32f4_username_exists($str){
		if(!$this->sys_user->username_exists($str, $this->sys_user->user_data()->username) || $str == $this->sys_user->user_data()->username){
			return true;
		}
		
		$this->form_validation->set_message('d32f4_username_exists', '%s is already exists');
		return false;
	}
	
	public function d32f4_email_exists($str){
		if(!$this->sys_user->email_exists($str, $this->sys_user->user_data()->email) || $str == $this->sys_user->user_data()->email){
			return true;
		}
		
		$this->form_validation->set_message('d32f4_email_exists', '%s is already exists');
		return false;
	}
	
	public function update(){
		$data = $this->sys_user->user_data();
		
		if(is_object($data)){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'trim|xss_clean|required');
			$this->form_validation->set_rules('username', 'username', 'trim|xss_clean|required|callback_d32f4_username_exists');
			$this->form_validation->set_rules('email', 'email', 'trim|xss_clean|valid_email|required|callback_d32f4_email_exists');
			
			if($this->form_validation->run() === true){
				$this->sys_user->update($data->id, array(
					'name' => $this->input->post('name'),
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
				));
				
				$notif = 'profile updated!';
				
				$this->sys_user->user_data_reload();
				$this->template->add_notif($notif);
				$this->index();
				return;
			}
			
			if($this->input->is_ajax_request()){
				$this->template->add_content_view($this->sys_user->user_data()->group_name . '/profile/update', array(
					'data' => $data,
				));
			}else{
				$this->template->add_content_view($this->sys_user->user_data()->group_name . '/profile/update', array(
					'data' => $data,
				), 'profile: ' . $data->username);
				$this->template->render();
			}
		}else{
			echo 'something wrong!';
		}
	}
}

/* End of file profile.php */