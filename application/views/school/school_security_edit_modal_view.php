<div class="row">
  <!-- col-md-offset-1 -->
      <div class="col-md-12">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="Form1" action="<?php echo base_url('school/security_measures_edit_view_ajax_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');">
          <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
          <input type="hidden" name="securityMeasureId" value="<?php echo $school_security_measures->securityMeasureId;?>">
          <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
          <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
          <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
          <div class="alert alert-success text-center" id="msg_one" style="display: none;"></div>
          <div id="validation_one" class="text-center"></div>

             <h2 class="text-center">Section-F: SECURITY MEASURES</h2>
             <?php //var_dump($school_security_measures); ?>
                      <br>
                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>Institutional Security Status:</strong></div>
                         <?php foreach ($security_status as $s_status) : ?>
                          <?php if($s_status->securityStatusId == $school_security_measures->securityStatus){ $check ="checked";  }else{ $check=''; }?>
                            <label class="radio-inline col-sm-3">
                            <input type="radio" name="securityStatus" value="<?php echo $s_status->securityStatusId; ?>" required <?php echo $check; ?> > <?php echo $s_status->securityStatusTitle; ?>
                            </label>
                         <?php endforeach; ?>
                      </div>
                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>Type of Security Provided:</strong></div>
                         <?php foreach ($security_provided as $provided) : ?>
                          <?php if($provided->securityProvidedId == $school_security_measures->securityProvided ){     $check ="checked";  }else{ $check=''; }?>
                            <label class="radio-inline col-sm-3">
                            <input type="radio" name="securityProvided" value="<?php echo $provided->securityProvidedId; ?>" required <?php echo $check; ?> > <?php echo $provided->securityProvidedTitle; ?>
                            </label>
                         <?php endforeach; ?>

                      </div>
                      <div class="form-group">
                         <label class="control-label col-sm-4" for="securityPersonnel">Security Personnel (in Nos):</label>
                         <div class="col-sm-6">
                            <input type="text" name="securityPersonnel" placeholder="Enter Security Personnel (in Nos)" class="form-control" id="securityPersonnel" value="<?php echo $school_security_measures->securityPersonnel; ?>" required/>
                         </div>
                      </div>
                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>Status of Security personnel:</strong></div>
                         <?php foreach($security_personnel as $s_personnel): ?>
                          <?php if($school_security_measures->security_personnel_status_id == $s_personnel->SecurityPersonnelId){ $check ="checked"; }else{ $check=''; }?>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="security_personnel_status_id" value="<?php echo $s_personnel->SecurityPersonnelId?>" required <?php echo $check; ?>> <?php echo $s_personnel->SecurityPersonnelTitle; ?>
                         </label>
                         <?php endforeach;?>
                      </div>
                      <div class="form-group">
                         <div class="col-sm-4 text-right">
                            <strong>whether security is inline with instruction of Police Department</strong>
                          </div>
                          <?php $options = array("Yes", "No"); ?>
                         <?php foreach($options as $key => $value):?>
                          <?php if($school_security_measures->cameraInstallation == $value){ $check ="checked"; }else{ $check=''; }?>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="security_according_to_police_dept" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>
                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>CCTVs Camera System Installed:</strong></div>
                         <?php foreach($options as $key => $value):?>
                          <?php if($school_security_measures->cameraInstallation == $value){ $check ="checked"; }else{ $check=''; }?>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="cameraInstallation" <?php echo $check; ?> value="<?php echo $value; ?>" required>  <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-sm-4" for="numberOfCam">If is yes, then number of CCTVs Cameras</label>
                         <div class="col-sm-6">
                            <input type="text" name="camraNumber" placeholder="Enter number of CCTVs Cameras" class="form-control" id="numberOfCam" value="<?php echo $school_security_measures->camraNumber; ?>" />
                         </div>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>DVR Maintained</strong></div>
                         <?php foreach($options as $key => $value):?>
                          <?php if($school_security_measures->emergencyDoorsNumber == $value){ $check ="checked"; }else{ $check=''; }?>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="dvrMaintained" <?php echo $check; ?> required value="<?php echo $value; ?>" > <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>CCTVs Online Accessibility:</strong></div>
                         <?php foreach($options as $key => $value): ?>
                          <?php if($school_security_measures->emergencyDoorsNumber == $value){ $check ="checked"; }else{ $check=''; }?>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="cameraOnline" <?php echo $check; ?> value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach;?>
                      </div>

                      <div class="form-group">
                         <label class="control-label col-sm-4 text-right" for="exitDoorsNumber">Number of Exit Doors:</label>
                         <div class="col-sm-6">
                            <input type="text" required name="exitDoorsNumber" placeholder="Enter Number of Exit Doors" class="form-control" id="exitDoorsNumber" value="<?php echo $school_security_measures->exitDoorsNumber; ?>" />
                         </div>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>Emergency Exit Door Availability:</strong></div>
                         <?php foreach($options as $key => $value): ?>
                          <?php if($school_security_measures->emergencyDoorsNumber == $value){ $check ="checked"; }else{ $check=''; }?>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="emergencyDoorsNumber" <?php echo $check; ?> value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach;?>
                      </div>

                      <div class="form-group">
                         <label class="control-label col-sm-4 text-right" for="boundryWallHeight">Boundary Wall Height (In Feet):</label>
                         <div class="col-sm-6">
                            <input type="text" required name="boundryWallHeight" placeholder="Enter Boundary Wall Height in Feet" class="form-control" id="boundryWallHeight" value="<?php echo $school_security_measures->boundryWallHeight; ?>" />
                         </div>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>Barbed Wires Provided:</strong></div>
                         <?php foreach($options as $key => $value): ?>
                         <?php if($school_security_measures->wiresProvided == $value){ $check ="checked"; }else{ $check=''; } ?> 
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="wiresProvided" <?php echo $check;?> value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach;?>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-4 text-right"><strong>Watch Tower:</strong></div>
                         <?php foreach($options as $key => $value): ?>
                         <?php if($school_security_measures->watchTower == $value){ $check ="checked"; }else{ $check=''; } ?> 
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="watchTower" <?php echo $check; ?> value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach;?>
                      </div>

                      <div class="form-group">
                         <label class="control-label col-sm-4 text-right" for="licensedWeapon">Number of Licensed Weapon(s):</label>
                         <div class="col-sm-6">
                            <input type="text" required name="licensedWeapon" placeholder="Enter Number of Licensed Weapon" class="form-control" id="licensedWeapon" value="<?php echo $school_security_measures->licensedWeapon; ?>" />
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-sm-4" for="license_issued_by_id">License issued by whom:</label>
                          <div class="col-sm-6">
                             <select class="form-control select2" id="license_issued_by_id" name="license_issued_by_id" required>
                              <option>Select</option>
                              <?php foreach ($security_license_issued as $security_license_issue): ?>
                                <?php if($school_security_measures->license_issued_by_id == $security_license_issue->licenseIssuedId){ $check ="selected"; }else{ $check=''; }?> 
                                <option value="<?php echo $security_license_issue->licenseIssuedId; ?>" <?php echo $check;?> > <?php echo $security_license_issue->licenseIssuedTitle; ?> </option>
                              <?php endforeach; ?>
                             </select>
                          </div>
                      </div>

                      <div class="form-group">
                         <label class="control-label col-sm-4 text-right" for="licenseNumber">License No(s):</label>
                         <div class="col-sm-6">
                            <input type="text" required name="licenseNumber" placeholder="Enter License Number" class="form-control" id="licenseNumber" value="<?php echo $school_security_measures->licenseNumber; ?>" />
                         </div>
                      </div>

                      <div class="form-group">
                         <label class="control-label col-sm-4 text-right" for="ammunitionStatus">Ammunition Status (In Nos.):</label>
                         <div class="col-sm-6">
                            <input type="text" required name="ammunitionStatus" placeholder="Enter License Number" class="form-control" id="ammunitionStatus" value="<?php echo $school_security_measures->ammunitionStatus; ?>" />
                         </div>
                      </div>

                     <div class="form-group">
                        <div class="col-sm-4 text-right"><strong>Metal Detector:</strong></div>
                        <?php foreach($options as $key => $value): ?>
                        <?php if($school_security_measures->metalDetector == $value){ $check ="checked"; }else{ $check=''; }?>         
                        <label class="radio-inline col-sm-2">
                        <input type="radio" name="metalDetector" value="<?php echo $value; ?>" required <?php echo $check; ?> > <?php echo $value; ?>
                        </label>
                        <?php endforeach;?>
                     </div>

                     <div class="form-group">
                        <div class="col-sm-4 text-right"><strong>Walkthrough gate:</strong></div>
                        <?php foreach($options as $key => $value): ?>
                        <?php if($school_security_measures->walkThroughGate == $value){ $check ="checked"; }else{ $check=''; }?>      
                        <label class="radio-inline col-sm-2">
                        <input type="radio" name="walkThroughGate" value="<?php echo $value; ?>" required <?php echo $check; ?>> <?php echo $value; ?>
                        </label>
                        <?php endforeach;?>
                     </div>

                     <div class="form-group">
                        <div class="col-sm-4 text-right"><strong>Main Gate Barrier:</strong></div>
                        <?php $check = "";?>
                        <?php foreach($options as $key => $value): ?> 
                        <?php if($school_security_measures->gateBarrier == $value){ $check ="checked"; }else{ $check=''; }?>         
                        <label class="radio-inline col-sm-2">
                        <input type="radio" name="gateBarrier" value="<?php echo $value; ?>" required <?php echo $check; ?>> <?php echo $value; ?>
                        </label>
                        <?php endforeach;?>
                     </div>
              <div class="form-group">
                  <div class="col-md-offset-4 col-sm-offset-4">
                      <input type="submit"  style="margin-left:15px;" id="update" class="btn btn-primary btn-flat" value="Update">
                  </div>
              </div>
        </form>
      </div>
  </div>


  <script type="text/javascript">
    $('form[id="Form1"] input:submit').on('click', function(e) {
        e.preventDefault();
        $("#update").prop('disabled', true);
        $("#update").val("Please Wait...");
        $('#validation_one').html('');
        $('#msg_one').html('');
        // $('#create_school_user_process_response').html('');
        // $('#create_school_user_process_response_alert').html('');
        $.ajax({
             type: 'POST',
             url: $('#Form1').attr('action'),
             data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
             success: function(data){
                obj = $.parseJSON(data);
                // console.log(data);
                // fails
                if(obj.status == false){
                    $('#validation_one').html(obj.msg);
                    $("#update").val("Update");
                    $("#update").prop('disabled', false);
                }
                // pass
                if(obj.status == true){
                  $('#myModal').modal('show');
                  // $('#myModal').modal('hide');
                    $('#msg_one').show().html(obj.msg).fadeOut(3000);
                     // $('#modal_one').modal('hide');
                     setTimeout(function() {
                         $("#modal_one").modal('hide');
                     }, 3000);
                    // $("#Form1").trigger('reset');
                }

             },
              error:function (data) {
                alert("Not updated Security Measure :"+data);

              }
        });


        // return false;
    });
  </script>