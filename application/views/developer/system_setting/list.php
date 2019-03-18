<span>Current Version: <strong><?php echo MY_Controller::VERSION; ?></strong></span>
<br/>
<br/>
<br/>

<table id="maintable">
	<thead>
		<tr>
			<th>id</th>
			<th>key</th>
			<th>value</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($q->result() as $item): ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->key; ?></td>
			<td><?php echo $item->type != 'boolean' ? $item->value : ($item->value == 1 ? 'true' : 'false'); ?></td>
			<td>
				<a href="<?php echo base_url('index.php/developer/system_setting/edit/' . $item->id); ?>" class="btn" onclick="javascript:_edit(<?php echo $item->id; ?>, '<?php echo $item->key; ?>');return false;">edit</a>
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
	
	function _edit(id, title){
		var url = '<?php echo base_url('index.php/developer/system_setting/edit'); ?>/' + id;
		popup(url, 'edit: ' + title, 300, 200);
		
		return false;
	}
</script>