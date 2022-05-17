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
                                 <h3>Generate Order</h3>
                                 <!-- <p class="ds-title-new"><strong>Valid Until : </strong> </p>
                                 <p class="ds-title-new"><strong>Customer Number : </strong> </p> -->
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
                           <div style=" width: 100%; display: block; clear: both; height: 40px; border-top: 1px solid #76b382; border-bottom: 1px solid #76b382; margin-top: 10px;"></div>
                           <div class="row">
                              <div class="col-sm-12 col-md-6 left-box-st">
                                 <?php
                                 if (!empty($quote_from_details)) {
                                 ?>
                                    <p class="ds-title-new"><strong>Pickup Address :</strong></p>
                                    <!-- <p class="ds-title-new">Item Description: <?php //echo $quote_from_details[0]['order_created']; 
                                                                                    ?></p> -->
                                    <p class="ds-title-new">Address: <?php echo $quote_from_details[0]['address']; ?></p>
                                    <p class="ds-title-new">Address2: <?php echo $quote_from_details[0]['address2']; ?></p>
                                    <p class="ds-title-new">Company: <?php echo $quote_from_details[0]['company_name']; ?></p>
                                    <p class="ds-title-new">Country: <?php echo $quote_from_details[0]['country_name']; ?></p>
                                    <p class="ds-title-new">State: <?php echo $quote_from_details[0]['state_name']; ?></p>
                                    <p class="ds-title-new">City: <?php echo $quote_from_details[0]['city_name']; ?></p>
                                    <p class="ds-title-new">Zip Code: <?php echo $quote_from_details[0]['zip']; ?></p>
                                    <p class="ds-title-new">Phone No:
                                       <?php

                                       if (isset($quote_from_details[0]['telephone'])) {
                                          if (!empty($quote_from_details[0]['telephone']) && is_serialized_string($quote_from_details[0]['telephone'])) {
                                             $telephone = repairSerializeString($quote_from_details[0]['telephone']);
                                             $telephone = unserialize($telephone);
                                             //print_r($telephone);
                                             $telephones = implode(', ', $telephone);
                                          } else {
                                             $telephones = $quote_from_details[0]['telephone'];
                                          }
                                       } else {
                                          $telephones = 'N/A';
                                       }
                                       echo $telephones;
                                       ?>
                                    </p>
                                    <p class="ds-title-new">Address Type : <?php echo ($quote_from_details[0]['address_type'] == 0) ? 'Home' : 'Business'; ?></p>
                                 <?php
                                 }
                                 ?>
                              </div>
                              <div class="col-sm-12 col-md-6 right-box-st">
                                 <?php
                                 if (!empty($quote_to_details)) {

                                    if (isset($quote_to_details[0]['telephone'])) {
                                       if (!empty($quote_to_details[0]['telephone']) && is_serialized_string($quote_to_details[0]['telephone'])) {
                                          $telephone = repairSerializeString($quote_to_details[0]['telephone']);
                                          $telephone = unserialize($telephone);
                                          //print_r($telephone);
                                          $telephones = implode(', ', $telephone);
                                       } else {
                                          $telephones = $quote_to_details[0]['telephone'];
                                       }
                                    } else {
                                       $telephones = 'N/A';
                                    }


                                 ?>
                                    <p class="ds-title-new"><strong>Delivery Address :</strong></p>
                                    <!-- <p class="ds-title-new">Item Description: <?php echo $quote_to_details[0]['order_created']; ?></p> -->
                                    <p class="ds-title-new">Address: <?php echo $quote_to_details[0]['address']; ?></p>
                                    <p class="ds-title-new">Address2: <?php echo $quote_to_details[0]['address2']; ?></p>
                                    <p class="ds-title-new">Company: <?php echo $quote_to_details[0]['company_name']; ?></p>
                                    <p class="ds-title-new">Country: <?php echo $quote_to_details[0]['country_name']; ?></p>
                                    <p class="ds-title-new">State: <?php echo $quote_to_details[0]['state_name']; ?></p>
                                    <p class="ds-title-new">City: <?php echo $quote_to_details[0]['city_name']; ?></p>
                                    <p class="ds-title-new">Zip Code: <?php echo $quote_to_details[0]['zip']; ?></p>
                                    <p class="ds-title-new">Phone No: <?php echo $telephones; ?></p>
                                    <p class="ds-title-new">Address Type : <?php echo ($quote_to_details[0]['address_type'] == 0) ? 'Home' : 'Business'; ?></p>
                                 <?php
                                 }
                                 ?>
                              </div>
                           </div>
                           <div style=" width: 100%; display: block; clear: both; height: 5px; border-top: 1px solid #006c16; margin-top: 2px; margin-bottom: 11px;"></div>
                           <div class="row">
                              <div class="col-sm-12 col-md-6">
                                 <p class="ds-title-new"><strong>Parcel Type: </strong><?php echo (!empty($quote_details) && $quote_details[0]['shipment_type'] == 1) ? 'Document' : 'Package'; ?></p>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <p class="ds-title-new"><strong>Shipment Type: </strong><?php echo (!empty($quote_from_details) && $quote_details[0]['location_type'] == 1) ? 'Domestic' : 'International'; ?></p>
                              </div>
                           </div>
                           <div style=" width: 100%; display: block; clear: both; height: 5px; border-top: 1px solid #fd0000; margin-top: 2px;"></div>
                           <div class="spacer-gap"></div>
                           <div class="row">
                              <div class="col-sm-4">
                                 <p class="ds-title-new"><strong>Parcel Details:</strong></p>
                              </div>
                           </div>
                           <!-- <div class="spacer-gap"></div> -->
                           <div class="row">
                              <div class="col-sm-12 col-md-12">
                                 <div class="table-responsive-sm">
                                    <table class="table table-striped">
                                       <thead style="font-size: 14px;">
                                          <tr>
                                             <th class="center">SL No.</th>
                                             <th class="center">Item Name</th>
                                             <th class="center">Item Type</th>
                                             <th class="center">Category</th>
                                             <th class="center">Description</th>
                                             <th class="center">Qty</th>
                                             <th class="center">Rate</th>
                                             <th class="center">Insurance</th>
                                             <th class="center">Insur. Total</th>
                                             <th>Amount</th>
                                          </tr>
                                       </thead>
                                       <tbody style="font-size: 13px;">
                                          <?php
                                          //echo '<pre>';print_r($quote_item_details);
                                          if (!empty($quote_item_details)) {
                                             foreach ($quote_item_details as $key => $value) {
                                                $description = strlen($value['desc']) > 50 ? substr($value['desc'], 0, 50) . "..." : $value['desc'];

                                                if ($value['road'] != '0.00') {
                                                   $rate = $value['road'];
                                                } else if ($value['rail'] != '0.00') {
                                                   $rate = $value['rail'];
                                                } else if ($value['air'] != '0.00') {
                                                   $rate = $value['air'];
                                                } else if ($value['ship'] != '0.00') {
                                                   $rate = $value['ship'];
                                                } else {
                                                   $rate = '0.00';
                                                }

                                                //$total = $total + $value['line_total'];
                                                //$total += ($rate + $value['insur']);

                                                $qty = ($value['quantity'] > 0) ? $value['quantity'] : '1';
                                                $insur = ($value['insur'] != 0) ? $value['insur'] : '0.00';
                                                $insur_withqty = ($insur * $qty);
                                                $insur_withqty = number_format((float)$insur_withqty, 2, '.', '');
                                                // $rate_withqty = ($rate * $qty);
                                                $total += $rate + $insur_withqty;
                                                //$total += ($rate * $qty) + $insur_withqty;
                                                $total = number_format((float)$total, 2, '.', '');

                                                $subtotal += $total;
                                                $subtotal = number_format((float)$subtotal, 2, '.', '');
                                          ?>
                                                <tr>
                                                   <td class="center"><?php echo $key + 1; ?></td>
                                                   <td class="center"><?php echo $value['item_name']; ?></td>
                                                   <td class="center"><?php echo $value['package']; ?></td>
                                                   <td class="center"><?php echo $value['category_name']; ?></td>
                                                   <td class="center"><?php echo $description; ?></td>
                                                   <td class="center"><?php echo $qty; ?></td>
                                                   <td class="center"><?php echo $rate; ?></td>
                                                   <td class="center"><?php echo $insur; ?></td>
                                                   <td class="center"><?php echo $insur_withqty; ?></td>
                                                   <td class="center"><?php echo $total; ?></td>
                                                </tr>
                                          <?php
                                                $total = 0;
                                             }
                                          }
                                          ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="spacer-gap"></div>
                           <div class="row">
                              <div class="col-sm-12 col-md-8">
                                 &nbsp;
                              </div>
                              <div class="col-sm-12 col-md-4">
                                 <table class="table table-striped">
                                    <tbody style="font-size: 13px;">
                                       <tr>
                                          <td>Subtotal:</td>
                                          <td>$<?php echo $subtotal; ?></td>
                                       </tr>
                                       <?php
                                       if ($discount > 0) {
                                       ?>
                                          <tr>
                                             <td>Discount:</td>
                                             <td>$<?php echo $discount; ?></td>
                                          </tr>
                                       <?php
                                       }
                                       ?>
                                       <?php
                                       if (!empty($tax)) {
                                          // echo '<pre>';print_r($tax);

                                          if (isset($tax[0]['type']) && !isset($tax[1]['type']) && $tax[0]['type'] == 'GA') {
                                             //GA only
                                       ?>
                                             <tr>
                                                <td><?php echo $tax[0]['type'] . ' Tax (' . $tax[0]['amount'] . '%)'; ?>:</td>
                                                <td>
                                                   <?php
                                                   $discounted_total = ($subtotal - $discount);
                                                   $added_ga_tax = ($discounted_total * $tax[0]['amount']) / 100;
                                                   $grand_total = ($discounted_total + $added_ga_tax);

                                                   echo  '$' . number_format((float)$added_ga_tax, 2, '.', '');
                                                   ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>Total:</td>
                                                <td><?php echo  '$' . number_format((float)$grand_total, 2, '.', ''); ?></td>
                                             </tr>
                                          <?php
                                          } else if (isset($tax[0]['id']) && isset($tax[1]['id'])) {
                                             //GA & RA
                                          ?>
                                             <!-- GA starts -->
                                             <tr>
                                                <td><?php echo $tax[0]['type'] . ' Tax (' . $tax[0]['amount'] . '%)'; ?>:</td>
                                                <td>
                                                   <?php
                                                   $discounted_total = ($subtotal - $discount);
                                                   $added_ga_tax = ($discounted_total * $tax[0]['amount']) / 100;
                                                   $total_with_tax = ($discounted_total + $added_ga_tax);

                                                   echo  '$' . number_format((float)$added_ga_tax, 2, '.', '');
                                                   ?>
                                                </td>
                                             </tr>
                                             <!-- GA ends -->
                                             <!-- RA starts -->
                                             <tr>
                                                <td><?php echo $tax[1]['type'] . ' Tax (' . $tax[1]['amount'] . '%)'; ?>:</td>
                                                <td>
                                                   <?php
                                                   $added_ra_tax = ($added_ga_tax * $tax[1]['amount']) / 100;
                                                   $grand_total = ($total_with_tax + $added_ra_tax);

                                                   echo  '$' . number_format((float)$added_ra_tax, 2, '.', '');
                                                   ?>
                                                </td>
                                             </tr>
                                             <!-- RA ends -->
                                             <tr>
                                                <td>Total:</td>
                                                <td><?php echo  '$' . number_format((float)$grand_total, 2, '.', ''); ?></td>
                                             </tr>
                                          <?php
                                          } else {
                                             //RA only
                                          ?>
                                             <tr>
                                                <td>Total:</td>
                                                <td>
                                                   <?php
                                                   $grand_total = ($subtotal - $discount);
                                                   echo  '$' . number_format((float)$grand_total, 2, '.', '');
                                                   ?>
                                                </td>
                                             </tr>
                                          <?php
                                          }
                                       } else {
                                          ?>
                                          <tr>
                                             <td>Total:</td>
                                             <td>
                                                <?php
                                                $grand_total = ($subtotal - $discount);
                                                echo  '$' . number_format((float)$grand_total, 2, '.', '');
                                                ?>
                                             </td>
                                          </tr>
                                       <?php
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div style=" width: 100%; display: block; clear: both; height: 8px; border-top: 1px solid #e22929; border-bottom: 1px solid #e22929; margin:20px 0px;"></div>
                           <div class="row">
                              <?php
                              if (!empty($quote_details) && $quote_details[0]['order_created'] == 0) {
                              ?>
                                 <div class="col-sm-12">
                                    <div class="form-check" style="padding-top: 0px!important;">
                                       <label class="form-check-label big">
                                          <input type="hidden" id="quote_id_enc" name="quote_id_enc" value="<?php echo (isset($quote_id_enc)) ? $quote_id_enc : ''; ?>">
                                          <input type="hidden" id="subtotal" name="subtotal" value="<?php echo (isset($subtotal)) ? $subtotal : '0.00'; ?>">
                                          <input type="hidden" id="discount" name="discount" value="<?php echo (isset($discount)) ? $discount : '0.00'; ?>">
                                          <input type="hidden" id="ga_percentage" name="ga_percentage" value="<?php echo (isset($tax[0]['amount'])) ? $tax[0]['amount'] : '0.00'; ?>">
                                          <input type="hidden" id="ga_tax_amt" name="ga_tax_amt" value="<?php echo (isset($added_ga_tax)) ? $added_ga_tax : '0.00'; ?>">
                                          <input type="hidden" id="ra_percentage" name="ra_percentage" value="<?php echo (isset($tax[1]['amount'])) ? $tax[1]['amount'] : '0.00'; ?>">
                                          <input type="hidden" id="ra_tax_amt" name="ra_tax_amt" value="<?php echo (isset($added_ra_tax)) ? $added_ra_tax : '0.00'; ?>">
                                          <input type="hidden" id="grand_total" name="grand_total" value="<?php echo (isset($grand_total)) ? $grand_total : '0.00'; ?>">
                                          <input type="hidden" id="credit_outstanding_amount" name="credit_outstanding_amount" value="<?php echo $profile_details['credit_outstanding_amount']; ?>">
                                          <input type="hidden" id="user_id" name="user_id" value="<?php echo $profile_details['user_id']; ?>">
                                          <input type="hidden" id="pay_later" name="pay_later" value="<?php echo $profile_details['pay_later']; ?>">
                                          <?php if ($profile_details['pay_later'] == '1') {
                                             $checkPoint = getCheckPoint($profile_details['user_id'], '1');
                                             if ($checkPoint == '0') {
                                          ?>
                                                <input type="radio" style="margin-bottom: 0px!important; margin-top: 0px!important;" class="form-check-input" name="payment_mode" value="1"> Pay Later
                                          <?php }
                                          } ?>
                                       </label>
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
                                    <?php if ($profile_details['credit_outstanding_amount'] >= $grand_total) { ?>
                                       <div class="form-check" style="padding-top: 0px!important;">
                                          <label class="form-check-label big">
                                             <input type="radio" style="margin-bottom: 0px!important; margin-top: 0px!important;" class="form-check-input" name="payment_mode" value="3"> Credit amount
                                             <i class="fa  fa-usd fa-1x "></i><?php echo $profile_details['credit_outstanding_amount']; ?>
                                          </label>
                                       </div>
                                    <?php } ?>
                                 </div>
                              <?php
                              } else {
                              ?>
                                 <div class="col-sm-12">
                                 </div>
                                 <div class="col-sm-12">
                                    <b><i class="fa fa-check" style="color:green; font-size:24px;"></i> Order Successfully Placed.</b>
                                 </div>
                              <?php
                              }
                              ?>
                              <div class="col-sm-12">
                                 <?php
                                 if (!empty($quote_details) && $quote_details[0]['order_created'] == 0) {
                                 ?>
                                    <input type="submit" style="background: #016c1c!important;" name="submit" class="next action-button submit" value="Create Order" />
                                 <?php
                                 }
                                 ?>
                              </div>
                           </div>
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
<div class="modal" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">List of Prohibited Items</h4>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <?php foreach ($prohibitedList as $prohibitedKey => $prohibitedValue) { ?>
               <p><?php echo $prohibitedValue->name; ?></p>
            <?php } ?>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-danger action-button-Back-new" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('frontend/includes/footer'); ?>
<!--<script src="<?php //echo base_url();
                  ?>assets/frontend/js/shipment_form_val.js" type="text/javascript"></script>-->
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
</script>