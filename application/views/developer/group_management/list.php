<a href="<?php echo base_url('index.php/developer/group_management/add'); ?>" class="btn" onclick="javascript:popup('<?php echo base_url('index.php/developer/group_management/add'); ?>', 'add new', 300, 200);return false;">add new</a>
<br/>
<br/>

<table id="maintable">
	<thead>
		<tr>
			<th>id</th>
			<th>name</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($q->result() as $item): ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->name; ?></td>
			<td class="action">
				<a href="<?php echo base_url('index.php/developer/group_management/edit/' . $item->id); ?>" class="btn" onclick="javascript:_edit(<?php echo $item->id; ?>, '<?php echo $item->name; ?>');return false;">edit</a>
				<a href="" class="btn" onclick="javascript:_delete(<?php echo $item->id; ?>, '<?php echo $item->name; ?>');return false;">delete</a>
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
		var url = '<?php echo base_url('index.php/developer/group_management/edit'); ?>/' + id;
		popup(url, 'edit: ' + title, 300, 200);
		
		return false;
	}
	
	function _delete(id, title){
		var url = '<?php echo base_url('index.php/developer/group_management/del'); ?>/' + id;
		if(confirm('Are you sure want to delete "' + title + '"?')){
			window.location = url;
		}
		
		return false;
	}
</script>