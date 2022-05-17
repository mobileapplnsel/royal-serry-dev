<?php defined('BASEPATH') or exit('No direct script access allowed');

$this->load->view('frontend/includes/header');

?>
<style>
   .carousel-fade .carousel-inner .item {
      transition-property: opacity;
   }

   .carousel-fade .carousel-inner .item,
   .carousel-fade .carousel-inner .active.left,
   .carousel-fade .carousel-inner .active.right {
      opacity: 0;
   }

   .carousel-fade .carousel-inner .active,
   .carousel-fade .carousel-inner .next.left,
   .carousel-fade .carousel-inner .prev.right {
      opacity: 1;
   }

   .carousel-fade .carousel-inner .next,
   .carousel-fade .carousel-inner .prev,
   .carousel-fade .carousel-inner .active.left,
   .carousel-fade .carousel-inner .active.right {
      left: 0;
      transform: translate3d(0, 0, 0);
   }




   .slide {
      margin-top: 0px;
      margin-left: 0;
      margin-right: 0;
      clear: both;
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/aos.css" />






<!-- Banner Section Starts -->
<div id="carousel-example-generic" class="carousel-fade carousel slide" data-ride="carousel">
   <!-- Indicators -->
   <ol class="carousel-indicators">
      <?php
      // print_r($bannerList);die;
      if (!empty($bannerList)) {
         $flag = 1;
         foreach ($bannerList as $key => $banner) {
      ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key; ?>" class="<?php if ($flag == 1) {echo 'active';} ?>"></li>
      <?php $flag++;
         }
      } ?>
   </ol>
   <!-- Wrapper for slides -->
   <div class="carousel-inner" role="listbox">
      <?php
      // print_r($bannerList);die;
      if (!empty($bannerList)) {
         $flag = 1;
         foreach ($bannerList as $banner) {
      ?>
            <div class="item <?php if ($flag == 1) {
                                 echo 'active';
                              } ?>">
               <a target="_blank"></a>
               <img src="<?php echo base_url(); ?>uploads/banner/mobile/<?php echo $banner['image']; ?>" alt="" style="width:100%;">
               <div class="carousel-caption">
                  <h1><?php echo $banner['heading'] . '<br>';
                        if ($banner['heading2'] != '') {
                           echo $banner['heading2'] . '<br>';
                        }
                        if ($banner['heading3'] != '') {
                           echo $banner['heading3'] . '<br>';
                        }
                        ?></h1>
                  <p><?php echo $banner['sub_heading']; ?></p>
               </div>
            </div>
      <?php $flag++;
         }
      } ?>
   </div>
   <!-- Controls -->
   <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
   </a>
   <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
   </a>
</div>





<!--contact info-->

<section class="Info-text-bottom">

   <div class="container">

      <div class="row">

         <div class="col-sm-3">

            <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
               <div class="single-info-text">
                  <?php echo $SectioncallCentre->description; ?>

               </div>
            </div>

         </div>

         <div class="col-sm-4">
            <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">

               <div class="single-info-text">
                  <?php echo $SectionLocation->description; ?>

               </div>
            </div>

         </div>

         <div class="col-sm-5">
            <div data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">

               <div class="single-info-text">

                  <h3>Track & Trace</h3>

                  <div class="newsletter-form">

                     <?php echo form_open(base_url('order-tracking-search'), array('id' => 'trackingF', 'class' => '')); ?>

                     <div class="form-group">

                        <input type="text" style="width: calc(100% - 130px)!important; float: left;" name="shipment_no" id="shipment_no" class="form-control" placeholder="EX: 123456">

                        <button class="btn btn-primary" type="submit">Track & Trace</button>

                        <div class="clearfix"></div>

                     </div>

                     <?php echo form_close(); ?>

                  </div>

               </div>
            </div>

         </div>

      </div>

   </div>

</section>

<section class="shipment-bottom-section">

   <div class="container">

      <?php /*<div class="row">
         <div class="col-md-4">
            <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">

               <h5>Our <br /> people , <br /><span class="shipment-text-title">your freight.</span></h5>

               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

            </div>
         </div>
         <div class="col-md-4">
            <div class="code code--small code--right aos-init aos-animate" data-aos="flip-right">

               <img src="<?php echo base_url(); ?>assets/frontend/images/about-img.png" alt="" />

            </div>
         </div>
         <div class="col-md-4">

            <div data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine" class="aos-init aos-animate">
               <div class="shipment-background">

                  <p>Our core values:</p>

                  <ul class="shipment-line-text">

                     <li>Innovative - Open and creative to customer and employee solutions.</li>

                     <li>Transparent Communication and Collaboration. We communicate openly.</li>

                     <li>Don't fix what isn't broken, unless it provides a road map to increased productivity.</li>

                     <li>Shared Goal & Initiative Alignment.We accomplish our goals more efficiently.</li>

                  </ul>

               </div>
            </div>

         </div>

      </div>*/ ?>

      <div class="row">
         <div class="col-md-4">
            <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">

               <?php echo $SectionOne->description; ?>

            </div>
         </div>
         <div class="col-md-4">
            <div class="code code--small code--right aos-init aos-animate" data-aos="flip-right">

               <img src="<?php echo base_url() . 'assets/frontend/images/' . $SectionImg1->image; ?>" alt="" />

            </div>
         </div>
         <div class="col-md-4">

            <div data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine" class="aos-init aos-animate">
               <div class="shipment-background">

                  <?php echo $SectionOne2->description; ?>

               </div>
            </div>

         </div>

      </div>

   </div>

   <div class="bottom-color-button">

      <div class="container">

         <div class="row">

            <div class="col-md-4">
               <div data-aos="zoom-in-up">

                  <a href="<?php echo base_url(); ?>home" class="green-button-text">Schedule shipment</a>
               </div>
            </div>

            <div class="col-md-4">
               <div data-aos="zoom-in-up">

                  <a href="<?php echo base_url(); ?>home" class="red-button-text">Get estimated cost/quote</a>
               </div>
            </div>

            <div class="col-md-4">
               <div data-aos="zoom-in-up">

                  <a href="<?php echo base_url(); ?>home" class="gray-button-text"> Start Shipment</a>
               </div>
            </div>

         </div>

      </div>

   </div>

</section>

<section class="app-background-section">

   <div class="container">

      <div class="row">

         <div class="col-md-6">
            <div class="code code--small code--right aos-init" data-aos="flip-right">

               <div class="app-img-section">

                  <img src="<?php echo base_url(); ?>assets/frontend/images/app-img.jpg" alt="">

               </div>
            </div>
         </div>

         <div class="col-md-6">
            <div class="code code--small code--left aos-init" data-aos="flip-up">

               <div class="app-img-text">

                  <h2>Download </h2>

                  <h5>Mobile Apps</h5>

                  <div class="app-button">

                     <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/google-play-button.png" alt=""></a>

                     <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/app-store-button.png" alt=""></a>

                  </div>

               </div>
            </div>
         </div>

      </div>

   </div>

</section>

<section class="equal-package-section">

   <div class="row no-margin">

      <div class="col-md-6 no-padding">
         <div data-aos="zoom-out-up">
            <div class="package-section-text">
               <!--<h2>We give you <br /> complete control of <br /> your shipments.</h2>
               <div class="col-sm-6">
                  <h5>Shipping </h5>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                  <a href="#" class="read-more-text">READ MORE....</a>
               </div>
               <div class="col-sm-6">
                  <h5>Packages </h5>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                  <a href="#" class="read-more-text">READ MORE....</a>
               </div>-->
               <?php echo $SectionTwo->description; ?>
            </div>
         </div>
      </div>

      <div class="col-md-6 no-padding">

         <div class="section-img-no-padding">

            <img src="<?php echo base_url() . 'assets/frontend/images/' . $SectionImg2->image; ?>" alt="" style="width:100%;">

         </div>

      </div>

   </div>

</section>

<section class="countdown-timer-section" style="display:none">

   <div class="container">

      <div class="row">

         <div class="col-sm-3">
            <div data-aos="zoom-in-up">

               <div class="count">6500m</div>

               <h5>Delivered Packages</h5>
            </div>
         </div>

         <div class="col-sm-3">
            <div data-aos="zoom-in-up">

               <div class="count">57</div>

               <h5>State Covered</h5>
            </div>
         </div>

         <div class="col-sm-3">
            <div data-aos="zoom-in-up">

               <div class="count">784</div>

               <h5>Satisfied Clients</h5>
            </div>
         </div>

         <div class="col-sm-3">
            <div data-aos="zoom-in-up">

               <div class="count">4500 m</div>

               <h5>Tons of Goods</h5>
            </div>
         </div>

      </div>

   </div>

</section>

<section class="banner-left-section">

   <div class="container">

      <div class="row">

         <div class="col-sm-12">
            <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">

               <div class="banner-box-shadow">
                  <!--<h2>Pallets,<br /> Containers & Cargo</h2>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->
                  <?php echo $SectionThree->description; ?>
               </div>
            </div>
         </div>

      </div>

   </div>

</section>

<section class="blog-news-section">

   <div class="container">

      <h2>Latest News</h2>

      <div class="row">
         <?php //echo '<pre>'; print_r($newsList); echo '</pre>';
         ?>
         <?php
         if (!empty($newsList)) {
            foreach ($newsList as $news) {
         ?>
               <div class="col-md-4">
                  <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">

                     <div class="blog-image-box">

                        <a href="view-news/<?php echo $news['id']; ?>"><img src="<?php echo base_url(); ?>uploads/news_image/<?php echo $news['image']; ?>" alt=""></a>

                     </div>

                     <div class="blog-image-text">
                        <p> <a href="view-news/<?php echo $news['id']; ?>"><?php echo $news['category_name']; ?></a></p>
                        <h3><a href="view-news/<?php echo $news['id']; ?>"><?php echo $news['name']; ?> </a></h3>
                        <p><?php echo substr($news['description'], 0, 80); ?> </p>
                     </div>

                     <a href="view-news/<?php echo $news['id']; ?>" class="blog-read-button">READ MORE</a>
                  </div>

               </div>
         <?php }
         } ?>

         <!--<div class="col-md-4">
                  <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">

                  <div class="blog-image-box">

                     <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/blog-img-2.jpg" alt=""></a>

                  </div>

                  <div class="blog-image-text">

                     <p> <a href="#">Delivery, Package, Transport</a></p>

                     <h3><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </a></h3>

                     <p>Lorem Ipsum is simply dummy text of the<br/> printing and typesetting industry. </p>

                  </div>

                  <a href="#" class="blog-read-button">READ MORE</a>
                  </div>

               </div>

               <div class="col-md-4">
                  <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">

                  <div class="blog-image-box">

                     <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/blog-img-3.jpg" alt=""></a>

                  </div>

                  <div class="blog-image-text">

                     <p> <a href="#">Delivery, Package, Transport</a></p>

                     <h3><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </a></h3>

                     <p>Lorem Ipsum is simply dummy text of the<br/> printing and typesetting industry. </p>

                  </div>

                  <a href="#" class="blog-read-button">READ MORE</a>
                  </div>

               </div>-->

      </div>

   </div>

</section>

<script src="<?php echo base_url(); ?>assets/frontend/js/aos.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/highlight.js"></script>

<script>
   AOS.init({
      easing: 'ease-out-back',
      duration: 1000
   });
</script>

<script>
   hljs.initHighlightingOnLoad();

   $('.hero__scroll').on('click', function(e) {
      $('html, body').animate({
         scrollTop: $(window).height()
      }, 1200);
   });
</script>

<script>
   $(window).on("load resize", function() {

      var counters = $(".count");
      var countersQuantity = counters.length;
      var counter = [];

      for (i = 0; i < countersQuantity; i++) {
         counter[i] = parseInt(counters[i].innerHTML);
      }

      var count = function(start, value, id) {
         var localStart = start;
         setInterval(function() {
            if (localStart < value) {
               localStart++;
               counters[id].innerHTML = localStart;
            }
         }, 4);
      }

      for (j = 0; j < countersQuantity; j++) {
         count(0, counter[j], j);
      }
   });
</script>

<?php $this->load->view('frontend/includes/footer'); ?>