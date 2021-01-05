<?php

//create icons
$icon_list = "";
foreach($icons as $icon){
    $icon_list .= "<option value='".$icon->icon_title."'";
    if($icon->icon_title == $action->module_icon){
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
            
            <?php echo validation_errors(); ?>
            
            <form class="form-horizontal" role="form" method="post" action="<?php echo site_url("modules/edit_action/".$module_id."/".$controller_id); ?>">
			  
              <div class="form-group">
				<label for="module_title" class="col-sm-2 control-label">Action Title</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="module_title" name="module_title" placeholder="Action Title" value="<?php echo set_value('module_title', $action->module_title); ?>" />
				</div>
			  </div>
              
              
              <div class="form-group">
				<label for="module_desc" class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="module_desc" name="module_desc" placeholder="Action Description" value="<?php echo set_value('module_desc', $action->module_desc); ?>" />
				</div>
			  </div>
              
              
              <div class="form-group">
				<label for="module_title" class="col-sm-2 control-label">Action URI</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="module_uri" name="module_uri" placeholder="Action URI" value="<?php echo set_value('module_uri', $action->module_uri); ?>" />
				</div>
			  </div>
              
              
               
              <div class="form-group">
				 <label class="col-md-2 control-label">Menu Status </label> 
				 <div class="col-md-10"> 
					<label class="radio"> <input type="radio" class="flat-red" name="module_menu_status" value="1" <?php echo radio_checked($action->module_menu_status, "1"); ?> /> Show in menu </label> 
					<label class="radio"> <input type="radio" class="flat-red" name="module_menu_status" value="0" <?php echo radio_checked($action->module_menu_status, "0"); ?> /> Don't show in menu </label> 
					</div>
			  </div>
              
              
              
              
              
              <div class="form-group">
				<label class="col-sm-2 control-label">Action Icon</label>
				<div class="col-sm-10">
				 <select class="form-control" name="module_icon">
				  <?php echo $icon_list; ?>
				</select>
				
				</div>
			  </div>
              
              
              
              
              <div class="form-group">
				 <label class="col-md-2 control-label">Status </label> 
				 <div class="col-md-10"> 
					<label class="radio"> <input type="radio" class="flat-red" name="module_status" value="1" <?php echo radio_checked($action->module_status, "1"); ?>  /> Active </label> 
					<label class="radio"> <input type="radio" class="flat-red" name="module_status" value="0" <?php echo radio_checked($action->module_status, "0"); ?> /> Inactive </label> 
					</div>
			  </div>


              
			 
              
			  
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-primary">Save</button>
				</div>
			  </div>
			</form>



			
			
		</div>
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>
