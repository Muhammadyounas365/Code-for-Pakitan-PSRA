    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/plugins/iCheck');?>/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib');?>/select2/dist/css/select2.min.css">

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
          <h3 class="box-title">Edit <?php echo @$title; ?> form</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php echo validation_errors(); ?>
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('age/create_process/');?><?php echo $age->ageId; ?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Age Title</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="ageTitle" value="<?php echo set_value('ageTitle',$age->ageTitle);?>" id="title" placeholder="Age Title">
                        </div>
                      </div>
                      
                      
                      <!-- radio for menu status -->
                     

                     

                     

                      <div class="form-group">
                          <div class="col-md-offset-2 col-sm-offset-2">
                              <button type="submit"  style="margin-left:15px;"  class="btn btn-primary btn-flat">Update <?php echo @ucfirst($title); ?></button>
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


  <!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/lib/plugins/iCheck');?>/icheck.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/lib');?>/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
      //Initialize Select2 Elements
    $('.select2').select2()
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass   : 'iradio_flat-blue'
  })
</script>