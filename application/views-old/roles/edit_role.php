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
                $module_list .= "<option value='".$cmodule->module_id."' ".sel_attr($cmodule->module_id, $role->role_homepage)."> ".$cmodule->module_title."</option>";
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
        <li><a href="#">Create <?php echo ucfirst(@$title); ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo @ucfirst($title); ?> form</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php echo validation_errors(); ?>
                <div class="col-md-10">
                  <form class="form-horizontal" id="role_form" method="post" enctype="multipart/form-data" action="<?php echo site_url("roles/edit/".$role->role_id); ?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Role Title</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control"  id="role_title" name="role_title" placeholder="Role Title" value="<?php echo set_value('role_title', $role->role_title); ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="role_desc" class="col-sm-3 control-label">Description</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="role_desc" name="role_desc" placeholder="Role Description" value="<?php echo set_value('role_desc', $role->role_desc); ?>"  />
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
                          <input type="radio" name="role_status" value="1" class="flat-red"  <?php echo radio_checked($role->role_status, "1"); ?>> Keep enabled
                        </label>
                        <br>
                        <label>
                          <input type="radio" name="role_status" value="0" class="flat-red"  <?php echo radio_checked($role->role_status, "0"); ?>> Keep disabled
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
                                          if(in_array($act_id, $this_role_rights)){
                                              echo  " data-jstree='{ \"selected\" : true }'";
                                          }
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
                          <div class="col-md-offset-3 col-sm-offset-3">
                              <button type="submit"  style="margin-left:15px;"  class="btn btn-primary btn-flat">Update <?php $trimed_title = rtrim($title, "edite");  echo @ucfirst($trimed_title); ?></button>
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
          // alert(ids);
          //return false;*/
      });

</script>
