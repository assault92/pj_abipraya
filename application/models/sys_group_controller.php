<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sys_group_controller extends MY_Model {
	public function __construct(){
		parent::__construct('sys_group_controller');
	}

	public function select_all($limit = 0, $offset = 0, $group_id){
		$this->db->flush_cache();
		$this->db->select();
		$this->db->where('sys_group_controller.group', $group_id);
		
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
}

/* End of file sys_group_controller.php */