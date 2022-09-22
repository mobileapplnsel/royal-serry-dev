<?php
//echo '<pre>'; print_r($branchList);echo '</pre>'; //die;
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
            <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('error'); ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('success'); ?></div>
        <?php } ?>
            <section class="content-header">
                <h1>
                    Pickup/Delivery Staff List
                </h1>
                <ol class="breadcrumb">
                    <!--<li><a href="<?= base_url('admin/addcategory') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Category</a></li>-->
                    <li><a href="<?= base_url('admin/users-list') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Pickup/Delivery Staff List</li>
                </ol>
            </section>
            <section class="content-header">
                <div class="row">
                    <div class="col-xs-12">    
                        <div class="box">
                            <div class="box-body">   
                                <?php echo form_open(base_url('admin/pickup-delivery-boy-list'), array('id' => 'searchF', 'class' => 'form-inline','method'=>'POST', 'enctype' => 'multipart/form-data')); ?>
                                <div class="row">
                                    
                                    
                                    <div class="col-sm-4">
                                    	<!--<label>Select Branch:</label>-->
                                        <select class="form-control" name="branch_id" >
                                        <option value="">Select Branch Name</option>
                                        <?php
                                            if(!empty($branchList)){
                                                foreach($branchList as $branch){
                                        ?>
                                        <option value="<?= $branch->branch_id ?>" <?php if($branch->branch_id==$branch_id){ echo "selected";} ?>><?= $branch->name ?>&nbsp;(<?= $branch->email ?>)</option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="col-sm-4">&nbsp;&nbsp;&nbsp;</div>
                                    
                                    
                                    <div class="col-sm-4">                                        
                                        <input type="submit" name="search" id="search" class="btn btn-success" value="Search"> 
                                        <a href="<?php echo base_url('admin/pickup-delivery-boy-list'); ?>" class="btn btn-success">Reset</a>                                        
                                    </div>                                    
                                </div>                                
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Pickup/Delivery Staff List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        	<th class='notexport'>Action</th>
                                        	<th>Branch Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <!--<th>Edit</th>
                                            <th>Delete</th>-->
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($usersList)):
                                            foreach($usersList as $user){
                                        ?>
                                        <tr>
                                        	<td>
                                            <?php if($this->session->userdata('user_type') == 'MO' || $this->session->userdata('branch_id') == $user->branch_id){?>
                                            <ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <?php if (get_permission('PDLIST', 'is_edit')){ ?>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/editbranchuser/')?><?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                    <!--<li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="#"><i class="fa fa-eye text-green"></i> View</a></li>-->
                                                    
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/adduserarea/')?><?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-area-chart text-blue"></i> Add Area</a> </li>
                                                    
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/addusershift/')?><?= $user->user_id ?>"><i class="fa fa-calendar-check-o text-blue"></i> Add Shift</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/adduserduty/')?><?= $user->user_id ?>"><i class="fa fa-calendar text-blue"></i> Add Duty Allocation</a></li>
                                                    <li class="divider" role="presentation"></li>
                                                    <?php } ?>
                                                    <?php if($this->session->userdata('user_type') != 'MO'){ ?>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/addorderpickup/')?><?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-truck text-blue"></i> Pickup Order List</a> </li>
                                                    
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/addorderdelivery/')?><?= $user->user_id ?>"><i class="fa fa-truck text-blue"></i> Delivery Order List</a></li>
                                                    <li class="divider" role="presentation"></li>
                                                    <?php } ?>
                                                    <?php if (get_permission('PDLIST', 'is_delete')){ ?>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#UserDeleteModal" data-videotag-id="<?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                    <?php } ?>
                                                  </ul>
                                                </li>
                                              </ul>
                                            <?php }?>
                                            </td>
                                            <td><?= $user->branch_name ?>&nbsp;(<?= $user->branch_email ?>)</td>
                                            <td><?= $user->firstname ?></td>
                                            <td><?= $user->lastname ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->telephone ?></td>
                                            <td><?= $user->address.', '.$user->city_name.', '.$user->state_name.', '.$user->country_name.' - '.$user->zip ?></td>
                                            <td><?php if($user->status) {echo '<span class="label label-success">Active</span>';} else {echo '<span class="label label-warning">De-Active</span>';} ?></td>
                                            <!--<td><a href='<?= base_url('admin/editbranchuser/')?><?= $user->user_id ?>'><i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a></td>
                                            <td><a data-toggle="modal" data-target="#UserDeleteModal" data-videotag-id="<?= $user->user_id ?>" style="cursor:pointer;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>-->
                                            
                                            
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="9">No Branch Found</td>';
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