<?php //echo '<pre>'; print_r($shipment_details); echo '</pre>'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
	<title>Print Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		.invoice-title h2,
		.invoice-title h3 {
			display: inline-block;
		}

		.table>tbody>tr>.no-line {
			border-top: none;
		}

		.table>thead>tr>.no-line {
			border-bottom: none;
		}

		.table>tbody>tr>.thick-line {
			border-top: 2px solid;
		}

		#print_button {
			background-color: #236c1f;
			color: white;
			font-size: 16px;
			padding: 8px 16px;
			margin-right: 10px;
			margin-top: 3px;
			display: block;
			border-radius: 25px;
			cursor: pointer;
		}

		@media print {
			#print_button {
				display: none;
			}
		}
	</style>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="invoice-title">
					<h2>Invoice</h2>
					<h3 class="pull-right">Order # <?php echo (!empty($shipment_details) && $shipment_details['shipment_no'] != '') ? $shipment_details['shipment_no'] : ''; ?></h3>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Billed To:</strong><br>
							<?php echo $quote_from_details[0]['firstname'] . ' ' . $quote_from_details[0]['lastname']; ?><br>
							<?php echo $quote_from_details[0]['address']; ?> <?php echo $quote_from_details[0]['address2']; ?><br>
							<?php echo $quote_from_details[0]['city_name']; ?><br>
							<?php echo $quote_from_details[0]['state_name']; ?>, <?php echo $quote_from_details[0]['country_name']; ?> <?php echo $quote_from_details[0]['zip']; ?>
						</address>
					</div>
					<div class="col-xs-6 text-right">
						<address>
							<strong>Shipped To:</strong><br>
							<?php echo $quote_to_details[0]['firstname'] . ' ' . $quote_to_details[0]['lastname']; ?><br>
							<?php echo $quote_to_details[0]['address']; ?> <?php echo $quote_to_details[0]['address2']; ?><br>
							<?php echo $quote_to_details[0]['city_name']; ?><br>
							<?php echo $quote_to_details[0]['state_name']; ?>, <?php echo $quote_to_details[0]['country_name']; ?> <?php echo $quote_to_details[0]['zip']; ?>
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Payment Method:</strong><br>
							<?php if ($shipment_details['payment_mode'] == 3) {
								echo 'Credit';
							} elseif ($shipment_details['payment_mode'] == 2) {
								echo 'Card';
							} else {
								echo 'Pay later';
							} ?><br>
							<?php echo $quote_from_details[0]['email']; ?>
						</address>
					</div>
					<div class="col-xs-6 text-right">
						<address>
							<strong>Order Date:</strong><br>
							<?php echo (!empty($quote_details) && $quote_details[0]['created_date'] != '') ? date("F j, Y", strtotime($quote_details[0]['created_date'])) : DTIME; ?><br><br>
						</address>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Order summary</strong></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<!--<tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>-->
									<tr>
										<td class="text-center"><strong>No.</strong></td>
										<td class="text-center"><strong>Category</strong></td>
										<td class="text-center"><strong>Subcategory</strong></td>
										<td class="text-center"><strong>Item Type</strong></td>
										<td class="text-center"><strong>Description</strong></td>
										<td class="text-center"><strong>Qty</strong></td>
										<td class="text-center"><strong>Rate</strong></td>
										<td class="text-center"><strong>Insurance</strong></td>
										<td class="text-center"><strong>Insur. Total</strong></td>
										<td class="text-right"><strong>Amount</strong></td>
									</tr>
								</thead>
								<tbody>
									<!--<tr>
    								<td>BS-200</td>
    								<td class="text-center">$10.99</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$10.99</td>
    							</tr>-->
									<?php
									$subtotal = 0.00;
									$discount = 0.00;
									$total = 0.00;
									//echo '<pre>';print_r($quote_details);die;
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

										$qty = ($value['quantity'] > 0) ? $value['quantity'] : '1';
										$insur = ($value['insur'] != 0) ? $value['insur'] : '0.00';
										$insur_withqty = ($insur * $qty);
										$insur_withqty = number_format((float)$insur_withqty, 2, '.', '');
										$total += ($rate * $qty) + $insur_withqty;
										$total = number_format((float)$total, 2, '.', '');

										$subtotal += $total;
										$subtotal = number_format((float)$subtotal, 2, '.', '');
									?>
										<tr>
											<td class="text-center"><?php echo $key + 1; ?></td>
											<td class="text-center"><?php echo $value['category_name']; ?></td>
											<td class="text-center"><?php echo $value['subcategory_name']; ?></td>
											<td class="text-center"><?php echo $value['item_name']; ?></td>
											<td class="text-center"><?php echo $description; ?></td>
											<td class="text-center"><?php echo $qty; ?></td>
											<td class="text-center"><?php echo $rate; ?></td>
											<td class="text-center"><?php echo $insur; ?></td>
											<td class="text-center"><?php echo $insur_withqty; ?></td>
											<td class="text-right"><?php echo $total; ?></td>
										</tr>
									<?php
										$total = 0;
									} ?>



									<tr>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line text-center"><strong>Subtotal</strong></td>
										<td class="thick-line text-right">$<?php echo $subtotal; ?></td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<?php
										if ($discount > 0) {
										?>
											<td class="no-line text-center"><strong>Discount</strong></td>
											<td class="no-line text-right">$<?php echo $discount; ?></td>
										<?php
										}
										?>


									</tr>
									<?php
									if (!empty($tax)) {
										// echo '<pre>';print_r($tax);

										if (isset($tax[0]['type']) && !isset($tax[1]['type']) && $tax[0]['type'] == 'GA') {
											//GA only
									?>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong><?php echo $tax[0]['type'] . ' Tax (' . $tax[0]['amount'] . '%)'; ?></strong></td>
												<td class="no-line text-right">
													<?php
													$discounted_total = ($subtotal - $discount);
													$added_ga_tax = ($discounted_total * $tax[0]['amount']) / 100;
													$grand_total = ($discounted_total + $added_ga_tax);

													echo  '$' . $added_ga_tax;
													?>
												</td>
											</tr>

											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong>Total</strong></td>
												<td class="no-line text-right"><?php echo  '$' . $grand_total; ?></td>
											</tr>
										<?php
										} else if (isset($tax[0]['id']) && isset($tax[1]['id'])) {
											//GA & RA
										?>
											<!-- GA starts -->
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong><?php echo $tax[0]['type'] . ' Tax (' . $tax[0]['amount'] . '%)'; ?></strong></td>
												<td class="no-line text-right">
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
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong><?php echo $tax[1]['type'] . ' Tax (' . $tax[1]['amount'] . '%)'; ?></strong></td>
												<td class="no-line text-right">
													<?php
													$added_ra_tax = ($added_ga_tax * $tax[1]['amount']) / 100;
													$grand_total = ($total_with_tax + $added_ra_tax);

													echo  '$' . $added_ra_tax;
													?>
												</td>
											</tr>
											<!-- RA ends -->

											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong>Total</strong></td>
												<td class="no-line text-right"><?php echo  '$' . $grand_total; ?></td>
											</tr>
										<?php
										} else {
											//RA only
										?>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-center"><strong>Total</strong></td>
												<td class="no-line text-right">
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
											<td class="no-line"></td>
											<td class="no-line"></td>
											<td class="no-line"></td>
											<td class="no-line"></td>
											<td class="no-line"></td>
											<td class="no-line"></td>
											<td class="no-line"></td>
											<td class="no-line"></td>
											<td class="no-line text-center"><strong>Total</strong></td>
											<td class="no-line text-right">
												<?php
												$grand_total = ($subtotal - $discount);
												echo  '$' . $grand_total;
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!--<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">$685.99</td>
    							</tr>-->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<center>
		<button onClick="window.print()" id="print_button">&nbsp;Print&nbsp;</button>
	</center>
</body>

</html>