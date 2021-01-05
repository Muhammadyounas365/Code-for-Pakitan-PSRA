          <div class="row">
            <!-- col-md-offset-1 -->
                <div class="col-md-offset-1 col-md-10">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="Form1" action="<?php echo base_url('school/hazard_risk_edit_view_ajax_modal_process'); ?>/<?php echo $school_id; ?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >
                    <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
                    <input type="hidden" name="hazardsWithAssociatedRisksId" value="<?php echo $hazards_hazard_with_associated_risks->hazardsWithAssociatedRisksId; ?>">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
                    <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
                    <div class="alert alert-success text-center" id="msg_one" style="display: none;"></div>
                    <div id="validation_one" class="text-center"></div>
                    
                      <h2 class="text-center">Section-G: HAZARDS WITH ASSOCIATED RISKS</h2>

                      <div class="form-group">
                         <div class="col-sm-6"><strong>Exposed to floods:</strong></div>
                         <?php $options = array("Yes", "No"); ?>
                         <?php foreach($options as $key => $value): ?>
                          <?php if($hazards_hazard_with_associated_risks->exposedToFlood == $value){ $check ="checked"; }else{ $check=''; }?>

                          <label class="radio-inline col-sm-2">
                          <input type="radio" <?php echo $check; ?> name="exposedToFlood" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                          </label>
                          <?php endforeach; ?>
                      </div>
                      <div class="form-group">
                         <div class="col-sm-6"><strong>Drowning (In case of nearby canal):</strong></div>

                         <?php foreach($options as $key => $value): ?>
                          <?php if($hazards_hazard_with_associated_risks->drowning == $value){ $check ="checked"; }else{ $check=''; }?>

                          <label class="radio-inline col-sm-2">
                          <input type="radio" <?php echo $check; ?> name="drowning" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                          </label>
                          <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-6"><strong>School Building Condition (Walls, Doors, windows)</strong></div>
                        <?php $condition = array("Good", "Satisfactory", "Poor"); $counter = 0; ?>
                        <?php foreach($condition as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->buildingCondition == $value){ $check ="checked"; }else{ $check=''; }?>

                         <?php if($counter == 2): ?>
                            </div>
                            <div class="col-sm-6"></div>
                            <div class="form-group">
                             <?php $counter = 0; ?>
                         <?php endif; ?>
                         <?php $counter++; ?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="buildingCondition" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                         <div class="col-sm-6"><strong>School Access route</strong></div>
                         <?php $safeUnsafe = array("Safe", "Unsafe"); ?>
                         <?php foreach($safeUnsafe as $key => $value): ?>
                          <?php if($hazards_hazard_with_associated_risks->accessRoute == $value){ $check ="checked"; }else{ $check=''; }?>

                          <label class="radio-inline col-sm-2">
                          <input type="radio" <?php echo $check; ?> name="accessRoute" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                          </label>
                          <?php endforeach; ?>
                      </div>
                      <?php if(count($unsafe_ids) > 0 ): ?>
                      <?php $display = ''; ?>
                      <?php else: ?>
                      <?php $display = 'none';?>
                      <?php endif; ?> 
                      <div id="UnsafeDiv" style="display: <?php echo $display; ?>;">
                        <div class="form-group checkbox_required">
                           <div class="col-sm-6"><strong>If Unsafe: Describe the following</strong></div>
                           <?php $counter = 0; ?>
                           <?php foreach($unsafe_list as $un_list ): ?>
                            <?php if(in_array($un_list->unSafeListId, $unsafe_ids)){ $check ="checked"; }else{ $check=''; } ?>
                            <?php if($counter >= 2): ?>
                               </div>
                               <div class="col-sm-6"></div>
                               <div class="form-group checkbox_required">
                                <?php $counter = 0; ?>
                            <?php endif; ?>
                           
                            <label class="checkbox-inline col-sm-2">
                            <input type="checkbox" <?php echo $check; ?> name="unSafeList[]" value="<?php echo $un_list->unSafeListId; ?>" > <?php echo $un_list->unSafeListTitle; ?>
                            </label>
                            <?php $counter++; ?>
                            <?php endforeach; ?>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6"><strong>Other buildings adjacent to School</strong></div>

                        <?php $safeUnsafe = array("Safe", "Unsafe"); ?>
                        <?php foreach($safeUnsafe as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->adjacentBuilding == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="adjacentBuilding" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Safe assembly points available for <br>
                          (i. Flood ii. Earthquake
                      iii. Fire iii. Human induce)</strong></div>
                        
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->safeAssemblyPointsAvailable == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="safeAssemblyPointsAvailable" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                        <!--  <label class="radio-inline col-sm-2">
                         <input type="radio" name="safeAssemblyPointsAvailable" value="Yes" required> Yes
                         </label>
                         <label class="radio-inline col-sm-2">
                         <input type="radio" name="safeAssemblyPointsAvailable" value="No" required> No
                         </label> -->
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Teacher trained on School Based Disaster Risk Management</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->disasterTraining == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="disasterTraining" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>

                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>School Improvement plan developed</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->schoolImprovementPlan == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="schoolImprovementPlan" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>School Disaster Management plan developed</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->schoolDisasterManagementPlan == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="schoolDisasterManagementPlan" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>

                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Electrification condition</strong></div>
                          <?php $counter = 0; ?>
                          <?php foreach($condition as $key => $value): ?>
                           <?php if($hazards_hazard_with_associated_risks->electrification_condition_id == $key){ $check ="checked"; }else{ $check=''; }?>
                           <?php if($counter == 2): ?>
                              </div>
                              <div class="col-sm-6"></div>
                              <div class="form-group">
                               <?php $counter = 0; ?>
                           <?php endif; ?>
                           <?php $counter++; ?>

                           <label class="radio-inline col-sm-2">
                           <input type="radio" <?php echo $check; ?> name="electrification_condition_id" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                           </label>
                           <?php endforeach; ?>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Proper ventilation system available</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->ventilationSystemAvailable == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="ventilationSystemAvailable" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Expose to Chemicals in School Laboratory</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->chemicalsSchoolLaboratory == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="chemicalsSchoolLaboratory" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Expose to Chemicals in school surrounding</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->chemicalsSchoolSurrounding == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="chemicalsSchoolSurrounding" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Exposed to road accident</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->roadAccident == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="roadAccident" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>Safe drinking water available</strong></div>
                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->safeDrinkingWaterAvailable == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="safeDrinkingWaterAvailable" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-6"><strong>Proper sanitation facilities available (Latrine, draining)</strong></div>

                        <?php foreach($options as $key => $value): ?>
                         <?php if($hazards_hazard_with_associated_risks->sanitationFacilities == $value){ $check ="checked"; }else{ $check=''; }?>

                         <label class="radio-inline col-sm-2">
                         <input type="radio" <?php echo $check; ?> name="sanitationFacilities" value="<?php echo $value; ?>" required> <?php echo $value; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>School Building Structure</strong></div>
                        <?php foreach ($building_structure as $b_structure ) : ?>
                          <?php if($hazards_hazard_with_associated_risks->building_structure_id == $b_structure->buildingStructureId){ $check ="checked"; }else{ $check=''; }?>
                          <label class="radio-inline col-sm-2">
                          <input type="radio" name="building_structure_id" value="<?php echo $b_structure->buildingStructureId; ?>" required <?php echo $check; ?> > <?php echo $b_structure->buildingStructure; ?>
                          </label>
                        <?php endforeach; ?>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6"><strong>School surrounded by the community</strong></div>
                        <?php $counter = 0; ?>
                        <?php foreach ($hazards_surrounded as $h_surrounded ) : ?>
                          <?php if($hazards_hazard_with_associated_risks->school_surrounded_by_id == $h_surrounded->hazardsSurroundedId){ $check ="checked"; }else{ $check=''; }?>
                            <?php if($counter == 2): ?>
                               </div>
                               <div class="col-sm-6"></div>
                               <div class="form-group">
                                <?php $counter = 0; ?>
                            <?php endif; ?>
                            <?php $counter++; ?>
                            <label class="radio-inline col-sm-2">
                            <input type="radio" name="school_surrounded_by_id" value="<?php echo $h_surrounded->hazardsSurroundedId; ?>" required <?php echo $check; ?> > <?php echo $h_surrounded->hazardsSurroundedTitle; ?>
                            </label>
                          <?php endforeach; ?>
                      </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 col-sm-offset-4">
                                <input type="submit"  style="margin-left:15px;" id="update" class="btn btn-primary btn-flat" value="Update">
                            </div>
                        </div>
                  </form>
                </div>
            </div>
        </div>





<script type="text/javascript">
    // checkbox required or not ...
    $(function(){
        var requiredCheckboxes = $('.checkbox_required :checkbox[required]');
        requiredCheckboxes.change(function(){
            if(requiredCheckboxes.is(':checked')) {
                requiredCheckboxes.removeAttr('required');
            } else {
                requiredCheckboxes.attr('required', 'required');
            }
        });
    });

    $('input[type=radio][name=accessRoute]').change(function() {
        if (this.value == 'Safe') {
            $("#UnsafeDiv").fadeOut('slow');
            $( ".checkbox_required input[type=checkbox]" ).prop( "checked", false );
        }
        else{
          $("#UnsafeDiv").fadeIn('slow');
        }
    });
</script>



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





<script type="text/javascript">
    $(document).ready(function(){

         $('[data-mask]').inputmask();
    });  
</script>