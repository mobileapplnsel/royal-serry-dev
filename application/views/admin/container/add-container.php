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
                    Add New Container
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/container-list') ?>"><i class="fa fa-dashboard"></i> Container </a></li>
                    <li class="active">Add New Container/Shipment</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('container/insertcontainer'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Add New Container/Shipment </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
						<div class="form-group col-md-12">
                            <label for="email">Shipment Details<span>*</span> : </label>
                            <textarea rows="10" cols="60" class="form-control" name="shipment_details" style="resize:none;" required></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Container No : </label>
                            <input type="text" class="form-control" placeholder="Container No" name="container_no" maxlength="20" value="">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="shipment_mode" id="shipment_mode" required>
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
                            <label for="email"><span id="lbltext">Vehicle Number</span> <span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Vehicle Number" name="vehicle_number" maxlength="20" value="" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="status">Status<span>*</span> : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1">Initiated</option>
                                <option value="2">Uploading</option>
                                <option value="3">Shipment</option>
                                <option value="4">Arrived</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">From Branch Location<span>*</span> : </label>
                            <?php 
							if($this->session->userdata('user_type') == 'MO'){
								echo fillCombo('branch', 'branch_id', 'name', '', 'is_main_office="0"', 'branch_id', 'form-control', 'from_branch_id', 'from_branch_id'); 
							} else {
								echo fillCombo('branch', 'branch_id', 'name', '', 'branch_id='.$this->session->userdata('branch_id'), 'branch_id', 'form-control', 'from_branch_id', 'from_branch_id');
							}
							?>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">To Branch Location<span>*</span> : </label>
                            <?php //echo fillCombo('branch', 'branch_id', 'name', '', 'is_main_office="0"', 'branch_id', 'form-control', 'to_branch_id', 'to_branch_id'); ?>
                            <select class="form-control" name="to_branch_id" id="to_branch_id" required>
                                <option value="">Select To Branch ID</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Via Branch Name: </label>
                            	<select class="form-control" name="branch_id[]" id="branch_id" multiple="multiple">
                            </select>
                        </div>
                        
                        
                        
                        
                        <div class="form-group col-md-6">
                            <label for="email">Schedule Date<span>*</span> : </label>
                            <input type="date" class="form-control" placeholder="Schedule Date" name="schedule_date" id="schedule_date" value="" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Arrival Date<span>*</span> : </label>
                            <input type="date" class="form-control" placeholder="Arrival Date" name="date_of_arrival" id="date_of_arrival" value="" required>
                        </div>
                        
                         <div class="form-group col-md-6">
                            <label for="date_time">Shipment Date/Time<span>*</span> : </label>
                            <input type="datetime-local" class="form-control" placeholder="Shipment Date/Time" name="date_time" id="ship_date_time" value=""  required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Remarks<span>*</span> : </label>
                            <textarea rows="5" cols="60" class="form-control" name="remarks" style="resize:none;" required></textarea>
                        </div>                      
                        
                        </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Add Shipment</button>
                      <a href="<?php echo base_url('admin/container-list'); ?>" class="btn btn-info pull-right">Back</a>
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