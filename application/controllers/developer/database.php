<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class database extends ADMIN_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->template->add_breadcrumb('database', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database'));
		
		$this->load->helper('directory');
		$this->load->helper('file');
	}
	
	public function index(){
		if(intval($this->input->get('confirm')) == 1){
			$this->load->dbutil();
			$backup =& $this->dbutil->backup(array(
				'format' => 'txt',
			));
			
			$this->load->helper('file');
			$sql_no_check = <<<SQL
			
SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+07:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';\n\n

SQL;
			$backup_file = date('Y-m-d h-i A') . '.sql';
			write_file('./uploads/database/' . $backup_file, $sql_no_check . $backup);
			$this->template->add_notif('new backup created - ' . $backup_file);
		}
		
		$this->template->add_breadcrumb('backup');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/database/backup', array(
			'lists' => directory_map('./uploads/database'),
		));
		$this->template->render();
	}
	
	public function backup_delete(){
		$file = $this->security->sanitize_filename($this->input->get('file'));
		$path = './uploads/database/' . $file;
		
		if(!file_exists($path)){
			echo 'backup file not exists!';
			return;
		}
		
		@unlink($path);
		
		$notif = 'backup file "' . $file . '" deleted!';
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database/?notif=' . $notif));
	}
	
	public function restore(){
		if($this->input->get('file') != false){
			$file = $this->security->sanitize_filename($this->input->get('file'));
			$path = './uploads/database/' . $file;
			
			if($file == 'costum_upload'){
				
				$config['upload_path'] = './uploads/tmp/';
				$config['allowed_types'] = 'sql';
				$config['overwrite'] = true;
				$config['max_size']	= (string) 1024 * 5; // 5mb

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('upload')){
					
					$this->template->add_notif($this->upload->display_errors());
					
				}else{
					
					$upload = $this->upload->data();
					$path = $config['upload_path'] . $upload['file_name'];
					
					$this->load->library('backup_restore');
					$this->backup_restore->import($path);
					@unlink($path);
					
					$this->template->add_content_view($this->sys_user->user_data()->group_name . '/database/restore_completed', array(
						
					));
					$this->template->render();
					
				}
				
			}else if(!file_exists($path)){
				
				echo 'backup file not exists!';
				return;
				
			}else{
				$this->load->library('backup_restore');
				$this->backup_restore->import($path);
				$this->template->add_content_view($this->sys_user->user_data()->group_name . '/database/restore_completed', array(
					
				));
				$this->template->render();
				return;
			}
		}
		
		$this->template->add_breadcrumb('restore');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/database/restore', array(
			'lists' => directory_map('./uploads/database'),
		));
		$this->template->render();
	}
	
	
	public function reset(){
		$this->template->add_breadcrumb('reset');
		
		if(intval($this->input->get('confirm')) == 1){
			$this->load->library('backup_restore');
			$this->backup_restore->import('../database/database.sql');
			$this->template->add_content_view($this->sys_user->user_data()->group_name . '/database/reset_confirm', array(
				
			));
		}else{
			$this->template->add_content_view($this->sys_user->user_data()->group_name . '/database/reset', array(
				
			));
		}
		$this->template->render();
	}	
}

/* End of file database.php */