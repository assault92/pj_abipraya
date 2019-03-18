<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pegawai_management extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('Pegawai Management', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management'));
		
		$this->load->model('t_pegawai');
		$this->load->model('t_divisi');
	}
	
	public function index(){
		$this->template->add_content_view('' . $this->sys_user->user_data()->group_name . '/pegawai_management/list', array(
			'q' => $this->t_pegawai->select_pegawai_public(0, 0),
			'divisi_respon' => $this->t_divisi->select_divisi_public(0, 0),
		), 'Pegawai List');
		$this->template->render();
	}
	
	public function tambah_data(){
		$notif = '';
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('divisi', 'divisi', 'trim|xss_clean|required');
		$this->form_validation->set_rules('nik', 'nik', 'trim|xss_clean|required');
		$this->form_validation->set_rules('nama', 'nama', 'trim|xss_clean|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|xss_clean|required');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');
		
		if($this->form_validation->run() === true){
			$pegawai_id = $this->t_pegawai->insert(array(
				'divisi' => $this->input->post('divisi'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'telephone' => $this->input->post('telephone'),
				'status' => '1',
				'user' => $this->sys_user->user_data()->id,
				'date' => 'NOW()',
			));
			
			$nama = $this->input->post('nama');
			$notif = 'Pegawai ' . $nama . ' added to database!';

			redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management'. $this->group->name . '?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('add new');
		$this->template->add_content_view('' . $this->sys_user->user_data()->group_name . '/pegawai_management/add', array(
			'q' => $this->t_pegawai->select_pegawai_public(0, 0),
			'divisi_respon' => $this->t_divisi->select_divisi_public(0, 0),
		), 'add Pegawai');
		$this->template->render();
	}
	
	public function edit(){
		$notif = '';
		$id = intval($this->uri->segment(4));
		$data = $this->t_pegawai->get($id);
		
		if(!is_object($data)){
			echo 'id not found!';
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('divisi', 'divisi', 'trim|xss_clean|required');
		$this->form_validation->set_rules('nik', 'nik', 'trim|xss_clean|required');
		$this->form_validation->set_rules('nama', 'nama', 'trim|xss_clean|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|xss_clean|required');
		$this->form_validation->set_rules('telephone', 'telephone', 'trim|xss_clean|required');

		if($this->form_validation->run() === true){
			$this->t_pegawai->update($id, array(
				'divisi' => $this->input->post('divisi'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'telephone' => $this->input->post('telephone'),
				'status' => '1',
				'user' => $this->sys_user->user_data()->id,
				'date' => 'NOW()',
			));
			
			$nama = $this->input->post('nama');
			$notif = 'Data Pegawai ' . $nama . ' update !';

			redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management'. $this->group->name . '?notif=' . $notif));
			return;
		}
		
		$this->template->add_breadcrumb('edit');
		$this->template->add_breadcrumb($data->nik);
		$this->template->add_content_view('' . $this->sys_user->user_data()->group_name . '/pegawai_management/edit', array(
			'data' => $data,
			'divisi' =>  $this->t_divisi->select_divisi_public(0, 0),
		), 'Edit: ' . $data->nik);
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
		
		$this->template->add_breadcrumb('edit');
		$this->template->add_breadcrumb($data->nik);
		$this->template->add_content_view('' . $this->sys_user->user_data()->group_name . '/pegawai_management/view', array(
			'data' => $data,
			'divisi' =>  $this->t_divisi->select_divisi_public(0, 0),
		), 'Edit: ' . $data->nik);
		$this->template->render();
	}
	
	public function del(){
		$notif = '';
		
		$id = intval($this->uri->segment(4));
		$data = $this->t_pegawai->get($id);
		
		if(is_object($data)){
			$this->t_pegawai->delete($id);
			$notif = 'Data ' . $data->nama . ' deleted!';
		}else{
			$notif = 'error on deleting Pegawai ' . $data->nama;
		}
		
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/?warning=' . $notif));
	}
}

/* End of file pegawai_management.php */