<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sys_setting extends MY_Model {
	private $cache;
	
	public function __construct(){
		parent::__construct('sys_setting');
		
		$this->reload_value();
	}
	
	public function reload_value(){
		$this->cache = array();
		foreach($this->select_all()->result() as $item){
			$this->cache[$item->key] = $item;
		}
	}
	
	public function value($key){
		$item = $this->cache[$key];
		
		if($item->type == 'boolean')
			return (bool) $item->value;
			
		if($item->type == 'numeric')
			return (int) $item->value;
		
		return $item->value;
	}
	
	public function val($key){
		return $this->value($key);
	}
	
}

/* End of file sys_setting.php */