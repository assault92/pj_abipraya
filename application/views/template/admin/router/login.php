
<div id="login-form">
	<div class="form">
		<form action="<?php echo base_url('index.php/router/login?redir=' . $this->input->get('redir')); ?>" method="post">
				<?php $field = 'username_email'; $alias = 'Username / Email'; ?>
				<input type="text" name="<?php echo $field; ?>" placeholder="<?php echo $alias;?>" value="<?php echo set_value($field, ''); ?>" /></li>
				<?php $field = 'password'; $alias = format_alias($field); ?>
				<input type="password" name="<?php echo $field; ?>" placeholder="<?php echo $alias;?>" value="<?php echo set_value($field, ''); ?>" /></li>
				<input type="submit" value="login" class="btn"/></li>
				<div class="text-center" style="color:orange;">
					<?php if(intval($this->input->get('error')) == 1): ?>
						<hr>
						*username/email or password wrong!
					<?php endif; ?>
				</div>
			</ul>
			
			<hr/>
			<!-- <a href="<?php echo base_url('index.php/router/register'); ?>">register</a> 
			<a href="<?php echo base_url('index.php/router/forgot_password'); ?>" style="color:white;">forget password ?</a>
			| -->
		</form>
	</div>
	
</div>