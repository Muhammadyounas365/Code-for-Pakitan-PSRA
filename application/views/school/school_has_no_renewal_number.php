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
      <!-- <li><a href="#">Examples</a></li> -->
      <li class="active"><?php echo @ucfirst($title); ?>s</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Schools list</h3>
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
            <!-- radio button for search... -->
           
            <!-- school Id search form-->
            
            <!-- end school id form here... -->
            <!-- <=======        ========> -->
            <!-- school area and name search -->
          
            <div id="area_and_like_box">
              <div class="form-group">
                <div class="col-sm-4">
                  <select class="form-control select2" id="district_id" name="district_id" onchange="getTehsilsByDistrictId(this);" required  style="width: 100%;">
                    <?php echo $districts;?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <select class="form-control select2" name="tehsil_id" id="tehsil_id" style="width: 100%;" onchange="requiredOperationAfterTehsilChange(this);">
                    <option value="0">Select Tehsil</option>
                  </select>
                </div>
                <label class="col-sm-4">
                  <input type="text" class="form-control" name="like_text" onkeyup="getSchoolsDontHaveRegistrationNumberAllotedLikeCondition(this);" required="required"  id="like_text" placeholder="Enter School Name" value="">
                </label>
              </div>
            </div>
              <div class="clearfix"></div>
            <div id="by_school_id">
              <form id="Form2" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/get_single_school_for_renewal_by_id');?>">
                <div class="form-group">
                  <label class="col-sm-4">
                    <input type="text" class="form-control" name="schools_id" required="required" form="Form2" id="schools_id" placeholder="Enter School Id Examples 1,2,3 etc.">
                  </label>
                  <label class="col-sm-2">
                    <input type="submit" id="search" class="form-control btn-xs btn-primary btn-flat" form="Form2" value="Search">
                  </label>
                </div>
              </form>
            </div>
            <!-- end school area search... -->
            <div>
              <table class="table table-responsive table-hover table-bordered table-condensed table-striped">
                <thead>
                  <tr style="font-size: 12px;">
                    <th style="width: 10px">ID</th>
                    <th>School Name</th>
                    
                    
                    <th>Address</th>
                    <th>BISE Reg No </th>
                    <th>School Level</th>
                     <th>Reg Type </th>
                      <th>Year of Establishment </th>
                      
                    
                    <th>School Type</th>
                    
                    
                    <th class="text-center">Renewal#</th>
                  </tr>
                </thead>
                <tbody id="searched_data_div">
                  <!-- <tr ></tr> -->
                  <?php $counter= 1; 

                  ?>
                  <?php foreach($schools as $school): ?>
                  <tr>
                    <td><?php echo $school->schoolId; ?></td>
                    <td class="text-center"><a class="btn btn-link" href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $school->schoolId; ?>"><?php echo $school->schoolName; ?></a><br>
                    <span class="label label-default"><?php echo @$school->registrationNumber; ?></span></td>
                    
                    
                    <td><?php if($school->districtTitle != NULL){
                      echo "<span style='font-size:12px;'><strong>District: </strong>".$school->districtTitle."<br /><strong>Tehsil: </strong>".$school->tehsilTitle." ".$school->address."</span>";
                      }else{
                      echo $school->address;
                      }
                      ?>
                    </td>
                    
                    
                    
                    <td><?php echo @$school->biseregistrationNumber; ?></td>
                    <td><?php echo @$school->classTitle; ?> To <?php echo @$school->upper_class; ?></td>
                     <td><?php echo @$school->regTypeTitle; ?></td>
                      <td><?php echo @$school->yearOfEstiblishment; ?></td>
                       <td><?php echo @$school->genderOfSchoolTitle; ?></td>
                    
                    <td class="text-center">
                      <?php echo @$school->sessionYearTitle; ?><br>
                      <a  style="margin-bottom:5px;" href="#" class="btn btn-success btn-flat btn-xs" onclick="load_form_in_modal(<?php echo $school->school_session_id; ?>, 'Generate Renewal Number', 'School/generate_renewal_number');">Generate Renewal Code</a>
                      <br>
                      <a href="<?php echo base_url('school/certificate_of_schools/'); ?><?php echo $school->schoolId; ?>" title="Print the <?php echo @ucfirst($title); ?> Certificate" target="_blank" > &nbsp;<i class="fa fa-file-text"></i></a>
                      <a class="school_details" id="<?php echo $school->school_session_id; ?>" href="#" title="Edit School Details"> &nbsp;<i class="  fa fa-edit"></i></a>
                      <br>
                       <?php if($school->isfined==1) { ?>
                       <a href="#" class="btn btn-danger btn-xs btn-flat" title="the school has been fined!"><i class="fa fa-fire"></i> Fined</a>
                       <?php } ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->

<div class="modal fade" id="modal_one" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #00a65a;color:#fff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:#fff;" id="modal_one_title">title will be goes dynamically</h4>
        </div>
        <div id="modal_one_content_goes_here">
          
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
$('input[type=radio][name=search_method]').change(function() {
if (this.value == 'by_school_id') {
$("#like_text").val('');
$("select.select2").select2('data', {}); // clear out values selected
$("select.select2").select2({ allowClear: true }); // re-init to show default status
$("#by_school_id").fadeIn('slow');
$("#area_and_like_box").fadeOut('slow');
}
else{
$("#school_id").val('');
$("#by_school_id").fadeOut('slow');
$("#area_and_like_box").fadeIn('slow');
}
});
function requiredOperationAfterTehsilChange(selected) {
$("#like_text").val('');

}
function getSchoolsDontHaveRegistrationNumberAllotedLikeCondition(likeObj) {
var likObjValue = ''; var district_id = 0; var tehsil_id = 0;
likObjValue = likeObj.value;
district_id = $("#district_id").val();
tehsil_id = $("#tehsil_id").val();
// console.log();
if(likObjValue.length > 4 ){
$.ajax({
type: 'POST',
url: "<?php echo base_url('school/get_single_school_for_renewal_by_id');?>",
data: {"matchString": likObjValue, "district_id":district_id, "tehsil_id": tehsil_id},
success: function(data){
// console.log(data);
$('tr.bg-success').remove();
$('#searched_data_div').prepend(data);
},
error:function (data) {
alert("not add staff info :"+data);
}
});
}else{
$('tr.bg-success').remove();
}
}

function getTehsilsByDistrictId(selected) {
$("#like_text").val('');
$("select.select2").select2('data', {}); // clear out values selected
$("select.select2").select2({ allowClear: true }); // re-init to show default status
$.ajax({
type: 'GET',
url: "<?php echo base_url('School/get_tehsils_list_by_district_id')?>/"+selected.value,
//data: {"id": id},
success: function(data){
$("#tehsil_id").html(data);
},
error:function (error) {
alert("getTehsilsByDistrictId"+ error);
}
});
}
function load_form_in_modal(id, title, url) {
  $con= confirm('Are you Sure to create Renewal Code');
  if($con)
  {
    $.ajax({
type: 'POST',
url: "<?php echo base_url('')?>"+url,
data: {"id": id},
success: function(data){
  try
  {
   obj = $.parseJSON(data);
   if(obj.status == true)
   {
     $('#modal_one').modal('show');
     $("#modal_one_content_goes_here").html(obj.msg);
     $("#modal_one_title").html(title);

     ///////////////////

                    $("#send_message").on('click',function(){
                    var school_id=$("#schools_id_for_message").val(); 
                    //alert(school_id);
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('messages/send_registration_certificate_to_school')?>",
                    data: {"school_id": school_id},
                    success: function(data){
                      console.log(data);
                        try {
                              // handle json here
                              

                        obj = $.parseJSON(data);
                        if(obj.status == false)
                        {
                        alert(obj.msg);
                        }
                        else if(obj.status == true)
                        {
                        alert(obj.msg);

                            
                         
                        }
                            
                          }
                          catch (e)
                          {
                            location.reload();
                             //console.log(data);
                          } 
                    },
                    error:function(data){

                    }
                  });

                  });
   }
   if(obj.status==false)
   {
      $('#modal_one').modal('show');
      $("#modal_one_content_goes_here").html(obj.msg);
      $("#modal_one_title").html(title);
   }
  }
  catch (e)
  {
    location.reload();
  }

},
error:function (data) {
// alert("getUcsByTehsilsId :s"+data);
}
});
  }

// $('#myModal').modal('show');

}
</script>
<script type="text/javascript">
$('form[id="Form2"] input:submit').on('click', function(e) {
e.preventDefault();
$("#search").prop('disabled', true);
$("#search").val("Please Wait...");
$('#create_school_user_process_response').html('');
$('#create_school_user_process_response_alert').html('');
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
// return false;
});
</script>

<script type="text/javascript">
      $(".school_details").on('click',function(){
        var id=$(this).attr('id');
        //$(this).closest("tr").html("");
        // alert(id);
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('School/edit_school_details_by_id')?>",
              data: {"id": id},

              success: function(data){
                console.log(data);
                      try
                       {
                        obj = $.parseJSON(data);
                        $('#modal_one').modal('show');
                        $("#modal_one_content_goes_here").html("");
                        $("#modal_one_content_goes_here").html(obj.view);
                        $("#modal_one_title").html("Edit School Details"); 
                       }
                       catch (e)
                       {
                        location.reload();
                       }
                  

              },
               error:function (data) {
                 // alert("getUcsByTehsilsId :s"+data);

               }

          });
        // $('#myModal').modal('show');

        
      });
      </script>