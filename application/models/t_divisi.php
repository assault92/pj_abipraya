<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class t_divisi extends MY_Model {
	public function __construct(){
		parent::__construct('t_divisi');
	}

	public function get_by_id($id){
		$this->db->flush_cache();
		$this->db->select();
		$this->db->like('id', $id, 'none');
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function select_divisi_public($limit = 0, $offset = 0){
		$this->db->flush_cache();
		$this->db->select('t_divisi.*');
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
}

/* End of file t_divisi.php */

