	<!--contact info-->
<section class="Info-text">
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
		           <?php echo form_open(base_url('order-tracking-search'), array('id' => 'trackingF', 'class' => '')); ?>
			        <div class="form-group">
				    <input type="text" name="shipment_no" id="shipment_no" class="form-control" placeholder="EX: 123456" style="width: calc(100% - 130px);float: left;">
				    <button class="btn btn-primary" type="submit">Track & Trace</button>
				    <div class="clearfix"></div>
			       </div>
		           <?php echo form_close(); ?>
	          </div>
                    </div>
                </div>
        </div>
</div>
</section>
