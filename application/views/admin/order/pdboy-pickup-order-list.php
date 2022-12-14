<?php
//echo '<pre>'; print_r($HolidayList); echo '</pre>'; //die;
$a=array();
if(!empty($HolidayList)){
	foreach($HolidayList as $Holiday){
		array_push($a, $Holiday->from_date);
	}
}
  
$CI =& get_instance();
$CI->load->model('container_model');
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
                    Pickup Order List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/pdboy-pickup-order-list') ?>"><i class="fa fa-dashboard"></i>Pickup Order List</a></li>
                    <li class="active">Pickup Order List</li>
                </ol>
            </section>
            <section class="content-header">
                <div class="row">
                    <div class="col-xs-12">    
                        <div class="box">
                            <div class="box-body">   
                                <?php echo form_open(base_url('admin/pdboy-pickup-order-list'), array('id' => 'searchF', 'class' => 'form-inline','method'=>'POST', 'enctype' => 'multipart/form-data')); ?>
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
                                        <input type="submit" name="search" id="search" class="btn btn-success" value="Search">
                                        <a href="<?php echo base_url('admin/pdboy-pickup-order-list'); ?>" class="btn btn-success">Reset</a>                                       
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
                                <h3 class="box-title">Pickup Order List</h3>
                            </div>
                            
                            <div class="box-body">
                            <?php if (in_array(date("Y-m-d"), $a)){
								echo "Today is our holiday!!";
							} else {?>
                            <div class="col-sm-12"> 
                            	<a href="<?php echo base_url('admin/google-map-direction'); ?>" class="btn btn-info" target="_blank" style="width:195px; margin-left:170px;">Show direction in google map</a>
                            </div>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Order No</th>                                            
                                            <th>Pickup Address</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Item Name/Barcode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($userPickupOrderList)):
                                            foreach($userPickupOrderList as $userPickup){
                                        ?>
                                        <tr>
                                            <td><?= $userPickup->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                  <?php if($userPickup->status) {?>
                                                  <li role="presentation"> <a role="button" href="<?= base_url('admin/pdboyorderstatuschange/')?><?= $userPickup->id ?>/0" class="btn" style="text-align: left"><i class="fa fa-plus text-blue"></i>Change Status to Not-Picked-up</a> </li>
                                                  <?php } else {?>
                                                  <li role="presentation"> <a role="button" href="<?= base_url('admin/pdboyorderstatuschange/')?><?= $userPickup->id ?>/1" class="btn" style="text-align: left"><i class="fa fa-plus text-blue"></i>Change Status to Picked-up</a> </li>
                                                  <!--<li role="presentation"> <a role="button" href="<?= base_url('admin/addordercustomstatus/')?><?= $userPickup->shipment_id ?>/7/1" class="btn" style="text-align: left"><i class="fa fa-plus text-blue"></i>Add Order Custom Status</a> </li>-->
                                                  <?php }?>
                                                  <li role="presentation"> <a role="button" href="<?= base_url('admin/pdboy-pickup-image-upload/')?><?= $userPickup->shipment_id; ?>" class="btn" style="text-align: left"><i class="fa fa-plus text-blue"></i>Upload Image</a> </li>

                                                  <li role="presentation"> <a role="button" href="<?= base_url('admin/edit-order-details/')?><?= $userPickup->shipment_id; ?>" class="btn" style="text-align: left"><i class="fa fa-plus text-blue"></i>Edit Order Details</a> </li>

                                                   <!--<li role="presentation"> <a data-toggle="modal" data-target="#UserPickupOrderDeleteModal" data-UserPickupOrder-id="<?= $userPickup->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>-->
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $userPickup->shipment_no ?></td>
                                            <td><?php echo '<strong>Name</strong>: '.$userPickup->from_firstname.' '.$userPickup->from_lastname.'<br>'.$userPickup->from_address.'<br>'.$userPickup->from_address2.'<br><strong>City</strong>: '.$userPickup->city_name.'<br><strong>State</strong>: '.$userPickup->state_name.'<br><strong>Country</strong>: '.$userPickup->country_name.'<br><strong>Zip</strong>: '.$userPickup->from_zip.'<br><strong>Telephone</strong>: '.$userPickup->from_telephone;?></td>
                                            <td><?= date('m-d-Y',strtotime($userPickup->shipment_date));?></td>
                                            <td><?php if($userPickup->status) {echo '<span class="label label-success">Picked-up</span>';} else {echo '<span class="label label-warning">Not-Pickup</span>';} ?></td>
                                            <td>
                                                <table width="100%" border="0" cellspacing="1" cellpadding="15" >
                                                <?php  
												$quote_item_details = $this->container_model->containerItemDetails($userPickup->shipment_id);
												//echo '<pre>'; print_r($quote_item_details); echo '</pre>';
												$count = 1;
												foreach($quote_item_details as $items){
													$year = date("y");
													$itemsId = str_pad($count, 3, '0', STR_PAD_LEFT);
													$shipmentId = str_pad($userPickup->shipment_id, 7, '0', STR_PAD_LEFT);
													//if($this->container_model->checkItemExistByshipmentID($shipment->shipment_id, $items->id) == 0){
												?>
                                                  <tr>
                                                    <td style=" border-bottom:1px solid #999; border-right:1px solid #999;"><?= $items->item_name ?></td>
                                                    <td style=" border-bottom:1px solid #999; border-right:1px solid #999;"><img src="<?php echo base_url(); ?>index.php/container/set_barcode/<?php echo $year.$shipmentId.$itemsId ?>"  alt="barcode" /></td>
                                                    <td style=" border-bottom:1px solid #999; border-right:1px solid #999;"><a href="<?php echo base_url(); ?>admin/print-barcode/<?php echo $userPickup->shipment_id.'/'.$count; ?>" target="_blank" class="btn btn-primary">Print</a></td>
                                                  </tr>
                                                  <?php $count++;}//} ?>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="6">No Pickup Order Found</td>';
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                             <?php } ?>   
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