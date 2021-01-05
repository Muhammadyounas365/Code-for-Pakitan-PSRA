<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSRA | User login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/bootstrap/dist/css/');?>/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/font-awesome/css/');?>font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/');?>/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/');?>/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href='<?php echo base_url("assets/toastr/build/toastr.css"); ?>' >
<script src='<?php echo base_url("assets/lib/jquery/dist/jquery.min.js");?>' ></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151551956-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151551956-1');
</script>

</head>

<body class="hold-transition login-page" style="background-color: #fff;">

<div class="container-fluid" style="background-color:#155f1b;color:white;box-shadow: 0 1px 3px #aaa;
    -webkit-box-shadow: 0 1px 3px #aaa;
    -moz-box-shadow: 0 1px 3px #aaa;margin-bottom: 20px;">
    <h3 class="" align="center">Khyber Pakhtunkhwa Private Schools Regulatory Authority</h3>
    <h5 class="" align="center">Online School Registration System </h5>
    
    

  </div>

<?php if($this->session->flashdata("registration_success")){ ?>
 <div class="row" style="margin-top:20px;">
     <div class="col-sm-offset-4 col-sm-4">
       
     <div class="alert alert-success alert-dismissible">
  <a style="text-decoration: none;" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> You have Successfully Registered your School/Academy.Now Enter User Name and Password to Login.
</div>
     </div>
  
</div>
<?php } ?>
<div class="login-box" style="box-shadow: 0 3px 10px #aaa;
    -webkit-box-shadow: 0 3px 10px #aaa;
    -moz-box-shadow: 0 3px 10px #aaa;background-color: #fff;margin-top:5px;">
  
  <!-- /.login-logo -->
  <div class="login-box-body" style="padding:10px;">
        <img src="<?php echo base_url("assets/images/site_images/logo.png"); ?>" class="img img-responsive " style="max-width: 150px;margin: 0 auto; ">

    <p class="login-box-msg">Use Chrome Web Browser</p>
    <?php echo validation_errors(); ?>
    <form action="<?php echo base_url('user/login'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="userName" placeholder="user name">
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class=" fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button  type="submit" class="btn btn-primary btn-block btn-flat col-xs-6 pull-right">Sign In</button>
        </div>
        <!-- /.col -->
         <div style="margin-top:10px;" class=" col-xs-12">
          <h4>
            <a class="btn btn-success btn-block btn-flat col-xs-6 pull-right" href="<?php echo base_url('registration/user_registration'); ?>">
              Create Username & Password
                        
            </a>
          </h4>
            
          </div>
         
        
      </div>
    </form>

   
         
          
          

<!--     <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

<!--     <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style=" border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;">
      
      <div class="modal-body" >
       
              
              <form role="form" action="<?php echo site_url("registration/send_password_by_email"); ?>" method="post">
                  <div class="form-group">
                <h4 class="bigintro" style="margin-top:0;border-bottom: 1px solid #aaa;font-weight: bold;">Find Your Password</h4>
                
                  <div  style="text-align: center;">
                  <p for="exampleInputEmail1">Please enter your User Name and Email address to find your Password</p>
                  <input style="width: 50%;" type="text" placeholder="User Name" class="" name="username" id="username" required="required"><br><br>
                  <input style="width: 50%;" type="email" placeholder="Email Address" class="" name="email" id="exampleInputEmail1" required="required">
                 </div>
                  </div>
                  
               
                
              
            
      </div>
      <div class="modal-footer" style="background-color: #f2f2f2;">
     
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                 
                   </form>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
      </div>
    </div>

  </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/lib/');?>jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src='<?php echo base_url("assets/toastr/build/toastr.min.js"); ?>'></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/lib/bootstrap/dist/js/');?>/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/lib/');?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
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
      $(document).ready(function () {
         $("body").hide();
      $("body").fadeIn();
      });
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
</body>
</html>
