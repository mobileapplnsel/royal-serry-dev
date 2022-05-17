<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo '<pre>'; print_r($categoryList);echo '</pre>';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
            $this->load->view('admin/include/sidebar');
        ?>
        <div class="content-wrapper">
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <section class="content-header">
                <h1>
                    Add New Shift
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/shift-list') ?>"><i class="fa fa-dashboard"></i> Shift List </a></li>
                    <li class="active">Add New Shift</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('shift/insertshift'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Add New Shift </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Shift Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Shift Name" maxlength="20" name="shift_name" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Shift Type<span>*</span> : </label>                        
                            <select class="form-control" name="shift_type" required>
                                <option value="">Select Shift Type</option>
                                <option value="M">Morning</option>
                                <option value="E">Evening</option>
                                <option value="N">Night</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Time From<span>*</span> : </label>
                            <input type="time" class="form-control" placeholder="Shift Time From" name="time_from" id="time_from" value="" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Time To<span>*</span> : </label>
                            <input type="time" class="form-control" placeholder="Shift Time To" name="time_to" id="time_to" value="" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="status">Status<span>*</span> : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">De-Active</option>
                            </select>
                        </div> 
                                              
                        
                        </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Add Shift</button>
                      <a href="<?php echo base_url('admin/shift-list'); ?>" class="btn btn-info pull-right">Back</a>
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