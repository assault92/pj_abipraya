 <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('admin/lte/dist/img/user2-160x160.jpg'); ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo ucwords($data->name); ?></h3>

              <p class="text-muted text-center">Username : <?php echo $data->username; ?></p>

            </div>
            <!-- /.box-body -->
          </div>
         
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              
              <div class="active tab-pane" id="settings">
                
                <form class="form-horizontal" action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/profile/update'); ?>" method="post">

                  <div class="form-group">
                  	<?php $field = 'name'; $alias = format_alias($field); ?>
                    <label for="inputName" class="col-sm-2 control-label">User ID</label>

                    <div class="col-sm-10">
                      <input type="text" name="name_text" class="form-control" id="inputName" placeholder="<?php echo $field; ?>" value="<?php echo set_value($field, $data->$field); ?>" disabled/>

                      <input type="hidden" name="<?php echo $field; ?>" class="form-control" id="inputName" placeholder="<?php echo $field; ?>" value="<?php echo set_value($field, $data->$field); ?>" />
                      <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <?php $field = 'username'; $alias = format_alias($field); ?>
                    <label for="inputName" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input type="text" name="<?php echo $field; ?>" class="form-control" id="inputName" placeholder="<?php echo $field; ?>" value="<?php echo set_value($field, $data->$field); ?>" />
                      <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                  	<?php $field = 'email'; $alias = format_alias($field); ?>
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" name="<?php echo $field; ?>" class="form-control" id="inputEmail" placeholder="<?php echo $field; ?>" value="<?php echo set_value($field, $data->$field); ?>" />
                      <?php echo form_error($field, '<p><b><font style="color:red;">', '</font></b></p>'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                   <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                  </div>
                </form>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->