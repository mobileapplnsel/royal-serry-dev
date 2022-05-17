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
            <p class="login-box-msg">Forgot password</p>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('success'); ?></div>
        	<?php } ?>
            
            <?php echo form_open(base_url('admin/forgot_password_email'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email_address" value="<?php echo $this->session->flashdata('email_address'); ?>" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                
                <div class="row">
                    
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                    </div>
                    <!-- /.col -->
                </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
<?php
    $this->load->view('admin/include/footer');
?>