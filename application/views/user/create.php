
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2 style="display:inline;">
        <?php echo @$title; ?>
      </h2>
      <small><?php echo @$description; ?></small>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('user');?>"><?php echo @$title; ?></a></li>
        <li><a href="#">Create <?php echo @$title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">create new <?php echo @$title; ?>s form</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php echo validation_errors(); ?>
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('user/create');?>">
                    <div class="box-body">
                      <div class="form-group">


                      <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" name="role_id" id="role_id">
                            <option>Select Role</option>
                            <?php foreach($roles as $role): ?>
                                <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_title; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="district" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" name="district" id="district">
                            <option>Select District</option>
                            <?php foreach($districts as $district): ?>
                                <option value="<?php echo $district->districtId; ?>"><?php echo $district->districtTitle; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="address" value="<?php echo set_value('address');?>" id="address" placeholder="Address">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" id="name" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">User-name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="username" value="<?php echo set_value('username');?>" id="username" placeholder="User-name">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="passwordconf" class="col-sm-2 control-label" style="margin-top:-10px;">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="passwordconf" name="passconf" placeholder="Password">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="contactNumber" class="col-sm-2 control-label">Contact Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="contactNumber" value="<?php echo set_value('email');?>" id="contactNumber" placeholder="Contact Number" data-inputmask='"mask": "0399-9999999"' data-mask>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" value="<?php echo set_value('email');?>" id="inputEmail3" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="cnic" value="<?php echo set_value('cnic');?>" id="cnic" placeholder="CNIC" data-inputmask='"mask": "99999-9999999-9"' data-mask>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="gender" id="gender">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>                           
                          </select>
                        </div>
                      </div>

                      <!-- radio for status -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">User status</label>
                        <div class="col-sm-10">
                        <label>
                          <input type="radio" name="status" value="1" class="flat-red" checked> Active
                        </label>
                        <br>
                        <label>
                          <input type="radio" name="status" value="0" class="flat-red"> In-Active
                        </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="img" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                          <input type="file" name="file" id="img">
                          <p class="help-block">Profile picture is optional if not provided, the default avator will be set.</p>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-offset-2 col-sm-offset-2">
                              <button type="submit"  style="margin-left:15px;"  class="btn btn-primary btn-flat">Add new user</button>
                          </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <!-- Footer -->
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
               $('[data-mask]').inputmask();
           });    
</script>       
