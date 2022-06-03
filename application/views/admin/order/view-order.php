<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
                <h1> View Order </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/order-list') ?>"><i class="fa fa-dashboard"></i> Order List </a></li>
                    <li class="active">View Order</li>
                </ol>
            </section>
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <div class="box box-primary">
                        <div class="box-header with-border"> View Order </div>
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
                                    <div class="col-sm-12 col-md-6">
                                        <?php
                                        if (!empty($quote_from_details)) {
                                        ?>
                                            <p class="ds-title-new"><strong>Pickup Address :</strong></p>
                                            <!-- <p class="ds-title-new">Item Description: <?php //echo $quote_from_details[0]['order_created']; 
                                                                                            ?></p> -->
                                            <p class="ds-title-new">Address: <?php echo $quote_from_details[0]['address']; ?></p>
                                            <p class="ds-title-new">Address2: <?php echo $quote_from_details[0]['address2']; ?></p>
                                            <p class="ds-title-new">Company: <?php echo $quote_from_details[0]['company_name']; ?></p>
                                            <p class="ds-title-new">Country: <?php echo $quote_from_details[0]['country_name']; ?></p>
                                            <p class="ds-title-new">City: <?php echo $quote_from_details[0]['city_name']; ?></p>
                                            <p class="ds-title-new">State: <?php echo $quote_from_details[0]['state_name']; ?></p>
                                            <p class="ds-title-new">Zip Code: <?php echo $quote_from_details[0]['zip']; ?></p>
                                            <p class="ds-title-new">Phone No:  <?php
                                                if (!empty($quote_from_details[0]['telephone']) && is_serialized_string($quote_from_details[0]['telephone'])) {
                                                    $telephone = repairSerializeString($quote_from_details[0]['telephone']);
                                                    $telephone = unserialize($telephone);
                                                    //print_r($telephone);
                                                    $telephones = implode(', ', $telephone);
                                                } else {
                                                    $telephones = $quote_from_details[0]['telephone'];
                                                }
                                                echo $telephones;
                                                ?></p>
                                            <p class="ds-title-new">Address Type : <?php echo ($quote_from_details[0]['address_type'] == 0) ? 'Home' : 'Business'; ?></p>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <?php
                                        if (!empty($quote_to_details)) {
                                        ?>
                                            <p class="ds-title-new"><strong>Delivery Address :</strong></p>
                                            <!-- <p class="ds-title-new">Item Description: <?php echo $quote_to_details[0]['order_created']; ?></p> -->
                                            <p class="ds-title-new">Address: <?php echo $quote_to_details[0]['address']; ?></p>
                                            <p class="ds-title-new">Address2: <?php echo $quote_to_details[0]['address2']; ?></p>
                                            <p class="ds-title-new">Company: <?php echo $quote_to_details[0]['company_name']; ?></p>
                                            <p class="ds-title-new">Country: <?php echo $quote_to_details[0]['country_name']; ?></p>
                                            <p class="ds-title-new">City: <?php echo $quote_to_details[0]['city_name']; ?></p>
                                            <p class="ds-title-new">State: <?php echo $quote_to_details[0]['state_name']; ?></p>
                                            <p class="ds-title-new">Zip Code: <?php echo $quote_to_details[0]['zip']; ?></p>
                                            <p class="ds-title-new">Phone No:
                                                <?php
                                                if (!empty($quote_to_details[0]['telephone']) && is_serialized_string($quote_to_details[0]['telephone'])) {
                                                    $telephone = repairSerializeString($quote_to_details[0]['telephone']);
                                                    $telephone = unserialize($telephone);
                                                    //print_r($telephone);
                                                    $telephones = implode(', ', $telephone);
                                                } else {
                                                    $telephones = $quote_to_details[0]['telephone'];
                                                }
                                                echo $telephones;
                                                ?></p>
                                            <p class="ds-title-new">Address Type : <?php echo ($quote_to_details[0]['address_type'] == 0) ? 'Home' : 'Business'; ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <p class="ds-title-new"><strong>Parcel Type: </strong><?php echo (!empty($quote_details) && $quote_details[0]['shipment_type'] == 1) ? 'Document' : 'Package'; ?></p>


                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p class="ds-title-new"><strong>Shipment Type: </strong><?php echo (!empty($quote_from_details) && $quote_details[0]['shipment_type'] == 1) ? 'Domestic' : 'International'; ?></p>

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


                                                    </tr>
                                                </thead>
                                                <tbody style="font-size: 13px;">
                                                    <?php
                                                    //echo '<pre>';print_r($quote_item_details);echo '</pre>';
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

                                                            $qty = ($value['quantity'] > 0) ? $value['quantity'] : '1';
                                                            if ($value['protect_parcel'] == '1') {
                                                                $total += ($rate * $qty) + $value['insur'];
                                                            } else {
                                                                $total += ($rate * $qty);
                                                            }
                                                            $total = number_format((float)$total, 2, '.', '');

                                                            $subtotal += $total;
                                                            $subtotal = number_format((float)$subtotal, 2, '.', '');
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $key + 1; ?></td>
                                                                <td><?php echo $value['item_name']; ?></td>
                                                                <td><?php echo ($value['type'] == 1) ? 'Document' : 'Package'; ?></td>
                                                                <td><?php echo $value['category_name']; ?></td>
                                                                <td><?php echo $description; ?></td>
                                                                <td><?php echo $qty; ?></td>
                                                                <td><?php echo $rate; ?></td>
                                                                <td><?php echo $value['insur']; ?></td>
                                                                <td><?php echo $total; ?></td>

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
                                                <?php
                                                if ($discount > 0) {
                                                ?>
                                                    <tr>
                                                        <td>Discount:</td>
                                                        <td>$<?php echo $discount; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                if (!empty($tax)) {
                                                    // echo '<pre>';print_r($tax);

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

                                                                echo  '$' . $added_ga_tax;
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

                                                                echo  '$' . $added_ga_tax;
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

                                                                echo  '$' . $added_ra_tax;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <!-- RA ends -->

                                                        <tr>
                                                            <td>Total:</td>
                                                            <td><?php echo  '$' . $grand_total; ?></td>
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
                                                                echo  '$' . $grand_total;
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
                                                            echo  '$' . $grand_total;
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
                            <!--<button type="submit" class="btn btn-success">Add Quotation</button>-->
                            <?php if ($this->session->userdata('user_type') == 'MO') { ?>
                                <a href="<?php echo base_url('admin/order-list'); ?>" class="btn btn-info pull-right">Back</a>
                        </div>
                    <?php } else { ?>
                        <a href="<?php echo base_url('admin/pickup-order-list'); ?>" class="btn btn-info pull-right">Back</a>
                    </div>
                <?php } ?>
                </div>
                <?php echo form_close(); ?>
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