<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	protected $table;
	
	public function __construct($table = null){
		parent::__construct();
		
		if($table != null){
			$this->table = $table;
		}
	}
	
	protected function set_table($table){
		$this->table = $table;
	}
	
	public function last_id(){
		$this->db->flush_cache();
		$this->db->select('(`id` + 1) as `max_id`', false);
		$this->db->limit(1);
		$this->db->order_by('id DESC');
		return $this->db->get($this->table)->row()->max_id;
	}
	
	public function insert($data){
		$this->db->flush_cache();
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function update($id, $data){
		$this->db->flush_cache();
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	
	public function delete($id){
		$this->db->flush_cache();
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	
	public function get($id){
		$this->db->flush_cache();
		$this->db->select();
		$this->db->where('id', intval($id));
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
	
	public function select_all($limit = 0, $offset = 0){
		$this->db->flush_cache();
		$this->db->select();
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
	
	public function count(){
		$this->db->flush_cache();
		$this->db->select('COUNT(*) AS `counter`', false);
		$q = $this->db->get($this->table);
		return $q->row()->counter;
	}
	
	public function select_costum($select, $limit = 0, $offset = 0){
		$this->db->flush_cache();
		$this->db->select($select);
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
}

/* End of file MY_Model.php */