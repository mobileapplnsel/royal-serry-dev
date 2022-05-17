<?php
$CI =& get_instance();
$CI->load->model('container_model');
//echo '<pre>'; print_r($getAddedItemShipmentDetails); echo '</pre>'; //die;
//echo '====>>'.$full_status;
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
  $container_id = $this->uri->segment(3);
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
                    Shipment Item List For Your Branch
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addcontainer') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Shipment</a></li>
                    <li><a href="<?= base_url('admin/container-list') ?>"><i class="fa fa-dashboard"></i>Container List</a></li>
                    <li class="active">Order Item List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><strong>Container/Shipment Item List For Your Branch</strong></h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Shipment Id</th>
                                            <th>Shipment Order No</th>                                            
                                            <th>Destination Branch</th>
                                            <th>Item Name/Barcode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($getAddedItemShipmentDetails)):
                                            foreach($getAddedItemShipmentDetails as $AddedItem){
                                        ?>
                                        <tr>
                                            <td><?= $AddedItem->order_id ?></td>
                                            <td><?= $AddedItem->shipment_no ?></td>
                                            <td><?= $AddedItem->branch_name ?></td>
                                            <td>
                                                <table width="100%" border="0" cellspacing="1" cellpadding="15" >
                                                <?php  
												$quote_item_details = $this->container_model->addedcontainerItemDetails($AddedItem->order_id);
												//echo '<pre>'; print_r($quote_item_details); echo '</pre>';
												$count = 1;
												foreach($quote_item_details as $items){
													$year = date("y");
													$itemsId = str_pad($count, 3, '0', STR_PAD_LEFT);
													$shipmentId = str_pad($AddedItem->order_id, 7, '0', STR_PAD_LEFT);
												?>
                                                  <tr>
    <td style=" border-bottom:1px solid #999; border-right:1px solid #999;"><?= $items->item_name ?></td>
    <td style=" border-bottom:1px solid #999; border-right:1px solid #999;"><img src="<?php echo base_url(); ?>index.php/container/set_barcode/<?php echo $year.$shipmentId.$itemsId ?>"  alt="barcode" /></td>
    <td style=" border-bottom:1px solid #999; border-right:1px solid #999;">
    <?php if($items->status == '3'){ ?>
    		<a class="btn btn-warning" href="#">Arrived to Warehouse</a>
        <?php } else { ?>
        	<a class="btn btn-info" href="<?= base_url('container/changecontaineritemstatus/')?><?= $AddedItem->order_id.'/'.$items->container_shipment_items_id ?>">Change to arrived</a>
	<?php } ?>
    </td>
                                                  </tr>
                                                  <?php } ?>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="4">No Order Item found for your branch.</td>';
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>   
                            
                             <div class="box-footer">
                              <a href="<?php echo base_url('admin/container-list'); ?>" class="btn btn-info pull-right">Back</a>
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