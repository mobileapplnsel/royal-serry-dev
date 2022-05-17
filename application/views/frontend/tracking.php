<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
?>
<section class="home-newsletter">
   <div class="container">
      <div class="row">
         <div class="col-sm-12" id="element_overlapT">
            <div class="single">
               <h3>Track & Trace</h3>
               <br>
               <br>
               <?php echo form_open(base_url('order-tracking-search'), array('id' => 'trackingF', 'class' => '')); ?>
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Enter Your Tracking No." id="shipment_no" name="shipment_no">
                  <span class="input-group-btn">
                  <button class="btn btn-theme" type="submit">Track & Trace</button>
                  </span>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('frontend/includes/footer'); ?>
