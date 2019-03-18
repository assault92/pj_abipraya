<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pegawai extends PUBLIC_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('pegawai', base_url('index.php/public/pegawai'));

		$this->load->model('t_pegawai');
		$this->load->model('t_divisi');
	}

	public function index(){
		$this->template->add_content_view('public/pegawai/list', array(
			'q' => $this->t_pegawai->select_pegawai_public(0, 0),
			'divisi_respon' => $this->t_divisi->select_divisi_public(0, 0),
		), '');
		$this->template->render();
	}

	public function view(){
		$notif = '';
		$id = intval($this->uri->segment(4));
		$data = $this->t_pegawai->get($id);
		
		if(!is_object($data)){
			echo 'id not found!';
			return;
		}
		
		$this->template->add_content_view('public/pegawai/view', array(
			'data' => $data,
			'divisi' => $this->t_divisi->select_divisi_public(0, 0),
		), 'View: ' . $data->nik);
		$this->template->render();
	}
	
}

/* End of file pegawai.php */