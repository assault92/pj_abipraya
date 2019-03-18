<a class="btn btn-tab <?php echo $this->router->method == 'index' ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database'); ?>">backup</a>
<a class="btn btn-tab <?php echo $this->router->method == 'restore' ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database/restore'); ?>">restore</a>
<a class="btn btn-tab <?php echo $this->router->method == 'reset' ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database/reset'); ?>">reset</a>

<hr/>