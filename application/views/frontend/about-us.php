<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
?>
<section class="blog-news-section">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div style="padding:15px;" class="blog-image-text" id="element_overlapT">
               <h1><?php echo $AboutMsg->name;?></h1>
               <p><?php echo $AboutMsg->description;?></p>
                  
            </div>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('frontend/includes/footer');?>