<?php
//print_r($_SESSION);
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<style type="text/css">
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}
</style>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!--<a href="<?= base_url('admin') ?>"><b>RoyalSerry</b> Shipping</a>-->
            <a href="<?= base_url('admin') ?>"><img src="<?= base_url('assets/admin/') ?>dist/img/logo1.png" /></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('success'); ?></div>
        	<?php } ?>
            
            <?php echo form_open(base_url('admin/adminlogin'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email_address" value="<?php echo $this->session->flashdata('email_address'); ?>" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password-field" value="<?php echo $this->session->flashdata('password'); ?>" required>
                    <!--<span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="width:34px;"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8" style="padding-left:35px;">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" style="margin: 4px -2px 2px -21px !important;"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            <?php echo form_close(); ?>

<!--
            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
            </div>
             /.social-auth-links 
-->
            <a href="<?php echo base_url(); ?>admin/forgotpassword">I forgot my password</a>
            <!--<br>
            <a href="register.html" class="text-center">Register a new membership</a>-->


        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
<?php
    $this->load->view('admin/include/footer');
?>