<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class router extends MY_Controller {
	
	private $forgot_email;
	
	public function __construct(){
		parent::__construct();
		
		$this->template->set_template('template/admin/login-template');
	}
	
	public function index(){
		if(!$this->sys_user->is_logged()){
			if($this->sys_setting->value('authorized only') == 1){
				redirect(base_url('index.php/router/login?redir=' . $this->input->get('redir')));
			}else{
				redirect(base_url('index.php/public/pegawai/'));
			}
			return;
		}
		
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/home'));
	}

	public function login(){
		if($this->sys_user->login()){
			if($this->input->get('redir') != false){
				redirect(rawurldecode($this->input->get('redir')));
			}else{
				redirect(base_url());
			}
			return;
		}
		
		$this->template->set_title('Login');
		$this->template->add_content_view('template/admin/router/login', 'Login');
		$this->template->render();
	}
	
	public function logout(){
		$this->sys_user->logout();
		redirect(base_url(''));
	}
	
	
	public function d32f4_email_exists($str){
		$this->forgot_email = $this->sys_user->get_by_email($str);
		
		if($this->forgot_email !== false){
			return true;
		}
		
		$this->form_validation->set_message('d32f4_email_exists', '%s doesn\'t exists');
		return false;
	}
	
	public function forgot_password(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'valid_email|required|callback_d32f4_email_exists');
		if($this->form_validation->run() === true){
			$this->load->library('email');
			$this->email->from('no-reply@' . $this->config->item('domain'), 'no-reply');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Forgot Password');
			$this->email->message($this->load->view('template/admin/router/forgot_password_email', array('data' => $this->forgot_email), true));
			$this->email->send();
			
			$this->template->add_content('Email sent to ' . $this->input->post('email') . '!', 'Forgot Password');
		}else{
			$this->template->add_content_view('template/admin/router/forgot_password', 'Forgot Password');
		}
		
		$this->template->set_title('Forgot password');
		$this->template->render();
	}
	
	public function register(){
		$this->template->set_title('Register');
		$this->template->add_content_view('template/admin/router/register', 'Register');
		$this->template->render();
	}
	
	public function notfound(){
		$this->template->set_title('404- not found');
		$this->template->add_content_view('template/admin/router/notfound', ':-(');
		$this->template->render();
	}
}

/* End of file router.php */