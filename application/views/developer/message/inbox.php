<a class="btn btn-tab <?php echo $this->router->method == 'index' ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/'); ?>">inbox</a>
<a class="btn btn-tab <?php echo $this->router->method == 'sent' ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/sent'); ?>">sent</a>
<a class="btn btn-tab <?php echo $this->router->method == 'trash' ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/trash'); ?>">trash</a>

<hr/>

<style>
	.unread{
		font-weight:700;
	}
</style>

<?php if($folder == 'inbox'): ?>
<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/compose/'); ?>" onClick="javascript:popup('<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/compose/'); ?>', 'compose new message', 600, 500);return false;" class="btn">new message</a>
<br/>
<br/>
<?php endif; ?>

<br/>
<table id="maintable">
	<thead>
		<tr>
			<th>No</th>
			<th><?php echo $folder == 'inbox' ? 'From' : 'To'; ?></th>
			<th>Subject</th>
			<th>Post Time</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $no = 0; foreach($q->result() as $item): $no++; ?>
		<tr>
			<td><?php echo $no; ?></td>
			<td class="<?php echo intval($item->read) == 0 && $folder == 'inbox' ? 'unread' : ''; ?>"><a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/detail/' . $item->id); ?>" onClick="javascript:read(<?php echo $item->id; ?>);return false;"><?php echo $item->name; ?></a></td>
			<td><?php echo $item->subject; ?></td>
			<td><?php echo format_date($item->post_time); ?></td>
			<td>
				<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/detail/' . $item->id); ?>" class="btn">detail</a>
				<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/delete/' . $item->id); ?>" class="btn">delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<br/>
<br/>

<script type="text/javascript">
	var t_init = 0;
	$(function(){
		if(t_init == 0){
			$('#maintable').dataTable(<?php echo $q->num_rows() > 10 ? '{"sPaginationType": "full_numbers"}' : ''; ?>);
			t_init++;
		}
	});
	
	function read(id){
		var url = '<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/message/detail'); ?>/' + id;
		popup(url, 'Detail Message', 600, 500);
	}
</script>