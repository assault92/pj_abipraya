<form action="" method="post">
	<table>
		<tbody>
			<tr>
				<td class="label">From</td>
				<td><i>me</i></td>
			</tr>
			<tr>
				<?php $field = 'to'; $alias = format_alias($field); ?>
				<td class="label">To</td>
				<td>
					<select name="<?php echo $field; ?>">
					<?php foreach($q->result() as $item): if($item->id != $this->sys_user->user_data()->id): ?>
						<option value="<?php echo $item->id; ?>" <?php echo set_value($field, '') == $item->id ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
					<?php endif; endforeach; ?>
					</select>
					<?php echo form_error($field, '<br/><font color="red">', '</font>'); ?>
				</td>
			</tr>
			<tr>
				<?php $field = 'subject'; $alias = format_alias($field); ?>
				<td class="label"><?php echo $alias; ?></td>
				<td>
					<input class="long-field" type="text" name="<?php echo $field; ?>" value="<?php echo set_value($field, ''); ?>" />
					<?php echo form_error($field, '<br/><font color="red">', '</font>'); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<hr/>
	
	<?php $field = 'content'; $alias = format_alias($field); ?>
	<textarea name="<?php echo $field; ?>"><?php echo set_value($field, ''); ?></textarea>
	<?php echo form_error($field, '<br/><font color="red">', '</font>'); ?>
	
	<br/>
	<input type="submit" value="send!" class="btn" />
</form>