<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class backup_restore{
	
	public function __construct(){
		
	}
	
	public function import($file, $delimiter = ';'){
		//echo file_get_contents($file);return;
		set_time_limit(0);
		$matches = array();
		$otherDelimiter = false;
		if (is_file($file) === true) {
			$file = fopen($file, 'r');
			if (is_resource($file) === true) {
				$query = array();
				while (feof($file) === false) {
					$query[] = fgets($file);
					if (preg_match('~' . preg_quote('delimiter', '~') . '\s*([^\s]+)$~iS', end($query), $matches) === 1){
						//DELIMITER DIRECTIVE DETECTED
						array_pop($query); //WE DON'T NEED THIS LINE IN SQL QUERY
						if( $otherDelimiter = ( $matches[1] != $delimiter )){
						}else{
							//THIS IS THE DEFAULT DELIMITER, DELETE THE LINE BEFORE THE LAST (THAT SHOULD BE THE NOT DEFAULT DELIMITER) AND WE SHOULD CLOSE THE STATEMENT                                
							array_pop($query);
							$query[]=$delimiter;
						}
					}
					if ( !$otherDelimiter && preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1) {                            
						$query = trim(implode('', $query));
						get_instance()->db->query($query);
						
						while (ob_get_level() > 0){
							ob_end_flush();
						}
						flush();
					}
					if (is_string($query) === true) {
						$query = array();
					}
				}
				return fclose($file);
			}
		}
		return false;
	}
}

/* End of file backup_restore.php */