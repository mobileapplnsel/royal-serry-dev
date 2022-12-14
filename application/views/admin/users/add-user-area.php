<?php
//echo '<pre>'; print_r($userAreaList);echo '</pre>';
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
                    Add / Edit Area
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/adduser') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New User</a></li>
                    <li><a href="<?= base_url('admin/pickup-delivery-boy-list') ?>"><i class="fa fa-dashboard"></i>Pickup/Delivery Staff List</a></li>
                    <li class="active">Pickup/Delivery Staff Area List</li>
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
                            <?php echo form_open(base_url('users/insertuserarea/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Add New Area </div>
                            <div class="box-body">
                                <div class="form-group col-md-6 col-md-offset-3"></div>
                            	<div class="form-group col-md-6">
                                <label for="email">Area <span>*</span> : </label>
                                <select class="form-control select2field" name="area_id[]" id="user_area_ids" multiple="multiple" style="width: 75%" required>
                                <?php if($branchAreaList){ ?>    
                                <?php foreach($branchAreaList as $area){?> 
                                    <option value="<?=$area->city_id;?>"><?=$area->city_name;?></option>

                                <?php } }?>                             
                                </select>
                            </div>
                            </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Add Area</button>
                                  <a href="<?php echo base_url('admin/pickup-delivery-boy-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->uri->segment(3);?>" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Pickup/Delivery Staff Area List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Area Name</th>                                            
                                            <th>Pickup/Delivery Staff Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($userAreaList)):
                                            foreach($userAreaList as $userArea){
                                        ?>
                                        <tr>
                                            <td><?= $userArea->pd_boy_areaID ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <!--<li role="presentation"> <a role="button" href="<?= base_url('videos/insertseriesvideo') ?>/<?php echo $userArea->branch_id;?>/<?php echo $userArea->id;?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>-->
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#UserAreaDeleteModal" data-area-id="<?= $userArea->pd_boy_areaID ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $userArea->city_name ?></td>
                                            <td><?= $userArea->firstname.' '.$userArea->lastname ?></td>
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