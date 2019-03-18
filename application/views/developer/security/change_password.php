<div class="row">
	<div class="col-md-12">
	<form action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/security/change_password'); ?>" method="post">
			<?php $field = 'current_password'; $alias = format_alias($field); ?>
			<label><?php echo $alias; ?></label>
			<input type="password" name="<?php echo $field; ?>" class="form-control" value="" />
			<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
			<br>
			<?php $field = 'new_password'; $alias = format_alias($field); ?>
			<label><?php echo $alias; ?></label>
			<input type="password" name="<?php echo $field; ?>" class="form-control" value="" />
			<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
			<br>
			<?php $field = 'confirm_password'; $alias = format_alias($field); ?>
			<label><?php echo $alias; ?></label>
			<input type="password" name="<?php echo $field; ?>" class="form-control" value="" />
			<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
			<br>
				<input type="submit" value="Change Password" class="btn btn-primary" />
			
	</form>
	</div>
</div>