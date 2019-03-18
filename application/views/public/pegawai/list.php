<div class="row">
<div class="col-md-8 col-md-offset-2">
	
<div class="box-body table-responsive no-padding">
<table class="table table-hover" id="maintable">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Divisi</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telephone</th>
			<th>Detail</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 0;
			foreach($q->result() as $item): 
			$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $item->divisi; ?></td>
			<td><?php echo $item->nik; ?></td>
			<td><?php echo $item->nama; ?></td>
			<td><?php echo $item->alamat; ?></td>
			<td><?php echo $item->telephone; ?></td>
			<td>
				<div class="btn-group">
				<a href="<?php echo base_url('index.php/public/pegawai/view/' . $item->id); ?>" class="btn btn-primary" onclick="javascript:_view(<?php echo $item->id; ?>, '<?php echo $item->nama; ?>');return false;">
					Lihat Data</a>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

</div><!-- end col-12 -->
</div><!-- end col-12 -->
</div>
	

<script type="text/javascript">
	var t_init = 0;
	$(function(){
		if(t_init == 0){
			$('#maintable').dataTable(<?php echo $q->num_rows() > 10 ? '{"sPaginationType": "full_numbers"}' : ''; ?>);
			t_init++;
		}
	});

	function _view(id, title){
		var url = '<?php echo base_url('index.php/public/pegawai/view'); ?>/' + id;
		popup(url);
		
		return false;
	}
	
</script>