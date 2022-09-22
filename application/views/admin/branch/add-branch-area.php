<?php
//echo '<pre>'; print_r($branchAreaList);echo '</pre>';
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
                    Add / Edit Branch Area
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addbranch') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Branch</a></li>
                    <li><a href="<?= base_url('admin/branch-list') ?>"><i class="fa fa-dashboard"></i>Branch List</a></li>
                    <li class="active">Branch Area List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add / Edit Area</h3>
                            </div>
                            <?php echo form_open(base_url('branch/insertbrancharea/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Add New Area </div>
                            <div class="box-body">
                                <div class="form-group col-md-6 col-md-offset-3"></div>
                            	<!-- <div class="form-group col-md-6">
                                <label for="email">Area Postcode<span>*</span> : </label>
                                <select class="form-control" name="area_id[]" id="area_id" multiple="multiple" style="width: 75%" required>                                 
                                </select> -->
                                <div class="form-group col-md-6">
                                <label for="email">City<span>*</span> : </label>
                                <select class="form-control select2field" name="city_id[]" id="city_id"style="width: 75%" multiple required>  
                                <?php foreach ($cities as $key => $citie) { ?>
                                    <option value="<?php echo $citie->id ?>"><?php echo $citie->name ?></option>
                                <?php } ?>                               
                                </select>
                            </div>
                            </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Add Area</button>
                                  <a href="<?php echo base_url('admin/branch-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="branch_id" value="<?php echo $this->uri->segment(3);?>" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Branch Area List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SN.</th>
                                            <th>Action</th>
                                            <th>Area Name</th>                                            
                                            <th>Branch Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($branchAreaList)):
                                            foreach($branchAreaList as $key=>$branchArea){
                                        ?>
                                        <tr>
                                            <td><?= $key+1; ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#BranchAreaDeleteModal" data-area-id="<?= $branchArea->branch_areaID ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <!-- <td><?= $branchArea->place_name.', '.$branchArea->state_name.', '.$branchArea->county_name.' - '.$branchArea->postal_code ?></td> -->
                                            <td><?= $branchArea->city_name;?></td>
                                            <td><?= $branchArea->branch_name ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="4">No Branch Area Found</td>';
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