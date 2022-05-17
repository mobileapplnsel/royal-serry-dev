<?php
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
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
            $this->load->view('admin/include/sidebar');
        ?>
        <div class="content-wrapper">
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('success'); ?></div>
        	<?php } ?>
            <section class="content-header">
                <h1>Change Password</h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Change Password</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('admin/changepass'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                        <div class="box box-primary">
                        <div class="box-header with-border"> Change Password </div>
                        <div class="box-body">
						<div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Old Password<span>*</span> : </label>
                            <input type="password" class="form-control" placeholder="Old Password" name="old_password" id="password-field" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="width:34px;"></span>
                        </div>
                                                
                        <div class="form-group col-md-6 ">
                            <label for="email">New Password<span>*</span> : </label>
                            <input type="password" class="form-control" placeholder="New Password" name="new_password" id="password-field1" required>
                            <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password" style="width:34px;"></span>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Confirm Password<span>*</span> : </label>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="password-field2" required>
                            <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password" style="width:34px;"></span>
                        </div>                        
                        
                     </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Change Password</button>
                          <a href="<?php echo base_url('admin'); ?>" class="btn btn-info pull-right">Back</a>
                        </div>
            		</div>
                    <?php echo form_close(); ?>
                    
                </div>
            </div>
        </div>
        <?php
            $this->load->view('admin/include/footer-content');
        ?>

        <!-- Control Sidebar -->
        
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
<!-- ./wrapper -->
<?php
    $this->load->view('admin/include/footer');
?>