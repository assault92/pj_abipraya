<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sys_group extends MY_Model {
	public function __construct(){
		parent::__construct('sys_group');
	}
	
	public function get_by_name($name){
		$this->db->flush_cache();
		$this->db->select();
		$this->db->like('name', $name, 'none');
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function select_operator_group($limit = 0, $offset = 0){
		$this->db->flush_cache();
		$this->db->select('sys_group.*');
		$this->db->where('id = 3');
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
}

/* End of file sys_group.php */