          <div class="row" style="padding: 10px 25px;">
            <!-- col-md-offset-1 -->
                <div class="col-md-12">
                  <?php echo validation_errors(); ?>
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('school/renewal_of_registration_process');?>">
                    <input type="hidden" name="schools_id" value="<?php echo $schooldata->schoolId; ?> ">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa");?>
                    <input type="hidden" name="owner_id" value="<?php echo $owner_id; ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>">
                    <div class="box-body">
                      <?php if(!empty($reg_type)): ?>
                      <div class="form-group">
                        <strong class="col-sm-2 text-right">Registration:</strong>
                        <?php foreach ($reg_type as $reg) : ?>
                          <?php $reg_type_id_checked = ''; ?>
                         <label class="radio-inline col-sm-2">
                          <?php if($reg->regTypeId == 2 ): ?>
                            <?php $reg_type_id_checked = 'checked'; ?>
                          <?php endif; ?>
                          <input type="radio" name="reg_type_id" <?php echo $reg_type_id_checked; ?> class="flat-red" value="<?php echo $reg->regTypeId; ?>"> <?php echo $reg->regTypeTitle; ?>
                         </label>
                         <?php endforeach; ?>
                      </div>
                      <?php else: ?>
                        <h5 class="text-danger">No type found for registration.</h5>
                      <?php endif;?>

                      <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="text-danger">*</span>Session Year</label>
                        <div class="col-sm-6">
                          <?php if(!empty($session_years)): ?>
                        <select class="form-control select2" name="session_year_id" style="width: 100%;">
                            <?php foreach ($session_years as $session_year) : ?>
                              <option value="<?= $session_year->sessionYearId;?>"><?= $session_year->sessionYearTitle; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                          <h5 class="text-danger">No Session Years Found.</h5>
                        <?php endif;?>
                        <div class="col-sm-2">&nbsp;</div>
                      </div>
                      </div>


                      <div class="form-group">
                         <label class="control-label col-sm-2" for="name">School Name:</label>
                         <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" required name="name" value="<?php echo $schooldata->schoolName; ?>" />
                         </div>
                      </div>

                      <div class="form-group">
                         <label class="control-label col-sm-2" for="gender">Gender</label>
                         <?php //echo ; ?>
                         <div class="col-sm-4">
                          <select class="form-control select2" required name="gender_type_id">
                            <?php foreach ($gender_of_school as $gender) : ?>
                              <?php if($gender->genderOfSchoolId == $schooldata->gender_type_id){ $selected = 'selected';}else{ $selected = '';}?>
                              <option value="<?= $gender->genderOfSchoolId;?>" <?php echo $selected ?> ><?= $gender->genderOfSchoolTitle; ?></option>
                            <?php endforeach; ?>
                          </select>
                         </div>
                         <label class="control-label col-sm-2" for="level">Select Level:</label>
                         <div class="col-sm-4">
                            <select class="form-control select2" required id="level" name="level_of_school_id" class="form-control">
                              <?php $selected=''; ?>
                              <?php foreach ($level_of_institute as $item) : ?>
                                <?php if($item->levelofInstituteId == $schooldata->level_of_school_id){ $selected = 'selected'; }else{ $selected=''; } ?>
                                <option value="<?= $item->levelofInstituteId;?>" <?php echo $selected ?> > <?= $item->levelofInstituteTitle; ?></option>
                              <?php endforeach; ?>
                              
                              <?php // echo $level_of_institute; ?>
                            </select>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-sm-2" for="schoolType">School Type:</label>
                         <div class="col-sm-4">
                            <select class="form-control select2" id="schoolType" required name="type_of_institute_id" onchange="schooltypeextra(this);">
                              <?php $selected=''; ?>
                              <?php if(empty($school_types)): ?>
                                <option>no data found</option>
                              <?php else:?>
                                <?php foreach ($school_types as $school_type) : ?>
                                  <?php if($school_type->typeId == $schooldata->school_type_id){ $selected = 'selected'; }else{ $selected=''; } ?>
                                  <option value="<?= $school_type->typeId;?>" <?php echo $selected ?>> <?= $school_type->typeTitle; ?></option>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                         </div>
                         <!-- 11 -->
                         <div id="div11" style="display: none;">
                             <label class="control-label col-sm-2" for="schoolTypeOther">Other:</label>
                             <div class="col-sm-4">
                                <input type="text" placeholder="<?php echo @$schooldata->schoolTypeOther; ?>"  name="schoolTypeOther" class="form-control" id="schoolTypeOther" />
                             </div>
                         </div>

                      </div>
                        <div id="div2" style="display: none;">
                      <span><i class="text-info">*</i> <small>If the school is ppc then write the school name of gov school and EMIS code</small></span>
                      <div class="form-group">
                         <label class="control-label col-sm-2" for="ppcName">Name of School:</label>
                         <div class="col-sm-4">
                            <input type="text" placeholder="Enter name of the gov. School"  name="ppcName" class="form-control" id="ppcName" value="<?php echo $schooldata->ppcName; ?>" />
                         </div>
                         <label class="control-label col-sm-2" for="ppcCode">EMIS Code:</label>
                         <div class="col-sm-4">
                            <input type="text" placeholder="Enter EMIS Code"  name="ppcCode" class="form-control" id="ppcCode" value="<?php echo $schooldata->ppcCode; ?>" />
                         </div>
                      </div>
                        </div>
                      <div class="form-group">
                          <div class="col-md-2 col-sm-offset-10">
                              <button type="submit"  style="margin-left:15px;" class="btn btn-primary btn-flat">Proceed</button>
                          </div>
                      </div>
                    </div>
                  </form>

                </div>
            </div>

<script type="text/javascript">
   function schooltypeextra(ar) {
    if(ar.value == 2 || ar.value == 11){
        if(ar.value == 2){
          $("#div2").show();
          $("#div11").hide();
        }else{
            $("#div11").show();
            $("#div2").hide();
        }
    }else{
      $("#div11").hide();
      $("#div2").hide();
    }

   }
</script>