
<div class="row">
	
	<div class="col-md-3">
		<img src="<?php echo base_url('admin/images/avatar.png'); ?>" class="user-image" alt="User Image">
	</div>
	
	<div class="col-md-9">
		<form action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/profile/update'); ?>" method="post">
				<?php $field = 'name'; $alias = format_alias($field); ?>
				<label><?php echo $alias; ?></label>
				<input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" />
				<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
				<br>
				<?php $field = 'username'; $alias = format_alias($field); ?>
				<label><?php echo $alias; ?></label>
				<input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" />
				<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
				<br>
				<?php $field = 'email'; $alias = format_alias($field); ?>
				<label><?php echo $alias; ?></label>
				<input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" />
				<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
				
				<br>
					<input type="submit" value="Update" class="btn btn-primary" />
				
		</form>
	</div>
	
</div>