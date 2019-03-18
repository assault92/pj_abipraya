<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class theme_roller extends ADMIN_Controller {
	public $themes;

	public function __construct(){
		parent::__construct();
		$this->template->add_breadcrumb('theme roller', base_url('index.php/' . $this->sys_user->user_data()->group_name . '/theme_roller'));
		
		$this->themes[] = array('theme-firenze', '#408271', '#FFE8A3', '#E6B82E', '#A34121', '#822100');
		$this->themes[] = array('theme-business-casual', '#133463', '#365FB7', '#799AE0', '#F4EFDC', '#BA9B65');
		$this->themes[] = array('theme-fresh-money', '#2F400D', '#8CBF26', '#A8CA65', '#E8E5B0', '#419184');
		$this->themes[] = array('theme-sandy-stone', '#E6E2AF', '#A7A37E', '#EFECCA', '#046380', '#002F2F');
		$this->themes[] = array('theme-modern-office', '#14212B', '#293845', '#4F6373', '#8F8164', '#D9D7AC');
		$this->themes[] = array('theme-japanese-garden', '#D8CAA8', '#5C832F', '#284907', '#382513', '#363942');
		$this->themes[] = array('theme-zen-and-tea', '#10222B', '#95AB63', '#BDD684', '#E2F0D6', '#F6FFE0');
		$this->themes[] = array('theme-pistachio', '#B0CC99', '#677E52', '#B7CA79', '#F6E8B1', '#89725B');
		$this->themes[] = array('theme-first-impression', '#FFF0A3', '#B8CC6E', '#4B6000', '#E4F8FF', '#004460');
		$this->themes[] = array('theme-jhonny-cash', '#878271', '#2E302E', '#1D2120', '#141414', '#191C1B');
	}
	
	public function index(){
		$this->template->add_breadcrumb('chooser');
		$this->template->add_content_view($this->sys_user->user_data()->group_name . '/theme_roller/chooser');
		$this->template->render();
	}
	
	public function choose(){
		$this->sys_setting->update(4, array(
			'value' => $this->input->post('theme'),
		));
		
		$notif = 'theme updated to "' . ucwords(str_replace('theme ', '', str_replace('-', ' ', $this->input->post('theme')))) . '"!';
		redirect(base_url('index.php/' . $this->sys_user->user_data()->group_name . '/theme_roller?notif=' . $notif));
	}
}

/* End of file theme_roller.php */