<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo @$site_name; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--   <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0"> -->
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href='<?php echo base_url("assets/lib/bootstrap/dist/css/bootstrap.min.css"); ?>' >
    <!-- Font Awesome -->
    <link rel="stylesheet" href='<?php echo base_url("assets/lib/font-awesome/css/font-awesome.min.css");?>' >
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href='<?php echo base_url("assets/dist/css/AdminLTE.min.css") ?>' >
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href='<?php echo base_url("assets/dist/css/skins/skin-blue.min.css"); ?>' >
    <link rel="stylesheet" href='<?php echo base_url("assets/css/styles.css"); ?>' >
    <link rel="stylesheet" href='<?php echo base_url("assets/toastr/build/toastr.css"); ?>' >
    <!-- jQuery 3 -->
    <script src='<?php echo base_url("assets/lib/jquery/dist/jquery.min.js");?>' ></script>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/plugins/iCheck');?>/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/lib');?>/select2/dist/css/select2.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    
    
    <!-- google analytics code -->
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131083466-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-131083466-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145262973-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-145262973-1');
    </script>
    <style type="text/css">
    .node{
    color:white !important;
    }
    </style>
    <style type="text/css">
    .navbar-default {
    
    border: 0;
    box-shadow: 0 0 6px rgba(0,0,0,0.5);
    }
    .fixed-top {
    
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
    </style>
    
    
    <style type="text/css">
    
    .errors{
    
    color:red !important;
    
    
    }
    .form-control{
    
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color:transparent !important;
    background-image: none;
    
    
    
    }
    .error{
    color:red !important;
    
    }
    .text-success{
    color:green !important;
    
    
    }
    .panel_div {
    
    
    width:auto;
    min-width: 250px;
    
    
    
    
    
    font-size:14px;
    font-weight: bold;
    
    height: 30px;
    text-align: center;
    margin-top:20px;
    
    color:#fff;
    text-transform: uppercase;
    
    }
    .panel_div b{
    background-color:#5c9ccc;
    padding:5px;
    border-radius: 4px;
    }
    .bottom{
    margin-bottom:5px !important;
    padding:10px;
    width: 100%;
    min-height: 50px;
    height: auto;
    background-color: #eee;
    margin-left: 0px !important;
    }
    .section {
    
    
    
    
    color:#000;
    background-color: #dfeffc;
    
    
    
    
    
    
    
    
    
    }
    .page-head{
    background: rgba(86,148,100,1);
    background: -moz-linear-gradient(left, rgba(86,148,100,1) 0%, rgba(86,148,100,1) 21%, rgba(21,62,64,1) 100%);
    background: -webkit-gradient(left top, right top, color-stop(0%, rgba(86,148,100,1)), color-stop(21%, rgba(86,148,100,1)), color-stop(100%, rgba(21,62,64,1)));
    background: -webkit-linear-gradient(left, rgba(86,148,100,1) 0%, rgba(86,148,100,1) 21%, rgba(21,62,64,1) 100%);
    background: -o-linear-gradient(left, rgba(86,148,100,1) 0%, rgba(86,148,100,1) 21%, rgba(21,62,64,1) 100%);
    background: -ms-linear-gradient(left, rgba(86,148,100,1) 0%, rgba(86,148,100,1) 21%, rgba(21,62,64,1) 100%);
    background: linear-gradient(to right, rgba(86,148,100,1) 0%, rgba(86,148,100,1) 21%, rgba(21,62,64,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#569464', endColorstr='#153e40', GradientType=1 );
    }
    h2,h3,h4,h5,h6{
    
    
    
    }
    body {
    font-family: Times, "Times New Roman", serif;
    }
    .error-alert{
    border: red solid 1px;
    }
    .reg_type_selection:hover{
    border:1px solid #a6c9e2;
    }
    .form-control[type=text], .form-control[type=number],.form-control[type=password],.form-control[type=email]{
    
    border:none;
    
    border-bottom: 1px solid gray;
    padding:0 10px;
    height: 40px;
    display: inline-block;
    font-weight: normal;
    font-size: 15px;
    color: #000000;
    }
    .form-control:focus{
    border-bottom-width: 2px;
    }
    textarea:focus{
    -moz-box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;
    -webkit-box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;
    box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;
    }
    label{
    font-weight: 600;
    font-size:13px;
    font-family: Arial;
    margin-top:10px;
    
    }
    legend{
      font-weight: bolder;
      text-align: center;
    }
    .form-group{
      margin-top:10px;
      padding:15px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;

    }
    </style>
  </head>
  <body id="fade">
    <!-- Site wrapper -->
    
    <!-- =============================================== -->
    
    
    <div class="container-fluid" style="background-color:#155f1b;color:white;box-shadow: 0 1px 3px #aaa;
      -webkit-box-shadow: 0 1px 3px #aaa;
      -moz-box-shadow: 0 1px 3px #aaa;margin-bottom: 20px;">
      <h3 class="" align="center" style="text-shadow: 6px 6px 4px #000000;">Khyber Pakhtunkhwa Private Schools Regulatory Authority</h3>
      <h5 class="" align="center">Online Tuition Academy Registration System </h5>
      <b class="pull-right">Already have acount? <a style="padding:0;width:50px;"  class="btn btn-primary btn-sm" href="<?php echo base_url("user/login"); ?>"> Login</a></b>
      
    </div>
    <?php if(validation_errors() != ''){ ?>
    <div class="alert alert-dismissible">
      <a style="text-decoration: none;" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error!</strong>  <?php echo validation_errors();  ?>
    </div>
    
    <?php } ?>
    <div class="container-fluid" style="background-color: #fff;">
    <div class="container" style="margin-bottom:100px;padding-top:20px;background-color: #dfeffc;">
      <!-- Content Header (Page header) -->
      
      
      
      <!-- Main content -->
      <section style="background-color: #dfeffc;">
        <!-- Default box -->
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('registration/create_academy_user_process');?>" id="create_school_user_process">
        <div class="form-group col-sm-12">

           <div class="text-center row" style="margin:0 auto;width:100%;">
          <span style="color: red;line-height: 1px;text-align: center;">Note:Remember User Name and Password For Login To Your Academy acount.</span>
        </div>
        <br>
        <legend>Registration of Tuition Academies
        </legend>

         <div class=" ">
                    <label for="name"  class="col-sm-2 control-label"> Name of the Owner</label>
                    <div class="col-sm-10">
                      <input length="5" type="text"  required="required" class="form-control" name="name" value="<?php echo set_value('name');?>" id="name" placeholder="Name">
                      
                    </div>
                    </div>
        </div>
       
        <div class="row">
          
          <div class="">
            
            
            
              <input type="hidden" name="role_id" value="<?php echo $roles; ?>">
              <input type="hidden" name="status" value="1">
              
              
              <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa");?>
              <input type="hidden" name="createdDate" value="<?php echo $dated; ?>">
              <div class="">
                <div id="create_school_user_process_response" class="text-center"></div>
                <div class="section   col-sm-12">
                 
                    <div class="form-group col-sm-12">
                    <label for="userName" class="col-sm-2 control-label"><span class="text-danger">*</span>User-name</label>
                    <div class="col-sm-10">
                      <input length="5" type="text" onkeyup="check_username();"  required="required" class="form-control" name="userName" value="<?php echo set_value('userName');?>" id="username" placeholder="User-name">
                      <span id="check_username"></span>
                    </div>
                  </div>
                  
                  <div class="form-group col-sm-12">
                    <label for="password" class="col-sm-2 control-label"><span class="text-danger">*</span>Password</label>
                    <div class="col-sm-10">
                      <input length="5" type="password"  required="required" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    </div>
                    <div class="form-group col-sm-12">
                    <label for="passwordconf" class="col-sm-2 control-label" ><span class="text-danger">*</span>Confirm Password</label>
                    <div class="col-sm-10">
                      <input length="5" type="password"  required="required" class="form-control" id="passwordconf" name="passconf" placeholder="Password">
                    </div>
                  </div>
                  
                  <div class="form-group col-sm-12">
                    <label for="contactNumber" class="col-sm-2 control-label">Contact Number</label>
                    <div class="col-sm-10">
                      <input length="12" type="text"  required="required" class="form-control" name="contactNumber" value="<?php echo set_value('email');?>" id="contactNumber" placeholder="Contact Number" data-inputmask='"mask": "0399-9999999"' data-mask>
                    </div>
                    </div>
                     <div class="form-group col-sm-12">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input length="8" type="email"  required="required" class="form-control" name="email" value="<?php echo set_value('email');?>" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
                  
                  <div class="form-group col-sm-12">
                    <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                    <div class="col-sm-10">
                      <input length="15" type="text" value="<?php echo set_value('cnic');?>"  required="required" class="form-control" name="cnic" data-inputmask='"mask": "99999-9999999-9"' data-mask id="cnic" placeholder="CNIC">
                    </div>
                    </div>
                    <div class="form-group col-sm-12">
                    <label for="gender" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="gender" id="gender">
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group col-sm-12">
                    <label for="address" class="col-sm-2 control-label">Your Address</label>
                    <div class="col-sm-10">
                      <input  type="text"  required="required" class=" form-control" name="address" value="<?php echo set_value('address');?>" id="address" placeholder="Address">
                    </div>
                  </div>
                  <!-- radio for status -->
                  
                </div>
                <div class="section   col-sm-12">
              
              <div id="create_school_response" class="text-center"></div>
              
              <!-- form starts here...-->
              
              
              
              
              <div class="form-group col-sm-12">
                <label class="control-label col-sm-2" for="academy_name">Academy Name/Tuition Center:</label>
                <div class="col-sm-10">
                  <input length="5" value="<?php echo set_value('schoolName');?>" type="text" class="form-control" id="academy_name" required placeholder="Enter Academy Name" name="academy_name">
                </div>
               
              </div>
              
              <div class="form-group col-sm-12">
                <label class="control-label col-sm-2" for="yoe">Year of Establishment:</label>
                <div class="col-sm-10">
                  <input length="4" type="number" min="1900" max="2099" step="1" placeholder="Enter Year of Establishment"  name="yearOfEstiblishment" <?php set_value('yearOfEstiblishment'); ?>  class="form-control" id="yoe" />
                </div>
                </div>
                <div class="form-group col-sm-12">
                <label class="control-label col-sm-2" for="telePhoneNumber">Tele-phone number (<small>with city code</small>) :</label>
                <div class="col-sm-10">
                  <input type="text"  name="telePhoneNumber" placeholder="Enter Telephone number" value="<?php set_value('telePhoneNumber'); ?>" class="form-control" id="telePhoneNumber" />
                </div>
              </div>
              
              <div class="form-group col-sm-12">
                <label for="district" class="col-sm-2 control-label">District</label>
                <div class="col-sm-10">
                  <select onchange="getTehsilsByDistrictId(this);" style="width:100%;" required="required" class="form-control select2" name="district" id="district">
                    <option value="">Select District</option>
                    <?php foreach($districts as $district): ?>
                    <option value="<?php echo $district->districtId; ?>"><?php echo $district->districtTitle; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                </div>
                <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label"><span class="text-danger">*</span>Tehsils</label>
                <div class="col-sm-10">
                  
                  <select required="required" class="form-control select2" name="tehsil_id" onchange="getUcsByTehsilsId(this);" style="width: 100%;" id="tehsil_id">
                    <option value="">Select</option>
                    
                  </select>
                  
                  
                  
                </div>
              </div>
              <div class="form-group col-sm-12">
                
                <label class="col-sm-2 control-label"><span class="text-danger">*</span>UC/Cantonment</label>
                <div class="col-sm-10">
                  <select  class="form-control select2" name="uc_id" id="uc_id" style="width: 100%;">
                      <option value="">Select</option>
                  </select>
                </div>
                </div>
                 <div class="form-group col-sm-12">
                <label class="control-label col-sm-2" for="postal_address">Postal Address</label>
                <div class="col-sm-10">
                  <input length="5" type="text" value="<?php set_value('postal_address'); ?>"   placeholder="Enter Academy Postal Address"  name="postal_address" class="form-control" id="postal_address" />
                </div>
              </div>
              <div class="form-group col-sm-12">
                <label class="control-label col-sm-2" for="villageName">Village/Locality Name:</label>
                <div class="col-sm-10">
                  <input length="3" type="text"  placeholder="Enter village or city name"  name="address" class="form-control" id="address1" />
                </div>
                </div>
                 <div class="form-group col-sm-12">
                <label class="control-label col-sm-2" for="gender">Select Gender</label>
                <div class="col-sm-10">
                  <select required="required" class="form-control" required name="gender_type_id" style="width: 100%;">
                    <option value="">Select</option>
                    <?php foreach ($gender_of_school as $gender) : ?>
                    <option value="<?= $gender->genderOfSchoolId;?>" <?php echo set_select('gender_type_id',  $gender->genderOfSchoolId); ?> ><?= $gender->genderOfSchoolTitle; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                </div>
                <div class="form-group col-sm-12">
                <label class="control-label col-sm-2" for="location">Select Location:</label>
                <div class="col-sm-10">
                  <select required="required" class="form-control" id="location" name="location" style="width: 100%;">
                    <option  value="">Select Location</option>
                    <option value="Urban">Urban</option>
                    <option value="Rural">Rural</option>
                  </select>
                </div>
              </div>
         
              
             
              <div  class="bottom  col-sm-12">
                
                <div class=" col-sm-12">
                  <input type="submit" name="submit" value="Create Academy Acount" style="
                  border-radius: 12px;
                  -webkit-border-radius: 12px;
                  -moz-border-radius: 12px;
                  
                  "   class="btn btn-warning col-sm-2 pull-right"/>
                </div>
                
              </div>
              
              <!-- <input type="submit" name="submit" value="submit"> -->
              
              <!-- /.box-body -->
              
              <!-- /.box-footer-->
              
              <!-- /.box -->
              </div>
            
            
            
            </form>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
    <script type="text/javascript">
    //var lab=false;
    $(document).ready(function(){
    
    $('[data-mask]').inputmask();
    });
    ////////////////////////////////////
    
    $( "#name" ).keypress(function(e) {
    var key = e.keyCode;
    if (key >= 48 && key <= 57) {
    e.preventDefault();
    }
    });
    ///////////////////////////////
    $( ".form-control" ).blur(function(e) {
    $(this).parent().children('.error').remove();
    $(this).removeClass('error-alert');
    var value = $(this).val();
    var data = eval($(this).attr('length'));
    //alert(data);
    if (value.length < data) {
    $(this).addClass('error-alert');
    $(this).after('<span class="error">length must be at least '+data+'  characters long</span>')
    }
    });
    //////////////////////////////////
    $( ".form-control" ).keyup(function(e) {
    
    var value = $(this).val();
    var data = eval($(this).attr('length'));
    //alert(value);
    if (value.length == data) {
    $(this).parent().children('.error').remove();
    }
    });
    /////////////////////////////////
    function check_username(lab=true)
    {
    
    var username=$("#username").val();
    $('#username').parent().children('span').remove();
    if(username.length >= 5)
    {
    
    $.ajax({
    type: 'POST',
    async: !1,
    url: '<?php echo base_url('aJax/check_if_username_exist');?>',
    data:'username=' + username,   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
    success: function(data){
    //obj = $.parseJSON(data);
    console.log(data);
    if(data==1){
    //$('#check_username').parent().children('.errors').remove();
    
    $('#username').after('<span class="errors">Already exist Please try another one</span>');
    lab=false;
    //alert(lab);
    }
    else if(data==0){
    //$('#check_username').parent().children('.errors').remove();
    
    $('#username').after('<span class="text-success">User Name is available</span>');
    
    }
    },
    
    
    });
    }
    return lab;
    }
    ////////////////////////////////
    $('#password, #passwordconf').on('keyup', function () {
    $('#passwordconf').parent().children('.text-success').remove();
    $('#passwordconf').parent().children('.error').remove();
    if($('#password').val().length >= 5 && $('#passwordconf').val().length >= 5){
    
    if ($('#password').val() == $('#passwordconf').val()) {
    $('#passwordconf').after('<span class="text-success"> Matching</span>');
    } else
    $('#passwordconf').after('<span class="error">Passwords Not Matching</span>');
    }
    });
    ///////////////////////////////
    $('#create_school_user_process').on('submit', function() {
    
    //alert('')
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
    /////////////////////////////
    var is_valid_length=true;
    $(".form-control").each(function() {
    $(this).parent().children('.error').remove();
    $(this).removeClass('error-alert');
    var value = $(this).val();
    var data = eval($(this).attr('length'));
    //alert(data);
    //alert(value.length);
    if (value.length < data) {
    $(this).addClass('error-alert');
    $(this).after('<span class="error">length must be at least '+data+'  characters long</span>');
    is_valid_length=false;
    }
    
    });
    if(is_valid_length==false)
    return false;
    ////////////////////////////
    
    
    ////////////////////////////////
    if (password != passconf) {
    $('#passwordconf').after('<span class="error">Passwords Not Matching</span>');
    isvalid=false;
    }
    
    
    
    
    
    var regEx =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var validEmail = regEx.test(email);
    if (!validEmail) {
    isvalid=false;
    $('#inputEmail3').after('<span class="error">Enter a valid email</span>');
    }
    
    
    
    if(isvalid == true)
    {
    $("#userInsert").prop('disabled', true);
    $("#userInsert").val("Please Wait...");
    $('#create_school_user_process_response').html('');
    $('#create_school_user_process_response_alert').html('');
    
    }
    else{
    return false;
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
    url: "<?php echo base_url('registration/get_ucs_by_tehsils_id')?>/",
    data: {"id":selected.value},
    success: function(data){
    $("#uc_id option").remove();
    $("#uc_id").append(data);
    }
    
    });
    }
    function getTehsilsByDistrictId(selected){
    
    $.ajax({
    type: 'POST',
    url: "<?php echo base_url('registration/get_tehsils_by_district_id')?>/",
    data: {"id":selected.value},
    success: function(data){
    
    $("#tehsil_id").html(data);
    }
    });
    }
    
    </script>
    
    <!-- Footer Start From Here -->
    <footer class="main-footer text-center" style="border:0;position: fixed;bottom:0;width: 100%;margin:0;margin-left: 1px;">
      <div class="">
        <!-- <b>Version</b> 2.4.0 -->
      </div>
      <strong class="text-center">Copyright &copy; 2018 <a href="#">PSRA</a>.</strong> All rights
      reserved.
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-user bg-yellow"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                  <p>New phone +1(800)555-1234</p>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                  <p>nora@example.com</p>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-file-code-o bg-green"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                  <p>Execution time 5 seconds</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->
          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
                </h4>
                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
                </h4>
                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
                </h4>
                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
                </h4>
                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->
        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>
            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>
              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label class="control-sidebar-subheading">
                Allow mail redirect
                <input type="checkbox" class="pull-right" checked>
              </label>
              <p>
                Other sets of options are available
              </p>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label class="control-sidebar-subheading">
                Expose author name in posts
                <input type="checkbox" class="pull-right" checked>
              </label>
              <p>
                Allow the user to show his name in blog posts
              </p>
            </div>
            <!-- /.form-group -->
            <h3 class="control-sidebar-heading">Chat Settings</h3>
            <div class="form-group">
              <label class="control-sidebar-subheading">
                Show me as online
                <input type="checkbox" class="pull-right" checked>
              </label>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label class="control-sidebar-subheading">
                Turn off notifications
                <input type="checkbox" class="pull-right">
              </label>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label class="control-sidebar-subheading">
                Delete chat history
                <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
              </label>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script src='<?php echo base_url("assets/lib/jquery/dist/jquery.min.js");?>' ></script>
  <script type="text/javascript" src='<?php echo base_url("assets/toastr/build/toastr.min.js"); ?>'></script>
  <!-- <script type="text/javascript" src="<?php echo base_url('assets/lib/plugins/input-mask/jquery.inputmask.js'); ?>"></script> -->
  <!-- App -->
  <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>" ></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>" ></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.form-components.js'); ?>" ></script> -->
  <!-- <script>
  $(document).ready(function(){
  "use strict";
  // App.init(); // Init layout and core plugins
  Plugins.init(); // Init all plugins
  FormComponents.init(); // Init all form-specific plugins
  });
  </script> -->
  <!-- Bootstrap 3.3.7 -->
  <script src='<?php echo base_url("assets/lib/bootstrap/dist/js/bootstrap.min.js")?>'></script>
  <!-- SlimScroll -->
  <script src='<?php echo base_url("assets/lib/jquery-slimscroll/jquery.slimscroll.min.js");?>'></script>
  <!-- FastClick -->
  <script src='<?php echo base_url("assets/lib/fastclick/lib/fastclick.js")?>'></script>
  <!-- AdminLTE App -->
  <script src='<?php echo base_url("assets/dist/js/adminlte.js")?>'></script>
  <!-- AdminLTE for demo purposes -->
  <script src='<?php echo base_url("assets/dist/js/demo.js");?>'></script>
  <!-- iCheck 1.0.1 -->
  <script src="<?php echo base_url('assets/lib/plugins/iCheck');?>/icheck.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url('assets/lib');?>/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo base_url('assets/lib/plugins/input-mask/jquery.inputmask.js');?>"></script>
  <script type="text/javascript">
  //Initialize Select2 Elements
  $('.select2').select2()
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-blue',
  radioClass   : 'iradio_flat-blue'
  })
  </script>
  <?php
  if($this->session->flashdata("msg") || $this->session->flashdata("msg_error") || $this->session->flashdata("msg_success")){
  
  $type = "";
  if($this->session->flashdata("msg_success")){
  $type = "success";
  $msg = $this->session->flashdata("msg_success");
  }elseif($this->session->flashdata("msg_error")){
  $type = "error";
  $msg = $this->session->flashdata("msg_error");
  }else{
  $type = "info";
  $msg = $this->session->flashdata("msg");
  }
  ?>
  <script type="text/javascript">
  toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
  }
  toastr.<?php echo $type; ?>("<?php echo $msg; ?>");
  </script>
  <?php } ?>
  <script>
  $(document).ready(function () {
  $('.sidebar-menu').tree();
  });
  </script>
</body>
</html>