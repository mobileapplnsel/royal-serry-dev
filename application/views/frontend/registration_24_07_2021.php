<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
$this->load->view('frontend/includes/contact');
?>
<section class="form-contact-text">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div class="form-registration-text" id="element_overlapT">
               <h3>Registration</h3>
               <!-- <p>Sign in to continue</p> -->
                <!-- <form action="<?=base_url('register-user');?>" id="registerF" method="post" class="contact-form-registration" aria-label="Contact Form Area"> -->
                  <?php echo form_open(base_url('register-user'), array('id' => 'registerF', 'class' => 'contact-form-registration')); ?>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="user_type" id="inlineRadio1" value="NU" checked="checked">
                     <label class="form-check-label" for="inlineRadio1">Normal user</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="user_type" id="inlineRadio2" value="BU">
                     <label class="form-check-label" for="inlineRadio2">Business user</label>
                  </div>
                  <div class="form-field-text">
                     <div class="row">
                        <div class="col-sm-6">
                           <input type="text" class="form-control name-text" placeholder="First name" name="firstname" id="firstname">
                        </div>
                        <div class="col-sm-6">
                           <input type="text" class="form-control name-text" placeholder="Last name" name="lastname" id="lastname">
                        </div>
                        <div class="col-sm-6 bu_fields" style="display:none;">
                           <input type="text" class="form-control info-text" placeholder="Company  Name" name="companyname" id="companyname">
                        </div>
                        <div class="col-sm-6 bu_fields" style="display:none;">
                           <input type="text" class="form-control info-text" placeholder="Website" name="website" id="website">
                        </div>

                     </div>
                  </div>
                  <div class="form-field-text">
                     <div class="row">
                        <div class="col-sm-6">
                           <input type="text" class="form-control info-text" placeholder="Address Line 1" name="address" id="autocomplete" onFocus="geolocate()">
                        </div>
                        <div class="col-sm-6">
                           <input type="text" class="form-control info-text" placeholder="Address Line 2" name="address2" id="street_number">
                        </div>
                        <div class="col-sm-6">
                           <?php echo fillCombo('countries_master', 'id', 'name', '', 'status = 1', 'id', 'form-control info-text', 'country', 'country'); ?>
                           <!-- <input type="text" class="form-control info-text" placeholder="Country" name="country" id="country"> -->
                        </div>
                        <div class="col-sm-6">
                           <select name="state" id="state" class="form-control info-text">
                              <option value="">Select Country first</option>
                           </select>
                           <!-- <input type="text" class="form-control info-text" placeholder="State" name="state" id="state"> -->
                        </div>
                        <div class="col-sm-6">
                           <select name="city" id="city" class="form-control info-text">
                              <option value="">Select State first</option>
                           </select>
                           <!-- <input type="text" class="form-control info-text" placeholder="City" name="city" id="city"> -->
                        </div>
                        <div class="col-sm-6">
                           <input type="number" class="form-control info-text" placeholder="Zip code" name="zip" id="postal_code">
                        </div>
                     </div>
                  </div>
                  <div class="form-field-text">
                     <div class="row">
                        <div class="col-sm-6">
                           <input type="number" class="form-control info-text" placeholder="Phone" name="telephone" id="telephone">
                        </div>
                        <div class="col-sm-6">
                           <input type="email" class="form-control info-text" placeholder="Email" name="email" id="email">
                        </div>
                        <div class="col-sm-6">
                           <input type="password" class="form-control info-text" placeholder="Password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                        <div class="col-sm-6">
                           <input type="password" class="form-control info-text" placeholder="Confirm Password" name="conf_password" id="conf_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-default">Registration</button>
                  <div class="form-group">
                     <div class="col-sm-12 control">
                        <div class="registration-bottom-text">Already have an account? <a href="<?php echo base_url('login'); ?>">login now</a>
                        </div>
                     </div>
                  </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('frontend/includes/footer');?>
<script src="<?php echo base_url(); ?>assets/frontend/js/auto-complete.js" type="text/javascript" ></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARF0EkzlBcTi4_uWIcdqOGqHyGTsUtduQ&libraries=places&callback=initAutocomplete" async defer></script>
<script>
    $(function(){
      $('input[name=user_type]').change(function(){
         var value = $( 'input[name=user_type]:checked' ).val();
         //alert(value);
         $('.bu_fields').toggle();
      });
    $("#registerF").submit('on',function(e){
          e.preventDefault();
          $("#element_overlapT").LoadingOverlay("show");
            toastr.remove()
            toastr.success('<span style="color:#fff;">Please wait...</span>');
            $.ajax({
            dataType : "json",
            type : "post",
            cache: false,
           // contentType: false,
            //processData: false,
            data : $('#registerF').serializeArray(),
            headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
              url: $('#registerF').attr('action'),
            success:function(data)
              {
               $("#element_overlapT").LoadingOverlay("hide", true);
                if(data.code == 400)
                {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">'+data.error+'</span>');
                }

                if(data.status == 0)
                {
                  toastr.remove()
                   toastr.error('<span style="color:#fff;">'+data.message+'</span>');
                }
                if(data.status == 1)
                {
                    toastr.remove()
                    toastr.success('<span style="color:#fff;">'+data.message+'</span>');
                    $('#registerF').trigger('reset');
                    setTimeout(function() {
                        window.location.href = data.redirectUrl;
                    }, 5000);
                }
            },
            error: function (jqXHR, status, err) {
              toastr.remove()
              toastr.error('<span style="color:#fff;">Local error callback.</span>');
            }

          });


    });

    $('#country').on('change', function () {
     var countryID = $(this).val();
     if (countryID) {
       $.ajax({
         type: 'POST',
         headers: {  'csrftoken': '<?=$this->security->get_csrf_hash();?>'},
         url: '<?php echo base_url('getStates'); ?>',
         data: 'country_id=' + countryID,
         success: function (data) {
           $('#state').html('<option value="">Select State</option>');
           var dataObj = jQuery.parseJSON(data);
           if (dataObj) {
             $(dataObj).each(function () {
               var option = $('<option />');
               option.attr('value', this.id).text(this.name);
               $('#state').append(option);
             });
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

    $('#state').on('change', function () {
     var stateID = $(this).val();
     if (stateID) {
       $.ajax({
         type: 'POST',
         headers: {  'csrftoken': '<?=$this->security->get_csrf_hash();?>'},
         url: '<?php echo base_url('getCity'); ?>',
         data: 'state_id=' + stateID,
         success: function (data) {
           $('#city').html('<option value="">Select City</option>');
           var dataObj = jQuery.parseJSON(data);
           if (dataObj) {
             $(dataObj).each(function () {
               var option = $('<option />');
               option.attr('value', this.id).text(this.name);
               $('#city').append(option);
             });
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
</script>