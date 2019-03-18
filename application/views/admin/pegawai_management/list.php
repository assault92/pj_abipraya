	
<div class="row">
	<div class="col-xs-12">
		 <div class="box">
		 	<div class="box-body">

<button type="button" class="btn btn-warning pull-left" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus"></i> Tambah Data
</button>

</div>
</div>
</div>
</div>	

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            	
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
			<th>Operasi</th>
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
					

					<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/view/' . $item->id); ?>" class="btn btn-primary" onclick="javascript:_view(<?php echo $item->id; ?>, '<?php echo $item->nama; ?>');return false;">
					Lihat Data</a>

					<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/edit/' . $item->id); ?>" class="btn btn-warning" onclick="javascript:_edit(<?php echo $item->id; ?>, '<?php echo $item->nama; ?>');return false;">
					Edit</a>

					<a href="" class="btn btn-danger" onclick="javascript:_delete(<?php echo $item->id; ?>, '<?php echo $item->nama; ?>');return false;">Hapus</a>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
</div>
        </div>
      </div>
</div> 


<!-- Pop Up -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Data Pegawai</h4>
            </div>
           

            <form action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/tambah_data'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

            <div class="box-body">
            <div class="modal-body">
            

            <!-- Isi Data -->
            <div class="form-group">
                <?php $field = 'divisi'; $name = $field; ?>
                  <label>Divisi</label><br/>
                  	<select name="<?php echo $field; ?>" id="divisi" class="form-control select2">
                      
                      <option value="0">--Select Data--</option>
	                      <?php foreach($divisi_respon->result() as $item):?>
							<option value="<?php echo $item->id; ?>"><?php echo $item->nama; ?></option>
						  <?php endforeach; ?>
					</select>

                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

              <div class="form-group">
                <?php $field = 'nik'; $name = $field; ?>
                  <label>NIK</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" placeholder="<?php echo ucwords($name); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

               
               <div class="form-group">
                <?php $field = 'nama'; $name = $field; ?>
                  <label>Nama Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" placeholder="<?php echo ucwords($name); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                 
                </div>

                <div class="form-group">
                <?php $field = 'alamat'; $name = $field; ?>
                  <label>Alamat Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" placeholder="<?php echo ucwords($name); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                 
                </div>

                <div class="form-group">
                <?php $field = 'telephone'; $name = $field; ?>
                  <label>Telephone Pegawai</label>
                 
                    <input type="text" name="<?php echo $field; ?>" class="form-control" placeholder="<?php echo ucwords($name); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

              </div>
              <!-- Isi Data  -->

            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>

            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 <!-- Pop Up -->


<script type="text/javascript">
	var t_init = 0;
	$(function(){
		if(t_init == 0){
			$('#maintable').dataTable(<?php echo $q->num_rows() > 10 ? '{"sPaginationType": "full_numbers"}' : ''; ?>);
			t_init++;
		}
	});


	function _edit(id, title){
		var url = '<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/edit'); ?>/' + id;
		popup(url, 'Edit: ' + title, 500, 600);
		
		return false;
	}

	function _view(id, title){
		var url = '<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/view'); ?>/' + id;
		popup(url, 'Data: ' + title, 500, 600);
		
		return false;
	}
	
	function _delete(id, title){
		var url = '<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/del'); ?>/' + id;
		if(confirm('Are you sure want to delete "' + title + '"?')){
			window.location = url;
		}
		
		return false;
	}
</script>