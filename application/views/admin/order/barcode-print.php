<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$year = date("y");
$itemsId = str_pad($this->uri->segment(4), 3, '0', STR_PAD_LEFT);
$shipmentId = str_pad($this->uri->segment(3), 7, '0', STR_PAD_LEFT);  
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Barcode</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
</style> 
<style type="text/css">
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
</head>

<body style=" padding: 0; margin: 0">
<div style=" width: 360px; height: 360px; margin: 0 auto; padding: 10px; display:  block;  border: 1px solid #666768;">
	<div style=" width: 100%; height: 360px; border: 1px solid #000; display:  block;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="45%"><img src="<?php echo base_url(); ?>index.php/container/set_barcode/<?php echo $year.$shipmentId.$itemsId ?>" width="100%" height="50px" alt="barcode" style="margin-top: 5px;margin-left: 5px;"/></td>
      <td width="11%">&nbsp;</td>
      <td width="44%">
      <p style=" font-family: 'Open Sans', sans-serif; font-size: 10px; line-height: 14px; padding: 0; margin: 0;">
	  <?php if($shipment_details['payment_mode']==1)
	  { echo 'Pay Later';} 
	  elseif($shipment_details['payment_mode']==2) 
	  { echo 'Credit / debit /atm Card';}
	  else 
	  { echo 'Credit amount';} ?></p>
      <p style=" font-family: 'Open Sans', sans-serif; font-size: 10px; line-height: 14px; padding: 0; margin: 0;">Order # <?php echo (!empty($shipment_details) && $shipment_details['shipment_no'] != '') ? $shipment_details['shipment_no'] : ''; ?></p>
      <p style=" font-family: 'Open Sans', sans-serif; font-size: 10px; line-height: 14px; padding: 0; margin: 0;">Order Date: <?php echo (!empty($quote_details) && $quote_details[0]['created_date'] != '') ? date('d-m-Y H:i:s',strtotime($quote_details[0]['created_date'])) : DTIME; ?></p>
      </td>
    </tr>
     </tbody>
</table>
<div style=" width: 100%; height: 1px; display: block; background: #a9a9a9;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="padding: 4px 10px;">
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 12px; line-height: 20px; padding: 0; margin: 0;"><strong>Ship To</strong></p>      
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 14px; padding: 0; margin: 0;">Recipient Name : <?php echo $quote_to_details[0]['firstname']; ?> <?php echo $quote_to_details[0]['lastname']; ?></p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Address line1 : <?php echo $quote_to_details[0]['address']; ?></p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Address line 2 : <?php echo $quote_to_details[0]['address2']; ?></p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">State, City, Zip code : <?php echo $quote_to_details[0]['state_name']; ?>, <?php echo $quote_to_details[0]['city_name']; ?>, <?php echo $quote_to_details[0]['zip']; ?>
        </p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Country : <?php echo $quote_to_details[0]['country_name']; ?></p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Contact Number:</p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;"><?php //echo formatPhoneTo($quote_to_details[0]['telephone']); ?><?php echo $quote_to_details[0]['telephone']; ?></p>
      
      </td>
      
    </tr>
  </tbody>
</table>
	<div style=" width: 100%; height: 1px; display: block; background: #a9a9a9;"></div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="padding: 4px 10px;">
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 12px; line-height: 20px; padding: 0; margin: 0;"><strong>Ship From</strong></p>
      
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 14px; padding: 0; margin: 0;">Sender Name : <?php echo $quote_from_details[0]['firstname']; ?> <?php echo $quote_from_details[0]['lastname']; ?> </p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Address line1 : <?php echo $quote_from_details[0]['address']; ?></p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Address line 2 : <?php echo $quote_from_details[0]['address2']; ?></p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">State, City, Zip code : <?php echo $quote_from_details[0]['state_name']; ?>, <?php echo $quote_from_details[0]['city_name']; ?>, <?php echo $quote_from_details[0]['zip']; ?>
        </p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Country : <?php echo $quote_from_details[0]['country_name']; ?></p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Contact Number: </p>
        <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;"><?php echo $quote_from_details[0]['telephone']; ?></p>
        <!-- <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">8765443219</p> -->
      
      </td>
      
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style=" padding: 5px;"><p style=" font-family: 'Open Sans', sans-serif; font-size: 10px; line-height: 14px; padding: 0; margin: 0; text-align: center; padding: 5px0 px; display: block;">Legal Terms Goes Hear. Legal Teams Goes Here</p></td>
    </tr>
  </tbody>
</table>
<div style=" width: 100%; height: 1px; display: block; background: #a9a9a9;"></div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
  <tbody>
    <tr>
      <td width="28%"><img src="<?php echo base_url(); ?>assets/admin/dist/img/barcode-logo.jpg" width="97" height="" alt="" style="margin-left: 5px;" /></td>
      <td width="3%">&nbsp;</td>
      <td width="69%">
      <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Service sold on: royalserry.com</p>
      <p style=" font-family: 'Open Sans', sans-serif; font-size: 9px; line-height: 11px; padding: 0; margin: 0;">Royal Serry </p>
     
      <p style=" font-family: 'Open Sans', sans-serif; font-size:9px; line-height: 11px; padding: 0; margin: 0;">info@royalserry.com</p>
      </td>
    </tr>
     </tbody>
</table>
 
	</div>

</div>
<center>
  <button onclick="window.print()" id="print_button">&nbsp;Print&nbsp;</button>
</center>
</body>
</html>
