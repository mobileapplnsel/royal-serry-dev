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
                    Add Branch Holiday
                </h1>
                <ol class="breadcrumb">
                    <!--<li><a href="<?= base_url('admin/addbranch') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Branch</a></li>-->
                    <li><a href="<?= base_url('admin/branch-list') ?>"><i class="fa fa-dashboard"></i>Branch List</a></li>
                    <li class="active">Branch Holiday List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add Holiday</h3>
                            </div>
                            <?php echo form_open(base_url('branch/insertbranchHoliday/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> &nbsp; </div>
                            <div class="box-body">
                               <div class="form-group col-md-6 col-md-offset-3"></div>
                                <div class="form-group col-md-12">
                                    <label for="email">Holiday Name<span>*</span> : </label>
                                    <input type="text" class="form-control" placeholder="Holiday Name" name="name" maxlength="50" onKeyUp="this.value=this.value.replace(/[^A-z_ ]/g,'');" value="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">From Date<span>*</span> : </label>
                                    <input type="date" class="form-control" placeholder="From Date" name="from_date" id="schedule_date" value="" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="email">To Date<span>*</span> : </label>
                                    <input type="date" class="form-control" placeholder="To Date" name="to_date" id="date_of_arrival" value="" required>
                                </div>
                                
                                	
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Add Holiday</button>
                                  <a href="<?php echo base_url('admin/branch-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="branch_id" value="<?php echo $this->uri->segment(3);?>" />
                                <input type="hidden" id="ship_date_time" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Branch Holiday List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Name</th>                                            
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($branchHolidayList)):
                                            foreach($branchHolidayList as $branchHoliday){
                                        ?>
                                        <tr>
                                            <td><?= $branchHoliday->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                   <li role="presentation"> <a data-toggle="modal" data-target="#BranchHolidayDeleteModal" data-branchHoliday-id="<?= $branchHoliday->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $branchHoliday->name; ?></td>
                                            <td><?= $branchHoliday->from_date ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="4">No Branch Holiday Found</td>';
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