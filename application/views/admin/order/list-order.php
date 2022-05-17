<?php
//echo '<pre>'; print_r($orderList);echo '</pre>';
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
$CI =& get_instance();
$CI->load->model('order_model');
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
                    All Order List
                </h1>
                <ol class="breadcrumb">
                    <!--<li><a href="<?= base_url('admin/adddocument') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Quotation</a></li>-->
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Order List</li>
                </ol>
            </section>
            <section class="content-header">
                <div class="row">
                    <div class="col-xs-12">    
                        <div class="box">
                            <div class="box-body">   
                                <?php echo form_open(base_url('admin/order-list'), array('id' => 'searchF', 'class' => 'form-inline','method'=>'POST', 'enctype' => 'multipart/form-data')); ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>From Date</label>
                                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="mm-dd-yyyy" value="<?php echo $from_date; ?>" readonly>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>To Date</label>
                                        <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="mm-dd-yyyy" value="<?php echo $to_date; ?>" readonly>
                                    </div>
                                    <div class="col-sm-4">
                                    	<label>Order Status:</label>
                                        <select class="form-control" name="status_id" >
                                        <option value="">Select Order Status</option>
                                        <?php
                                            if(!empty($StatusList)){
                                                foreach($StatusList as $Status){
                                        ?>
                                        <option value="<?= $Status->id ?>" <?php if($Status->id==$status_id){ echo "selected";} ?>><?= $Status->status_name ?></option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="col-sm-4" style="width:100%">&nbsp;</div>
                                    <div class="col-sm-4">
                                        <label>Category:</label>
                                        <select class="form-control cast-crew-multiple" name="ship_cat_id" id="ship_cat_id">
                                            <option value="">Select Category</option>
                                            <?php
                                                if(!empty($ShippingCatList)){
                                                    foreach($ShippingCatList as $ShippingCat){
                                            ?>
                                            <option value="<?= $ShippingCat->id ?>" <?php if($ShippingCat->id==$ship_cat_id){ echo "selected";} ?>><?= $ShippingCat->name ?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Sub-category:</label>
                                        <select class="form-control cast-crew-multiple" name="category_id" id="ship_subcat_id">
                                            <option value="">Select Item Category</option>
                                            <?php
												if(!empty($ShippingDocumentCatList)){
													foreach($ShippingDocumentCatList as $ShippingDocumentCat){
											?>
											<option value="<?= $ShippingDocumentCat->cat_id ?>" <?php if($ShippingDocumentCat->cat_id==$category_id){ echo "selected";} ?>><?= $ShippingDocumentCat->category_name ?></option>
											<?php 
													}
												}
											?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">                                        
                                        <input type="submit" name="search" id="search" class="btn btn-success" value="Search"> 
                                        <a href="<?php echo base_url('admin/order-list'); ?>" class="btn btn-success">Reset</a>                                        
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
                                <h3 class="box-title">Order List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Order No</th>
                                            <th>Customer Name</th>
                                            <th>Ordered Date</th>
                                            <th>Amount($)</th>
                                            <th>Payment Mode</th>
                                            <th>Order Status</th>
											<th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($orderList)):
                                            foreach($orderList as $order){
                                        ?>
                                        <tr>
                                            <td><?= $order->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/vieworder/')?><?= $order->id ?>" class="btn" style="text-align: left"><i class="fa fa-eye text-blue"></i> View Order</a> </li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/print-invoice/')?><?= $order->id ?>" class="btn" style="text-align: left" target="_blank"><i class="fa fa-file-code-o text-blue"></i> Print Invoice</a> </li>
                                                    <?php if($order->status==1) {?>
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/add-order-status/')?><?= $order->id ?>" class="btn" style="text-align: left"><i class="fa fa-plus text-blue"></i> Add Order Status</a> </li>
                                                   
                                                    <!--<li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#OrderDeleteModal" data-order-id="<?= $order->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>-->
                                                    
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/orderclosed/')?><?= $order->id ?>/2" class="btn" style="text-align: left"><i class="fa fa-times-circle text-blue"></i>Mark as closed</a> </li>
                                                    <?php }?>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $order->shipment_no ?></td>
                                            <td><?= $order->firstname.' '.$order->lastname ?></td>
                                            <td><?= date("m-d-Y", strtotime($order->created_date)); ?></td>
                                            <td><?= $order->grand_total ?></td>
                                            <td><?php if($order->payment_mode==3)
												{ echo 'Credit';} 
												elseif($order->payment_mode==2)
												{ echo 'Card';}
												else { echo 'Pay later';} ?></td>
											<?php
											$order_status = $this->order_model->getOrderStatusDetails($order->id);
											if(!empty($order_status)){
											foreach($order_status as $val){
											?>
											<td><span class="label label-success"><?php echo $val['status_name'];?></span></td>
											<?php } } else {?>
											<td><span class="label label-success">Ready for Pickup</span></td>
											<?php }?>
                                             <td><?php if($order->status==1) {echo '<span class="label label-success">Opened</span>';} else {echo '<span class="label label-warning">Closed</span>';} ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="8">No Order Found</td>';
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