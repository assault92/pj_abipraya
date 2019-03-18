<style>
	#fieldset_menu_editor input[type="submit"]{
		margin-left:0;
	}
	#fieldset_menu_editor ul{
		display:inline-block;
		vertical-align:top;
	}
		#fieldset_menu_editor ul input[type="text"]{
			width:230px;
		}
</style>

<fieldset id="fieldset_menu_editor">
	<legend>Add Menu</legend>
	<form action="<?php echo base_url('index.php/developer/menu_management/add/' . $this->group->name); ?>" method="post">
		<ul style="list-style:none;">
			<?php $field = 'controller'; $alias = $field; ?>
			<li><label><?php echo $alias; ?></label></li>
			<li>
				<select name="<?php echo $field; ?>">
				<?php foreach($$field->result() as $item): ?>
					<option value="<?php echo $item->controller; ?>" <?php echo set_value($field, '') == $item->controller ? 'selected' : ''; ?>><?php echo $item->controller; ?></option>
				<?php endforeach; ?>
				</select>
			</li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
		</ul>
		<ul style="list-style:none;">
			<?php $field = 'alias'; $alias = $field; ?>
			<li><label><?php echo $alias; ?></label></li>
			<li><input type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" /></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
		</ul>
		<br/>
		<input type="submit" value="submit" class="btn" />
	</form>
</fieldset>