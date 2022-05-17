<?php
//echo '<pre>'; print_r($ShippingModeList); print_r($ShippingCatList); print_r($ShippingDocumentCatList); print_r($ShippingPackageCatList); die;
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
                    Add New Rate
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/rate-list') ?>"><i class="fa fa-dashboard"></i> Rate </a></li>
                    <li class="active">Add New Rate</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('rate/insertrate'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Add New Rate </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_mode_id" required>
                            	<option value="">Select Shipping Mode</option>
                                <?php
                                    if(!empty($ShippingModeList)){
                                        foreach($ShippingModeList as $ShippingMode){
                                ?>
                                <option value="<?= $ShippingMode->id ?>"><?= $ShippingMode->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Delivery Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="delivery_mode_id" required>
                            	<option value="">Select Delivery Mode</option>
                                <?php
                                    if(!empty($DeliveryModeList)){
                                        foreach($DeliveryModeList as $DeliveryMode){
                                ?>
                                <option value="<?= $DeliveryMode->id ?>"><?= $DeliveryMode->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_cat_id" id="ship_cat_id" required>
                            	<option value="">Select Shipping Category</option>
                                <?php
                                    if(!empty($ShippingCatList)){
                                        foreach($ShippingCatList as $ShippingCat){
                                ?>
                                <option value="<?= $ShippingCat->id ?>"><?= $ShippingCat->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Item Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_subcat_id" id="ship_subcat_id" required>
                                <option value="">Select Item Category</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Item Sub-Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_sub_subcat_id" id="ship_sub_subcat_id" required>
                                <option value="">Select Item Sub-Category</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="status">Rate Type<span>*</span> : </label>                        
                            <select class="form-control" name="rate_type" id="rate_type" required>
                                <option value="D">Distance</option>
                                <option value="L">Location</option>
                            </select>
                        </div> 
                        <div id="location_div" style="display:none">
                            <div class="form-group col-md-6">
                                <label for="email">From Location Name<span>*</span> : </label>
                                <!--<input type="text" class="form-control" placeholder="From Location Name" name="location_from" id="location_from" value="" >-->
                                <?php echo fillCombo('states_master', 'id', 'name', '', '', 'id', 'form-control', 'location_from', 'location_from'); ?>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="email">To Location Name<span>*</span> : </label>
                                <!--<input type="text" class="form-control" placeholder="To Location Name" name="location_to" value="" >-->
                                <?php echo fillCombo('states_master', 'id', 'name', '', '', 'id', 'form-control', 'location_to', 'location_to'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Miles<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Miles" name="miles" onKeyPress="javascript:return isNumber(event)" maxlength="6" value="" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Rate($)<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Rate" name="rate" onKeyPress="javascript:return isNumber(event)" maxlength="6" value="" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Insurance($)<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Insurance" name="insurance" onKeyPress="javascript:return isNumber(event)" maxlength="6" value="" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">De-Active</option>
                            </select>
                        </div> 
                                              
                        
                        </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Add Rate</button>
                      <a href="<?php echo base_url('admin/rate-list'); ?>" class="btn btn-info pull-right">Back</a>
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