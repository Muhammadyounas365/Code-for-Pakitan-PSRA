<style type="text/css">
.bold{
font-weight: bold;
}
.upload-btn-wrapper {
position: relative;
overflow: hidden;
display: inline-block;
}
.btn-upload {
border: 2px dotted gray;
color: #1d42ab;
background-color: white;
padding: 8px 20px;

font-size: 20px;
font-weight: bold;
width:100%;
height: 150px;
border: 1px solid #DDDDDD;
background: #FAFAFA;
}
.upload-btn-wrapper input[type=file] {
font-size: 100px;
position: absolute;
left: 0;
top: 0;
opacity: 0;
}
.panel-heading{
padding:5px;
}
input[type="checkbox"]
{
border:1px solid red;
}
</style>
<!-- Default unchecked -->
<script src="<?= base_url('ckeditor/ckeditor.js') ?>"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2 style="display:inline;">
    <?php echo @$title; ?>
    </h2>
    <small><?php echo @$description; ?></small>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('product');?>"><?php echo @$title; ?></a></li>
      <li><a href="#">Create <?php echo @$title; ?></a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Add New <?php echo @$title; ?>s form</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <?php echo validation_errors(); ?>
          <div class="col-md-12">
            <div class="  form-group col-sm-12">
              
              <div style="margin-left:10px;" class="upload-btn-wrapper">
                <button id="schools" class=" btn btn-primary"><i class="fa fa-plus"></i> Select Schools</button>
                
              </div>
              <div style="margin-left:10px;display:none;" class="well well-sm" id="selection" >Message Send To :
                <b class="text-success" id="selected_schools"></b>
              </div>
              
              
            </div>
            <form id="myForm" method="post" enctype="multipart/form-data" action="">
              <div class="box-body">
                <div class="  form-group col-sm-12">
                  <div class="">
                    <label for="subject" class=" control-label">Subject</label>
                    <input type="text" required="required" placeholder="Subject" name="subject" id="subject"  class="form-control"><?php echo set_value('discription');?>
                  </div>
                  
                </div>
                <div class="  form-group col-sm-12">
                  <div class="">
                    <label for="name" class=" control-label">Type Your Message Here</label>
                    <textarea required="required" placeholder="Type Your Message Here" name="discription" id="editor1"  class="form-control" rows="3"><?php echo set_value('discription');?></textarea>
                  </div>
                  
                </div>
                
                  <div class="form-group col-sm-12">
                      
                      <div id="images_preview" class=""></div>
                      <div id="images_preview_exceed_error" class="text-danger"></div>
                      <div class="clearfix col-sm-12">
                        <div class="upload-btn-wrapper">
                          <button onclick="return check_images_number()" class="btn-upload"><i class="fa fa-file"></i> Attach Files</button>
                          <input accept="image/*,.pdf,.doc,.docx" onclick="return check_images_number()" type="file" id="otherimages"  name="otherimages[]" multiple="multiple">
                        </div>
                        
                        
                        
                        
                      </div><div id="limit_message">You can Upload Maximum 5 Files</div>
                    </div>
                
                
                
                
                
                
                <div class="form-group">
                  <div class="pull-right">
                    <input style="background-color: #F4731E;border-color: #F4731E;color: #FFFFFF;" type="submit"    class="btn btn-primary btn-flat">
                  </div>
                </div>
                
                
                
                
              </div>
              
              
              
              
              
              
              
              
              
              <!-- radio for status -->
              
              
              
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
<!-- Modal -->

<div class="modal fade" id="modal_one" role="dialog" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog modal-lg">
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" id="modal_one_title">Select Schools</h4>
    </div>
    <div id="modal_one_content_goes_here">
      <section class="content">
        <div class="box box-success box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo @ucfirst("School"); ?>s list</h3>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="pull-right margin-b">
              <!-- <a href="<?php echo base_url('school/create_form'); ?>" class="btn btn-flat btn-primary">Add new <?php echo @ucfirst($title); ?></a> -->
            </div>
            <?php $role_id = $this->session->userdata('role_id');?>
            <div class="row">
              <div class="col-md-12">
                <div class="">
                  <!-- searching of schools by name and area wise -->
                  <div class="clearfix"></div>
                  <div id="area_and_like_box">
                    <div class="">
                      
                      <div class=" form-group col-sm-4">
                        <select  style="width:100%;" required="required" class="form-control select2" name="district" id="district">
                          <option value="0">Select District</option>
                          <?php foreach($districts as $district): ?>
                          <option value="<?php echo $district->districtId; ?>"><?php echo $district->districtTitle; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      
                      <div class="form-group col-sm-4">
                        <select  class=" select2 form-control" required id="level_id" name="level_of_school_id" class="form-control" style="width: 100%;">
                          <option value="0">Select Level</option>
                          <?php foreach ($level_of_institute as $item) : ?>
                          <option value="<?= $item->levelofInstituteId;?>"><?= $item->levelofInstituteTitle; ?></option>
                          <?php endforeach; ?>
                          
                          <?php // echo $level_of_institute; ?>
                        </select>
                      </div>
                      <label class="col-sm-4">
                        <input type="text" class="form-control" name="like_text" onkeyup="filter();"  id="like_text" placeholder="Enter School Name" value="">
                      </label>
                      
                      <a  class="btn btn-primary btn-sm btn-flat pull-right" id="done">Done</a>
                      <div class="clearfix"></div>
                    </div>
                    
                  </div>
                  <!-- end school area search... -->
                  <!-- end searching code here -->
                  <table width="100%"  id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                    <thead>
                      <tr>
                        <th class="text-primary" width="20%">
                          <label><input type="checkbox"  name="select_all"  id="select_all"  value="" >
                          Select All</label>
                        </th>
                        <th>School ID</th>
                        <th class="text-primary">School Name</th>
                        <th class="text-primary">District</th>
                        <th width="20%" class="text-primary">School Level</th>
                      </tr>
                    </thead>
                    <tbody id="filter_schools">
                      <tr><td>Total Schools</td><td><b style="color:red;"><?php echo count($schools) ?></b></td></tr>
                      <?php $counter= 1; ?>
                      <?php foreach($schools as $school): ?>
                      <tr>
                        <td><input  class="checkbox" type="checkbox" name="ids[]" value="<?php echo $school->schoolId; ?>" ></td>
                          <td style="font-weight: bold;"><?php echo $school->schoolId; ?></td>
                        <td style="font-weight: bold;"><?php echo $school->schoolName; ?></td>
                        
                        <td style="font-weight: bold;"><?php echo $school->districtTitle; ?></td>
                        <td style="font-weight: bold;"><?php echo $school->levelofInstituteTitle; ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  
                </div>
                
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
    </div>
  </div>
  
</div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
// Find and remove selected table rows
$("#schools").click(function(e){
e.preventDefault();
$('#modal_one').modal('show');
return false;
});
});
$(document).ready(function(){
  
$('#select_all').on('click',function(){
if(this.checked){
$('.checkbox').each(function(){
this.checked = true;

});
}else{
$('.checkbox').each(function(){
this.checked = false;
});
}
});

});
</script>
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace('editor1');
</script>
<script type="text/javascript">
$(document).ready(function(){
$('#level_id').on('change',function(){
filter();
});
});
$(document).ready(function(){
$('#district').on('change',function(){
filter();
});
});
function filter()
{
var district_id = 0; var level_id = 0;
district_id = $("#district").val();
level_id = $("#level_id").val();
var string = $("#like_text").val();
// console.log(likObjValue);
$.ajax({
type: 'POST',
url: "<?php echo base_url('messages/filter_schools_by_level_and_district');?>",
data: {"matchString": string,"district":district_id, "level": level_id},
success: function(data){
$("#filter_schools").html(data);
$('#select_all').prop('checked',false);
//console.log(data);


},
error:function (error) {
alert("Error occur:"+error);
}
});
}
$('#done').on('click',function(){
//alert();
var district_value=$('#district').val();
var level_value=$('#level_id').val();
var district_text=$('#district option:selected').text();
var level_text=$('#level_id option:selected').text();
///////////////////////////////////////
if(district_value == 0){district_text='';}else{district_text="In "+district_text;}
if(level_value == 0){level_text='';}
//////////////////////////////////////////
if ($("#select_all").is(":checked")) {
var total_selected_schools=" All "+level_text+" Schools "+district_text;
$('#selected_schools').html(total_selected_schools);
}
else
{
var selected = [];
$("input[name='ids[]']:checked").each(function() {
selected.push($(this).val());
});
var total_selected_schools=selected.length+" "+level_text+" Schools "+district_text;
$('#selected_schools').html(total_selected_schools);
}
$('#selection').show();
$('#modal_one').modal('hide');
//console.log(selected);
});
/////////////
// $('#myForm').on('submit', function(e) {
// e.preventDefault();
//  var messageLength = CKEDITOR.instances['editor1'].getData().replace(/<[^>]*>/gi, '').length;
//             if( !messageLength ) {
//                 alert( 'Please enter a message' );
//                 e.preventDefault();
//                 return 0;
//             }
// $.ajax({
// type: 'POST',
// url: "<?php //echo base_url('messages/index'); ?>",
// data: $('#myForm').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
// success: function(data){
// console.log(data);
// // try{
// //      obj = $.parseJSON(data);
// // }
// // catch (e)
// // {
// //   location.reload();
// // }


// },
// error:function (data) {
// alert("Enrollement data error:"+data);
// }
// });
// });



//////////////


</script>

<script>
function check_images_number() {
  if(storedFiles.length == 5)
{
  return false;
}
}
var selDiv = "";
var storedFiles = [];

$(document).ready(function() {
$("#otherimages").on("change", handleFileSelect);

selDiv = $("#images_preview");
// $("#myForm").on("submit", handleForm);

$("body").on("click", ".selFile", removeFile);
});

function handleFileSelect(e) {
$('#limit_message').html('');

var files = e.target.files;
var filesArr = Array.prototype.slice.call(files);
filesArr.forEach(function(f) {
if(!f.type.match("image.*") && !f.type.match(".pdf") && !f.type.match("application/msword") && !f.type.match(".doc") ) {
return;
}
if(storedFiles.length < 5)
{
  storedFiles.push(f);

  var reader = new FileReader();
reader.onload = function (e) {
var html = "<div class='col-md-6 clearfix' style='padding:5px;'><p class=' btn-success text-primary' style='margin-top:30px;padding:10px;padding-right:30px;border:1px solid gray;overflow: hidden;text-overflow: ellipsis;'>"+f.name+"</p><a style='position: absolute;right: 10px;color: #fff;opacity: .8;width: 22px;height: 22px;top: 40px;text-align: center;' href='javascript:void(0);' class='selFile' data-file='"+f.name+"'><i class='fa fa-close'></i></a></div>";
selDiv.append(html);

}
reader.readAsDataURL(f);
}


});

}

function handleForm(e) {

e.preventDefault();
 var messageLength = CKEDITOR.instances['editor1'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Please enter a message' );
                e.preventDefault();
                return false;
            }
for(var instanceName in CKEDITOR.instances)
 CKEDITOR.instances[instanceName].updateElement();
$("#failed_alert").hide();
$("#success_alert").hide();
if($("#select_all"). prop("checked") == true){
  
  
$('.checkbox').each(function(){
$(this). prop("checked",false);
});
}
else
{
  if($('.checkbox:checked').length < 1)
  {
    alert("Please Select at least 1 School");
    return false;
  }
}
// var form = $('form')[0]; // You need to use standard javascript object here
// var formdata = new FormData(form);
// //console.log(formdata);
// for(var i=0, len=storedFiles.length; i<len; i++) {
// formdata.append('otherimages['+i+']',storedFiles[i]);
// }

// $.ajax({
// type: 'POST',
// url: "<?php //echo base_url('messages/create_message')?>",
// data:formdata,
// contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
// processData: false,
// success:  function(data){ 
//    console.log(data);
// try {
//       // handle json here
      

// obj = $.parseJSON(data);
// if(obj.status == false)
// {
// alert(obj.msg);
// }
// else if(obj.status == true)
// {
// alert(obj.msg);

    
 
// }
    
//   }
//   catch (e)
//   {
//     //location.reload();
//      //console.log(data);
//   } 
//   },
 

 





// error:function (data) {
// // alert("getUcsByTehsilsId :s"+data);
// alert("Failed");
// }
// });
}
function removeFile(e) {
var file = $(this).data("file");
for(var i=0;i<storedFiles.length;i++) {
if(storedFiles[i].name === file) {
storedFiles.splice(i,1);

break;
}
}
$(this).parent().remove();
}
</script>