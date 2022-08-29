<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<footer>
   <section class="footer-bottom-text">
      <div class="container">
         <div class="row">
            <div class="col-sm-4">
               <div class="footer-contact-logo">
                  <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/logo.png" alt="ROYALSERRY Logo"></a>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="footer-contact-info">
                  <h4>Get in touch from here.</h4>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="footer-button-text">
                  <a href="<?php echo base_url(); ?>branch-list" class="green-call-button">Call Us Now</a>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="footer-link-section">
      <div class="container">
         <div class="row">
            <div class="col-sm-3">
               <h4 class="footer-title">Services</h4>
               <ul>
                  <li><a href="<?php echo base_url(); ?>air-freight">Air Freight</a></li>
                  <li><a href="<?php echo base_url(); ?>sea-freight">Sea Freight</a></li>
                  <li><a href="<?php echo base_url(); ?>land-transport">Land Transport</a></li>
                  <li><a href="<?php echo base_url(); ?>delivery">Delivery</a></li>
                  <!--<li><a href="<?php echo base_url(); ?>consultancy">Consultancy</a></li>
                  <li><a href="<?php echo base_url(); ?>value-added-services">Value Added Services</a></li>-->
               </ul>
            </div>
            <div class="col-sm-3">
               <h4 class="footer-title">Quick Links</h4>
               <ul>
                  <li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
                  <li><a href="<?php echo base_url(); ?>industry-sectors">Industry Sectors</a></li>
                  <li><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
               </ul>
            </div>
            <div class="col-sm-3">
               <h4 class="footer-title">Useful Links</h4>
               <ul>
                  <li><a href="<?php echo base_url(); ?>order-tracking">Track Shipment</a></li>
                  <li><a href="<?php echo base_url(); ?>use-services">User Services</a></li>
                  <li><a href="<?php echo base_url(); ?>terms-and-condition">Terms of Use.</a></li>
                  <li><a href="<?php echo base_url(); ?>privacy-policy">Privacy</a></li>
                  <!-- <li><a href="#">Warehouse Logistics</a></li>
                  <li><a href="#">Global Agents Network</a></li>
                  <li><a href="#">FAQ</a></li> -->
               </ul>
            </div>
            <div class="col-sm-3">
               <h4 class="footer-title">Follow Us</h4>
               <ul class="social-media-link">
                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fab fa-youtube"></i></a></li>
               </ul>
            </div>
         </div>

        
      </div>
   </section>
   <section class="copyright-section">
      <div class="container">
         <p>&copy; 2021 Royal Serry Shipping LLC. All rights reserved</p>
      </div>
   </section>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- loadingoverlap -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/loadingoverlap/loadingoverlay.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/loadingoverlap/loadingoverlay_progress.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for Datatables -->
<script src="<?= base_url('assets/admin/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAt4LSIfqh9KL_w3a9aQffOTrQ5n5neX0&libraries=places&callback=initAutocomplete"></script>
 -->

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAt4LSIfqh9KL_w3a9aQffOTrQ5n5neX0&amp;libraries=places"></script>

<script src="<?php echo base_url(); ?>assets/frontend/js/auto-complete.js" type="text/javascript"></script>
<!-- intlTelInput -->
<script src="<?php echo base_url(); ?>assets/frontend/plugins/intl-tel-input-master/build/js/intlTelInput.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>js/intro.js"></script>
<script>
   introJs().start();

</script>
<!--Bootstrap Alert-->
<script type="text/javascript">
   toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "500",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
   }

   <?php if ($this->session->flashdata('success')) { ?>
      toastr.success("<?php echo $this->session->flashdata('success'); ?>");
   <?php } else if ($this->session->flashdata('error')) { ?>
      toastr.error("<?php echo $this->session->flashdata('error'); ?>");
   <?php } else if ($this->session->flashdata('warning')) { ?>
      toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
   <?php } else if ($this->session->flashdata('info')) { ?>
      toastr.info("<?php echo $this->session->flashdata('info'); ?>");
   <?php } ?>
</script>
</body>

</html>

<style type="text/css">
   .iti--allow-dropdown {
      width: 100%;
   }
</style>

<script type="text/javascript">
   $(function() {
      $(".example1").dataTable({
         bFilter: false,
         bInfo: false,
         "order": [
            [3, "desc"]
         ]
      });
      $(".example2").dataTable();
   });

   $(function() {
      $("#trackingF").submit('on', function(e) {
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
            data: $('#trackingF').serializeArray(),
            headers: {
               'Authkey': '<?= $this->security->get_csrf_hash(); ?>'
            },
            url: $('#trackingF').attr('action'),
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
                  $('#trackingF').trigger('reset');
                  setTimeout(function() {
                     window.location.href = data.redirectUrl;
                  }, 500);
               }
            },
            error: function(jqXHR, status, err) {
               toastr.remove()
               toastr.error('<span style="color:#fff;">Local error callback.</span>');
            }
         });
      });
   });


   var input = document.querySelector(".telephone");
   window.intlTelInput(input, {
      // allowDropdown: false,
      autoHideDialCode: false,
      // autoPlaceholder: "off",
      dropdownContainer: document.body,
      // excludeCountries: ["us"],
      formatOnDisplay: false,
      geoIpLookup: function(callback) {
         $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            callback(countryCode);
         });
      },
      hiddenInput: "full_number",
      initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      //preferredCountries: ['in'],
      //separateDialCode: true,     
      utilsScript: "<?php echo base_url(); ?>assets/frontend/plugins/intl-tel-input-master/build/js/utils.js",
   });
</script>

<script>
   var max_chars = 2;

   $(document).on('keydown', '.number', function() {
      if ($(this).val().length >= max_chars) {
         $(this).val($(this).val().substr(0, max_chars));
      }
   });


   $(document).on('keyup', '.number', function() {
      if ($(this).val().length >= max_chars) {
         $(this).val($(this).val().substr(0, max_chars));
      }
   });


   var max_chars2 = 6;

   $(document).on('keydown', '.value_of_shipment', function() {
      if ($(this).val().length >= max_chars2) {
         $(this).val($(this).val().substr(0, max_chars2));
      }
   });


   $(document).on('keyup', '.value_of_shipment', function() {
      if ($(this).val().length >= max_chars2) {
         $(this).val($(this).val().substr(0, max_chars2));
      }
   });
</script>

<script language="javascript">
    $(document).ready(function () {
        $(".date-picker").datepicker({
            minDate: 0
        });
    });
</script>