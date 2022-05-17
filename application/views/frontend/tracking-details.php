<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
//echo '<pre>'; print_r($shipment_list);echo '</pre>';
$CI =& get_instance();
$CI->load->model('order_model');
?>
<section class="form-contact-text">
<div class="container">
<div class="row">
<!-- <h3>My Account</h3><br> -->
<?php if (isset($sessionData) && ($sessionData['logged_in'] == 'TRUE')) {?>
<?php $this->load->view('frontend/includes/left-panel'); ?>
<?php } ?>
<!--+++++++++++++++++++++++left-side==============-->
<!-- <div class="col-sm-3 white-gap gray-line">
   <ul class="list-group">
      <li class="list-group-item"><a href="#"><i class="fa fa-truck"></i> Start Shipment</a></li>
      <li class="list-group-item"><a href="#"  class="red-active"><i class="fa fa-map-marker"></i> Track Order</a></li>
      <li class="list-group-item"><a href="#"><i class="fa fa-cog"></i> Manage Account</a></li>
   </ul>
</div> -->
<!--+++++++++++++++++++++++left-side-end==============-->
<!--+++++++++++++++++++++++right-side==============-->	        	
<div class="col-sm-9 white-gap">
<h3>Order Details</h3>
<div class="spacer-gap"></div>
<!--+++++++++++++++++++++++++dashboard================-->
<div class="col-sm-6">
   <h2 class="ds-title3">Order Number: <b><?php echo $shipment_list[0]['shipment_no']; ?></b></h2>
</div>
<div class="col-sm-6">
   <h2 class="ds-title3">Order Status: <b><?php echo getStatusNameByShipment($shipment_list[0]['shipment_id']); ?></b></h2>
   <div class="col-sm-12">
      <h2 class="ds-title3">Order Date: <b><?php echo date('m-d-Y',strtotime($shipment_list[0]['order_date'])); ?></b></h2>
   </div>
   <!-- <div class="col-sm-6">
      <h2 class="ds-title3">Form Date:</h2>
   </div> -->
</div>
<div class="spacer-gap"></div>
<section class="cls_track">
   <div class="col-sm-12">
   	<div class="row">
      <div class="timeline-wrapper">
         <?php foreach ($shipment_list as $key => $value) { ?>
         <div class="timeline-outer">
         <div class="col-sm-9">
            <div class="node nodeactive">
            <?php if($value['status_id']=='1'){?>
            	<img src="<?php echo base_url(); ?>assets/frontend/images/1-white.png" alt="Ready for Pickup" />
               <?php } else if($value['status_id']=='2'){?>
                <img src="<?php echo base_url(); ?>assets/frontend/images/2-white.png" alt="Picked Up" />
                <?php } else if($value['status_id']=='3'){?>
                <img src="<?php echo base_url(); ?>assets/frontend/images/3-white.png" alt="Warehouse" />
                <?php } else if($value['status_id']=='4'){?>
                <img src="<?php echo base_url(); ?>assets/frontend/images/4-white.png" alt="In Transit" />
                <?php } else if($value['status_id']=='8'){?>
                <img src="<?php echo base_url(); ?>assets/frontend/images/5-white.png" alt="Destination Warehouse" />
                <?php } else if($value['status_id']=='5' || $value['status_id']=='7'){?>
                <img src="<?php echo base_url(); ?>assets/frontend/images/6-white.png" alt="Out for Delivery" />
                <?php } else if($value['status_id']=='6'){?>
                <img src="<?php echo base_url(); ?>assets/frontend/images/7-white.png" alt="Delivered" />
                <?php } ?>
               <h3 class="ds-title3"><?php echo getStatusName($value['status_id']); ?></h3>
               <p><?php echo date('m-d-Y h:i:sa',strtotime($value['status_date'])); ?></p>
               <?php if($value['status_id'] == '5'){ ?>
                <ul class="clsul">
                <?php
                $CustomStatusDetails = $CI->order_model->getCustomOrderStatus($value['shipment_id'], $value['status_id'], '2');
                foreach($CustomStatusDetails as $status){	
                ?>
                    <li class="clslistatus"><?= $status->status_text.' - '.$status->comment; ?><br><?php echo date('m-d-Y h:i:sa',strtotime($status->created_date)); ?></li>
                 <?php
                }
                 ?>
                </ul>
               <?php }?>
            </div>
         </div>
         <div class="col-sm-3">
         	<div class="status">
            <div class="form-check">
               <input class="form-check-input" type="checkbox" value="" id="" checked disabled>
               <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">
               Done
               </label>
            </div>
         </div>
         </div>
         </div>
         <?php } ?>

      </div>
   	</div>
   </div>
   
   </div>
</section>
<?php $this->load->view('frontend/includes/footer'); ?>
