<style type="text/css">
  
  .errors{
    color:red !important;
    font-weight: bold;
  }
  .error{
    color:red !important;
    font-weight: bold;
  }
  .text-success{
    color:green !important;
    font-weight: bold;
  }
</style>
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
        <li><a href="<?php echo base_url('user');?>"><?php echo @$title; ?></a></li>
        <li><a href="#">Create <?php echo @$title; ?></a></li>
      </ol>
    </section>


    <script type="text/javascript">      function clicked(argument) {
        $('#myModal').modal('show');
      }</script>
<button onclick="clicked()" style="display: none;">Click to show modal</button>


    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">create new <?php echo @$title; ?>s form</h3>
        </div>
        <div class="box-body">
          <div class="row">
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('user/create_school_user_process');?>" id="create_school_user_process">
                    <input type="hidden" name="role_id" value="<?php echo $roles; ?>">
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="district_id" value="<?php echo $district_id; ?>">
                    <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa");?>
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>">
                    <div class="box-body">
                      <div id="create_school_user_process_response" class="text-center"></div>
                      <div class="form-group">


<!--                       <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" name="role_id" id="role_id">
                            <option>Select Role</option>
                            <?php foreach($roles as $role): ?>
                                <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_title; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div> -->

<!--                       <div class="form-group">
                        <label for="district" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" name="district" id="district">
                            <option>Select District</option>
                            <?php foreach($districts as $district): ?>
                                <option value="<?php echo $district->districtId; ?>"><?php echo $district->districtTitle; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div> -->



                      <div class="form-group">
                        <label for="name"  class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text"  required="required" class="form-control" name="name" value="<?php echo set_value('name');?>" id="name" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="username" class="col-sm-2 control-label"><span class="text-danger">*</span>User-name</label>
                        <div class="col-sm-10">
                          <input type="text" onkeyup="check_username();"  required="required" class="form-control" name="username" value="<?php echo set_value('username');?>" id="username" placeholder="User-name">
                          <span id="check_username"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="password" class="col-sm-2 control-label"><span class="text-danger">*</span>Password</label>

                        <div class="col-sm-10">
                          <input type="password"  required="required" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="passwordconf" class="col-sm-2 control-label" style="margin-top:-10px;"><span class="text-danger">*</span>Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password"  required="required" class="form-control" id="passwordconf" name="passconf" placeholder="Password">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="contactNumber" class="col-sm-2 control-label">Contact Number</label>
                        <div class="col-sm-10">
                          <input type="text"  required="required" class="form-control" name="contactNumber" value="<?php echo set_value('email');?>" id="contactNumber" placeholder="Contact Number" data-inputmask='"mask": "0399-9999999"' data-mask>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email"  required="required" class="form-control" name="email" value="<?php echo set_value('email');?>" id="inputEmail3" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                        <div class="col-sm-10">
                          <input type="text"  required="required" class="form-control" name="cnic" data-inputmask='"mask": "99999-9999999-9"' data-mask id="cnic" placeholder="CNIC">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="gender" id="gender">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>                           
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text"  required="required" class="form-control" name="address" value="<?php echo set_value('address');?>" id="address" placeholder="Address">
                        </div>
                      </div>


                      <!-- radio for status -->
<!--                       <div class="form-group">
                        <label class="col-sm-2 control-label">User status</label>
                        <div class="col-sm-10">
                        <label>
                          <input type="radio" name="status" value="1" class="flat-red" checked> Active
                        </label>
                        <br>
                        <label>
                          <input type="radio" name="status" value="0" class="flat-red"> In-Active
                        </label>
                        </div>
                      </div> -->

<!--                       <div class="form-group">
                        <label for="img" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                          <input type="file" name="file" id="img">
                          <p class="help-block">Profile picture is optional if not provided, the default avator will be set.</p>
                        </div>
                      </div> -->
                      <div class="form-group">
                          <div class="col-md-offset-2 col-sm-offset-2">
                              <input type="button"  style="margin-left:15px;" id="userInsert" value="Add School User"  class="btn btn-primary btn-flat">
                          </div>
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
     //var lab=false;
     $(document).ready(function(){
     $('[data-mask]').inputmask();
      });

      function check_username(lab=true)
      {
        
      var username=$("#username").val();
        
       if(username.length < 5)
       {
             
                lab=false;
                $('#check_username').removeClass('text-success');
                $('#check_username').addClass('errors');
                $('#check_username').html('User Name must be at least 8 characters long');
                
       }
       else
       {
                $.ajax({
             type: 'POST',
             async: !1,
             url: '<?php echo base_url('ajax/check_if_username_exist');?>',
             data:'username=' + username,   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
             success: function(data){
                //obj = $.parseJSON(data);
                console.log(data);
                if(data==1){
                  
                  $('#check_username').removeClass('text-success');
                  $('#check_username').addClass('errors');
                  $('#check_username').html('User Name already exist');

                  lab=false;
                   //alert(lab);
                  }
                  else if(data==0){
                   
                     $('#check_username').removeClass('errors');
                     $('#check_username').addClass('text-success');
                     $('#check_username').html('You can own this User Name');

                     
                  }
        },
        error: function() {
            alert('Error occured');
        }
        
      });
       }
        return lab;
      }    

    $('form[id="create_school_user_process"] input:button').on('click', function(e) {
        e.preventDefault();
        //alert('');
        var first_name = $('#name').val();
        var username = $('#username').val();
        var email = $('#inputEmail3').val();
        var password = $('#password').val();
        var passconf = $('#passwordconf').val();
        var cnic = $('#cnic').val();
        var isvalid=false;
        
        //alert(isvalidate);
        

       $(".error").remove();

       isvalid=check_username();
      
 
    if (first_name.length < 1) {
        isvalid=false;
      $('#name').after('<span class="error">This field is required</span>');
    }
     
    if (username.length < 5) {
      isvalid=false;
      $('#check_username').removeClass('text-success');
                $('#check_username').addClass('errors');
                $('#check_username').html('This field is required');
    }
    if (cnic.length < 13) {
      isvalid=false;
      $('#cnic').after('<span class="error">This field is required</span>');
    }
    
    if (email.length < 1) {
      isvalid=false;
      $('#inputEmail3').after('<span class="error">This field is required</span>');
    } else {
      var regEx =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var validEmail = regEx.test(email);
      if (!validEmail) {
        isvalid=false;
        $('#inputEmail3').after('<span class="error">Enter a valid email</span>');
      }
    }
    if (password.length < 8) {
      isvalid=false;
      $('#password').after('<span class="error">Password must be at least 8 characters long</span>');
    }
    if (passconf.length < 8) {
      isvalid=false;
      $('#passwordconf').after('<span class="error">Password must be at least 8 characters long</span>');
    }
        if(isvalid == true)
        {
           $("#userInsert").prop('disabled', true);
           $("#userInsert").val("Please Wait...");
           $('#create_school_user_process_response').html('');
           $('#create_school_user_process_response_alert').html('');

           $('#myModal').modal('show');
        }

        
        
				$("#userInsert").val("Add School User");
        $("#userInsert").prop("disabled", false);

        // return false;
    });
      // function create_school_user_process() {

      // }

      function school_form_process() {


        $.ajax({
             type: 'POST',
             url: $('#create_school_user_process').attr('action'),
             data: $('#create_school_user_process').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
             success: function(data){

                obj = $.parseJSON(data);
                console.log(data);
                // fails
                if(obj.status == false){
                    $('#create_school_user_process_response').html(obj.msg);

                }
                // pass
                if(obj.status == true){
                  console.log(obj.user_id);
                  
                  // $('#myModal').modal('hide');
                  var owner_id = $("#owner_id").val(obj.user_id);

                    /////////$('#create_school_user_process_response_alert').show().html(obj.msg).fadeOut(3000);
                    //////$("#create_school_user_process").trigger('reset');


        // Now the Model data will be posted in database table
        // Start From here
        $("#schoolInsert").prop('disabled', true);
        $("#schoolInsert").prop('value', 'Please Wait...');
        $('#create_school_response').html('');
        $('#create_school_user_process_response_alert').html('');
        $.ajax({
             type: 'POST',
             url: $('#school_form').attr('action'),
             data: $('#school_form').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
             success: function(data){
                obj = $.parseJSON(data);
                console.log(data);
                // fails
                if(obj.status == false){
                    $('#create_school_process_response').html(obj.msg);
                }
                // pass
                if(obj.status == true){
                  $('#create_school_user_process_response_alert').show().html(obj.msg).fadeOut(3000);
                  $("#school_form").trigger('reset');
                  $("select.select2").select2('data', {}); // clear out values selected
                  $("select.select2").select2({ allowClear: true }); // re-init to show default status
                  setTimeout(hide_model_and_reset_school_form, 1000);



                }

             },
              error:function (error) {
                console.log("create_school_user_processsss :s"+error);

              }
        });
                }

              },
              error:function (data) {
                alert("create_school_user_process :"+data);

              }
        });
         // Form insertion End Here



          // Model Section End Here

				$("#schoolInsert").val('Add School');
        $("#schoolInsert").prop('disabled', false);
        return false;
      }

      function hide_model_and_reset_school_form() {
        location.reload(true)
        $('#myModal').fadeOut('slow');
        $('#school_form').trigger("reset");
      }

      // $("#type_of_institute_id").change(function () {
      //     console.log($("#type_of_institute_id :selected").val());
      // });

      function schoolTypeChanged(selected) {
      var schoolType =  selected.value;
      $("#ppcName").prop('disabled', false);
      $("#ppcName").val("");
      $('#ppc_div').fadeOut('slow');
        if(schoolType == 2 ){
            $('#ppc_div').fadeIn('slow');
            var schoolName = $("#schoolName").val();
            $("#ppcName").prop('disabled', true);
            $("#ppcName").val(schoolName);
            $("#ppcCode").focus();
            
        }
      if(schoolType == 11 ){
          $('#schoolTypeOtherDiv').fadeIn('slow');
          $("#schoolTypeOther").prop('required', true);       
      }else{
          $('#schoolTypeOtherDiv').fadeOut('slow'); 
          $("#schoolTypeOther").prop('required', false);   
      }
      }

      function getUcsByTehsilsId(selected){
        
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('User/get_ucs_by_tehsils_id')?>/",
              data: {"id":selected.value},

              success: function(data){
                $("#uc_id option").remove();
                  $("#uc_id").append(data);
              },
               error:function (data) {
                 alert("getUcsByTehsilsId :s"+data);

               }

          });
      }
      

  </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">School Registration Form</h4>
          </div>
          <div class="modal-body">
            <div id="create_school_response" class="text-center"></div>
            <div class="alert alert-success" id="create_school_user_process_response_alert" style="display: none;"></div>
            <div id="create_school_process_response" class="text-center"></div>
            <!-- form starts here...-->
              <form class="form-horizontal" method="post" enctype="multipart/form-data" id="school_form" action="<?php echo base_url('User/master_table_data_school_user_insert_process');?>">
                <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                <input type="hidden" name="createdDate" value="<?php echo $dated; ?>">
                <!-- <input type="hidden" name="reg_type_id" value="1"> -->
                <input type="hidden" name="owner_id" value="" id="owner_id">
                <input type="hidden" name="district_id" value="<?php echo $district_id; ?>">
                <div class="box-body">

                  <?php if(!empty($reg_type)): ?>
                  <div class="form-group">
                    <strong class="col-sm-2 text-right">Registration:</strong>
                    <?php $reg_break = 0;?>
                    <?php foreach ($reg_type as $reg) : ?>
                      <?php if($reg_break == 3){ ?>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-2 text-right"></div>
                      <?php } ?>  
                     <label class="radio-inline col-sm-3">
                        <input type="radio" name="reg_type_id" class="flat-red" value="<?php echo $reg->regTypeId; ?>"> <?php echo $reg->regTypeTitle; ?>
                     </label>
                     <?php $reg_break++; ?>
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
                     <label class="control-label col-sm-2" for="schoolName">School Name:</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" id="schoolName" required placeholder="Enter School Name" name="schoolName">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-2" for="yoe">Year of Establishment:</label>
                     <div class="col-sm-4">
                        <input type="number" min="1900" max="2099" step="1" placeholder="Select Year of Establishment" value="<?php echo date('Y');?>" name="yearOfEstiblishment" <?php set_value('yearOfEstiblishment'); ?>  class="form-control" id="yoe" />
                     </div>
                     <label class="control-label col-sm-2" for="telePhoneNumber">Tele-phone number (<small>with city code</small>) :</label>
                     <div class="col-sm-4">
                        <input type="text"  name="telePhoneNumber" placeholder="Enter Telephone number" <?php set_value('telePhoneNumber'); ?> class="form-control" id="telePhoneNumber" />
                     </div>
                  </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label"><span class="text-danger">*</span>Tehsils</label>
                      <div class="col-sm-4">
                        <?php if(!empty($tehsils)): ?>
                      <select class="form-control select2" name="tehsil_id" onchange="getUcsByTehsilsId(this);" style="width: 100%;">
                          <option>Select</option>
                          <?php foreach ($tehsils as $tehsil) : ?>
                            <option value="<?= $tehsil->tehsilId;?>" <?php set_value('tehsil_id'); ?> ><?= $tehsil->tehsilTitle; ?></option>
                          <?php endforeach; ?>
                      </select>
                      <?php else: ?>
                        <h5 class="text-danger">No Tehsils found.</h5>
                      <?php endif;?>
                    </div>

                    <label class="col-sm-2 control-label"><span class="text-danger">*</span>UC/Cantonment</label>
                    <div class="col-sm-4">
                      <select class="form-control select2" name="uc_id" id="uc_id" style="width: 100%;">
                      </select>
                    </div>
                    </div>


                  <div class="form-group">

                     <label class="control-label col-sm-2" for="villageName">Village/City Name:</label>
                     <div class="col-sm-4">
                        <input type="text"  placeholder="Enter village or city name"  name="address" class="form-control" id="address1" />
                     </div>

                     <label class="control-label col-sm-2" for="location">Select Location:</label>
                     <div class="col-sm-4">
                        <select class="form-control select2" id="location" name="location" style="width: 100%;">
                           <option>Select Location</option>
                           <option value="Urban">Urban</option>
                           <option value="Rural">Rural</option>
                        </select>
                     </div>
                  </div>

                   <div class="form-group">
                     <label class="control-label col-sm-2" for="gender">Select Gender</label>
                     <div class="col-sm-4">
                      <select class="form-control select2" required name="gender_type_id" style="width: 100%;">
                        <option>Select</option>
                        <?php foreach ($gender_of_school as $gender) : ?>
                          <option value="<?= $gender->genderOfSchoolId;?>" <?php echo set_select('gender_type_id',  $gender->genderOfSchoolId); ?> ><?= $gender->genderOfSchoolTitle; ?></option>
                        <?php endforeach; ?>
                      </select>
                     </div>
                     <label class="control-label col-sm-2" for="level">Select Level:</label>
                     <div class="col-sm-4">
                        <select class="form-control select2" required id="level_of_school" name="level_of_school_id" class="form-control" style="width: 100%;">
                          <option>Select</option>
                          <?php foreach ($level_of_institute as $item) : ?>
                            <option value="<?= $item->levelofInstituteId;?>"><?= $item->levelofInstituteTitle; ?></option>
                          <?php endforeach; ?>
                          
                          <?php // echo $level_of_institute; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-2" for="school_type_id">School Type:</label>
                     <div class="col-sm-4">
                        <select class="form-control select2" id="school_type_id" onchange="schoolTypeChanged(this);" required name="school_type_id" style="width: 100%;">
                          <?php if(empty($school_types)): ?>
                            <option>no data found</option>
                          <?php else:?>
                            <option>Select</option>
                            <?php foreach ($school_types as $school_type) : ?>
                              <option value="<?= $school_type->typeId;?>"> <?= $school_type->typeTitle; ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                     </div>
                      <div id="schoolTypeOtherDiv" style="display: none;">
                       <label class="control-label col-sm-2" for="schoolTypeOther">Other:</label>
                       <div class="col-sm-4">
                          <input type="text"  placeholder="Enter School Type if not in dropdown"  name="schoolTypeOther" class="form-control" id="schoolTypeOther" />
                       </div>
                      </div>
                  </div>

                  <div class="form-group" id="ppc_div" style="display: none;">
                    <span><i class="text-info">*</i> <small>If the school is ppc then write the school name of gov school and EMIS code</small></span><br />
                     <label class="control-label col-sm-2" for="ppcName">Name of School:</label>
                     <div class="col-sm-4">
                        <input type="text"  placeholder="Enter name of the gov. School"  class="form-control" id="ppcName" />
                     </div>
                     <label class="control-label col-sm-2" for="ppcCode">EMIS Code:</label>
                     <div class="col-sm-4">
                        <input type="text" placeholder="Enter EMIS Code"  name="ppcCode" class="form-control" id="ppcCode" />
                     </div>
                  </div>
                  <!-- <input type="submit" name="submit" value="submit"> -->
                </div>
              </form>
            <!-- form ends here... -->
          </div>
          <div class="modal-footer">
            <div class="form-group">
                <div class="pull-right">
                    <input type="button" id="schoolInsert" form="school_form" style="margin-left:15px;" class="btn btn-primary btn-flat" value="Add School" onclick="return school_form_process();" >
                </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
