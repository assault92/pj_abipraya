<?php foreach($group->result() as $item): ?>
<a class="btn btn-tab <?php echo $this->group->id == $item->id ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/controller_management/index/' . $item->name); ?>"><?php echo $item->name; ?></a>
<?php endforeach; ?>

<?php //var_dump($this->group); ?>
<hr/>

<a href="<?php echo base_url('index.php/developer/controller_management/add/' . $this->group->name); ?>" class="btn" onclick="javascript:popup('<?php echo base_url('index.php/developer/controller_management/add/' . $this->group->name); ?>', 'add new', 300, 200);return false;">add new</a>
<br/>
<br/>

<table id="maintable">
	<thead>
		<tr>
			<th>id</th>
			<th>controller</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($q->result() as $item): ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->controller; ?></td>
			<td>
				<a href="<?php echo base_url('index.php/developer/controller_management/edit/' . $this->group->name . '/' . $item->id); ?>" class="btn" onclick="javascript:_edit(<?php echo $item->id; ?>, '<?php echo $item->controller; ?>');return false;">edit</a>
				<a href="" class="btn" onclick="javascript:_delete(<?php echo $item->id; ?>, '<?php echo $item->controller; ?>');return false;">delete</a>
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
		var url = '<?php echo base_url('index.php/developer/controller_management/edit/' . $this->group->name); ?>/' + id;
		popup(url, 'edit: ' + title, 400, 200);
		
		return false;
	}
	
	function _delete(id, title){
		var url = '<?php echo base_url('index.php/developer/controller_management/del/' . $this->group->name); ?>/' + id;
		if(confirm('Are you sure want to delete "' + title + '"?')){
			window.location = url;
		}
		
		return false;
	}
</script>