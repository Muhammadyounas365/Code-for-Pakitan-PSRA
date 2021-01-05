<style type="text/css">
  @media print {
  .small_font{
  font-size: 8px;
  }
  .page_break_before{
  page-break-before: always;
  margin-top: 35px;
  }
}
.shadow {
  -webkit-box-shadow: 3px 3px 5px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
  -moz-box-shadow:    3px 3px 5px 6px #ccc;  /* Firefox 3.5 - 3.6 */
  box-shadow:         3px 3px 5px 6px #ccc;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
}
.page-header {
    padding-bottom: 19px;
    margin: 40px 0 20px;
    border-bottom: 1px solid #ccc;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    School
    <small>details</small>
    </h1>
    <!--       <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Invoice</li>
    </ol> -->
  </section>
  <!-- Main content -->
  <?php //var_dump($school);exit; ?>
  <section class="invoice" style="border:1px solid #ccc;">
    <!-- title row -->
    <div class="row page_break_before light-blue">
      <div class="col-xs-12">
        <h2 class="page-header" style="font-weight: bolder;height:  auto;">
        <i class="fa fa-university"></i> <?php echo @$school->schoolName; ?> &nbsp;&nbsp;&nbsp; <?php if(!empty($school->ppcCode)){ echo "PPC Code".$school->ppcCode; }?>
        <small class="pull-right" style="color:red;font-weight: bolder;"><?php echo @$school->regTypeTitle; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    
    <!-- info row -->
    <div class="row invoice-info light-blue" style="margin-bottom: 20px;">
      <div class="col-sm-4 invoice-col ">
        <address>
          <strong>About School</strong><br>
          <strong>School Id #<b style="color:red;font-size: 16px;"><?php echo $school->schoolId; ?></b></strong><br />
          
          
          <strong>Session Year: <?php echo @$school->sessionYearTitle; ?></strong><br />
          <strong>Registration #
          <?php if($school->registrationNumber != 0 ): ?>
          <?php echo @$school->registrationNumber; ?><?php endif; ?>
          </strong><br />
          <?php if(!empty($school->yearOfEstiblishment)): ?>
          <?php echo "Established In: ".$school->yearOfEstiblishment; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->telePhoneNumber)): ?>
          <?php echo "Tele-Phone #: ".$school->telePhoneNumber; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->genderOfSchoolTitle)): ?>
          <?php echo "School For: ".$school->genderOfSchoolTitle; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->levelofInstituteTitle)): ?>
          <?php echo "School Level: ".$school->levelofInstituteTitle; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->typeTitle)): ?>
          <?php echo "School System: ".$school->typeTitle; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->schoolTypeOther)): ?>
          <?php echo "School Level: ".$school->schoolTypeOther; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->mediumOfInstruction)): ?>
          <?php echo "Medium Of Instruction: ".$school->mediumOfInstruction; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->managementTitle)): ?>
          <?php echo "Management: ".$school->managementTitle; ?>
          <br>
          <?php endif; ?>
          
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col ">
        <address>
          <strong>Adress</strong><br>
          <?php if(!empty($school->location)): ?>
          <?php echo "Located In: ".$school->location; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->districtTitle)): ?>
          <?php echo "District: ".$school->districtTitle; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->tehsilTitle)): ?>
          <?php echo "Tehsil: ".$school->tehsilTitle; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->pkNo)): ?>
          <?php echo "Pk: ".$school->pkNo; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->ucTitle)): ?>
          <?php echo "Uc: ".$school->ucTitle; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school->address)): ?>
          <?php echo $school->address; ?>
          <br />
          <?php endif; ?>
          
          <?php if(!empty($school->late)): ?>
          <b>Latitude:</b>
          <?php echo @$school->late; ?>
          <br />
          <?php endif; ?>
          <?php if(!empty($school->longitude)): ?>
          <b>Longitude:</b>
          <?php echo @$school->longitude; ?>
          <?php endif; ?>
        </address>
        <strong>View Location: </strong><a onclick="sendCordinates(<?php echo $school->late;?>,<?php echo $school->longitude;?>);" data-toggle="modal" data-target="#viewMap" href="#" style="font-size: 20px;padding-top: 10px; text-decoration: none;" class="glyphicon glyphicon-map-marker btn btn-default"></a>
        
      </div>
      
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Bise Information</b><br>
        <?php if(!empty($school->biseregistrationNumber)): ?>
        <?php echo "Bise Register: ".$school->biseregistrationNumber; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($school->primaryRegDate)): ?>
        <?php echo "Primary Registeration Date: ".$school->primaryRegDate; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($school->middleRegDate)): ?>
        <?php echo "Middle Registeration Date: ".$school->middleRegDate; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($school->highRegDate)): ?>
        <?php echo "High Registeration Date: ".$school->highRegDate; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($school->interRegDate)): ?>
        <?php echo "H.Secy/Inter College Registeration Date: ".$school->interRegDate; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($school->biseAffiliated)): ?>
        <?php echo "Bise Affiliation: ".$school->biseAffiliated; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($school->biseName) && $school->bise_id != 10): ?>
        <?php echo "Bise Affiliated With: ".$school->biseName; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($school->otherBiseName)): ?>
        <?php echo "Bise Affiliated With: ".$school->otherBiseName; ?>
        <br>
        <?php endif; ?>
        <?php if(!empty($bank_transaction)): ?>
        <?php $count=1; foreach($bank_transaction as $bt){
          echo "<strong>Transaction</strong> # $count: ".$bt['bt_no'].' '."<strong> Date</strong>: ". $bt['bt_date']."<br>"; $count++;
        }  ?>
        <br>
        <?php endif; ?>
      </div>
      <!-- /.col -->
      <div class="clearfix"></div>
     
      
    </div>
    <!-- /.row -->
    <?php if(!empty($school_bank->bankAccountNumber)): ?>
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1">
        <p class="lead">Account Information</p>
        <div class="table-responsive">
          <table class="table table-striped">
            <tr>
              <th style="width:50%">Account Name:</th>
              <td><?php if($school_bank->bankAccountName){ echo $school_bank->bankAccountName; } ?></td>
            </tr>
            <tr>
              <th>Account Number:</th>
              <td><?php if($school_bank->bankAccountNumber){ echo $school_bank->bankAccountNumber; } ?></td>
            </tr>
            <tr>
              <th>Branch Code</th>
              <td><?php if($school_bank->bankBranchCode){ echo $school_bank->bankBranchCode; } ?></td>
            </tr>
            <tr>
              <th>Account Title:</th>
              <td><?php if($school_bank->accountTitle){ echo $school_bank->accountTitle; } ?></td>
            </tr>
            <tr>
              <th>Branch Address:</th>
              <td><?php if($school_bank->bankBranchAddress){ echo $school_bank->bankBranchAddress; } ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php endif; ?>
    <div class="clearfix"></div>
    <!-- Table row -->
    <div class="row page_break_before" style="min-height: 200px;">
      <h3 style="font-weight: bolder;color:#fff;background-color: black;padding:5px;width:auto;max-width: 500px;margin:0 auto;border-radius:5px;font-size:16px;" class="lead text-center"> Section-B: Physical Facilities</h3>
      <div class="col-xs-12  table-responsive">
        <table class="table table-bordered table-striped">
          <tbody>
            <?php if(count($school_physical_facilities)) { ?>
            <tr>
              <td style="width:50%;"><b>Building</b></td>
              <td><?php echo $school_physical_facilities->physicalBuildingTitle;?></td>
            </tr>
            <?php if(!empty($school_physical_facilities->numberOfClassRoom)): ?>
            <tr>
              <td><b>Class Rooms</b></td>
              <td>
                <?php echo $school_physical_facilities->numberOfClassRoom; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_physical_facilities->numberOfOtherRoom)): ?>
            <tr>
              <td><b>Other Rooms</b></td>
              <td>
                <?php echo $school_physical_facilities->numberOfOtherRoom; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_physical_facilities->totalArea)): ?>
            <tr>
              <td><b>Total Area</b></td>
              <td>
                <?php echo $school_physical_facilities->totalArea; ?> Marlas
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_physical_facilities->coveredArea)): ?>
            <tr>
              <td><b>Covered Area</b></td>
              <td>
                <?php echo $school_physical_facilities->coveredArea; ?> Marlas
              </td>
            </tr>
            <?php endif; ?>
            
            <?php $physical_count = count($school_physical_facilities_physical);?>
            <?php if($physical_count > 0): ?>
            <tr>
              <td><b>Physical Facilities Availible</b></td>
              <td>
                <?php $counter =1;?>
                <?php foreach($school_physical_facilities_physical as $physical): ?>
                <?php echo $physical->physicalTitle;?>
                <?php if($physical_count == $counter):?>
                <?php echo ".";?>
                <?php else: ?>,
                <?php endif;?>
                <?php $counter++; ?>
                <?php endforeach; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_physical_facilities->numberOfLatrines)): ?>
            <tr>
              <td><b>Number Of Latrines</b></td>
              <td>
                <?php echo $school_physical_facilities->numberOfLatrines; ?>
              </td>
            </tr>
            <?php endif; ?>
            
            <?php $academic_count = count($school_physical_facilities_academic);?>
            <?php if($academic_count > 0): ?>
            <tr>
              <td><b>academic Facilities Availible</b></td>
              <td>
                <?php $counter =1;?>
                <?php foreach($school_physical_facilities_academic as $academic): ?>
                <?php echo $academic->academicTitle;?>
                <?php if($physical_count == $counter):?>
                <?php echo ".";?>
                <?php else: ?>,
                <?php endif;?>
                <?php $counter++; ?>
                <?php endforeach; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_physical_facilities->numberOfComputer)): ?>
            <tr>
              <td><b>Number Of Computer</b></td>
              <td>
                <?php echo $school_physical_facilities->numberOfComputer; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php $curricular_count = count($school_physical_facilities_co_curricular);?>
            <?php if($curricular_count > 0): ?>
            <tr>
              <td><b>Co curricular Facilities Availible</b></td>
              <td>
                <?php $counter =1;?>
                <?php foreach($school_physical_facilities_co_curricular as $curricular): ?>
                <?php echo $curricular->coCurricularTitle;?>
                <?php if($curricular_count == $counter):?>
                <?php echo ".";?>
                <?php else: ?>,
                <?php endif;?>
                <?php $counter++; ?>
                <?php endforeach; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php $other_count = count($school_physical_facilities_other);?>
            <?php if($other_count > 0): ?>
            <tr>
              <td><b>Other Facilities Availible</b></td>
              <td>
                <?php $counter =1;?>
                <?php foreach($school_physical_facilities_other as $other): ?>
                <?php echo $other->otherTitle;?>
                <?php if($other_count == $counter):?>
                <?php echo ".";?>
                <?php else: ?>,
                <?php endif;?>
                <?php $counter++; ?>
                <?php endforeach; ?>
              </td>
            </tr>
            <?php endif; ?>
            <tr><td  colspan="2" class="text-center">
              <?php if($school->status!=1) { ?>
              <button type="button" onclick="load_form_in_modal(<?php echo $schoolId; ?>, 'Edit Physical Facilities', 'School/physical_facilities_view_edit');" class="btn btn-flat btn-sm btn-primary no-print"><i class="fa fa-edit"></i> Edit Physical Facilities
              </button>
              <?php } ?>
            </td></tr>
            <?php }
            else
            { ?>
            <tr><td class="text-center" colspan="2" id="empty_td_staff"><h3 class="text-center" style="color:red;">No  Physical Facility Added Yet.</h3>
            <?php if($school->status==2) { ?>
             <a class=" btn btn-primary" href="<?php echo base_url('school/add_section_b/'.$schoolId); ?>" title="Add Physical Facilities" > &nbsp;<i class="fa fa-plus"></i>Add Physical Facilities</a>
             <?php } ?>
            
            
            </td></tr>
            <?php } ?>
            <tr><td colspan="2" class="text-center"><strong style="font-size: 20px;">Library details</strong></td></tr>
            <?php $library_count = count($school_library);?>
            <?php if($library_count > 0): ?>
            
            <?php foreach($school_library as $library): ?>
            <tr id="lib_row_<?php echo $library->schoolLibraryId; ?>">
              <td style="width:50%;"><b><?php echo $library->bookType; ?></b></td>
              <td>
                <?php echo $library->numberOfBooks;?>
                <span class="pull-right no-print">
                <?php if($school->status!=1) { ?>
                  <a href="javascript:void(0);" title="Delete Staff" onclick="delete_record_by_id(<?php echo $library->schoolLibraryId; ?>, 'schoolLibraryId', 'school_library', 'lib_row_');" > &nbsp;<i class="fa fa-trash-o text-danger"></i>
                  </a>
                  <?php } ?>
                </span>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            <td colspan="2" class="text-center">
              <?php if($school->status!=1) { ?>
              <button type="button" onclick="load_form_in_modal(<?php echo $schoolId; ?>, 'Add Book In Library', 'School/add_books_in_library_view');" class="btn btn-flat btn-sm btn-primary no-print"><i class="fa fa-plus"></i> Add Books
              </button>
              <?php } ?>
            </td>
            
          </tbody>
        </table>
        
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row page_break_before" style="min-height: 200px;">
      <h3 style="font-weight: bolder;color:#fff;background-color: black;padding:5px;width:auto;max-width: 500px;margin:0 auto;border-radius:5px;font-size:16px;" class="lead text-center">Section-C: Class & Age Wise Enrollement</h3>
      <div class="col-xs-12 table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Class</th>
              <th>Age</th>
              <th>Gender</th>
              <th>Enrolled</th>
              <th class="no-print" style="width: 250px;">&nbsp;</th>
            </tr>
          </thead>
          <tbody id="enrolled_tbody">
            <?php $counter = 1;?>
            <?php $total_enrolled = 0;?>
            
            <?php foreach($age_and_class as $ac): ?>
            <tr id="enrolled_row_<?php echo $ac->ageAndClassId; ?>">
              <td><?php echo $counter; ?></td>
              <td><?php echo $ac->classTitle; ?></td>
              <td><?php echo $ac->ageTitle; ?></td>
              <td><?php echo $ac->studentGenderTitle; ?></td>
              <td><?php echo $ac->enrolled; ?></td>
              <td class="no-print">
              <?php if($school->status!=1) { ?>
                <a href="javascript:void(0);" title="Delete Enrollement" onclick="delete_record_by_id(<?php echo $ac->ageAndClassId; ?>, 'ageAndClassId', 'age_and_class', 'enrolled_row_');" > &nbsp;<i class="fa fa-trash-o text-danger"></i>
                </a>
                <?php } ?>
              </td>
              <?php $total_enrolled = $total_enrolled + $ac->enrolled; ?>
            </tr>
            <?php $counter++; ?>
            <?php endforeach; ?>
            <tr class="append_total_enrolled">
              <td colspan="4" class="text-center"><strong>Total Enrolled</strong></td>
              <td><strong><?php echo $total_enrolled; ?></strong></td>
              <td class="no-print">&nbsp;</td>
            </tr>
            <tr> <td  colspan="6" class="text-center"> 
            <?php if($school->status!=1) { ?>
            <button type="button" onclick="load_form_in_modal(<?php echo $schoolId; ?>, 'Add New Enrollement To School', 'School/school_enrollement_add_ajax');" class="btn btn-flat btn-sm btn-primary no-print"><i class="fa fa-plus"></i> Add Enrollement
            </button>
            <?php } ?>

            </td></tr>
          </tbody>
        </table>
        
        
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row page_break_before" style="min-height: 200px;">
      <h3 style="font-weight: bolder;color:#fff;background-color: black;padding:5px;width:auto;max-width: 500px;margin:0 auto;border-radius:5px;font-size:16px;" class="lead text-center"> Section-D: Staff Detail</h3>
      <div class="col-xs-12 table-responsive">
        <table class="table table-bordered table-condensed table-striped">
          <thead class="small_font">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th class="text-center">F/Husband Name</th>
              <th>CNIC</th>
              <th>Gender</th>
              <th>Type</th>
              <th>Academic</th>
              <th>Professional</th>
              <th class="text-center">Training <br> In Months</th>
              <th class="text-center">Experience <br> In Months</th>
              <th>Designation</th>
              <th class="text-center">Appointment At</th>
              <th>Net.Pay</th>
              <th class="text-center">annual <br>Increament</th>
              <th class="no-print">Action</th>
            </tr>
          </thead>
          <tbody class="small_font" id="staff_tbody">
            <?php $counter = 1;?>
            <?php if(!empty($school_staff)): ?>
            <?php foreach($school_staff as $st): ?>
            <tr id="staff_row_<?php echo $st->schoolStaffId; ?>">
              <td><?php echo $counter; ?></td>
              <td><?php echo $st->schoolStaffName; ?></td>
              <td><?php echo $st->schoolStaffFatherOrHusband; ?></td>
              <td><?php echo $st->schoolStaffCnic; ?></td>
              <td><?php echo $st->genderTitle; ?></td>
              <td><?php echo $st->staffTtitle; ?></td>
              <td><?php echo $st->schoolStaffQaulificationAcademic; ?></td>
              <td><?php echo $st->schoolStaffQaulificationProfessional; ?></td>
              <td><?php echo $st->TeacherTraining; ?></td>
              <td><?php echo $st->TeacherExperience; ?></td>
              <td><?php echo $st->schoolStaffDesignition; ?></td>
              <td><?php echo $st->schoolStaffAppointmentDate; ?></td>
              <td><?php echo $st->schoolStaffNetPay; ?></td>
              <td><?php echo $st->schoolStaffAnnualIncreament; ?></td>
              <td class="no-print" style="width: 250px;">
              <?php if($school->status!=1) { ?>
              <a href="javascript:void(0);" onclick="load_form_in_modal(<?php echo $st->schoolStaffId; ?>, 'Staff Update', 'School/school_staff_edit_by_id')"> &nbsp;<i class="fa fa-edit"></i></a>
              <a href="javascript:void(0);" title="Delete Staff" onclick=" delete_record_by_id(<?php echo $st->schoolStaffId; ?>, 'schoolStaffId', 'school_staff', 'staff_row_');" > &nbsp;<i class="fa fa-trash-o text-danger"></i>
              </a>
              <?php } ?>
              </td>
            </tr>
            <?php $counter++; ?>
            <?php endforeach; ?>
            <?php else:?>
            <td colspan="15" id="empty_td_staff"><h3 class="text-center" style="color:red;">No Staff Added Yet.</h3></td>
            <?php endif;?>
          </tbody>
        </table>
        <?php if($school->status!=1) { ?>
        <button type="button" onclick="load_form_in_modal(<?php echo $schoolId; ?>, 'Add New Staff Member To School', 'School/school_staff_add_ajax');" class="btn btn-flat btn-sm btn-primary no-print"><i class="fa fa-plus"></i> Add Staff
        </button>
        <?php } ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row page_break_before" style="min-height: 200px;">
      <h3 style="font-weight: bolder;color:#fff;background-color: black;padding:5px;width:auto;max-width: 500px;margin:0 auto;border-radius:5px;font-size:16px;" class="lead text-center">Section-E: Student Dues/Funds Details</h3>
      <div class="col-xs-12 table-responsive">
        <table class="table table-bordered table-condensed table-striped">
          <thead class="small_font">
            <tr>
              <th>#</th>
              <th>Class</th>
              <th>Addmission Fee</th>
              <th>Monthly Tuition Fee</th>
              <th>Security Fund</th>
              <th>Other Fund</th>
              <th class="no-print">Action</th>
            </tr>
          </thead>
          <tbody class="small_font" id="fund_tbody">
            <?php  $counter = 1;
            if(count($school_fee)) { ?>
            <?php foreach($school_fee as $fe): ?>
            <tr id="fund_row_<?php echo $fe->feeId; ?>">
              <td><?php echo $counter; ?></td>
              <td><?php echo $fe->classTitle; ?></td>
              <td><?php echo $fe->addmissionFee; ?></td>
              <td><?php echo $fe->tuitionFee; ?></td>
              <td><?php echo $fe->securityFund; ?></td>
              <td><?php echo $fe->otherFund; ?></td>
              <td class="no-print" style="width: 250px;">
              <?php if($school->status!=1) { ?>
              <a href="javascript:void(0);" onclick="load_form_in_modal(<?php echo $fe->feeId; ?>, 'Fee Update', 'school/school_fee_edit_by_id')"> &nbsp;<i class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" title="Delete Dues/Fund" onclick="delete_record_by_id(<?php echo $fe->feeId; ?>, 'feeId', 'fee', 'fund_row_');" > &nbsp;<i class="fa fa-trash-o text-danger"></i>
                </a>
                <?php } ?>
              </td>
            </tr>
            <?php $counter++; ?>
            <?php endforeach; ?>
            <?php } 
            else
            { ?>
    
    
    <td colspan="7" id="empty_td_fee"><h3 class="text-center" style="color:red;">Not Added Yet.</h3></td>
    <?php } ?>
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-8">
            Whether the above fees are mentioned in the prospectus/admission form <strong>
            <?php if(!empty($school_fee_mentioned_in_form)){ ?>
            <?php echo $school_fee_mentioned_in_form->feeMentionedInForm; ?>
            <?php } ?>
            </strong>
          </div>
          
        </div>
        <?php if($school->status!=1) { ?>
        <button type="button" onclick="load_form_in_modal(<?php echo $schoolId; ?>, 'Add Student Dues/Funds Details To School', 'School/school_fund_add_ajax');" class="btn btn-flat btn-sm btn-primary no-print"><i class="fa fa-plus"></i> Add Student Dues/Funds Details
        </button>
        <?php } ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row page_break_before" style="min-height:200px;">
      <h3 style="font-weight: bolder;color:#fff;background-color: black;padding:5px;width:auto;max-width: 500px;margin:0 auto;border-radius:5px;font-size:16px;" class="lead text-center"> Section-F: SECURITY MEASURES</h3>
      <div class="col-xs-12 table-responsive">
        <table class="table table-bordered table-striped">
          <tbody>
      <?php if(count($school_security_measures)) { ?>
      
            
            <tr>
              <td style="width:50%;"><b>Security Status</b></td>
              <td><?php echo $school_security_measures->securityStatusTitle;?></td>
            </tr>
            <?php if(!empty($school_security_measures->securityProvidedTitle)): ?>
            <tr>
              <td><b>Security Provided</b></td>
              <td>
                <?php echo $school_security_measures->securityProvidedTitle; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->SecurityPersonnelTitle)): ?>
            <tr>
              <td><b>Security Personnel (in Nos)</b></td>
              <td>
                <?php echo $school_security_measures->SecurityPersonnelTitle; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->securityPersonnel)): ?>
            <tr>
              <td><b>Status of Security personnel</b></td>
              <td>
                <?php echo $school_security_measures->securityPersonnel; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->security_according_to_police_dept)): ?>
            <tr>
              <td><b>Security is inline with instruction of Police Department</b></td>
              <td>
                <?php echo $school_security_measures->security_according_to_police_dept; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->cameraInstallation)): ?>
            <tr>
              <td><b>CCTVs Camera System Installed</b></td>
              <td>
                <?php echo $school_security_measures->cameraInstallation; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->camraNumber)): ?>
            <tr>
              <td><b>Number of CCTVs Cameras</b></td>
              <td>
                <?php echo $school_security_measures->camraNumber; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->dvrMaintained)): ?>
            <tr>
              <td><b>DVR Maintained</b></td>
              <td>
                <?php echo $school_security_measures->dvrMaintained; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->cameraOnline)): ?>
            <tr>
              <td><b>CCTVs Online Accessibility</b></td>
              <td>
                <?php echo $school_security_measures->cameraOnline; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->exitDoorsNumber)): ?>
            <tr>
              <td><b>Number of Exit Doors</b></td>
              <td>
                <?php echo $school_security_measures->exitDoorsNumber; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->emergencyDoorsNumber)): ?>
            <tr>
              <td><b>Emergency Exit Door Availability</b></td>
              <td>
                <?php echo $school_security_measures->emergencyDoorsNumber; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->boundryWallHeight)): ?>
            <tr>
              <td><b>Boundary Wall Height (In Feet)</b></td>
              <td>
                <?php echo $school_security_measures->boundryWallHeight; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->wiresProvided)): ?>
            <tr>
              <td><b>Barbed Wires Provided</b></td>
              <td>
                <?php echo $school_security_measures->wiresProvided; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->watchTower)): ?>
            <tr>
              <td><b>Watch Tower</b></td>
              <td>
                <?php echo $school_security_measures->watchTower; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->licensedWeapon)): ?>
            <tr>
              <td><b>Number of Licensed Weapon(s)</b></td>
              <td>
                <?php echo $school_security_measures->licensedWeapon; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->licenseIssuedTitle)): ?>
            <tr>
              <td><b>License issued by</b></td>
              <td>
                <?php echo $school_security_measures->licenseIssuedTitle; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->licenseNumber)): ?>
            <tr>
              <td><b>License No(s)</b></td>
              <td>
                <?php echo $school_security_measures->licenseNumber; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->ammunitionStatus)): ?>
            <tr>
              <td><b>Ammunition Status (In Nos.)</b></td>
              <td>
                <?php echo $school_security_measures->ammunitionStatus; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->metalDetector)): ?>
            <tr>
              <td><b>Metal Detector</b></td>
              <td>
                <?php echo $school_security_measures->metalDetector; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->walkThroughGate)): ?>
            <tr>
              <td><b>Walkthrough gate</b></td>
              <td>
                <?php echo $school_security_measures->walkThroughGate; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_security_measures->gateBarrier)): ?>
            <tr>
              <td><b>Main Gate Barrier</b></td>
              <td>
                <?php echo $school_security_measures->gateBarrier; ?>
              </td>
            </tr>
            <?php endif; ?>
            
         <tr><td>
         <?php if($school->status!=1) { ?>
        <button type="button" onclick="load_form_in_modal(<?php echo $schoolId; ?>, 'Edit Security Measures', 'School/security_measures_edit_view_ajax_modal');" class="btn btn-flat btn-sm btn-primary no-print"><i class="fa fa-edit"></i> Edit Security Measure
        </button>
        <?php } ?>

    </td></tr>
    <!-- /.row -->
     <?php }
    else
    { ?>
    
    
    <td class="text-center" colspan="4" id="empty_td_staff"><h3 class="text-center" style="color:red;">Not Added Yet.</h3>
    <?php if($school->status==2) { ?>
   <a class=" btn btn-primary" href="<?php echo base_url('school/add_section_f/'.$schoolId); ?>" title="Add Security Measures" > &nbsp;<i class="fa fa-plus"></i>Add Security Measures </a>
   <?php } ?>

    </td>
    <?php } ?>

     </tbody>
        </table>
          </div>
      <!-- /.col -->
    </div>
    <!-- Table row -->
    <div class="row page_break_before" style="min-height: 200px;">
      <h3 style="font-weight: bolder;color:#fff;background-color: black;padding:5px;width:auto;max-width: 500px;margin:0 auto;border-radius:5px;font-size:16px;" class="lead text-center">Section-G: HAZARDS WITH ASSOCIATED RISKS</h3>
      <div class="col-xs-12  table-responsive">
        <table class="table table-bordered table-striped">
          <tbody>
      <?php if(count($school_hazards_with_associated_risks)) { ?>
      
            <td></td>
            <tr>
              <td style="width:50%;"><b>Exposed to floods</b></td>
              <td><?php echo $school_hazards_with_associated_risks->exposedToFlood;?></td>
            </tr>
            <?php if(!empty($school_hazards_with_associated_risks->drowning)): ?>
            <tr>
              <td><b>Drowning (In case of nearby canal)</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->drowning; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->buildingCondition)): ?>
            <tr>
              <td><b>School Building Condition (Walls, Doors, windows)</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->buildingCondition; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->accessRoute)): ?>
            <tr>
              <td><b>School Access route</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->accessRoute; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php $hazards_with_associated_risks_unsafe_list_count = count($hazards_with_associated_risks_unsafe_list);?>
            <?php if($hazards_with_associated_risks_unsafe_list_count > 0): ?>
            <tr>
              <td><b>In case of unsafe Access route</b></td>
              <td>
                <?php $counter1 =1;?>
                <?php foreach($hazards_with_associated_risks_unsafe_list as $hz_list_item): ?>
                <?php echo $hz_list_item->unSafeListTitle;?>
                <?php if($hazards_with_associated_risks_unsafe_list_count == $counter1):?>
                <?php echo ".";?>
                <?php else: ?>,
                <?php endif;?>
                <?php $counter1++; ?>
                <?php endforeach; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->adjacentBuilding)): ?>
            <tr>
              <td><b>Other buildings adjacent to School</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->adjacentBuilding; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->safeAssemblyPointsAvailable)): ?>
            <tr>
              <td><b>Safe assembly points available for <br>(i. Flood ii. Earthquake iii. Fire iii. Human induce)</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->safeAssemblyPointsAvailable; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->disasterTraining)): ?>
            <tr>
              <td><b>Teacher trained on School Based Disaster Risk Management</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->disasterTraining; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->schoolImprovementPlan)): ?>
            <tr>
              <td><b>School Improvement plan developed</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->schoolImprovementPlan; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->schoolDisasterManagementPlan)): ?>
            <tr>
              <td><b>School Disaster Management plan developed</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->schoolDisasterManagementPlan; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->electrificationTitle)): ?>
            <tr>
              <td><b>Electrification condition</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->electrificationTitle; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->ventilationSystemAvailable)): ?>
            <tr>
              <td><b>Proper ventilation system available</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->ventilationSystemAvailable; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->chemicalsSchoolLaboratory)): ?>
            <tr>
              <td><b>Expose to Chemicals in School Laboratory</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->chemicalsSchoolLaboratory; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->chemicalsSchoolSurrounding)): ?>
            <tr>
              <td><b>Expose to Chemicals in school surrounding</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->chemicalsSchoolSurrounding; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->roadAccident)): ?>
            <tr>
              <td><b>Exposed to road accident</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->roadAccident; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->safeDrinkingWaterAvailable)): ?>
            <tr>
              <td><b>Safe drinking water available</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->safeDrinkingWaterAvailable; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->sanitationFacilities)): ?>
            <tr>
              <td><b>Proper sanitation facilities available (Latrine, draining)</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->sanitationFacilities; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->buildingStructure)): ?>
            <tr>
              <td><b>School Building Structure</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->buildingStructure; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($school_hazards_with_associated_risks->hazardsSurroundedTitle)): ?>
            <tr>
              <td><b>School surrounded by the community</b></td>
              <td>
                <?php echo $school_hazards_with_associated_risks->hazardsSurroundedTitle; ?>
              </td>
            </tr>
            <?php endif; ?>
            
         <tr> <td colspan="2">
         <?php if($school->status!=1) { ?>
        <button type="button" onclick="load_form_in_modal(<?php echo $schoolId; ?>, 'Edit Hazards With Associated Risks', 'School/hazard_risk_edit_view_ajax_modal');" class="btn btn-flat btn-sm btn-primary no-print"><i class="fa fa-edit"></i> Edit Hazards With Associated Risks
        </button>
        <?php } ?>
        <td></tr>
      
      <?php }
      else
      {
      ?>
      <tr><td class="text-center" colspan="2" id="empty_td_staff"><h3 class="text-center" style="color:red;">Not Added Yet.</h3>
      <?php if($school->status==2) { ?>
       <a class=" btn btn-primary" href="<?php echo base_url('school/add_section_g/'.$schoolId); ?>" title="Add Hazard With Associated Risks" > &nbsp;<i class="fa fa-plus"></i>Add Hazard With Associated Risks</a>
       <?php } ?>

      </td></tr>
      <?php } ?>
      <!-- /.col -->
      </tbody>
        </table>
        </div>
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row page_break_before" style="min-height: 200px;">
      <h3 style="font-weight: bolder;color:#fff;background-color: black;padding:5px;width:auto;max-width: 500px;margin:0 auto;border-radius:5px;font-size:16px;" class="lead text-center">Section-H: Fee Concession</h3>
      <div class="col-xs-12  table-responsive">
        <table class="table table-bordered table-condensed table-striped">
          <thead class="small_font">
            <tr>
              <th>#</th>
              <th>Concession Type</th>
              <th>Percentage</th>
              <th>Number Of Student</th>
              <th class='no-print'>Action</th>
            </tr>
          </thead>
          <tbody class="small_font">
            <?php $counter = 1;?>
            <?php if(count($school_fee_concession)) { ?>
            <?php foreach($school_fee_concession as $fee_con): ?>
            <tr>
              <td><?php echo $counter; ?></td>
              <td><?php echo $fee_con->concessionTypeTitle; ?></td>
              <td><?php echo $fee_con->percentage; ?></td>
              <td><?php echo $fee_con->numberOfStudent; ?></td>
              <td class="no-print">
               <?php if($school->status!=1) { ?>
              <a href="javascript:void(0);" onclick="load_form_in_modal(<?php echo $fee_con->feeConcessionId ; ?>, 'Fee Concession Update', 'school/fee_concession_edit_by_id')"> &nbsp;<i class="fa fa-edit"></i></a>
              <?php } ?>
             </td>
            </tr>
            <?php $counter++; ?>
            <?php endforeach; ?>
            <?php }
            else
            { ?>
            
            
            <td class="text-center" colspan="5" id=""><h3  style="color:red;">Not Added Yet.</h3>
            <?php if($school->status==2) { ?>
             <a class=" btn btn-primary" href="<?php echo base_url('school/add_section_h/'.$schoolId); ?>" title="Add Fee Concession" > &nbsp;<i class="fa fa-plus"></i>Add Fee Concession</a>
             <?php } ?>

            </td>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- <button onclick="get_last_inserted_row(1172, 'School/get_staff_record_by_id', 'staff_row_')">Click to show modal</button> -->
    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <!--  <a href="#" target="_blank" class="btn btn-default" onClick="window.print();return false"><i class="fa fa-print"></i> Print</a> -->
        <a href="#" target="_blank" class="btn btn-primary btn-flat pull-right" onClick="window.print();return false"><i class="fa fa-print"></i> Print</a>
        <span style="display: none;">
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-download"></i> Generate PDF
          </button>
        </span>
      </div>
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
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
      <div id="modal_one_content_goes_here" style="padding: 30px;">
        
      </div>
    </div>
    
  </div>
</div>
<div id="viewMap" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">Map View</h4>
      </div>
      <div class="modal-body">
        <div id="mapBody">
        </div>  
        
        <script>              
          function sendCordinates (id1,id2){
            if (typeof id1 == 'undefined') 
               return false;
            var latitude  = parseFloat(id1);
            var longitude = parseFloat(id2);
            document.getElementById('mapBody').innerHTML ="<div id='map' style='width:100%;height:400px;'></div>";
              var positionMap = {lat: latitude , lng:longitude};
              var map = new google.maps.Map(document.getElementById('map'),{
                zoom:14,
                center: new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude)),
                mapTypeId: google.maps.MapTypeId.ROADMAP
              });
             var marker = new google.maps.Marker({
             position:positionMap,
              animation: google.maps.Animation.BOUNCE
             });
             marker.setMap(map , marker);
             var infowindow = new google.maps.InfoWindow({
              content: "School Location"
             });
             infowindow.open(map , marker); 
          } 
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTbYZF_kDxKNopcvej6oh-eVs1z9Xq2J0&callback=sendCordinates"></script>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function load_form_in_modal(id, title, url) {
  
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
function delete_record_by_id(id, column, table, prefix_id_text) {
var staff_row_id = prefix_id_text+id;
var deletion = confirm('Are you sure you wnat to perform deletion.');
if(!deletion){
return deletion;
}
// alert("<?php //echo base_url('School/delete_record_by_id')?>");
$.ajax({
type: 'POST',
url: "<?php echo base_url('School/delete_record_by_id/')?>",
data: {"id": id, "column":column, "table":table },
success: function(data){
obj = $.parseJSON(data);
if(obj.status == false){
alert("Deletion failed, Please try again.");
}
// pass
if(obj.status == true){
$("#"+staff_row_id).fadeOut(1000);
if( table == "age_and_class" ){
get_last_inserted_row(id, 'School/get_enrolled_record_by_id/'+<?php echo $school->schoolId; ?>, 'enrolled_row_', 'enrolled_tbody');
}
}
},
error:function (error) {
alert("deletion error in ajax process :"+error);
}
});
}
// this function will get and append last inserted row in corresponding table.
function get_last_inserted_row(id, url, prefix_id_text, append_tbody_fetched) {
// alert("id:"+id+" URL:"+url+" prefix_id_text:"+prefix_id_text);
$.ajax({
type: 'POST',
url: "<?php echo base_url('')?>"+url,
data: {"id": id},
success: function(data){
// $("#staff_tbody").append(data);
$("#"+append_tbody_fetched).append(data);
},
error:function (error) {
alert("school full details 'get_last_inserted_row' :"+error);
}
});
}
</script>
<script type="text/javascript">
function remove_enrolled_total_list_by_class() {
$( ".append_total_enrolled:first" ).remove();
// alert($( ".append_total_enrolled" ).length);
}
</script>