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
                            <p class="red">General</p>
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
                                            <input type="button" name="change_location" id="change_location" class="action-button pull-right green" value="Change Location">
                                            <div class="spacer"></div>

                                            <label for="usr">First Name</label>
                                            <input type="text" name="firstname" id="firstname" value="<?php echo $profile_details['firstname']; ?>" class="form-control  name-text is-valid firstname" placeholder="John " required readonly>
                                            <div id="firstname111" style="display:none"></div>

                                            <label for="usr">Last Name</label>
                                            <input type="text" name="lastname" id="lastname" value="<?php echo $profile_details['lastname']; ?>" class="form-control name-text is-valid lastname" placeholder="Da" required readonly>
                                            <div class="lastname_from_err" style="display:none"></div>

                                            <!--<label>Address Line1</label>
                                            <input type="text" name="address" id="autocomplete" value="<?php //echo $profile_details['address']; 
                                                                                                        ?>" class="form-control name-text" placeholder="Enter location.." required readonly onfocus="geolocate()">-->


                                            <label>From Address Line1</label>
                                            <input type="text" name="address_from" id="autocomplete" class="form-control name-text autocomplete address_from" data-loc="fromloc" placeholder="" required readonly>

                                            <div class="address_from_err" style="display:none"></div>


                                            <label>Address Line 2</label>
                                            <input type="text" name="address2" id="address2" value="<?php echo $profile_details['address2']; ?>" class="form-control name-text" placeholder="Enter location.." readonly>
                                            <div class="address2_to_err" style="display:none"></div>

                                            <label> Company (Optional)</label>
                                            <input type="text" name="company_name" id="company_name" value="<?php echo $profile_details['companyname']; ?>" class="form-control name-text" placeholder="" readonly>

                                            <label>Country/Territory</label>
                                            <?php echo fillCombo_frontend('countries_master', 'id', 'name', $profile_details['country'], 'status = 1', 'id', 'form-control form-control-new', 'country', 'country', '1'); ?>
                                            <div class="country_from_err" style="display:none"></div>

                                            <label>State</label>
                                            <?php echo fillCombo_frontend('states_master', 'id', 'name', $profile_details['state'], 'country_id=' . $profile_details['country'], 'id', 'form-control form-control-new', 'state', 'state', '1'); ?>
                                            <div class="state_from_err" style="display:none"></div>

                                            <label>City</label>
                                            <?php echo fillCombo_frontend('cities_master', 'id', 'name', $profile_details['city'], 'state_id=' . $profile_details['state'], 'id', 'form-control form-control-new', 'city', 'city', '1'); ?>
                                            <div class="city_from_err" style="display:none"></div>

                                            <label>Zip code</label>
                                            <input type="text" name="zip" id="zip" value="<?php echo $profile_details['zip']; ?>" class="form-control name-text" placeholder="LE14" readonly>
                                            <div class="zip_from_err" style="display:none"></div>

                                            <label>Email Address</label>
                                            <input type="email" name="email" id="email" value="<?php echo $profile_details['email']; ?>" class="form-control name-text" placeholder="abc@gmail.com" required readonly>
                                            <div class="email_from_err" style="display:none"></div>

                                            <label>Phone no</label>
                                            <input type="tel" name="telephone" id="telephone" value="<?php echo $profile_details['telephone']; ?>" class="form-control name-text" placeholder="99 9999 9999" required readonly>
                                            <div class="telephone_from_err" style="display:none"></div>

                                            <div class="col-sm-12">
                                                <label>Address Type</label>
                                                <div class="spacer"></div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="user_type" id="inlineRadio1" value="NU" <?php echo (($profile_details['user_type'] == '0') ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="inlineRadio1">Home Address</label>
                                                </div>
                                                <div class="address_type_from_err" style="display:none"></div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="user_type" id="inlineRadio2" value="BU" <?php echo (($profile_details['user_type'] == '1') ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="inlineRadio2">Business user</label>
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
                                                    <label for="usr">First Name</label>
                                                    <input type="text" name="firstname_to" id="firstname_to" class="form-control second_step_cls name-text is-valid" placeholder="">
                                                    <div class="firstname_to_err" style="display:none"></div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="usr">Last Name</label>
                                                    <input type="text" name="lastname_to" id="lastname_to" class="form-control second_step_cls name-text is-valid" placeholder="" required>
                                                    <div class="lastname_to_err" style="display:none"></div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label>To Address Line1</label>
                                                    <input type="text" name="address_to" id="autocomplete2" class="form-control second_step_cls name-text autocomplete" data-loc="toloc" placeholder="" required>
                                                    <div class="address_to_err" style="display:none"></div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label>Address Line 2</label>
                                                    <input type="text" name="address2_to" id="address2_to" class="form-control name-text second_step_cls" placeholder="" required>
                                                    <div class="address2_to_err" style="display:none"></div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label> Company (Optional)</label>
                                                    <input type="text" name="company_name_to" id="company_name_to" class="form-control name-text" placeholder="">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Country/Territory</label>
                                                    <?php echo fillCombo_frontend('countries_master', 'id', 'name', '', 'status = 1', 'id', 'form-control form-control-new', 'country_to', 'country_to'); ?>
                                                    <div class="country_to_err" style="display:none"></div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="col-sm-12">
                                                    <label>State</label>
                                                    <?php echo fillCombo_frontend('states_master', 'id', 'name', '', 'country_id=' . $profile_details['country'], 'id', 'form-control form-control-new', 'state_to', 'state_to'); ?>
                                                    <div class="state_to_err" style="display:none"></div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="col-sm-12">
                                                    <label>City</label>
                                                    <?php echo fillCombo_frontend('cities_master', 'id', 'name', '', 'state_id=' . $profile_details['state'], 'id', 'form-control form-control-new', 'city_to', 'city_to'); ?>
                                                    <div class="city_to_err" style="display:none"></div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="col-sm-12">
                                                    <label>Zip code</label>
                                                    <input type="text" name="zip_to" id="zip_to" class="form-control info-text second_step_cls" placeholder="">
                                                    <div class="zip_to_err" style="display:none"></div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email_to" id="email_to" class="form-control name-text second_step_cls" placeholder="" required>
                                                    <div class="email_to_err" style="display:none"></div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label>Phone no </label>
                                                    <input type="tel" name="telephone_to[]" id="telephone_to" class="form-control name-text second_step_cls" placeholder="" required>
                                                    <div class="telephone_to_err" style="display:none"></div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <input type="button" name="add_more_tel_btn" id="add_more_tel_btn" class="action-button add" value="Add More">
                                                </div>

                                                <div id="add_more_tel"></div>

                                                <div class="col-sm-12">
                                                    <label>Address Type</label>
                                                    <div class="spacer"></div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="address_type" id="inlineRadio1_to" value="0" selected>
                                                        <label class="form-check-label" for="inlineRadio1_to">Home Address</label>
                                                    </div>
                                                    <div class="address_type_err" style="display:none"></div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="address_type" id="inlineRadio2_to" value="1">
                                                        <label class="form-check-label" for="inlineRadio2_to">Business user</label>
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
                                <input type="button" name="Back" class="Back action-button-Back" value="Back" />
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
                                                <input class="form-check-input" type="radio" name="shipment_type_option" id="watch-me" value="1" checked>
                                                <label class="form-check-label" for="inlineRadio1">For Document</label>
                                            </div>
                                            <div class="form-check form-check-inline" id="package_option">
                                                <input class="form-check-input look-me" type="radio" name="shipment_type_option" id="look-me1" value="2">
                                                <label class="form-check-label" for="inlineRadio2">For Package</label>
                                            </div>
                                            <!--++++++++++++++++++++++++++top-toggle-redio-end+++++++-->

                                        </div>

                                        <div class="spacer"></div>
                                        <!--+++++++++++++++++++++++++++++++for-documents-->
                                        <div id="show-me">
                                            <div class="document-wrap" id="document_wrap">
                                               <!-- <h2 class="ds-title gap" style=" margin-bottom: 30px; margin-top: -15px;">Documents in your shipment.</h2>-->
                                                <div class="spacer"></div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <?php echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', '', 'type= 1', 'cat_id', 'form-control form-control-new', 'document_category[]', 'document_category'); ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <select class="form-control form-control-new" id="document_item" name="document_item[]">
                                                            <option>Selet Category First</option>
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
                                                <div class="col-sm-6 no-gap-left">
                                                    <div class="form-group ">
                                                        <div class="input-group">
                                                            <div class="input-group-addon no-back">
                                                                <i class="fa fa fa-usd"></i>
                                                            </div>
                                                            <input class="form-control" id="value_of_shipment_document" name="value_of_shipment_document[]" type="number" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 no-gap-left">
                                                    <div class="form-check" style="margin-top: -11px;">
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
                                                <div class="col-md-12 col-sm-12">
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
                                                                    <label class="form-check-label" for="ship_document" style="top: 0px!important;">By Ship: <span id="ship_document_span"></span></label>
                                                                    </input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 no-gap">
                                                    <!--<a href="javascript:void(0);" class="btn btn-success btn-add-more" id="add_more_doc">Add More</a>-->
                                                    <button type="button" class="btn btn-success" onclick="addBtn()"> Add More</button>
                                                </div>
                                            </div>
                                            <!--=============-->
                                        </div>
                                        <!--+++++++++++++++++++++++++++++++for-documents-->
                                        <!--+++++++++++++++++++++++++++++++For Package-->
                                        <div id="show-me-three" style="display:none;">
                                            <div class="shipment-wrap">
                                                <!--left-->
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <?php echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', '', 'type= 2', 'cat_id', 'form-control form-control-new', 'package_category[]', 'package_category'); ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <select class="form-control form-control-new" id="package_item" name="package_item[]">
                                                            <option>Selet Category First</option>
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
                                                            <input class="form-control" id="value_of_shipment_parcel" name="value_of_shipment_parcel[]" type="number" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--left-end-->
                                                <!--right-->
                                                <div class="col-sm-6">
                                                    <label>Reference</label>
                                                    <input class="form-control" type="text" id="referance_parcel" name="referance_parcel[]" placeholder="Reference">
                                                    <div class="spacer" style="height: 70px;"></div>
                                                    <div class="form-check" style="padding-left: 0 !important;">
                                                        <input class="form-check-input" type="checkbox" name="protect_parcel[]" id="protect_parcel" value="2">
                                                        <label class="form-check-label" for="protect_parcel" style="top: 0px!important;">
                                                            Protect your shipment
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--right-end-->
                                                <!--+++++++++++++++++++++++++++--------+++++++++++++-->
                                                <!--+++++++++++++++++++++++++++sec+++++++++++++-->
                                                <!--+++++++++++++++++++++++++++--------+++++++++++++-->
                                                <div class="spacer"></div>
                                                <div class="col-sm-12 no-gap">
                                                    <!-- <h2 class="ds-title"> Document’s packaging</h2>
                                                <div class="spacer"></div> -->
                                                    <!--+++++++++++++++++++++-->
                                                    <!--+++++++++++++++++++++-->
                                                    <div class="col-sm-6 no-gap">
                                                        <div class="spacer"></div>
                                                        <!-- <label for="">Packaging type</label>
                                                   <select class="form-control" id="">
                                                      <option>type 1</option>
                                                      <option>type 2</option>
                                                      <option>type 3</option>
                                                      <option>type 4</option>
                                                      <option>type 5</option>
                                                   </select> -->
                                                        <div class="spacer"></div>
                                                        <h2 class="ds-title gap">Dimension</h2>
                                                       <!-- <label for="dimension">Dimension</label>-->
                                                        <div class="spacer-gap"></div>
                                                        <label for="length">Length</label>
                                                        <div class="form-group">
                                                            <div class="col-sm-9 no-gap">
                                                                <input class="form-control" type="text" id="length" name="length[]" placeholder="Length">
                                                            </div>
                                                            <div class="col-sm-3 no-gap2">
                                                                <select class="form-control" id="length_dimen" name="length_dimen[]">
                                                                    <option value="cm">cm</option>
                                                                    <option value="inc">inc</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="spacer"></div>
                                                        <label for="height">Height</label>
                                                        <div class="form-group">
                                                            <div class="col-sm-9 no-gap">
                                                                <input class="form-control" type="text" id="height" name="height[]" placeholder="Height">
                                                            </div>
                                                            <div class="col-sm-3 no-gap2">
                                                                <select class="form-control" id="height_dimen" name="height_dimen[]">
                                                                    <option value="cm">cm</option>
                                                                    <option value="inc">inc</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="spacer"></div>
                                                        <label for="weight">Weight</label>
                                                        <div class="form-group">
                                                            <div class="col-sm-9 no-gap">
                                                                <input class="form-control" type="text" id="weight" name="weight[]" placeholder="Weight">
                                                            </div>
                                                            <div class="col-sm-3 no-gap2">
                                                                <select class="form-control" id="weight_dimen" name="weight_dimen[]">
                                                                    <option value="pound">pound</option>
                                                                    <option value="kg">kg</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--+++++++++++++++++++++-->
                                                    <!--+++++++++++++++++++++-->
                                                    <div class="col-sm-6">
                                                        <div class=" spacer-gap" style="height: 83px;"></div>
                                                        <label>Quantity</label>
                                                        <input class="form-control" type="text" id="quantity" name="quantity[]" placeholder="Quantity">
                                                        <div class="spacer"></div>
                                                        <label for="weight">Breadth</label>
                                                        <div class="form-group">
                                                            <div class="col-sm-9 no-gap">
                                                                <input class="form-control" type="text" id="breadth" name="breadth[]" placeholder="Breadth">
                                                            </div>
                                                            <div class="col-sm-3 no-gap2">
                                                                <select class="form-control" id="breadth_dimen" name="breadth_dimen[]">
                                                                    <option value="cm">cm</option>
                                                                    <option value="inc">inc</option>
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
                                            <div class="row" id="parcel_charges_row">
                                                <div class="col-md-12 col-sm-12">
                                                    <h2 class="ds-title gap" style=" margin-bottom: 30px; ">Your Charges</h2>
                                                </div>
                                                <div class="col-md-8 col-sm-12">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input rate_checkbox" id="road_parcel" name="road_parcel" type="radio" value="1">
                                                                    <input type="hidden" name="road_parcel_input" id="road_parcel_input" value="">
                                                                    <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Road: <span id="road_parcel_span"></span></label>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input rate_checkbox" id="rail_parcel" name="rail_parcel" type="radio" value="2">
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
                                                                    <input class="form-check-input rate_checkbox" id="air_parcel" name="air_parcel" type="radio" value="3">
                                                                    <input type="hidden" name="air_parcel_input" id="air_parcel_input" value="">
                                                                    <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Air: <span id="air_parcel_span"></span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input rate_checkbox" id="ship_parcel" name="ship_parcel" type="radio" value="4">
                                                                    <input type="hidden" name="ship_parcel_input" id="ship_parcel_input" value="">
                                                                    <label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Ship: <span id="ship_parcel_span"></span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!--- New Modifications Starts --->
                                            <div class="spacer"></div>
                                            <div class="col-sm-12 no-gap">
                                                <button type="button" class="btn btn-success" onclick="addBtn()"> Add More </button>
                                            </div>
                                            <div class="spacer"></div>
                                            <div class="gra-line"></div>
                                            <div class="spacer"></div>
                                            <!--- New Modifications Ends --->



                                            <!--=============-->
                                        </div>
                                        <!--+++++++++++++++++++++++++++++++For Package-->
                                    </div>
                                    <p></p>

                                    <div class="div-add-more"></div>


                                </div>
                                <input type="button" name="next" data-next="form_3" class="next action-button" value="next" />
                                <input type="submit" name="add_quote" class="action-button" value="Get Quote" />
                                <!-- <input type="button" name="skip" class="next action-button edit2" value="Skip" /> -->
                                <input type="button" name="Back" class="Back action-button-Back" value="Back" />
                            </fieldset>
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
                                            <p class="ds-title-new"><strong>General</strong> <a href="#" class="add-more"><i class="fas fa-edit"></i></a></p>
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
                                            <p class="ds-title-new"><strong>Location:</strong> <a href="#" class="add-more"><i class="fas fa-edit"></i></a></p>
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
                                            <p class="ds-title-new"><strong>Parcel Details:</strong> <a href="#" class="add-more"><i class="fas fa-edit"></i></a></p>
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
                                                    <input type="hidden" id="quote_type" name="quote_type" value="0">
                                                    <input type="radio" class="form-check-input" name="payment_mode" value="1"> Pay Later
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label big">
                                                    <input type="radio" class="form-check-input" name="payment_mode" value="2" checked>
                                                    Credit / debit /atm Card
                                                    <i class="fa  fa-credit-card fa-1x "></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label big">
                                                    <input type="radio" class="form-check-input" name="payment_mode" value="3"> Cash on Delivery
                                                    <i class="fa  fa-usd fa-1x "></i>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" data-next="form_4" class="next action-button submit create-order" value="Create Order" />
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

<!--<script id="script1"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- <script src="<?php echo base_url(); ?>assets/frontend/js/home.js" type="text/javascript"></script> -->
<script>
    $(document).ready(function() {

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

                //alert(firstname);
                if (firstname == '') {
                    $("#firstname").css('outline', '1px solid red');
                    $("#firstname111").html('<font color="red">Pleae enter your first name.</font>');
                    $("#firstname111").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $("#firstname").css('outline', '#ccc');
                    $("#firstname111").html('');
                    $("#firstname111").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (lastname == '') {
                    $(".lastname").css('outline', '1px solid red');
                    $(".lastname_from_err").html('<font color="red">Pleae enter your last name.</font>');
                    $(".lastname_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".lastname").css('outline', '#ccc');
                    $(".lastname_from_err").html('');
                    $(".lastname_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (address_from == '') {
                    //$(".address_from").css('outline', '1px solid red');
                    $(".address_from_err").html('<font color="red">Pleae enter your address.</font>');
                    $(".address_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    //$(".address_from").css('outline', '#ccc');
                    $(".address_from_err").html('');
                    $(".address_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (address2 == '') {
                    $(".address2").css('outline', '1px solid red');
                    $(".address2_to_err").html('<font color="red">Pleae enter your address.</font>');
                    $(".address2_to_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".address2").css('outline', '#ccc');
                    $(".address2_to_err").html('');
                    $(".fname_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (country == '') {
                    $("#country").css('outline', '1px solid red');
                    $(".country_from_err").html('<font color="red">Pleae enter your country.</font>');
                    $(".country_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".country_from_err").html('');
                    $(".country_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (state == '') {
                    $(".state_from_err").html('<font color="red">Pleae enter your state.</font>');
                    $(".state_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".state_from_err").html('');
                    $(".state_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (city == '') {
                    $(".city_from_err").html('<font color="red">Pleae enter your city.</font>');
                    $(".city_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".city_from_err").html('');
                    $(".city_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (zip == '') {
                    $(".zip_from_err").html('<font color="red">Pleae enter your zip.</font>');
                    $(".zip_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".city_from_err").html('');
                    $(".city_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (email == '') {
                    $(".email_from_err").html('<font color="red">Pleae enter your email.</font>');
                    $(".email_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".email_from_err").html('');
                    $(".email_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                if (telephone == '') {
                    $(".telephone_from_err").html('<font color="red">Pleae enter your telephone.</font>');
                    $(".telephone_from_err").show();
                    //$('#second_step').prop('disabled', true);
                } else {
                    $(".telephone_from_err").html('');
                    $(".telephone_from_err").hide();
                    //$('#second_step').prop('disabled', false);
                }

                var firstname_to = $("input[name=firstname_to]").val();
                var lastname_to = $("input[name=lastname_to]").val();
                var address_to = $("input[name=address_to]").val();
                var address2_to = $("input[name=address2_to]").val();
                var zip_to = $("input[name=zip_to]").val();
                var email_to = $("input[name=email_to]").val();
                var telephone_to = $("#telephone_to").val();
                var country_to = $("input[name=country_to]").val();
                var state_to = $("input[name=state_to]").val();
                var city_to = $("input[name=city_to]").val();

                if (firstname_to == '') {
                    $(".firstname_to_err").html('<font color="red">Pleae enter your first name.</font>');
                    $(".firstname_to_err").show();
                } else {
                    $(".firstname_to_err").html('');
                    $(".firstname_to_err").hide();
                }

                if (lastname_to == '') {
                    $(".lastname_to_err").html('<font color="red">Pleae enter your last name.</font>');
                    $(".lastname_to_err").show();
                } else {
                    $(".lastname_to_err").html('');
                    $(".lastname_to_err").hide();
                }

                if (address_to == '') {
                    $(".address_to_err").html('<font color="red">Pleae enter your address.</font>');
                    $(".address_to_err").show();
                } else {
                    $(".address_to_err").html('');
                    $(".address_to_err").hide();
                }

                if (address2_to == '') {
                    $(".address2_to_err").html('<font color="red">Pleae enter your address.</font>');
                    $(".address2_to_err").show();
                } else {
                    $(".address2_to_err").html('');
                    $(".address2_to_err").hide();
                }

                if (zip_to == '') {
                    $(".zip_to_err").html('<font color="red">Pleae enter your zip.</font>');
                    $(".zip_to_err").show();
                } else {
                    $(".zip_to_err").html('');
                    $(".zip_to_err").hide();
                }

                if (email_to == '') {
                    $(".email_to_err").html('<font color="red">Pleae enter your email.</font>');
                    $(".email_to_err").show();
                } else {
                    $(".email_to_err").html('');
                    $(".email_to_err").hide();
                }

                if (telephone_to == '') {
                    $(".telephone_to_err").html('<font color="red">Pleae enter your telephone.</font>');
                    $(".telephone_to_err").show();
                } else {
                    $(".telephone_to_err").html('');
                    $(".telephone_to_err").hide();
                }

                if (country_to == '') {
                    $("#country").css('outline', '1px solid red');
                    $(".country_to_err").html('<font color="red">Pleae enter your country.</font>');
                    $(".country_to_err").show();
                } else {
                    $(".country_to_err").html('');
                    $(".country_to_err").hide();
                }

                if (state_to == '') {
                    $("#state_to").css('outline', '1px solid red');
                    $(".state_to_err").html('<font color="red">Pleae enter your state.</font>');
                    $(".state_to_err").show();
                } else {
                    $(".state_to_err").html('');
                    $(".state_to_err").hide();
                }

                if (city_to == '') {
                    $("#city_to").css('outline', '1px solid red');
                    $(".city_to_err").html('<font color="red">Pleae enter your city.</font>');
                    $(".city_to_err").show();
                } else {
                    $(".city_to_err").html('');
                    $(".city_to_err").hide();
                }

                if (firstname != '' && lastname != '' && address_from != '' && address2 != '' && country != '' && state != '' && city != '' && zip != '' && email != '' && telephone != '' && firstname_to != '' && lastname_to != '' && address_to != '' && address2_to != '' && zip_to != '' && email_to != '' && telephone_to != '' && country_to != '' && state_to != '' && city_to != '') {
                    gotonext = 1;
                    //$('#second_step').prop('disabled', false);
                } else {
                    gotonext = 2;
                    //$('#second_step').prop('disabled', true);
                }

            } else if (nextbtnval == 'form_1' || nextbtnval == 'form_3') {
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
        });

        $(".Back").click(function() {
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
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar").css("width", percent + "%")
        }
        $(".submit").click(function() {
            return false;
        })

        $("#watch-me").click(function() {
            $("#show-me:hidden").show('slow');
            $("#show-me-two").hide();
            $("#show-me-three").hide();
        });

        $("#watch-me").click(function() {
            if ($('watch-me').prop('checked') === false) {
                $('#show-me').hide();
            }
        });

        $("#see-me").click(function() {
            $("#show-me-two:hidden").show('slow');
            $("#show-me").hide();
            $("#show-me-three").hide();
        });

        $("#see-me").click(function() {
            if ($('see-me-two').prop('checked') === false) {
                $('#show-me-two').hide();
            }
        });

        //** Loading the for package for first time First **//
        $(".look-me").click(function() {

            $("#show-me-three:hidden").show('slow');
            $("#show-me").hide();
            $("#show-me-two").hide();
        });

        $("#look-me").click(function() {
            if ($('see-me-three').prop('checked') === false) {
                $('#show-me-three').hide();
            }
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

            if (categoryID) {
                $.ajax({
                    dataType: "json",
                    type: "post",
                    url: '<?php echo base_url('getDocumentCategory'); ?>',
                    data: {
                        [csrfName]: csrfHash,
                        category_id: categoryID
                    },
                    success: function(data) {
                        $('#document_item').html('<option value="">Select Item</option>');
                        var string1 = JSON.stringify(data);
                        var dataObj = JSON.parse(string1);
                        var resultKeyCount = Object.keys(dataObj).length;
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
                    }
                });
            } else {
                $('#document_item').html('<option value="">Select Category first</option>');
            }
        });

        $('#package_category').on('change', function() {
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    dataType: "json",
                    type: "post",
                    url: '<?php echo base_url('getPackageCategory'); ?>',
                    data: {
                        [csrfName]: csrfHash,
                        category_id: categoryID
                    },
                    success: function(data) {
                        $('#package_item').html('<option value="">Select Item</option>');
                        var string1 = JSON.stringify(data);
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
                $('#document_charges_row').slideUp(500);
            } else {
                $('#document_other').prop('checked', false);
                $('#document_other_row').slideUp(500);
                $('#document_charges_row').slideDown(500);
            }
        });

        $('#package_item').on('change', function() {
            var document_item_val = $(this).val();
            if (document_item_val < 1) {
                $('#parcel_other').prop('checked', true);
                $('#parcel_other_row').slideDown(500);
                $('#parcel_charges_row').slideUp(500);
            } else {
                $('#parcel_other').prop('checked', false);
                $('#parcel_other_row').slideUp(500);
                $('#parcel_charges_row').slideDown(500);
            }
        });


        $('#add_more_tel_btn').click(function() {
            var html = '<div><div class="col-sm-9"> <label>Phone no </label> <input type="tel" name="telephone_to[]" id="telephone_to" class="form-control name-text" placeholder="" required></div><div class="col-sm-3"><input type="button" name="remove_tel_btn" id="remove_tel_btn" class="remove_tel_btn action-button add" value="Remove"></div></div>';
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
            } else {
                $('#details_of_pack').slideUp(500);
            }
        });

        $('.create-order').on('click', function() {
            $('#quote_type').val("1");
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
            if (ship_cat_id == 1) {
                var ship_subcat_id = $('#document_category').val();
            } else {
                var ship_subcat_id = $('#package_category').val();
            }
            var rate_type = 'L';
            var location_from = $('#state').val();
            var location_to = $('#state_to').val();

            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getShipmentChanges'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    ship_cat_id: ship_cat_id,
                    ship_subcat_id: ship_subcat_id,
                    rate_type: rate_type,
                    location_from: location_from,
                    location_to: location_to
                },
                success: function(data) {
                    var string1 = JSON.stringify(data);
                    var dataObj = JSON.parse(string1);
                    $(dataObj).each(function() {
                        //console.log(dataObj[0]['ship_mode_id']);
                        if (ship_cat_id == 1) {
                            if (this.ship_mode_id == 1) {
                                $('#road_document_input').val(this.rate);
                                $('#road_document_span').text(this.rate);
                            } else if (this.ship_mode_id == 2) {
                                $('#rail_document_input').val(this.rate);
                                $('#rail_document_span').text(this.rate);
                            } else if (this.ship_mode_id == 3) {
                                $('#air_document_input').val(his.rate);
                                $('#air_document_span').text(this.rate);
                            } else {
                                $('#ship_document_input').val(this.rate);
                                $('#ship_document_span').text(this.rate);
                            }
                        } else {
                            if (this.ship_mode_id == 1) {
                                $('#road_parcel_input').val(this.rate);
                                $('#road_parcel_span').text(this.rate);
                            } else if (this.ship_mode_id == 2) {
                                $('#rail_parcel_input').val(this.rate);
                                $('#rail_parcel_span').text(this.rate);
                            } else if (this.ship_mode_id == 3) {
                                $('#air_parcel_input').val(this.rate);
                                $('#air_parcel_span').text(this.rate);
                            } else {
                                $('#ship_parcel_input').val(this.rate);
                                $('#ship_parcel_span').text(this.rate);
                            }
                        }
                    });

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

        var newID = randString(4);

        var html = '';
        html += '<div id=\'' + newID + '\'><div class="spacer"></div>';

        html += '<div style=" padding-left: 30px;"><div class="form-check form-check-inline document_option' + getCookie('docpackcount') + '" id="document_option' + newID + '">';

        html += '<input class="form-check-input" type="hidden" name="ids[]" value="' + newID + '" >';

        html += '<input class="form-check-input shipment_type_option" type="radio" name="shipment_type_option_' + newID + '" id="shipment_type_option_m_' + newID + '" data-newid="' + newID + '" value="1" checked>';

        html += '<label class="form-check-label" for="inlineRadio1">For Document</label></div>';
		

        html += '<div class="form-check form-check-inline" id="package_option' + newID + '">';

        html += '<input class="form-check-input shipment_type_option" type="radio" name="shipment_type_option_' + newID + '" id="shipment_type_option_m_' + newID + '" data-newid="' + newID + '" value="2">';

        html += '<label class="form-check-label" for="inlineRadio2">For Package</label></div></div>';


        html += '<div class="spacer"></div><div id="show_me_document_' + newID + '"><div class="document-wrap" id="document_wrap"><div class="spacer"></div><div class="row"><div class="col-md-6 col-sm-12">';

        html += '<?php echo fillCombo_frontend("document_package_categories", "cat_id", "category_name", "", "type= 1", "cat_id", "form-control form-control-new get_document_category", "document_category[]", "document_category_'+newID+'", "", "data-newid3", "'+newID+'"); ?>';

        html += ' </div><div class="col-md-6 col-sm-12"><select class="form-control form-control-new get_document_item" id="document_item' + newID + '" name="document_item[]" data-newid-di="' + newID + '"><option>Selet Category First</option></select></div></div>  <div class="row" id="document_other_row' + newID + '" style="display:none;"><div class="col-md-6 col-sm-12"><div class="form-check form-check-inline"><input class="form-check-input" id="document_other' + newID + '" name="document_other[]" type="radio" value="1"><label class="form-check-label" for="document_other">Other Category</label></input></div></div><div class="col-md-6 col-sm-12"><textarea class="form-control" id="other_details_document' + newID + '" name="other_details_document[]" rows="2"></textarea></div></div><div class="col-sm-12 no-gap"><h3 class="titelt">Value of your shipment</h3></div><div class="col-sm-6"><div class="form-group "><div class="input-group"><div class="input-group-addon no-back"><i class="fa fa fa-usd"></i></div><input class="form-control" id="value_of_shipment_document' + newID + '" name="value_of_shipment_document[]" type="number" /></div></div></div><div class="col-sm-6"><div class="form-check"><input class="form-check-input" type="checkbox" value="1" id="protect_shipment_document" name="protect_shipment_document[]"><label class="form-check-label" for="protect_shipment_document" style="top: 0px!important;">Protect your shipment</label></div></div></div> <div class="spacer"></div><div class="col-sm-12"></div><div class="spacer"></div><div class="gra-line"></div><div class="spacer"></div><div id="add_document_div' + newID + '"></div><div class="col-sm-6">&nbsp;</div><div class="row" id="document_charges_row' + newID + '" style="display:none;"><div class="col-md-12 col-sm-12"><h2 class="ds-title gap" style=" margin-bottom: 30px; ">Your Charges</h2></div><div class="col-md-8 col-sm-12"><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="road_document' + newID + '" name="charges_by_' + newID + '" type="radio" value="1" data-newid-rc = "' + newID + '"><input type="hidden" name="road_document_input_' + newID + '" id="road_document_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Road: <span id="road_document_span' + newID + '"></span></label></input></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="rail_document' + newID + '" name="charges_by_' + newID + '" type="radio" value="2" data-newid-rc = "' + newID + '"><input type="hidden" name="rail_document_input_' + newID + '" id="rail_document_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Rail: <span id="rail_document_span' + newID + '"></span></label></input></div></div></div></div><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="air_document' + newID + '" name="charges_by_' + newID + '" type="radio" value="3"  data-newid-rc = "' + newID + '"><input type="hidden" name="air_document_input_' + newID + '" id="air_document_input' + newID + '" value=""><label class="form-check-label" for="air_document" style="top: 0px!important;">By Air: <span id="air_document_span' + newID + '"></span></label></input></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="ship_document" name="charges_by_' + newID + '" type="radio" value="4" data-newid-rc = "' + newID + '"><input type="hidden" name="ship_document_input_' + newID + '" id="ship_document_input' + newID + '" value=""><label class="form-check-label" for="ship_document" style="top: 0px!important;">By Ship: <span id="ship_document_span"></span></label></input></div></div></div></div></div></div></div>';

        html += '<div id="show_me_package_' + newID + '" style="display:none;"><div class="shipment-wrap"><div class="row"><div class="col-md-6 col-sm-12">';

        html += '<?php echo fillCombo_frontend("document_package_categories", "cat_id", "category_name", "", "type= 2", "cat_id", "form-control form-control-new get_package_category", "package_category[]", "package_category_'+newID+'", "", "data-newid4", "'+newID+'"); ?>';

        html += '</div><div class="col-md-6 col-sm-12"><select class="form-control form-control-new get_package_item" id="package_item' + newID + '" name="package_item[]" data-newid-pi="' + newID + '"><option>Selet Category First</option></select></div></div>  <div class="row" id="parcel_other_row' + newID + '" style="display:none;"><div class="col-md-6 col-sm-12"><div class="form-check form-check-inline"><input class="form-check-input" id="parcel_other' + newID + '" name="parcel_other_' + newID + '[]" type="radio" value="2"><label class="form-check-label" for="parcel_other">Other Category</label></input></div></div><div class="col-md-6 col-sm-12"><textarea class="form-control" id="other_details_parcel' + newID + '" name="other_details_parcel[]" rows="2"></textarea></div></div><div class="col-sm-6 no-gap-left"><label for="">Describe your shipment.</label><textarea class="form-control" id="shipment_description_parcel' + newID + '" name="shipment_description_parcel[]" aria-label="With textarea"></textarea><div class="spacer"></div><label for="">Value of your shipment</label><div class="form-group"><div class="input-group"><div class="input-group-addon no-back"><i class="fa fa fa-usd"></i></div><input class="form-control" id="value_of_shipment_parcel" name="value_of_shipment_parcel[]" type="number" /></div></div></div><div class="col-sm-6"><label>Reference</label><input class="form-control" type="text" id="referance_parcel' + newID + '" name="referance_parcel[]" placeholder="Referance"><div class="spacer"></div><div class="form-check"><input class="form-check-input" type="checkbox" name="protect_parcel[]" id="protect_parcel' + newID + '" value="2"><label class="form-check-label" for="protect_parcel" style="top: 0px!important;">Protect your shipment</label></div></div><div class="spacer"></div><div class="col-sm-12 no-gap"><h2 class="ds-title"> Document’s packaging</h2><div class="spacer"></div> <div class="col-sm-6"><div class="spacer"></div> <label for="">Packaging type</label><select class="form-control" id=""><option>type 1</option><option>type 2</option><option>type 3</option><option>type 4</option><option>type 5</option></select><div class="spacer-gap"></div><h2 class="ds-title gap">Dimension</h2><div class="spacer-gap"></div><label for="length">Length</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="length' + newID + '" name="length[]" placeholder="Length"></div><div class="col-sm-3 no-gap2"><select class="form-control" id="length_dimen' + newID + '" name="length_dimen[]"><option value="cm">cm</option><option value="inc">inc</option></select></div></div><div class="spacer"></div><label for="height">Height</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="height' + newID + '" name="height[]" placeholder="Height"></div><div class="col-sm-3 no-gap2"><select class="form-control" id="height_dimen" name="height_dimen[]"><option value="cm">cm</option><option value="inc">inc</option></select></div></div><div class="spacer"></div><label for="weight">Weight</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="weight' + newID + '" name="weight[]" placeholder="Weight"></div><div class="col-sm-3 no-gap2"><select class="form-control" id="weight_dimen' + newID + '" name="weight_dimen[]"><option value="pound">pound</option><option value="kg">kg</option></select></div></div></div><div class="col-sm-6"><label>Quantity</label><input class="form-control" type="text" id="quantity" name="quantity[]" placeholder="Quantity"><div class="spacer" style="height: 101px;"></div><label for="weight">Breadth</label><div class="form-group"><div class="col-sm-9 no-gap"><input class="form-control" type="text" id="breadth' + newID + '" name="breadth[]" placeholder="Breadth"></div><div class="col-sm-3 no-gap2"><select class="form-control" id="breadth_dimen' + newID + '" name="breadth_dimen[]"><option value="cm">cm</option><option value="inc">inc</option></select></div></div></div></div></div><div class="spacer"></div><div class="col-sm-12"> </div><div class="spacer"></div><div class="gra-line"></div><div class="spacer"></div><div class="col-sm-6">&nbsp;</div><div class="row" id="parcel_charges_row' + newID + '"><div class="col-md-12 col-sm-12"><h2 class="ds-title gap" style=" margin-bottom: 30px; ">Your Charges</h2></div><div class="col-md-8 col-sm-12"><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="road_parcel' + newID + '" name="road_parcel_' + newID + '" type="radio" value="1"  data-newid-rc = "' + newID + '"><input type="hidden" name="road_parcel_input_' + newID + '" id="road_parcel_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Road: <span id="road_parcel_span' + newID + '"></span></label></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="rail_parcel' + newID + '" name="rail_parcel_' + newID + '" type="radio" value="2" data-newid-rc = "' + newID + '"><input type="hidden" name="rail_parcel_input_' + newID + '" id="rail_parcel_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Rail: <span id="rail_parcel_span"></span></label></div></div></div></div><div class="container"><div class="row"><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="air_parcel' + newID + '" name="air_parcel_' + newID + '" type="radio" value="3" data-newid-rc = "' + newID + '"><input type="hidden" name="air_parcel_input_' + newID + '" id="air_parcel_input' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Air: <span id="air_parcel_span"></span></label></div></div><div class="col-md-6 col-sm-4"><div class="form-check"><input class="form-check-input get_rate_checkbox" id="ship_parcel' + newID + '" name="ship_parcel_' + newID + '" type="radio" value="4" data-newid-rc = "' + newID + '"><input type="hidden" name="ship_parcel_input_' + newID + '" id="ship_parcel_input_' + newID + '" value=""><label class="form-check-label" for="defaultCheck1" style="top: 0px!important;">By Ship: <span id="ship_parcel_span' + newID + '"></span></label></div></div></div></div></div></div></div>';

        html += '<div class="col-sm-12 no-gap"><button type="button" class="btn btn-success" onclick="addBtn()" > Add More </button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick="removeBtn(\'' + newID + '\')" > Remove </button></div></div>';

        $(".div-add-more").append(html);
    }

    function removeBtn(newID) {

        $("#" + newID).remove();
    }

    //var newID = randString(4);

    $(document).on('change', '.shipment_type_option', function() {
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
        //console.log('newid_3:'+newid_3);

        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var categoryID = $(this).val();

        if (categoryID) {
            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getDocumentCategory'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    category_id: categoryID
                },
                success: function(data) {
                    $('#document_item' + newid_3).html('<option value="">Select Item</option>');
                    var string1 = JSON.stringify(data);
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
                }
            });
        } else {
            $('#document_item' + newid_3).html('<option value="">Select Category first</option>');
        }
    });

    $(document).on('change', '.get_package_category', function() {
        var newid4 = $(this).attr('data-newid4');

        console.log('newid_3:' + newid4);
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var categoryID = $(this).val();
        if (categoryID) {
            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getPackageCategory'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    category_id: categoryID
                },
                success: function(data) {
                    $('#package_item' + newid4).html('<option value="">Select Item</option>');
                    var string1 = JSON.stringify(data);
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
                }
            });
        } else {
            $('#package_item' + newid4).html('<option value="">Select Category first</option>');
        }
    });

    $(document).on('change', '.get_document_item', function() {
        var newid1 = $(this).attr('data-newid-di');
        var document_item_val = $(this).val();
        if (document_item_val < 1) {
            $('#document_other' + newid1).prop('checked', true);
            $('#document_other_row' + newid1).slideDown(500);
            $('#document_charges_row' + newid1).slideUp(500);
        } else {
            $('#document_other' + newid1).prop('checked', false);
            $('#document_other_row' + newid1).slideUp(500);
            $('#document_charges_row' + newid1).slideDown(500);
        }
    });

    $(document).on('change', '.get_package_item', function() {
        var newid1 = $(this).attr('data-newid-pi');
        var document_item_val = $(this).val();
        if (document_item_val < 1) {
            $('#parcel_other' + newid1).prop('checked', true);
            $('#parcel_other_row' + newid1).slideDown(500);
            $('#parcel_charges_row' + newid1).slideUp(500);
        } else {
            $('#parcel_other' + newid1).prop('checked', false);
            $('#parcel_other_row' + newid1).slideUp(500);
            $('#parcel_charges_row' + newid1).slideDown(500);
        }
    });

    $(document).on('change', '.get_rate_checkbox', function() {

        var newid1 = $(this).attr('data-newid-rc');
        if ($(this).val() > 0) {
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var ship_cat_id = $('input[name="shipment_type_option_' + newid1 + '"]:checked').val();

            if (ship_cat_id == 1) {
                var ship_subcat_id = $('#document_category_' + newid1).val();
            } else {
                var ship_subcat_id = $('#package_category_' + newid1).val();
            }
            var rate_type = 'L';
            var location_from = $('#state').val();
            var location_to = $('#state_to').val();


            //console.log(ship_subcat_id, rate_type, location_from, location_to);
            $.ajax({
                dataType: "json",
                type: "post",
                url: '<?php echo base_url('getShipmentChanges'); ?>',
                data: {
                    [csrfName]: csrfHash,
                    ship_cat_id: ship_cat_id,
                    ship_subcat_id: ship_subcat_id,
                    rate_type: rate_type,
                    location_from: location_from,
                    location_to: location_to
                },
                success: function(data) {
                    var string1 = JSON.stringify(data);
                    var dataObj = JSON.parse(string1);
                    $(dataObj).each(function() {
                        //console.log(dataObj[0]['ship_mode_id']);
                        if (ship_cat_id == 1) {
                            if (this.ship_mode_id == 1) {
                                $('#road_document_input' + newid1).val(this.rate);
                                $('#road_document_span' + newid1).text(this.rate);
                            } else if (this.ship_mode_id == 2) {
                                $('#rail_document_input' + newid1).val(this.rate);
                                $('#rail_document_span' + newid1).text(this.rate);
                            } else if (this.ship_mode_id == 3) {
                                $('#air_document_input' + newid1).val(his.rate);
                                $('#air_document_span' + newid1).text(this.rate);
                            } else {
                                $('#ship_document_input' + newid1).val(this.rate);
                                $('#ship_document_span' + newid1).text(this.rate);
                            }
                        } else {
                            if (this.ship_mode_id == 1) {
                                $('#road_parcel_input' + newid1).val(this.rate);
                                $('#road_parcel_span' + newid1).text(this.rate);
                            } else if (this.ship_mode_id == 2) {
                                $('#rail_parcel_input' + newid1).val(this.rate);
                                $('#rail_parcel_span' + newid1).text(this.rate);
                            } else if (this.ship_mode_id == 3) {
                                $('#air_parcel_input' + newid1).val(this.rate);
                                $('#air_parcel_span' + newid1).text(this.rate);
                            } else {
                                $('#ship_parcel_input' + newid1).val(this.rate);
                                $('#ship_parcel_span' + newid1).text(this.rate);
                            }
                        }
                    });

                }
            });
        } else {

        }
    });

    $(document).ready(function() {

        //** Loading the for package after add more Second **//
        $(document).on('change', '#shipment_type_option' + getCookie('docpackcount'), function() {

            if ($(this).val() == 1) {
                $('.document_option' + getCookie('docpackcount')).show();
                $('#package_option' + getCookie('docpackcount')).hide();
                $("[name='shipment_type_option" + getCookie('docpackcount') + "'][value='1']").prop('checked', true);

            } else if ($(this).val() == 2) {
                $('#package_option' + getCookie('docpackcount')).show();
                $('.document_option' + getCookie('docpackcount')).hide();
                $("[name='shipment_type_option" + getCookie('docpackcount') + "'][value='2']").prop('checked', true);

            }
        });

    });

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
</script>