<?php
//echo '<pre>'; print_r($containerList);echo '</pre>';
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
                    All Container/Shipment List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addcontainer') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Shipment</a></li>
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Shipment List</li>
                </ol>
            </section>
            <?php if($this->session->userdata('user_type') == 'MO'){ ?>
            <section class="content-header">
                <div class="row">
                    <div class="col-xs-12">    
                        <div class="box">
                            <div class="box-body">   
                                <?php echo form_open(base_url('admin/container-list'), array('id' => 'searchF', 'class' => 'form-inline','method'=>'POST', 'enctype' => 'multipart/form-data')); ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control" name="from_branch_id" >
                                        <option value="">From Branch Name</option>
                                        <?php
                                            if(!empty($branchList)){
                                                foreach($branchList as $branch){
                                        ?>
                                        <option value="<?= $branch->branch_id ?>" <?php if($branch->branch_id==$from_branch_id){ echo "selected";} ?>><?= $branch->name ?>&nbsp;(<?= $branch->email ?>)</option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <select class="form-control" name="to_branch_id" >
                                        <option value="">To Branch Name</option>
                                        <?php
                                            if(!empty($branchList)){
                                                foreach($branchList as $branch){
                                        ?>
                                        <option value="<?= $branch->branch_id ?>" <?php if($branch->branch_id==$to_branch_id){ echo "selected";} ?>><?= $branch->name ?>&nbsp;(<?= $branch->email ?>)</option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    
                                    
                                    <div class="col-sm-4">                                        
                                        <input type="submit" name="search" id="search" class="btn btn-success" value="Search"> 
                                        <a href="<?php echo base_url('admin/container-list'); ?>" class="btn btn-success">Reset</a>                                        
                                    </div>                                    
                                </div>                                
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php }?>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Shipment List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Shipment No</th>
                                            <th>Container No</th>
                                            <th>Shipping Mode</th>
                                            <th>Vehicle Number</th>
                                            <th>Schedule Date</th>
                                            <th>Arrival Date</th>
                                            <th>From Branch</th>
                                            <th>To Branch</th>
                                            <th>Status</th>
                                            <th>Space</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($containerList)):
                                            foreach($containerList as $container){
                                        ?>
                                        <tr>
                                            <td><?= $container->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                  <?php if($container->created_by == $this->session->userdata('user_id') || $this->session->userdata('user_type') == 'MO'){ ?>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/editcontainer/')?><?= $container->id ?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                    <?php if($container->full_status=='1'){ ?>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/editcontainertofull/')?><?= $container->id ?>/0" class="btn" style="text-align: left"><i class="fa fa-window-maximize text-blue"></i> Mark as Empty</a> </li>
                                                    <?php } else {?>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/editcontainertofull/')?><?= $container->id ?>/1" class="btn" style="text-align: left"><i class="fa fa-window-maximize text-blue"></i> Mark as Full</a> </li>
                                                    <?php } }?>
                                                    
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/add-item-to-container/')?><?= $container->id ?>" class="btn" style="text-align: left"><i class="fa fa-cart-plus text-blue"></i> Add Item To Shipment</a> </li>
                                                    
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/branch-container-item/')?><?= $container->id ?>" class="btn" style="text-align: left"><i class="fa fa-object-group text-blue"></i> Shipment Item For Your Branch</a> </li>
                                                    
                                                    <?php if($container->created_by == $this->session->userdata('user_id') || $this->session->userdata('user_type') == 'MO'){ ?>
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/view-item-to-container/')?><?= $container->id ?>" class="btn" style="text-align: left"><i class="fa fa-eye text-blue"></i> View Items</a> </li>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#ContainerDeleteModal" data-container-id="<?= $container->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                    <?php }?>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $container->shipment_no ?></td>
                                            <td><?= $container->container_no ?></td>
                                            <td><?= $container->shipping_mode_name ?></td>
                                            <td><?= $container->vehicle_number ?></td>
                                            <td><?= date("m-d-Y", strtotime($container->schedule_date));?></td>
                                            <td><?= date("m-d-Y", strtotime($container->date_of_arrival));?></td>
                                            <td><?= $container->from_branch_name ?></td>
                                            <td><?= $container->to_branch_name ?></td>
                                            <td><?php if($container->status=='1') 
											{echo '<span class="label label-info">Initiated</span>';} 
											else if($container->status=='2')
											 {echo '<span class="label label-warning">Uploading</span>';} 
											 else if($container->status=='3')
											 {echo '<span class="label label-success">Shipment</span>';}
											 else {echo '<span class="label label-danger">Arrived</span>';}
											 ?>
                                            </td>
                                            <td><?php if($container->full_status=='1') 
											{echo '<span class="label label-danger">Full</span>';} 
											else
											 {echo '<span class="label label-success">Empty</span>';} 
											 
											 ?>
                                            </td>
                                            
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="13">No Container Found</td>';
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