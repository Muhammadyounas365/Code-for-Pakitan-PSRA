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
        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
  aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width:85%">85% 
  </div>
  </div>
          <div class="row">
            <!-- col-md-offset-1 -->
                <div class="col-md-offset-1 col-md-10">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('school/form_g_process'); ?>/<?php echo $school_id; ?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >
                    <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
                    <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
                      <h2 class="text-center">Section-G: HAZARDS WITH ASSOCIATED RISKS</h2>

                      <div class="form-group">
                         <div class="col-sm-6"><strong>Exposed to floods:</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="exposedToFlood" value="Yes"> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="exposedToFlood" value="No"> No
                         </label>
                      </div>
                      <div class="form-group">
                         <div class="col-sm-6"><strong>Drowning (In case of nearby canal):</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="drowning" value="Yes"> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="drowning" value="No"> No
                         </label>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-6"><strong>School Building Condition (Walls, Doors, windows)</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="buildingCondition" value="Good"> Good
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="buildingCondition" value="Satisfactory"> Satisfactory
                         </label>
                         <label class="radio-inline col-sm-1">
                         <input type="radio" name="buildingCondition" value="Poor"> Poor
                         </label>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-6"><strong>School Access route</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="accessRoute" value="Safe"> Safe 
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="accessRoute" value="Unsafe" id="UnsafeRadioButton"> Unsafe
                         </label>
                      </div>
                      <div id="UnsafeDiv" style="display: none;">
                        <div class="form-group">
                           <div class="col-sm-6"><strong>If Unsafe: Describe the following</strong></div>
                           <label class="checkbox-inline col-sm-2">
                           <input type="checkbox" name="unSafeList[]" value="1"> Main road
                           </label>
                           <label class="checkbox-inline col-sm-2">
                           <input type="checkbox" name="unSafeList[]" value="2"> Walk through the market
                           </label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6"></div>
                            <label class="checkbox-inline col-sm-2">
                            <input type="checkbox" name="unSafeList[]" value="3"> Narrow street
                            </label>
                            <label class="checkbox-inline col-sm-2">
                            <input type="checkbox" name="unSafeList[]" value="4"> Open filed
                            </label>
                            <label class="checkbox-inline col-sm-1">
                            <input type="checkbox" name="unSafeList[]" value="5"> Standing Crops
                            </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6"><strong>Other buildings adjacent to School</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="adjacentBuilding" value="Safe"> Safe
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="adjacentBuilding" value="Unsafe"> Unsafe
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Safe assembly points available for <br>
                          (i. Flood ii. Earthquake
                      iii. Fire iii. Human induce)</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="safeAssemblyPointsAvailable" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="safeAssemblyPointsAvailable" value="No" required> No
                         </label>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Teacher trained on School Based Disaster Risk Management</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="disasterTraining" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="disasterTraining" value="No" required> No
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>School Improvement plan developed</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="schoolImprovementPlan" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="schoolImprovementPlan" value="No" required> No
                         </label>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>School Disaster Management plan developed</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="schoolDisasterManagementPlan" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="schoolDisasterManagementPlan" value="No" required> No
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Electrification condition</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="electrification_condition_id" value="1" required> Good
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="electrification_condition_id" value="2" required> Satisfactory
                         </label>
                         <label class="radio-inline col-sm-1">
                         <input type="radio" name="electrification_condition_id" value="3" required> Poor
                         </label>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Proper ventilation system available</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="ventilationSystemAvailable" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="ventilationSystemAvailable" value="No" required> No
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Expose to Chemicals in School Laboratory</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="chemicalsSchoolLaboratory" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="chemicalsSchoolLaboratory" value="No" required> No
                         </label>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Expose to Chemicals in school surrounding</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="chemicalsSchoolSurrounding" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="chemicalsSchoolSurrounding" value="No" required> No
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Exposed to road accident</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="roadAccident" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="roadAccident" value="No" required> No
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Safe drinking water available</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="safeDrinkingWaterAvailable" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="safeDrinkingWaterAvailable" value="No" required> No
                         </label>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Proper sanitation facilities available (Latrine, draining)</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="sanitationFacilities" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="sanitationFacilities" value="No" required> No
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>School Building Structure</strong></div>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="building_structure_id" value="1" required> Single Story
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="building_structure_id" value="2" required> Double Story
                         </label>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>School surrounded by the community</strong></div>
                        <label class="radio-inline col-sm-2">
                        <input type="radio" name="school_surrounded_by_id" value="1" required> Local
                        </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="school_surrounded_by_id" value="2" required> Outsider
                         </label>
                         <label class="radio-inline col-sm-1">
                         <input type="radio" name="school_surrounded_by_id" value="3" required> Refugees
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

      $('input[type=radio][name=accessRoute]').change(function() {
          if (this.value == 'Safe') {
              $("#UnsafeDiv").fadeOut('slow');
          }
          else{
            $("#UnsafeDiv").fadeIn('slow');
          }
      });
  </script>