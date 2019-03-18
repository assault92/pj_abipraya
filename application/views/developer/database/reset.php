<?php echo $this->load->view($this->sys_user->user_data()->group_name . '/database/menu', null, true); ?>

<p>
	Are you sure want to reset database?
	<br/>
	<br/>
	<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database/reset?confirm=1'); ?>" class="btn">reset</a>
</p>