<div class="row">
        <div class="col-xs-12">
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
	<hr>
		<form action="" method="post">

			<div class="form-group">
            
            <div class="form-group">
				<?php $field = 'divisi'; $alias = $field; ?>
				<label>Divisi</label>
					<select name="<?php echo $field; ?>" class="form-control select2">
					<?php foreach($$field->result() as $item): ?>
						<option value="<?php echo $item->id; ?>" disabled <?php echo set_value($field, $data->$field == $item->id ? 'selected' : ''); ?>><?php echo $item->nama; ?></option>
					<?php endforeach; ?>
					</select>
				<?php echo form_error($field, '<font style="color:red;">', '</font>'); ?>
			</div>

              <div class="form-group">
                <?php $field = 'nik'; $name = $field; ?>
                  <label>NIK</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1" disabled>
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

               
               <div class="form-group">
                <?php $field = 'nama'; $name = $field; ?>
                  <label>Nama Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1" disabled>
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

                <div class="form-group">
                <?php $field = 'alamat'; $name = $field; ?>
                  <label>Alamat Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1" disabled>
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>

                <div class="form-group">
                <?php $field = 'telephone'; $name = $field; ?>
                  <label>Telephone Pegawai</label>
                  
                    <input type="text" name="<?php echo $field; ?>" class="form-control" value="<?php echo set_value($field, $data->$field); ?>" id="input1" disabled>
                    <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                  
                </div>
			
		
		</form>
		</div>
        </div>
      </div>
</div>  