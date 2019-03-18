<div class="row">
<div class="col-md-12">
	<div class="box box-info">

<form id='formID' action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/security/change_password'); ?>" method="post" class="form-horizontal">
		
		<div class="box-body">
		
		<div class="form-group">
		<?php $field = 'current_password'; $alias = format_alias($field); ?>
		
		<label for="input5" class="col-sm-2 control-label"><?php echo $alias; ?></label>
		<div class="col-sm-10">
		<input type="password" class="form-control" name="<?php echo $field; ?>" value="" />
		<?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
		</div>
		</div>

		<div class="form-group">
		<?php $field = 'new_password'; $alias = format_alias($field); ?>
		
		<label for="input5" class="col-sm-2 control-label"><?php echo $alias; ?></label>
		<div class="col-sm-10">
		<input type="password" class="form-control" name="<?php echo $field; ?>" value="" />
		<?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
		</div>	
		</div>

	 	<div class="form-group">	
		<?php $field = 'confirm_password'; $alias = format_alias($field); ?>
		
		<label for="input5" class="col-sm-2 control-label"><?php echo $alias; ?></label>
		<div class="col-sm-10">
		<input type="password" class="form-control" name="<?php echo $field; ?>" value="" />
		<?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
		</div>	
		</div>
		
		</div>

		<div class="box-footer">
                <button type="submit" class="btn btn-warning pull-right">Change Password</button>
        </div>
	
</form>
</div>
</div>

</div>