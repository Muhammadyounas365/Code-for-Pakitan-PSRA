
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2 style="display:inline;">
      <?php echo @ucfirst($title); ?>
    </h2>
    <small><?php echo @$description; ?></small>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('module');?>"><?php echo @$title; ?></a></li>
      <li><a href="#">Create <?php echo @$title; ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Create New <?php echo @ucfirst($title); ?></h3>
      </div>
      <div class="box-body">
        <div class="row">
              <div class="col-md-offset-1 col-md-9">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('complain_type/create_process').'/'.$complainTypes->complainTypeId;?>">
                  <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d:m:Y h:i:sa");?>
                  <input type="hidden" name="updatedBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                  <input type="hidden" name="updatedDate" value="<?php echo $dated; ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="title" class="col-sm-3 control-label"><?php echo @ucfirst($title); ?> Title</label>
                      <div class="col-sm-9">
                        <?php echo form_error('complainTypeTitle'); ?>
                        <input type="text" class="form-control" name="complainTypeTitle" required value="<?php  echo $complainTypes->complainTypeTitle;?>" id="title" >

                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-offset-2">
                            <button type="submit"  style="margin-left:15px;" class="btn btn-primary btn-flat"><?php echo @ucfirst($title); ?></button>
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
