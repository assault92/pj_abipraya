<table>
	<tbody>
		<tr>
			<td class="label">From</td>
			<td><?php echo $data->from == $this->sys_user->user_data()->id ? '<i>me</i>' : $data->from_name . ' &lt;<i>' . $data->from_email . '</i>&gt;'; ?></td>
		</tr>
		<tr>
			<td class="label">To</td>
			<td><?php echo $data->to == $this->sys_user->user_data()->id ? '<i>me</i>' : $data->to_name . ' &lt;<i>' . $data->to_email . '</i>&gt;'; ?></td>
		</tr>
		<tr>
			<td class="label">Subject</td>
			<td><?php echo $data->subject; ?></td>
		</tr>
		<tr>
			<td class="label">Post time</td>
			<td><?php echo format_date($data->post_time); ?></td>
		</tr>
	</tbody>
</table>
<hr/>

<?php echo $data->content; ?>

<style>
	input.subject{
		width:400px;
	}
</style>
<?php if($data->to == $this->sys_user->user_data()->id && intval($data->trash) == 0): ?>
	<form action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/reply/' . $data->id); ?>" method="post">
		<hr/>
		<ul>
			<?php $field = 'subject'; $name = $field; ?>
			<li><label><?php echo $name; ?></label></li>
			<li><input type="text" class="subject" name="<?php echo $field; ?>" value="<?php echo set_value($field, 're:' . $data->$field); ?>" /></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<?php $field = 'content'; $alias = format_alias($field); ?>
			<li><label><?php echo $alias; ?></label></li>
			<li><textarea class="medium" name="<?php echo $field; ?>"><?php echo set_value($field, ''); ?></textarea></li>
			<?php echo form_error($field, '<li><font style="color:red;">', '</font></li>'); ?>
			
			<li><input type="submit" value="send" class="btn"/></li>
		</ul>
	</form>
<?php else: ?>
	<br/>
	<br/>
<?php endif; ?>