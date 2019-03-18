<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sys_message extends MY_Model {
	public function __construct(){
		parent::__construct('sys_message');
	}
	
	public function count_unread_inbox($user_id){
		$this->db->flush_cache();
		$this->db->select('count(*) as `counter`', false);
		
		$this->db->where('sys_message.to', $user_id);
		$this->db->where('sys_message.trash', 0);
		$this->db->where('sys_message.read', 0);
		$q = $this->db->get($this->table);
		
		return $q->row()->counter;
	}
	
	public function select_all($limit = 0, $offset = 0, $user_id, $folder = 'inbox'){
		if($folder == 'trash'){
			$this->db->flush_cache();
			$this->db->order_by('sys_message.post_time DESC');
			$this->db->select('
				user_from.name as `from_name`,
				user_from.email as `from_email`,
				user_to.name as `to_name`,
				user_to.email as `to_email`,
				sys_message.*');
			$this->db->join('sys_user as user_from', 'sys_message.from = user_from.id', false);
			$this->db->join('sys_user as user_to', 'sys_message.to = user_to.id', false);
			$this->db->where('sys_message.trash', 1);
		}else{
			$this->db->flush_cache();
			$this->db->select('sys_message.*, sys_user.name as name, sys_user.email as email');
			$this->db->order_by('sys_message.post_time DESC');
			
			switch($folder){
				case 'sent':
					$this->db->where('sys_message.from', $user_id);
					$this->db->where('sys_message.trash', 0);
					$this->db->join('sys_user', 'sys_message.to = sys_user.id');
					break;
					
				default:
					$this->db->where('sys_message.to', $user_id);
					$this->db->where('sys_message.trash', 0);
					$this->db->join('sys_user', 'sys_message.from = sys_user.id');
					break;
			}
		}
		
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
	
	public function get($id){
		$this->db->flush_cache();
		$this->db->select('
			user_from.name as `from_name`,
			user_from.email as `from_email`,
			user_to.name as `to_name`,
			user_to.email as `to_email`,
			sys_message.*');
		$this->db->join('sys_user as user_from', 'sys_message.from = user_from.id', false);
		$this->db->join('sys_user as user_to', 'sys_message.to = user_to.id', false);
		$this->db->where('sys_message.id', $id);
		$q = $this->db->get($this->table);
		return $q->num_rows() > 0 ? $q->row() : false;
	}
}

/* End of file sys_message.php */