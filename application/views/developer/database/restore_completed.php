<?php echo $this->load->view($this->sys_user->user_data()->group_name . '/database/menu', null, true); ?>

<p>
	<strong>Restore database completed!</strong> please re-login.<br/>
	<br/>
	<a href="<?php echo base_url('index.php/router/login'); ?>" class="btn">go to login</a>
</p>