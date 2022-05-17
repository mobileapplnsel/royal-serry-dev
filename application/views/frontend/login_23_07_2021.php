<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
?>
<section class="form-contact-text">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div class="text-form-content" id="element_overlapT">
               <h3>Login</h3>
               <p>Sign in to continue</p>
                  <?php echo form_open(base_url('userlogin'), array('id' => 'loginF', 'class' => 'contact-form')); ?>
                  <div class="form-group">
                     <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required">
                  </div>
                  <div class="form-group">
                     <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">
                  </div>
                  <div class="col-xs-12">
                     <p class="omb_forgotPwd"><a href="<?php echo base_url('forgot-password'); ?>">Forgot password?</a></p>
                  </div>
                  <button type="submit" class="btn btn-default">Login</button>
                  <div class="form-group">
                     <div class="col-sm-12 control">
                        <div class="bottom-line-text">Have an account yet? <a href="<?php echo base_url('registration'); ?>">Signup Now.</a>
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
<script>
    $(function(){
    $("#loginF").submit('on',function(e){
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
            data : $('#loginF').serializeArray(),
            headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
              url: $('#loginF').attr('action'),
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
                    $('#loginF').trigger('reset');
                    setTimeout(function() {
                        window.location.href = data.redirectUrl;
                    }, 500); 
                }
            },
            error: function (jqXHR, status, err) {
              toastr.remove()
              toastr.error('<span style="color:#fff;">Local error callback.</span>');
            }

          });


    });

});
</script>