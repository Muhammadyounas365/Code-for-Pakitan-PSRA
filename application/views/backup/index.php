 



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
                   <form action="<?=base_url('backup/index');?>" class="form-horizontal" role="form" method="post">  
                    <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                        
                    </label>
                    <div class="form-group">
                        <div class="col-md-1 rep-mar">
                            <input type="hidden" value="0" name="hidden">
                            <button type="submit" class="btn btn-primary">
                              <i class="fa fa-download"></i> Download backup
                            </button>
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
       
