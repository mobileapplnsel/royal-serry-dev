<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
?>
<section class="form-contact-text">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div class="text-form-content" id="element_overlapT">
               <h3>Forgot password</h3>
                  <?php echo form_open(base_url('forgot-password-email'), array('id' => 'forgetF', 'class' => 'contact-form')); ?>
                  <div class="form-group">
                     <input type="username" name="email" id="email" class="form-control" placeholder="Email" required="required">
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('frontend/includes/footer');?>
<script>
    $(function(){
    $("#forgetF").submit('on',function(e){
        e.preventDefault();
        $("#element_overlapT").LoadingOverlay("show");
        toastr.remove();
        toastr.success('<span style="color:#fff;">Please wait...</span>');
        $.ajax({
        dataType : "json",
        type : "post",
        cache: false,
       // contentType: false,
        //processData: false,
        data : $('#forgetF').serializeArray(),
        headers: {'Authkey': '<?=$this->security->get_csrf_hash();?>'},
        url: $('#forgetF').attr('action'),
        success:function(data)
          {
            $("#element_overlapT").LoadingOverlay("hide", true);
            if(data.code == 400)
            {
              toastr.remove();
              toastr.error('<span style="color:#fff;">'+data.error+'</span>');
            }

            if(data.status == 0)
            {
              toastr.remove();
               toastr.error('<span style="color:#fff;">'+data.message+'</span>');
            }
            if(data.status == 1)
            {
                toastr.remove();
                toastr.success('<span style="color:#fff;">'+data.message+'</span>');
                $('#forgetF').trigger('reset');
                setTimeout(function() {
                  window.location.href = data.redirectUrl;
                }, 5000);
            }
        },
        error: function (jqXHR, status, err) {
          toastr.remove();
          toastr.error('<span style="color:#fff;">Local error callback.</span>');
        }

      });
    });
});
</script>