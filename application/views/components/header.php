<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
// echo "<pre>"; print_r($_SESSION);exit();
    $menu_list = "<ul class='sidebar-menu' data-widget='tree'>";
    foreach($menu_arr as $controller_id => $controller_data){
        
        $cn_class = "";
        if($controller_name == $controller_data['controller_uri']){
            $cn_class = "active menu-open";
        }


        //check of we have any action for this controller
        if(isset($controller_data['actions']) and is_array($controller_data['actions'])){
            $menu_list .= "<li id='".$controller_data['controller_uri']."main'  class='treeview ".$cn_class."'><a  href='#'>";
                $menu_list.="<i class='fa ".$controller_data['controller_icon']."'></i> <span  class='menu-text'>".strtoupper($controller_data['controller_title'])."</span><span class='pull-right-container'>
                <i class='fa fa-angle-left pull-right'></i>
              </span>
                    </a>";               
          
          //create sub menu
          $menu_list .= "<ul class='treeview-menu'>";
            
            foreach($controller_data['actions'] as $action){
                    
                $class = "";
                if($current_action_id == $action['action_id']){
                    $class = "node";
                }
               
                    $menu_list .= "<li><a class='".$class."' href='".site_url($controller_data['controller_uri']."/".$action['action_uri'])."'><span class='sub-menu-text'><i class='fa ".$action['action_icon']."'></i> ".ucfirst($action['action_title'])."<span id='".$action['action_uri']."' ></span></span></a></li>";
                
                
                
            }
                
            $menu_list .= "</ul>";
            //end of sub menu
                    
            $menu_list .= "</li>";
        }

    }
    $menu_list .= "</ul>";
    // var_dump($menu_list);

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSRA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!--   <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0"> -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("assets/images/site_images/favicon.png"); ?>" />
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
  <link rel="stylesheet" href='<?php echo base_url("assets/lib/jquery/dist/jquery-ui.css");?>' >
  <link rel="stylesheet" href='<?php echo base_url("assets/css/styles.css"); ?>' >

  <link rel="stylesheet" href='<?php echo base_url("assets/toastr/build/toastr.css"); ?>' >
  <!-- jQuery 3 -->
  <script src='<?php echo base_url("assets/lib/jquery/dist/jquery.min.js");?>' ></script>
  <script src='<?php echo base_url("assets/lib/jquery/dist/jquery-ui.js");?>' ></script>

    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/plugins/iCheck');?>/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib');?>/select2/dist/css/select2.min.css">
   <link href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo base_url('assets/datatables/buttons.dataTables.min.css'); ?>" >

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151551956-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151551956-1');
</script>

<script type="text/javascript">
            // $(function () {
            //     startTime();
            //     $(".center").center();
            //     $(window).resize(function () {
            //         $(".center").center();
            //     });
            // });

            // /*  */
            // function startTime()
            // {
            //     var today = new Date();
            //     var h = today.getHours();
            //     var m = today.getMinutes();
            //     var s = today.getSeconds();

            //     // add a zero in front of numbers<10
            //     m = checkTime(m);
            //     s = checkTime(s);

            //     //Check for PM and AM
            //     var day_or_night = (h > 11) ? "PM" : "AM";

            //     //Convert to 12 hours system
            //     if (h > 12)
            //         h -= 12;
            //      h = checkTime(h);
            //     //Add time to the headline and update every 500 milliseconds
            //     $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
            //     setTimeout(function () {
            //         startTime()
            //     }, 1000);
            // }

            // function checkTime(i)
            // {
            //     if (i < 10)
            //     {
            //         i = "0" + i;
            //     }
            //     return i;
            // }

            </script>

            <style type="text/css">
              .node{
                color:white !important;
              }
               #loading {
  display: none;
  position: fixed;
  z-index: 100000000;
  top:40%;
  left:40%;
  background-color:transparent;
  
}
@media (max-width: 991px){
.main-header .navbar-custom-menu a, .main-header .navbar-right a {
    color: gray;
    background: transparent;
  }
}
@media (max-width: 767px){
.skin-blue .main-header .navbar .dropdown-menu li a {
    color: gray;
  }
}
.bg-success{
    background-color:#fff !important;
    border-left:6px solid red;
}
 

 th{
  background-color: #9fc8e8;
 }
    thead{
      background-color: #9fc8e8;
    }
    .heading{
      background-color: #9fc8e8;
    }
    select.form-control,.form-control{
border: 1px solid #8f8f8f;
padding:0 10px;
height: 25px;
display: inline-block;

font-weight: normal;
font-size:14px;
color: #000000;

}
.form-control:focus{


-moz-box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;
  -webkit-box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;
  box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;

}
textarea:focus{
-moz-box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;
  -webkit-box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;
  box-shadow: 0px 0px 5px #79b7e7, inset 0 2px 2px #8f8f8f;




}
textarea{
  padding-top:20px;
}
.content-wrapper {
    min-height: 100%;
    background-color: #fff;
    z-index: 800;
}
.shadow {
  -moz-box-shadow:    3px 3px 5px 6px #ccc;
  -webkit-box-shadow: 3px 3px 5px 6px #ccc;
  box-shadow:         3px 3px 5px 6px #ccc;
}
.box{
  background-color: #dfeffc;
}
.table{
   background-color: #dfeffc;
}
.light-blue{
  background-color: #dfeffc;
}
input[type=submit]{color:#fff;}
table{margin:top:40px !important;
    font-size:13px;
}
label{
  font-weight: 400;
  font-size:14px;
  font-family: Arial;
  margin-bottom:0;
 
}
.box-header{
background-color:#9fc8e8 !important;
text-transform: uppercase;
font-size: 14px;
color:black !important;
}
.skin-blue .sidebar a {
color: black;
font-weight: 700;
font-size: 15px;
}
.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.menu-open>a {
background-color: #d0e5f5;
color:black;
}
 
.skin-blue .sidebar-menu>li>.treeview-menu {
margin-top: 0;
background: #d0e5f5;
}
.skin-blue .sidebar-menu .treeview-menu>li>a:hover {
color:red;
}
.skin-blue .sidebar-menu .treeview-menu>li>a {
    color: black;
    font-size: 13px;
    font-weight: 600;
}
.node{
color:red !important;
}
a.btn-link{
    color:black !important;
    font-size:13px !important;
    font-weight:bold;
    text-decoration:underline;
}
}
body{font-family:Arial;}
.btn{border-radius:5px !important;}
html{zoom:90%;}
.table{
   background-color: #dfeffc;
}
.modal-content{
   background-color: #dfeffc;
         </style>

  <!-- google code ends -->
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color:#fff;">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <!-- <a href="../../index2.html" class="logo"> -->
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- <span class="logo-mini"><b>A</b>LT</span> -->
      <!-- logo for regular state and mobile devices -->
      <!-- <span class="logo-lg"><b>Admin</b>LTE</span> -->
    <!-- </a> -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #5c9ccc !important;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <?php if($inbox_messages > 0) { ?>
           <li class="messages-menu">
            <a style="font-weight: bold;font-size: 20px;" href="<?php echo base_url("messages/inbox"); ?>">
              <i  class="fa fa-envelope-o"></i>
              <span style="font-size: 16px;" class="label label-danger"><?php echo $inbox_messages ; ?></span>
            </a>
            </li>
            <?php } ?>
<!--             <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li> -->
                <!-- inner menu: contains the actual data -->
                <!-- <ul class="menu"> -->
<!--                   <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li> -->
                  
<!--                 </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> -->
          <!-- Notifications: style can be found in dropdown.less -->
<!--           <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li> -->
                <!-- inner menu: contains the actual data -->
<!--                 <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> -->
          <!-- Tasks: style can be found in dropdown.less -->
<!--           <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li> -->
                <!-- inner menu: contains the actual data -->
<!--                 <ul class="menu">
                  <li> -->
                    <!-- Task item -->
<!--                     <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li> -->
                  <!-- end task item -->
<!--                 </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li> -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <span  class="hidden-xss" style="font-weight: bolder;font-size: 13px;text-transform: uppercase;"><?php echo @ucfirst($this->session->userdata('userTitle'));?>
              <span style="font-size:16px;">|</span><b><?php echo date("D M d Y"); ?></b> <b id="time"></b></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color: #5c9ccc !important;">
                <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

                <p>
                  <?php echo @ucfirst($this->session->userdata('userTitle'));?>
                  <small>Member since <?php $date = date("d-M-Y",strtotime($this->session->userdata('createdDate')));?> <?php echo @$date;?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
      <!--           <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('user/edit/')?><?php echo $this->session->userdata('userId'); ?>" class="btn btn-primary btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('user/logout')?>" class="btn btn-danger btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
<!--           <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar" style="margin-top:-60px !important;background-color: #dfeffc !important;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="imagevb">
          <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
          <img src="<?php echo base_url("assets/images/site_images/logo.png"); ?>" class="img img-responsive " style="max-height:120px; max-width: 120px;margin:0 auto; ">
        </div>
        <br /><!-- 
        <div class="pull-left info">
          <p>School</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div> -->
      </div>
      <!-- search form -->
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <h3 class="text-center" style="color:black;margin-top:-30px;"><strong>PSRA</strong></h3>
      <?php echo $menu_list; ?>
<!--       <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Hot</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
      </ul>
 -->    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
<div id="loading">

            <img src="<?=base_url('assets/loader.png')?>"/>

        </div>