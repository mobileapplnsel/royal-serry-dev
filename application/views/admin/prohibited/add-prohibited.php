<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                    Add New Prohibited
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/prohibited-list') ?>"><i class="fa fa-dashboard"></i> Prohibited List </a></li>
                    <li class="active">Add New Prohibited</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('prohibited/insertprohibited'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Add New Prohibited </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Prohibited Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Prohibited Name" maxlength="20" onKeyUp="this.value=this.value.replace(/[^A-z_ ]/g,'');" name="name" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="shipping_category_id" required>
                                <option value="">Select Shipping Category</option>
                                <?php
                                    if(!empty($ShippingCategoryList)){
                                        foreach($ShippingCategoryList as $scategory){
                                ?>
                                <option value="<?= $scategory->id ?>"><?= $scategory->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="shipping_mode_id" required>
                                <option value="">Select Shipping Mode</option>
                                <?php
                                    if(!empty($ShippingModeList)){
                                        foreach($ShippingModeList as $mcategory){
                                ?>
                                <option value="<?= $mcategory->id ?>"><?= $mcategory->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Status<span>*</span> : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">De-Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Prohibited Description<span>*</span> : </label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Prohibited Description ..." required></textarea>
                        </div>
                        
                         
                                              
                        
                        </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Add Prohibited</button>
                      <a href="<?php echo base_url('admin/prohibited-list'); ?>" class="btn btn-info pull-right">Back</a>
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