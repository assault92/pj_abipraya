			<div id="login-form">
				<form action="<?php echo base_url('index.php/router/register'); ?>" method="post">
					<ul>
						
						<?php $field = 'name'; $alias = format_alias($field); ?>
						<li><label><?php echo $alias; ?></label></li>
						<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
						<?php echo form_error($field, '<li class="error">', '</li>'); ?>
						
						<?php $field = 'email'; $alias = format_alias($field); ?>
						<li><label><?php echo $alias; ?></label></li>
						<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
						<?php echo form_error($field, '<li class="error">', '</li>'); ?>
						
						<?php $field = 'username'; $alias = format_alias($field); ?>
						<li><label><?php echo $alias; ?></label></li>
						<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
						<?php echo form_error($field, '<li class="error">', '</li>'); ?>
						
						<?php $field = 'password'; $alias = format_alias($field); ?>
						<li><label><?php echo $alias; ?></label></li>
						<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
						<?php echo form_error($field, '<li class="error">', '</li>'); ?>
						
						<?php $field = 'confirm_password'; $alias = format_alias($field); ?>
						<li><label><?php echo $alias; ?></label></li>
						<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
						<?php echo form_error($field, '<li class="error">', '</li>'); ?>
						
						<li><input type="submit" value="register" class="btn"/></li>
					</ul>
				</form>
			</div>