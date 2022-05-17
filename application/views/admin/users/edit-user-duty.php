<?php
//echo '<pre>'; print_r($userDutyDetails);echo '</pre>';
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
			//echo '<pre>'; print_r($editVidResolution); echo '</pre>';
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
                    Edit Duty Allocation
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/adduser') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New User</a></li>
                    <li><a href="<?= base_url('admin/pickup-delivery-boy-list') ?>"><i class="fa fa-dashboard"></i>Pickup/Delivery Boy List</a></li>
                    <li class="active">Pickup/Delivery Boy Duty Allocation List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Edit Duty</h3>
                            </div>
                            <?php echo form_open(base_url('users/updateuserduty/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Edit Duty Allocation </div>
                            <div class="box-body">
                               <div class="form-group col-md-6 col-md-offset-3"></div>
                            		<div class="form-group col-md-6">
                                    <label for="parent">Shift Name<span>*</span> : </label>                        
                                    <select class="form-control" name="shift_id" id="user_shift_id" disabled>
                                    	<option value="">Select Shift</option>
                                        <?php
                                            if(!empty($ShiftList)){
                                                foreach($ShiftList as $Shift){
                                        ?>
                                        <option value="<?= $Shift->id ?>" <?php if($Shift->id == $userDutyDetails[0]->shift_id){ echo 'selected';}?> ><?= $Shift->shift_name.' ('.$Shift->shift_type.')' ?></option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">From Date<span>*</span> : </label>
                                    <input type="date" class="form-control" placeholder="From Date" name="from_date" id="schedule_date" value="<?= $userDutyDetails[0]->from_date;?>" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="email">To Date<span>*</span> : </label>
                                    <input type="date" class="form-control" placeholder="To Date" name="to_date" id="date_of_arrival" value="<?= $userDutyDetails[0]->to_date;?>" required>
                                </div>
                                	
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Update Duty</button>
                                  <a href="<?php echo base_url('admin/adduserduty/'.$this->uri->segment(3)); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="pd_id" id="pd_id" value="<?php echo $this->uri->segment(3);?>" />
                                <input type="hidden"  id="ship_date_time" value="" >
                            </div>
                            <?php echo form_close(); ?>
                                                
                        </div>
                        <div class="box">
                            
                        </div>
                    </div>            
                </div>
            </section>
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