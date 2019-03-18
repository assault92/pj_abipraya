<div id="login-form">
	<form action="<?php echo base_url('index.php/router/forgot_password'); ?>" method="post">
		<ul>
			
			<?php $field = 'email'; $alias = format_alias($field); ?>
			<li><label><?php echo $alias; ?></label></li>
			<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
			<?php echo form_error($field, '<li style="color:red;">', '</li>'); ?>
			
			<li><input type="submit" value="recovery" class="btn"/></li>
		</ul>
	</form>
</div>