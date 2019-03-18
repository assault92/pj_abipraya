<fieldset>
	<legend>add user</legend>
	<form action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/user_management/add'); ?>" method="post">
		<ul style="list-style:none;">
			<?php $field = 'name'; $name = $field; ?>
			<li><label><?php echo $name; ?></label></li>
			<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<?php $field = 'username'; $name = $field; ?>
			<li><label><?php echo $name; ?></label></li>
			<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<?php $field = 'email'; $name = $field; ?>
			<li><label><?php echo $name; ?></label></li>
			<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<?php $field = 'password'; $name = $field; ?>
			<li><label><?php echo $name; ?></label></li>
			<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<?php $field = 'group'; $name = $field; ?>
			<li><label><?php echo $name; ?></label></li>
			<li>
				<select name="<?php echo $field; ?>">
				<?php foreach($$field->result() as $item): ?>
					<option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
				<?php endforeach; ?>
				</select>
			</li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<li><input type="submit" value="submit" class="btn" /></li>
		</ul>
	</form>
</fieldset>