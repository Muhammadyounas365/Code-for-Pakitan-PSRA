<style type="text/css">
.extra_small{
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
  <section class="content">
    <!-- Default box -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Create New <?php echo @ucfirst($title); ?></h3>
      </div>
      <div class="box-body">
        <div class="progress">
          <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">50%
          </div>
        </div>
        <div class="row">
          <!-- col-md-offset-1 -->
          <div class="col-sm-12">
            <h2 class="text-center">Section-D: Staff Detail</h2>
            <div class="text-center">
              <span><i>STAFF STATEMENT</i> <small>(Teaching and Non-Teaching)</small></span>
            </div>
            <!-- form creation -->
            
            <form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/school_staff_add_process_ajax');?>">
              <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
              <div class="alert alert-success" id="msg_one" style="display: none;"></div>
              <div id="validation_one" class=" alert alert-danger text-center" style="display: none;color:white;"></div>
              <div class="form-group col-sm-4">
                
                <input type="text" name="schoolStaffName" required="required" form="Form1" class="form-control" id="schoolStaffName" placeholder="Name">
                
              </div>
              <div class="form-group col-sm-4">
                
                <input type="text" class="form-control" name="schoolStaffFatherOrHusband" required="required" form="Form1" id="schoolStaffFatherOrHusband" placeholder="Father/Husband Name">
                
              </div>
              <div class="form-group col-sm-4">
                
                <input type="text" class="form-control" data-inputmask='"mask": "99999-9999999-9"' data-mask name="schoolStaffCnic" required="required" placeholder="CNIC" form="Form1" id="schoolStaffCnic">
                
              </div>
              <div class="form-group col-sm-4">
                
                <select class="form-control select2" id="schoolStaffGender" form="Form1" required="required" name="schoolStaffGender" style="width: 100%;">
                  <?php if(!empty($gender)): ?>
                  <option value="">Select Staff Gender</option>
                  <?php foreach($gender as $gen): ?>
                  <option value="<?php echo $gen->genderId ?>"><?php echo $gen->genderTitle; ?></option>
                  <?php endforeach;?>
                  <?php else: ?>
                  No gender found.
                  <?php endif;?>
                </select>
                
              </div>
              
              <div class="form-group col-sm-4">
                
                <select class="form-control select2" form="Form1" required="required" id="schoolStaffType" name="schoolStaffType" style="width: 100%;">
                  <?php if(!empty($staff_type)): ?>
                  <option value="">Select Staff Type</option>
                  <?php foreach($staff_type as $s_type): ?>
                  <option value="<?php echo $s_type->staffTypeId ?>"><?php echo $s_type->staffTtitle; ?></option>
                  <?php endforeach;?>
                  <?php else: ?>
                  No Staff Type Found.
                  <?php endif;?>
                </select>
              </div>
              
              <div class="form-group col-sm-4">
                
                <input type="text" class="form-control" name="schoolStaffQaulificationAcademic"  required="required" form="Form1" id="schoolStaffQaulificationAcademic" placeholder="Enter Academic Qualification">
                
              </div>
              <div class="form-group col-sm-4">
                <input type="text" class="form-control" name="schoolStaffQaulificationProfessional" form="Form1" id="schoolStaffQaulificationProfessional" placeholder="Enter Professional Qualification">
                
              </div>
              <div class="form-group col-sm-4">
                <input type="text" class="form-control" name="TeacherTraining" form="Form1" id="TeacherTraining" placeholder="Relevant Teaching Training In Months">
                
              </div>
              <div class="form-group col-sm-4">
                <input type="text" class="form-control" name="TeacherExperience" form="Form1" id="TeacherExperience" placeholder="Teacher Experience In Months">
              </div>
              <div class="form-group col-sm-4">
                <input type="text" class="form-control" name="schoolStaffDesignition" required="required" form="Form1" id="schoolStaffDesignition" placeholder="Enter Designation">
                
              </div>
              <div class="form-group col-sm-4">
                <input type="text"  class="datepicker form-control" placeholder="Date of Appointment" name="schoolStaffAppointmentDate" required="required" form="Form1" id="schoolStaffAppointmentDate">
              </div>
              <div class="form-group col-sm-4">
                <input type="text" class="form-control" name="schoolStaffNetPay" required="required" id="schoolStaffNetPay" form="Form1" placeholder="Enter Net Pay i-e 10000, 15000, 17000 etc.">
                
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-sm-4">
                <input type="text" class="form-control" name="schoolStaffAnnualIncreament" form="Form1" id="schoolStaffAnnualIncreament" placeholder="Annual Increment">
                
              </div>
              
              <div class="form-group col-sm-4">
                <input type="submit" class="btn-block form-control  btn-sm btn-primary btn-flat" form="Form1" id="add_staff" value="Add Staff">
                
                
              </div>
            </form>
          </div>
        </div>
        
        <div class="row page_break_before">
          <h3 class="lead text-center">Section-D: Staff Detail</h3>
          <form id="delete"  action="<?php echo base_url('school/delete_staff_info_by_id/'.$school_id); ?>" method="post" onsubmit="return delete_confirm();" />
            <input type="hidden" name="school_id"  value="<?php echo $school_id; ?>" >
            <div class="col-xs-12 table-responsive">
              <table class="table table-bordered table-condensed">
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
                    
                  </tr>
                </thead>
                <tbody class="small_font" id="formdata">
                  <?php $counter = 1;?>
                  <?php if(!empty($school_staff)): ?>
                  <?php foreach($school_staff as $st): ?>
                  <tr id="staff_row_<?php echo $st->schoolStaffId; ?>">
                    <td><input class="delete_checkbox" type='checkbox' value="<?php echo $st->schoolStaffId; ?>"  name='staff_ids[]'></td>
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
                    
                  </tr>
                  <?php $counter++; ?>
                  <?php endforeach; ?>
                  
                  <?php endif;?>
                </tbody>
              </table>
              
            </div>
          </form>
          <br>
          
          <a  href="<?php echo base_url('school/form_d_process/'.$school_id); ?>"  style="margin-right:15px;" class=" pull-right btn btn-primary btn-flat btn-sm" onclick="return staff_confirm();" >Next Section</a>
          <input form="delete" style="margin-right:15px;" value="Delete Selected"  type="submit" class="pull-right btn btn-danger btn-sm  btn-flat">
          <!-- /.col -->
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
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<form id="Form1" method="post" onsubmit="callme(event);" enctype="multipart/form-data" action="<?php echo base_url('school/form_d_process');?>">
</form>
<form id="Form2" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/form_d_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >
<input type="hidden" name="school_id" name="Form1" value="<?php echo $school_id; ?>">
</form>
<script type="text/javascript">
$('#Form1').on('submit', function(e) {
e.preventDefault();


$("#add_staff").prop('disabled', true);
$("#add_staff").val("Please Wait...");
$('#create_school_user_process_response').html('');
$('#create_school_user_process_response_alert').html('');
$.ajax({
type: 'POST',
url: $('#Form1').attr('action'),
data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
success: function(data){
obj = $.parseJSON(data);
// fails
if(obj.status == false){
$('#validation_one').show().html(obj.msg).fadeOut(10000);

$("#add_staff").val("Add Staff");
$("#add_staff").prop('disabled', false);
}
// pass
if(obj.status == true){
var id =obj.staff_info.schoolStaffId;
var name =obj.staff_info.schoolStaffName;
var fatherName = obj.staff_info.schoolStaffFatherOrHusband;
var cnic = obj.staff_info.schoolStaffCnic;
var qualificationProfessional = obj.staff_info.schoolStaffQaulificationProfessional;
var qualificationAcademic = obj.staff_info.schoolStaffQaulificationAcademic;
var appointmentDate =obj.staff_info.schoolStaffAppointmentDate;
var designation = obj.staff_info.schoolStaffDesignition;
var netPay = obj.staff_info.schoolStaffNetPay;
var annualIncrement = obj.staff_info.schoolStaffAnnualIncreament;
var TeacherTraining = obj.staff_info.TeacherTraining;
var TeacherExperience = obj.staff_info.TeacherExperience;
var gender_text = obj.staff_info.genderTitle;
var staff_text = obj.staff_info.staffTtitle;
var markup = "<tr><td><input class='delete_checkbox' type='checkbox' value='"+id+"'name='staff_ids[]'></td><td>" + name + " </td><td>"+fatherName + "</td> <td> " + cnic + "</td> <td>" + gender_text + "</td> <td> " + staff_text + "</td>  <td>" + qualificationAcademic + "</td> <td>" + qualificationProfessional + "</td>  <td> "+TeacherTraining + "</td><td>"+TeacherExperience + "</td> <td>" + designation + "</td> <td>" + appointmentDate + "</td><td>" + netPay + "</td>   <td>" + annualIncrement + "</td></tr>";
$("#formdata").prepend(markup);
$("#appointmentDate").attr("type", "text");
$('#Form1').trigger("reset");
$("select.select2").select2('data', {}); // clear out values selected
$("select.select2").select2({ allowClear: true }); // re-init to show default status

// $('#myModal').modal('hide');
$('#msg_one').show().html(obj.msg).fadeOut(3000);
// $('#modal_one').modal('hide');

$("#add_staff").val("Add Staff");
$("#add_staff").prop('disabled', false);


}
},
error:function (data) {
alert("not add staff info :"+data);
}
});
return false;
});
function delete_confirm(){
if($('.delete_checkbox:checked').length > 0){
var result = confirm("Are you sure to delete selected users?");
if(result){
return true;
}else{
return false;
}
}else{
alert('Select at least 1 record to delete.');
return false;
}
}
function staff_confirm(){
if($('.delete_checkbox').length > 0){
var result = confirm("Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.");
if(result){
return true;
}else{
return false;
}
}else{
alert('Add at least 1 Staff record for go to next Section.');
return false;
}
}
</script>
<script type="text/javascript">
// console.log($);
function callme(e) {
var staff_id = $('select[name="teaching_or_non_teaching_staff"] option:selected').val();
var staff_text = $('select[name="teaching_or_non_teaching_staff"] option:selected').text();
// var gender_id = $("input[name='gender']:checked").val();
var gender_id = $('select[name="gender"] option:selected').val();
var gender_text = $('select[name="gender"] option:selected').text();
e.preventDefault();
var name = $("#name").val();
var fatherName = $("#fatherName").val();
var cnic = $("#cnic").val();
var qualificationProfessional = $("#qualificationProfessional").val();
var qualificationAcademic = $("#qualificationAcademic").val();
var appointmentDate = $("#appointmentDate").val();
var designation = $("#designation").val();
var netPay = $("#netPay").val();
var annualIncrement = $("#annualIncrement").val();
var TeacherTraining = $("#TeacherTraining").val();;
var TeacherExperience = $("#TeacherExperience").val();;
var markup = "<tr class='extra_small'><td><input type='checkbox' form='Form2' name='record'></td><td><input type='hidden' form='Form2' name='name[]' value='" + name + "' />" + name + " </td> <td><input type='hidden' form='Form2' name='fatherName[]' value='"+fatherName + "' /> "+fatherName + "</td> <td><input type='hidden' form='Form2' name='cnic[]' value='" + cnic + "' /> " + cnic + "</td> <td><input type='hidden' form='Form2' name='gender[]' value='" + gender_id + "' /> " + gender_text + "</td>  <td><input type='hidden' form='Form2' name='staff[]' value='" + staff_id + "' /> " + staff_text + "</td>  <td><input type='hidden' form='Form2' name='qualificationAcademic[]' value='" + qualificationAcademic + "' /> " + qualificationAcademic + "</td> <td><input type='hidden' form='Form2' name='qualificationProfessional[]' value='" + qualificationProfessional + "' /> " + qualificationProfessional + "</td>   <td><input type='hidden' form='Form2' name='TeacherTraining[]' value='"+TeacherTraining + "' /> "+TeacherTraining + "</td> <td><input type='hidden' form='Form2' name='TeacherExperience[]' value='"+TeacherExperience + "' /> "+TeacherExperience + "</td> <td><input type='hidden' form='Form2' name='designation[]' value='" + designation + "' /> " + designation + "</td> <td><input type='hidden' form='Form2' name='appointmentDate[]' value='" + appointmentDate + "' /> " + appointmentDate + "</td>  <td><input type='hidden' form='Form2' name='netPay[]' value='" + netPay + "' /> " + netPay + "</td> <td><input type='hidden' form='Form2' name='annualIncrement[]' value='" + annualIncrement + "' /> " + annualIncrement + "</td> </tr>";
$("#formdata").append(markup);
$("#appointmentDate").attr("type", "text");
$('#Form1').trigger("reset");
$("select.select2").select2('data', {}); // clear out values selected
$("select.select2").select2({ allowClear: true }); // re-init to show default status

}

$(document).ready(function(){
$('[data-mask]').inputmask();
// Find and remove selected table rows
$(".delete-row").click(function(){
$("table tbody").find('input[name="record"]').each(function(){
if($(this).is(":checked")){
$(this).parents("tr").remove();
}
});
});
});
$("#appointmentDate").focusout(function(){
var value = $(this).val();
alert(value);
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