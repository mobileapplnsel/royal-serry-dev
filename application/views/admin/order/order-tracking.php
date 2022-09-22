<?php
//echo '<pre>'; print_r($shipment_list);echo '</pre>';
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->model('order_model');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<style type="text/css">
.ds-title3 {
    font-size: 16px !important;
    font-family: 'Open Sans', sans-serif;
    color: #505050;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left;
}
.form-check {
    padding-top: 14px;
    padding-left: 15px!important;
}
label.form-check-label {
    font-size: 17px;
    color: #333;
    margin-right: 27px;
    font-family: 'Open Sans', sans-serif;
    font-weight: 400;
    position: relative;
    top: -4px;
    left: 15px;
}
.timeline-wrapper {
  margin-left: 1.5rem;
  border-left: 2px solid #ddd;
}
.node {
  padding-left: .5rem;
  padding-bottom: 1.5rem;
  position: relative;
}
.node h3, .node p {
  margin: 0;
	padding-left: 25px;
}
.node::before {
  content: "";
  width: 20px;
  height: 20px;
  background: #fff;
  border: 2px solid #ccc;
  border-radius: 50%;
  position: absolute;
  top: 6px;
  left: -12px;
}

.nodeactive::before {
    content: "";
    width: 20px;
    height: 20px;
    background: #007016 !important;
    border: 2px solid #007016;
    border-radius: 50%;
    position: absolute;
    top: 6px;
    left: -12px;
}

</style>
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
                    Order Tracking
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/order-list') ?>"><i class="fa fa-dashboard"></i>Order List</a></li>
                    <li class="active">Order Tracking</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Order Tracking</h3>
                            </div>
                            <?php echo form_open(base_url('order/order_tracking/'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Order Tracking </div>
                            <div class="box-body">
                                <div class="form-group col-md-6 col-md-offset-3"></div>
                            	<div class="form-group col-md-6">
                                <label for="email">Tracking No<span>*</span> : </label>
                                  <input type="text" class="form-control" placeholder="Enter Your Tracking No." id="shipment_no" name="shipment_no" required>
                            </div>
                            </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Track & Trace</button>
                                  <a href="<?php echo base_url('admin/order-tracking-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="branch_id" value="<?php echo $this->uri->segment(3);?>" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <?php if(!empty($shipment_list)){?>
                            <div class="box-header">
                                <h3 class="box-title">Order Details</h3>
                            </div>
                            <div class="box-body">
                                <div class="col-sm-6">
                                   <h2 class="ds-title3">Order Number: <b><?php echo $shipment_list[0]['shipment_no']; ?></b></h2>
                                </div>
                            	<div class="col-sm-6">
                               <h2 class="ds-title3">Order Status: <b><?php echo getStatusNameByShipment($shipment_list[0]['shipment_id']); ?></b></h2>
                               <div class="col-sm-12">
                                  <h2 class="ds-title3">Order Date: <b><?php echo date('m-d-Y',strtotime($shipment_list[0]['order_date'])); ?></b></h2>
                               </div>
                            </div>
                            <div class="spacer-gap"></div>
                            <section class="">
                               <div class="col-sm-9">
                                  <div class="timeline-wrapper">
                                     <?php foreach ($shipment_list as $key => $value) { ?>
                                        <div class="node nodeactive">
                                           <h3 class="ds-title3"><?php echo getStatusName($value['status_id']); ?></h3>
                                           <p><?php echo date('m-d-Y h:i:sa',strtotime($value['status_date'])); ?></p>

                                            <?php if($value['status_id'] >=4){ ?>
                                              <ul class="all-tracking-link">
                                                <?php if ($trackingLinks) {
                                                 foreach($trackingLinks as $key=>$trackingdata){ ?>
                                                 <li><a href="<?php echo $trackingdata->tracking_link;?>" target="_blank">Container Tracking <?php echo $key+1; ?></a></li>
                                               <?php } }?>
                                              </ul>

                                            <?php }?>




                                           <?php if($value['status_id'] == '5'){ ?>
                                           	<ul class="clsul">
                                            <?php
												$CustomStatusDetails = $this->order_model->getCustomOrderStatus($value['shipment_id'], $value['status_id'], '2');
											foreach($CustomStatusDetails as $status){	
                                            ?>
                                            	<li class="clslistatus"><?= $status->status_text.' - '.$status->comment; ?><br><?php echo date('m-d-Y h:i:sa',strtotime($status->created_date)); ?></li>
                                             <?php
											}
											 ?>
                                            </ul>
                                           <?php }?>
                                        </div>
                                     <?php } ?>
                                  </div>
                               </div>
                               <div class="col-sm-3">
                                  <?php foreach ($shipment_list as $key1 => $value1) { ?>
                                     <div class="status">
                                        <div class="form-check">
                                           <input class="form-check-input" type="checkbox" value="" id="" checked disabled>
                                           <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">
                                           Done
                                           </label>
                                        </div>
                                     </div>
                                  <?php } ?>
                               </div>
							</section>
                            </div>  
                            <?php }?>                  
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