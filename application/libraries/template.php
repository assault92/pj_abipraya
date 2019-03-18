<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class dom_menu{
	public $alias;
	public $link;
	public $child;
	
	public function __construct($alias, $link = '#'){
		$this->alias = $alias;
		$this->link = $link;
		$this->child = array();
	}
	
	public function add_child($alias, $link = '#'){
		return $this->child[] = new dom_menu($alias, $link);
	}
}

//alias for sidebar
class short_menu extends dom_menu{}

class template{
	private $template_file;
	private $echo;
	
	private $js_link;
	private $js_script;
	
	private $css_link;
	private $css_script;
	
	private $breadcrumb;
	private $sidebar;
	private $notif;
	private $menu;
	
	private $mode;
	
	private $site_title;
	
	private $enable_menu;
	private $enable_breadcrumb;
	private $enable_footer;
	private $enable_sidebar;
	private $enable_print;
	
	public function __construct(){
		get_instance()->load->helper('template');
		$this->template_file = '';
		$this->echo = false;
		$this->js_link = array();
		$this->js_script = array();
		$this->css_link = array();
		$this->css_script = array();
		$this->breadcrumb = array();
		$this->sidebar = '';
		$this->content = array();
		$this->notif = array();
		$this->menu = array();
		$this->mode = 'normal';
		$this->site_title = '';
		$this->enable_menu = true;
		$this->enable_breadcrumb = true;
		$this->enable_footer = true;
		$this->enable_sidebar = true;
		$this->enable_print = false;
	}
	
	public function set_title($title){
		$this->site_title = ucfirst($title);
	}
	
	public function append_title($str){
		$this->site_title .= ' - ' . ucfirst($str);
	}
	
	public function enable_menu($enable = true){
		$this->enable_menu = $enable;
	}
	
	public function enable_breadcrumb($enable = true){
		$this->enable_breadcrumb = $enable;
	}
	
	public function enable_footer($enable = true){
		$this->enable_footer = $enable;
	}
	
	public function enable_sidebar($enable = true){
		$this->enable_sidebar = $enable;
	}
	
	public function enable_print($enable = true){
		$this->enable_print = $enable;
	}
	
	
	public function set_mode($mode){
		$this->mode = $mode;
	}
	
	
	public function set_template($template_file){
		$this->template_file = $template_file;
	}
	
	public function enable_echo($echo = true){
		$this->echo = $echo;
	}
	
	public function add_breadcrumb($alias, $link = '#'){
		$alias = str_replace('_', ' ', $alias);
		$alias = ucwords($alias);
		
		$this->breadcrumb[] = array(
			$alias, $link
		);
	}
	
	public function add_sidebar($view, $data = array()){
		$this->sidebar .= get_instance()->load->view($view, $data, true);
	}
	
	public function add_content_view($view, $data = null, $title = ''){
		if(is_string($data))
			$title = $data;
		$this->content[] = array(
			$title, get_instance()->load->view($view, $data, true)
		);
	}
	
	// backward compatibility
	public function set_content($content, $title = ''){
		$this->add_content($content, $title);
	}
	
	public function add_content($content, $title = ''){
		$this->content[] = array(
			$title, $content
		);
	}
	
	
	public function add_menu($alias, $link = '#'){
		return $this->menu[] = new dom_menu($alias, $link);
	}
	
	
	public function add_notif($notif){
		$this->notif[] = $notif;
	}
	
	
	public function add_js($js){
		if(is_url($js)){
			$this->js_link[] = $js;
		}else{
			$this->js_script[] = $js;
		}
	}
	
	public function add_css($css){
		if(is_url($css)){
			$this->css_link[] = $css;
		}else{
			$this->css_script[] = $css;
		}
	}
	
	
	public function render($mode = null){
		if($mode != null)
			$this->mode = $mode;
		$data = array(
			'js_link' => $this->js_link,
			'js_script' => $this->js_script,
			'css_link' => $this->css_link,
			'css_script' => $this->css_script,
			'breadcrumb' => $this->breadcrumb,
			'sidebar' => $this->sidebar,
			'content' => $this->content,
			'notif' => $this->notif,
			'menu' => $this->menu,
			
			'site_title' => $this->site_title,
			
			'enable_menu' => $this->enable_menu,
			'enable_breadcrumb' => $this->enable_breadcrumb,
			'enable_footer' => $this->enable_footer,
			'enable_sidebar' => $this->enable_sidebar && strlen($this->sidebar) > 0 ? true : false,
			'enable_print' => $this->enable_print,
		);
		switch(strtolower($this->mode)){
			case 'api':
				$this->_render_api($data);
				break;
			default:
				$this->_render($data);
				break;
		}
	}
	
	private function _render($data){
		if(get_instance()->input->is_ajax_request()){
			echo !empty($this->content[0][1]) ? $this->content[0][1] : $this->content[0][1];
		}else{
			$output = get_instance()->load->view($this->template_file, $data, $this->echo);
			
			if($this->echo){
				echo $output;
			}else{
				return $output;
			}
		}
	}
	
	private function _render_api($data){
		$output = json_encode($data);
		get_instance()->output->set_content_type('text/plain');
		echo $output;
	}
}

if(!function_exists('format_alias')){
	function format_alias($str){
		$str = str_replace('_', ' ', $str);
		$str = ucwords($str);
		return $str;
	}
}

if(!function_exists('format_date')){
	function format_date($date, $only_data = false){
		$date = strtotime($date);
		list($Y, $m, $d) = explode('-', date('Y-m-d'));
		list($Y1, $m1, $d1) = explode('-', date('Y-m-d', $date));
		
		if($Y == $Y1 && $m == $m1 && $d == $d1){
			return 'Today' . ($only_data ? '' : date(', h:ia', $date));
		}
		
		if($Y == $Y1 && $m == $m1){
			return $only_data ? date('l dS', $date) : date('l dS, h:ia', $date);
		}
		
		if($Y == $Y1){
			return $only_data ? date('dS F', $date) : date('dS F, ha', $date);
		}
		
		return date('d F, Y', $date);
	}
}


if(!function_exists('sanitize')){
	setlocale(LC_ALL, 'en_US.UTF8');
	function sanitize($str, $replace=array(), $delimiter='-') {
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}
}


if(!function_exists('format_size')){
	function format_size($size) {
		$unit = 'B';
		
		if($size > (1024 * 1024 * 1024)){
			$size = $size / (1024 * 1024 * 1024);
			$unit = 'GB';
		}
		
		if($size > (1024 * 1024)){
			$size = $size / (1024 * 1024);
			$unit = 'MB';
		}
		
		if($size > (1024)){
			$size = $size / (1024);
			$unit = 'KB';
		}
		
		return number_format($size, 2, '.', ',') . ' ' . $unit;
	}
}

/* End of file template.php */