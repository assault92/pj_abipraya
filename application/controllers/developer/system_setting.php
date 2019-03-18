<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class system_setting extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('system setting', base_url('index.php/developer/system_setting'));
	}
	
	public function index(){
		$this->template->add_content_view('developer/system_setting/list', array(
			'q' => $this->sys_setting->select_all(0, 0),
		), 'setting list');
		$this->template->render();
	}
		
	public function edit(){
		$notif = '';
		$id = intval($this->uri->segment(4));
		$data = $this->sys_setting->get($id);
		
		if(!is_object($data)){
			echo 'id not found!';
			return;
		}
		
		$this->load->library('form_validation');
		if($data->type == 'numeric' || $data->type == 'boolean'){
			$this->form_validation->set_rules('value', 'value', 'numeric|required');
		}else{
			$this->form_validation->set_rules('value', 'value', 'trim|xss_clean|required');
		}
		if($this->form_validation->run() === true){
			$this->sys_setting->update($id, array(
				'value' => $this->input->post('value'),
			));
			
			$notif = 'setting ' . $data->key . ' updated to ' . $this->input->post('value');
			redirect(base_url('index.php/developer/system_setting/?tabs=0&notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('edit');
		$this->template->add_breadcrumb($data->key);
		$this->template->add_content_view('developer/system_setting/edit', array(
			'data' => $data,
			'setting' => $this->sys_setting->select_all(),
		), 'edit: ' . $data->key);
		$this->template->render();
	}
}

/* End of file system_setting.php */