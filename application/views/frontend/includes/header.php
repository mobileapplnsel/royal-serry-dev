<?php defined('BASEPATH') or exit('No direct script access allowed');
$sessionData = $this->session->userdata('Customer');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Royal Serry Shipping LLC.</title>
		<meta name="viewport" content= "width=device-width, initial-scale=1.0">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="" type="image/x-icon">
		<link rel="icon" href="" type="image/x-icon">

		<!-- Fonts -->
       <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

       <!-- Stylesheet -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/dashbord.css" />
		  <!-- Toastr -->
  		<link href="<?php echo base_url(); ?>assets/admin/plugins/toastr/toastr.min.css" rel="stylesheet">
		<!-- Script -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> -->
		<!--+++++++++++++++++++++++++++dashbord+++++++-->
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" type="text/css">
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	    <!--+++++++++++++++++++++++++++dashbord+++++++-->
	    <link rel="stylesheet" href="<?=base_url('assets/admin/')?>bower_components/datatables.net-bs/css/dataTables.bootstrap.css">
	    <!-- intlTelInput -->
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/plugins/intl-tel-input-master/build/css/intlTelInput.css">
	    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	</head>
	<body class="<?php echo str_replace('/','',$this->uri->slash_segment(1));?>">
		<header>
	  	<nav class="navbar navbar-default">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/logo.png" alt="ROYALSERRY logo" /></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		        <li class="nav-item active"><a href="<?php echo base_url('order-tracking'); ?>">Track Order</a></li>
                <li class="nav-item"><a href="<?php echo base_url('home'); ?>">Ship</a></li>
                <li class="nav-item"><a href="<?php echo base_url('use-services'); ?>">User Services</a></li>
                <li class="nav-item"><a href="<?php echo base_url('branch-list'); ?>">Branch List</a></li>
                <?php if (isset($sessionData) && ($sessionData['logged_in'] == 'TRUE')) {?>
                	<li class="sign-up-text nav-item"><a href="<?php echo base_url('profile'); ?>"><span class="sign-text">Profile</span></a></li>
                	<li class="login-up-text nav-item"><a href="<?php echo base_url('logout'); ?>"><span class="login-text">Logout</span></a></li>
            	<?php } else {?>
            		<li class="sign-up-text nav-item"><a href="<?php echo base_url('registration'); ?>"><span class="sign-text">Sign Up</span></a></li>
                	<li class="login-up-text nav-item"><a href="<?php echo base_url('login'); ?>"><span class="login-text">Login</span></a></li>
            	<?php }?>


		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	  </header>


