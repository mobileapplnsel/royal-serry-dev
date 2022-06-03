<?php
//echo '<pre>'; print_r($getViaBranchList); //print_r($ShippingCatList); print_r($ShippingDocumentCatList); die;
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
                    Edit Container/Shipment
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/container-list') ?>"><i class="fa fa-dashboard"></i> Container List </a></li>
                    <li class="active">Edit Container/Shipment</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    
                    <?php echo form_open(base_url('container/updateContainer/'.$editContainer[0]->id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Edit Container/Shipment </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                       <div class="form-group col-md-12">
                            <label for="email">Shipment Details<span>*</span> : </label>
                            <textarea rows="10" cols="60" class="form-control" name="shipment_details" style="resize:none;" required><?= $editContainer[0]->shipment_details ?></textarea>
                        </div>
                       <div class="form-group col-md-6">
                            <label for="email">Container No : </label>
                            <input type="text" class="form-control" placeholder="Container No" name="container_no" maxlength="20" value="<?= $editContainer[0]->container_no ?>">
                        </div>
                        
                       	<div class="form-group col-md-6">
                            <label for="parent">Shipping Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="shipment_mode" id="shipment_mode" required>
                                <?php
                                    if(!empty($ShippingModeList)){
                                        foreach($ShippingModeList as $ShippingMode){
                                ?>
                                <option value="<?= $ShippingMode->id ?>" <?php if($ShippingMode->id==$editContainer[0]->shipment_mode){ echo "selected";} ?>><?= $ShippingMode->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email"><span id="lbltext"><?php 
							if($editContainer[0]->shipment_mode==1){
								echo 'Truck No';
							} elseif($editContainer[0]->shipment_mode==2){
								echo 'Rail No';
							} elseif($editContainer[0]->shipment_mode==3){
								echo 'Flight No';
							} elseif($editContainer[0]->shipment_mode==4){
								echo 'Ship No';
							}
							?></span><span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Vehicle Number" name="vehicle_number" maxlength="20" value="<?= $editContainer[0]->vehicle_number ?>" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="status">Status<span>*</span> : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1" <?php if($editContainer[0]->status == 1) {echo 'selected';} ?>>Initiated</option>
                                <option value="2" <?php if($editContainer[0]->status == 2) {echo 'selected';} ?>>Uploading</option>
                                <option value="3" <?php if($editContainer[0]->status == 3) {echo 'selected';} ?>>Shipment</option>
                                <option value="4" <?php if($editContainer[0]->status == 4) {echo 'selected';} ?>>Arrived</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">From Branch Location<span>*</span> : </label>
                            <?php
							if($this->session->userdata('user_type') == 'MO'){ 
								echo fillCombo('branch', 'branch_id', 'name', $editContainer[0]->from_branch_id, 'is_main_office="0"', 'branch_id', 'form-control', 'from_branch_id', 'from_branch_id'); 
							} else {
								echo fillCombo('branch', 'branch_id', 'name', $editContainer[0]->from_branch_id, 'branch_id='.$this->session->userdata('branch_id'), 'branch_id', 'form-control', 'from_branch_id', 'from_branch_id');
							}
							?>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">To Branch Location<span>*</span> : </label>
                            <?php echo fillCombo('branch', 'branch_id', 'name', $editContainer[0]->to_branch_id, 'is_main_office="0"', 'branch_id', 'form-control', 'to_branch_id', 'to_branch_id'); ?>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="email">Via Branch Name : </label>
                            	<select class="form-control" name="branch_id[]" id="branch_id" multiple="multiple">
                                <?php
                                    if(!empty($getViaBranchList)){
                                        foreach($getViaBranchList as $Branch){
                                ?>
                                    <option value="<?= $Branch->branchId ?>" selected><?= $Branch->branchName ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        
                        
                        
                        <div class="form-group col-md-6">
                            <label for="email">Schedule Date<span>*</span> : </label>
                            <input type="date" class="form-control" placeholder="Schedule Date" name="schedule_date" id="schedule_date" value="<?= $editContainer[0]->schedule_date ?>" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Arrival Date<span>*</span> : </label>
                            <input type="date" class="form-control" placeholder="Arrival Date" name="date_of_arrival" id="date_of_arrival" value="<?= $editContainer[0]->date_of_arrival ?>" required>
                        </div>
                        
                         <div class="form-group col-md-6">
                            <label for="date_time">Shipment Date/Time<span>*</span> : </label>
                            <input type="datetime-local" class="form-control" placeholder="Shipment Date/Time" name="date_time" id="ship_date_time" value="<?= $editContainer[0]->date_time ?>" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Remarks<span>*</span> : </label>
                            <textarea rows="5" cols="60" class="form-control" name="remarks" style="resize:none;" required><?= $editContainer[0]->remarks ?></textarea>
                        </div>
                        
                        
                        </div>                     
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update Shipment</button>
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