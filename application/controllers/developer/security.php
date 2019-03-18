<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class security extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('security', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/security'));
	}
	
	public function index(){
		$this->template->add_breadcrumb('change password');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/security/change_password', array(
			
		));
		$this->template->render();
	}
	
	public function d32f4_check_password($str){
		if($str == $this->sys_user->user_data()->password){
			return true;
		}
		
		$this->form_validation->set_message('d32f4_check_password', 'The %s field must use current password');
		return false;
	}
	
	public function change_password(){
		$data = $this->sys_user->user_data();
		
		if(is_object($data)){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('current_password', 'current password', 'trim|xss_clean|required|callback_d32f4_check_password');
			$this->form_validation->set_rules('new_password', 'new_password', 'trim|xss_clean|required');
			$this->form_validation->set_rules('confirm_password', 'confirm_password', 'trim|xss_clean|required|matches[new_password]');
			if($this->form_validation->run() === true){
				$this->sys_user->update($data->id, array(
					'password' => $this->input->post('new_password'),
				));
				
				$notif = 'password changed!';
				
				$this->template->add_notif($notif);
				$this->index();
				return;
			}
			
			$this->template->add_content_view($this->sys_user->user_data()->group_name . '/security/change_password', array(
				
			));
			$this->template->render();
		}else{
			echo 'something wrong!';
		}
	}
}

/* End of file security.php */