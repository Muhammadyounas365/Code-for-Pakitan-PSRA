  
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
        <li><a href="<?php echo base_url('admin/user');?>"><?php echo @$title; ?></a></li>
        <li><a href="#">Create <?php echo @$title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">create new <?php echo @$title; ?>s form</h3>

          <!-- <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> -->
        </div>
        <div class="box-body">
          <div class="row">
            <?php echo validation_errors(); ?>
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/user/create');?>">
                    <div class="box-body">
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
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" value="<?php echo set_value('email');?>" id="inputEmail3" placeholder="Email">
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