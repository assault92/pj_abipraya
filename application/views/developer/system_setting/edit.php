<fieldset>
	<legend>edit setting: <?php echo $data->key; ?></legend>
	<form action="<?php echo base_url('index.php/developer/system_setting/edit/' . $data->id); ?>" method="post">
		<ul style="list-style:none;">
		
		<?php if($data->type == 'boolean'): ?>
			<?php $field = 'value'; $alias = $field; ?>
			<li>
				<label><?php echo $alias; ?></label>
				
				<select name="<?php echo $field; ?>">
					<option value="1" <?php echo set_value($field, $data->$field) == '1' ? 'selected' : ''; ?>>true</option>
					<option value="0" <?php echo set_value($field, $data->$field) == '0' ? 'selected' : ''; ?>>false</option>
				</select>
				
				<input type="submit" value="submit" class="btn" />
			</li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
		<?php else: ?>
			<?php $field = 'value'; $alias = $field; ?>
			<li><label><?php echo $alias; ?></label></li>
			<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, $data->$field); ?>" /></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<li><input type="submit" value="submit" class="btn" /></li>
		<?php endif; ?>
		</ul>
	</form>
</fieldset>