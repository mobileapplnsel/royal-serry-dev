<?php defined('BASEPATH') or exit('No direct script access allowed');

$this->load->view('frontend/includes/header');

?>
<style>.carousel-fade .carousel-inner .item {
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




.slide{ 
  margin-top: 0px;
	margin-left: 0;
	margin-right: 0;
	clear: both;
}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 






<!-- Banner Section Starts -->
 <div id="carousel-example-generic" class="carousel-fade carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="<?php echo base_url(); ?>assets/frontend/images/banner-home.jpg" alt="" style="width:100%;">
                  <div class="carousel-caption">
                   <h1>People<br>Partnersship<br>Performence</h1>
               <p>Keeping our customers satisfied.</p>
                  </div>
                </div>
                <div class="item">
                 <img src="<?php echo base_url(); ?>assets/frontend/images/banner-home2.jpg" alt="" style="width:100%;">
                  <div class="carousel-caption">
                   <h1>People<br>Partnersship<br>Performence</h1>
               <p>Keeping our customers satisfied.</p>
                  </div>
                </div>
                <div class="item">
                 <img src="<?php echo base_url(); ?>assets/frontend/images/banner-home3.jpg" alt="" style="width:100%;">
                  <div class="carousel-caption">
                    <h1>People<br>Partnersship<br>Performence</h1>
               <p>Keeping our customers satisfied.</p>
                  </div>
                </div>
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

                  <div class="single-info-text">

                     <h3>Call Centre</h3>

                     <p>24/7 Support<br> <a href="tel:1800 565 5986">1800 565 5986</a></p>

                  </div>

               </div>

               <div class="col-sm-4">

                  <div class="single-info-text">

                     <h3>Locations</h3>

                     <p>8101 Sandy Spring Rd, Suite 300-24,<br> Laurel, Md 20707</p>

                  </div>

               </div>

               <div class="col-sm-5">

                  <div class="single-info-text">

                     <h3>Track & Trace</h3>

                     <div class="newsletter-form">

                        <form>

                           <div class="form-group">

                              <input type="email" name="newsletter-email" class="form-control" placeholder="EX: 123456">

                              <button class="btn btn-primary">Track & Trace</button>

                              <div class="clearfix"></div>

                           </div>

                        </form>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </section>

      <section class="shipment-bottom-section">

         <div class="container">

            <div class="row">

               <div class="col-md-4">

                  <h5>Our <br /> people , <br /><span class="shipment-text-title">your freight.</span></h5>

                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

               </div>

               <div class="col-md-4">

                  <img src="<?php echo base_url(); ?>assets/frontend/images/about-img.png" alt="" />

               </div>

               <div class="col-md-4">

                  <div class="shipment-background">

                     <p>Our core values:</p>

                     <ul class="shipment-line-text">

                        <li><i class="fas fa-circle"></i> Innovative - Open and creative to customer and employee solutions.</li>

                        <li><i class="fas fa-circle"></i> Transparent Communication and Collaboration. We communicate openly.</li>

                        <li><i class="fas fa-circle"></i> Don't fix what isn't broken, unless it provides a road map to increased productivity.</li>

                        <li><i class="fas fa-circle"></i> Shared Goal & Initiative Alignment.We accomplish our goals more efficiently.</li>

                     </ul>

                  </div>

               </div>

            </div>

         </div>

         <div class="bottom-color-button">

            <div class="container">

               <div class="row">

                  <div class="col-md-4">

                     <a href="#" class="green-button-text">Schedule shipment</a>

                  </div>

                  <div class="col-md-4">

                     <a href="#" class="red-button-text">Get estimated cost/quote</a>

                  </div>

                  <div class="col-md-4">

                     <a href="#" class="gray-button-text"> Start Shipment</a>

                  </div>

               </div>

            </div>

         </div>

      </section>

      <section class="app-background-section">

         <div class="container">

            <div class="row">

               <div class="col-md-6">

                  <div class="app-img-section">

                     <img src="<?php echo base_url(); ?>assets/frontend/images/app-img.jpg" alt="">

                  </div>

               </div>

               <div class="col-md-6">

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

      </section>

      <section class="equal-package-section">

         <div class="row no-margin">

            <div class="col-md-6 no-padding">

               <div class="package-section-text">

                  <h2>We give you <br /> complete control of <br /> your shipments.</h2>

                  <div class="col-sm-6">

                     <h5>Shipping </h5>

                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>

                     <a href="#" class="read-more-text">READ MORE....</a>

                  </div>

                  <div class="col-sm-6">

                     <h5>Packages </h5>

                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>

                     <a href="#" class="read-more-text">READ MORE....</a>

                  </div>

               </div>

            </div>

            <div class="col-md-6 no-padding">

               <div class="section-img-no-padding">
               <img src="<?php echo base_url(); ?>assets/frontend/images/package-img.jpg" alt="" style="width:100%;">

               </div>

            </div>

         </div>

      </section>

      <section class="countdown-timer-section">

         <div class="container">

            <div class="row">

               <div class="col-sm-3">

                  <div class="count">6500m</div>

                  <h5>Delivered Packages</h5>

               </div>

               <div class="col-sm-3">

                  <div class="count">57</div>

                  <h5>State Covered</h5>

               </div>

               <div class="col-sm-3">

                  <div class="count">784</div>

                  <h5>Satisfied Clients</h5>

               </div>

               <div class="col-sm-3">

                  <div class="count">4500 m</div>

                  <h5>Tons of Goods</h5>

               </div>

            </div>

         </div>

      </section>

      <section class="banner-left-section">

         <div class="container">

            <div class="row">

               <div class="col-sm-12">

                  <div class="banner-box-shadow">

                     <h2>Pallets,<br /> Containers & Cargo</h2>

                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                  </div>

               </div>

            </div>

         </div>

      </section>

      <section class="blog-news-section">

         <div class="container">

            <h2>Latest News</h2>

            <div class="row">

               <div class="col-md-4">

                  <div class="blog-image-box">

                     <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/blog-img-1.jpg" alt=""></a>

                  </div>

                  <div class="blog-image-text">

                     <p> <a href="#">Delivery, Package, Transport</a></p>

                     <h3><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </a></h3>

                     <p>Lorem Ipsum is simply dummy text of the<br/> printing and typesetting industry. </p>

                  </div>

                  <a href="#" class="blog-read-button">READ MORE</a>

               </div>

               <div class="col-md-4">

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

               <div class="col-md-4">

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

            </div>

         </div>

      </section>
      <script>  
	        
	$(window).on("load resize",function() {

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

<?php $this->load->view('frontend/includes/footer');?>