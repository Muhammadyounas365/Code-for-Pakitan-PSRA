<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    $menu_list = "<ul id='nav'>";
    foreach($menu_arr as $controller_id => $controller_data){
        $cn_class = "";
        if($controller_name == $controller_data['controller_uri']){
            $cn_class = "current open";
        }

          $menu_list .= "<li id='".$controller_data['controller_uri']."main'  class='".$cn_class."'><a  href='javascript:void(0);'>";
              $menu_list.="<i class='fa ".$controller_data['controller_icon']."'></i>".$controller_data['controller_title']."<i class='fa fa-angle-left pull-right'></i></a>";               
        
        //create sub menu
        $menu_list .= "<ul class='sub-menu'>";
        //check of we have any action for this controller
        if(isset($controller_data['actions']) and is_array($controller_data['actions'])){
            
            foreach($controller_data['actions'] as $action){
                    
                $class = "";
                if($current_action_id == $action['action_id']){
                    $class = "current";
                }
               
                    $menu_list .= "<li><a class='".$class."' href='".site_url($controller_data['controller_uri']."/".$action['action_uri'])."'><span class='sub-menu-text'><i class='fa fa-circle-o'></i> ".ucfirst($action['action_title'])."<span id='".$action['action_uri']."' ></span></span></a></li>";
                
                
                
            }
        }
            
        $menu_list .= "</ul>";
        //end of sub menu
                
        $menu_list .= "</li>";
    }
    $menu_list .= "</ul>";
    // var_dump($menu_list);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Empty File | Melon - Flat &amp; Responsive Admin Template</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href='<?php echo base_url("assets/melon_admin_template/bootstrap/css/bootstrap.min.css"); ?>' rel="stylesheet" type="text/css" />

	<!-- jQuery UI -->
	<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<link href='<?php echo base_url("assets/melon_admin_template/assets/css/main.css"); ?>' rel="stylesheet" type="text/css" />
	<link href='<?php echo base_url("assets/melon_admin_template/assets/css/plugins.css"); ?>' rel="stylesheet" type="text/css" />
	<link href='<?php echo base_url("assets/melon_admin_template/assets/css/responsive.css"); ?>' rel="stylesheet" type="text/css" />
	<link href='<?php echo base_url("assets/melon_admin_template/assets/css/icons.css"); ?>' rel="stylesheet" type="text/css" />



	<link href='<?php echo base_url("assets/melon_admin_template/bootstrap/css/bootstrap.min.css"); ?>' rel="stylesheet" type="text/css" />



	<link href='<?php echo base_url("assets/melon_admin_template/assets/css/fontawesome/font-awesome.min.css"); ?>' rel="stylesheet" />
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/assets/js/libs/jquery-1.10.2.min.js"); ?>'></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js");?>'></script>

	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/bootstrap/js/bootstrap.min.js"); ?>'></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/assets/js/libs/lodash.compat.min.js"); ?>'></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/touchpunch/jquery.ui.touch-punch.min.js");?>'></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/event.swipe/jquery.event.move.js");?>'></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/event.swipe/jquery.event.swipe.js");?>'></script>

	<!-- General -->
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/assets/js/libs/breakpoints.js");?>'></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/respond/respond.min.js");?>'></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/cookie/jquery.cookie.min.js");?>'></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/slimscroll/jquery.slimscroll.min.js");?>'></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/plugins/slimscroll/jquery.slimscroll.horizontal.min.js");?>'></script>

	<!-- App -->
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/assets/js/app.js");?>' ></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/assets/js/plugins.js");?>' ></script>
	<script type="text/javascript" src='<?php echo base_url("assets/melon_admin_template/assets/js/plugins.form-components.js");?>' ></script>

	<script>
	$(document).ready(function(){
		"use strict";

		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins
	});
	</script>
</head>

<body>

	<!-- Header -->
	<header class="header navbar navbar-fixed-top" role="banner">
		<!-- Top Navigation Bar -->
		<div class="container">

			<!-- Only visible on smartphones, menu toggle -->
			<ul class="nav navbar-nav">
				<li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
			</ul>

			<!-- Logo -->
			<a class="navbar-brand" href="index.html">
				<img src="assets/img/logo.png" alt="logo" />
				<strong>ME</strong>LON
			</a>
			<!-- /logo -->

			<!-- Sidebar Toggler -->
			<a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
				<i class="icon-reorder"></i>
			</a>
			<!-- /Sidebar Toggler -->

			<!-- Top Left Menu -->
			<ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
				<li>
					<a href="#">
						Dashboard
					</a>
				</li>
			</ul>
			<!-- /Top Left Menu -->

			<!-- Top Right Menu -->
			<ul class="nav navbar-nav navbar-right">
				<!-- User Login Dropdown -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-male"></i>
						<span class="username">John Doe</span>
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- /user login dropdown -->
			</ul>
			<!-- /Top Right Menu -->
		</div>
		<!-- /top navigation bar -->
	</header> <!-- /.header -->

	<div id="container">
		<div id="sidebar" class="sidebar-fixed">
			<div id="sidebar-content">

				<!--=== Navigation ===-->
<!-- 				<ul id="nav">
					<li class="current">
						<a href="index.html">
							<i class="icon-dashboard"></i>
							Entry #1
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<i class="icon-desktop"></i>
							Entry #2
							<span class="label label-info pull-right">6</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="ui_general.html">
								<i class="icon-angle-right"></i>
								Entry #2.1
								</a>
							</li>
						</ul>
					</li>
				</ul> -->
				<?php echo $menu_list; ?>
				<!-- /Navigation -->
			</div>
			<div id="divider" class="resizeable"></div>
		</div>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="index.html">Dashboard</a>
						</li>
						<li class="current">
							<a href="calendar.html" title="">Calendar</a>
						</li>
					</ul>

					<ul class="crumb-buttons">
						<li><a href="charts.html" title=""><i class="icon-signal"></i><span>Statistics</span></a></li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Dashboard</h3>
						<span>Good morning, John!</span>
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<div class="row">
					<!--=== Example Box ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Example Box</h4>
							</div>
							<div class="widget-content">
								<p>Lorem Ipsum.</p>
							</div>
						</div>
					</div> <!-- /.col-md-12 -->
					<!-- /Example Box -->
				</div> <!-- /.row -->
				<!-- /Page Content -->

			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>