<style>
#myProgress {
width: 100%;
background-color: #ddd;
border-radius:30% 30%;
}
#myBar {
width: 26%;
height: 30px;
background-color: #4CAF50;
text-align: center;
line-height: 30px;
color: white;
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
        <div class="row">
          <!-- col-md-offset-1 -->
          <div class="col-md-12">
            <form action="" class="form-horizontal" method="post"  name="Form2" id="Form2">
              
              <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
              <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
              <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
              <div class="progress">
                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                  40%
                </div>
              </div>
              <div class="box-body">
                <h2 class="text-center">Section-C: Class & Age Wise Enrollement</h2><br/>
                <div class="form-group">
                  <input type="hidden" name="school_id"  value="<?php echo $school_id; ?>">
                  <label class="col-sm-2 col-md-2 control-label"><span class="text-danger">*</span>Age</label>
                  <div class="col-sm-4 col-md-4">
                    <?php if(!empty($age_list)): ?>
                    <select required class="form-control select2" name="age_id" form="Form2" style="width: 100%;">
                      <option value="">Select Age</option>
                      <?php foreach ($age_list as $age) : ?>
                      <option value="<?= $age->ageId;?>"><?= $age->ageTitle; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php else: ?>
                    <h5 class="text-danger">No age found.</h5>
                    <?php endif;?>
                  </div>
                  <label class="col-sm-2 col-md-2 control-label"><span class="text-danger">*</span>Class</label>
                  <div class="col-sm-4 col-md-4">
                    <?php if(!empty($class_list)): ?>
                    <select required class="form-control select2" name="class_id" form="Form2" style="width: 100%;">
                      <option value="">Select Class</option>
                      <?php foreach ($class_list as $class) : ?>
                      <option value="<?= $class->classId;?>"><?= $class->classTitle; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php else: ?>
                    <h5 class="text-danger">No Class found.</h5>
                    <?php endif;?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="gender">Gender:</label>
                  <div class="col-sm-4">
                    <select required class="form-control select2" id="gender_id" form="Form2" name="gender_id" style="width: 100%;">
                      <option value="">Select Gender</option>
                      <option value="1">Boys</option>
                      <option value="2">Girls</option>
                    </select>
                  </div>
                  <!-- <span class="col-sm-2"></span> -->
                  <label class="control-label col-sm-2 col-md-2" for="numberOfClassroom">Enrolled:</label>
                  <div class="col-sm-4 col-md-4" style="width: 32.4061234%;">
                    <input required type="text"  name="enrolled" placeholder="No. of students" class="form-control" form="Form2" id="enrolled" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 pull-right">
                    <button type="submit" id="add_enrolled" class="btn btn-sm add-row btn-primary btn-flat" form="Form2">Add Record</button>
                  </label>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <form id="delete"  action="<?php echo base_url('school/delete_age_class_by_id/'.$school_id); ?>" method="post" onsubmit="return delete_confirm();" />
                  <input type="hidden" name="school_id"  value="<?php echo $school_id; ?>" >
                  <div class="table-responsive">
                    <table class="table-bordered table-condensed table-hover" style="width: 100%;">
                      <thead>
                        <tr>
                          <th class='text-center'>Select</th>
                          <th class='text-center'>Age</th>
                          <th class='text-center'>Class</th>
                          <th class='text-center'>Gender</th>
                          <th class='text-center'>Enrolled</th>
                        </tr>
                      </thead>
                      <tbody id="formdata2">
                        <?php if(count($age_and_class)){ ?>
                        <?php foreach ($age_and_class as $single_class) { ?>
                        <tr class='text-center'>
                          <td ><input class="delete_checkbox" type='checkbox' name='age_class_ids[]' value="<?php echo $single_class->ageAndClassId; ?>"></td>
                          <td><?php echo $single_class->ageTitle;  ?></td>
                          <td> <?php echo $single_class->classTitle;  ?> </td>
                          <td><?php echo $single_class->studentGenderTitle  ?></td>
                          <td><?php echo $single_class->enrolled;  ?></td>
                        </tr>
                        <?php }
                        }?>
                      </tbody>
                      
                    </table>
                  </div>
                </form>
                <br>
                
                <a  href="<?php echo base_url('school/form_c_process/'.$school_id); ?>"  style="margin-right:15px;" class=" pull-right btn btn-primary btn-flat btn-sm" onclick="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >Next Section</a>
                <input form="delete" style="margin-right:15px;" value="Delete Selected"  type="submit" class="pull-right btn btn-danger btn-sm  btn-flat">
              </div>
            </div>
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
<form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/form_c_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >
  
</form>
<script type="text/javascript">
// console.log($);
function addRecord(e) {
e.preventDefault();
var age_id = $('select[name="age"] option:selected').val();
var age_text =  $('select[name="age"] option:selected').text();
var class_id = $('select[name="class"] option:selected').val();
var class_text = $('select[name="class"] option:selected').text();
var enrolled = $("#enrolled").val();
var gender_id = $("select[name='gender'] option:selected").val();
var gender_text = $('select[name="gender"] option:selected').text();

var markup = "<tr class='text-center'><td ><input type='checkbox' name='age_class_ids[]' value='""'></td><td><input type='hidden' form='Form1' name='age[]' value='" + age_id + "' /> " + age_text + "</td><td><input type='hidden' form='Form1' name='class[]' value='"+ class_id + "' /> "+ class_text +" </td><td><input type='hidden' form='Form1' name='gender[]' value='" + gender_id + "' />"+ gender_text +" </td><td><input form='Form1' type='hidden' name='enrolled[]' value='" + enrolled + "' />" + enrolled + "</td></tr>";
$("#formdata2").prepend(markup);
$('#Form2').trigger("reset");
$("select.select2").select2('data', {}); // clear out values selected
$("select.select2").select2({ allowClear: true }); // re-init to show default status

}


$(document).ready(function(){

// Find and remove selected table rows
$(".delete-row").click(function(){
$("table tbody").find('input[name="record"]').each(function(){
if($(this).is(":checked")){
$(this).parents("tr").remove();
}
});
});
});
</script>
<script type="text/javascript">
$('#Form2').on('submit', function(e) {

e.preventDefault();
$("#add_enrolled").prop('disabled', true);
$("#add_enrolled").val("Please Wait...");

$.ajax({
type: 'POST',
url: "<?php echo base_url('school/school_enrollement_add_process_ajax'); ?>",
data: $('#Form2').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
success: function(data){
console.log(data);
obj = $.parseJSON(data);

// fails
if(obj.status == false){
$('#validation_one').html(obj.msg);
$("#add_enrolled").val("Add Enrollement");
$("#add_enrolled").prop('disabled', false);
}
if(obj.status == true){

var age_text =  obj.age_class.ageTitle;
var ageAndClassId=obj.age_class.ageAndClassId;
var class_text = obj.age_class.classTitle;
var enrolled =obj.age_class.enrolled;

var gender_text = obj.age_class.studentGenderTitle;

var markup = "<tr class='text-center'><td ><input class='delete_checkbox' type='checkbox' name='age_class_ids[]' value='"+ageAndClassId+"'></td><td> " + age_text + "</td><td> "+ class_text +" </td><td>"+ gender_text +" </td><td>" + enrolled + "</td></tr>";
$("#formdata2").prepend(markup);

$('#validation_one').html(obj.msg);
$("#add_enrolled").val("Add Enrollement");
$("#add_enrolled").prop('disabled', false);
$('#Form2').trigger("reset");
$("select.select2").select2('data', {}); // clear out values selected
$("select.select2").select2({ allowClear: true });
}
// pass

},
error:function (data) {
alert("Enrollement data error:"+data);
}
});
return false;
// return false;
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
</script>