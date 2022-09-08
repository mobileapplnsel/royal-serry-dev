<?php
//echo '<pre>'; print_r($userShiftList);echo '</pre>';
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
                    Add / Edit Duty Allocation
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/adduser') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New User</a></li>
                    <li><a href="<?= base_url('admin/pickup-delivery-boy-list') ?>"><i class="fa fa-dashboard"></i>Pickup/Delivery Staff List</a></li>
                    <li class="active">Pickup/Delivery Staff Duty Allocation List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add / Edit Duty</h3>
                            </div>
                            <?php echo form_open(base_url('users/insertuserduty/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Add New Duty Allocation </div>
                            <div class="box-body">
                               <div class="form-group col-md-6 col-md-offset-3"></div>
                            		<div class="form-group col-md-6">
                                    <label for="parent">Shift Name<span>*</span> : </label>                        
                                    <select class="form-control" name="shift_id" id="user_shift_id" required>
                                    	<option value="">Select Shift</option>
                                        <?php
                                            if(!empty($ShiftList)){
                                                foreach($ShiftList as $Shift){
                                        ?>
                                        <option value="<?= $Shift->id ?>"><?= $Shift->shift_name.' ('.$Shift->shift_type.')' ?></option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">From Date<span>*</span> : </label>
                                    <input type="date" class="form-control" placeholder="From Date" name="from_date" id="schedule_date" value="" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="email">To Date : </label>
                                    <input type="date" class="form-control" placeholder="To Date" name="to_date" id="date_of_arrival" value="">
                                </div>
                                	
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Add Duty</button>
                                  <a href="<?php echo base_url('admin/pickup-delivery-boy-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="pd_id" id="pd_id" value="<?php echo $this->uri->segment(3);?>" />
                                <input type="hidden"  id="ship_date_time" value="" >
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Pickup/Delivery Staff Duty Allocation List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Shift Name</th>                                            
                                            <th>From Date</th>
                                            <th>To Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($userShiftList)):
                                            foreach($userShiftList as $userShift){
                                        ?>
                                        <tr>
                                            <td><?= $userShift->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                  <li role="presentation"> <a role="button" href="<?= base_url('admin/edituserduty/')?><?= $this->uri->segment(3).'/'.$userShift->id ?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                   <li role="presentation"> <a data-toggle="modal" data-target="#UserDutyalloDeleteModal" data-dutyallo-id="<?= $userShift->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $userShift->shift_name.' ('.$userShift->time_from.' To '.$userShift->time_to.')' ?></td>
                                            <td><?= date("m-d-Y", strtotime($userShift->from_date));?></td>
                                            <td><?= date("m-d-Y", strtotime($userShift->to_date));?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="5">No Duty Found</td>';
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>                    
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