<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class message extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('message', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message'));
	}
	
	public function index(){
		$this->template->add_breadcrumb('inbox');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/message/inbox', array(
			'q' => $this->sys_message->select_all(0, 0, $this->sys_user->user_data()->id),
			'folder' => 'inbox',
		));
		$this->template->render();
	}
	
	public function sent(){
		$this->template->add_breadcrumb('sent');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/message/inbox', array(
			'q' => $this->sys_message->select_all(0, 0, $this->sys_user->user_data()->id, 'sent'),
			'folder' => 'sent',
		));
		$this->template->render();
	}
	
	public function trash(){
		$this->template->add_breadcrumb('trash');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/message/trash', array(
			'q' => $this->sys_message->select_all(0, 0, $this->sys_user->user_data()->id, 'trash')
		));
		$this->template->render();
	}
	
	public function permanent_delete(){
		$id = intval($this->uri->segment(4));
		$data = $this->sys_message->get($id);
		
		if(!is_object($data)){
			echo 'id not found';
			return;
		}
		
		$this->sys_message->delete($data->id);
		
		$notif = 'message "' . $data->subject . '" permanently deleted!';
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/trash?notif=' . $notif));
	}
	
	public function delete(){
		$id = intval($this->uri->segment(4));
		$data = $this->sys_message->get($id);
		
		if(!is_object($data)){
			echo 'id not found';
			return;
		}
		
		$this->sys_message->update($data->id, array(
			'trash' => 1,
		));
		
		$folder = $data->from == $this->sys_user->user_data()->id ? 'sent' : '';
		
		$notif = 'message "' . $data->subject . '" moved to trash!';
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/' . $folder . '?notif=' . $notif));
	}
	
	public function restore(){
		$id = intval($this->uri->segment(4));
		$data = $this->sys_message->get($id);
		
		if(!is_object($data)){
			echo 'id not found';
			return;
		}
		
		$this->sys_message->update($data->id, array(
			'trash' => 0,
		));
		
		$folder = $data->from == $this->sys_user->user_data()->id ? 'sent' : '';
		
		$notif = 'message "' . $data->subject . '" restored!';
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/' . $folder . '?notif=' . $notif));
	}
	
	public function detail(){
		$id = intval($this->uri->segment(4));
		$data = $this->sys_message->get($id);
		
		if(!is_object($data)){
			echo 'id not found';
			return;
		}
		
		if($data->to == $this->sys_user->user_data()->id && ($data->read) == 0){
			$this->sys_message->update($data->id, array(
				'read' => 1,
			));
		}
		
		$this->template->add_breadcrumb('detail');
		$this->template->add_breadcrumb($data->subject, format_date($data->post_time));
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/message/detail', array(
			'data' => $data,
		));
		$this->template->render();
	}
	
	public function reply(){
		$id = intval($this->uri->segment(4));
		$data = $this->sys_message->get($id);
		
		if(!is_object($data)){
			echo 'id not found';
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', 'subject', 'trim|xss_clean|required');
		$this->form_validation->set_rules('content', 'content', 'trim|xss_clean|required');
		
		if($this->form_validation->run() === true){
			$this->sys_message->insert(array(
				'from' => $this->sys_user->user_data()->id,
				'to' => $data->from,
				'subject' => $this->input->post('subject'),
				'content' => $this->input->post('content'),
				'post_time' => date('Y-m-d H:i:s'),
				'read' => 0,
				'trash' => 0,
			));
			
			$notif = 'message sent!';
			redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/sent?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('compose');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/message/detail', array(
			'data' => $data,
		));
		$this->template->render();
	}
	
	public function d32f4_id_exists($str){
		if(!$this->sys_user->id_exists($str, $this->sys_user->user_data()->id, true)){
			return true;
		}
		
		$this->form_validation->set_message('d32f4_id_exists', 'receiver invalid');
		return false;
	}
	
	public function compose(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', 'subject', 'trim|xss_clean|required');
		$this->form_validation->set_rules('content', 'content', 'trim|xss_clean|required');
		$this->form_validation->set_rules('to', 'to', 'is_natural_no_zero|required|callback_d32f4_id_exists');
		
		if($this->form_validation->run() === true){
			$this->sys_message->insert(array(
				'from' => $this->sys_user->user_data()->id,
				'to' => $this->input->post('to'),
				'subject' => $this->input->post('subject'),
				'content' => $this->input->post('content'),
				'post_time' => date('Y-m-d H:i:s'),
				'read' => 0,
				'trash' => 0,
			));
			
			$notif = 'message sent!';
			redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/sent?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('compose');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/message/compose', array(
			'q' => $this->sys_user->select_all(0, 0),
		));
		$this->template->render();
	}
}

/* End of file message.php */