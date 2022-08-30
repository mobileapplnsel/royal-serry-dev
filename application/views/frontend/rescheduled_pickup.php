<?php defined('BASEPATH') or exit('No direct script access allowed');
//echo '<pre>'; print_r($profile_details);echo '</pre>';
$this->load->view('frontend/includes/header');
?>
<style>
   .left-box-st {
      width: 48%;
      background: #d7e6da;
      margin: 1%;
      border-radius: 12px;
      padding: 15px;
      min-height: 430px;
   }

   .right-box-st {
      width: 48%;
      background: #ecdfdf;
      margin: 1%;
      border-radius: 12px;
      padding: 15px;
      min-height: 430px;
   }
</style>
<section class="form-contact-text">
   <div class="container">
      <div class="row">
         <h3>Dashboard</h3>
         <br>
         <?php $this->load->view('frontend/includes/left-panel'); ?>
         <!--+++++++++++++++++++++++right-side==============-->
         <div class="col-sm-9 white-gap">
            <!--+++++++++++++++++++++++++dashboard================-->
            <div class="container-fluid">
               <div class="row justify-content-center">
                  <div class="card">
                     <!-- <p class="red">General</p> -->
                     <?php echo form_open(base_url('save-order'), array('id' => 'msform', 'class' => '')); ?>
                     <!-- progressbar -->
                     <br> <!-- fieldsets -->
                     <!--+++++++++++++++++++++++++++++++++++++++++++3-end++++++++++++++++++-->
                     <!--+++++++++++++++++++++++++++++++++++++++++++4-start++++++++++++++++++-->
                     <!--+++++++++++++++++++++++++++++++++++++++++++4-end++++++++++++++++++-->
                     <?php
                     $subtotal = 0.00;
                     $discount = 0.00;
                     $total = 0.00;
                     $qty = 0;
                     ?>
                     <fieldset>
                        <div class="form-card" style=" margin-top: -37px;">
                           <div class="row">
                              <div class="col-md-8">
                                 <h3>Rescheduled Pickup</h3>
                              </div>
                              <div class="col-md-4">
                                 <p class="ds-title-new"><strong>Order # :</strong> <?php echo (!empty($shipment_details) && $shipment_details['shipment_no'] != '') ? $shipment_details['shipment_no'] : ''; ?></p>
                                 <p class="ds-title-new"><strong>Date : </strong> <?php echo (!empty($quote_details) && $quote_details[0]['order_created_dtime'] != '') ? $quote_details[0]['order_created_dtime'] : DTIME; ?></p>
                                 <?php
                                 if (!empty($shipment_details) && $shipment_details['payment_mode'] != '') {
                                    if ($shipment_details['payment_mode'] == 1) {
                                       echo '<p class="ds-title-new"><strong>Payment Mode # :</strong> PayLater </p>';
                                    } else  if ($shipment_details['payment_mode'] == 2) {
                                       echo '<p class="ds-title-new"><strong>Payment Mode # :</strong> Credit Card </p>';
                                    } else  if ($shipment_details['payment_mode'] == 3) {
                                       echo '<p class="ds-title-new"><strong>Payment Mode # :</strong> Credit Amount </p>';
                                    }
                                 } else {
                                    // echo 'NA';
                                 }

                                 ?>
                              </div>
                           </div>
                           <div style=" width: 100%; display: block; clear: both; height: 40px; border-top: 1px solid #76b382; border-bottom: 1px solid #76b382; margin-top: 10px;">
                           </div>
                           
                           
                           <div class="spacer-gap"></div>
                           <div class="row">
                              <div class="col-sm-4">
                                 <p class="ds-title-new"><strong>Pickup Details:</strong></p>
                              </div>
                           </div>
                           <!-- <div class="spacer-gap"></div> -->
                           <div class="row">
                              <div class="col-md-6 col-sm-12">
                                        <h3 class="titelt">Delivery Speed: </h3>
                                        <div class="spacer"></div>
                                        <select class="form-control form-control-new delivery_speed pickup-speed" id="delivery_speed" name="delivery_speed">
                                            <option>select</option>
                                            <?php
                                            if (!empty($deliveryModeList)) {
                                                foreach ($deliveryModeList as $key => $value) {
                                            ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php if($shipment_details['delivery_mode_id']==$value['id']){echo "selected";} ?>><?php echo $value['name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <h3 class="titelt">Pickup Date: </h3>
                                        <div class="spacer"></div>
                                        <input class="form-control form-control-new pickup-date-picker" type="text" value="<?php echo date('d-m-Y',strtotime($shipment_details['pickup_date'])); ?>" name="pickup_date" readonly required>
                                    </div>
                                    <input type="hidden" id="city" name="city" value="<?php echo $shipment_from_address['city'] ?>">
                           </div>
                           <div class="spacer-gap"></div>
                           
                     </fieldset>
                     <?php echo form_close(); ?>
                  </div>
               </div>
            </div>
            <div style=" max-width: 900px; margin: 0 auto; display: block; background: #e93e3e; height: 8px; padding: 0 20px;"></div>
            <!--+++++++++++++++++++++++dashboard-end++++++++++++-->
         </div>
         <!--+++++++++++++++++++++++right-side==============-->
      </div>
   </div>
</section>
<
<?php $this->load->view('frontend/includes/footer'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
      $("#msform").submit('on', function(e) {
         e.preventDefault();
         $("#element_overlapT").LoadingOverlay("show");
         toastr.remove()
         toastr.success('<span style="color:#fff;">Please wait...</span>');
         $.ajax({
            dataType: "json",
            type: "post",
            cache: false,
            // contentType: false,
            //processData: false,
            data: $('#msform').serializeArray(),
            headers: {
               'Authkey': '<?= $this->security->get_csrf_hash(); ?>'
            },
            url: $('#msform').attr('action'),
            success: function(data) {
               $("#element_overlapT").LoadingOverlay("hide", true);
               if (data.code == 400) {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">' + data.error + '</span>');
               }

               if (data.status == 0) {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">' + data.message + '</span>');
               }
               if (data.status == 1) {
                  toastr.remove()
                  toastr.success('<span style="color:#fff;">' + data.message + '</span>');
                  //$('#registerF').trigger('reset');
                  setTimeout(function() {
                     window.location.href = data.redirectUrl;
                  }, 5000);
               }
            },
            error: function(jqXHR, status, err) {
               toastr.remove()
               toastr.error('<span style="color:#fff;">Local error callback.</span>');
            }
         });
      });
   });

   $(document).ready(function() {
      $("input[type='radio']").click(function() {
         var radioValue = $("input[name='payment_mode']:checked").val();
         if (radioValue == '2') {
            //alert("Your are a - " + radioValue);
            $("#cardinfo").show(300);
            $("#cardname").prop('required', true);
            $("#card_number").prop('required', true);
            $("#card_exp_month").prop('required', true);
            $("#card_exp_year").prop('required', true);
            $("#card_cvc").prop('required', true);
         } else {
            $("#cardinfo").hide(300);
            $("#cardname").prop('required', false);
            $("#card_number").prop('required', false);
            $("#card_exp_month").prop('required', false);
            $("#card_exp_year").prop('required', false);
            $("#card_cvc").prop('required', false);
         }
      });
   });


   $(document).on('change', '.pickup-speed', function() {
        
        var pickupspeed = $('.pickup-speed').find(":selected").val();
        var fromCity = $('#city').val();
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajax({
            dataType: "json",
            type: "post",
            url: '<?php echo base_url('get-branch-pickup-method'); ?>',
            data: {
                [csrfName]: csrfHash,
                pickupspeed: pickupspeed,
                from_city: fromCity,
            },
            success: function(data) {
               $(".pickup-date-picker" ).val();
                $(".pickup-date-picker" ).datepicker( "destroy" );
                var days = JSON.stringify(data);
                $(".pickup-date-picker").datepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: 0,
                    beforeShowDay: function(date){ 
                        if (days.includes(date.getDay())) {
                            return [true, "" ];
                        } else {
                            return [false, "" ];
                        }
                        
                    }
                });

            }
        });


    });
</script>