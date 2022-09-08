<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
   button.btn-default {
      background: #006633;
      background-color: rgb(0, 102, 51);
      color: #fff;
      text-shadow: none;
      height: 46px;
      width: 36%;
      border-radius: 0;
      border: 1px solid #006633;
      margin: 0 0 10px;
      margin-top: 0px;
      padding: 5px;
      font-size: 16px;
      text-transform: capitalize;
      letter-spacing: 1px;
      font-family: 'Open Sans', sans-serif;


   }

   .nav-tabs>li>a {
      color: #fff !important;

      background-color: #006633 !important;
      border: 1px solid #006633 !important;
      font-weight: 200 !important;
      font-family: 'Open Sans', sans-serif !important;
      font-size: 14px !important;
   }

   .nav-tabs>li.active>a {
      color: #fff !important;


      background-color: #ff0000 !important;
      border: 1px solid #ff0000 !important;


      border-bottom-color: rgb(0, 102, 51);
      border-bottom-color: transparent;
      font-weight: 200 !important;
      font-family: 'Open Sans', sans-serif !important;
      font-size: 14px !important;
   }

   .nav-tabs {
      border-bottom: 1px solid #b30000 !important;
   }

   .iti--allow-dropdown {
      width: 30% !important;
   }

   .star {
      color: #ff0000;
      font-weight: bold;
   }
</style>
<section class="form-contact-text">
   <div class="container">
      <div class="row">
         <h3>My Account</h3>
         <br>
         <!--+++++++++++++++++++++++left-side==============-->
         <?php $this->load->view('frontend/includes/left-panel'); ?>
         <!--+++++++++++++++++++++++left-side-end==============-->
         <!--+++++++++++++++++++++++right-side==============-->
         <div class="col-sm-9 white-gap" id="element_overlapT">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#home" class="togol">Profile</a></li>
               <li><a data-toggle="tab" href="#menu1" class="togol">Change Password</a></li>
               <li><a data-toggle="tab" href="#credit" class="togol">Credit Amount</a></li>
            </ul>
            <div class="tab-content">
               <div id="home" class="tab-pane fade in active">
                  <!--+++++++++++++++++++++++++dashboard================-->
                  <?php echo form_open(base_url('profile-update'), array('id' => 'profileF', 'class' => 'contact-form-registration')); ?>
                  <div class="form-check form-check-inline" style=" margin-left: 20px;">
                     <input class="form-check-input" type="radio" name="user_type" id="inlineRadio1" value="NU" checked="checked">
                     <label class="form-check-label" for="inlineRadio1">Normal Customer</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="user_type" id="inlineRadio2" value="BU">
                     <label class="form-check-label" for="inlineRadio2">Business Customer</label>
                  </div>
                  <div class="form-field-text">
                     <div class="row">
                        <div class="col-sm-6">
                           <label for="usr">First Name <span class="star">*</span></label>
                           <input type="text" class="form-control name-text" placeholder="First name" name="firstname" id="firstname" value="<?php echo $profile_details['firstname']; ?>">
                        </div>
                        <div class="col-sm-6">
                           <label for="usr">Last Name <span class="star">*</span></label>
                           <input type="text" class="form-control name-text" placeholder="Last name" name="lastname" id="lastname" value="<?php echo $profile_details['lastname']; ?>">
                        </div>
                        <div class="col-sm-6">
                           <label>Address Line1 <span class="star">*</span></label>
                           <input type="text" class="form-control info-text autocomplete" placeholder="Address Line 1" name="address" id="autocomplete" value="<?php echo $profile_details['address']; ?>">

                           <input type="hidden" name="lat" id="lat_from" class="form-control" placeholder="" value="<?php echo $profile_details['latitude']; ?>" required>
                           <input type="hidden" name="lng" id="lng_from" class="form-control" placeholder="" value="<?php echo $profile_details['longitude']; ?>" required>
                        </div>
                        <div class="col-sm-6">
                           <label>Address Line2 <span class="star">*</span></label>
                           <input type="text" class="form-control info-text" placeholder="Address Line 2" name="address2" id="address2" value="<?php echo $profile_details['address2']; ?>">
                        </div>
                        <div class="col-sm-6">
                           <label>Country/Territory <span class="star">*</span></label>
                           <?php echo fillCombo('countries_master', 'id', 'name', $profile_details['country'], 'status = 1', 'id', 'form-control info-text', 'country', 'country'); ?>
                           <!-- <input type="text" class="form-control info-text" placeholder="Country" name="country" id="country"> -->
                        </div>
                        <div class="col-sm-6">
                           <label>State <span class="star">*</span></label>
                           <?php echo fillCombo('states_master', 'id', 'name', $profile_details['state'], 'country_id=' . $profile_details['country'], 'id', 'form-control info-text', 'state', 'state'); ?>
                           <input type="hidden" name="state_google_val" id="state_google_val" value="">
                           <!-- <input type="text" class="form-control info-text" placeholder="State" name="state" id="state"> -->
                        </div>
                        <div class="col-sm-6">
                           <label>City <span class="star">*</span></label>
                           <?php echo fillCombo('cities_master', 'id', 'name', $profile_details['city'], 'state_id=' . $profile_details['state'], 'id', 'form-control info-text', 'city', 'city'); ?>
                           <input type="hidden" name="city_google_val" id="city_google_val" value="">
                           <!-- <input type="text" class="form-control info-text" placeholder="City" name="city" id="city"> -->
                        </div>
                        <div class="col-sm-6">
                           <label>Zip code <span class="star">*</span></label>
                           <input type="number" class="form-control info-text" placeholder="Zip code" name="zip" id="zip" value="<?php echo $profile_details['zip']; ?>">
                        </div>
                        <div class="col-sm-6">
                           <label>Phone No. <span class="star">*</span></label><br />
                           <input type="tel" class="form-control info-text telephone" name="country_code" value="<?php echo $profile_details['country_code']; ?>" style="float:left;">
                           <input type="tel" class="form-control info-text" placeholder="Phone" name="telephone" id="telephone" value="<?php echo $profile_details['telephone']; ?>" style="width:69%; float:right; margin-top:0;">
                        </div>
                        <div class="col-sm-6">
                           <label>Email Address <span class="star">*</span></label>
                           <input type="email" class="form-control info-text" placeholder="Email" name="email" id="email" value="<?php echo $profile_details['email']; ?>">
                        </div>
                        <div class="col-sm-6 bu_fields" style="display:none;">
                           <input type="text" class="form-control info-text" placeholder="Company  Name" name="companyname" id="companyname" value="<?php echo $profile_details['companyname']; ?>">
                        </div>
                        <div class="col-sm-6 bu_fields" style="display:none;">
                           <input type="text" class="form-control info-text" placeholder="Website" name="website" id="website" value="<?php echo $profile_details['website']; ?>">
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-default">Update</button>
                  <!-- <button type="submit" class="btn btn-default edit">Edit</button>-->
                  <!--<button type="button" value="Change Password" data-toggle="modal" data-target="#myModal" class="btn btn-default pull-right color-red">Change Password</button>-->
                  <?php echo form_close(); ?>
                  <!--+++++++++++++++++++++++dashboard-end++++++++++++-->
               </div>
               <div id="menu1" class="tab-pane fade">
                  <div class="form-field-text">
                     <?php echo form_open(base_url('profile-password-update'), array('id' => 'ChangePasswordForm', 'class' => 'ChangePassword')); ?>
                     <div class="row">
                        <div class="col-sm-2">
                           &nbsp;
                        </div>
                        <div class="col-sm-8">
                           <label for="usr">Old Password</label>
                           <input type="password" class="form-control name-text" placeholder="Old Password" name="Old" id="Old" value="" required>
                           <span toggle="#Old" class="fa fa-fw fa-eye field-icon toggle-password" style="width: 34px; position: absolute; right: 18px; margin-top: -55px;}"></span>

                           <label for="usr">New Password </label>
                           <input type="password" class="form-control name-text" placeholder="New Password " name="New" id="New" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                           <span toggle="#New" class="fa fa-fw fa-eye field-icon toggle-password" style="width: 34px; position: absolute; right: 18px; margin-top: -55px;}"></span>
                           <small>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small><br>

                           <label>Confirm Password</label>
                           <input type="password" class="form-control info-text" placeholder="Confirm Password" name="Confirm" id="Confirm" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                           <span toggle="#Confirm" class="fa fa-fw fa-eye field-icon toggle-password" style="width: 34px; position: absolute; right: 18px; margin-top: -55px;}"></span>

                           <p id="ErrorMessageP"></p>

                           <button type="submit" value="Change Password" class="btn btn-default pull-left color-red">Change Password</button>

                        </div>
                        <div class="col-sm-2">
                           &nbsp;
                        </div>
                     </div>
                     <?php echo form_close(); ?>
                  </div>
               </div>
               <div id="credit" class="tab-pane fade">
                  <div class="form-field-text">
                     <?php echo form_open(base_url('credit-amount-update'), array('id' => 'CreditAmountForm', 'class' => 'CreditAmountForm')); ?>
                     <div class="row">
                        <div class="col-sm-12">
                           <h3>Credit Limit($): <?php echo number_format($profile_details['credit_limit'], 2); ?></h3>
                           <h3>Remaining Credit Limit($): <?php echo number_format($profile_details['credit_outstanding_amount'], 2); ?></h3>
                        </div>
                        <?php $totpay = $profile_details['credit_limit'] - $profile_details['credit_outstanding_amount'];
                        if ($totpay > 0) {
                        ?>
                           <div class="col-sm-6">
                              <label><strong>Payable Amount($)</strong>: <?php echo number_format(($profile_details['credit_limit'] - $profile_details['credit_outstanding_amount']), 2); ?></label><br />
                              <p style="display: none;"><input type="radio" name="pay_type" value="cash" class="form-control info-text" checked="checked" />Cash</p>
                              <p><input type="radio" name="pay_type" value="card" class="form-control info-text" />Card</p>

                              <div class="panel-body" id="cardinfo" style="display:none;">
                                 <div class="form-group">
                                    <label>NAME</label>
                                    <input type="text" name="cardname" id="cardname" placeholder="Enter name" autofocus="">
                                 </div>

                                 <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off">
                                 </div>
                                 <div class="row">
                                    <div class="left">
                                       <div class="form-group">
                                          <label>EXPIRY DATE</label>
                                          <div class="col-1">
                                             <input type="text" name="card_exp_month" placeholder="MM" maxlength="2" id="card_exp_month">
                                          </div>
                                          <div class="col-2">
                                             <input type="text" name="card_exp_year" placeholder="YY" maxlength="2" id="card_exp_year">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="right">
                                       <div class="form-group">
                                          <label>CVC CODE</label>
                                          <input type="text" name="card_cvc" placeholder="CVC" autocomplete="off" maxlength="3" id="card_cvc">
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <input type="hidden" name="payable_amount" value="<?php echo ($profile_details['credit_limit'] - $profile_details['credit_outstanding_amount']); ?>" />
                              <input type="hidden" name="credit_outstanding_amount" value="<?php echo $profile_details['credit_limit']; ?>" />
                              <button type="submit" class="btn btn-default">Pay</button>
                           </div>

                           <div class="col-sm-6">
                              &nbsp;
                           </div>
                        <?php } ?>
                     </div>
                     <?php echo form_close(); ?>
                  </div>
               </div>
            </div>
         </div>
         <!--+++++++++++++++++++++++right-side==============-->
      </div>
   </div>
</section>
<?php $this->load->view('frontend/includes/footer'); ?>

<script>
   $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
         input.attr("type", "text");
      } else {
         input.attr("type", "password");
      }
   });

   $(function() {
      $('input[name=user_type]').change(function() {
         var value = $('input[name=user_type]:checked').val();
         //alert(value);
         $('.bu_fields').toggle();
      });
      $("#profileF").submit('on', function(e) {
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
            data: $('#profileF').serializeArray(),
            headers: {
               'Authkey': '<?= $this->security->get_csrf_hash(); ?>'
            },
            url: $('#profileF').attr('action'),
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
                  $('#profileF').trigger('reset');
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

      $("#CreditAmountForm").submit('on', function(e) {
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
            data: $('#CreditAmountForm').serializeArray(),
            headers: {
               'Authkey': '<?= $this->security->get_csrf_hash(); ?>'
            },
            url: $('#CreditAmountForm').attr('action'),
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
                  $('#CreditAmountForm').trigger('reset');
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

      $('#country').on('change', function() {
         var countryID = $(this).val();
         if (countryID) {
            $.ajax({
               type: 'POST',
               headers: {
                  'csrftoken': '<?= $this->security->get_csrf_hash(); ?>'
               },
               url: '<?php echo base_url('getStates'); ?>',
               data: 'country_id=' + countryID,
               success: function(data) {
                  $('#state').html('<option value="">Select State</option>');
                  var dataObj = jQuery.parseJSON(data);
                  if (dataObj) {
                     $(dataObj).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.id).text(this.name);
                        $('#state').append(option);
                     });
                     var state_google_val = $('#state_google_val').val();
                     if (state_google_val != '') {
                        $("#state option:contains(" + state_google_val + ")").attr("selected", true);
                        $("#state").trigger('change');
                     }
                  } else {
                     $('#state').html('<option value="">State not available</option>');
                  }
               }
            });
         } else {
            $('#state').html('<option value="">Select Country first</option>');
            $('#city').html('<option value="">Select State first</option>');
         }
      });

      $('#state').on('change', function() {
         var stateID = $(this).val();
         if (stateID) {
            $.ajax({
               type: 'POST',
               headers: {
                  'csrftoken': '<?= $this->security->get_csrf_hash(); ?>'
               },
               url: '<?php echo base_url('getCity'); ?>',
               data: 'state_id=' + stateID,
               success: function(data) {
                  $('#city').html('<option value="">Select City</option>');
                  var dataObj = jQuery.parseJSON(data);
                  if (dataObj) {
                     $(dataObj).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.id).text(this.name);
                        $('#city').append(option);
                     });
                     var city_google_val = $('#city_google_val').val();
                     if (city_google_val != '') {
                        $("#city option:contains(" + city_google_val + ")").attr("selected", true);
                        $("#city").trigger('change');
                     }
                  } else {
                     $('#city').html('<option value="">State not available</option>');
                  }
               }
            });
         } else {
            $('#city').html('<option value="">Select State first</option>');
         }
      });
   });

   $(".ChangePassword").submit('on', function(e) {
      e.preventDefault();
      var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
         csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var New, Old, Confirm;
      New = $('#New').val();
      Old = $('#Old').val();
      Confirm = $('#Confirm').val();
      $("#element_overlap1").LoadingOverlay("show");
      $.ajax({
         dataType: "json",
         type: "post",
         data: {
            [csrfName]: csrfHash,
            New: New,
            Old: Old,
            Confirm: Confirm,
         },
         headers: {
            'Authkey': '<?= $this->security->get_csrf_hash(); ?>'
         },
         url: '<?= base_url('profile-password-update'); ?>',
         success: function(data) {
            $("#element_overlap1").LoadingOverlay("hide", true);
            if (data.status == 0) {
               toastr.error('<span style="color:#fff;">' + data.message + '</span>');
            }
            if (data.status == 1) {
               $('#ErrorMessageP').html(data.message);
               toastr.success('<span style="color:#fff;">' + data.message + '</span>');

            }
         },
         error: function(jqXHR, status, err) {
            toastr.error('<span style="color:#fff;">Local error callback.</span>');
         }
      });
      //} //else
   });

   $(document).ready(function() {
      $("input[name='pay_type']").click(function() {
         var radioValue = $("input[name='pay_type']:checked").val();
         if (radioValue == 'card') {
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