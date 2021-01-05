<style type="text/css">
.error{
color:red;
font-weight: bold;
font-size: 12px;
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
      <li><a href="<?php echo base_url('module');?>"><?php echo @$title; ?></a></li>
      <li><a href="#">Create <?php echo @$title; ?></a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content ">
      <div class="box box-primary box-solid">
          <div class="box-body">
    <?php $user_id = $this->session->userdata('userId');
    $school = $this->db->where('owner_id', $user_id)->get('schools')->row();
    $result = $this->db->where('user_id', $user_id)->order_by("formProcessId")->get('forms_process')->row();
    //<?php var_dump($result);exit;
    if(count($result)){
    $form_a_status = $result->form_a_status;
    $form_b_status = $result->form_b_status;
    $form_c_status = $result->form_c_status;
    $form_d_status = $result->form_d_status;
    $form_e_status = $result->form_e_status;
    $form_f_status = $result->form_f_status;
    $form_g_status = $result->form_g_status;
    $form_h_status = $result->form_h_status;
    $school_id = $result->school_id;
    $this->db->select('reg_type.*,school.*,session_year.sessionYearTitle,session_year.sessionYearTitle');
    $this->db->from('school');
    $this->db->join('session_year',"school.session_year_id=session_year.sessionYearId");
    $this->db->join('reg_type',"school.reg_type_id=reg_type.regTypeId");

    $this->db->where('schools_id', $schooldata->schoolId);
    $this->db->order_by("session_year_id", "asc");
    $query =$this->db->get();
    //var_dump($schooldata);exit;
    
    $school_sessions=$query->result();
    // echo "<pre>";print_r($school_sessions);exit;
    
    } ?>
    <?php if($schooldata->registrationNumber!='' && $schooldata->registrationNumber!=0): ?>
   <?php $previos_session_id=$this->db->where('schools_id', $schooldata->schoolId)->where('status',1)->order_by("schoolId",'DESC')->get('school')->row()->schoolId; ?>
    <?php //var_dump($school_sessions);exit;
   
    foreach ($school_sessions as $session)
    {
     if($session->status == 1): ?>
    <h3 class=" well text-center text-success"><a href="<?php echo base_url("school/explore_school_by_id/".$session->schoolId."");?>"> Session <?php echo $session->sessionYearTitle ?> <i class="fa fa-check"></i></a></h3>
    <?php
       
    ?>
    <?php elseif($session->status == 0): ?> 
    <h3 class="text-center text-info"> <a class="btn btn-primary" href="javascript:void(0);" onclick='load_form_in_modal("<?php echo $session->schoolId; ?>", "Apply For", "school/school_update_by_school_user_after_copying_data");'> Now Apply for session <?php echo $session->sessionYearTitle ?></i></a></h3>
    <?php
       
    ?>
    <?php elseif($session->status == 2): ?>
    <h3 class=" well text-center text-success"><a href="<?php echo base_url("school/explore_school_by_id/".$session->schoolId."");?>">You have applied for <?php echo $session->regTypeTitle; ?> in session <?php echo $session->sessionYearTitle ?></a></h3>

    
    <?php
       
    ?>
     <?php 
     
       endif;

       if($session->status == 2 OR $session->status == 0 ){
      break;
     }
     } ?>
     
    <?php elseif($form_a_status == 0): ?>
    <!-- Default box -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Create New <?php echo @ucfirst($title); ?></h3>
      </div>
      <div class="box-body">
        <div class="row">
          <!-- col-md-offset-1 -->
          <div class="col-md-12">
            <?php echo validation_errors(); ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="create_form" action="<?php echo base_url('school/create_process');?>">
              <input type="hidden" name="schools_id" value="<?php echo $schooldata->schoolId;?>">
              <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa");?>
              <!-- <input type="hidden" name="createdBy" value="<?php //echo $this->session//->userdata('userId'); ?>" />
              <input type="hidden" name="createdDate" value="<?php //echo $dated; ?>"> -->
              <div class="box-body">
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
                    <input type="radio" name="reg_type_id" <?php echo $reg_type_id_checked; ?>  disabled  class="flat-red" value="<?php echo $reg->regTypeId; ?>"> <?php echo $reg->regTypeTitle; ?>
                  </label>
                  <?php endforeach; ?>
                </div>
                <?php else: ?>
                <h5 class="text-danger">No type found for registration.</h5>
                <?php endif;?>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="name">School Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" required name="name" value="<?php echo $schooldata->schoolName; ?>" <?php if(!empty($schooldata->schoolName)):?> disabled <?php  endif; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="yoe">Year of Establishment:</label>
                  <div class="col-sm-4">
                    <input type="number"  min="1900" max="2099" step="1"  value="<?php echo $schooldata->yearOfEstiblishment; ?>" <?php if(!empty($schooldata->yearOfEstiblishment)):?> disabled <?php  endif; ?> name="yearOfEstiblishment"  class="form-control" id="yoe" />
                  </div>
                  <label class="control-label col-sm-2" for="telePhoneNumber">Tele-phone number (<small>with city code</small>) :</label>
                  <div class="col-sm-4">
                    <input type="text"  name="telePhoneNumber" value="<?php echo $schooldata->telePhoneNumber; ?>"  <?php if(!empty($schooldata->telePhoneNumber)):?> disabled <?php  endif; ?> class="form-control" id="telePhoneNumber" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="uc_id">Select UC:</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" id="uc_id" name="uc_id">
                      <option value="0">Select UC</option>
                      <?php foreach ($ucs_list as $uc_li) : ?>
                      <?php if($uc_li->ucId == $schooldata->uc_id){ $selected = 'selected';}else{ $selected = '';}?>
                      <option value="<?= $uc_li->ucId;?>" <?php echo $selected ?> ><?= $uc_li->ucTitle; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <label class="control-label col-sm-2" for="uc_text">UC Name (<small>If not found in list write name here</small>):</label>
                  <div class="col-sm-4">
                    <?php // echo $schooldata->uc_text; ?>
                    <input type="text" name="uc_text" placeholder="If not found in list write name here"  class="form-control" id="uc_text" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="villageName">Village/City Name:</label>
                  <div class="col-sm-4">
                    <input type="text" required name="address" value="<?php echo $schooldata->address; ?>" class="form-control" id="address" />
                  </div>
                  <label class="control-label col-sm-2" for="location">Select Location:</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" id="location" required name="location">
                      <option>Select Location</option>
                      <?php foreach ($locations as $location) : ?>
                      <?php if($location->locationTitle == $schooldata->location){ $selected = 'selected disabled';}else{ $selected = 'disabled';}?>
                      <option value="<?= $location->locationTitle;?>" <?php echo $selected ?> ><?= $location->locationTitle; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group" style="border:1px solid #d9d9d9; border-radius: 3px; padding: 5px;">
                  <h5><strong class="text-info">GPS Coordinates:</strong></h5>
                  <label class="control-label col-sm-2" for="late">Latitude:</label>
                  <div class="col-sm-4">
                    <input type="number" required placeholder="(Precision upto 6 decimal)" value="<?php set_value('late'); ?>" name="late" class="form-control" id="lat" step="any" />
                  </div>
                  <label class="control-label col-sm-2" for="long">Longitude:</label>
                  <div class="col-sm-4">
                    <input type="number" required value="<?php set_value('longitude'); ?>" name="longitude" placeholder="(Precision upto 6 decimal)" class="form-control" id="long" step="any" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="gender">Gender</label>
                  <?php //echo ; ?>
                  <div class="col-sm-4">
                    <select class="form-control select2" required name="gender_type_id">
                      <option>Select</option>
                      <?php foreach ($gender_of_school as $gender) : ?>
                      <?php if($gender->genderOfSchoolId == $schooldata->gender_type_id){ $selected = 'selected disabled';}else{ $selected = 'disabled';}?>
                      <option value="<?= $gender->genderOfSchoolId;?>" <?php echo $selected ?> ><?= $gender->genderOfSchoolTitle; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <label class="control-label col-sm-2" for="level">Select Level:</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" required id="level" name="level_of_school_id" class="form-control">
                      <option>Select</option>
                      <?php $selected=''; ?>
                      <?php foreach ($level_of_institute as $item) : ?>
                      <?php if($item->levelofInstituteId == $schooldata->level_of_school_id){ $selected = 'selected disabled'; }else{ $selected='disabled'; } ?>
                      <option value="<?= $item->levelofInstituteId;?>" <?php echo $selected ?> > <?= $item->levelofInstituteTitle; ?></option>
                      <?php endforeach; ?>
                      
                      <?php // echo $level_of_institute; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="schoolType">School Type:</label>
                  <div class="col-sm-4">
                    <!--                             <select class="form-control select2" id="schoolType" name="schoolType" class="form-control">
                      <option>School Type</option>
                      <option value="1">Private</option>
                      <option value="2">Public Private Collaboration (PPC)</option>
                      <option value="3">The Citizen’s Foundation</option>
                      <option value="4">Mercy Pak International Schools</option>
                      <option value="5">Bacha Khan Education System</option>
                      <option value="6">Medical technologies</option>
                      <option value="7">Tuition Academy</option>
                      <option value="8">Montessori</option>
                      <option value="9">Kindergarten</option>
                      <option value="10">Center</option>
                    </select> -->
                    <select class="form-control select2" id="schoolType" required name="type_of_institute_id">
                      <?php $selected=''; ?>
                      <?php if(empty($school_types)): ?>
                      <option>no data found</option>
                      <?php else:?>
                      <?php $selected=''; ?>
                      <option>Select</option>
                      <?php foreach ($school_types as $school_type) : ?>
                      <?php if($school_type->typeId == $schooldata->school_type_id){ $selected = 'selected disabled'; }else{ $selected='disabled'; } ?>
                      <option value="<?= $school_type->typeId;?>" <?php echo $selected ?>> <?= $school_type->typeTitle; ?></option>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <?php if($schooldata->school_type_id == 11):?>
                  <label class="control-label col-sm-2" for="schoolTypeOther">Other:</label>
                  <div class="col-sm-4">
                    <input type="text" disabled="disabled" placeholder="<?php echo @$schooldata->schoolTypeOther; ?>"  name="schoolTypeOther" class="form-control" id="schoolTypeOther" />
                  </div>
                  <?php endif;?>
                </div>
                <?php if($schooldata->school_type_id == 2): ?>
                <span><i class="text-info">*</i> <small>If the school is ppc then write the school name of gov school and EMIS code</small></span>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="ppcName">Name of School:</label>
                  <div class="col-sm-4">
                    <input type="text" required placeholder="Enter name of the gov. School"  name="ppcName" class="form-control" disabled id="ppcName" value="<?php echo $schooldata->ppcName; ?>" />
                  </div>
                  <label class="control-label col-sm-2" for="ppcCode">EMIS Code:</label>
                  <div class="col-sm-4">
                    <input type="text" required placeholder="Enter EMIS Code"  name="ppcCode" class="form-control" id="ppcCode" disabled value="<?php echo $schooldata->ppcCode; ?>" />
                  </div>
                </div>
                <?php endif;?>
                <div class="form-group">
                  <div class="col-sm-2">
                    <h5><strong>Medium of Instruction</strong></h5>
                  </div>
                  <div class="col-sm-4">
                    <label class="radio-inline">
                      <input type="radio" name="mediumOfInstruction" required value="Urdu" class="flat-red" checked> Urdu
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="mediumOfInstruction" required value="English" class="flat-red"> English
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="mediumOfInstruction" required value="Both" class="flat-red"> Both
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="biseRegister">BISE Registered:</label>
                  <div class="col-sm-4">
                    <select required="required" class="form-control select2" id="biseRegister" onchange="biseRegisterChanged(this);" required name="biseRegister">
                      <option value="">BISE Registered ?</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <div id="registrationNumberDiv" style="display: none;">
                    <label class="control-label col-sm-2" for="biseregistrationNumber">Registration No.</label>
                    <div class="col-sm-4">
                      <input type="text"  placeholder="Registration Number"  name="biseregistrationNumber" class="form-control" id="biseregistrationNumber" />
                    </div>
                  </div>
                </div>
                <div style="border:1px solid #d9d9d9; border-radius: 3px; padding: 5px;">
                  <div class="form-group">
                    <h5 style="margin-left: 25px"><strong class="text-info">Write date of last registration as per your level of school.</strong></h5>
                    <label class="control-label col-sm-2" for="primaryRegDate">Primary:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control datepicker" id="primaryRegDate" name="primaryRegDate" class="form-control" />
                    </div>
                    <label class="control-label col-sm-2" for="middleRegDate">Middle:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control datepicker" id="middleRegDate" name="middleRegDate" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="highRegDate">High:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control datepicker" id="highRegDate" name="highRegDate" class="form-control" />
                    </div>
                    <label class="control-label col-sm-2" for="interRegDate">H.Secy/Inter College:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control datepicker" id="interRegDate" name="interRegDate" class="form-control" />
                    </div>
                  </div>
                </div>
                <br />
                <div class="form-group">
                  <label class="control-label col-sm-2" for="biseAffiliated">Affiliated with BISE?</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" id="biseAffiliated" onchange="biseAffiliatedChanged(this);" required name="biseAffiliated">
                      <option value="">BISE Affiliated ?</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <span id="biseAffiliatedDiv" style="display: none;">
                    <label class="control-label col-sm-2" for="bise_id">Name of BISE:</label>
                    <div class="col-sm-4">
                      <?php if(!empty($bise_list)): ?>
                      <select class="form-control select2" id="bise_id" name="bise_id" style="width: 100%;" onchange="otherBiseNameFunction(this);">
                        <option value="">Select Name of BISE</option>
                        <?php foreach ($bise_list as $bise) : ?>
                        <option value="<?= $bise->biseId;?>"><?= $bise->biseName; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php else: ?>
                      <h5 class="text-danger">No Bise found.</h5>
                      <?php endif;?>
                      <!--
                      <option value="1">Board of Intermediate and Secondary Education, Peshawar</option>
                      <option value="2">Board of Intermediate and Secondary Education, Mardan</option>
                      <option value="3">Board of Intermediate and Secondary Education, Kohat</option>
                      <option value="4">Board of Intermediate and Secondary Education, Bannu</option>
                      <option value="5">Board of Intermediate and Secondary Education, Dera Ismail Khan</option>
                      <option value="6">Board of Intermediate and Secondary Education, Swat</option>
                      <option value="7">Board of Intermediate and Secondary Education, Abbottabad</option>
                      <option value="8">Board of Intermediate and Secondary Education, Malakand</option> -->
                    </select>
                  </div>
                </span>
              </div>
              <div class="form-group">
                <div id="otherBiseNameDiv" style="display: none;">
                  <label class="control-label col-sm-2" for="otherBiseName">Other BISE Name</label>
                  <div class="col-sm-4">
                    <input type="text"  placeholder="Enter Other BISE Name"  name="otherBiseName" class="form-control" id="otherBiseName" />
                  </div>
                </div>
                <label class="control-label col-sm-2" for="management_id">Nature of Management:</label>
                <div class="col-sm-4">
                  <select required class="form-control select2" id="management_id" name="management_id" required>
                    <option value="">Select Nature of Management</option>
                    <option value="1">Individual</option>
                    <option value="2">Registered Body/Firm</option>
                    <option value="3">Association of Persons</option>
                    <option value="4">Trust</option>
                  </select>
                </div>
                <!--                          <label class="control-label col-sm-2" for="ao">Any Other:</label>
                <div class="col-sm-4">
                  <input type="text"  placeholder="if any other Nature of Management"  name="ao" class="form-control" id="ao" />
                </div> -->
              </div>
              <span style="display: none;"><i class="text-info">Note:</i> <small>(If not managed by an individual, give details of the Members / Partners / Directors / Trustees, as the case may be vide Annex-A.
                Attach a copy of the Constitution Memorandum, Articles of the Association / Trust Deed / Rules and By-laws of such body, as the case may
              be.)</small></span><br>
              <div class="form-group">
                <label class="control-label col-sm-2" for="bankAccountNumber">Bank Account:</label>
                <div class="col-sm-4">
                  <select class="form-control select2" id="banka_acount_details"  onchange="havebankacount(this);" name="banka_acount_details">
                    <option value="">Have Bank Acount ?</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                
              </div>
              <div class="form-group" style="display:none;" id="acountnoandbankname">
                <label class="control-label col-sm-2" >Bank Account No:</label>
                <div class="col-sm-4">
                  <input type="text"  placeholder="Institution Bank Account No"  name="bankAccountNumber" class="form-control" id="BankAccountNumber" />
                </div>
                <label class="control-label col-sm-2">Bank Name:</label>
                <div class="col-sm-4">
                  <input type="text"  name="bankAccountName" placeholder="Enter Bank Name" class="form-control" id="BankAccountName" />
                </div>
              </div>
              <div class="form-group" style="display:none;" id="bankbrachandbankaddress">
                <label class="control-label col-sm-2">Bank Branch Code:</label>
                <div class="col-sm-4">
                  <input type="text"  placeholder="Bank Branch Code"  name="bankBranchCode" class="form-control" id="BankBranchCode" />
                </div>
                <label class="control-label col-sm-2">Bank Branch Address:</label>
                <div class="col-sm-4">
                  <input type="text"  name="bankBranchAddress" placeholder="Enter Bank Branch Address" class="form-control" id="BankBranchAddress" />
                </div>
              </div>
              <div class="form-group" style="display: none;" id="banktitle">
                <div class="col-sm-2 text-right">
                  <h5><strong>Title of Account:</strong></h5>
                </div>
                <div class="col-sm-4">
                  <label class="radio-inline">
                    <input type="radio" name="accountTitle" value="Individual" class="flat-red" checked="checked"> Individual
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="accountTitle" value="Designated" class="flat-red"> Designated
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="accountTitle" value="Joint" class="flat-red"> Joint
                  </label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-sm-offset-2">
                  <button id="submit" type="submit"  style="margin-left:15px;" class="btn btn-primary btn-flat">Add <?php echo @ucfirst($title); ?></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    
  <!-- /.box -->
</section>
<!-- /.content -->
<?php elseif($form_b_status == 0 ):?>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_b/')?><?php echo $school_id;?>" class="btn-link">Continue Form Filling With Section-B</a></h3>
<?php elseif($form_c_status == 0):?>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_c/')?><?php echo $school_id;?>" class="btn-link">Continue Form Filling With Section-C</a></h3>
<?php elseif($form_d_status == 0):?>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_c/')?><?php echo $school_id;?>" class="btn-link">&lt;&lt;Go Back To Section-C</a></h3>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_d/')?><?php echo $school_id;?>" class="btn-link">Continue Form Filling With Section-D</a></h3>
<?php elseif($form_e_status == 0):?>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_e/')?><?php echo $school_id;?>" class="btn-link">Continue Form Filling With Section-E</a></h3>
<?php elseif($form_f_status == 0):?>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_f/')?><?php echo $school_id;?>" class="btn-link">Continue Form Filling With Section-F</a></h3>
<?php elseif($form_g_status == 0):?>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_g/')?><?php echo $school_id;?>" class="btn-link">Continue Form Filling With Section-G</a></h3>
<?php elseif($form_h_status == 0):?>
<h3 class="text-center text-info"><a href="<?php echo base_url('school/form_h/')?><?php echo $school_id;?>" class="btn-link">Continue Form Filling With Section-H</a></h3>
<?php else: ?>
<h3 class="text-center text-success"><a href="<?php echo base_url('school/explore_school_by_id/')?><?php echo $school_id;?>" class="btn-link">School Registration Completed, Click to view the school information.</a></h3>
<?php endif;?>
</div>
</div>
</div>
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="modal_one" role="dialog" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog modal-lg">
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" id="modal_one_title">title will be goes dynamically</h4>
    </div>
    <div id="modal_one_content_goes_here">
      
    </div>
  </div>
  
</div>
</div>
<script type="text/javascript">
function load_form_in_modal(id, title, url) {
// alert(id);
$.ajax({
type: 'POST',
url: "<?php echo base_url('')?>"+url,
data: {"id": id},
success: function(data){
$('#modal_one').modal('show');
$("#modal_one_content_goes_here").html(data);
$("#modal_one_title").html(title);
},
error:function (data) {
// alert("getUcsByTehsilsId :s"+data);
}
});
// $('#myModal').modal('show');
}
function biseRegisterChanged(selected) {
var biseRegistered =  selected.value;
if(biseRegistered == 'Yes' ){
$('#registrationNumberDiv').fadeIn('slow');
}else{
$('#registrationNumberDiv').fadeOut('slow');
}
}
function biseAffiliatedChanged(selected) {
var biseRegistered =  selected.value;
if(biseRegistered == 'Yes' ){
$('#biseAffiliatedDiv').fadeIn('slow');
}else{
$('#biseAffiliatedDiv').fadeOut('slow');
}
}
function havebankacount(selected) {
var acount =  selected.value;
if(acount == 'Yes' ){
$('#acountnoandbankname').fadeIn('slow');
$('#bankbrachandbankaddress').fadeIn('slow');
$('#banktitle').fadeIn('slow');
$('#BankAccountNumber').attr('required','required');
$('#BankAccountName').attr('required','required');
$('#BankBranchCode').attr('required','required');
$('#BankBranchAddress').attr('required','required');
}
else{
$('#acountnoandbankname').fadeOut('slow');
$('#bankbrachandbankaddress').fadeOut('slow');
$('#banktitle').fadeOut('slow');
$('#BankAccountNumber').removeAttr('required');
$('#BankAccountName').removeAttr('required');
$('#BankBranchCode').removeAttr('required');
$('#BankBranchAddress').removeAttr('required');
}
}
function otherBiseNameFunction(selected) {
var id =  selected.value;
if(id == 10 ){
$('#otherBiseNameDiv').fadeIn('slow');
}else{
$('#otherBiseNameDiv').fadeOut('slow');
}
}
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#submit").click(function(event){
var biseAffiliated=$('#biseAffiliated').val();
var biseRegister=$('#biseRegister').val();
var banka_acount_details=$('#banka_acount_details').val();
var uc_id=$('#uc_id').val();
if(uc_id==0)
{
$('#uc_text').attr('required','required');
}
else
{
$('#uc_text').removeAttr('required');
}
/////////
if(biseRegister == "Yes")
{
$('#biseregistrationNumber').attr('required','required');
}
else
{
$('#biseregistrationNumber').removeAttr('required');
}
////////
if(biseAffiliated == "Yes")
{
$('#bise_id').attr('required','required');
}
else
{
$('#bise_id').removeAttr('required');
}
////////
});
});
$( ".datepicker" ).datepicker({
changeMonth:true,
changeYear:true,
appendText:"(dd-mm-yy)",
dateFormat:"dd-mm-yy",
color: "black",
altFormat: "DD, d MM, yy",
yearRange: "-100:+0",
});
</script>