<style type="text/css">
 fieldset {
    display: block;
    margin-inline-start: 2px;
    margin-inline-end: 2px;
    padding-block-start: 0.35em;
    padding-inline-start: 0.75em;
    padding-inline-end: 0.75em;
    padding-block-end: 0.625em;
    min-inline-size: min-content;
    border-width: 1px;
    border-style: groove;
    border:1px solid #bbb;
    border-image: initial;
    font-size: 16px;

}
legend {
    width: auto;
    display: block;
    padding-inline-start: 2px;
    padding-inline-end: 2px;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial;
    font-size: 16px;
    
}
</style>
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
      <!-- <li><a href="#">Examples</a></li> -->
      <li class="active"><?php echo @ucfirst($title); ?>s</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo @ucfirst($title); ?> Setting</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        
        
       
        <div class="row">
          
        
          <div class="col-md-4">
          <fieldset><legend>Session Setting</legend>
          <fieldset class=" text-center">
           <legend>Current Session</legend>
             <strong class="label label-success"><?php echo $current_session; ?></strong>
              <button id="current" class=" pull-right"><i class="fa fa-edit"></i></button>
            </fieldset>
            <hr>
            <fieldset class=" text-center">
            <legend>Next Session</legend>
              <strong class="label label-success"><?php echo $next_session; ?></strong> 
              <button id="next" class="pull-right "><i class="fa fa-edit"></i></button>
            </fieldset>
            <hr>
            <fieldset class=" text-center">
               <legend>Start new session</legend>
              <button  id="start_session"  class="btn btn-warning"><i class="fa fa-clock-o"></i> Start New Session</button>
            </fieldset>

          </fieldset>
            
          </div>
          <div class="col-md-8">
             <fieldset><legend>All Sessions</legend>
             <div class=" col-sm-12  margin-b">
            <a href="<?php echo base_url('district/create_form'); ?>" class=" pull-right btn btn-flat btn-primary">Add new <?php echo @ucfirst($title); ?></a>
          </div>
            <table class="table-striped table table-responsive table-hover table-bordered">
              <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th class="text-center">Session</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Actions</th>
                </tr>
                <?php $counter=1; ?>
                <?php foreach($session_years as $year): ?>
                <tr>
                  <td><?php echo $counter++;?></td>
                  <td class="text-center"><?php echo $year->sessionYearTitle; ?></td>
                  <td class="text-center">
                    <?php if($year->status == 0 ): ?>
                    <small class="label label-danger"> Inactives</small>
                    <?php else: ?>
                    <small class="label label-success"> Active</small>
                    <?php endif;?>
                  </td>
                  <td class="text-center">
                    <a style="font-size: 20px" href="<?php echo base_url('session_setting/edit/'); ?><?php echo $year->sessionYearId; ?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
                    
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </fieldset>
          <!--                           </div>
        </div> -->
      </div>
      
      <!-- /.box-body -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="next_sessin_model" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_one_title">Edit Next Session</h4>
      </div>
      <div id="modal_one_content_goes_here">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('session_setting/update_next_session');?>">
           <div class="panel-body">
              <label class="col-md-2 control-label"><span class="text-danger">*</span>Session Year</label>
                    <div class="col-md-4">
                      <?php if(!empty($session_years)): ?>
                    <select required="required" class="form-control" name="session_id" style="width: 100%;">
                    <option value="">Select Session</option>
                        <?php foreach ($session_years as $session_year) : ?>
                          <option value="<?= $session_year->sessionYearId;?>"><?= $session_year->sessionYearTitle; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php else: ?>
                      <h5 class="text-danger">No Session Years Found.</h5>
                    <?php endif;?>
                    
                  </div>

                  <div class="form-group">
                            <div class="col-md-2">
                                <input type="submit"  style="margin-left:15px;" id="update" class="btn btn-primary btn-flat" value="Update">
                            </div>
                        </div>
           </div>        
                    
                  
                  </form>
      </div>
    </div>
    
  </div>
</div>

<div class="modal fade" id="current_sessin_model" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_one_title">Edit Current Session</h4>
      </div>
      <div id="modal_one_content_goes_here">
      <div class="row">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('session_setting/update_current_session');?>">
           <div class="panel-body">
              <label class="col-md-2 control-label"><span class="text-danger">*</span>Session Year</label>
                    <div class="col-md-4">
                      <?php if(!empty($session_years)): ?>
                    <select required="required" class="form-control" name="session_id" style="width: 100%;">
                    <option value="">Select Session</option>
                        <?php foreach ($session_years as $session_year) : ?>
                          <option value="<?= $session_year->sessionYearId;?>"><?= $session_year->sessionYearTitle; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php else: ?>
                      <h5 class="text-danger">No Session Years Found.</h5>
                    <?php endif;?>
                    
                  </div>

                  <div class="form-group">
                            <div class="col-md-2">
                                <input type="submit"  style="margin-left:15px;" id="update" class="btn btn-primary btn-flat" value="Update">
                            </div>
                        </div>
           </div>        
                    
                  
                  </form>
      </div>
        
      </div>
    </div>
    
  </div>
</div>
<script type="text/javascript">
  
  $(document).ready(function(){

  $('#start_session').on('click',function(e){
    e.preventDefault();

    var r=confirm("Are You Sure to Start New Session");
    
    if(r == true)
    {

    $('#start_session').prop('disabled', true);
    var id=1;
    $.ajax({
    type: 'POST',
    url: "<?php echo base_url('school/renewal_as_a_whole_school')?>",
    data: {"id": id},
    success: function(data){
    alert("New Session Created For "+data+" Schools");
    $('#start_session').prop('disabled', false);
    },
    error:function (data) {
     alert("Failed");
     $('#start_session').prop('disabled', false);
    }
});
    }


  });
   

   $('#current').on('click',function(){
      $("#current_sessin_model").modal('show');

   });
    $('#next').on('click',function(){
      $("#next_sessin_model").modal('show');

   });
  });
</script>