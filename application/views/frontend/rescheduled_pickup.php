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
                     <?php echo form_open(base_url('shipment-rescheduled/'.$quote_id_enc), array('id' => 'msform', 'class' => '')); ?>
                     
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
                           <div class="row rescheduled-payment">
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
                              <input  type="hidden" id="city" name="city" value="<?php echo $shipment_from_address['city'] ?>">
                           </div>
                           <div class="row" id="make-payment" style="display:none">
                              <div class="col-sm-12">
                                 <fieldset class="rescheduled-payment-1" disabled="" style="display:none">
                                 <div class="form-check" style="padding-top: 0px!important;">
                                    <?php $grand_total="0.00"; ?>  
                                    <input type="hidden" id="quote_id_enc" name="quote_id_enc" value="<?php echo (isset($quote_id_enc)) ? $quote_id_enc : ''; ?>">
                                    <input type="hidden" id="subtotal" name="subtotal" value="0.00">
                                    <input type="hidden" id="discount" name="discount" value="0.00">
                                    <input type="hidden" id="ga_percentage" name="ga_percentage" value="0.00">
                                    <input type="hidden" id="ga_tax_amt" name="ga_tax_amt" value="0.00">
                                    <input type="hidden" id="ra_percentage" name="ra_percentage" value="0.00">
                                    <input type="hidden" id="ra_tax_amt" name="ra_tax_amt" value="0.00">
                                    <input type="hidden" id="grand_total" name="grand_total" value="0.00">

                                    <input type="hidden" id="delivery_mode_id" name="delivery_mode_id" value="0">

                                    <input type="hidden" id="credit_outstanding_amount" name="credit_outstanding_amount" value="<?php echo $profile_details['credit_outstanding_amount']; ?>">

                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $profile_details['user_id']; ?>">
                                    <input type="hidden" id="pay_later" name="pay_later" value="<?php echo $profile_details['pay_later']; ?>">
                                 </div>
                                 <div class="form-check" style="padding-top: 0px!important;">
                                       <label class="form-check-label big">
                                          <input type="radio" style="margin-bottom: 0px!important; margin-top: 0px!important;" class="form-check-input" name="payment_mode" value="2" checked="checked">
                                          Credit / debit /atm Card
                                          <i class="fa  fa-credit-card fa-1x "></i>
                                       </label>
                                       <div class="panel-body" id="cardinfo">
                                          <div class="row">
                                             <div class="col-md-9">
                                                <div class="row">
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                         <label>NAME</label>
                                                         <input type="text" name="cardname" id="cardname" placeholder="Enter name" autofocus="" required="required">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                         <label>CARD NUMBER</label>
                                                         <input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required="required">
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="row ">
                                                   <div class="col-md-4">
                                                      <div class="form-group">
                                                         <label>EXPIRY DATE</label>
                                                         <input type="text" name="card_exp_month" placeholder="MM" maxlength="2" id="card_exp_month" required="required">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                      <div class="form-group">
                                                         <label>&nbsp;</label>
                                                         <input type="text" name="card_exp_year" placeholder="YY" maxlength="2" id="card_exp_year" required="required">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                      <div class="form-group">
                                                         <label>CVC CODE</label>
                                                         <input type="text" name="card_cvc" placeholder="CVC" autocomplete="off" maxlength="3" id="card_cvc" required="required">
                                                      </div>
                                                   </div>
                                                </div>

                                             </div>

                                             <div class="col-md-3">
                                                <div class="payment-icon">
                                                   <ul>
                                                      <li><img src="http://182.75.124.211/royal-serry-dev/assets/frontend/images/picon_1.png"></li>
                                                      <li><img src="http://182.75.124.211/royal-serry-dev/assets/frontend/images/picon_2.png"></li>
                                                      <li><img src="http://182.75.124.211/royal-serry-dev/assets/frontend/images/picon_3.png"></li>
                                                      <li><img src="http://182.75.124.211/royal-serry-dev/assets/frontend/images/picon_4.png"></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                 </div>
                                 </fieldset>
                                 <fieldset class="rescheduled-payment-2" disabled="" style="display:none">
                                       <div class="form-check" style="padding-top: 0px!important;">
                                          <label class="form-check-label big">
                                             <input type="radio" style="margin-bottom: 0px!important; margin-top: 0px!important;" class="form-check-input" name="payment_mode" value="3"> Credit amount
                                             <i class="fa  fa-usd fa-1x "></i><?php echo $profile_details['credit_outstanding_amount']; ?>
                                          </label>
                                       </div>
                                 </fieldset>
                                 <fieldset class="rescheduled-payment-3">
                                    <?php if ($profile_details['pay_later'] == '1') {
                                       $checkPoint = getCheckPoint($profile_details['user_id'], '1');
                                       if ($checkPoint == '0') { ?>
                                       <div class="form-check" style="padding-top: 0px!important;">
                                          <label class="form-check-label big">
                                             <input type="radio" style="margin-bottom: 0px!important; margin-top: 0px!important;" class="form-check-input" name="payment_mode" value="1"> Pay Later
                                          </label>
                                       </div>
                                    <?php }
                                    } ?>
                                 </fieldset>
                              </div>
                           </div>
                           <div class="row">
                                 <div class="col-sm-12">
                                    <input type="button" name="Back" class="Back action-button-Back" data-back="form_4" value="Back" style="border: 1px solid rgb(206, 212, 218); background: #fe0000!important;" onclick="window.location = '<?php echo base_url('shipment-rescheduled-pickup/'.$quote_id_enc); ?>';">
                                    <input class="action-button payment-action" type="submit" name="rescheduled" value="Rescheduled" style="border: 1px solid rgb(206, 212, 218);background: #016c1c!important;"></div>
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

                  if (data.paymentrequired) {
                     $('#msform').prop('action', '<?php echo base_url('shipment-rescheduled-payment/'.$quote_id_enc); ?>');
                     $("#delivery_speed").prop("disabled", true);
                     $("#delivery_mode_id").val(data.paymentDetails.delivery_mode_id);
                     $("#subtotal").val(data.paymentDetails.amount);
                     $("#ga_percentage").val(data.paymentDetails.ga_tax_amt);
                     $("#ga_tax_amt").val(data.paymentDetails.ga_percentage);
                     $("#ra_percentage").val(data.paymentDetails.ra_percentage);
                     $("#ra_tax_amt").val(data.paymentDetails.ra_tax_amt);
                     $("#grand_total").val(data.paymentDetails.total);
                     $('.rescheduled-payment-1').show();
                     $('.rescheduled-payment-1').prop("disabled", false);
                     var creditOutstandingAmount = $("#credit_outstanding_amount").val();
                     if (creditOutstandingAmount>=data.paymentDetails.total) {
                        $('.rescheduled-payment-2').show();
                        $('.rescheduled-payment-2').prop("disabled", false);
                     }
                     $("#make-payment").show();
                     $(".payment-action").val('Pay')
                  }else{
                     setTimeout(function() {
                        window.location.href = data.redirectUrl;
                     }, 5000);
                  }
               }
            },
            error: function(jqXHR, status, err) {
               toastr.remove()
               toastr.error(err+'<span style="color:#fff;">Local error callback.</span>');
               
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
        
        
      $('.rescheduled-payment-1').hide();
      $('.rescheduled-payment-1').prop("disabled", true);
      $('.rescheduled-payment-2').hide();
      $('.rescheduled-payment-2').prop("disabled", true);
      $("#make-payment").hide();




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
                $(".pickup-date-picker" ).val('');
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