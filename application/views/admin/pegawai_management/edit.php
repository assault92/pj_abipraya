<div class="row">
        <div class="col-xs-12">
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
	<hr>
		<form action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/pegawai_management/edit/' . $data->id); ?>" method="post">

			<div class="form-group">
            
            <div class="form-group">
				<?php $field = 'divisi'; $alias = $field; ?>
				<label>Divisi</label>
					<select name="<?php echo $field; ?>" class="form-control select2">
					<?php foreach($$field->result() as $item): ?>
						<option value="<?php echo $item->id; ?>" <?php echo set_value($field, $data->$field == $item->id ? 'selected' : ''); ?>><?php echo $item->nama; ?></option>
					<?php endforeach; ?>
					</select>
				<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
			</div>

              <div class="form-group">
                <?php $field = 'nik'; $name = $field; ?>
                  <label>NIK</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

               
               <div class="form-group">
                <?php $field = 'nama'; $name = $field; ?>
                  <label>Nama Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

                <div class="form-group">
                <?php $field = 'alamat'; $name = $field; ?>
                  <label>Alamat Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

                <div class="form-group">
                <?php $field = 'telephone'; $name = $field; ?>
                  <label>Telephone Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1">
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>
			
		<input type="submit" value="Update" class="btn btn-primary" style="width:100%;" />
		</form>
		</div>
        </div>
      </div>
</div>  