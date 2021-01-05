    <!-- iCheck for checkboxes and radio inputs -->
 
<?php

//create icons
$icon_list = "";
foreach($icons as $icon){
    $icon_list .= "<option value='".$icon->icon_title."'";
    if($icon->icon_title == $controller->module_icon){
        $icon_list .= " selected='selected' ";
    }
    $icon_list .= "> ".$icon->icon_title."</option>";
}




?>


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
          <h3 class="box-title">Edit <?php echo @$title; ?>s form</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php echo validation_errors(); ?>
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url("modules/edit_controller/".$controller->module_id); ?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Controller Title</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="module_title" value="<?php echo set_value('controller_title', $controller->module_title);?>" id="title" placeholder="Controller Title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="desc" class="col-sm-2 control-label">Description</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="module_desc" value="<?php echo set_value('desc',$controller->module_desc);?>" id="desc" placeholder="Controller Description">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="uri" class="col-sm-2 control-label">Controller URL</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="module_uri" value="<?php echo set_value('uri',$controller->module_uri);?>" id="uri" placeholder="Controller URL">
                        </div>
                      </div>
                      <!-- radio for menu status -->
                      <div class="form-group">
                         <label class="col-md-2 control-label">Menu Status </label> 
         <div class="col-md-10"> 
          <label class="radio"> <input type="radio" class="flat-red" name="module_menu_status" value="1" <?php echo radio_checked($controller->module_menu_status, "1"); ?> /> Show in menu </label> 
          <label class="radio"> <input type="radio" class="flat-red" name="module_menu_status" value="0" <?php echo radio_checked($controller->module_menu_status, "0"); ?> /> Don't show in menu </label> 
          </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Controller Icon</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="module_icon">
                           <?php echo $icon_list; ?>
                        </select>
                      </div>
                      </div>

                      <!-- radio for status -->
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                            <label class="radio"> <input type="radio" class="flat-red" name="module_status" value="1" <?php echo radio_checked($controller->module_status, "1"); ?> /> Active </label> 
                              <label class="radio"> <input type="radio" class="flat-red" name="module_status" value="0" <?php echo radio_checked($controller->module_status, "0"); ?> /> Inactive </label>
                                            </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-offset-2 col-sm-offset-2">
                              <button type="submit"  style="margin-left:15px;"  class="btn btn-primary btn-flat">Add <?php echo @ucfirst($title); ?></button>
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