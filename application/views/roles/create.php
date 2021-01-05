<?php
//create icons
$module_list = "";
foreach($modules as $module){
    
    //if this module is a controller, set it as option group
    if($module->parent_id == 0){
        $module_list .= "<optgroup label='".$module->module_title."'>";
        
        //now lets get all actions of this controller
        foreach($modules as $cmodule){
            if($cmodule->parent_id == $module->module_id){
                $module_list .= "<option value='".$cmodule->module_id."'> ".$cmodule->module_title."</option>";
            }
        }
        $module_list .= "</optgroup>";
    }
    
}
?>

    <!-- jstree -->

  <link rel="stylesheet" href="<?php echo base_url('assets/lib');?>/jstree-dist/themes/default/style.min.css">

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
            <?php echo validation_errors(); ?>
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('roles/create_process');?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="title" class="col-sm-3 control-label"><?php echo @ucfirst($title); ?> Title</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="role_title" value="<?php echo set_value('role_title');?>" id="title" placeholder="<?php echo @ucfirst($title); ?> Title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="role_desc" class="col-sm-3 control-label">Description</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="role_desc" value="<?php echo set_value('role_desc');?>" id="role_desc" placeholder="<?php echo @ucfirst($title); ?> Description">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="uri" class="col-sm-3 control-label">Role homepage</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="role_homepage">
                              <?php echo $module_list; ?>
                            </select>
                        </div>
                      </div>
                      <!-- radio for menu status -->
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Role Status</label>
                        <div class="col-sm-9">
                        <label>
                          <input type="radio" name="role_status" value="1" class="flat-red" checked> Keep enabled
                        </label>
                        <br>
                        <label>
                          <input type="radio" name="role_status" value="0" class="flat-red"> Keep disabled
                        </label>
                        </div>
                      </div>

                    <div class="form-group">
                      <input type="hidden" value="" id="checked_modules" name="checked_modules" />
                       <label class="col-md-3 control-label">Assign Modules </label> 
                       <div class="col-md-9" id="roles_tree">                   
                          <ul>
                          <?php
                              foreach($module_tree as $cont_id => $cont_t){
                                 echo "<li id=".$cont_id.">";
                                 foreach($cont_t as $cont_title => $action){
                                      echo $cont_title;
                                      //start of actions ul
                                      echo "<ul>";
                                      foreach($action as $act_id => $act_att){
                                          echo "<li id='".$act_id."'";
                                          echo " >".$act_att[1]."</li>";
                                      }
                                      //enc of action ul
                                      echo "</ul>";
                                      //end of controller li
                                      echo "</li>";
                                 }
                              }
                            
                            ?>
                        
                        </ul>
                      </div>
                      </div>


                      <div class="form-group">
                          <div class="col-md-offset-2 col-sm-offset-2">
                              <button type="submit"  style="margin-left:15px;" class="btn btn-primary btn-flat">Add <?php echo @ucfirst($title); ?></button>
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


<script src="<?php echo base_url('assets/lib');?>/jstree-dist/jstree.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.3/jstree.min.js"></script> -->

<script>
  var jq = jQuery.noConflict();
  
      jq("#roles_tree").jstree({
          "plugins" : [ "themes", "html_data", "checkbox", "ui" ]
      });
      jq("#role_form").submit(function(e){
          var ids = jq("#roles_tree").jstree().get_checked(false);
          jq("#checked_modules").val(ids);
          //return false;*/
      });

</script>