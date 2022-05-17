<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
?>
<section class="form-contact-text">
    <div class="container">
        <div class="row">
            <h3>Dashboard</h3>
            <br>
            <?php $this->load->view('frontend/includes/left-panel'); ?>
            <!--+++++++++++++++++++++++right-side==============-->
            <div class="col-sm-9 white-gap">
                <!--+++++++++++++++++++++++++dashboard================-->
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="card">
                            <h3>Generate Order</h3>
                            <!-- <p class="red">General</p> -->
                            <?php echo form_open(base_url('save-order'), array('id' => 'msform', 'class' => '')); ?>
                            <!-- progressbar -->

                            <br> <!-- fieldsets -->
                            <!--+++++++++++++++++++++++++++++++++++++++++++3-end++++++++++++++++++-->
                            <!--+++++++++++++++++++++++++++++++++++++++++++4-start++++++++++++++++++-->
                            <!-- <fieldset>
                                 <div class="form-card">
                                    <div class="row">
                                       <div class="col-sm-9">
                                          <h2 class="ds-title-new">Price : </h2>
                                          <div class="spacer"></div>
                                          <h2 class="ds-title-new">Tax : </h2>
                                          <div class="spacer"></div>
                                          <h2 class="ds-title-new"><strong>Total Price : </strong></h2>
                                       </div>
                                       <div class="col-sm-3">
                                          <h2 class="ds-title-new aalign-right">500 USD</h2>
                                          <div class="spacer"></div>
                                          <h2 class="ds-title-new aalign-right">50 USD</h2>
                                          <div class="spacer"></div>
                                          <h2 class="ds-title-new aalign-right"><strong>550 USD</strong></h2>
                                       </div>
                                       <div class="spacer-gap"></div>
                                       <div class="spacer-gap"></div>
                                    </div>
                                 </div>
                                 <input type="button" name="next" class="next action-button submit" value="next" />
                                 <input type="button" name="skip" class="next action-button edit2 submit" value="Get a Quote" />
                                 <input type="button" name="Back" class="Back action-button-Back" value="Back" />
                              </fieldset> -->
                            <!--+++++++++++++++++++++++++++++++++++++++++++4-end++++++++++++++++++-->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <!--++++++++++++++++++++++++++++++++++++++genarel-->
                                        <div class="col-sm-4">
                                            <p class="ds-title-new"><strong>General</strong>
                                                <!-- <a href="#" class="add-more"><i class="fas fa-edit"></i></a> -->
                                            </p>
                                            <p class="ds-title-new">
                                                Type of Shipment : <?php echo (!empty($quote_details) && $quote_details[0]['shipment_type'] == 1)?'Document':'Package'; ?>
                                                <br>
                                                Parcel Type: <?php echo (!empty($quote_from_details) && $quote_details[0]['shipment_type'] == 1)?'Domestic':'International'; ?>
                                            </p>
                                        </div>
                                        <div class="col-sm-8">
                                            &nbsp;
                                        </div>
                                        <!--++++++++++++++++++++++++++++++++++++++genarel-->
                                        <!--++++++++++++++++++++++++++++++++++++++location-->
                                        <div class="spacer"></div>
                                        <div class="col-sm-12">
                                            <p class="ds-title-new"><strong>Location:</strong>
                                                <!-- <a href="#" class="add-more"><i class="fas fa-edit"></i></a> -->
                                            </p>
                                        </div>
                                        <div class="spacer"></div>
                                        <!--++++++++++++++++++++++++++++++++++++++-->
                                        <div class="col-sm-4">
                                            <?php
                                            if (!empty($quote_from_details)) {
                                            ?>
                                                <p class="ds-title-new"><strong>From Location</strong></p>
                                                <!-- <p class="ds-title-new">Item Description: <?php echo $quote_from_details[0]['order_created']; ?></p> -->
                                                <p class="ds-title-new">Address: <?php echo $quote_from_details[0]['address']; ?></p>
                                                <p class="ds-title-new">Address2: <?php echo $quote_from_details[0]['address2']; ?></p>
                                                <p class="ds-title-new">Company: <?php echo $quote_from_details[0]['company_name']; ?></p>
                                                <p class="ds-title-new">Country: <?php echo $quote_from_details[0]['country']; ?></p>
                                                <p class="ds-title-new">City: <?php echo $quote_from_details[0]['city']; ?></p>
                                                <p class="ds-title-new">State: <?php echo $quote_from_details[0]['state']; ?></p>
                                                <p class="ds-title-new">Zip Code: <?php echo $quote_from_details[0]['zip']; ?></p>
                                                <p class="ds-title-new">Phone No: <?php echo $quote_from_details[0]['telephone']; ?></p>
                                                <p class="ds-title-new">Address Type : <?php echo ($quote_from_details[0]['address_type'] == 0) ? 'Home' : 'Business'; ?></p>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            if (!empty($quote_to_details)) {
                                            ?>
                                                <p class="ds-title-new"><strong>To Location</strong></p>
                                                <!-- <p class="ds-title-new">Item Description: <?php echo $quote_to_details[0]['order_created']; ?></p> -->
                                                <p class="ds-title-new">Address: <?php echo $quote_to_details[0]['address']; ?></p>
                                                <p class="ds-title-new">Address2: <?php echo $quote_to_details[0]['address2']; ?></p>
                                                <p class="ds-title-new">Company: <?php echo $quote_to_details[0]['company_name']; ?></p>
                                                <p class="ds-title-new">Country: <?php echo $quote_to_details[0]['country']; ?></p>
                                                <p class="ds-title-new">City: <?php echo $quote_to_details[0]['city']; ?></p>
                                                <p class="ds-title-new">State: <?php echo $quote_to_details[0]['state']; ?></p>
                                                <p class="ds-title-new">Zip Code: <?php echo $quote_to_details[0]['zip']; ?></p>
                                                <p class="ds-title-new">Phone No: <?php echo $quote_to_details[0]['telephone']; ?></p>
                                                <p class="ds-title-new">Address Type : <?php echo ($quote_to_details[0]['address_type'] == 0) ? 'Home' : 'Business'; ?></p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-sm-4">
                                            &nbsp;
                                        </div>
                                        <!--++++++++++++++++++++++++++++++++++++++location-end-->
                                        <div class="spacer"></div>
                                        <!--++++++++++++++++++++++++++++++++++++++Parcel -->
                                        <br>
                                        <div class="spacer"></div>
                                        <div class="col-sm-12">
                                            <p class="ds-title-new"><strong>Parcel Details:</strong>
                                                <!-- <a href="#" class="add-more"><i class="fas fa-edit"></i></a> -->
                                            </p>
                                        </div>
                                        <div class="spacer"></div>
                                        <!--++++++++++++++++++++++++++++++++++++++-->
                                        <?php
                                        
                                        // echo '<pre>'; print_r($quote_item_details);
                                        if (!empty($quote_item_details) && $quote_item_details[0]['type'] == 0) {
                                        ?>
                                            <div class="col-sm-4">
                                            <p class="ds-title-new"><strong>For Document</strong></p>
                                                <p class="ds-title-new">Documents in your shipment: <?php echo $quote_item_details[0]['desc']; ?></p>
                                                <p class="ds-title-new"> <?php echo $quote_item_details[0]['desc']; ?></p>
                                                <p class="ds-title-new">Category: <?php echo $quote_item_details[0]['category_name']; ?></p>
                                                <p class="ds-title-new">Value of your shipment: <?php echo $quote_item_details[0]['value_shipment']; ?> </p>
                                                <p class="ds-title-new">Quatity: <?php echo $quote_item_details[0]['quantity']; ?> </p>
                                                <p class="ds-title-new">Rate: <?php echo $quote_item_details[0]['rate']; ?> </p>
                                                <p class="ds-title-new">Insurance: <?php echo $quote_item_details[0]['insur']; ?> </p>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-sm-4">
                                                <p class="ds-title-new"><strong>For Package</strong></p>
                                                <p class="ds-title-new">Describe your shipment: <?php echo $quote_item_details[0]['desc']; ?></p>
                                                <p class="ds-title-new"> <?php echo $quote_item_details[0]['desc']; ?></p>
                                                <p class="ds-title-new">Category: <?php echo $quote_item_details[0]['category_name']; ?></p>
                                                <p class="ds-title-new">Value of your shipment: <?php echo $quote_item_details[0]['value_shipment']; ?> </p>
                                                <p class="ds-title-new">Quatity: <?php echo $quote_item_details[0]['quantity']; ?> </p>
                                                <p class="ds-title-new">Rate: <?php echo $quote_item_details[0]['rate']; ?> </p>
                                                <p class="ds-title-new">Insurance: <?php echo $quote_item_details[0]['insur']; ?> </p>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                        <div class="col-sm-4">
                                            &nbsp;
                                        </div>
                                        <!--++++++++++++++++++++++++++++++++++++++Parcel -end-->
                                        <div class="spacer"></div>
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <label class="form-check-label big">
                                                    <input type="hidden" id="quote_id_enc" name="quote_id_enc" value="<?php echo (isset($quote_id_enc)) ? $quote_id_enc : ''; ?>">
                                                    <input type="radio" class="form-check-input" name="payment_mode" value="1" checked> Pay Later
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label big">
                                                    <input type="radio" class="form-check-input" name="payment_mode" value="2">
                                                    Credit / debit /atm Card
                                                    <i class="fa  fa-credit-card fa-2x "></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label big">
                                                    <input type="radio" class="form-check-input" name="payment_mode" value="3"> Cash on Delivery
                                                    <i class="fa  fa-usd fa-2x "></i>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($quote_details) && $quote_details[0]['order_created'] == 0) {
                                ?>
                                    <input type="submit" name="submit" class="next action-button submit" value="Create Order" />
                                <?php
                                }
                                ?>

                            </fieldset>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <!--+++++++++++++++++++++++dashboard-end++++++++++++-->
            </div>
            <!--+++++++++++++++++++++++right-side==============-->
        </div>
    </div>
</section>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">List of Prohibited Items</h4>

            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php foreach ($prohibitedList as $prohibitedKey => $prohibitedValue) { ?>
                    <p><?php echo $prohibitedValue->name; ?></p>
                <?php } ?>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger action-button-Back-new" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/includes/footer'); ?>


<!--<script src="<?php //echo base_url();
                    ?>assets/frontend/js/shipment_form_val.js" type="text/javascript"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $("#msform").submit('on', function(e) {
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
                data: $('#msform').serializeArray(),
                headers: {
                    'Authkey': '<?= $this->security->get_csrf_hash(); ?>'
                },
                url: $('#msform').attr('action'),
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
                        //$('#registerF').trigger('reset');
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
    });
</script>