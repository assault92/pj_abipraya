<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sys_menu extends MY_Model {
	public function __construct(){
		parent::__construct('sys_menu');
	}
	
	public function select_all($limit = 0, $offset = 0, $group_id){
		$this->db->flush_cache();
		$this->db->select();
		$this->db->where('sys_menu.group', $group_id);
		$this->db->order_by('sys_menu.order ASC');
		
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
	
	public function reset_order($group_id){
		$this->db->flush_cache();
		$this->db->set('order', 0);
		$this->db->where('sys_menu.group', $group_id);
		$this->db->update($this->table);
	}
	
	public function set_order($id, $i){
		$this->db->flush_cache();
		$this->db->set('order', $i);
		$this->db->where('sys_menu.id', $id);
		$this->db->update($this->table);
	}
}

/* End of file sys_menu.php */