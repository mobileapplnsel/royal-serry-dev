<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo '<pre>'; print_r($quote_details); print_r($quote_from_details); print_r($quote_to_details); print_r($quote_item_details);print_r($shipment_details);echo '</pre>';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<?php
    $subtotal   = 0.00;
    $discount   = 0.00;
    $total      = 0.00;
    $qty        = 0;
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php
        $this->load->view('admin/include/sidebar');
    ?>
  <div class="content-wrapper">
    <?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <?= $this->session->flashdata('error'); ?>
    </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <?= $this->session->flashdata('success'); ?>
    </div>
    <?php } ?>
    <section class="content-header">
      <h1> Edit Order </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('admin/order-list') ?>"><i class="fa fa-dashboard"></i> Order List </a></li>
        <li class="active">View Order</li>
      </ol>
    </section>
    <div class="container">
      <div class="col-md-12">
        <h2></h2>
        <div class="box box-primary">
          <div class="box-header with-border"> Edit Order Details</div>
          <div class="box-body">
            <div class="form-group col-md-6 col-md-offset-3"></div>
 			<div class="form-card">

                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <p class="ds-title-new"><strong>Order # :</strong> <?php echo (!empty($shipment_details) && $shipment_details['shipment_no'] != '') ? $shipment_details['shipment_no'] : ''; ?></p>
                        <p class="ds-title-new"><strong>Date : </strong> <?php echo (!empty($quote_details) && $quote_details[0]['created_date'] != '') ? $quote_details[0]['created_date'] : DTIME; ?></p>
                        <!-- <p class="ds-title-new"><strong>Valid Until : </strong> </p>
                        <p class="ds-title-new"><strong>Customer Number : </strong> </p> -->
                    </div>
                    <div class="col-sm-12 col-md-3">&nbsp;</div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6" style="background-color: bisque;pointer-events: none;">
                        <?php
                        if (!empty($quote_from_details)) {
                        ?>
                        <p class="ds-title-new"><strong>Pickup Address :</strong></p>
                        <div class="form-group col-md-6">
                            <label for="email">First Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname" value="<?php echo $quote_from_details[0]['firstname']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Last Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" value="<?php echo $quote_from_details[0]['lastname']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Line1<span>*</span> : </label>
                            <input type="text" class="form-control autocomplete" placeholder="Address Line1" name="address" id="address" value="<?php echo $quote_from_details[0]['address']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Line2 (Optional) : </label>
                            <input type="text" class="form-control" placeholder="Address Line2" name="address2" id="address2" value="<?php echo $quote_from_details[0]['address2']; ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Company (Optional) : </label>
                            <input type="text" class="form-control" placeholder="Company Name" name="company_name" id="company_name" value="<?php echo $quote_from_details[0]['company_name']; ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Country/Territory<span>*</span> : </label>
                            <?php echo fillCombo_frontend('countries_master', 'id', 'name', $quote_from_details[0]['country'], 'status = 1', 'id', 'form-control', 'country', 'country', ''); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">State<span>*</span> : </label>
                            <?php echo fillCombo_frontend('states_master', 'id', 'name', $quote_from_details[0]['state'], 'country_id=' . $quote_from_details[0]['country'], 'id', 'form-control form-control-new', 'state', 'state', ''); ?>
                                            <input type="hidden" name="state_google_val" id="state_google_val" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">City<span>*</span> : </label>
                            <?php echo fillCombo_frontend('cities_master', 'id', 'name', $quote_from_details[0]['city'], 'state_id=' . $quote_from_details[0]['state'], 'id', 'form-control form-control-new', 'city', 'city', ''); ?>
                                            <input type="hidden" name="city_google_val" id="city_google_val" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Zip code<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Zip code" name="zip" id="zip" value="<?php echo $quote_from_details[0]['zip']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Address<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Email Address"  name="email" id="email" value="<?php echo $quote_from_details[0]['email']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Phone no<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Phone no" name="telephone" id="telephone" value="<?php echo $quote_from_details[0]['telephone']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Type<span>*</span> : </label>
                            <select class="form-control" name="user_type" id="user_type" required>
                                <option value="0" <?php echo (($quote_from_details[0]['address_type'] == '0') ? 'selected' : ''); ?>>Home Address</option>
                                <option value="1" <?php echo (($quote_from_details[0]['address_type'] == '1') ? 'selected' : ''); ?>>Business Address</option>
                            </select>
                        </div>

                        <?php
                        }
                        ?>

                    </div>
                    <div class="col-sm-12 col-md-6" style="background-color: darkgray;pointer-events: none;">
                        <?php
                        if (!empty($quote_to_details)) {
							if (strlen($quote_to_details[0]['telephone']) > 25) {
								//$telephone = repairSerializeString($quote_to_details[0]['telephone']);
								//$telephone = unserialize($telephone);
								//print_r($telephone);
								//$telephones = implode(', ', $telephone);
								$telephones = $quote_to_details[0]['telephone'];
							} else {
								$telephones = $quote_to_details[0]['telephone'];
							}


                        ?>
                            <p class="ds-title-new"><strong>Delivery Address :</strong></p>
                            <!-- <p class="ds-title-new">Item Description: <?php echo $quote_to_details[0]['order_created']; ?></p> -->
                            <div class="form-group col-md-6">
                                <label for="email">First Name<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="First Name" name="firstname_to" id="firstname_to" value="<?php echo $quote_to_details[0]['firstname']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Last Name<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname_to" id="lastname_to" value="<?php echo $quote_to_details[0]['lastname']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Address Line1<span>*</span> : </label>
                                <input type="text" class="form-control autocomplete" placeholder="Address Line1" name="address_to" id="address_to" value="<?php echo $quote_to_details[0]['address']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Address Line2 (Optional) : </label>
                                <input type="text" class="form-control" placeholder="Address Line2" name="address2_to" id="address2_to" value="<?php echo $quote_to_details[0]['address2']; ?>" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Company (Optional) : </label>
                                <input type="text" class="form-control" placeholder="Company Name" name="company_name_to" id="company_name_to" value="<?php echo $quote_to_details[0]['company_name']; ?>" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Country/Territory<span>*</span> : </label>
                                <?php echo fillCombo_frontend('countries_master', 'id', 'name', $quote_to_details[0]['country'], 'status = 1', 'id', 'form-control', 'country_to', 'country_to', ''); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">State<span>*</span> : </label>
                                <?php echo fillCombo_frontend('states_master', 'id', 'name', $quote_to_details[0]['state'], 'country_id=' . $quote_to_details[0]['country'], 'id', 'form-control form-control-new', 'state_to', 'state_to', ''); ?>
                                                <input type="hidden" name="state_to_google_val" id="state_to_google_val" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">City<span>*</span> : </label>
                                <?php echo fillCombo_frontend('cities_master', 'id', 'name', $quote_to_details[0]['city'], 'state_id=' . $quote_to_details[0]['state'], 'id', 'form-control form-control-new', 'city', 'city', ''); ?>
                                                <input type="hidden" name="city_to_google_val" id="city_to_google_val" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Zip code<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Zip code" name="zip_to" id="zip_to" value="<?php echo $quote_to_details[0]['zip']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Email Address"  name="email_to" id="email_to" value="<?php echo $quote_to_details[0]['email']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Phone no<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Phone no" name="telephone_to" id="telephone_to" value="<?php echo $telephones; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Address Type<span>*</span> : </label>
                                <select class="form-control" name="address_type_to" id="address_type_to" required>
                                    <option value="0" <?php echo (($quote_to_details[0]['address_type'] == '0') ? 'selected' : ''); ?>>Home Address</option>
                                    <option value="1" <?php echo (($quote_to_details[0]['address_type'] == '1') ? 'selected' : ''); ?>>Business Address</option>
                                </select>
                            </div>
                            <!-- <p class="ds-title-new">Address: <?php echo $quote_to_details[0]['address']; ?></p>
                            <p class="ds-title-new">Address2: <?php echo $quote_to_details[0]['address2']; ?></p>
                            <p class="ds-title-new">Company: <?php echo $quote_to_details[0]['company_name']; ?></p>
                            <p class="ds-title-new">Country: <?php echo $quote_to_details[0]['country_name']; ?></p>
                            <p class="ds-title-new">City: <?php echo $quote_to_details[0]['city_name']; ?></p>
                            <p class="ds-title-new">State: <?php echo $quote_to_details[0]['state_name']; ?></p>
                            <p class="ds-title-new">Zip Code: <?php echo $quote_to_details[0]['zip']; ?></p>
                            <p class="ds-title-new">Phone No: <?php echo formatPhoneTo($quote_to_details[0]['telephone']); ?></p>
                            <p class="ds-title-new">Address Type : <?php echo ($quote_to_details[0]['address_type'] == 0) ? 'Home' : 'Business'; ?></p> -->
                        <?php
                        }
                        ?>
                    </div>
                </div>

   
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <p class="ds-title-new"><strong>Shipment Type: </strong><?php echo (!empty($quote_details) && $quote_details[0]['shipment_type'] == 1) ? 'Document' : 'Package'; ?></p>


                    </div>
                    <div class="col-sm-12 col-md-4">
                        <p class="ds-title-new"><strong>Parcel Type: </strong><?php echo (!empty($quote_from_details) && $quote_details[0]['shipment_type'] == 1) ? 'Domestic' : 'International'; ?></p>

                    </div>
                    <div class="col-sm-12 col-md-4">
                        <p class="ds-title-new"><strong>Speed Rate: </strong></p>
                        <select class="form-control form-control-new delivery_speed" id="delivery_speed" name="delivery_speed">
                            <?php if (!empty($deliveryModeList)) {
                                foreach ($deliveryModeList as $key => $value) {
                            ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                    </div>

                </div>

                <div class="spacer-gap"></div>

                <div class="row">
                    <div class="col-sm-4">
                        <p class="ds-title-new"><strong>Parcel Details:</strong></p>
                    </div>

                </div>

                <!-- <div class="spacer-gap"></div> -->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead style="font-size: 14px;">
                                    <tr>
                                        <th class="center">SL No.</th>
                                        <th>Item Name</th>
                                        <th>Item Type</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th class="right">Rate</th>
                                        <th class="center">Insurance</th>
                                        <th>Amount</th>   
                                        <th>Edit</th>                                     
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px;">
                                    <?php
									$total = 0;
                                    //echo '<pre>';print_r($quote_item_details);echo '<pre>';
                                    if (!empty($quote_item_details)) {
                                        foreach ($quote_item_details as $key => $value) {
                                            $description = strlen($value['desc']) > 50 ? substr($value['desc'], 0, 50) . "..." : $value['desc'];

                                             if ($value['road'] != '0.00') {
                                                 $rate = $value['road'];
                                             } else if ($value['rail'] != '0.00') {
                                                 $rate = $value['rail'];
                                             } else if ($value['air'] != '0.00') {
                                                 $rate = $value['air'];
                                             } else if ($value['ship'] != '0.00') {
                                                 $rate = $value['ship'];
                                             } else {
                                                 $rate = '0.00';
                                             }

                                            //$total = $total + $value['line_total'];
                                            //$total += ($rate + $value['insur']);
                                            //$rate  = $value['rate'];
                                            $insur = $value['insur'];
                                            $is_protect_parcel = $value['protect_parcel'];
                                            $qty = ($value['quantity'] >0)?$value['quantity']:'1';
                                            if($value['type'] == 2){
                                                $rate_dimen = number_format(((($value['length'] * $value['breadth'] * $value['height']) / 5000) * 1.25),2);
                                            } else {
                                                $rate_dimen = 0.00;
                                            }
                                            if($is_protect_parcel == 1){
                                                $total += ($rate * $qty) + $insur + $value['additional_charge'] + $rate_dimen;
                                            } else {
                                                $total += ($rate * $qty) + $value['additional_charge'] + $rate_dimen;
                                            }                                            
                                            $total = number_format((float)$total, 2, '.', '');

                                            $subtotal += $total;
                                            $subtotal = number_format((float)$subtotal, 2, '.', '');
                                    ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $value['item_name']; ?></td>
                                                <td><?php echo $value['package']; ?></td>
                                                <td><?php echo $value['category_name']; ?></td>
                                                <td><?php echo $description; ?></td>
                                                <td><?php echo $qty; ?></td>
                                                <td><?php echo $rate; ?></td>
                                                <td><?php echo (($is_protect_parcel == 1)? $value['insur'] :'0.00'); ?></td>
                                                <td><?php echo $total; ?></td>
                                                <td><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal_<?php echo $key; ?>" class="text-success"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                                            </tr>

                                            <div class="modal fade" id="exampleModal_<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg" role="document">
                                                <?php echo form_open(base_url('admin/updateOrderDetails'), array('id' => 'update-order_'.$key, 'class' => '', 'enctype' => 'multipart/form-data')); ?>
                                                <div class="modal-content" id="element_overlapT<?php echo $key; ?>">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Item Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <input type="hidden" name="item_id" id="item_id" value="<?php echo $value['id']; ?>">
                                                    <input type="hidden" name="shipment_id" id="shipment_id" value="<?php echo $this->uri->segment(3); ?>">
                                                    <input type="hidden" name="charges_mode" id="charges_mode" value="<?php echo $quote_details[0]['transport_type']; ?>">
                                                    <input type="hidden" name="rate" id="rate_<?php echo $key; ?>" value="<?php echo $rate; ?>">
                                                    <input type="hidden" name="insur" id="insur_<?php echo $key; ?>" value="<?php echo $insur; ?>">
                                                    <input type="hidden" name="total" id="total_<?php echo $key; ?>" value="<?php echo $total; ?>">
                                                    <input type="hidden" name="rate_type" id="rate_type" value="L">
                                                    <input type="hidden" name="location_from" id="location_from" value="<?php echo $quote_from_details[0]['state']; ?>">
                                                    <input type="hidden" name="location_to" id="location_to" value="<?php echo $quote_to_details[0]['state']; ?>">
                                                    <input type="hidden" name="delivery_speed" id="delivery_speed1" value="1">
                                                    <input type="hidden" name="type" id="type" value="<?php echo $value['type']; ?>">
                                                    <input type="hidden" name="additional_charge_gross" id="additional_charge_gross_hidden_<?php echo $key; ?>" value="">    
                                                    <input type="hidden" name="subtotal" id="subtotal_hidden_<?php echo $key; ?>" value="">    
                                                    <input type="hidden" name="discount" id="discount_hidden_<?php echo $key; ?>" value="">    
                                                    <input type="hidden" name="tax_ga_pur" id="tax_ga_pur_hidden_<?php echo $key; ?>" value="">    
                                                    <input type="hidden" name="tax_ga_amu" id="tax_ga_amu_hidden_<?php echo $key; ?>" value="">    
                                                    <input type="hidden" name="tax_ra_pur" id="tax_ra_pur_hidden_<?php echo $key; ?>" value="">    
                                                    <input type="hidden" name="tax_ra_amu" id="tax_ra_amu_hidden_<?php echo $key; ?>" value="">    
                                                    <input type="hidden" name="grand_total" id="grand_total_hidden_<?php echo $key; ?>" value="">  
                                                    <?php if($value['type'] == 1){ ?>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <?php
                                                                $cond = array(
                                                                    'type' => '1',
                                                                    'parent_cat_id' => 0
                                                                );
                                                                echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', $value['category_id'], $cond, 'cat_id', 'form-control document_category', 'document_category', 'document_category','','data-id',$key); ?>
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <?php
                                                                    $cond = array(
                                                                        'type' => '1',
                                                                        'parent_cat_id' => $value['category_id']
                                                                    );
                                                                        echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', $value['subcategory_id'], $cond, 'cat_id', 'form-control', 'document_sub_cat', 'document_sub_cat_'.$key,'','data-id',$key);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">    
                                                            <div class="col-sm-6 form-group">
                                                                <?php
                                                                    $cond = array(
                                                                        'category_id' => $value['category_id'],
                                                                    );
                                                                    echo fillCombo_frontend('document', 'document_id', 'name', $value['item_id'], $cond, 'category_id', 'form-control', 'document_item', 'document_item_'.$key,'','data-id',$key);
                                                                ?>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="row document_other_row" id="document_other_row_<?php echo $key; ?>" style="display:none;">
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" id="document_other" name="document_other" type="radio" value="1">
                                                                <label class="form-check-label" for="document_other">Other Category</label>
                                                                </input>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <textarea class="form-control" id="other_details_document" name="other_details_document" rows="2"><?php echo $value['other_details_parcel']; ?> </textarea>
                                                        </div>
                                                    </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <label for="">Value of your shipment</label>
                                                                <input class="form-control" id="value_of_shipment_parcel" name="value_of_shipment_parcel" value="<?php echo $value['value_shipment']; ?>" type="number" />
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <div class="form-check" style="margin-top: 27px;">
                                                                    <input class="form-check-input" type="checkbox" name="protect_parcel" id="protect_parcel" value="1" <?php echo (($value['protect_parcel'] == 2)? 'checked' : ''); ?>>
                                                                    <label class="form-check-label" for="protect_parcel" style="top: 0px!important;">
                                                                        Protect your shipment
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <label>Additional Charge Comment</label>
                                                                <input type="text" name="additional_charge_comment" id="additional_charge_comment" class="form-control" value="<?php echo $value['additional_charge_comment']; ?>">
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <label>Additional Charge </label>
                                                                <input type="text" name="additional_charge" id="additional_charge" class="form-control" value="<?php echo $value['additional_charge']; ?>" maxlength="6" onKeyPress="javascript:return isNumber(event)">
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <?php
                                                                $cond = array(
                                                                    'type' => '2',
                                                                    'parent_cat_id' => 0
                                                                );
                                                                echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', $value['category_id'], $cond, 'cat_id', 'form-control package_category', 'package_category', 'package_category','','data-id',$key); ?>
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <?php
                                                                $cond = array(
                                                                    'type' => '2',
                                                                    'parent_cat_id' => $value['category_id']
                                                                );
                                                                echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name',$value['subcategory_id'], $cond, 'cat_id', 'form-control', 'package_sub_cat', 'package_sub_cat_'.$key,'','data-id',$key); ?>
                                                                
                                                                <!-- <select class="form-control" id="package_sub_cat_<?php echo $key; ?>" name="package_sub_cat">
                                                                    <option value="">Selet Category First</option>
                                                                </select> -->
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <?php
                                                                    $cond = array(
                                                                        'category_id' => $value['category_id'],
                                                                    );
                                                                    echo fillCombo_frontend('package', 'package_id', 'name', $value['item_id'], $cond, 'category_id', 'form-control', 'package_item', 'package_item_'.$key,'','data-id',$key);
                                                                ?>
                                                                <!-- <select class="form-control" id="package_item_<?php echo $key; ?>" name="package_item">
                                                                    <option value="">Selet Category First</option>
                                                                </select> -->
                                                            </div>
                                                        </div>
                                                        <div class="row" id="parcel_other_row" style="display:none;">
                                                            <div class="col-sm-6 form-group">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" id="parcel_other" name="parcel_other" type="radio" value="2">
                                                                    <label class="form-check-label" for="parcel_other">Other Category</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <textarea class="form-control" id="other_details_parcel" name="other_details_parcel" rows="2"><?php echo $value['other_details_parcel']; ?></textarea>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <label for="">Describe your shipment.</label>
                                                                <textarea class="form-control" id="shipment_description_parcel" name="shipment_description_parcel" aria-label="With textarea"> <?php echo $description; ?></textarea>
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <label for="">Value of your shipment</label>
                                                                <input class="form-control" id="value_of_shipment_parcel" name="value_of_shipment_parcel" value="<?php echo $value['value_shipment']; ?>" type="number" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <label>Reference</label>
                                                                <input class="form-control" type="text" id="referance_parcel" name="referance_parcel" value="<?php echo $value['referance_parcel']; ?>" placeholder="Reference">
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <div class="form-check" style="margin-top: 27px;">
                                                                    <input class="form-check-input" type="checkbox" name="protect_parcel" id="protect_parcel" value="2" <?php echo (($value['protect_parcel'] == 2)? 'checked' : ''); ?>>
                                                                    <label class="form-check-label" for="protect_parcel" style="top: 0px!important;">
                                                                        Protect your shipment
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <label>Quantity</label>
                                                                <input class="form-control" type="text" id="quantity" name="quantity" value="<?php echo $qty; ?>" placeholder="Quantity">
                                                            </div>                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 form-group">
                                                                <h3>Dimension</h3>                                                            
                                                                <hr>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group ">                  
                                                                <div class="col-sm-9 no-gap">
                                                                    <label for="length">Length</label>
                                                                    <input class="form-control" type="text" id="length" name="length" value="<?php echo $value['length']; ?>" placeholder="Length">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="length_dimen" name="length_dimen">
                                                                        <option value="cm" <?php echo (($value['length_dimen'] == 'cm')? 'selected' : ''); ?>>cm</option>
                                                                        <option value="inc" <?php echo (($value['length_dimen'] == 'inc')? 'selected' : ''); ?>>inc</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 form-group ">                  
                                                                <div class="col-sm-9 no-gap">
                                                                    <label for="length">Breadth</label>
                                                                    <input class="form-control" type="text" id="breadth" name="breadth" value="<?php echo $value['breadth']; ?>" placeholder="Breadth">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="breadth_dimen" name="breadth_dimen">
                                                                        <option value="cm" <?php echo (($value['breadth_dimen'] == 'cm')? 'selected' : ''); ?>>cm</option>
                                                                        <option value="inc" <?php echo (($value['breadth_dimen'] == 'inc')? 'selected' : ''); ?>>inc</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group ">                  
                                                                <div class="col-sm-9 no-gap">
                                                                    <label for="length">Height</label>
                                                                    <input class="form-control" type="text" id="height" name="height" value="<?php echo $value['height']; ?>" placeholder="Height">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="height_dimen" name="height_dimen">
                                                                        <option value="cm" <?php echo (($value['height_dimen'] == 'cm')? 'selected' : ''); ?>>cm</option>
                                                                        <option value="inc" <?php echo (($value['height_dimen'] == 'inc')? 'selected' : ''); ?>>inc</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 form-group ">                  
                                                                <div class="col-sm-9 no-gap">
                                                                    <label for="length">Weight</label>
                                                                    <input class="form-control" type="text" id="weight" name="weight" value="<?php echo $value['weight']; ?>" placeholder="Weight">
                                                                </div>
                                                                <div class="col-sm-3 no-gap-left">
                                                                    <select class="form-control" id="weight_dimen" name="weight_dimen">
                                                                        <option value="kg" <?php echo (($value['weight_dimen'] == 'kg')? 'selected' : ''); ?>>kg</option>
                                                                        <option value="pound" <?php echo (($value['weight_dimen'] == 'pound')? 'selected' : ''); ?>>pound</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <label>Additional Charge Comment</label>
                                                                <input type="text" name="additional_charge_comment" id="additional_charge_comment" class="form-control" value="<?php echo $value['additional_charge_comment']; ?>">
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <label>Additional Charge </label>
                                                                <input type="text" name="additional_charge" id="additional_charge" class="form-control" value="<?php echo $value['additional_charge']; ?>" maxlength="6" onKeyPress="javascript:return isNumber(event)">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                                    <button type="button" name="save" id="save" class="btn btn-info save" data-id="<?php echo $key; ?>">Save changes</button>
                                                  </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                              </div>
                                            </div>
                                    <?php
                                            $total = 0;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="spacer-gap"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        &nbsp;
                    </div>
                    <div class="col-sm-12 col-md-4">

                        <table class="table table-striped">

                            <tbody style="font-size: 13px;">
                                <tr>
                                    <td>Subtotal:</td>
                                    <td>$<?php echo $subtotal; ?></td>
                                </tr>
                                <tr>
                                    <td>Discount:</td>
                                    <td>$<?php echo $discount; ?></td>
                                </tr>
                                <?php
                                if (!empty($tax)) {
                                    // echo '<pre>';print_r($tax);
                                    $tax_ga_pur = '';
                                    $tax_ga_amu = '';
                                    $tax_ra_pur = '';
                                    $tax_ra_amu = '';
                                    if (isset($tax[0]['type']) && !isset($tax[1]['type']) && $tax[0]['type'] == 'GA') {
                                        //GA only
                                ?>
                                        <tr>
                                            <td><?php echo $tax[0]['type'] . ' Tax (' . $tax[0]['amount'] . '%)'; ?>:</td>
                                            <td>
                                                <?php
                                                $discounted_total = ($subtotal - $discount);
                                                $added_ga_tax = ($discounted_total * $tax[0]['amount']) / 100;
                                                $grand_total = ($discounted_total + $added_ga_tax);
                                                $tax_ga_pur = $tax[0]['amount'];
                                                $tax_ga_amu = $added_ga_tax;
                                                echo  '$' . number_format($added_ga_tax,2);
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Total:</td>
                                            <td><?php echo  '$' . $grand_total; ?></td>
                                        </tr>
                                    <?php
                                    } else if (isset($tax[0]['id']) && isset($tax[1]['id'])) {
                                        //GA & RA
                                    ?>
                                        <!-- GA starts -->
                                        <tr>
                                            <td><?php echo $tax[0]['type'] . ' Tax (' . $tax[0]['amount'] . '%)'; ?>:</td>
                                            <td>
                                                <?php
                                                $discounted_total = ($subtotal - $discount);
                                                $added_ga_tax = ($discounted_total * $tax[0]['amount']) / 100;
                                                $total_with_tax = ($discounted_total + $added_ga_tax);
                                                $tax_ga_pur = $tax[0]['amount'];
                                                $tax_ga_amu = $added_ga_tax;
                                                
                                                echo  '$' . number_format($added_ga_tax,2);
                                                ?>
                                            </td>
                                        </tr>
                                        <!-- GA ends -->

                                        <!-- RA starts -->
                                        <tr>
                                            <td><?php echo $tax[1]['type'] . ' Tax (' . $tax[1]['amount'] . '%)'; ?>:</td>
                                            <td>
                                                <?php
                                                $added_ra_tax = ($added_ga_tax * $tax[1]['amount']) / 100;
                                                $grand_total = ($total_with_tax + $added_ra_tax);
                                                $tax_ra_pur = $tax[1]['amount'];
                                                $tax_ra_amu = $added_ra_tax;
                                                echo  '$' . number_format($added_ra_tax,2);
                                                ?>
                                            </td>
                                        </tr>
                                        <!-- RA ends -->
                                        <tr>
                                            <?php $additional_charge_gross = $shipment_price_details['additional_charge_gross']; ?>
                                            <td>Additional Charge:</td>
                                            <td><input type="text" name="additional_charge_gross" id="additional_charge_gross" class="form-control" value="<?php echo $shipment_price_details['additional_charge_gross']; ?>" maxlength="6" onKeyPress="javascript:return isNumber(event)"></td>
                                        </tr>
                                        <tr>
                                            <td>Total:</td>
                                            <td><?php echo  '$' . number_format($grand_total + $additional_charge_gross,2); ?></td>
                                        </tr>
                                    <?php
                                    } else {
                                        //RA only
                                    ?>
                                        <tr>
                                            <td>Total:</td>
                                            <td>
                                                <?php
                                                $grand_total = ($subtotal - $discount);
                                                echo  '$' . number_format($grand_total + $additional_charge_gross,2);
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td>Total:</td>
                                        <td>
                                            <?php
                                            $grand_total = ($subtotal - $discount);
                                            echo  '$' . number_format($grand_total + $additional_charge_gross,2);
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>  
          </div>
          <div class="box-footer"> 
            <button type="submit" class="btn btn-success pull-right" id="update_shipment_price_dtls" name="update_shipment_price_dtls" style="display:none;">Update Total</button> 
            <?php if($this->session->userdata('user_type') == 'MO'){?>
            	<a href="<?php echo base_url('admin/order-list'); ?>" class="btn btn-info ">Back</a> </div>
            <?php } else {?>
            	<a href="<?php echo base_url('admin/pickup-order-list'); ?>" class="btn btn-info ">Back</a> </div>
            <?php }?>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
  <?php
   $this->load->view('admin/include/footer-content');
  ?>
  <?php 
   // $additional_charge_gross = $shipment_price_details['additional_charge_gross'];
   //  $shipPriceDet = [                        
   //                  'subtotal'              => $subtotal,
   //                  'discount'              => $discount,
   //                  'ga_percentage'         => $tax_ga_pur,
   //                  'ga_tax_amt'            => $tax_ga_amu,  
   //                  'ra_percentage'         => $tax_ra_pur,
   //                  'ra_tax_amt'            => $tax_ra_amu,
   //                  'additional_charge_gross'=> $shipment_price_details['additional_charge_gross'],
   //                  'grand_total'           => $grand_total + $additional_charge_gross,                     
   //                  ];
   //      //print_r($shipPriceDet);
   //      $shipment_charges_up = $this->OuthModel->UpdateQuery('shipment_price_details', $this->OuthModel->xss_clean($shipPriceDet), 'shipment_id', $this->uri->segment(3));
?>
  <!-- Control Sidebar --> 
  
  <!-- /.control-sidebar --> 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php
    $this->load->view('admin/include/footer');
?>

<script>


$(document).on('change','#additional_charge_gross',function(){
    var aditionalChargeAll  = $(this).val();
    if(parseInt(aditionalChargeAll) > 0){
        $('#update_shipment_price_dtls').show();
    } else {
        $('#update_shipment_price_dtls').hide();
    }
});

$(document).on('click','#update_shipment_price_dtls',function(e){    
            e.preventDefault();
            var shipment_id              = '<?php echo $this->uri->segment(3); ?>';
            var additional_charge_gross  = $('#additional_charge_gross').val();
            var subtotal                 = '<?php echo $subtotal; ?>';
            var discount                 = '<?php echo $discount; ?>';
            var tax_ga_pur               = '<?php echo $tax_ga_pur; ?>';
            var tax_ga_amu               = '<?php echo $tax_ga_amu; ?>';
            var tax_ra_pur               = '<?php echo $tax_ra_pur; ?>';
            var tax_ra_amu               = '<?php echo $tax_ra_amu; ?>';
            var grand_total              = '<?php echo $grand_total; ?>';
            var csrfName                 = '<?php echo $this->security->get_csrf_token_name(); ?>',csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            $("#element_overlapT").LoadingOverlay("show");
            toastr.remove();
            toastr.success('<span style="color:#fff;">Please wait...</span>');
            var formData = {
                    shipment_id             : shipment_id,
                    additional_charge_gross : additional_charge_gross,
                    subtotal                : subtotal,
                    discount                : discount,
                    tax_ga_pur              : tax_ga_pur,
                    tax_ga_amu              : tax_ga_amu,
                    tax_ra_pur              : tax_ra_pur,
                    tax_ra_amu              : tax_ra_amu,
                    grand_total             : grand_total,
                    [csrfName]              : csrfHash,
            };
            //console.log(formData);
            $.ajax({
                dataType : "json",
                type : "post",
                cache: false,
                // contentType: false,
                //processData: false,
                data : formData,
                //headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
                url: '<?php echo base_url('admin/updateAditionalCharge'); ?>',
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
                        setTimeout(function() {
                            window.location.href = data.redirectUrl;
                        }, 5000);
                    }
                },
                error: function (jqXHR, status, err) {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">Local error callback.</span>');
                }
          });
});

$(document).on('change','#delivery_speed',function(){
    $('#delivery_speed1').val($(this).val());
});

$(document).ready(function(){

    $('.save').on('click', function(){ 
        var dataId = $(this).data('id');
        var additional_charge_gross  = $('#additional_charge_gross').val();
        var subtotal                 = '<?php echo $subtotal; ?>';
        var discount                 = '<?php echo $discount; ?>';
        var tax_ga_pur               = '<?php echo $tax_ga_pur; ?>';
        var tax_ga_amu               = '<?php echo $tax_ga_amu; ?>';
        var tax_ra_pur               = '<?php echo $tax_ra_pur; ?>';
        var tax_ra_amu               = '<?php echo $tax_ra_amu; ?>';
        var grand_total              = '<?php echo $grand_total + $shipment_price_details['additional_charge_gross'] ; ?>';

        $('#additional_charge_gross_hidden_'+dataId).val(additional_charge_gross);
        $('#subtotal_hidden_'+dataId).val(subtotal);
        $('#discount_hidden_'+dataId).val(discount);
        $('#tax_ga_pur_hidden_'+dataId).val(tax_ga_pur);
        $('#tax_ga_amu_hidden_'+dataId).val(tax_ga_amu);
        $('#tax_ra_pur_hidden_'+dataId).val(tax_ra_pur);
        $('#tax_ra_amu_hidden_'+dataId).val(tax_ra_amu);
        $('#grand_total_hidden_'+dataId).val(grand_total);
        //e.preventDefault();
          $("#element_overlapT"+dataId).LoadingOverlay("show");
            toastr.remove()
            toastr.success('<span style="color:#fff;">Please wait...</span>');
            //$('#update-order_'+dataId).append(additional_charge_gross);
            $.ajax({
                dataType : "json",
                type : "post",
                cache: false,
                // contentType: false,
                //processData: false,
                // + "&additional_charge_gross=" + additional_charge_gross + "&subtotal=" + subtotal + "&discount=" + discount + "&tax_ga_pur=" + tax_ga_pur + "&tax_ga_amu=" + tax_ga_amu + "&tax_ra_pur=" + tax_ra_pur + "&tax_ra_amu=" + tax_ra_amu + "&grand_total=" + grand_total

                data : $('#update-order_'+dataId).serializeArray() ,
                //headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
                url: $('#update-order_'+dataId).attr('action'),
                success:function(data)
                {
                    $("#element_overlapT"+dataId).LoadingOverlay("hide", true);
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
                        $('#update-order_'+dataId).trigger('reset');
                        setTimeout(function() {
                            window.location.href = data.redirectUrl;
                        }, 5000);
                    }
                },
                error: function (jqXHR, status, err) {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">Local error callback.</span>');
                }
          });
    });
});
    $('.document_category').on('change', function() {
            var dataId = $(this).data('id');
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var categoryID = $(this).val();
            var ship_sub_subcat_id = $('#document_sub_cat_'+dataId).val();

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
                        $('#document_item_'+dataId).html('<option value="">Select Item</option>');
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
                                $('#document_item_'+dataId).append(option);
                            });
                            $('#document_item_'+dataId).append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#document_item_'+dataId).html('<option value="">Items not available</option>');
                        }


                        $('#document_sub_cat_'+dataId).html('<option value="">Select Subcategory</option>');
                        if (resultKeyCount2 > 0) {
                            $(dataObj2).each(function() {
                                var option2 = $('<option />');
                                option2.attr('value', this.cat_id).text(this.category_name);
                                $('#document_sub_cat_'+dataId).append(option2);
                            });
                            $('#document_sub_cat_'+dataId).append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#document_sub_cat_'+dataId).html('<option value="">Subcategory not available</option>');
                        }
                    }
                });
            } else {
                $('#document_item_'+dataId).html('<option value="">Select Category first</option>');
                $('#document_sub_cat_'+dataId).html('<option value="">Select Category first</option>');
            }
        });

    $('.package_category').on('change', function() {
            var dataId = $(this).data('id');
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var categoryID = $(this).val();
            var ship_sub_subcat_id = $('#document_sub_cat_'+dataId).val();

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
                        $('#package_item_'+dataId).html('<option value="">Select Item</option>');
                        var string1 = JSON.stringify(data.items);
                        var dataObj = JSON.parse(string1);
                        var resultKeyCount = Object.keys(dataObj).length;
                        if (resultKeyCount > 0) {
                            $(dataObj).each(function() {
                                var option = $('<option />');
                                option.attr('value', this.package_id).text(this.name);
                                $('#package_item_'+dataId).append(option);
                            });
                            $('#package_item_'+dataId).append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#package_item_'+dataId).html('<option value="">Items not available</option>');
                        }

                        var string2 = JSON.stringify(data.subcat);
                        var dataObj2 = JSON.parse(string2);
                        var resultKeyCount2 = Object.keys(dataObj2).length;

                        $('#package_sub_cat_'+dataId).html('<option value="">Select Subcategory</option>');
                        if (resultKeyCount2 > 0) {
                            $(dataObj2).each(function() {
                                var option2 = $('<option />');
                                option2.attr('value', this.cat_id).text(this.category_name);
                                $('#package_sub_cat_'+dataId).append(option2);
                            });
                            $('#package_sub_cat_'+dataId).append($("<option></option>").attr("value", '0').text('Other'));
                        } else {
                            $('#package_sub_cat_'+dataId).html('<option value="">Subcategory not available</option>');
                        }
                    }
                });
            } else {
                $('#package_item_'+dataId).html('<option value="">Select Category first</option>');
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
</script>