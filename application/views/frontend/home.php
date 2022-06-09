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
                            <h3>Start Shipment</h3>
                            <p class="red page-sub-heading">General</p>
                            <?php echo form_open(base_url('save-quote'), array('id' => 'msform', 'class' => '')); ?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong></strong></li>
                                <li id="personal"><strong></strong></li>
                                <li id="payment"><strong></strong></li>
                                <!-- <li id="confirm"><strong></strong></li> -->
                                <li id="confirmm"><strong></strong></li>
                            </ul>
                            <br> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <!-- <div class="col-5">
                                          <h2 class="steps">Step 1 - 4</h2>
                                          </div>-->
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="fieldlabels">Type of Shipment (Document or Parcel)</label>
                                             <select class="form-control" id="shipment_type" name="shipment_type">
                                                <option value="">Select Shipment Type</option>
                                                <option value="1">Document</option>
                                                <option value="2">Parcel</option>
                                             </select>
                                          </div>
                                       </div> -->
                                        <div class="col-sm-12" style="text-align: center;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="location_type" id="location_type1" value="1" checked="checked">
                                                <label class="form-check-label" for="location_type1" style="top: -5px;">Domestic</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="location_type" id="location_type2" value="2">
                                                <label class="form-check-label" for="location_type2" style="top: -5px;">International</label>
                                            </div>

                                            <!-- <input type="radio" name="location_type" id="location_type" value="1">Domestic
                                          <input type="radio" name="location_type" id="location_type" value="2">International -->
                                        </div>
                                        <!-- <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="fieldlabels">Domestic or International</label>
                                             <select class="form-control" id="domestic" name="location_type">
                                                <option value="">Select Location Type</option>
                                                <option value="1">Domestic</option>
                                                <option value="2">International</option>
                                             </select>
                                          </div>
                                       </div> -->

                                    </div>
                                </div>
                                <input type="button" id="first_step" name="next" data-next="form_1" class="next action-button" value="Next" />
                            </fieldset>
                            <!--+++++++++++++++++++++++++++++++++++++++++++1end++++++++++++++++++-->
                            <!--+++++++++++++++++++++++++++++++++++++++++++2-start++++++++++++++++++-->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <!--leftside-->
                                        <div class="col-sm-6">
                                            <h2 class="ds-title gap">From Location</h2>
                                            <input type="button" name="change_location" id="change_location" class="action-button pull-right green" value="Edit Location">
                                            <div class="spacer"></div>

                                            <label for="usr">First Name <span class="star">*</span></label>
                                            <div id="firstname111" style="display:none"></div>
                                            <input type="text" name="firstname" id="firstname" value="<?php echo $profile_details['firstname']; ?>" class="form-control  name-text is-valid firstname" placeholder="First Name" required readonly>


                                            <label for="usr">Last Name <span class="star">*</span></label>
                                            <div class="lastname_from_err" style="display:none"></div>
                                            <input type="text" name="lastname" id="lastname" value="<?php echo $profile_details['lastname']; ?>" class="form-control name-text is-valid lastname" placeholder="Last Name" required readonly>


                                            <!--<label>Address Line1</label>
                                            <input type="text" name="address" id="autocomplete" value="<?php //echo $profile_details['address'];  
                                                                                                        ?>" class="form-control name-text" placeholder="Enter location.." required readonly onfocus="geolocate()">-->

                                            <label>From Address Line1 <span class="star">*</span></label>
                                            <div class="address_from_err" style="display:none"></div>
                                            <input type="text" name="address_from" id="autocomplete" class="form-control name-text autocomplete address_from" data-loc="fromloc" placeholder="" value="<?php echo $profile_details['address']; ?>" required readonly>

                                            <input type="hidden" name="lat_from" id="lat_from" class="form-control" placeholder="" value="" required>

                                            <input type="hidden" name="lng_from" id="lng_from" class="form-control" placeholder="" value="" required>

                                            <label>Address Line 2</label>
                                            <div class="address2_from_err" style="display:none"></div>
                                            <input type="text" name="address2" id="address2" value="<?php echo $profile_details['address2']; ?>" class="form-control name-text" placeholder="Enter location.." readonly>


                                            <label> Company (Optional)</label>
                                            <input type="text" name="company_name" id="company_name" value="<?php echo $profile_details['companyname']; ?>" class="form-control name-text" placeholder="" readonly>

                                            <label>Country/Territory <span class="star">*</span></label>
                                            <div class="country_from_err" style="display:none"></div>
                                            <?php echo fillCombo_frontend('countries_master', 'id', 'name', $profile_details['country'], 'status = 1', 'id', 'form-control form-control-new', 'country', 'country', ''); ?>


                                            <label>State <span class="star">*</span></label>
                                            <div class="state_from_err" style="display:none"></div>
                                            <?php echo fillCombo_frontend('states_master', 'id', 'name', $profile_details['state'], 'country_id=' . $profile_details['country'], 'id', 'form-control form-control-new', 'state', 'state', ''); ?>
                                            <input type="hidden" name="state_google_val" id="state_google_val" value="">


                                            <label>City <span class="star">*</span></label>
                                            <div class="city_from_err" style="display:none"></div>
                                            <?php echo fillCombo_frontend('cities_master', 'id', 'name', $profile_details['city'], 'state_id=' . $profile_details['state'], 'id', 'form-control form-control-new', 'city', 'city', ''); ?>
                                            <input type="hidden" name="city_google_val" id="city_google_val" value="">


                                            <label style=" display:block; clear:both;">Zip code <span class="star">*</span></label>
                                            <div class="zip_from_err" style="display:none"></div>
                                            <div id="div_zip" style="float:left;"></div>
                                            <div class="zip_popup" style="display: none;  float:left;" data-zip=""><a class="getintouch-pop" href="javascript:void(0);" style="color:#016c1c!important;" data-zip-type="zip"> &nbsp; Click here</a> to get in touch!</div>
                                            <input type="text" name="zip" id="zip" value="<?php echo $profile_details['zip']; ?>" class="form-control name-text" placeholder="LE14" readonly>
                                            <div id="LoadingImage1" style="display:none;">
                                                <img src="<?= base_url('uploads/profile_img/') ?>loading-buffering.gif" height="30" width="30" />
                                            </div>



                                            <label>Email Address
                                                <!-- <span class="star">*</span> -->
                                            </label>
                                            <!-- <div class="email_from_err" style="display:none"></div> -->
                                            <input type="email" name="email" id="email" value="<?php echo $profile_details['email']; ?>" class="form-control name-text" placeholder="abc@gmail.com" required readonly>


                                            <label>Phone no <span class="star">*</span></label>
                                            <div class="telephone_from_err" style="display:none"></div>
                                            <input type="tel" name="telephone" id="telephone" value="<?php echo $profile_details['telephone']; ?>" class="form-control name-text " placeholder="99 9999 9999" required readonly>


                                            <div class="col-sm-12">
                                                <label>Address Type <span class="star">*</span></label>
                                                <div class="spacer"></div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="user_type" id="inlineRadio1" value="NU" <?php echo (($profile_details['user_type'] == '0') ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="inlineRadio1">Home Address</label>
                                                </div>
                                                <div class="address_type_from_err" style="display:none"></div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="user_type" id="inlineRadio2" value="BU" <?php echo (($profile_details['user_type'] == '1') ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="inlineRadio2">Business Address</label>
                                                </div>
                                                <div class="address_type_from_err" style="display:none"></div>
                                            </div>

                                        </div>
                                        <!--leftside-end-->
                                        <!--rightside-->
                                        <div class="col-sm-6">
                                            <!--+++++++++++++++++++++++++++++++++++++++++++++++++form++++++-->
                                            <h2 class="ds-title gap"> To Location</h2>
                                            <!--<input type="checkbox" name="copy_from" id="copy_from" class="form-check-input">
                                 <label class="form-check-label" for="copy_from">Copy From Address</label>-->
                                            <div class="spacer"></div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="usr">First Name <span class="star">*</span></label>
                                                    <div class="firstname_to_err" style="display:none"></div>
                                                    <input type="text" name="firstname_to" id="firstname_to" class="form-control second_step_cls name-text is-valid" placeholder="">

                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="usr">Last Name <span class="star">*</span></label>
                                                    <div class="lastname_to_err" style="display:none"></div>
                                                    <input type="text" name="lastname_to" id="lastname_to" class="form-control second_step_cls name-text is-valid" placeholder="" required>

                                                </div>

                                                <div class="col-sm-12">
                                                    <label>To Address Line1 <span class="star">*</span></label>
                                                    <div class="address_to_err" style="display:none"></div>
                                                    <input type="text" name="address_to" id="autocomplete2" class="form-control second_step_cls name-text autocomplete" data-loc="toloc" placeholder="" required>

                                                    <input type="hidden" name="lat_to" id="lat_to" class="form-control" placeholder="" value="" required>

                                                    <input type="hidden" name="lng_to" id="lng_to" class="form-control" placeholder="" value="" required>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label>Address Line 2 </label>
                                                    <div class="address2_to_err" style="display:none"></div>
                                                    <input type="text" name="address2_to" id="address2_to" class="form-control name-text second_step_cls" placeholder="">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label> Company (Optional)</label>
                                                    <input type="text" name="company_name_to" id="company_name_to" class="form-control name-text" placeholder="">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Country/Territory <span class="star">*</span></label>
                                                    <?php echo fillCombo_frontend('countries_master', 'id', 'name', '', 'status = 1', 'id', 'form-control form-control-new', 'country_to', 'country_to'); ?>
                                                    <div class="country_to_err" style="display:none"></div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="col-sm-12">
                                                    <label>State <span class="star">*</span></label>
                                                    <div class="state_to_err" style="display:none"></div>
                                                    <select name="state_to" id="state_to" class="form-control form-control-new"></select>
                                                    <input type="hidden" name="state_to_google_val" id="state_to_google_val" value="">
                                                    <?php //echo fillCombo_frontend('states_master', 'id', 'name', '','', 'id', 'form-control form-control-new', 'state_to', 'state_to'); 
                                                    ?>

                                                </div>
                                                <div class="spacer"></div>
                                                <div class="col-sm-12">
                                                    <label>City <span class="star">*</span></label>
                                                    <div class="city_to_err" style="display:none"></div>
                                                    <select name="city_to" id="city_to" class="form-control form-control-new"></select>
                                                    <input type="hidden" name="city_to_google_val" id="city_to_google_val" value="">
                                                    <?php //echo fillCombo_frontend('cities_master', 'id', 'name', '', '', 'id', 'form-control form-control-new', 'city_to', 'city_to'); 
                                                    ?>

                                                </div>
                                                <div class="spacer"></div>
                                                <div class="col-sm-12">
                                                    <label style=" display:block; clear:both;">Zip code <span class="star">*</span></label>
                                                    <div class="zip_to_err" style="display:none"></div>
                                                    <div id="div_zip_to" style="float:left;"></div>
                                                    <div class="zip_to_popup" style="display: none; float:left;" data-zip-to=""><a class="getintouch-pop" href="javascript:void(0);" style="color:#016c1c!important;" data-zip-type="zip_to"> &nbsp; Click here</a> to get in touch!</div>
                                                    <input type="text" name="zip_to" id="zip_to" class="form-control info-text second_step_cls" placeholder="">
                                                    <div id="LoadingImage" style="display:none;">
                                                        <img src="<?= base_url('uploads/profile_img/') ?>loading-buffering.gif" height="30" width="30" />
                                                    </div>


                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Email Address 
                                                        <!-- <span class="star">*</span> -->
                                                    </label>
                                                    <!-- <div class="email_to_err" style="display:none"></div> -->
                                                    <input type="email" name="email_to" id="email_to" class="form-control name-text second_step_cls" placeholder="" required>

                                                </div>
                                                <div class="col-sm-9">
                                                    <label>Phone no <span class="star">*</span></label>
                                                    <div class="telephone_to_err" style="display:none"></div>
                                                    <input type="number" name="telephone_to[]" id="telephone_to" class="form-control name-text second_step_cls" placeholder="" required>

                                                </div>

                                                <div class="col-sm-3">
                                                    <input type="button" name="add_more_tel_btn" id="add_more_tel_btn" class="action-button add" value="Add More" style="border: 1px solid rgb(206, 212, 218);background-color: #ff0000 !important;color: #fff;font-size: 12px!important;font-family: 'Open Sans', sans-serif!important;height: 46px;">
                                                </div>

                                                <div id="add_more_tel"></div>

                                                <div class="col-sm-12">
                                                    <label>Address Type <span class="star">*</span></label>
                                                    <div class="spacer"></div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="address_type" id="inlineRadio1_to" value="0">
                                                        <label class="form-check-label" for="inlineRadio1_to">Home Address</label>
                                                    </div>
                                                    <div class="address_type_err" style="display:none"></div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="address_type" id="inlineRadio2_to" value="1">
                                                        <label class="form-check-label" for="inlineRadio2_to">Business Address</label>
                                                        <div class="address_type_err" style="display:none"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--+++++++++++++++++++++++++++++++++++++++++++++++++form++++++-->
                                        </div>
                                    </div>
                                    <!--rightside-end-->
                                </div>
                                <input type="button" id="second_step" name="next" class="next action-button" value="next" data-next="change_location" />
                                <input type="button" name="Back" class="Back action-button-Back" data-back="change_location" value="Back" />
                            </fieldset>
                            <!--+++++++++++++++++++++++++++++++++++++++++++2-end++++++++++++++++++-->
                            <!--+++++++++++++++++++++++++++++++++++++++++++3-start++++++++++++++++++-->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-5">
                                            <!-- Button to Open the Modal -->
                                            <button type="button" style=" position: absolute; z-index: 999; right: 1px;" class="Modal-st" data-toggle="modal" data-target="#myModal">
                                                List of Prohibited Items
                                            </button>
                                        </div>
                                    </div>
                                    <div class="spacer"></div>
                                    <div class="col-sm-12">
                                        <p>Do you have the all details of the item ? </p>

                                        <div style="padding-left: 15px;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input details_have" type="radio" name="details_have" id="details_have1" value="1" checked="checked">
                                                <label class="form-check-label" for="details_have1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input details_have" type="radio" name="details_have" id="details_have2" value="2">
                                                <label class="form-check-label" for="details_have2">No</label>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="spacer"></div>
                                    <div id="details_of_pack">
                                        <div class="spacer"></div>
                                        <div style=" padding-left: 30px;">
                                            <!--++++++++++++++++++++++++++top-toggle-redio+++++++-->
                                            <div class="form-check form-check-inline document_option" id="document_option">
                                                <input class="form-check-input" type="hidden" name="doc_pack_count" id="doc_pack_count" value="0">
                                                <input class="form-check-input shipment_type_option" type="radio" name="shipment_type_option" id="shipment_type_option" value="1" checked>
                                                <label class="form-check-label" for="inlineRadio1">For Document</label>
                                            </div>
                                            <div class="form-check form-check-inline" id="package_option">
                                                <input class="form-check-input shipment_type_option" type="radio" name="shipment_type_option" id="shipment_type_option" value="2">
                                                <label class="form-check-label" for="inlineRadio2">For Package</label>
                                            </div>
                                            <!--++++++++++++++++++++++++++top-toggle-redio-end+++++++-->

                                        </div>

                                        <div class="spacer"></div>
                                        <!--+++++++++++++++++++++++++++++++for-documents-->
                                        <div id="show-me">
                                            <div class="new-background">
                                                <div class="document-wrap" id="document_wrap">
                                                    <!-- <h2 class="ds-title gap" style=" margin-bottom: 30px; margin-top: -15px;">Documents in your shipment.</h2> -->
                                                    <div class="spacer"></div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <?php
                                                            $cond = array(
                                                                'type' => '1',
                                                                'parent_cat_id' => 0
                                                            );
                                                            echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', '', $cond, 'cat_id', 'form-control form-control-new', 'document_category[]', 'document_category'); ?>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <select class="form-control form-control-new" id="document_sub_cat" name="document_sub_cat[]">
                                                                <option value="">Selet Category First</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <select class="form-control form-control-new" id="document_item" name="document_item[]">
                                                                <option value="">Selet Category First</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <select class="form-control form-control-new">
                                                        <option>Select Document type</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12"></div>
                                             </div> -->
                                                    <div class="row" id="document_other_row" style="display:none;">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" id="document_other" name="document_other[]" type="radio" value="1">
                                                                <label class="form-check-label" for="document_other">Other Category</label>
                                                                </input>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <textarea class="form-control" id="other_details_document" name="other_details_document[]" rows="2"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 no-gap">
                                                        <h3 class="titelt">Value of your shipment</h3>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group ">
                                                            <div class="input-group">
                                                                <div class="input-group-addon no-back">
                                                                    <i class="fa fa fa-usd"></i>
                                                                </div>
                                                                <input class="form-control value_of_shipment" id="value_of_shipment_document" name="value_of_shipment_document[]" type="number" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" id="protect_shipment_document" name="protect_shipment_document[]">
                                                            <label class="form-check-label" for="protect_shipment_document" style="top: 0px!important;">
                                                                Protect your shipment
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--=====================-->
                                                <div class="spacer"></div>


                                                <!--- New Modifications Starts --->

                                                <!--- New Modifications Ends --->



                                                <div class="spacer"></div>
                                                <div class="gra-line"></div>
                                                <div class="spacer"></div>
                                                <div id="add_document_div"></div>
                                                <div class="col-sm-6">&nbsp;</div>
                                                <div class="row" id="document_charges_row" style="display:none;">
                                                    <div class="col-md-4 col-sm-12">
                                                        <h2 class="ds-title gap" style=" margin-bottom: 30px; ">
                                                            Your Charges
                                                        </h2>
                                                    </div>
                                                    <div class="col-md-8 col-sm-12">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="road_document" name="charges_by" type="radio" value="1">
                                                                        <input type="hidden" name="road_document_input" id="road_document_input" value="">
                                                                        <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Road: <span id="road_document_span"></span></label>
                                                                        </input>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="rail_document" name="charges_by" type="radio" value="2">
                                                                        <input type="hidden" name="rail_document_input" id="rail_document_input" value="">
                                                                        <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Rail: <span id="rail_document_span"></span></label>
                                                                        </input>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="air_document" name="charges_by" type="radio" value="3">
                                                                        <input type="hidden" name="air_document_input" id="air_document_input" value="">
                                                                        <label class="form-check-label" for="air_document" style="top: 0px!important;">By Air: <span id="air_document_span"></span></label>
                                                                        </input>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="ship_document" name="charges_by" type="radio" value="4">
                                                                        <input type="hidden" name="ship_document_input" id="ship_document_input" value="">
                                                                        <label class="form-check-label" for="ship_document" style="top: 0px!important;">By Sea: <span id="ship_document_span"></span></label>
                                                                        </input>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <!--<a href="javascript:void(0);" class="btn btn-success btn-add-more" id="add_more_doc">Add More</a>-->
                                                        <button type="button" class="btn btn-success" onclick="addBtn()"> Add More</button>
                                                    </div>
                                                </div>
                                                <!--=============-->
                                            </div>
                                        </div>
                                        <!--+++++++++++++++++++++++++++++++for-documents-->
                                        <!--+++++++++++++++++++++++++++++++For Package-->
                                        <div id="show-me-three" style="display:none;">
                                            <div class="new-background">
                                                <div class="shipment-wrap">
                                                    <!--left-->
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <?php
                                                            $cond = array(
                                                                'type' => '2',
                                                                'parent_cat_id' => 0
                                                            );

                                                            echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', '', $cond, 'cat_id', 'form-control form-control-new', 'package_category[]', 'package_category'); ?>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <select class="form-control form-control-new" id="package_sub_cat" name="package_sub_cat[]">
                                                                <option value="">Selet Category First</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <select class="form-control form-control-new" id="package_item" name="package_item[]">
                                                                <option value="">Selet Category First</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row">
                                                  <div class="col-md-6 col-sm-12">
                                                      <select class="form-control form-control-new">
                                                          <option>Select Document type</option>
                                                      </select>
                                                  </div>
                                                  <div class="col-md-6 col-sm-12"></div>
                                              </div> -->
                                                    <div class="row" id="parcel_other_row" style="display:none;">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" id="parcel_other" name="parcel_other[]" type="radio" value="2">
                                                                <label class="form-check-label" for="parcel_other">Other Category</label>
                                                                </input>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <textarea class="form-control" id="other_details_parcel" name="other_details_parcel[]" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 no-gap-left">
                                                        <label for="">Describe your shipment.</label>
                                                        <textarea class="form-control" id="shipment_description_parcel" name="shipment_description_parcel[]" aria-label="With textarea"></textarea>
                                                        <div class="spacer"></div>
                                                        <label for="">Value of your shipment</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon no-back">
                                                                    <i class="fa fa fa-usd"></i>
                                                                </div>
                                                                <input class="form-control value_of_shipment" id="value_of_shipment_parcel" name="value_of_shipment_parcel[]" type="number" value="0" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--left-end-->
                                                    <!--right-->
                                                    <div class="col-sm-6">
                                                        <label>Reference</label>
                                                        <input class="form-control" type="text" id="referance_parcel" name="referance_parcel[]" placeholder="Reference">
                                                        <div class="spacer" style="height: 64px;"></div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="protect_parcel[]" id="protect_parcel" value="2">
                                                            <label class="form-check-label" for="protect_parcel" style="top: 0px!important;">
                                                                Protect your shipment
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!--right-end-->
                                                    <div class="spacer"></div>
                                                    <div class="col-sm-6 no-gap-left" style="margin-top: -23px;">
                                                        <label>Quantity</label>
                                                        <input class="form-control quantity number" type="text" id="quantity" name="quantity[]" placeholder="Quantity" value="0">
                                                    </div>

                                                    <div class="col-sm-6">
                                                        &nbsp;
                                                    </div>
                                                    <div class="spacer"></div>

                                                    <!--+++++++++++++++++++++++++++--------+++++++++++++-->
                                                    <!--+++++++++++++++++++++++++++sec+++++++++++++-->
                                                    <!--+++++++++++++++++++++++++++--------+++++++++++++-->
                                                    <div class="spacer"></div>
                                                    <div class="col-sm-12 no-gap">
                                                        <div class="spacer"></div>
                                                        <div class="gra-line"></div>
                                                        <div class="spacer"></div>

                                                        <h3 class="titelt">Dimension</h3>
                                                        <!--+++++++++++++++++++++-->
                                                        <!--+++++++++++++++++++++-->
                                                        <div class="col-sm-6 no-gap-left">
                                                            <div class="spacer"></div>
                                                            <!-- <label for="">Packaging type</label>
                                                            <select class="form-control" id="">
                                                                <option>type 1</option>
                                                                <option>type 2</option>
                                                                <option>type 3</option>
                                                                <option>type 4</option>
                                                                <option>type 5</option>
                                                            </select> -->

                                                            <label for="length">Length</label>
                                                            <div class="form-group">
                                                                <div class="col-sm-9 no-gap">
                                                                    <input class="form-control" type="text" id="length" name="length[]" placeholder="Length" value="0">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="length_dimen" name="length_dimen[]">
                                                                        <option value="cm">cm</option>
                                                                        <!-- <option value="inc">inc</option> -->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="spacer"></div>
                                                            <label for="height">Height</label>
                                                            <div class="form-group">
                                                                <div class="col-sm-9 no-gap">
                                                                    <input class="form-control" type="text" id="height" name="height[]" placeholder="Height" value="0">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="height_dimen" name="height_dimen[]">
                                                                        <option value="cm">cm</option>
                                                                        <!-- <option value="inc">inc</option> -->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="spacer"></div>

                                                        </div>
                                                        <!--+++++++++++++++++++++-->
                                                        <!--+++++++++++++++++++++-->
                                                        <div class="col-sm-6">
                                                            <div class="spacer"></div>
                                                            <label for="weight">Breadth</label>
                                                            <div class="form-group">
                                                                <div class="col-sm-9 no-gap">
                                                                    <input class="form-control" type="text" id="breadth" name="breadth[]" placeholder="Breadth" value="0">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="breadth_dimen" name="breadth_dimen[]">
                                                                        <option value="cm">cm</option>
                                                                        <!-- <option value="inc">inc</option> -->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="spacer"></div>
                                                            <label for="weight">Weight</label>
                                                            <div class="form-group">
                                                                <div class="col-sm-9 no-gap">
                                                                    <input class="form-control" type="text" id="weight" name="weight[]" placeholder="Weight" value="0">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="weight_dimen" name="weight_dimen[]">
                                                                        <option value="kg">kg</option>
                                                                        <option value="pound">pound</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--+++++++++++++++++++++-->
                                                        <!--+++++++++++++++++++++-->
                                                    </div>
                                                    <!--+++++++++++++++++++++++++++--------+++++++++++++-->
                                                    <!--+++++++++++++++++++++++++++sec+++++++++++++-->
                                                    <!--+++++++++++++++++++++++++++--------+++++++++++++-->
                                                </div>

                                                <!--<div class="spacer"></div>
                                <div class="col-sm-12"><a href="#" class="btn-add-more">+ Add More</a> </div>
                                <div class="spacer"></div>
                                <div class="gra-line"></div>-->

                                                <div class="spacer"></div>
                                                <div class="col-sm-6">&nbsp;</div>
                                                <div class="row" id="parcel_charges_row" style="display:none;">
                                                    <div class="col-md-4 col-sm-12">
                                                        <h2 class="ds-title gap" style=" margin-bottom: 30px; ">Your Charges</h2>
                                                    </div>
                                                    <div class="col-md-8 col-sm-12">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="road_parcel" name="charges_parcel" type="radio" value="1">
                                                                        <input type="hidden" name="road_parcel_input" id="road_parcel_input" value="">
                                                                        <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Road: <span id="road_parcel_span"></span></label>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="rail_parcel" name="charges_parcel" type="radio" value="2">
                                                                        <input type="hidden" name="rail_parcel_input" id="rail_parcel_input" value="">
                                                                        <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Rail: <span id="rail_parcel_span"></span></label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="air_parcel" name="charges_parcel" type="radio" value="3">
                                                                        <input type="hidden" name="air_parcel_input" id="air_parcel_input" value="">
                                                                        <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Air: <span id="air_parcel_span"></span></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input rate_checkbox" id="ship_parcel" name="charges_parcel" type="radio" value="4">
                                                                        <input type="hidden" name="ship_parcel_input" id="ship_parcel_input" value="">
                                                                        <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Sea: <span id="ship_parcel_span"></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!--- New Modifications Starts --->
                                                <div class="spacer"></div>
                                                <!-- <div class="col-sm-12">
                                                <button type="button" class="btn btn-success" onclick="addBtn()"> Add More </button>
                                            </div> -->
                                                <!-- <div class="spacer"></div>
                                            <div class="gra-line"></div>
                                            <div class="spacer"></div> -->
                                                <!--- New Modifications Ends --->

                                            </div>

                                            <!--=============-->
                                        </div>
                                        <!--+++++++++++++++++++++++++++++++For Package-->
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-success" onclick="addBtn()"> Add More </button>
                                        </div>
                                    </div>

                                    <div class="spacer"></div>
                                    <p></p>

                                    <div class="div-add-more"></div>



                                </div>

                                <div class="row" id="add-more-div" style="display:none;">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-success" onclick="addBtn()"> Add More </button>
                                    </div>
                                    <div class="spacer"></div>
                                </div>


                                <div class="row" id="final_charges_row" style="display:none;">


                                    <div class="col-md-12 col-sm-12">
                                        <h2 class="ds-title gap" style=" margin-bottom: 30px; ">
                                            Your Charges (Excluding Insurance)
                                        </h2>
                                    </div>


                                    <div class="col-md-6 col-sm-12">
                                        <h3 class="titelt">Speed Rate: </h3>
                                        <div class="spacer"></div>
                                        <select class="form-control form-control-new delivery_speed" id="delivery_speed" name="delivery_speed">
                                            <?php
                                            if (!empty($deliveryModeList)) {
                                                foreach ($deliveryModeList as $key => $value) {
                                            ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        &nbsp;
                                    </div>

                                    <div class="spacer"></div>

                                    <div class="col-md-12 col-sm-12">

                                        <div class="container">

                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input get_final_rate_checkbox" id="road_radio" name="charges_final" type="radio" value="1">
                                                        <input type="hidden" name="road_input" id="road_input" value="">
                                                        <label class="form-check-label" for="road_radio" style="top: -7px!important;">By Road: <span id="road_span"></span></label>
                                                        </input>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input get_final_rate_checkbox" id="rail_dadio" name="charges_final" type="radio" value="2">
                                                        <input type="hidden" name="rail_input" id="rail_input" value="">
                                                        <label class="form-check-label" for="rail_dadio" style="top: -7px!important;">By Rail: <span id="rail_span"></span></label>
                                                        </input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4" style="display: none;">
                                                    <div class="form-check">
                                                        <input class="form-check-input get_final_rate_checkbox" id="air_radio" name="charges_final" type="radio" value="3">
                                                        <input type="hidden" name="air_input" id="air_input" value="">
                                                        <label class="form-check-label" for="air_radio" style="top: -7px!important;">By Air: <span id="air_span"></span></label>
                                                        </input>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input get_final_rate_checkbox" id="ship_radio" name="charges_final" type="radio" value="4">
                                                        <input type="hidden" name="ship_input" id="ship_input" value="">
                                                        <label class="form-check-label" for="ship_radio" style="top: -7px!important;">By Sea: <span id="ship_span"></span></label>
                                                        </input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <input type="hidden" name="charges_sum" id="charges_sum" value="0">
                                <input type="hidden" id="quote_type" name="quote_type" value="0">
                                <input type="hidden" name="rate_factor" id="rate_factor" value="<?php echo $rateFactor; ?>">
                                <!-- <input type="button" name="next" data-next="form_3" class="next action-button" value="next" /> -->
                                <div class="quote-div">
                                    <input type="button" name="next" data-next="form_4" class="action-button  create-order" value="Place Order" />
                                    <input type="submit" name="add_quote" class="action-button" value="Get Quote" />
                                </div>

                                <div class="quote-req-div" style="display: none;">
                                    <input type="button" name="next" class=" action-button quote-req" value="Quote Request" />
                                </div>
                                <!-- <input type="button" name="skip" class="next action-button edit2" value="Skip" /> -->
                                <input type="button" name="Back" class="Back action-button-Back" data-back="form_4" value="Back" />
                            </fieldset>
                            <!--+++++++++++++++++++++++++++++++++++++++++++3-end++++++++++++++++++-->
                            <!--+++++++++++++++++++++++++++++++++++++++++++4-start++++++++++++++++++-->

                            <!--+++++++++++++++++++++++++++++++++++++++++++4-end++++++++++++++++++-->


                            <fieldset style="display: none;">
                                <div class="form-card">

                                </div>
                                <!-- <input type="button" name="next" data-next="form_4" class="next action-button submit create-order" value="Create Order" /> -->
                                <input type="button" name="Back" class="Back action-button-Back" value="Back" />
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
                <div class="theme_tabs">
                    <ul class="nav nav-tabs " role="tablist">
                        <li role="presentation"><a href="#tab1" class="active" role="tab" data-toggle="tab">Document</a></li>
                        <li role="presentation"><a href="#tab2" class="" role="tab" data-toggle="tab">Package</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <?php foreach ($prohibited_document as $prohibitedKey => $prohibitedValue) { ?>
                                <p><?php echo $prohibitedValue['name']; ?></p>
                            <?php } ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <?php foreach ($prohibited_parcel as $prohibitedKey => $prohibitedValue) { ?>
                                <p><?php echo $prohibitedValue['name']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>







            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger action-button-Back-new" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="getInTouch">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Get In Touch</h4>

            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="form-get-in-touch" action="<?php echo base_url('send-get-in-touch'); ?>">
                    <div class="form-group">
                        <input type="hidden" name="zip_code" id="zip_code" class="form-control">
                        <textarea name="comment" id="comment" class="form-control" placeholder="Comment*" required="required"></textarea>
                    </div>
                    <span class="modal-msg"></span>
                    <button type="button" class="btn btn-default action-button-Back-new getintouch-submit">Send</button>
                </form>
                <div class="spacer"></div>
            </div>
            <div class="modal-footer">
                <p>For more information about our branches <a href="<?php echo base_url(); ?>branch-list" target="_blank">click here</a>.</p>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/includes/footer'); ?>


<!--<script src="<?php //echo base_url();
                    ?>assets/frontend/js/shipment_form_val.js" type="text/javascript"></script>-->

<!--<script id="script1"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- <script src="<?php echo base_url(); ?>assets/frontend/js/home.js" type="text/javascript"></script> -->
<script>
    $(document).ready(function() {

        $('[name=ids]').val('100');

        var doc_pack_count = $('#doc_pack_count').val();
        // eraseCookie('docpackcount');
        // setCookie('docpackcount', doc_pack_count, '1');
        // //console.log('ss' + doc_pack_count + getCookie('docpackcount'));

        var gotonext = 0;
        var current_fs, next_fs, Back_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);
        $(".next").click(function() {


            /*** Form validation starts ***/
            var nextbtnval = $(this).attr("data-next");
            if (nextbtnval == 'change_location') {

                $(".page-sub-heading").html('Item Details');

                var firstname = $("input[name=firstname]").val();
                var lastname = $("input[name=lastname]").val();
                var address_from = $("input[name=address_from]").val();
                var address2 = $("input[name=address2]").val();
                var country = $("input[name=country]").val();
                var state = $("input[name=state]").val();
                var city = $("input[name=city]").val();
                var zip = $("input[name=zip]").val();
                var email = $("input[name=email]").val();
                var telephone = $("input[name=telephone]").val();
                var zip_from = $(".zip_popup").attr("data-zip");

                //alert(firstname);
                if (firstname == '') {
                    //$("#firstname").css('outline', '1px solid red');
                    $("#firstname111").html('<font color="red">Please enter your first name.</font>');
                    $("#firstname111").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    //$("#firstname").css('outline', '#ccc');
                    $("#firstname111").html('');
                    $("#firstname111").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (lastname == '') {
                    //$(".lastname").css('outline', '1px solid red');
                    $(".lastname_from_err").html('<font color="red">Please enter your last name.</font>');
                    $(".lastname_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    //$(".lastname").css('outline', '#ccc');
                    $(".lastname_from_err").html('');
                    $(".lastname_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (address_from == '') {
                    //$(".address_from").css('outline', '1px solid red');
                    $(".address_from_err").html('<font color="red">Please enter your address.</font>');
                    $(".address_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    //$(".address_from").css('outline', '#ccc');
                    $(".address_from_err").html('');
                    $(".address_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                // if (address2 == '') {
                //     $(".address2").css('outline', '1px solid red');
                //     $(".address2_from_err").html('<font color="red">Please enter your address.</font>');
                //     $(".address2_from_err").show();
                //     //$('#second_step').prop('disabled', true);
                // } else {
                //     $(".address2").css('outline', '#ccc');
                //     $(".address2_from_err").html('');
                //     $(".fname_from_err").hide();
                //     //$('#second_step').prop('disabled', false);
                // }

                if (country == '') {
                    $("#country").css('outline', '1px solid red');
                    $(".country_from_err").html('<font color="red">Please enter your country.</font>');
                    $(".country_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".country_from_err").html('');
                    $(".country_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (state == '') {
                    $(".state_from_err").html('<font color="red">Please enter your state.</font>');
                    $(".state_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".state_from_err").html('');
                    $(".state_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (city == '') {
                    $(".city_from_err").html('<font color="red">Please enter your city.</font>');
                    $(".city_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".city_from_err").html('');
                    $(".city_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (zip == '' && country!='195') {
                    $(".zip_from_err").html('<font color="red">Please enter your zip.</font>');
                    $(".zip_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".zip_from_err").html('');
                    $(".zip_from_err").hide();
                }

                // if (email == '') {
                //     $(".email_from_err").html('<font color="red">Please enter your email.</font>');
                //     $(".email_from_err").show();
                //     //$('#second_step').prop('disabled', true);
                // } else {
                //     $(".email_from_err").html('');
                //     $(".email_from_err").hide();
                //     //$('#second_step').prop('disabled', false);
                // }

                if (telephone == '') {
                    $(".telephone_from_err").html('<font color="red">Please enter your phone number.</font>');
                    $(".telephone_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".telephone_from_err").html('');
                    $(".telephone_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                // if (zip_from == '') {
                //     $(".zip_popup").hide();
                // } else {
                //     $(".zip_popup").show();
                // }

                var firstname_to = $("input[name=firstname_to]").val();
                var lastname_to = $("input[name=lastname_to]").val();
                var address_to = $("input[name=address_to]").val();
                var address2_to = $("input[name=address2_to]").val();
                var zip_to = $("input[name=zip_to]").val();
                var email_to = $("input[name=email_to]").val();
                var telephone_to = $("#telephone_to").val();
                var country_to = $('#country_to').find(":selected").val();
                var state_to = $('#state_to').find(":selected").val();
                var city_to = $('#city_to').find(":selected").val();
                var zip_to_val = $(".zip_to_popup").attr("data-zip-to");
                var user_type = $('input[name="user_type"]:checked').val();
                var address_type = $('input[name="address_type"]:checked').val();

                if (firstname_to == '') {
                    $(".firstname_to_err").html('<font color="red">Please enter your first name.</font>');
                    $(".firstname_to_err").show();
                } else {
                    $(".firstname_to_err").html('');
                    $(".firstname_to_err").hide();
                }

                if (lastname_to == '') {
                    $(".lastname_to_err").html('<font color="red">Please enter your last name.</font>');
                    $(".lastname_to_err").show();
                } else {
                    $(".lastname_to_err").html('');
                    $(".lastname_to_err").hide();
                }

                if (address_to == '') {
                    $(".address_to_err").html('<font color="red">Please enter your address.</font>');
                    $(".address_to_err").show();
                } else {
                    $(".address_to_err").html('');
                    $(".address_to_err").hide();
                }

                // if (address2_to == '') {
                //     $(".address2_to_err").html('<font color="red">Please enter your address.</font>');
                //     $(".address2_to_err").show();
                // } else {
                //     $(".address2_to_err").html('');
                //     $(".address2_to_err").hide();
                // }

                if (zip_to == '' && country_to!='195') {
                    $(".zip_to_err").html('<font color="red">Please enter your zip.</font>');
                    $(".zip_to_err").show();
                } else {
                    $(".zip_to_err").html('');
                    $(".zip_to_err").hide();
                }

                // if (email_to == '') {
                //     $(".email_to_err").html('<font color="red">Please enter your email.</font>');
                //     $(".email_to_err").show();
                // } else {
                //     if (validateEmail(email_to)) {
                //         $(".email_to_err").html('');
                //         $(".email_to_err").hide();
                //     } else {
                //         $(".email_to_err").html('<font color="red">Please enter valid email.</font>');
                //         $(".email_to_err").show();
                //     }

                // }

                if (telephone_to == '') {
                    $(".telephone_to_err").html('<font color="red">Please enter your phone number.</font>');
                    $(".telephone_to_err").show();
                } else {
                    $(".telephone_to_err").html('');
                    $(".telephone_to_err").hide();
                }

                if (country_to == '') {
                    $(".country_to_err").html('<font color="red">Please enter your country.</font>');
                    $(".country_to_err").show();
                } else {
                    $(".country_to_err").html('');
                    $(".country_to_err").hide();
                }

                if (state_to == '') {
                    $(".state_to_err").html('<font color="red">Please enter your state.</font>');
                    $(".state_to_err").show();
                } else {
                    $(".state_to_err").html('');
                    $(".state_to_err").hide();
                }

                if (city_to == '') {
                    $(".city_to_err").html('<font color="red">Please enter your city.</font>');
                    $(".city_to_err").show();
                } else {
                    $(".city_to_err").html('');
                    $(".city_to_err").hide();
                }

                if (user_type == undefined) {
                    $(".address_type_from_err").html('<font color="red">Please enter from address type.</font>');
                    $(".address_type_from_err").show();
                } else {
                    $(".address_type_from_err").html('');
                    $(".address_type_from_err").hide();
                }

                if (address_type == undefined) {
                    $(".address_type_err").html('<font color="red">Please enter to address type.</font>');
                    $(".address_type_err").show();
                } else {
                    $(".address_type_err").html('');
                    $(".address_type_err").hide();
                }

                // if (zip_to_val == '') {
                //     $(".zip_to_popup").hide();
                // } else {
                //     $(".zip_to_popup").show();
                // }

                if (firstname != '' && lastname != '' && address_from != '' && country != '' && state != '' && city != '' && zip != '' && telephone != '' && firstname_to != '' && lastname_to != '' && address_to != '' &&  telephone_to != '' && country_to != '' && state_to != '' && city_to != '' &&  user_type != undefined && address_type != undefined) {
                    gotonext = 1;
                    //$('#second_step').prop('disabled', false);
                } else {
                    gotonext = 2;
                    //$('#second_step').prop('disabled', true);
                }

            } else if (nextbtnval == 'form_1') {

                $(".page-sub-heading").html('Location');
                gotonext = 1;
            } else if (nextbtnval == 'form_3') {

                $(".page-sub-heading").html('Sub');
                gotonext = 1;
            }


            if (gotonext == 1) {

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                //show the next fieldset
                next_fs.show();

            } else {

                // current_fs = $(this).parent();
                // next_fs = $(this).parent().next();
                // $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                // next_fs.show();

            }

            /*** Form validation Ends ***/


            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': ''
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);

            $('html, body').animate({
                scrollTop: $(".navbar").offset().top
            }, 200);
        });

        $(".Back").click(function() {
            //change sub heading
            var backbtnval = $(this).attr("data-back");

            if (backbtnval == 'change_location') {
                $(".page-sub-heading").html('General');
            } else if (backbtnval == 'form_4') {
                $(".page-sub-heading").html('Location');
            }

            current_fs = $(this).parent();
            Back_fs = $(this).parent().prev();
            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            //show the Back fieldset
            Back_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': ''
                    });
                    Back_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);

            $('html, body').animate({
                scrollTop: $(".navbar").offset().top
            }, 200);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar").css("width", percent + "%")
        }
        $(".submit").click(function() {
            return false;
        });

        $('#country').on('change', function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'csrftoken': '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    url: '<?php echo base_url('getStates'); ?>',
                    data: 'country_id=' + countryID,
                    success: function(data) {
                        $('#state').html('<option value="">Select State</option>');
                        var dataObj = jQuery.parseJSON(data);
                        if (dataObj) {
                            $(dataObj).each(function() {
                                var option = $('<option />');
                                option.attr('value', this.id).text(this.name);
                                $('#state').append(option);
                            });
                            var state_google_val = $('#state_google_val').val();
                            if (state_google_val != '') {
                                $("#state option:contains(" + state_google_val + ")").attr("selected", true);
                                $("#state").trigger('change');
                            }
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

        $('#state').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'csrftoken': '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    url: '<?php echo base_url('getCity'); ?>',
                    data: 'state_id=' + stateID,
                    success: function(data) {
                        $('#city').html('<option value="">Select City</option>');
                        var dataObj = jQuery.parseJSON(data);
                        if (dataObj) {
                            $(dataObj).each(function() {
                                var option = $('<option />');
                                option.attr('value', this.id).text(this.name);
                                $('#city').append(option);
                            });
                            var city_google_val = $('#city_google_val').val();
                            if (city_google_val != '') {
                                $("#city option:contains(" + city_google_val + ")").attr("selected", true);
                                $("#city").trigger('change');
                            }
                        } else {
                            $('#city').html('<option value="">State not available</option>');
                        }
                    }
                });
            } else {
                $('#city').html('<option value="">Select State first</option>');
            }
        });

        $('#country_to').on('change', function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'csrftoken': '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    url: '<?php echo base_url('getStates'); ?>',
                    data: 'country_id=' + countryID,
                    success: function(data) {
                        $('#state_to').html('<option value="">Select State</option>');
                        var dataObj = jQuery.parseJSON(data);
                        if (dataObj) {
                            $(dataObj).each(function() {
                                var option = $('<option />');
                                option.attr('value', this.id).text(this.name);
                                $('#state_to').append(option);
                            });
                            var state_to_google_val = $('#state_to_google_val').val();
                            if (state_to_google_val != '') {
                                $("#state_to option:contains(" + state_to_google_val + ")").attr("selected", true);
                                $("#state_to").trigger('change');

                            }
                        } else {
                            $('#state_to').html('<option value="">State not available</option>');
                        }
                    }
                });
            } else {
                $('#state_to').html('<option value="">Select Country first</option>');
                $('#city_to').html('<option value="">Select State first</option>');
            }
        });

        $('#state_to').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'csrftoken': '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    url: '<?php echo base_url('getCity'); ?>',
                    data: 'state_id=' + stateID,
                    success: function(data) {
                        $('#city_to').html('<option value="">Select City</option>');
                        var dataObj = jQuery.parseJSON(data);
                        if (dataObj) {
                            $(dataObj).each(function() {
                                var option = $('<option />');
                                option.attr('value', this.id).text(this.name);
                                $('#city_to').append(option);
                            });

                            var city_to_google_val = $('#city_to_google_val').val();
                            if (city_to_google_val != '') {
                                $("#city_to option:contains(" + city_to_google_val + ")").attr("selected", true);
                                $("#city_to").trigger('change');
                            }
                        } else {
                            $('#city_to').html('<option value="">State not available</option>');
                        }
                    }
                });
            } else {
                $('#city_to').html('<option value="">Select State first</option>');
            }
        });

        $('#document_category').on('change', function() {

            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var categoryID = $(this).val();
            var ship_sub_subcat_id = $('#document_sub_cat').val();

            if (categoryID) {
                $.ajax({
                    dataType: "json",
                    type: "post",
                    url: '<?php echo base_url('getDocumentCategory'); ?>',
                    data: {
                        [csrfName]: csrfHash,
                        category_id: categoryID,
                        ship_sub_subcat_id: ship_sub_subcat_id
                    },
                    success: function(data) {
                        $('#document_item').html('<option value="">Select Item</option>');
                        var string1 = JSON.stringify(data.items);
                        var dataObj = JSON.parse(string1);
                        var resultKeyCount = Object.keys(dataObj).length;

                        var string2 = JSON.stringify(data.subcat);
                        var dataObj2 = JSON.parse(string2);
                        var resultKeyCount2 = Object.keys(dataObj2).length;

                        if (resultKeyCount > 0) {
                            $(dataObj).each(function() {
                                var option = $('<option />');
                                option.attr('value', this.document_id).text(this.name);
                                $('#document_item').append(option);
                            });
                            $('#document_item').append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#document_item').html('<option value="">Items not available</option>');
                        }


                        $('#document_sub_cat').html('<option value="">Select Subcategory</option>');
                        if (resultKeyCount2 > 0) {
                            $(dataObj2).each(function() {
                                var option2 = $('<option />');
                                option2.attr('value', this.cat_id).text(this.category_name);
                                $('#document_sub_cat').append(option2);
                            });
                            $('#document_sub_cat').append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#document_sub_cat').html('<option value="">Subcategory not available</option>');
                        }
                    }
                });
            } else {
                $('#document_item').html('<option value="">Select Category first</option>');
                $('#document_sub_cat').html('<option value="">Select Category first</option>');
            }
        });

        $('#package_category').on('change', function() {
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var categoryID = $(this).val();
            var ship_sub_subcat_id = $('#document_sub_cat').val();

            if (categoryID) {
                $.ajax({
                    dataType: "json",
                    type: "post",
                    url: '<?php echo base_url('getPackageCategory'); ?>',
                    data: {
                        [csrfName]: csrfHash,
                        category_id: categoryID,
                        ship_sub_subcat_id: ship_sub_subcat_id
                    },
                    success: function(data) {
                        $('#package_item').html('<option value="">Select Item</option>');
                        var string1 = JSON.stringify(data.items);
                        var dataObj = JSON.parse(string1);
                        var resultKeyCount = Object.keys(dataObj).length;
                        if (resultKeyCount > 0) {
                            $(dataObj).each(function() {
                                var option = $('<option />');
                                option.attr('value', this.package_id).text(this.name);
                                $('#package_item').append(option);
                            });
                            $('#package_item').append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#package_item').html('<option value="">Items not available</option>');
                        }

                        var string2 = JSON.stringify(data.subcat);
                        var dataObj2 = JSON.parse(string2);
                        var resultKeyCount2 = Object.keys(dataObj2).length;

                        $('#package_sub_cat').html('<option value="">Select Subcategory</option>');
                        if (resultKeyCount2 > 0) {
                            $(dataObj2).each(function() {
                                var option2 = $('<option />');
                                option2.attr('value', this.cat_id).text(this.category_name);
                                $('#package_sub_cat').append(option2);
                            });
                            $('#package_sub_cat').append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#package_sub_cat').html('<option value="">Subcategory not available</option>');
                        }
                    }
                });
            } else {
                $('#package_item').html('<option value="">Select Category first</option>');
            }
        });


        $('#document_item').on('change', function() {
            var document_item_val = $(this).val();
            if (document_item_val < 1) {
                $('#document_other').prop('checked', true);
                $('#document_other_row').slideDown(500);
                //$('#document_charges_row').slideUp(500);
                $('#final_charges_row').slideUp(500);
            } else {
                $('#document_other').prop('checked', false);
                $('#document_other_row').slideUp(500);
                //$('#document_charges_row').slideDown(500);
                $('#final_charges_row').slideDown(500);
            }
        });

        $('#package_item').on('change', function() {
            var document_item_val = $(this).val();
            if (document_item_val < 1) {
                $('#parcel_other').prop('checked', true);
                $('#parcel_other_row').slideDown(500);
                //$('#parcel_charges_row').slideUp(500);
                $('#final_charges_row').slideUp(500);
            } else {
                $('#parcel_other').prop('checked', false);
                $('#parcel_other_row').slideUp(500);
                //$('#parcel_charges_row').slideDown(500);
                $('#final_charges_row').slideDown(500);
            }
        });

        $(document).on('change', '.get_document_item', function() {
            var newid1 = $(this).attr('data-newid-di');
            var document_item_val = $(this).val();
            if (document_item_val < 1) {
                $('#document_other' + newid1).prop('checked', true);
                $('#document_other_row' + newid1).slideDown(500);
                //$('#document_charges_row' + newid1).slideUp(500);
            } else {
                $('#document_other' + newid1).prop('checked', false);
                $('#document_other_row' + newid1).slideUp(500);
                //$('#document_charges_row' + newid1).slideDown(500);
            }
        });

        $(document).on('change', '.get_package_item', function() {
            var newid1 = $(this).attr('data-newid-pi');
            var document_item_val = $(this).val();
            if (document_item_val < 1) {
                $('#parcel_other' + newid1).prop('checked', true);
                $('#parcel_other_row' + newid1).slideDown(500);
                //$('#parcel_charges_row' + newid1).slideUp(500);
            } else {
                $('#parcel_other' + newid1).prop('checked', false);
                $('#parcel_other_row' + newid1).slideUp(500);
                //$('#parcel_charges_row' + newid1).slideDown(500);
            }
        });


        $('#add_more_tel_btn').click(function() {
            // var html_old = '<div><div class="col-sm-9"> <label>Phone no </label> <input type="tel" name="telephone_to[]" id="telephone_to" class="form-control name-text" placeholder="" required></div><div class="col-sm-3"><input type="button" name="remove_tel_btn" id="remove_tel_btn" class="remove_tel_btn action-button add" value="Remove" ></div></div>';

            var html = '<div><div class="col-sm-9"><label>Phone no </label><input type="number" name="telephone_to[]" id="telephone_to" class="form-control name-text" placeholder="" required=""></div><div class="col-sm-3"><input type="button" name="remove_tel_btn" id="remove_tel_btn" class="remove_tel_btn action-button add" value="Remove" style="border: 1px solid rgb(206, 212, 218);background-color: #ff0000 !important;color: #fff;font-size: 12px!important;font-family:Open Sans!important;height: 46px;"></div>';
            $('#add_more_tel').append(html);
        });

        $('#copy_from').click(function() {
            if ($('input[name="copy_from"]').is(':checked')) {
                $('#firstname_to').val($('#firstname').val());
                $('#lastname_to').val($('#lastname').val());
                $('#address_to').val($('#autocomplete').val());
                $('#address2_to').val($('#address2').val());
                $('#company_name_to').val($('#company_name').val());
                $('#zip_to').val($('#zip').val());
                $('#email_to').val($('#email').val());
                $('#telephone_to').val($('#telephone').val());
                //$('#company_name_to').val($('#company_name').val());

                var country = $('#country option:selected').val();
                if (country != "") {
                    $('#country_to option[value="' + country + '"]').prop('selected', true);
                }

                var state = $('#state option:selected').val();
                if (state != "") {
                    $('#state_to option[value="' + state + '"]').prop('selected', true);
                }

                var city = $('#city option:selected').val();
                if (city != "") {
                    $('#city_to option[value="' + city + '"]').prop('selected', true);
                }

            } else {
                $('#firstname_to').val("");
                $('#lastname_to').val("");
                $('#address_to').val("");
                $('#address2_to').val("");
                $('#company_name_to').val("");
                $('#zip_to').val("");
                $('#email_to').val("");
                $('#telephone_to').val("");
                $('#country_to option:eq(0)').prop('selected', true);
                $('#state_to option:eq(0)').prop('selected', true);
                $('#city_to option:eq(0)').prop('selected', true);
            };
        });

        $('#change_location').on('click', function() {
            //alert('OK');
            $('#firstname').attr('readonly', false);
            $('#lastname').attr('readonly', false);
            $('#autocomplete').attr("readonly", false);
            $('#address2').attr("readonly", false);
            $('#company_name').attr("readonly", false);
            $('#zip').attr("readonly", false);
            $('#country').prop('disabled', false);
            $('#state').prop('disabled', false);
            $('#city').prop('disabled', false);

            /* $('#firstname_to').prop('readonly', false);
            $('#lastname_to').prop('readonly', false);
            $('#address_to').prop('readonly', false);
            $('#address2_to').prop('readonly', false);
            $('#company_name_to').prop('readonly', false);
            $('#country_to').prop('disabled', false);
            $('#state_to').prop('disabled', false);
            $('#city_to').prop('disabled', false);
            $('#zip_to').prop('readonly', false); */
        });

        $('.details_have').on('change', function() {
            var val = $(this).val();
            if (val == '1') {
                $('#details_of_pack').slideDown(500);
                $('.quote-req-div').hide();
                $('#final_charges_row').hide();
                $('.quote-div').show();
                $('#msform').attr('action', '<?php echo base_url('save-quote'); ?>');
            } else {
                $('#details_of_pack').slideUp(500);
                $('.quote-div').hide();
                $('.quote-req-div').show();
                $('#final_charges_row').hide();
                $('#msform').attr('action', '<?php echo base_url('save_quote_request'); ?>');
            }
        });

        $('.create-order').on('click', function() {
            $('#quote_type').val("1");
            toastr.remove();
            var charges_sum = $('#charges_sum').val();
            if (charges_sum > 0) {
                $('#msform').submit();
            } else {
                toastr.error('<span style="color:#fff;">Rate not found! Please choose the right combination or contact your nearest branch</span>');
            }


        });

        $('.quote-req').on('click', function() {
            $('#quote_type').val("2");
            $('#msform').submit();
        });

    });

    $(document).on('click', '.remove_tel_btn', function() {
        $(this).parent().parent().remove();
    });

    $(document).on('change', '#shipment_type', function() {

        if ($(this).val() == 1) {
            $('.document_option').show();
            $('#package_option').hide();
            $("[name='shipment_type_option'][value='1']").prop('checked', true);
            $("#show-me:hidden").show('slow');
            $("#show-me-two").hide();
            $("#show-me-three").hide();

        } else if ($(this).val() == 2) {
            $('#package_option').show();
            $('.document_option').hide();
            $("[name='shipment_type_option'][value='2']").prop('checked', true);
            $("#show-me-three:hidden").show('slow');
            $("#show-me").hide();
            $("#show-me-two").hide();
        }
    });

    $(document).on('change', '.rate_checkbox', function() {
        if ($(this).val() > 0) {
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var ship_cat_id = $('input[name="shipment_type_option"]:checked').val();
            var rate_doc_per = $('.rate_checkbox:checked').attr('name');

            if (rate_doc_per == 'charges_by') {
                var ship_subcat_id = $('#document_category').val();
                var ship_sub_subcat_id = $('#document_sub_cat').val();
            } else if (rate_doc_per == 'charges_parcel') {
                var ship_subcat_id = $('#package_category').val();
                var ship_sub_subcat_id = $('#package_sub_cat').val();
            } else {
                var ship_subcat_id = '0';
                var ship_sub_subcat_id = '0';
            }


            var charges_mode = $('.rate_checkbox:checked').val();


            var rate_type = 'L';
            var location_from = $('#state').val();
            var location_to = $('#state_to').val();

            //console.log(charges_mode);

            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getShipmentChanges'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    ship_cat_id: ship_cat_id,
                    ship_subcat_id: ship_subcat_id,
                    ship_sub_subcat_id: ship_sub_subcat_id,
                    rate_type: rate_type,
                    location_from: location_from,
                    location_to: location_to,
                    charges_mode: charges_mode
                },
                success: function(data) {
                    var string1 = JSON.stringify(data.rates);
                    var dataObj = JSON.parse(string1);
                    var resultKeyCount = Object.keys(dataObj).length;

                    if (resultKeyCount > 0) {
                        $(dataObj).each(function() {
                            if (ship_cat_id == 1) {
                                if (this.ship_mode_id == 1) {
                                    $('#road_document_input').val(this.rate);
                                    $('#road_document_span').text(this.rate);

                                    $('#air_document_input').val('');
                                    $('#air_document_span').text('');
                                    $('#ship_document_input').val('');
                                    $('#ship_document_span').text('');
                                    $('#rail_document_input').val('');
                                    $('#rail_document_span').text('');
                                } else if (this.ship_mode_id == 2) {
                                    $('#rail_document_input').val(this.rate);
                                    $('#rail_document_span').text(this.rate);


                                    $('#road_document_input').val('');
                                    $('#road_document_span').text('');
                                    $('#air_document_input').val('');
                                    $('#air_document_span').text('');
                                    $('#ship_document_input').val('');
                                    $('#ship_document_span').text('');
                                } else if (this.ship_mode_id == 3) {
                                    $('#air_document_input').val(his.rate);
                                    $('#air_document_span').text(this.rate);

                                    $('#road_document_input').val('');
                                    $('#road_document_span').text('');
                                    $('#rail_document_input').val('');
                                    $('#rail_document_span').text('');
                                    $('#ship_document_input').val('');
                                    $('#ship_document_span').text('');
                                } else if (this.ship_mode_id == 4) {
                                    $('#air_document_input').val(his.rate);
                                    $('#air_document_span').text(this.rate);

                                    $('#road_document_input').val('');
                                    $('#road_document_span').text('');
                                    $('#rail_document_input').val('');
                                    $('#rail_document_span').text('');
                                    $('#ship_document_input').val('');
                                    $('#ship_document_span').text('');
                                } else {
                                    $('#road_document_input').val('');
                                    $('#road_document_span').text('');
                                    $('#rail_document_input').val('');
                                    $('#rail_document_span').text('');
                                    $('#air_document_input').val('');
                                    $('#air_document_span').text('');
                                    $('#ship_document_input').val('');
                                    $('#ship_document_span').text('');
                                }
                            } else {
                                if (this.ship_mode_id == 1) {
                                    $('#road_parcel_input').val(this.rate);
                                    $('#road_parcel_span').text(this.rate);

                                    $('#rail_parcel_input').val('');
                                    $('#rail_parcel_span').text('');
                                    $('#air_parcel_input').val('');
                                    $('#air_parcel_span').text('');
                                    $('#ship_parcel_input').val('');
                                    $('#ship_parcel_span').text('');
                                } else if (this.ship_mode_id == 2) {
                                    $('#rail_parcel_input').val(this.rate);
                                    $('#rail_parcel_span').text(this.rate);

                                    $('#road_parcel_input').val('');
                                    $('#road_parcel_span').text('');
                                    $('#air_parcel_input').val('');
                                    $('#air_parcel_span').text('');
                                    $('#ship_parcel_input').val('');
                                    $('#ship_parcel_span').text('');
                                } else if (this.ship_mode_id == 3) {
                                    $('#air_parcel_input').val(this.rate);
                                    $('#air_parcel_span').text(this.rate);

                                    $('#road_parcel_input').val('');
                                    $('#road_parcel_span').text('');
                                    $('#rail_parcel_input').val('');
                                    $('#rail_parcel_span').text('');
                                    $('#ship_parcel_input').val('');
                                    $('#ship_parcel_span').text('');
                                } else if (this.ship_mode_id == 4) {
                                    $('#ship_parcel_input').val(this.rate);
                                    $('#ship_parcel_span').text(this.rate);

                                    $('#road_parcel_input').val('');
                                    $('#road_parcel_span').text('');
                                    $('#air_parcel_input').val('');
                                    $('#air_parcel_span').text('');
                                    $('#rail_parcel_input').val('');
                                    $('#rail_parcel_span').text('');
                                } else {
                                    $('#road_parcel_input').val('');
                                    $('#road_parcel_span').text('');
                                    $('#air_parcel_input').val('');
                                    $('#air_parcel_span').text('');
                                    $('#rail_parcel_input').val('');
                                    $('#rail_parcel_span').text('');
                                    $('#ship_parcel_input').val('');
                                    $('#ship_parcel_span').text('');
                                }
                            }
                        });
                    } else {

                        if (ship_cat_id == 1) {
                            $('#road_document_input').val('');
                            $('#road_document_span').text('');
                            $('#rail_document_input').val('');
                            $('#rail_document_span').text('');
                            $('#air_document_input').val('');
                            $('#air_document_span').text('');
                            $('#ship_document_input').val('');
                            $('#ship_document_span').text('');
                        } else {
                            $('#road_parcel_input').val('');
                            $('#road_parcel_span').text('');
                            $('#air_parcel_input').val('');
                            $('#air_parcel_span').text('');
                            $('#rail_parcel_input').val('');
                            $('#rail_parcel_span').text('');
                            $('#ship_parcel_input').val('');
                            $('#ship_parcel_span').text('');
                        }
                    }


                }
            });
        } else {

        }
    });

    $('.submit').click(function() {
        $(':required:invalid', '#form1').each(function() {
            var id = $('.tab-pane').find(':required:invalid').closest('.tab-pane').attr('id');
            $(this).css('border', '1px solid red');
            $(this).focus();
            $('.nav a[href="#' + id + '"]').tab('show');
        });
    });

    $(document).on('blur', 'input', function() {
        var is_val = $(this).val();
        if (is_val != '') {
            $(this).css('border', '1px solid #ced4da');
        }
    })

    $(document).on('change', 'select', function() {
        var is_val = $(this).val();
        if (is_val != '') {
            $(this).css('border', '1px solid #ced4da');
        }
    })

    $("#msform").submit('on', function(e) {
        e.preventDefault();
        $("#element_overlapT").LoadingOverlay("show");
        toastr.remove()

        var quote_type = $('#quote_type').val();
        var charges_sum = $('#charges_sum').val();

        if (quote_type == 2 || charges_sum > 0) {
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
        } else {
            toastr.error('<span style="color:#fff;">Rate not found! Please choose the right combination or contact your nearest branch</span>');
        }




    });



    //**Modifications by MK Sah Starts**//
    function randString(length) {
        var text = "";
        var possible = "0123456789";
        for (var i = 0; i < length; i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return text;
    }

    //console.log(newID);

    function addBtn() {

        $('#rail_span').text('');
        // $('#road_input').val('');
        $('#road_span').text('');
        // $('#air_input').val('');
        $('#air_span').text('');
        // $('#ship_input').val('');
        $('#ship_span').text('');

        var newID = randString(4);

        var html = '';
        html += '<div id=\'' + newID + '\' class="odd_even"><div class="spacer"></div>';

        html += '<div style=" padding-left: 30px;"><div class="form-check form-check-inline document_option' + getCookie('docpackcount') + '" id="document_option' + newID + '">';

        html += '<input class="form-check-input new-ids" type="hidden" name="ids[]" value="' + newID + '" >';

        html += '<input class="form-check-input get_shipment_type_option" type="radio" name="shipment_type_option_' + newID + '" id="shipment_type_option_m_' + newID + '" data-newid="' + newID + '" value="1" checked>';

        html += '<label class="form-check-label" for="inlineRadio1">For Document</label></div>';

        html += '<div class="form-check form-check-inline" id="package_option' + newID + '">';

        html += '<input class="form-check-input get_shipment_type_option" type="radio" name="shipment_type_option_' + newID + '" id="shipment_type_option_m_' + newID + '" data-newid="' + newID + '" value="2">';

        html += '<label class="form-check-label" for="inlineRadio2">For Package</label></div></div>';


        html += '<div class="spacer"></div><div class="new-background"><div id="show_me_document_' + newID + '" class="show_me_document"><div class="document-wrap" id="document_wrap"><div class="spacer"></div><div class="row"><div class="col-md-6 col-sm-12">';

        html += '<?php $cond = array('type' => '1', 'parent_cat_id' => 0);
                    echo fillCombo_frontend("document_package_categories", "cat_id", "category_name", "", $cond, "cat_id", "form-control form-control-new get_document_category", "document_category[]", "document_category_'+newID+'", "", "data-newid3", "'+newID+'"); ?>';

        html += ' </div><div class="col-md-6 col-sm-12"><select class="form-control form-control-new" id="document_sub_cat' + newID + '" name="document_sub_cat[]" data-subcatid="' + newID + '"><option value="">Selet Category First</option></select><select class="form-control form-control-new get_document_item" id="document_item' + newID + '" name="document_item[]" data-newid-di="' + newID + '"><option value="">Selet Category First</option></select></div></div>  <div class="row" id="document_other_row' + newID + '" style="display:none;"><div class="col-md-6 col-sm-12"><div class="form-check form-check-inline"><input class="form-check-input" id="document_other' + newID + '" name="document_other[]" type="radio" value="1"><label class="form-check-label" for="document_other">Other Category</label></input></div></div><div class="col-md-6 col-sm-12"><textarea class="form-control" id="other_details_document' + newID + '" name="other_details_document[]" rows="2"></textarea></div></div><div class="col-sm-12"><h3 class="titelt">Value of your shipment</h3></div><div class="col-sm-6"><div class="form-group "><div class="input-group"><div class="input-group-addon no-back"><i class="fa fa fa-usd"></i></div><input class="form-control value_of_shipment" id="value_of_shipment_document' + newID + '" name="value_of_shipment_document[]" type="number" /></div></div></div><div class="col-sm-6"><div class="form-check"><input class="form-check-input" type="checkbox" value="1" id="protect_shipment_document' + newID + '" name="protect_shipment_document' + newID + '"><label class="form-check-label" for="protect_shipment_document' + newID + '" style="top: 0px!important;">Protect your shipment</label></div></div></div> <div class="spacer"></div><div class="col-sm-12"></div><div class="spacer"></div><div class="gra-line"></div><div class="spacer"></div><div id="add_document_div' + newID + '"></div><div class="col-sm-6">&nbsp;</div><div class="row" id="document_charges_row' + newID + '" style="display:none;"><div class="col-md-4 col-sm-12"><h2 class="ds-title gap" style=" margin-bottom: 30px; ">Your Charges</h2></div><div class="col-md-8 col-sm-12"><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="road_document' + newID + '" name="charges_by_' + newID + '" type="radio" value="1" data-newid-rc = "' + newID + '"><input type="hidden" name="road_document_input_' + newID + '" id="road_document_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Road: <span id="road_document_span' + newID + '"></span></label></input></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="rail_document' + newID + '" name="charges_by_' + newID + '" type="radio" value="2" data-newid-rc = "' + newID + '"><input type="hidden" name="rail_document_input_' + newID + '" id="rail_document_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Rail: <span id="rail_document_span' + newID + '"></span></label></input></div></div></div></div><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="air_document' + newID + '" name="charges_by_' + newID + '" type="radio" value="3"  data-newid-rc = "' + newID + '"><input type="hidden" name="air_document_input_' + newID + '" id="air_document_input' + newID + '" value=""><label class="form-check-label" for="air_document" style="top: 0px!important;">By Air: <span id="air_document_span' + newID + '"></span></label></input></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="ship_document" name="charges_by_' + newID + '" type="radio" value="4" data-newid-rc = "' + newID + '"><input type="hidden" name="ship_document_input_' + newID + '" id="ship_document_input' + newID + '" value=""><label class="form-check-label" for="ship_document" style="top: 0px!important;">By Sea: <span id="ship_document_span"></span></label></input></div></div></div></div></div></div></div>';

        html += '<div id="show_me_package_' + newID + '" style="display:none;" class="show_me_package"><div class="shipment-wrap"><div class="row"><div class="col-md-6 col-sm-12">';

        html += '<?php $cond = array('type' => '2', 'parent_cat_id' => 0);
                    echo fillCombo_frontend("document_package_categories", "cat_id", "category_name", "", $cond, "cat_id", "form-control form-control-new get_package_category", "package_category[]", "package_category_'+newID+'", "", "data-newid4", "'+newID+'"); ?>';

        html += '</div><div class="col-md-6 col-sm-12"><select class="form-control form-control-new" id="package_sub_cat' + newID + '" name="package_sub_cat[]"><option value="">Selet Category First</option></select></div><div class="col-md-6 col-sm-12"><select class="form-control form-control-new get_package_item" id="package_item' + newID + '" name="package_item[]" data-newid-pi="' + newID + '"><option value="">Selet Category First</option></select></div></div> <div class="row" id="parcel_other_row' + newID + '" style="display:none;"><div class="col-md-6 col-sm-12"><div class="form-check form-check-inline"><input class="form-check-input" id="parcel_other' + newID + '" name="parcel_other_' + newID + '[]" type="radio" value="2"><label class="form-check-label" for="parcel_other">Other Category</label></input></div></div><div class="col-md-6 col-sm-12"><textarea class="form-control" id="other_details_parcel' + newID + '" name="other_details_parcel[]" rows="2"></textarea></div></div><div class="col-sm-6 no-gap"><label for="">Describe your shipment.</label><textarea class="form-control" id="shipment_description_parcel' + newID + '" name="shipment_description_parcel[]" aria-label="With textarea"></textarea><div class="spacer"></div><label for="">Value of your shipment</label><div class="form-group"><div class="input-group"><div class="input-group-addon no-back"><i class="fa fa fa-usd"></i></div><input class="form-control value_of_shipment" id="value_of_shipment_parcel" name="value_of_shipment_parcel[]" type="number" /></div></div></div><div class="col-sm-6"><label>Reference</label><input class="form-control" type="text" id="referance_parcel' + newID + '" name="referance_parcel[]" placeholder="Referance"><div class="spacer" style="height: 64px;"></div><div class="form-check"><input class="form-check-input" type="checkbox" name="protect_parcel' + newID + '" id="protect_parcel' + newID + '" value="2"><label class="form-check-label" for="protect_parcel' + newID + '" style="top: 0px!important;">Protect your shipment</label></div></div><div class="spacer"></div><div class="col-sm-6 no-gap-left" style="margin-top: -23px;"><label>Quantity</label><input class="form-control quantity number" type="text" id="quantity' + newID + '" name="quantity[]" placeholder="Quantity" value="0"></div><div class="col-sm-6">&nbsp;</div><div class="spacer"></div><div class="spacer"></div><div class="col-sm-12 no-gap"><div class="spacer"></div><div class="gra-line"></div><div class="spacer"></div><h3 class="titelt">Dimension</h3><div class="spacer"></div> <div class="col-sm-6 no-gap-left"><div class="spacer"></div><label for="length">Length</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="length' + newID + '" name="length[]" placeholder="Length" value="0"></div><div class="col-sm-3 no-gap-left"><select class="form-control" id="length_dimen' + newID + '" name="length_dimen[]"><option value="cm">cm</option><!-- <option value="inc">inc</option> --></select></div></div><div class="spacer"></div><label for="height">Height</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="height' + newID + '" name="height[]" placeholder="Height" value="0"></div><div class="col-sm-3 no-gap-left"><select class="form-control" id="height_dimen" name="height_dimen[]"><option value="cm">cm</option><!-- <option value="inc">inc</option> --></select></div></div><div class="spacer"></div></div><div class="col-sm-6"><div class="spacer"></div><label for="weight">Breadth</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="breadth' + newID + '" name="breadth[]" placeholder="Breadth" value="0"></div><div class="col-sm-3 no-gap-left"><select class="form-control" id="breadth_dimen' + newID + '" name="breadth_dimen[]"><option value="cm">cm</option><!-- <option value="inc">inc</option> --></select></div></div><div class="spacer"></div><label for="weight">Weight</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="weight' + newID + '" name="weight[]" placeholder="Weight" value="0"></div><div class="col-sm-3 no-gap-left"><select class="form-control" id="weight_dimen' + newID + '" name="weight_dimen[]"><option value="pound">pound</option><option value="kg">kg</option></select></div></div><div class="spacer"></div></div></div></div><div class="spacer"></div><div class="col-sm-12"> </div><div class="spacer"></div><div class="col-sm-6">&nbsp;</div><div class="row" id="parcel_charges_row' + newID + '" style="display:none;"><div class="col-md-4 col-sm-12"><h2 class="ds-title gap" style=" margin-bottom: 30px; ">Your Charges</h2></div><div class="col-md-8 col-sm-12"><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="charges_parcel' + newID + '" name="charges_parcel' + newID + '" type="radio" value="1" data-newid-rc = "' + newID + '"><input type="hidden" name="road_parcel_input_' + newID + '" id="road_parcel_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Road: <span id="road_parcel_span' + newID + '"></span></label></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="rail_parcel' + newID + '" name="charges_parcel' + newID + '" type="radio" value="2" data-newid-rc = "' + newID + '"><input type="hidden" name="rail_parcel_input_' + newID + '" id="rail_parcel_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Rail: <span id="rail_parcel_span' + newID + '"></span></label></div></div></div></div><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="air_parcel' + newID + '" name="charges_parcel' + newID + '" type="radio" value="3" data-newid-rc = "' + newID + '"><input type="hidden" name="air_parcel_input_' + newID + '" id="air_parcel_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Air: <span id="air_parcel_span' + newID + '"></span></label></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="ship_parcel' + newID + '" name="charges_parcel' + newID + '" type="radio" value="4" data-newid-rc = "' + newID + '"><input type="hidden" name="ship_parcel_input_' + newID + '" id="ship_parcel_input_' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Sea: <span id="ship_parcel_span' + newID + '' + newID + '"></span></label></div></div></div></div></div></div></div><div class="spacer"></div><button type="button" class="btn btn-success" onclick="addBtn()" > Add More </button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick="removeBtn(\'' + newID + '\')" > Remove </button></div>';

        // html += '<div class="col-sm-12"><button type="button" class="btn btn-success" onclick="addBtn()" > Add More </button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick="removeBtn(\'' + newID + '\')" > Remove </button></div></div>';

        $(".div-add-more").append(html);
        $('html, body').animate({
            scrollTop: $("#" + newID).offset().top
        }, 200);
    }

    function removeBtn(newID) {

        $('#rail_span').text('');
        // $('#road_input').val('');
        $('#road_span').text('');
        // $('#air_input').val('');
        $('#air_span').text('');
        // $('#ship_input').val('');
        $('#ship_span').text('');

        $("#" + newID).remove();
    }

    //var newID = randString(4);

    $(document).on('change', '.shipment_type_option', function() {
        // console.log(newID_2);

        // console.log($(this).val());
        if ($(this).val() == 1) {
            $('#show-me-three').hide();
            $('#show-me').show('slow');

        } else if ($(this).val() == 2) {

            //$('#show_me_document_'+newID_2).css({'display':'block'});
            $('#show-me').hide();
            $('#show-me-three').show('slow');
        }
    });

    $(document).on('change', '.get_shipment_type_option', function() {
        //var newID_2 = $(this).attr('id');
        var newID_2 = $(this).attr('data-newid');
        // console.log(newID_2);

        // console.log($(this).val());
        if ($(this).val() == 1) {
            $('#show_me_package_' + newID_2).hide();
            $('#show_me_document_' + newID_2).show('slow');

        } else if ($(this).val() == 2) {

            //$('#show_me_document_'+newID_2).css({'display':'block'});
            $('#show_me_document_' + newID_2).hide();
            $('#show_me_package_' + newID_2).show('slow');
        }
    });


    $(document).on('change', '.get_document_category', function() {

        var newid_3 = $(this).attr('data-newid3');
        var newid_4 = $(this).attr('data-subcatid');
        //console.log('newid_3:'+newid_3);

        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var categoryID = $(this).val();
        var ship_sub_subcat_id = $('#document_sub_cat').val();

        if (categoryID) {
            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getDocumentCategory'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    category_id: categoryID,
                    ship_sub_subcat_id: ship_sub_subcat_id
                },
                success: function(data) {
                    $('#document_item' + newid_3).html('<option value="">Select Item</option>');
                    var string1 = JSON.stringify(data.items);
                    var dataObj = JSON.parse(string1);
                    var resultKeyCount = Object.keys(dataObj).length;

                    if (resultKeyCount > 0) {
                        $(dataObj).each(function() {
                            var option = $('<option />');
                            option.attr('value', this.document_id).text(this.name);
                            $('#document_item' + newid_3).append(option);
                        });
                        $('#document_item' + newid_3).append($("<option></option>").attr("value", '0').text('Other'));
                    } else {
                        $('#document_item' + newid_3).html('<option value="">Items not available</option>');
                    }

                    var string2 = JSON.stringify(data.subcat);
                    var dataObj2 = JSON.parse(string2);
                    var resultKeyCount2 = Object.keys(dataObj2).length;

                    $('#document_sub_cat' + newid_3).html('<option value="">Select Subcategory</option>');
                    if (resultKeyCount2 > 0) {
                        $(dataObj2).each(function() {
                            var option2 = $('<option />');
                            option2.attr('value', this.cat_id).text(this.category_name);
                            $('#document_sub_cat' + newid_3).append(option2);
                        });
                        $('#document_sub_cat' + newid_3).append($("<option></option>").attr("value", '0').text('Other'));
                    } else {
                        $('#document_sub_cat' + newid_3).html('<option value="">Subcategory not available</option>');
                    }
                }
            });
        } else {
            $('#document_item' + newid_3).html('<option value="">Select Category first</option>');
            $('#document_sub_cat' + newid_4).html('<option value="">Select Category first</option>');
        }
    });

    $(document).on('change', '.get_package_category', function() {
        var newid4 = $(this).attr('data-newid4');

        //console.log('newid_3:' + newid4);
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var categoryID = $(this).val();
        var ship_sub_subcat_id = $('#document_sub_cat' + newid4).val();

        if (categoryID) {
            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getPackageCategory'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    category_id: categoryID,
                    ship_sub_subcat_id: ship_sub_subcat_id
                },
                success: function(data) {
                    $('#package_item' + newid4).html('<option value="">Select Item</option>');
                    var string1 = JSON.stringify(data.items);
                    var dataObj = JSON.parse(string1);
                    var resultKeyCount = Object.keys(dataObj).length;
                    if (resultKeyCount > 0) {
                        $(dataObj).each(function() {
                            var option = $('<option />');
                            option.attr('value', this.package_id).text(this.name);
                            $('#package_item' + newid4).append(option);
                        });
                        $('#package_item' + newid4).append($("<option></option>").attr("value", '0').text('Other'));
                    } else {
                        $('#package_item' + newid4).html('<option value="">Items not available</option>');
                    }

                    var string2 = JSON.stringify(data.subcat);
                    var dataObj2 = JSON.parse(string2);
                    var resultKeyCount2 = Object.keys(dataObj2).length;

                    $('#package_sub_cat' + newid4).html('<option value="">Select Subcategory</option>');
                    if (resultKeyCount2 > 0) {
                        $(dataObj2).each(function() {
                            var option2 = $('<option />');
                            option2.attr('value', this.cat_id).text(this.category_name);
                            $('#package_sub_cat' + newid4).append(option2);
                        });
                        $('#package_sub_cat' + newid4).append($("<option></option>").attr("value", '0').text('Other'));
                    } else {
                        $('#package_sub_cat' + newid4).html('<option value="">Subcategory not available</option>');
                    }
                }
            });
        } else {
            $('#package_item' + newid4).html('<option value="">Select Category first</option>');
        }
    });

    $(document).on('change', '.quantity', function() {
        finalRateCheckbox();
    });

    $(document).on('change', '.delivery_speed', function() {
        finalRateCheckbox();
    });

    $(document).on('change', '.get_final_rate_checkbox', function() {
        finalRateCheckbox();
    });

    function finalRateCheckbox() {

        //var newidsArr = $("input[name='ids[]']").map(function() {return $(this).val();}).get();
        var rate_type = 'L';
        var location_from = $('#state').val();
        var location_to = $('#state_to').val();
        var delivery_speed = $('.delivery_speed').find(":selected").val();
        //var charges_mode = $(this).val();
        var charges_mode = $("input[name='charges_final']:checked").val();
        $('#charges_sum').val('0');

        //console.log("charges_mode " + charges_mode);
        if (charges_mode != '' && charges_mode != NaN && charges_mode != undefined) {
            var func = ratecheckbox1(charges_mode, delivery_speed);
            if (func == true) {
                window.setTimeout(function() {
                    var newidsArr = $('input[name="ids[]"]').map(function() {
                        //$(newidsArr).each(function() {

                        var newid1 = $(this).val(); //this.value;
                        //console.log("newid1 "+newid1);

                        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

                        var ship_cat_id = $('input[name="shipment_type_option_' + newid1 + '"]:checked').val();
                        // var rate_doc_per = $(this).attr('name');
                        // var rate_doc_per = $('data-newid-rc').attr('data-newid-rc');

                        if (ship_cat_id == 1) {
                            var ship_subcat_id = $('#document_category_' + newid1).val();
                            var ship_sub_subcat_id = $('#document_sub_cat' + newid1).val();
                            var qty = '1';
                        } else if (ship_cat_id == 2) {
                            var ship_subcat_id = $('#package_category_' + newid1).val();
                            var ship_sub_subcat_id = $('#package_sub_cat' + newid1).val();
                            var qty = $('#quantity' + newid1).val();
                            var length = $('#length' + newid1).val();
                            var breadth = $('#breadth' + newid1).val();
                            var height = $('#height' + newid1).val();
                            var rate_factor = $('#rate_factor').val();
                        } else {
                            var ship_subcat_id = ($('#document_category_' + newid1).val() != '') ? $('#document_category_' + newid1).val() : $('#package_category_' + newid1).val();
                            var ship_sub_subcat_id = ($('#document_sub_cat' + newid1).val() != '') ? $('#document_sub_cat' + newid1).val() : $('#package_sub_cat' + newid1).val();
                        }

                        //console.log(newid1, '>>',rate_doc_per, '>>>' , ship_subcat_id, ship_sub_subcat_id, rate_type, location_from, location_to);
                        $.ajax({
                            dataType: "json",
                            type: "post",
                            url: '<?php echo base_url('getShipmentChanges'); ?>',
                            data: {
                                [csrfName]: csrfHash,
                                ship_cat_id: ship_cat_id,
                                ship_subcat_id: ship_subcat_id,
                                ship_sub_subcat_id: ship_sub_subcat_id,
                                rate_type: rate_type,
                                location_from: location_from,
                                location_to: location_to,
                                charges_mode: charges_mode,
                                delivery_speed: delivery_speed
                            },
                            success: function(data) {
                                var string1 = JSON.stringify(data.rates);
                                var dataObj = JSON.parse(string1);
                                var resultKeyCount = Object.keys(dataObj).length;

                                if (resultKeyCount > 0) {
                                    $(dataObj).each(function() {
                                        //console.log('ship_cat_id' + this.ship_mode_id);
                                        if (ship_cat_id == 1) {
                                            $('#protect_shipment_document' + newid1).val(this.insurance);
                                            if (this.ship_mode_id == 1) {
                                                var rate_tot = (this.rate * qty).toFixed(2);
                                                $('#road_document_input' + newid1).val(rate_tot);
                                                $('#road_document_span' + newid1).text(rate_tot);

                                                var road_document_input = $('#road_document_input').val();
                                                var road_input = $('#charges_sum').val();

                                                // var road_input = $('#road_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                // if (road_input != '' && road_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = (parseFloat(rate_tot) + parseFloat(road_input)).toFixed(2);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }

                                                // console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#road_input').val(sum);
                                                $('#road_span').text('$' + sum);

                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');

                                                $('#rail_document_input' + newid1).val('');
                                                $('#rail_document_span' + newid1).text('');
                                                $('#air_document_input' + newid1).val('');
                                                $('#air_document_span' + newid1).text('');
                                                $('#ship_document_input' + newid1).val('');
                                                $('#ship_document_span' + newid1).text('');
                                            } else if (this.ship_mode_id == 2) {
                                                var rate_tot = (this.rate * qty).toFixed(2);
                                                $('#rail_document_input' + newid1).val(rate_tot);
                                                $('#rail_document_span' + newid1).text(rate_tot);

                                                var rail_input = $('#charges_sum').val();
                                                //var rail_input = $('#rail_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                // if (rail_input != '' && rail_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = (parseFloat(rate_tot) + parseFloat(rail_input)).toFixed(2);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }
                                                //console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#rail_input').val(sum);
                                                $('#rail_span').text('$' + sum);


                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');

                                                $('#road_document_input' + newid1).val('');
                                                $('#road_document_span' + newid1).text('');
                                                $('#air_document_input' + newid1).val('');
                                                $('#air_document_span' + newid1).text('');
                                                $('#ship_document_input' + newid1).val('');
                                                $('#ship_document_span' + newid1).text('');
                                            } else if (this.ship_mode_id == 3) {
                                                var rate_tot = (this.rate * qty).toFixed(2);
                                                $('#air_document_input' + newid1).val(rate_tot);
                                                $('#air_document_span' + newid1).text(rate_tot);

                                                var air_input = $('#charges_sum').val();
                                                //var air_input = $('#air_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                // if (air_input != '' && air_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = parseFloat(rate_tot) + parseFloat(air_input);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }
                                                //console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#air_input').val(sum);
                                                $('#air_span').text('$' + sum);

                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');

                                                $('#rail_document_input' + newid1).val('');
                                                $('#rail_document_span' + newid1).text('');
                                                $('#road_document_input' + newid1).val('');
                                                $('#road_document_span' + newid1).text('');
                                                $('#ship_document_input' + newid1).val('');
                                                $('#ship_document_span' + newid1).text('');
                                            } else if (this.ship_mode_id == 4) {
                                                var rate_tot = (this.rate * qty).toFixed(2);
                                                $('#ship_document_input' + newid1).val(rate_tot);
                                                $('#ship_document_span' + newid1).text(rate_tot);

                                                var ship_input = $('#charges_sum').val();
                                                //var ship_input = $('#ship_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                // if (ship_input != '' && ship_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = (parseFloat(rate_tot) + parseFloat(ship_input)).toFixed(2);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }
                                                //console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#ship_input').val(sum);
                                                $('#ship_span').text('$' + sum);

                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');

                                                $('#rail_document_input' + newid1).val('');
                                                $('#rail_document_span' + newid1).text('');
                                                $('#air_document_input' + newid1).val('');
                                                $('#air_document_span' + newid1).text('');
                                                $('#road_document_input' + newid1).val('');
                                                $('#road_document_span' + newid1).text('');
                                            } else {
                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');
                                                $('#rail_document_input' + newid1).val('');
                                                $('#rail_document_span' + newid1).text('');
                                                $('#air_document_input' + newid1).val('');
                                                $('#air_document_span' + newid1).text('');
                                                $('#road_document_input' + newid1).val('');
                                                $('#road_document_span' + newid1).text('');
                                                $('#ship_document_input' + newid1).val('');
                                                $('#ship_document_span' + newid1).text('');
                                            }
                                        } else {
                                            $('#protect_parcel' + newid1).val(this.insurance);
                                            if (this.ship_mode_id == 1) {
                                                //var rate_qty = (this.rate * qty).toFixed(2);
                                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);
                                                // var rate_tot2 = (rate_tot * parseFloat(qty)).toFixed(2);
                                                // console.log(rate_tot + '*' + qty '' + rate_tot2);
                                                $('#road_parcel_input' + newid1).val(rate_tot);
                                                $('#road_parcel_span' + newid1).text(rate_tot);

                                                var road_input = $('#charges_sum').val();
                                                //var road_input = $('#road_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                // if (road_input != '' && road_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = (parseFloat(rate_tot) + parseFloat(road_input)).toFixed(2);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }

                                                //console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#road_input').val(sum);
                                                $('#road_span').text('$' + sum);

                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');


                                                $('#rail_parcel_input' + newid1).val('');
                                                $('#rail_parcel_span' + newid1).text('');
                                                $('#air_parcel_input' + newid1).val('');
                                                $('#air_parcel_span' + newid1).text('');
                                                $('#ship_parcel_input' + newid1).val('');
                                                $('#ship_parcel_span' + newid1).text('');
                                            } else if (this.ship_mode_id == 2) {
                                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);
                                                $('#rail_parcel_input' + newid1).val(rate_tot);
                                                $('#rail_parcel_span' + newid1).text(rate_tot);

                                                var rail_input = $('#charges_sum').val();
                                                //var rail_input = $('#rail_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                // if (rail_input != '' && rail_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = (parseFloat(rate_tot) + parseFloat(rail_input)).toFixed(2);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }
                                                //console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#rail_input').val(sum);
                                                $('#rail_span').text('$' + sum);


                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');


                                                $('#road_parcel_input' + newid1).val('');
                                                $('#road_parcel_span' + newid1).text('');
                                                $('#air_parcel_input' + newid1).val('');
                                                $('#air_parcel_span' + newid1).text('');
                                                $('#ship_parcel_input' + newid1).val('');
                                                $('#ship_parcel_span' + newid1).text('');
                                            } else if (this.ship_mode_id == 3) {
                                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);
                                                $('#air_parcel_input' + newid1).val(rate_tot);
                                                $('#air_parcel_span' + newid1).text(rate_tot);

                                                var air_input = $('#charges_sum').val();
                                                //var air_input = $('#air_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                // if (air_input != '' && air_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = (parseFloat(rate_tot) + parseFloat(air_input)).toFixed(2);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }
                                                //console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#air_input').val(sum);
                                                $('#air_span').text('$' + sum);

                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');

                                                $('#road_parcel_input' + newid1).val('');
                                                $('#road_parcel_span' + newid1).text('');
                                                $('#rail_parcel_input' + newid1).val('');
                                                $('#rail_parcel_span' + newid1).text('');
                                                $('#ship_parcel_input' + newid1).val('');
                                                $('#ship_parcel_span' + newid1).text('');
                                            } else if (this.ship_mode_id == 4) {
                                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);
                                                $('#ship_parcel_input' + newid1).val(rate_tot);
                                                $('#ship_parcel_span' + newid1).text(rate_tot);

                                                var ship_input = $('#charges_sum').val();
                                                //var ship_input = $('#ship_input').val();
                                                //console.log('rate ' + this.rate);
                                                //console.log('road_input ' + road_input);

                                                //if (ship_input != '' && ship_input != 'NaN') {
                                                //console.log('road_inputif ' + road_input);
                                                var sum = (parseFloat(rate_tot) + parseFloat(ship_input)).toFixed(2);
                                                // } else {
                                                //     //console.log('road_inputel ' + road_input);
                                                //     var sum = parseFloat(this.rate) + parseFloat(this.rate);
                                                // }
                                                //console.log('sum ' + sum);

                                                $('#charges_sum').val(sum);
                                                $('#ship_input').val(sum);
                                                $('#ship_span').text('$' + sum);

                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');

                                                $('#road_parcel_input' + newid1).val('');
                                                $('#road_parcel_span' + newid1).text('');
                                                $('#rail_parcel_input' + newid1).val('');
                                                $('#rail_parcel_span' + newid1).text('');
                                                $('#air_parcel_input' + newid1).val('');
                                                $('#air_parcel_span' + newid1).text('');
                                            } else {
                                                $('#rail_input').val('');
                                                $('#rail_span').text('');
                                                $('#road_input').val('');
                                                $('#road_span').text('');
                                                $('#air_input').val('');
                                                $('#air_span').text('');
                                                $('#ship_input').val('');
                                                $('#ship_span').text('');
                                                $('#road_parcel_input' + newid1).val('');
                                                $('#road_parcel_span' + newid1).text('');
                                                $('#rail_parcel_input' + newid1).val('');
                                                $('#rail_parcel_span' + newid1).text('');
                                                $('#air_parcel_input' + newid1).val('');
                                                $('#air_parcel_span' + newid1).text('');
                                                $('#ship_parcel_input' + newid1).val('');
                                                $('#ship_parcel_span' + newid1).text('');
                                            }
                                        }
                                    });
                                } else {
                                    if (ship_cat_id == 1) {
                                        $('#charges_sum').val('0');
                                        $('#rail_input').val('');
                                        $('#rail_span').text('');
                                        $('#road_input').val('');
                                        $('#road_span').text('');
                                        $('#air_input').val('');
                                        $('#air_span').text('');
                                        $('#ship_input').val('');
                                        $('#ship_span').text('');
                                        $('#rail_document_input' + newid1).val('');
                                        $('#rail_document_span' + newid1).text('');
                                        $('#air_document_input' + newid1).val('');
                                        $('#air_document_span' + newid1).text('');
                                        $('#road_document_input' + newid1).val('');
                                        $('#road_document_span' + newid1).text('');
                                        $('#ship_document_input' + newid1).val('');
                                        $('#ship_document_span' + newid1).text('');
                                    } else {
                                        $('#charges_sum').val('0');
                                        $('#rail_input').val('');
                                        $('#rail_span').text('');
                                        $('#road_input').val('');
                                        $('#road_span').text('');
                                        $('#air_input').val('');
                                        $('#air_span').text('');
                                        $('#ship_input').val('');
                                        $('#ship_span').text('');
                                        $('#road_parcel_input' + newid1).val('');
                                        $('#road_parcel_span' + newid1).text('');
                                        $('#rail_parcel_input' + newid1).val('');
                                        $('#rail_parcel_span' + newid1).text('');
                                        $('#air_parcel_input' + newid1).val('');
                                        $('#air_parcel_span' + newid1).text('');
                                        $('#ship_parcel_input' + newid1).val('');
                                        $('#ship_parcel_span' + newid1).text('');
                                    }

                                }

                            }
                        });
                        //});
                    }).get();
                }, 600);
            } else {
                console.log('false');
            }
        }



        //console.log(charges_mode);
        //if (newidsArr != '' && $(this).val() > 0) {
        //var newid1 = $(this).attr('data-newid-rc');


        //}


    }


    $(document).on('change', '.get_rate_checkbox', function() {

        var newid1 = $(this).attr('data-newid-rc');
        if ($(this).val() > 0) {
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var ship_cat_id = $('input[name="shipment_type_option_' + newid1 + '"]:checked').val();

            var rate_doc_per = $(this).attr('name');

            if (rate_doc_per == 'charges_by_' + newid1) {
                var ship_subcat_id = $('#document_category_' + newid1).val();
                var ship_sub_subcat_id = $('#document_sub_cat' + newid1).val();
            } else if (rate_doc_per == 'charges_parcel' + newid1) {
                var ship_subcat_id = $('#package_category_' + newid1).val();
                var ship_sub_subcat_id = $('#package_sub_cat' + newid1).val();
            } else {
                var ship_subcat_id = ($('#document_category_' + newid1).val() != '') ? $('#document_category_' + newid1).val() : $('#package_category_' + newid1).val();
                var ship_sub_subcat_id = ($('#document_sub_cat' + newid1).val() != '') ? $('#document_sub_cat' + newid1).val() : $('#package_sub_cat' + newid1).val();
            }

            var rate_type = 'L';
            var location_from = $('#state').val();
            var location_to = $('#state_to').val();
            var charges_mode = $(this).val();

            //console.log(newid1, '>>',rate_doc_per, '>>>' , ship_subcat_id, ship_sub_subcat_id, rate_type, location_from, location_to);
            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getShipmentChanges'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    ship_cat_id: ship_cat_id,
                    ship_subcat_id: ship_subcat_id,
                    ship_sub_subcat_id: ship_sub_subcat_id,
                    rate_type: rate_type,
                    location_from: location_from,
                    location_to: location_to,
                    charges_mode: charges_mode
                },
                success: function(data) {
                    var string1 = JSON.stringify(data.rates);
                    var dataObj = JSON.parse(string1);
                    var resultKeyCount = Object.keys(dataObj).length;

                    if (resultKeyCount > 0) {
                        $(dataObj).each(function() {
                            //console.log(dataObj[0]['ship_mode_id']);
                            if (ship_cat_id == 1) {
                                if (this.ship_mode_id == 1) {
                                    $('#road_document_input' + newid1).val(this.rate);
                                    $('#road_document_span' + newid1).text(this.rate);

                                    $('#rail_document_input' + newid1).val('');
                                    $('#rail_document_span' + newid1).text('');
                                    $('#air_document_input' + newid1).val('');
                                    $('#air_document_span' + newid1).text('');
                                    $('#ship_document_input' + newid1).val('');
                                    $('#ship_document_span' + newid1).text('');
                                } else if (this.ship_mode_id == 2) {
                                    $('#rail_document_input' + newid1).val(this.rate);
                                    $('#rail_document_span' + newid1).text(this.rate);

                                    $('#road_document_input' + newid1).val('');
                                    $('#road_document_span' + newid1).text('');
                                    $('#air_document_input' + newid1).val('');
                                    $('#air_document_span' + newid1).text('');
                                    $('#ship_document_input' + newid1).val('');
                                    $('#ship_document_span' + newid1).text('');
                                } else if (this.ship_mode_id == 3) {
                                    $('#air_document_input' + newid1).val(his.rate);
                                    $('#air_document_span' + newid1).text(this.rate);

                                    $('#rail_document_input' + newid1).val('');
                                    $('#rail_document_span' + newid1).text('');
                                    $('#road_document_input' + newid1).val('');
                                    $('#road_document_span' + newid1).text('');
                                    $('#ship_document_input' + newid1).val('');
                                    $('#ship_document_span' + newid1).text('');
                                } else if (this.ship_mode_id == 4) {
                                    $('#ship_document_input' + newid1).val(this.rate);
                                    $('#ship_document_span' + newid1).text(this.rate);

                                    $('#rail_document_input' + newid1).val('');
                                    $('#rail_document_span' + newid1).text('');
                                    $('#air_document_input' + newid1).val('');
                                    $('#air_document_span' + newid1).text('');
                                    $('#road_document_input' + newid1).val('');
                                    $('#road_document_span' + newid1).text('');
                                } else {
                                    $('#rail_document_input' + newid1).val('');
                                    $('#rail_document_span' + newid1).text('');
                                    $('#air_document_input' + newid1).val('');
                                    $('#air_document_span' + newid1).text('');
                                    $('#road_document_input' + newid1).val('');
                                    $('#road_document_span' + newid1).text('');
                                    $('#ship_document_input' + newid1).val('');
                                    $('#ship_document_span' + newid1).text('');
                                }
                            } else {
                                if (this.ship_mode_id == 1) {
                                    $('#road_parcel_input' + newid1).val(this.rate);
                                    $('#road_parcel_span' + newid1).text(this.rate);


                                    $('#rail_parcel_input' + newid1).val('');
                                    $('#rail_parcel_span' + newid1).text('');
                                    $('#air_parcel_input' + newid1).val('');
                                    $('#air_parcel_span' + newid1).text('');
                                    $('#ship_parcel_input' + newid1).val('');
                                    $('#ship_parcel_span' + newid1).text('');
                                } else if (this.ship_mode_id == 2) {
                                    $('#rail_parcel_input' + newid1).val(this.rate);
                                    $('#rail_parcel_span' + newid1).text(this.rate);


                                    $('#road_parcel_input' + newid1).val('');
                                    $('#road_parcel_span' + newid1).text('');
                                    $('#air_parcel_input' + newid1).val('');
                                    $('#air_parcel_span' + newid1).text('');
                                    $('#ship_parcel_input' + newid1).val('');
                                    $('#ship_parcel_span' + newid1).text('');
                                } else if (this.ship_mode_id == 3) {
                                    $('#air_parcel_input' + newid1).val(this.rate);
                                    $('#air_parcel_span' + newid1).text(this.rate);

                                    $('#road_parcel_input' + newid1).val('');
                                    $('#road_parcel_span' + newid1).text('');
                                    $('#rail_parcel_input' + newid1).val('');
                                    $('#rail_parcel_span' + newid1).text('');
                                    $('#ship_parcel_input' + newid1).val('');
                                    $('#ship_parcel_span' + newid1).text('');
                                } else if (this.ship_mode_id == 4) {
                                    $('#ship_parcel_input' + newid1).val(this.rate);
                                    $('#ship_parcel_span' + newid1).text(this.rate);

                                    $('#road_parcel_input' + newid1).val('');
                                    $('#road_parcel_span' + newid1).text('');
                                    $('#rail_parcel_input' + newid1).val('');
                                    $('#rail_parcel_span' + newid1).text('');
                                    $('#air_parcel_input' + newid1).val('');
                                    $('#air_parcel_span' + newid1).text('');
                                } else {
                                    $('#road_parcel_input' + newid1).val('');
                                    $('#road_parcel_span' + newid1).text('');
                                    $('#rail_parcel_input' + newid1).val('');
                                    $('#rail_parcel_span' + newid1).text('');
                                    $('#air_parcel_input' + newid1).val('');
                                    $('#air_parcel_span' + newid1).text('');
                                    $('#ship_parcel_input' + newid1).val('');
                                    $('#ship_parcel_span' + newid1).text('');
                                }
                            }
                        });
                    } else {
                        if (ship_cat_id == 1) {
                            $('#rail_document_input' + newid1).val('');
                            $('#rail_document_span' + newid1).text('');
                            $('#air_document_input' + newid1).val('');
                            $('#air_document_span' + newid1).text('');
                            $('#road_document_input' + newid1).val('');
                            $('#road_document_span' + newid1).text('');
                            $('#ship_document_input' + newid1).val('');
                            $('#ship_document_span' + newid1).text('');
                        } else {
                            $('#road_parcel_input' + newid1).val('');
                            $('#road_parcel_span' + newid1).text('');
                            $('#rail_parcel_input' + newid1).val('');
                            $('#rail_parcel_span' + newid1).text('');
                            $('#air_parcel_input' + newid1).val('');
                            $('#air_parcel_span' + newid1).text('');
                            $('#ship_parcel_input' + newid1).val('');
                            $('#ship_parcel_span' + newid1).text('');
                        }

                    }

                }
            });
        } else {

        }
    });

    $(document).ready(function() {

        //** Loading the for package after add more Second **//
        // $(document).on('change', '#shipment_type_option' + getCookie('docpackcount'), function() {

        //     if ($(this).val() == 1) {
        //         $('.document_option' + getCookie('docpackcount')).show();
        //         $('#package_option' + getCookie('docpackcount')).hide();
        //         $("[name='shipment_type_option" + getCookie('docpackcount') + "'][value='1']").prop('checked', true);

        //     } else if ($(this).val() == 2) {
        //         $('#package_option' + getCookie('docpackcount')).show();
        //         $('.document_option' + getCookie('docpackcount')).hide();
        //         $("[name='shipment_type_option" + getCookie('docpackcount') + "'][value='2']").prop('checked', true);

        //}
    });

    // Validate To zip code by keypress // DEBASIS
    $('#zip_to').keyup(function() {
        if ($(this).val().length > 4) {
            return true
            //do something
            //alert($(this).val());
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var postal_code = $(this).val();
            $("#LoadingImage").show();
            $.ajax({
                url: "<?php echo base_url(); ?>users/validateTozipcode",
                method: "POST",
                data: {
                    [csrfName]: csrfHash,
                    postal_code: postal_code
                },
                success: function(data) {
                    $("#LoadingImage").hide();
                    $(".zip_to_popup").hide();
                    $('#div_zip_to').empty().append(data);
                    if (data == '<span style="color:red;">We do not cover your area!</span>') {
                        $(".zip_to_popup").attr("data-zip-to", data);
                        $(".zip_to_popup").show();
                    } else {
                        $(".zip_to_popup").attr("data-zip-to", '');
                        $(".zip_to_popup").hide();
                    }

                }
            });
        }
    });


    // Validate From zip code by keypress // DEBASIS
    $('#zip').keyup(function() {
        if ($(this).val().length > 4) {
            //do something
            //alert($(this).val());
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var postal_code = $(this).val();
            $("#LoadingImage1").show();
            $.ajax({
                url: "<?php echo base_url(); ?>users/validateTozipcode",
                method: "POST",
                data: {
                    [csrfName]: csrfHash,
                    postal_code: postal_code
                },
                success: function(data) {
                    $("#LoadingImage1").hide();
                    $(".zip").hide();
                    $('#div_zip').empty().append(data);
                    if (data == '<span style="color:red;">We do not cover your area!</span>') {
                        $(".zip_popup").attr("data-zip", data);
                        $(".zip_popup").show();
                    } else {
                        $(".zip_popup").attr("data-zip", '');
                        $(".zip_popup").hide();
                    }
                }
            });
        }
    });

    $('.getintouch-pop').on('click', function() {

        $('#getInTouch').modal('hide');
        var zip_type = $(this).attr("data-zip-type");

        if (zip_type == 'zip') {
            var zip = $('#zip').val();
        } else if (zip_type == 'zip_to') {
            var zip = $('#zip_to').val();
        } else {
            var zip = '';
        }
        $('#zip_code').val(zip);
        $('#getInTouch').modal('toggle');
        $('#getInTouch').modal('show');
        //$('#getInTouch').modal('hide');
    });

    $('.getintouch-submit').on('click', function() {

        var zip_code = $('#zip_code').val();
        var comment = $('#comment').val();
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        //console.log(html)

        if (zip_code != '' && comment != '') {
            $('.modal-msg').html('');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('send-get-in-touch'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    zip_code: zip_code,
                    comment: comment,
                },
                success: function(resp) {
                    var json = $.parseJSON(resp);
                    if (json.mailsent == '1') {
                        $('.modal-msg').html(json.message);
                    } else {
                        $('.modal-msg').html(json.message);
                    }

                }
            });
        } else {
            $('.modal-msg').css('color', 'red');
            $('.modal-msg').html('*Required fields missing!');
        }
    });


    // });

    function setCookie(key, value, expiry) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
    }

    function getCookie(key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    }

    function eraseCookie(key) {
        var keyValue = getCookie(key);
        setCookie(key, keyValue, '-1');
    }

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function ratecheckbox1(charges_mode, delivery_speed) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var ship_cat_id = $('input[name="shipment_type_option"]:checked').val();
        //var rate_doc_per = $('.rate_checkbox:checked').attr('name');

        if (ship_cat_id == 1) {
            var ship_subcat_id = $('#document_category').val();
            var ship_sub_subcat_id = $('#document_sub_cat').val();
            var qty = '1';
        } else if (ship_cat_id == 2) {
            var ship_subcat_id = $('#package_category').val();
            var ship_sub_subcat_id = $('#package_sub_cat').val();
            var qty = $('#quantity').val();

            var length = $('#length').val();
            var breadth = $('#breadth').val();
            var height = $('#height').val();
            var rate_factor = $('#rate_factor').val();
        } else {
            var ship_subcat_id = ($('#document_category').val() != '') ? $('#document_category').val() : $('#package_category').val();
            var ship_sub_subcat_id = ($('#document_sub_cat').val() != '') ? $('#document_sub_cat').val() : $('#package_sub_cat').val();
        }


        //var charges_mode = $('.rate_checkbox:checked').val();


        var rate_type = 'L';
        var location_from = $('#state').val();
        var location_to = $('#state_to').val();

        //console.log('charges_mode' + charges_mode);

        $.ajax({
            dataType: "json",
            type: "post",
            url: '<?php echo base_url('getShipmentChanges'); ?>',
            data: {
                [csrfName]: csrfHash,
                ship_cat_id: ship_cat_id,
                ship_subcat_id: ship_subcat_id,
                ship_sub_subcat_id: ship_sub_subcat_id,
                rate_type: rate_type,
                location_from: location_from,
                location_to: location_to,
                charges_mode: charges_mode,
                delivery_speed: delivery_speed
            },
            success: function(data) {
                var string1 = JSON.stringify(data.rates);
                var dataObj = JSON.parse(string1);
                var resultKeyCount = Object.keys(dataObj).length;

                if (resultKeyCount > 0) {
                    $(dataObj).each(function() {
                        if (ship_cat_id == 1) {
                            $('#protect_shipment_document').val(this.insurance);
                            if (this.ship_mode_id == 1) {
                                var rate_tot = (this.rate * qty).toFixed(2);
                                $('#road_document_input').val(rate_tot);
                                $('#road_document_span').text(rate_tot);
                                $('#road_input').val(rate_tot);
                                $('#charges_sum').val(rate_tot);
                                $('#road_span').text(rate_tot);
                                //console.log('1rate:' + this.rate)

                                // $('#rail_input').val('');
                                $('#rail_span').text('');
                                // $('#air_input').val('');
                                $('#air_span').text('');
                                // $('#ship_input').val('');
                                $('#ship_span').text('');
                                $('#air_document_input').val('');
                                $('#air_document_span').text('');
                                $('#ship_document_input').val('');
                                $('#ship_document_span').text('');
                                $('#rail_document_input').val('');
                                $('#rail_document_span').text('');
                            } else if (this.ship_mode_id == 2) {
                                var rate_tot = (this.rate * qty).toFixed(2);
                                $('#rail_document_input').val(rate_tot);
                                $('#rail_document_span').text(rate_tot);
                                $('#rail_input').val(rate_tot);
                                $('#rail_span').text(rate_tot);
                                $('#charges_sum').val(rate_tot);


                                // $('#road_input').val('');
                                $('#road_span').text('');
                                // $('#air_input').val('');
                                $('#air_span').text('');
                                // $('#ship_input').val('');
                                $('#ship_span').text('');
                                $('#road_document_input').val('');
                                $('#road_document_span').text('');
                                $('#air_document_input').val('');
                                $('#air_document_span').text('');
                                $('#ship_document_input').val('');
                                $('#ship_document_span').text('');
                            } else if (this.ship_mode_id == 3) {
                                var rate_tot = (this.rate * qty).toFixed(2);
                                $('#air_document_input').val(rate_tot);
                                $('#air_document_span').text(rate_tot);
                                $('#air_input').val(rate_tot);
                                $('#air_span').text(rate_tot);
                                $('#charges_sum').val(rate_tot);

                                // $('#rail_input').val('');
                                $('#rail_span').text('');
                                // $('#road_input').val('');
                                $('#road_span').text('');
                                // $('#ship_input').val('');
                                $('#ship_span').text('');
                                $('#road_document_input').val('');
                                $('#road_document_span').text('');
                                $('#rail_document_input').val('');
                                $('#rail_document_span').text('');
                                $('#ship_document_input').val('');
                                $('#ship_document_span').text('');
                            } else if (this.ship_mode_id == 4) {
                                var rate_tot = (this.rate * qty).toFixed(2);
                                $('#air_document_input').val(rate_tot);
                                $('#air_document_span').text(rate_tot);
                                $('#ship_input').val(rate_tot);
                                $('#ship_span').text(rate_tot);
                                $('#charges_sum').val(rate_tot);

                                // $('#rail_input').val('');
                                $('#rail_span').text('');
                                // $('#road_input').val('');
                                $('#road_span').text('');
                                // $('#air_input').val('');
                                $('#air_span').text('');
                                $('#road_document_input').val('');
                                $('#road_document_span').text('');
                                $('#rail_document_input').val('');
                                $('#rail_document_span').text('');
                                $('#ship_document_input').val('');
                                $('#ship_document_span').text('');
                            } else {
                                $('#rail_input').val('');
                                $('#rail_span').text('');
                                $('#road_input').val('');
                                $('#road_span').text('');
                                $('#air_input').val('');
                                $('#air_span').text('');
                                $('#ship_input').val('');
                                $('#ship_span').text('');
                                $('#road_document_input').val('');
                                $('#road_document_span').text('');
                                $('#rail_document_input').val('');
                                $('#rail_document_span').text('');
                                $('#air_document_input').val('');
                                $('#air_document_span').text('');
                                $('#ship_document_input').val('');
                                $('#ship_document_span').text('');
                            }
                        } else {
                            $('#protect_parcel').val(this.insurance);
                            if (this.ship_mode_id == 1) {
                                // var rate_qty = (this.rate * qty).toFixed(2);

                                //var rate_tot = ((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(rate_qty)).toFixed(2);
                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);

                                //console.log(qty + '<>' + rate_qty+ '<>' + gtotal);

                                $('#road_parcel_input').val(rate_tot);
                                $('#road_parcel_span').text(rate_tot);
                                $('#road_input').val(rate_tot);
                                $('#road_span').text(rate_tot);
                                $('#charges_sum').val(rate_tot);

                                // $('#rail_input').val('');
                                $('#rail_span').text('');
                                // $('#air_input').val('');
                                $('#air_span').text('');
                                // $('#ship_input').val('');
                                $('#ship_span').text('');

                                $('#rail_parcel_input').val('');
                                $('#rail_parcel_span').text('');
                                $('#air_parcel_input').val('');
                                $('#air_parcel_span').text('');
                                $('#ship_parcel_input').val('');
                                $('#ship_parcel_span').text('');
                            } else if (this.ship_mode_id == 2) {
                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);

                                $('#rail_parcel_input').val(rate_tot);
                                $('#rail_parcel_span').text(rate_tot);
                                $('#rail_input').val(rate_tot);
                                $('#rail_span').text(rate_tot);
                                $('#charges_sum').val(rate_tot);


                                // $('#road_input').val('');
                                $('#road_span').text('');
                                // $('#air_input').val('');
                                $('#air_span').text('');
                                // $('#ship_input').val('');
                                $('#ship_span').text('');

                                $('#road_parcel_input').val('');
                                $('#road_parcel_span').text('');
                                $('#air_parcel_input').val('');
                                $('#air_parcel_span').text('');
                                $('#ship_parcel_input').val('');
                                $('#ship_parcel_span').text('');
                            } else if (this.ship_mode_id == 3) {
                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);

                                $('#air_parcel_input').val(rate_tot);
                                $('#air_parcel_span').text(rate_tot);
                                $('#air_input').val(rate_tot);
                                $('#air_span').text(rate_tot);
                                $('#charges_sum').val(rate_tot);

                                // $('#rail_input').val('');
                                $('#rail_span').text('');
                                // $('#road_input').val('');
                                $('#road_span').text('');
                                // $('#ship_input').val('');
                                $('#ship_span').text('');

                                $('#road_parcel_input').val('');
                                $('#road_parcel_span').text('');
                                $('#rail_parcel_input').val('');
                                $('#rail_parcel_span').text('');
                                $('#ship_parcel_input').val('');
                                $('#ship_parcel_span').text('');
                            } else if (this.ship_mode_id == 4) {
                                var rate_tot = (((((parseFloat(length) * parseFloat(breadth) * parseFloat(height)) / 5000) * parseFloat(rate_factor)) + parseFloat(this.rate)) * parseFloat(qty)).toFixed(2);

                                $('#ship_parcel_input').val(rate_tot);
                                $('#ship_parcel_span').text(rate_tot);
                                $('#ship_input').val(rate_tot);
                                $('#ship_span').text(rate_tot);
                                $('#charges_sum').val(rate_tot);

                                // $('#rail_input').val('');
                                $('#rail_span').text('');
                                // $('#road_input').val('');
                                $('#road_span').text('');
                                // $('#air_input').val('');
                                $('#air_span').text('');

                                $('#road_parcel_input').val('');
                                $('#road_parcel_span').text('');
                                $('#air_parcel_input').val('');
                                $('#air_parcel_span').text('');
                                $('#rail_parcel_input').val('');
                                $('#rail_parcel_span').text('');
                            } else {
                                $('#rail_input').val('');
                                $('#rail_span').text('');
                                $('#road_input').val('');
                                $('#road_span').text('');
                                $('#air_input').val('');
                                $('#air_span').text('');
                                $('#ship_input').val('');
                                $('#ship_span').text('');
                                $('#road_parcel_input').val('');
                                $('#road_parcel_span').text('');
                                $('#air_parcel_input').val('');
                                $('#air_parcel_span').text('');
                                $('#rail_parcel_input').val('');
                                $('#rail_parcel_span').text('');
                                $('#ship_parcel_input').val('');
                                $('#ship_parcel_span').text('');
                            }
                        }
                    });
                } else {

                    if (ship_cat_id == 1) {
                        $('#charges_sum').val('0');
                        $('#rail_input').val('');
                        $('#rail_span').text('');
                        $('#road_input').val('');
                        $('#road_span').text('');
                        $('#air_input').val('');
                        $('#air_span').text('');
                        $('#ship_input').val('');
                        $('#ship_span').text('');
                        $('#road_document_input').val('');
                        $('#road_document_span').text('');
                        $('#rail_document_input').val('');
                        $('#rail_document_span').text('');
                        $('#air_document_input').val('');
                        $('#air_document_span').text('');
                        $('#ship_document_input').val('');
                        $('#ship_document_span').text('');
                    } else {
                        $('#charges_sum').val('0');
                        $('#rail_input').val('');
                        $('#rail_span').text('');
                        $('#road_input').val('');
                        $('#road_span').text('');
                        $('#air_input').val('');
                        $('#air_span').text('');
                        $('#ship_input').val('');
                        $('#ship_span').text('');
                        $('#road_parcel_input').val('');
                        $('#road_parcel_span').text('');
                        $('#air_parcel_input').val('');
                        $('#air_parcel_span').text('');
                        $('#rail_parcel_input').val('');
                        $('#rail_parcel_span').text('');
                        $('#ship_parcel_input').val('');
                        $('#ship_parcel_span').text('');
                    }
                }


            }
        });

        // var charges_sum = $('#charges_sum').val();
        // if(charges_sum > 0){
        return true;
        // }else{

        // }

    }
</script>
<script type='text/javascript'>
  $(document).ready(function(){
  
     $( "#firstname_to" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>ajax/recipients/list",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
          response(data.map(function (value) {
                    return value;  
                }));
        }
       });
      },
    select: function (event, ui) {
       // Set selection
       
       $('#firstname_to').val(ui.item.firstname);
       $('#lastname_to').val(ui.item.lastname); 
       $('#autocomplete2').val(ui.item.address);
       $('#address2_to').val(ui.item.address2);
       $('#company_name_to').val(ui.item.company_name);
       $('#country_to').val(ui.item.country);
       $('#country_to').trigger("change");
       
       setTimeout( function(){ 
            $('#state_to').val(ui.item.state);
            $('#state_to').trigger("change"); 
        }  , 1000 );
       setTimeout( function(){ 
            $('#city_to').val(ui.item.city); 
        }  , 2000 );
      
       $('#zip_to').val(ui.item.zip);
       $('#email_to').val(ui.item.email);
       $('#email_to').val(ui.item.email);
       $('#lat_to').val(ui.item.latitude);
       $('#lng_to').val(ui.item.longitude);

        $.each(ui.item.telephone, function(key, value) {
            console.log(key + ": " + value);
            if (key==0) {
                $("#telephone_to").val(value);
            }else{

                var html = '<div><div class="col-sm-9"><label>Phone no </label><input type="number" name="telephone_to[]" id="telephone_to" value="'+value+'" class="form-control name-text" placeholder="" required=""></div><div class="col-sm-3"><input type="button" name="remove_tel_btn" id="remove_tel_btn" class="remove_tel_btn action-button add" value="Remove" style="border: 1px solid rgb(206, 212, 218);background-color: #ff0000 !important;color: #fff;font-size: 12px!important;font-family:Open Sans!important;height: 46px;"></div>';
                $('#add_more_tel').append(html);

            }
        });
      
       $("input[name=address_type][value="+ ui.item.address_type+ "]").prop('checked', true);
       
       return false;
      }
      
    });

  });
  </script>
