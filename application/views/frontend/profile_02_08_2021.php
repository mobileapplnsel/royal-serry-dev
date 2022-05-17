<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
?>

<section class="form-contact-text">
   <div class="container">
      <div class="row">
         <h3>My Account</h3>
         <br>
         <!--+++++++++++++++++++++++left-side==============-->
         <?php $this->load->view('frontend/includes/left-panel');?>
         <!--+++++++++++++++++++++++left-side-end==============-->
         <!--+++++++++++++++++++++++right-side==============-->
         <div class="col-sm-9 white-gap" id="element_overlapT">
            <!--+++++++++++++++++++++++++dashboard================-->
            <?php echo form_open(base_url('profile-update'), array('id' => 'profileF', 'class' => 'contact-form-registration')); ?>
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
                           <input type="text" class="form-control name-text" placeholder="First name" name="firstname" id="firstname" value="<?php echo $profile_details['firstname']; ?>">
                        </div>
                        <div class="col-sm-6">
                           <input type="text" class="form-control name-text" placeholder="Last name" name="lastname" id="lastname" value="<?php echo $profile_details['lastname']; ?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-field-text">
                     <div class="row">
                        <div class="col-sm-6">
                           <input type="text" class="form-control info-text" placeholder="Address Line 1" name="address" id="address" value="<?php echo $profile_details['address']; ?>">
                        </div>
                        <div class="col-sm-6">
                           <input type="text" class="form-control info-text" placeholder="Address Line 2" name="address2" id="address2" value="<?php echo $profile_details['address2']; ?>">
                        </div>
                        <div class="col-sm-6">
                           <?php echo fillCombo('countries_master', 'id', 'name', $profile_details['country'], 'status = 1', 'id', 'form-control info-text', 'country', 'country'); ?>
                           <!-- <input type="text" class="form-control info-text" placeholder="Country" name="country" id="country"> -->
                        </div>
                        <div class="col-sm-6">
                           <?php echo fillCombo('states_master', 'id', 'name', $profile_details['state'], 'country_id=' . $profile_details['country'], 'id', 'form-control info-text', 'state', 'state'); ?>
                           <!-- <input type="text" class="form-control info-text" placeholder="State" name="state" id="state"> -->
                        </div>
                        <div class="col-sm-6">
                           <?php echo fillCombo('cities_master', 'id', 'name', $profile_details['city'], 'state_id=' . $profile_details['state'], 'id', 'form-control info-text', 'city', 'city'); ?>
                           <!-- <input type="text" class="form-control info-text" placeholder="City" name="city" id="city"> -->
                        </div>
                        <div class="col-sm-6">
                           <input type="number" class="form-control info-text" placeholder="Zip code" name="zip" id="zip" value="<?php echo $profile_details['zip']; ?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-field-text">
                     <div class="row">
                        <div class="col-sm-6">
                           <input type="number" class="form-control info-text" placeholder="Phone" name="telephone" id="telephone" value="<?php echo $profile_details['telephone']; ?>">
                        </div>
                        <div class="col-sm-6">
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
               <button type="reset" value="Reset" class="btn btn-default pull-right">Change Password</button>
            <?php echo form_close(); ?>
            <!--+++++++++++++++++++++++dashboard-end++++++++++++-->
         </div>
         <!--+++++++++++++++++++++++right-side==============-->
      </div>
   </div>
</section>

<?php $this->load->view('frontend/includes/footer');?>

<script>
    $(function(){
      $('input[name=user_type]').change(function(){
         var value = $( 'input[name=user_type]:checked' ).val();
         //alert(value);
         $('.bu_fields').toggle();
      });
    $("#profileF").submit('on',function(e){
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
            data : $('#profileF').serializeArray(),
            headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
              url: $('#profileF').attr('action'),
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
                    $('#profileF').trigger('reset');
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