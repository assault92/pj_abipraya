<?php

/* example:
									// alias
$config['user_management'] = array('user management');

									// alias	child
$config['user_management'][] = array('manage', array(
	array('tambah', base_url('index.php/user_management/tambah')),
	array('tambah', base_url('index.php/user_management/tambah')),
));
*/
$config['user_management'] = array('user management', array(
	array('list', base_url('index.php/user_management/list')),
	array('add', base_url('index.php/user_management/add')),
));


$config['nested'] = array('nested test', array(
	array('l2a', '', array(
		array('l3a', ''),
		array('l3b', ''),
	)),
	array('l2b', '', array(
		array('l3a', ''),
		array('l3b', ''),
	)),
));