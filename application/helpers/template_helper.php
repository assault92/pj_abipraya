<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('is_url')){
	function is_url($url){
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}
}

if(!function_exists('build_url')){
	function build_url($path, $query_string = array(), $continue = false){
		if($continue == false){
			return base_url($path) . '?' . http_build_query((array) $query_string);
		}else{
			return base_url($path) . '?' . http_build_query(array_merge($_GET, (array) $query_string));
		}
	}
}

/* End of file template_helper.php */