<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sys_user extends MY_Model {
	private $_user_data;
	
	public function __construct(){
		parent::__construct('sys_user');
		$this->load->library('session');
		$this->_user_data = null;
		
		if($this->session->userdata('token') == false || $this->session->userdata('token') == '-')
			$this->session->set_userdata('token', '-');
		else
			$this->_login($this->session->userdata('token'));
	}
	
	public function user_data_reload(){
		return $this->_user_data = $this->get($this->_user_data->id);
	}
	
	public function user_data(){
		return $this->_user_data;
	}
	
	public function is_logged(){
		return is_object($this->_user_data) > 0 ? true : false;
	}
	
	public function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username_email', 'username/email', 'trim|xss_clean|required');
		$this->form_validation->set_rules('password', 'password', 'trim|xss_clean|required');
		if($this->form_validation->run() === true){
			$login = $this->_login($this->input->post('username_email'), $this->input->post('password'));
			if($login == false){
				redirect(base_url('index.php/router/login?error=1'));
				exit();
			}else
				return true;
		}
		return false;
	}
	
	public function _login($post_token, $password = null){
		$this->db->flush_cache();
		$this->db->select('sys_user.*, sys_group.name as group_name');
		$this->db->from($this->table);
		$this->db->join('sys_group', 'sys_user.group = sys_group.id');
		if($password == null){
			$this->db->like('token', addcslashes($post_token, '%_'), 'none');
		}else{
			$this->db->where('(sys_user.username LIKE' .$this->db->escape($post_token).' OR  sys_user.email LIKE  '.$this->db->escape($post_token).') AND sys_user.password LIKE '. addcslashes($this->db->escape($password), '%_'));
		}
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$user = $q->row();
			$this->_user_data = $user;
			
			if($password != null){
				$token = md5($user->id . $user->username . time());
				$this->session->set_userdata('token', $token);
				$this->update($user->id, array(
					'token' => $token,
				));
			}
			
			return true;
		}else{
			$this->session->set_userdata('token', '-');
			return false;
		}
	}
	
	public function logout(){
		$this->session->set_userdata('token', '-');
	}
	
	
	public function get_by_email($email){
		$this->db->flush_cache();
		$this->db->select('sys_user.*, sys_group.name as group_name');
		$this->db->join('sys_group', 'sys_user.group = sys_group.id');
		$this->db->like('sys_user.email', $email);
		
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
	
	public function get($id){
		$this->db->flush_cache();
		$this->db->select('sys_user.*, sys_group.name as group_name');
		$this->db->join('sys_group', 'sys_user.group = sys_group.id');
		$this->db->where('sys_user.id', intval($id));
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
	
	public function select_all($limit = 0, $offset = 0){
		$this->db->flush_cache();
		$this->db->select('sys_user.*, sys_group.name as group_name');
		$this->db->join('sys_group', 'sys_user.group = sys_group.id');
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
	
	public function select_all_except($limit = 0, $offset = 0, $except){
		$this->db->flush_cache();
		$this->db->select('sys_user.*, sys_group.name as group_name');
		$this->db->join('sys_group', 'sys_user.group = sys_group.id');
		$this->db->where('sys_user.group !=', $except);
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
	
	private function _data_exists($field, $data, $except = false, $where = false){
		$this->db->flush_cache();
		$this->db->select('count(*) as `counter`', false);
		
		if($where){
			$this->db->where('sys_user.' . $field, $data);
		}else{
			$this->db->like('sys_user.' . $field, $data);
		}
		
		if($except != false){
			if($where){
				$this->db->where('sys_user.' . $field, $except);
			}else{
				$this->db->like('sys_user.' . $field, $data);
			}
		}
		
		$q = $this->db->get($this->table);
		return ($q->row()->counter > 0);
	}

	
	public function email_exists($email, $except = false, $where = false){
		return $this->_data_exists('email', $email, $except, $where);
	}
	
	public function username_exists($username, $except = false, $where = false){
		return $this->_data_exists('username', $username, $except, $where);
	}
	
	public function id_exists($id, $except = false, $where = false){
		return $this->_data_exists('id', $id, $except, $where);
	}
}

/* End of file sys_user.php */