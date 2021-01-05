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
        <div class="progress">
        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
  aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">70% 
  </div>
  </div>
          <div class="row">
            <!-- col-md-offset-1 -->
                <div class="col-md-12">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('school/form_f_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');">
                    <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
                    <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
                       <h2 class="text-center">Section-F: SECURITY MEASURES</h2>
                                <br>
                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>Institutional Security Status:</strong></div>
                                   <label class="radio-inline col-sm-3">
                                   <input type="radio" name="securityStatus" value="1" required> Managed
                                   </label>
                                   <label class="radio-inline col-sm-3">
                                   <input type="radio" name="securityStatus" value="2" required> Not Managed
                                   </label>
                                </div>
                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>Type of Security Provided:</strong></div>
                                   <label class="radio-inline col-sm-3">
                                   <input type="radio" name="securityProvided" value="1" required> Own Arrangement
                                   </label>
                                   <label class="radio-inline col-sm-3">
                                   <input type="radio" name="securityProvided" value="2" required> Provided by Authorized Security Company
                                   </label>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-sm-4" for="securityPersonnel">Security Personnel (in Nos):</label>
                                   <div class="col-sm-6">
                                      <input type="text" name="securityPersonnel" placeholder="Enter Security Personnel (in Nos)" class="form-control" id="securityPersonnel"  required/>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>Status of Security personnel:</strong></div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="security_personnel_status_id" value="1" required> Trained
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="security_personnel_status_id" value="2" required> Retired (Forces)
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="security_personnel_status_id" value="3" required> Fresh
                                   </label>
                                </div>
                                <div class="form-group">
                                   <div class="col-sm-4 text-right">
                                      <strong>whether security is inline with instruction of Police Department</strong>
                                    </div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="security_according_to_police_dept" value="Yes" required> Yes
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="security_according_to_police_dept" value="No" required> No
                                   </label>
                                </div>
                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>CCTVs Camera System Installed:</strong></div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="cameraInstallation" value="Yes" required> Yes
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="cameraInstallation" value="No" required> No
                                   </label>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-sm-4" for="numberOfCam">If is yes, then number of CCTVs Cameras</label>
                                   <div class="col-sm-6">
                                      <input type="text" name="camraNumber" placeholder="Enter number of CCTVs Cameras" class="form-control" id="numberOfCam" />
                                   </div>
                                </div>

                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>DVR Maintained</strong></div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="dvrMaintained" value="Yes" required required> Yes
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="dvrMaintained" value="No" required required> No
                                   </label>
                                </div>

                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>CCTVs Online Accessibility:</strong></div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="cameraOnline" value="Yes" required> Yes
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="cameraOnline" value="No" required> No
                                   </label>
                                </div>

                                <div class="form-group">
                                   <label class="control-label col-sm-4 text-right" for="exitDoorsNumber">Number of Exit Doors:</label>
                                   <div class="col-sm-6">
                                      <input type="text" required name="exitDoorsNumber" placeholder="Enter Number of Exit Doors" class="form-control" id="exitDoorsNumber" />
                                   </div>
                                </div>

                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>Emergency Exit Door Availability:</strong></div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="emergencyDoorsNumber" value="Yes" required> Yes
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="emergencyDoorsNumber" value="No" required> No
                                   </label>
                                </div>

                                <div class="form-group">
                                   <label class="control-label col-sm-4 text-right" for="boundryWallHeight">Boundary Wall Height (In Feet):</label>
                                   <div class="col-sm-6">
                                      <input type="text" required name="boundryWallHeight" placeholder="Enter Boundary Wall Height in Feet" class="form-control" id="boundryWallHeight" />
                                   </div>
                                </div>

                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>Barbed Wires Provided:</strong></div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="wiresProvided" value="Yes" required> Yes
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="wiresProvided" value="No" required> No
                                   </label>
                                </div>

                                <div class="form-group">
                                   <div class="col-sm-4 text-right"><strong>Watch Tower:</strong></div>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="watchTower" value="Yes" required> Yes
                                   </label>
                                   <label class="radio-inline col-sm-2">
                                   <input type="radio" name="watchTower" value="No" required> No
                                   </label>
                                </div>

                                <div class="form-group">
                                   <label class="control-label col-sm-4 text-right" for="licensedWeapon">Number of Licensed Weapon(s):</label>
                                   <div class="col-sm-6">
                                      <input type="text" required name="licensedWeapon" placeholder="Enter Number of Licensed Weapon" class="form-control" id="licensedWeapon" />
                                   </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="license_issued_by_id">License issued by whom:</label>
                                    <div class="col-sm-6">
                                       <select class="form-control select2" id="license_issued_by_id" name="license_issued_by_id" required>
                                          <option>Select </option>
                                          <option value="1">DC</option>
                                          <option value="2">Home Deptt KPK</option>
                                          <option value="3">Ministry of Interior Pakistan</option>
                                          <option value="4">Other</option>
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="control-label col-sm-4 text-right" for="licenseNumber">License No(s):</label>
                                   <div class="col-sm-6">
                                      <input type="text" required name="licenseNumber" placeholder="Enter License Number" class="form-control" id="licenseNumber" />
                                   </div>
                                </div>

                                <div class="form-group">
                                   <label class="control-label col-sm-4 text-right" for="ammunitionStatus">Ammunition Status (In Nos.):</label>
                                   <div class="col-sm-6">
                                      <input type="text" required name="ammunitionStatus" placeholder="Enter License Number" class="form-control" id="ammunitionStatus" />
                                   </div>
                                </div>

                               <div class="form-group">
                                  <div class="col-sm-4 text-right"><strong>Metal Detector:</strong></div>
                                  <label class="radio-inline col-sm-2">
                                  <input type="radio" name="metalDetector" value="Yes" required> Yes
                                  </label>
                                  <label class="radio-inline col-sm-2">
                                  <input type="radio" name="metalDetector" value="No" required> No
                                  </label>
                               </div>

                               <div class="form-group">
                                  <div class="col-sm-4 text-right"><strong>Walkthrough gate:</strong></div>
                                  <label class="radio-inline col-sm-2">
                                  <input type="radio" name="walkThroughGate" value="Yes" required> Yes
                                  </label>
                                  <label class="radio-inline col-sm-2">
                                  <input type="radio" name="walkThroughGate" value="No" required> No
                                  </label>
                               </div>

                               <div class="form-group">
                                  <div class="col-sm-4 text-right"><strong>Main Gate Barrier:</strong></div>
                                  <label class="radio-inline col-sm-2">
                                  <input type="radio" name="gateBarrier" value="Yes" required> Yes
                                  </label>
                                  <label class="radio-inline col-sm-2">
                                  <input type="radio" name="gateBarrier" value="No" required> No
                                  </label>
                               </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 col-sm-offset-4">
                                <button type="submit"  style="margin-left:15px;" id="checkBtn" class="btn btn-primary btn-flat">Add <?php echo @ucfirst($title); ?></button>
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


  <script type="text/javascript">
  $(document).ready(function () {
      $('#checkBtn').click(function(e) {
        // e.preventDefault();
        pf_physical_id = $("input[name=pf_physical_id]:checked").length;
        academic_id = $("input[name=academic_id]:checked").length;
        co_curricular_id = $("input[name=co_curricular_id]:checked").length;
        other_id = $("input[name=other_id]:checked").length;
        if(!checked) {
          alert("You must check at least one checkbox.");
          return false;
        }

      });
      $("#latrines").change(function() {
        if($("#latrines").prop('checked') == true){
            $("#latDiv").fadeIn('slow');
            $("#latDiv").find("input").prop('required',true);
        }else{
          $("#latDiv").fadeOut('slow');//hide();
          $("#latDiv").find("input").prop('required',false);
        }
      })

      $("#computerlab").change(function() {
          if($("#computerlab").prop('checked') == true){
              $("#computerLabDiv").fadeIn('slow');
              $("#computerLabDiv").find("input").prop('required',true);
          }else{
            $("#computerLabDiv").fadeOut('slow');//hide();
            $("#computerLabDiv").find("input").prop('required',false);
          }

      });
      
  });

  </script>