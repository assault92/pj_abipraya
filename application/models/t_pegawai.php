<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class t_pegawai extends MY_Model {
	public function __construct(){
		parent::__construct('t_pegawai');
	}

	public function get_by_id($id){
		$this->db->flush_cache();
		$this->db->select('t_pegawai.id, t_divisi.nama as divisi, t_pegawai.nik, t_pegawai.nama, t_pegawai.alamat, t_pegawai.telephone, t_pegawai.status');
		$this->db->join('t_divisi', 't_pegawai.divisi = t_divisi.id');
		$this->db->like('t_pegawai.id', $id, 'none');
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function select_pegawai_public($limit = 0, $offset = 0){
		$this->db->flush_cache();
		$this->db->select('t_pegawai.id, t_divisi.nama as divisi, t_pegawai.nik, t_pegawai.nama, t_pegawai.alamat, t_pegawai.telephone, t_pegawai.status');
		$this->db->join('t_divisi', 't_pegawai.divisi = t_divisi.id');
		$this->db->order_by('t_pegawai.id asc');
		if($limit > 0){
			if($offset > 0)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);
		}
		return $this->db->get($this->table);
	}
}

/* End of file t_pegawai.php */

