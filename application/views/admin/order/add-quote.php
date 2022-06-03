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
$subtotal = 0.00;
$discount = 0.00;
$total = 0.00;
$qty = 0;

if($quote_data != ''){
    $location_type      = $quote_data[0]['location_type'];
    $shipment_type      = $quote_data[0]['shipment_type'];
    $delivery_mode_id   = $quote_data[0]['delivery_mode_id'];
    $customer_id        = $quote_data[0]['customer_id'];
    $transport_type     = $quote_data[0]['transport_type'];
} else {
    $location_type      = '1';
    $shipment_type      = '1';
    $delivery_mode_id   = '1';
    $customer_id        = '';
    $transport_type     = '1';
}
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
      <h1> Add Quote </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('admin/order-list') ?>"><i class="fa fa-dashboard"></i> Quote List </a></li>
        <li class="active">Create Qoute</li>
      </ol>
    </section>
    <div class="container">
      <div class="col-md-12">
        <h2></h2>
        <div class="box box-primary">
          <div class="box-header with-border"> Fill Quote Details</div>
          <div class="box-body">
            <div class="form-group col-md-6 col-md-offset-3"></div>
 			<div class="form-card">
                <?php
                if($quote_data == ''){
                 echo form_open(base_url('admin/startQuote'), array('method'=>'POST','id' => 'startQuoteF', 'class' => '', 'enctype' => 'multipart/form-data')); 
                }?>
                    <div class="row" style="pointer-events: <?php echo (($quote_data != '')? 'none' : ''); ?>;">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 form-group" style="background-color: darkseagreen;text-align: center;padding-bottom: 8px;">
                                    <label>Shipment Type</label><br>   
                                    <input class="form-check-input" type="radio" name="location_type" id="location_type1" value="1" <?php echo (($location_type == '1')? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="location_type">Domestic</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input class="form-check-input" type="radio" name="location_type" id="location_type2" value="2" <?php echo (($location_type == '2')? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="location_type">International</label>
                                </div>
                                <div class="col-sm-3 form-group" style="background-color: burlywood;text-align: center;padding-bottom: 8px;">
                                    <label>Parcel Type</label><br>
                                    <input class="form-check-input shipment_type_option" type="radio" name="shipment_type_option" id="shipment_type_option" value="1" <?php echo (($shipment_type == '1')? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="shipment_type_option">For Document</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input class="form-check-input shipment_type_option" type="radio" name="shipment_type_option" id="shipment_type_option" value="2" <?php echo (($shipment_type == '2')? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="shipment_type_option">For Package</label>
                                </div>
                                <div class="col-sm-3 form-group" style="background-color: darkseagreen;text-align: center;padding-bottom: 5px;">
                                    <label>Speed Rate</label>
                                    <select class="form-control form-control-new delivery_speed" id="delivery_speed" name="delivery_speed">
                                        <?php if (!empty($deliveryModeList)) {
                                            foreach ($deliveryModeList as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id']; ?>" <?php echo (($delivery_mode_id == $value['id'])? 'selected' : ''); ?>><?php echo $value['name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>           
                                </div>
                                <div class="col-sm-3 form-group" style="background-color: cadetblue;text-align: center;padding-bottom: 5px;">
                                    <label>Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-control select2" required="required">
                                        <option value="">Select Customer</option>
                                        <?php foreach ($userList as $key => $value) { ?>
                                            <option value="<?php echo $value->user_id; ?>" <?php echo (($customer_id == $value->user_id)? 'selected' : ''); ?>><?php echo $value->firstname.' '.$value->lastname.' ('.$value->telephone.') '.' ('.$value->email.') '; ?></option>
                                        <?php } ?>                                    
                                    </select>
                                </div>
                            </div>                                  
                        </div>
                    </div>
                    <div class="row" style="pointer-events: <?php echo (($quote_data != '')? 'none' : ''); ?>;">
                        <div class="col-sm-12 form-group" style="text-align:center;">
                            <label>Transport Type</label><br>   
                            <input class="form-check-input" type="radio" name="charges_final" id="charges_final1" value="1" <?php echo (($transport_type == '1')? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="charges_final">By Road</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="form-check-input" type="radio" name="charges_final" id="charges_final2" value="2" <?php echo (($transport_type == '2')? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="charges_final">By Rail</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="form-check-input" type="radio" name="charges_final" id="charges_final3" value="3" <?php echo (($transport_type == '3')? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="charges_final">By Air</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="form-check-input" type="radio" name="charges_final" id="charges_final4" value="4" <?php echo (($transport_type == '4')? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="charges_final">By Sea</label>
                        </div>
                    </div>
                    <div class="row" style="display: <?php echo (($quote_data != '')? 'none' : ''); ?>;">
                        <div class="col-sm-12 form-group" style="text-align:center;">
                            <input type="submit" name="start_quote" id="start_quote" class="btn btn-success" value="Start Quotation">
                        </div>
                    </div>
                <?php if($quote_data == ''){ echo form_close(); } else { 
                    echo form_open(base_url('admin/updateQuote'), array('method'=>'POST','id' => 'startQuoteF', 'class' => '', 'enctype' => 'multipart/form-data')); 
                ?>
                <input type="hidden" name="quotation_id" id="quotation_id" value="<?php echo $this->uri->segment(3); ?>">
                <div id="start_quore_div" style="display: <?php echo (($quote_data != '')? '' : 'none'); ?>;">
                <div class="row">
                    <div class="col-sm-12 col-md-6" style="background-color: bisque;">
                        <?php
                        //if (!empty($quote_from_details)) {
                        // echo '<pre>';
                        // print_r($quoteUser[0]);
                        ?>
                        <p class="ds-title-new"><strong>Pickup Address :</strong></p>
                        <div class="form-group col-md-6">
                            <label for="email">First Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname" value="<?php echo $quoteUser[0]->firstname;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Last Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" value="<?php echo $quoteUser[0]->lastname;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Line1<span>*</span> : </label>
                            <input type="text" class="form-control autocomplete" placeholder="Address Line1" name="address" id="address" value="<?php echo $quoteUser[0]->address;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Line2 (Optional) : </label>
                            <input type="text" class="form-control" placeholder="Address Line2" name="address2" id="address2" value="<?php echo $quoteUser[0]->address2;?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Company (Optional) : </label>
                            <input type="text" class="form-control" placeholder="Company Name" name="company_name" id="company_name" value="<?php echo $quoteUser[0]->companyname;?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Country/Territory<span>*</span> : </label>
                            <?php echo fillCombo_frontend('countries_master', 'id', 'name', $quoteUser[0]->country, 'status = 1', 'id', 'form-control form-control-new', 'country', 'country', ''); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">State<span>*</span> : </label>
                            <?php //echo fillCombo_frontend('states_master', 'id', 'name', '', '', '','form-control form-control-new', 'state', 'state', ''); ?>
                            <?php echo fillCombo_frontend('states_master', 'id', 'name', $quoteUser[0]->state, 'country_id=' . $quoteUser[0]->country, 'id', 'form-control form-control-new', 'state', 'state', ''); ?>
                            <input type="hidden" name="state_google_val" id="state_google_val" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">City<span>*</span> : </label>
                            <?php //echo fillCombo_frontend('cities_master', 'id', 'name', '', '', 'id', 'form-control form-control-new', 'city', 'city', ''); ?>
                            <?php echo fillCombo_frontend('cities_master', 'id', 'name', $quoteUser[0]->city, 'state_id=' . $quoteUser[0]->state, 'id', 'form-control form-control-new', 'city', 'city', ''); ?>
                            <input type="hidden" name="city_google_val" id="city_google_val" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Zip code<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Zip code" name="zip" id="zip" value="<?php echo $quoteUser[0]->zip;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Address<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Email Address"  name="email" id="email" value="<?php echo $quoteUser[0]->email;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Phone no<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Phone no" name="telephone" id="telephone" value="<?php echo $quoteUser[0]->telephone;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Type<span>*</span> : </label>
                            <select class="form-control" name="address_type" id="address_type" required>
                                <option value="0">Home Address</option>
                                <option value="1">Business Address</option>
                            </select>
                        </div>

                        <?php
                        //}
                        
                        ?>

                    </div>
                    <div class="col-sm-12 col-md-6" style="background-color: darkgray;">
                        <?php
                        if (!empty($quote_to_details)) {
							$str_data = @unserialize($quote_to_details[0]['telephone']);
							if ($str_data !== false) {
								$to_telephone = formatPhoneTo($quote_to_details[0]['telephone']);
							} else {
								$to_telephone = $quote_to_details[0]['telephone'];
							}
						}
                        ?>
                            <p class="ds-title-new"><strong>Delivery Address :</strong></p>
                            <!-- <p class="ds-title-new">Item Description: <?php echo $quote_to_details[0]['order_created']; ?></p> -->
                            <div class="form-group col-md-6">
                                <label for="email">First Name<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="First Name" name="firstname_to" id="firstname_to" value="<?php echo ((isset($quote_to_details[0]['firstname']))? $quote_to_details[0]['firstname'] : ''); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Last Name<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname_to" id="lastname_to" value="<?php echo ((isset($quote_to_details[0]['lastname']))? $quote_to_details[0]['lastname'] :'') ; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Address Line1<span>*</span> : </label>
                                <input type="text" class="form-control autocomplete" placeholder="Address Line1" name="address_to" id="address_to" value="<?php echo ((isset($quote_to_details[0]['address'])) ? $quote_to_details[0]['address'] : ''); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Address Line2 (Optional) : </label>
                                <input type="text" class="form-control" placeholder="Address Line2" name="address2_to" id="address2_to" value="<?php echo ((isset($quote_to_details[0]['address2'])) ? $quote_to_details[0]['address2'] :'') ; ?>" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Company (Optional) : </label>
                                <input type="text" class="form-control" placeholder="Company Name" name="company_name_to" id="company_name_to" value="<?php echo ((isset($quote_to_details[0]['company_name'])) ? $quote_to_details[0]['company_name'] : ''); ?>" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Country/Territory<span>*</span> : </label>

                                <?php echo fillCombo_frontend('countries_master', 'id', 'name', ((isset($quote_to_details[0]['country']))? $quote_to_details[0]['country'] :''), 'status = 1', 'id', 'form-control', 'country_to', 'country_to', ''); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">State<span>*</span> : </label>
                                <?php if(isset($quote_to_details[0]['state'])){ echo fillCombo_frontend('states_master', 'id', 'name', $quote_to_details[0]['state'], 'country_id=' . $quote_to_details[0]['country'], 'id', 'form-control form-control-new', 'state_to', 'state_to', ''); } else {?>
                                <select name="state_to" id="state_to" class="form-control form-control-new"></select>
                            <?php } ?>
                                <input type="hidden" name="state_to_google_val" id="state_to_google_val" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">City<span>*</span> : </label>
                                <?php if(isset($quote_to_details[0]['city'])){ echo fillCombo_frontend('cities_master', 'id', 'name', $quote_to_details[0]['city'], 'state_id=' . $quote_to_details[0]['state'], 'id', 'form-control form-control-new', 'city', 'city', ''); } else {?>

                                <select name="city_to" id="city_to" class="form-control form-control-new"></select>
                                <?php } ?>
                                <input type="hidden" name="city_to_google_val" id="city_to_google_val" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Zip code<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Zip code" name="zip_to" id="zip_to" value="<?php echo ((isset($quote_to_details[0]['zip'])) ? $quote_to_details[0]['zip'] : ''); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Email Address"  name="email_to" id="email_to" value="<?php echo ((isset($quote_to_details[0]['email'])) ? $quote_to_details[0]['email'] : ''); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Phone no<span>*</span> : </label>
                                <input type="text" class="form-control" placeholder="Phone no" name="telephone_to[]" id="telephone_to" value="<?php echo ((isset($quote_to_details[0]['telephone'])) ? $to_telephone : ''); ?>" required>
                                <?php //echo formatPhoneTo($quote_to_details[0]['telephone']); ?>
                            </div>
                            <?php $address_type = ((isset($quote_to_details[0]['address_type'])) ? $quote_to_details[0]['address_type'] : ''); ?>
                            <div class="form-group col-md-6">
                                <label for="email">Address Type<span>*</span> : </label>
                                <select class="form-control" name="address_type_to" id="address_type_to" required>
                                    <option value="0" <?php echo $address_type; ?>>Home Address</option>
                                    <option value="1" <?php echo $address_type; ?>>Business Address</option>
                                </select>
                            </div>                            
                        <?php
                       // }
                        ?>
                    </div>
                </div>
                <?php //echo form_close(); } ?>
                <div class="spacer-gap"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="ds-title-new"><strong>Parcel Details:</strong></p>
                    </div>
                    <div class="col-sm-8">
                        <!-- <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-lg" class="text-success pull-right btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i></a> -->
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
                                        <!--<th>Item Name</th>
                                        <th>Item Type</th>-->
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Item Type</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th class="right">Rate</th>
                                        <th class="center">Insurance</th>
                                        <th>Amount</th>   
                                        <th>Delete</th>                                     
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px;">
                                    <?php
                                    //echo '<pre>';print_r($quote_item_details);
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

                                            $qty = ($value['quantity'] >0)?$value['quantity']:'1';
                                            $total += ($rate * $qty) + $value['insur'];
                                            $total = number_format((float)$total, 2, '.', '');

                                            $subtotal += $total;
                                            $subtotal = number_format((float)$subtotal, 2, '.', '');
                                    ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <!--<td><?php echo $value['item_name']; ?></td>
                                                <td><?php echo $value['package']; ?></td>-->
                                                <td><?php echo $value['category_name']; ?></td>
                                                <td><?php echo $value['subcategory_name']; ?></td>
                                                <td><?php echo $value['item_name']; ?></td>
                                                <td><?php echo $description; ?></td>
                                                <td><?php echo $qty; ?></td>
                                                <td><?php echo $rate; ?></td>
                                                <td><?php echo $value['insur']; ?></td>
                                                <td><?php echo $total; ?></td>
                                                <td><a href="<?php echo base_url('admin/deleteQuoteItem');?>/<?php echo $value['id'];?>" onClick="return confirm('Do you want to delete!');"  class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                            </tr>                                            
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
                                            <td>Total:</td>
                                            <td><?php echo  '$' . number_format($grand_total,2); ?></td>
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
                                                echo  '$' . number_format($grand_total,2);
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
                                            echo  '$' . number_format($grand_total,2);
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
            
          </div>
          <div class="box-footer"> 
            <!-- <button type="submit" class="btn btn-success">Add Quotation</button>  -->
            <?php if($this->session->userdata('user_type') == 'MO'){?>
            	<a href="<?php echo base_url('admin/order-list'); ?>" class="btn btn-info pull-right">Back</a> </div>
            <?php } else {?>
            	<a href="<?php echo base_url('admin/createQuote'); ?>" class="btn btn-info pull-right">Back</a> </div>
            <?php }?>
        </div>
        <?php echo form_close(); }?> </div>
    </div>
  </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="element_overlapT">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 form-group" style="text-align: center;padding-bottom: 8px;">
                            <label>Parcel Type</label><br>
                            <input class="form-check-input shipment_type_option_model" type="radio" name="shipment_type_option_model" id="shipment_type_option_model1" value="1" <?php echo (($quote_data[0]['shipment_type'] == '1')? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="shipment_type_option_model1">For Document</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="form-check-input shipment_type_option_model" type="radio" name="shipment_type_option_model" id="shipment_type_option_model2" value="2" <?php echo (($quote_data[0]['shipment_type'] == '2')? 'checked' : ''); ?> required>
                            <label class="form-check-label" for="shipment_type_option_model2">For Package</label>
                        </div>
                    </div>
                    <div id="document_div">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <?php
                                $cond = array(
                                    'type' => '1',
                                    'parent_cat_id' => 0
                                );
                                echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name','', $cond, 'cat_id', 'form-control document_category', 'document_category', 'document_category','','',''); ?>
                            </div>
                            <div class="col-sm-6 form-group">
                                <?php
                                    $cond = array(
                                        'type' => '1',
                                        //'parent_cat_id' => $value['category_id']
                                    );
                                        echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', '', $cond, 'cat_id', 'form-control', 'document_sub_cat', 'document_sub_cat','','','');
                                ?>
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-sm-6 form-group">
                                <?php                                
                                    echo fillCombo_frontend('document', 'document_id', 'name', '','', 'category_id', 'form-control', 'document_item', 'document_item','','','');
                                ?>
                            </div>                                                            
                        </div>
                        <div class="row document_other_row" id="document_other_row" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="document_other" name="document_other" type="radio" value="1">
                                    <label class="form-check-label" for="document_other">Other Category</label>
                                    </input>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <textarea class="form-control" id="other_details_document" name="other_details_document" rows="2"> </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="">Value of your shipment</label>
                                <input class="form-control" id="value_of_shipment_document" name="value_of_shipment_document" value="" type="number" />
                            </div>
                            <div class="col-sm-6 form-group">
                                <div class="form-check" style="margin-top: 27px;">
                                    <input class="form-check-input" type="checkbox" name="protect_parcel" id="protect_parcel" value="1" >
                                    <label class="form-check-label" for="protect_parcel" style="top: 0px!important;">
                                        Protect your shipment
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="parcel_div" style="display:none;">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <?php
                                $cond = array(
                                    'type' => '2',
                                    'parent_cat_id' => 0
                                );
                                echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name', '', $cond, 'cat_id', 'form-control package_category', 'package_category', 'package_category','','',''); ?>
                            </div>
                            <div class="col-sm-6 form-group">
                                <?php
                                $cond = array(
                                    'type' => '2',
                                    //'parent_cat_id' => $value['category_id']
                                );
                                echo fillCombo_frontend('document_package_categories', 'cat_id', 'category_name','', $cond, 'cat_id', 'form-control', 'package_sub_cat', 'package_sub_cat','','',''); ?>
                                
                                <!-- <select class="form-control" id="package_sub_cat_<?php echo $key; ?>" name="package_sub_cat">
                                    <option value="">Selet Category First</option>
                                </select> -->
                            </div>
                            <div class="col-sm-6 form-group">
                                <?php
                                    // $cond = array(
                                    //     'category_id' => $value['category_id'],
                                    // );
                                    echo fillCombo_frontend('package', 'package_id', 'name', '','', 'category_id', 'form-control', 'package_item', 'package_item','','','');
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
                                <textarea class="form-control" id="other_details_parcel" name="other_details_parcel" rows="2"></textarea>
                            </div>                                                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="">Describe your shipment.</label>
                                <textarea class="form-control" id="shipment_description_parcel" name="shipment_description_parcel" aria-label="With textarea"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="">Value of your shipment</label>
                                <input class="form-control" id="value_of_shipment_parcel" name="value_of_shipment_parcel" value="" type="number" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Reference</label>
                                <input class="form-control" type="text" id="referance_parcel" name="referance_parcel" value="" placeholder="Reference">
                            </div>
                            <div class="col-sm-6 form-group">
                                <div class="form-check" style="margin-top: 27px;">
                                    <input class="form-check-input" type="checkbox" name="protect_parcel" id="protect_parcel" value="2">
                                    <label class="form-check-label" for="protect_parcel" style="top: 0px!important;">
                                        Protect your shipment
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Quantity</label>
                                <input class="form-control" type="text" id="quantity" name="quantity" value="" placeholder="Quantity">
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
                                    <input class="form-control" type="text" id="length" name="length" placeholder="Length">
                                </div>
                                <div class="col-sm-3 no-gap-left" style="margin-top: 25px;">
                                    <select class="form-control" id="length_dimen" name="length_dimen">
                                        <option value="cm">cm</option>
                                        <option value="inc">inc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">                  
                                <div class="col-sm-9 no-gap">
                                    <label for="length">Breadth</label>
                                    <input class="form-control" type="text" id="breadth" name="breadth" placeholder="Breadth">
                                </div>
                                <div class="col-sm-3 no-gap-left" style="margin-top: 25px;">
                                    <select class="form-control" id="breadth_dimen" name="breadth_dimen">
                                        <option value="cm">cm</option>
                                        <option value="inc">inc</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group ">                  
                                <div class="col-sm-9 no-gap">
                                    <label for="length">Height</label>
                                    <input class="form-control" type="text" id="height" name="height" placeholder="Height">
                                </div>
                                <div class="col-sm-3 no-gap-left" style="margin-top: 25px;">
                                    <select class="form-control" id="height_dimen" name="height_dimen">
                                        <option value="cm">cm</option>
                                        <option value="inc">inc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">                  
                                <div class="col-sm-9 no-gap">
                                    <label for="length">Weight</label>
                                    <input class="form-control" type="text" id="weight" name="weight" placeholder="Weight">
                                </div>
                                <div class="col-sm-3 no-gap-left" style="margin-top: 25px;">
                                    <select class="form-control" id="weight_dimen" name="weight_dimen">
                                        <option value="kg">kg</option>
                                        <option value="pound">pound</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" name="save_item" id="save_item" class="btn btn-info">Save changes</button>
              </div>
            </div>
        </div>
    </div>
  
  <?php
   $this->load->view('admin/include/footer-content');
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

$(document).on('change','#delivery_speed',function(){
    $('#delivery_speed1').val($(this).val());
});

$(document).on('change','.shipment_type_option_model',function(){
    var Val = $(this).val();
    if(Val == 1){
        $('#parcel_div').hide();
        $('#document_div').show();
    } else {
        $('#document_div').hide();
       $('#parcel_div').show();
    }
});


$(document).ready(function(){
    $('.save').on('click', function(){ 
        var dataId = $(this).data('id');   
        //e.preventDefault();
          $("#element_overlapT"+dataId).LoadingOverlay("show");
            toastr.remove()
            toastr.success('<span style="color:#fff;">Please wait...</span>');
            if($('#firstname_to').val() == ''){
                toastr.error('<span style="color:#fff;">Details of to address is required</span>');
                return false;
            }
            if($('#state_to').val() == ''){
                toastr.error('<span style="color:#fff;">State To is required</span>');
                return false;
            }

            $.ajax({
                dataType : "json",
                type : "post",
                cache: false,
                // contentType: false,
                //processData: false,
                data : $('#update-order').serializeArray(),
                //headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
                url: $('#update-order').attr('action'),
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
                        $('#update-order').trigger('reset');
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

    $('#save_item').on('click',function(){
        var csrfName         = '<?php echo $this->security->get_csrf_token_name(); ?>',csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var quotation_id                = $('#quotation_id').val();
        var shipment_type_option_model  = $('input[name="shipment_type_option_model"]:checked').val();
        var charges_final               = $('input[name="charges_final"]:checked').val();
        var location_from               = $('#state').val();    
        var location_to                 = $('#state_to').val();    
        var delivery_speed              = $('#delivery_speed').val();
        // Document
        var document_category           = $('#document_category').val();
        var document_sub_cat            = $('#document_sub_cat').val();
        var document_item               = $('#document_item').val();
        var document_other              = $('#document_other').val();
        var other_details_document      = $('#other_details_document').val();
        var value_of_shipment_document  = $('#value_of_shipment_document').val();
        var protect_parcel              = $('#protect_parcel').val();
        // Parcel
        var package_category            = $('#package_category').val();
        var package_sub_cat             = $('#package_sub_cat').val();
        var package_item                = $('#package_item').val();
        var parcel_other                = $('#parcel_other').val();
        var other_details_parcel        = $('#other_details_parcel').val();
        var shipment_description_parcel = $('#shipment_description_parcel').val();
        var value_of_shipment_parcel    = $('#value_of_shipment_parcel').val();
        var referance_parcel            = $('#referance_parcel').val();
        var protect_parcel              = $('#protect_parcel').val();
        var quantity                    = $('#quantity').val();
        var length                      = $('#length').val();
        var length_dimen                = $('#length_dimen').val();
        var breadth                     = $('#breadth').val();
        var breadth_dimen               = $('#breadth_dimen').val();
        var height                      = $('#height').val();
        var height_dimen                = $('#height_dimen').val();
        var weight                      = $('#weight').val();
        var weight_dimen                = $('#weight_dimen').val();

		// From Address
        var firstname               = $('#firstname').val();
        var lastname                = $('#lastname').val();
        var address                 = $('#address').val();
        var address2                = $('#address2').val();
        var company_name             = $('#company_name').val();
        var country                  = $('#country').val();
        var state                    = $('#state').val();
        var city                     = $('#city').val();
        var zip                      = $('#zip').val();
        var email                    = $('#email').val();
        var telephone                = $('#telephone').val();
        var address_type             = $('#address_type').val();
		
        // To Address
        var firstname_to                = $('#firstname_to').val();
        var lastname_to                 = $('#lastname_to').val();
        var address_to                  = $('#address_to').val();
        var address2_to                 = $('#address2_to').val();
        var company_name_to             = $('#company_name_to').val();
        var country_to                  = $('#country_to').val();
        var state_to                    = $('#state_to').val();
        var city_to                     = $('#city_to').val();
        var zip_to                      = $('#zip_to').val();
        var email_to                    = $('#email_to').val();
        var telephone_to                = $('#telephone_to').val();
        var address_type_to             = $('#address_type_to').val();
        var customer_id                 = $('#customer_id').val();

        if(firstname_to == '' || lastname_to =='' || address_to =='' || country_to =='' || state_to =='' || city_to =='' || zip_to =='' || email_to =='' || telephone_to ==''){
                toastr.error('<span style="color:#fff;">Address to Details are required</span>');
                return false;
        }
        // if(state_to == ''){
        //     toastr.error('<span style="color:#fff;">State To is required</span>');
        //     return false;
        // }
        if(shipment_type_option_model == 1){
            var dataStr = {[csrfName]: csrfHash,quotation_id:quotation_id,type : shipment_type_option_model,charges_final:charges_final,location_from:location_from,location_to:location_to,delivery_speed:delivery_speed,document_category : document_category,document_sub_cat : document_sub_cat,document_item : document_item,document_other : document_other,other_details_document : other_details_document,value_of_shipment_parcel : value_of_shipment_document,protect_parcel : protect_parcel,firstname_to:firstname_to,lastname_to:lastname_to,address_to:address_to,address2_to:address2_to,company_name_to:company_name_to,country_to:country_to,state_to:state_to,city_to:city_to,zip_to:zip_to,email_to:email_to,telephone_to:telephone_to,address_type_to:address_type_to,firstname:firstname,lastname:lastname,address:address,address2:address2,company_name:company_name,country:country,state:state,city:city,zip:zip,email:email,telephone:telephone,address_type:address_type,customer_id:customer_id};
        } else {
            var dataStr = {[csrfName]: csrfHash,quotation_id:quotation_id,type : shipment_type_option_model,charges_final:charges_final,location_from:location_from,location_to:location_to,delivery_speed:delivery_speed,package_category : package_category,package_sub_cat : package_sub_cat,package_item : package_item,parcel_other : parcel_other,other_details_parcel : other_details_parcel,shipment_description_parcel : shipment_description_parcel,value_of_shipment_parcel : value_of_shipment_parcel,referance_parcel : referance_parcel,protect_parcel : protect_parcel,quantity : quantity,length : length,length_dimen : length_dimen,breadth : breadth,breadth_dimen : breadth_dimen,height : height,height_dimen : height_dimen,weight : weight,weight_dimen : weight_dimen,firstname_to:firstname_to,lastname_to:lastname_to,address_to:address_to,address2_to:address2_to,company_name_to:company_name_to,country_to:country_to,state_to:state_to,city_to:city_to,zip_to:zip_to,email_to:email_to,telephone_to:telephone_to,address_type_to:address_type_to,firstname:firstname,lastname:lastname,address:address,address2:address2,company_name:company_name,country:country,state:state,city:city,zip:zip,email:email,telephone:telephone,address_type:address_type,customer_id:customer_id};
        }
        
        $("#element_overlapT").LoadingOverlay("show");
            toastr.remove()
            toastr.success('<span style="color:#fff;">Please wait...</span>');
            $.ajax({
                dataType : "json",
                type : "post",
                cache: false,
                // contentType: false,
                //processData: false,
                data : dataStr,
                //headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
                url: '<?php echo base_url('admin/saveQuoteItems'); ?>',
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
                        $("#element_overlapT").LoadingOverlay("show");
                        toastr.remove()
                        toastr.success('<span style="color:#fff;">'+data.message+'</span>');
                        //$('#update-order').trigger('reset');
                        setTimeout(function() {
                            window.location.href = data.redirectUrl;
                        }, 5000);
                    }
                },
                error: function (jqXHR, status, err) {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">Rate not found!</span>');
                }
          });

    });
});
    $('.document_category').on('change', function() {            
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

    $('.package_category').on('change', function() {            
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

    // $(document).on('click','#start_quote',function(){
    //     if(confirm('Are you sure want to create Quote')){
    //         $(this).hide();
    //         $('#start_quore_div').show();   

    //     }
    // });
</script>