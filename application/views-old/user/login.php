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


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page" style='background-image: url("<?php echo base_url("assets/images/site_images/login_page_back_ground_img.png"); ?>")' >
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>PSRA</b> Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
        <img src="<?php echo base_url("assets/images/site_images/logo.png"); ?>" class="img img-responsive " style="max-height:100px; max-width: 100px;margin: 0 auto; ">

    <p class="login-box-msg">Use Chrome Web Browser</p>
    <?php echo validation_errors(); ?>
    <form action="<?php echo base_url('user/login'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="userName" placeholder="user name">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
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
