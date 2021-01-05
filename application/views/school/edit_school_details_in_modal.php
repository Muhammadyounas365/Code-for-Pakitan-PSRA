  <div class="row"> 

  <div class="col-md-12">
  <div class="alert alert-warning" id="msg_one" style="display: none;color:#fff;"></div>
            
            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="Form1" action="<?php echo base_url('school/create_process');?>">
             
            <input form="Form1" type="hidden" name="schools_id" value="<?php echo $schooldata->schoolId;?>">
              <input type="hidden" form="Form1" name="school_id" value="<?php echo $schooldata->id;?>">
            <?php if(!empty($reg_type)): ?>
                <div class="form-group">
                  <strong class="col-sm-2 text-right">Registration:</strong>
                  <?php foreach ($reg_type as $reg) : ?>
                  <?php $reg_type_id_checked = ''; ?>
                  <?php $style = ''; ?>
                  <?php if($reg->regTypeId == $schooldata->reg_type_id ): ?>
                  <?php $reg_type_id_checked = 'checked'; ?>
                  <?php $style = 'style="font-weight:bold;"'; ?>
                  
                  
                  <?php endif; ?>
                  <label <?php echo $style; ?> class="radio-inline col-sm-2">
                    <input type="radio" form="Form1" name="reg_type_id" <?php echo $reg_type_id_checked; ?>    class="flat-red" value="<?php echo $reg->regTypeId; ?>"> <?php echo $reg->regTypeTitle; ?>
                  </label>
                  <?php endforeach; ?>
                </div>
                <?php else: ?>
                <h5 class="text-danger">No type found for registration.</h5>
                <?php endif;?>

                  <div class="form-group col-sm-12">
                  <label class="control-label col-sm-2" for="schoolName">School Name:</label>
                     <div class="col-sm-4">
                        <input form="Form1" length="5" value="<?php echo $schooldata->schoolName; ?>" type="text"  class="form-control" id="schoolName"  placeholder="Enter School Name" name="schoolName" <?php echo ($this->session->userdata('role_id')==9)? "readonly":""; ?> >
                     </div>
                    <label class="col-sm-2 control-label"><span class="text-danger">*</span>Session Year</label>
                    <div class="col-sm-4">
                      <?php if(!empty($session_years)): ?>
                    <select form="Form1" class="form-control" name="session_year_id" style="width: 100%;">
                        <?php foreach ($session_years as $session_year) : ?>
                <?php if($session_year->sessionYearId==$schooldata->session_year_id): ?>
                          <option value="<?= $session_year->sessionYearId;?>" selected><?= $session_year->sessionYearTitle; ?></option>
                <?php else : ?>
                  <option value="<?= $session_year->sessionYearId;?>"><?= $session_year->sessionYearTitle; ?></option>
                <?php endif;?>
                        <?php endforeach; ?>
                    </select>
                    <?php else: ?>
                      <h5 class="text-danger">No Session Years Found.</h5>
                    <?php endif;?>
                    
                  </div>
                  </div>

                  
                  <div class="form-group col-sm-12">
                     <label class="control-label col-sm-2" for="yoe">Year of Establishment:</label>
                     <div class="col-sm-4">
                        <input form="Form1" length="4" type="number" min="1900" max="2099" step="1" placeholder="Select Year of Establishment" value="<?php echo $schooldata->yearOfEstiblishment; ?>" name="yearOfEstiblishment" <?php set_value('yearOfEstiblishment'); ?>  class="form-control" id="yoe" <?php echo ($this->session->userdata('role_id')==9)? "readonly":""; ?> />
                     </div>
                     <label class="control-label col-sm-2" for="telePhoneNumber">Tele-phone number (<small>with city code</small>) :</label>
                     <div class="col-sm-4">
                        <input form="Form1" type="text"  name="telePhoneNumber" placeholder="Enter Telephone number" value="<?php echo $schooldata->telePhoneNumber; ?>" class="form-control" id="telePhoneNumber" />
                     </div>
                  </div>
                  <div class="form-group col-sm-12">
                     <label class="control-label col-sm-2" for="yoe">BISE Reg No:</label>
                     <div class="col-sm-4">
                        <input form="Form1"  placeholder="BISE Registration No" value="<?php echo $schooldata->biseregistrationNumber; ?>" name="biseregistrationNumber" <?php set_value('biseregistrationNumber'); ?>  class="form-control" id="yoe" />
                     </div>
                     
                  </div>
                    
                    <div class="form-group col-sm-12">
                        <label for="district" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-4">
                         <?php if($this->session->userdata('role_id')==9) { ?>

                         <input type="hidden" name="district_id" value="<?php echo $schooldata->district_id; ?>">
                         <?php } ?>
                          <select form="Form1" onchange="getTehsilsByDistrictId(this);" style="width:100%;"  class="form-control select2" name="district_id" id="district" <?php echo ($this->session->userdata('role_id')==9)? "disabled":""; ?>>
                            <option value="">Select District</option>
                            <?php foreach($districts as $district): ?>
                

                   <?php if($district->districtId==$schooldata->district_id): ?>
                          <option value="<?= $district->districtId;?>" selected><?= $district->districtTitle; ?></option>
                <?php else : ?>
                  <option value="<?= $district->districtId;?>"><?= $district->districtTitle; ?></option>
                <?php endif;?>






                            <?php endforeach; ?>
                          </select>
                        </div>

                        <label class="col-sm-2 control-label"><span class="text-danger">*</span>Tehsils</label>
                      <div class="col-sm-4">
                        <?php if($this->session->userdata('role_id')==9) { ?>

                         <input type="hidden" name="tehsil_id" value="<?php echo $schooldata->tehsil_id; ?>">
                         <?php } ?>
                      <select form="Form1" class="form-control select2" name="tehsil_id" onchange="getUcsByTehsilsId(this);" style="width: 100%;" id="tehsil_list_by_district_id" <?php echo ($this->session->userdata('role_id')==9)? "disabled":""; ?>>
                            <?php foreach($tehsils as $tehsil): ?>
                          <?php if($tehsil->tehsilId==$schooldata->tehsil_id): ?>
                          <option value="<?= $tehsil->tehsilId;?>" selected><?= $tehsil->tehsilTitle; ?></option>
                <?php else : ?>
                  <option value="<?= $tehsil->tehsilId;?>"><?= $tehsil->tehsilTitle; ?></option>
                <?php endif;?>

                        <?php endforeach; ?>   
                      </select>
                      
                        
                      
                    </div>
                      </div>

                    <div class="form-group col-sm-12">
                      

                    <label class="col-sm-2 control-label"><span class="text-danger">*</span>UC/Cantonment</label>
                    <div class="col-sm-4">
                    <?php if($this->session->userdata('role_id')==9) { ?>

                         <input type="hidden" name="uc_id" value="<?php echo $schooldata->uc_id; ?>">
                         <?php } ?>
                      <select form="Form1"  class="form-control select2" name="uc_id" id="uc_id" style="width: 100%;" <?php echo ($this->session->userdata('role_id')==9)? "disabled":""; ?>>

                       <?php foreach($ucs as $uc): ?>
                       <?php if($uc->ucId==$schooldata->uc_id): ?>
                       <option value="<?= $uc->ucId;?>" selected><?= $uc->ucTitle; ?></option>
                <?php else : ?>
                  <option value="<?= $uc->ucId; ?>"><?= $uc->ucTitle; ?></option>
                <?php endif;?>

                        <?php endforeach; ?>   
                      </select>
                    </div>
                    
                    


                 

                    
                     <label class="control-label col-sm-2" for="location">Select Location:</label>
                     <div class="col-sm-4">
                     <?php if($this->session->userdata('role_id')==9) { ?>

                         <input type="hidden" name="location" value="<?php echo $schooldata->location; ?>">
                         <?php } ?>
                        <select form="Form1" required="required" class="form-control" id="location" name="location" style="width: 100%;" <?php echo ($this->session->userdata('role_id')==9)? "disabled":""; ?>>
                          <option>Select Location</option>
                      <?php foreach ($locations as $location) : ?>
                      <?php if($location->locationTitle == $schooldata->location){ $selected = 'selected';}else{ $selected = '';}?>
                      <option value="<?= $location->locationTitle;?>" <?php echo $selected ?> ><?= $location->locationTitle; ?></option>
                      <?php endforeach; ?>
                        </select>
                     </div>
                  </div>

                   <div class="form-group col-sm-12">
                     <label class="control-label col-sm-2" for="gender">Select Gender</label>
                     <div class="col-sm-4">
                      <?php if($this->session->userdata('role_id')==9) { ?>

                         <input type="hidden" name="gender_type_id" value="<?php echo $schooldata->gender_type_id; ?>">
                         <?php } ?>
                      <select form="Form1" required="required" class="form-control" required name="gender_type_id" style="width: 100%;" <?php echo ($this->session->userdata('role_id')==9)? "disabled":""; ?>>
                       <option>Select</option>
                      <?php foreach ($gender_of_school as $gender) : ?>
                      <?php if($gender->genderOfSchoolId == $schooldata->gender_type_id){ $selected = 'selected ';}else{ $selected = '';}?>
                      <option value="<?= $gender->genderOfSchoolId;?>" <?php echo $selected ?> ><?= $gender->genderOfSchoolTitle; ?></option>
                      <?php endforeach; ?>
                      </select>
                     </div>
                     <label class="control-label col-sm-2" for="level">Select Level:</label>
                     <div class="col-sm-4">
                        <select form="Form1" required="required" class="form-control" required id="level_of_school" name="level_of_school_id" class="form-control" style="width: 100%;">
                          <option>Select</option>
                      <?php $selected=''; ?>
                      <?php foreach ($level_of_institute as $item) : ?>
                      <?php if($item->levelofInstituteId == $schooldata->level_of_school_id){ $selected = 'selected'; }else{ $selected=''; } ?>
                      <option value="<?= $item->levelofInstituteId;?>" <?php echo $selected ?> > <?= $item->levelofInstituteTitle; ?></option>
                      <?php endforeach; ?>
                          
                          <?php // echo $level_of_institute; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group col-sm-12">
                     <label class="control-label col-sm-2" for="school_type_id">School Type:</label>
                     <div class="col-sm-4">
                      <?php if($this->session->userdata('role_id')==9) { ?>

                         <input type="hidden" name="school_type_id" value="<?php echo $schooldata->school_type_id; ?>">
                         <?php } ?>
                        <select form="Form1" required="required" class="form-control" id="school_type_id" onchange="schoolTypeChanged(this);"  name="school_type_id" style="width: 100%;" <?php echo ($this->session->userdata('role_id')==9)? "disabled":""; ?>>
                          <?php if(empty($school_types)): ?>
                            <option>no data found</option>
                          <?php else:?>
                             <option>Select</option>
                      <?php foreach ($school_types as $school_type) : ?>
                      <?php if($school_type->typeId == $schooldata->school_type_id){ $selected = 'selected '; }else{ $selected=''; } ?>
                      <option value="<?= $school_type->typeId;?>" <?php echo $selected ?>> <?= $school_type->typeTitle; ?></option>
                      <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                     </div>
                     
                  </div>

                  
                  </div>
                  <div  class="bottom form-group col-sm-12">
                    
                     <div class=" col-sm-12">
                        <input form="Form1" type="submit" name="submit" id="update" value="Update School" style="
    border-radius: 12px;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
   
    "   class="btn btn-success col-sm-2 pull-right"/>
                     </div>
                     
                  </div>
                
                  <!-- <input type="submit" name="submit" value="submit"> -->
            

        <!-- /.box-body -->
        
          </form>
          </div>
          </div>



 <script type="text/javascript">
    function getUcsByTehsilsId(selected){
        
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('registration/get_ucs_by_tehsils_id')?>/",
              data: {"id":selected.value},

              success: function(data){
                $("#uc_id option").remove();
                  $("#uc_id").html(data);
              }
               

          });
      }


     
 </script>
 <script type="text/javascript">
   
    function getTehsilsByDistrictId(selected){
        
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('registration/get_tehsils_by_district_id')?>/",
              data: {"id":selected.value},

              success: function(data){
                  console.log(data);
                  $("#tehsil_list_by_district_id").html(data);
              }

          });
      }
      
 </script>

 <script type="text/javascript">
  $('#Form1').on('submit', function(e) {
      e.preventDefault();
      $("#update").prop('disabled', true);
      $("#update").val("Please Wait...");
      // $('#create_school_user_process_response').html('');
      // $('#create_school_user_process_response_alert').html('');
      
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url('school/edit_edit_school_details_by_id_submit');?>",
           data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
           success: function(data){
              obj = $.parseJSON(data);
              console.log(data);  
              // fails
              if(obj.status == false){
                  $('#msg_one').html(obj.msg);
                  $("#update").val("Update School");
                  $("#update").prop('disabled', false);
               }
              // // pass
              if(obj.status == true){
                $('#myModal').modal('show');
                // $('#myModal').modal('hide');
                  $('#msg_one').show().html(obj.msg).fadeOut(3000);
                   // $('#modal_one').modal('hide');
                   setTimeout(function() {
                       $("#modal_one").modal('hide');
                       //location.reload();
             $.ajax({
             type: 'POST',
             url: $('#Form2').attr('action'),
             data: $('#Form2').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
             success: function(data){
                // obj = $.parseJSON(data);
                 console.log(data);
                    $('tr.bg-success').remove();
                    $('#searched_data_div').prepend(data);
                    $("#search").val("Search");
                    $("#search").prop('disabled', false);
               
             },
              error:function (data) {
                alert("not add staff info :"+data);

              }
        });
                   }, 3000);
                  //$("#Form1").trigger('reset');
                  
              }

           },
            error:function (data) {
              alert("not update fee  info :"+data);
               $("#update").val("update");
               $("#update").prop('disabled', false);

            }
      });


      // return false;
  });
</script>