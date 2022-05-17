<?php
//echo '<pre>'; print_r($custom_status_details); print_r($shipment_id);echo '</pre>'; //die;
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
                    Add Order Custom Status
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/pdboy-delivery-order-list') ?>"><i class="fa fa-dashboard"></i>Delivery Order List</a></li>
                    <li class="active">Order Custom Status List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add Custom Order Status</h3>
                            </div>
                            <?php echo form_open(base_url('order/insertcustomorderstatus/'.$shipment_id.'/'.$status_id.'/'.$status_type), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Add New Custom Order Status </div>
                            <div class="box-body">
                               <div class="form-group col-md-6 col-md-offset-3"></div>
                            		<div class="form-group col-md-4">
                                    <label for="parent">Status Name<span>*</span> : </label>                        
                                    <select class="form-control" name="status_text" id="status_text" required>
                                        <option value="Rescheduled">Rescheduled</option>
                                        <option value="Undelivered">Undelivered</option>
                                        <option value="Returned">Returned</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="parent">Comment<span>*</span> : </label> 
                                    <input type="text" class="form-control" placeholder="Enter comment" name="comment" required>
                                 </div>
                                
                                	
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Add Custom Status</button>
                                  <a href="<?php echo base_url('admin/pdboy-delivery-order-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="shipment_id" value="<?php echo $shipment_id;?>" />
                                <input type="hidden" name="status_id" value="<?php echo $status_id;?>" />
                                <input type="hidden" name="status_type" value="<?php echo $status_type;?>" />
                                
                                <input type="hidden" name="branch_id" value="<?php echo $this->session->userdata('branch_id');?>" />
                                <input type="hidden" name="created_by" value="<?php echo $this->session->userdata('user_id');?>" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Custom Order Status List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Status</th> 
                                            <th>Comment</th>                                           
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($custom_status_details)):
                                            foreach($custom_status_details as $OrderStatus){
                                        ?>
                                        <tr>
                                            <td><?= $OrderStatus->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                   <li role="presentation"> <a data-toggle="modal" data-target="#OrdercustomStatusDeleteModal" data-CustomOrderStatus-id="<?= $OrderStatus->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $OrderStatus->status_text ?></td>
                                            <td><?= $OrderStatus->comment ?></td>
                                            <td><?= date("m-d-Y H:i:s", strtotime($OrderStatus->created_date)); ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="4">No order status Found</td>';
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