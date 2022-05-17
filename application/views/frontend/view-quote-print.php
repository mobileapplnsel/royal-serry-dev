<!DOCTYPE html>
<html lang="en" class="email-area">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <meta charset="utf-8">
  <title>Royal Serry Shipping LLC.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon">
  <link rel="icon" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/dashbord.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Fonts -->


  <title>Quotation</title>
  <style>
    .action-button-Back-new {
      width: 100px;
      background: #fe0000;
      font-weight: 400;
      color: white;
      border: 0 none;
      border-radius: 0px;
      cursor: pointer;
      padding: 10px 5px;
      margin: 10px 5px 10px 0px;
      float: left;
    }

    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 1rem;
      background-color: transparent;
    }

    .table th,
    .table td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #e9ecef;
    }

    .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #e9ecef;
    }

    .table tbody+tbody {
      border-top: 2px solid #e9ecef;
    }

    .table .table {
      background-color: #fff;
    }

    .table-sm th,
    .table-sm td {
      padding: 0.3rem;
    }

    .table-bordered {
      border: 1px solid #e9ecef;
    }

    .table-bordered th,
    .table-bordered td {
      border: 1px solid #e9ecef;
    }

    .table-bordered thead th,
    .table-bordered thead td {
      border-bottom-width: 2px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(0, 0, 0, 0.05);
    }

    .table-hover tbody tr:hover {
      background-color: rgba(0, 0, 0, 0.075);
    }

    .table-primary,
    .table-primary>th,
    .table-primary>td {
      background-color: #b8daff;
    }

    .table-hover .table-primary:hover {
      background-color: #9fcdff;
    }

    .table-hover .table-primary:hover>td,
    .table-hover .table-primary:hover>th {
      background-color: #9fcdff;
    }

    .table-secondary,
    .table-secondary>th,
    .table-secondary>td {
      background-color: #dddfe2;
    }

    .table-hover .table-secondary:hover {
      background-color: #cfd2d6;
    }

    .table-hover .table-secondary:hover>td,
    .table-hover .table-secondary:hover>th {
      background-color: #cfd2d6;
    }

    .table-success,
    .table-success>th,
    .table-success>td {
      background-color: #c3e6cb;
    }

    .table-hover .table-success:hover {
      background-color: #b1dfbb;
    }

    .table-hover .table-success:hover>td,
    .table-hover .table-success:hover>th {
      background-color: #b1dfbb;
    }

    .table-info,
    .table-info>th,
    .table-info>td {
      background-color: #bee5eb;
    }

    .table-hover .table-info:hover {
      background-color: #abdde5;
    }

    .table-hover .table-info:hover>td,
    .table-hover .table-info:hover>th {
      background-color: #abdde5;
    }

    .table-warning,
    .table-warning>th,
    .table-warning>td {
      background-color: #ffeeba;
    }

    .table-hover .table-warning:hover {
      background-color: #ffe8a1;
    }

    .table-hover .table-warning:hover>td,
    .table-hover .table-warning:hover>th {
      background-color: #ffe8a1;
    }

    .table-danger,
    .table-danger>th,
    .table-danger>td {
      background-color: #f5c6cb;
    }

    .table-hover .table-danger:hover {
      background-color: #f1b0b7;
    }

    .table-hover .table-danger:hover>td,
    .table-hover .table-danger:hover>th {
      background-color: #f1b0b7;
    }

    .table-light,
    .table-light>th,
    .table-light>td {
      background-color: #fdfdfe;
    }

    .table-hover .table-light:hover {
      background-color: #ececf6;
    }

    .table-hover .table-light:hover>td,
    .table-hover .table-light:hover>th {
      background-color: #ececf6;
    }

    .table-dark,
    .table-dark>th,
    .table-dark>td {
      background-color: #c6c8ca;
    }

    .table-hover .table-dark:hover {
      background-color: #b9bbbe;
    }

    .table-hover .table-dark:hover>td,
    .table-hover .table-dark:hover>th {
      background-color: #b9bbbe;
    }

    .center {
      text-align: center !important;
    }

    .table-active,
    .table-active>th,
    .table-active>td {
      background-color: rgba(0, 0, 0, 0.075);
    }

    .table-hover .table-active:hover {
      background-color: rgba(0, 0, 0, 0.075);
    }

    .table-hover .table-active:hover>td,
    .table-hover .table-active:hover>th {
      background-color: rgba(0, 0, 0, 0.075);
    }

    .table .thead-dark th {
      color: #fff;
      background-color: #212529;
      border-color: #32383e;
    }

    .table .thead-light th {
      color: #495057;
      background-color: #e9ecef;
      border-color: #e9ecef;
    }

    .table-dark {
      color: #fff;
      background-color: #212529;
    }

    .table-dark th,
    .table-dark td,
    .table-dark thead th {
      border-color: #32383e;
    }

    .table-dark.table-bordered {
      border: 0;
    }

    .table-dark.table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(255, 255, 255, 0.05);
    }

    .table-dark.table-hover tbody tr:hover {
      background-color: rgba(255, 255, 255, 0.075);
    }
  </style>

  <!--  <link rel="stylesheet" href="css/bootstrap.css">-->



</head>

<body style=" padding-top: 50px; padding: 0; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; background: #f0e8e8;">
  <?php
  $subtotal = 0.00;
  $discount = 0.00;
  $total = 0.00;

  ?>

  <div style=" max-width: 900px; margin: 0 auto; display: block; background: #006c16; height: 5px; padding: 0 20px;"></div>
  <div style=" max-width: 900px; margin: 0 auto; display: block; background: #fff; padding: 20px;">
    <!--top1-->
    <div>
      <div style=" width: 30%; float: left;">
        <button type="button" class="btn btn-success btn-send-mail">Send Mail</button>




        <h1 style="font-size: 18px;font-weight: 200;text-transform: uppercase;letter-spacing: 14px;">Royal Serry</h1>
        <img src="<?php echo base_url(); ?>assets/frontend/images/logo.png" width="258" height="109" alt="" />

        <div style="width: 100%; float: left;">
          <h6 style="font-size: 16px;line-height: 36px;padding: 0;margin: 0;font-weight: 500;"><strong>Customer Details:</strong></h6>

          <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Customer Name: <?php echo $quote_from_details[0]['firstname']; ?> <?php echo $quote_from_details[0]['lastname']; ?></p>
          <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Customer Email: <?php echo $quote_from_details[0]['email']; ?></p>
          <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Customer Phone:
            <?php
            if (isset($quote_from_details[0]['telephone'])) {
              if (!empty($quote_from_details[0]['telephone']) && is_serialized_string($quote_from_details[0]['telephone'])) {
                $telephone = repairSerializeString($quote_from_details[0]['telephone']);
                $telephone = unserialize($telephone);
                //print_r($telephone);
                $telephones = implode(', ', $telephone);
              } else {
                $telephones = $quote_from_details[0]['telephone'];
              }
            } else {
              $telephones = 'N/A';
            }
            echo $telephones;
            ?></p>

        </div>

      </div>
      <!--right-->
      <div style=" width: 70%; float: left;">
        <div style=" width: 70%; float: right">
          <p style="font-size: 16px;line-height: 24px;padding: 0;margin: 0;"><strong>Quotation:</strong> #<?php echo $quote_details[0]['quote_no']; ?></p>
          <p style="font-size: 16px;line-height: 24px;padding: 0;margin: 0;"><strong>Date:</strong> <?php echo date('m-d-Y', strtotime($quote_details[0]['created_date'])); ?></p>
          <!-- <p style="font-size: 16px;line-height: 24px;padding: 0;margin: 0;"><strong>Valid Until:</strong>88</p>
  <p style="font-size: 16px;line-height: 24px;padding: 0;margin: 0;"><strong>Customer Number:</strong>AURTH1587</p> -->
        </div>
        <div style=" width: 100%; display: block; clear: both; height: 2px;"></div>

        <div style=" width: 70%; float: right">
          <div style="width: 50%; float: left;">
            <h6 style="font-size: 16px;line-height: 36px;padding: 0;margin: 0;font-weight: 500;">Pickup Address:</h6>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;"><?php echo $quote_from_details[0]['address']; ?></p>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;"><?php echo $quote_from_details[0]['address2']; ?></p>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Email: <?php echo $quote_from_details[0]['email']; ?></p>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Phone: <?php echo $telephones; ?></p>

            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Zip Code: <?php echo $quote_from_details[0]['zip']; ?></p>
          </div>
          <div style="width: 50%; float: left;">
            <h6 style="font-size: 16px;line-height: 36px;padding: 0;margin: 0;font-weight: 500;">Delivery Address:</h6>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;"><?php echo $quote_to_details[0]['address']; ?></p>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;"><?php echo $quote_to_details[0]['address2']; ?></p>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Email: <?php echo $quote_to_details[0]['email']; ?></p>
            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Phone:
              <?php
              if (isset($quote_to_details[0]['telephone'])) {
                if (!empty($quote_to_details[0]['telephone']) && is_serialized_string($quote_to_details[0]['telephone'])) {
                  $telephone = repairSerializeString($quote_to_details[0]['telephone']);
                  $telephone = unserialize($telephone);
                  //print_r($telephone);
                  $telephones = implode(', ', $telephone);
                } else {
                  $telephones = $quote_to_details[0]['telephone'];
                }
              } else {
                $telephones = 'N/A';
              }
              echo $telephones;
              ?></p>

            <p style="font-size: 14px;line-height: 20px;padding: 0;margin: 0;">Zip Code: <?php echo $quote_to_details[0]['zip']; ?></p>

          </div>

        </div>
        <div style=" width: 100%; display: block; clear: both; height: 10px;"></div>
        <!--Shipment Type:-->
        <div style=" width: 70%; float: right">
          <div style="width: 50%; float: left;">
            <p style="font-size: 16px;line-height: 24px;padding: 0;margin: 0;"><strong>Shipment Type:</strong> <?php echo (($quote_details[0]['location_type'] == 1) ? 'Domestic' : 'International'); ?></p>
          </div>
          <div style="width: 50%; float: left;">
            <p style="font-size: 16px;line-height: 24px;padding: 0;margin: 0;"><strong>Shipment Mode:</strong>
              <?php
              if ($quote_details[0]['transport_type'] == 1) {
                echo 'Road';
              } else if ($quote_details[0]['transport_type'] == 2) {
                echo 'Rail';
              } else if ($quote_details[0]['transport_type'] == 3) {
                echo 'Air';
              } else if ($quote_details[0]['transport_type'] == 4) {
                echo 'Ship';
              } else {
                echo 'Old data!';
              } ?></p>
          </div>
        </div>
        <!--Shipment Type:-->
      </div>
      <!--right-->
      <div style=" width: 100%; display: block; clear: both; height: 2px;"></div>

    </div>
    <!--top1-end-->
    <div style=" width: 100%; display: block; clear: both; height: 40px; border-top: 1px solid #76b382; border-bottom: 1px solid #76b382; margin-top: 10px;"></div>

    <!--mid1-->
    <div>
      <div class="table-responsive-sm">
        <table class="table table-striped">
          <thead style="font-size: 14px;">
            <tr>
              <th class="center">No.</th>
              <th class="center">Category</th>
              <th class="center">Subcategory</th>
              <th class="center">Item Type</th>
              <th class="center">Description</th>
              <th class="center">Qty</th>
              <th class="center">Rate</th>
              <th class="center">Insurance</th>
              <th class="center">Insur. Total</th>
              <th class="center">Amount</th>
            </tr>
          </thead>
          <tbody style="font-size: 13px;">
            <?php
            $total = 0;
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
              //$rate_withqty = ($rate * $qty);
              $total += $rate + $insur_withqty;
              //$total += ($rate * $qty) + $insur_withqty;
              $total = number_format((float)$total, 2, '.', '');

              $subtotal += $total;
              $subtotal = number_format((float)$subtotal, 2, '.', '');
            ?>
              <tr>
                <td class="center"><?php echo $key + 1; ?></td>
                <td class="center"><?php echo $value['category_name']; ?></td>
                <td class="center"><?php echo $value['subcategory_name']; ?></td>
                <td class="center"><?php echo $value['item_name']; ?></td>
                <td class="center"><?php echo $description; ?></td>
                <td class="center"><?php echo $qty; ?></td>
                <td class="center"><?php echo $rate; ?></td>
                <td class="center"><?php echo $insur; ?></td>
                <td class="center"><?php echo $insur_withqty; ?></td>
                <td class="center"><?php echo $total; ?></td>

              </tr>
            <?php
              $total = 0;
            } ?>
          </tbody>
        </table>
      </div>

    </div>
    <!--mid1end-->
    <div style=" width: 100%; display: block; clear: both; height: 40px; border-top: 1px solid #e22929; border-bottom: 1px solid #e22929; margin-top: 10px;"></div>
    <!--bottom-->
    <div style=" width: 60%; float: left;">
      <div style=" width: 80%; background: #f2f2f2; margin:5%;padding: 5%;min-height: 172px;">
        Instruction:
      </div>
    </div>
    <div style=" width: 40%; float: left;margin-top: 2.5%;">
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

                  echo  '$' . number_format((float)$added_ga_tax, 2, '.', '');
                  ?>
                </td>
              </tr>

              <tr>
                <td>Total:</td>
                <td><?php echo  '$' . number_format((float)$grand_total, 2, '.', ''); ?></td>
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

                  echo  '$' . number_format((float)$added_ga_tax, 2, '.', '');
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

                  echo  '$' . number_format((float)$added_ra_tax, 2, '.', '');
                  ?>
                </td>
              </tr>
              <!-- RA ends -->

              <tr>
                <td>Total:</td>
                <td><?php echo  '$' . number_format((float)$grand_total, 2, '.', ''); ?></td>
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
                  echo  '$' . number_format((float)$grand_total, 2, '.', '');
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
                echo  '$' . number_format((float)$grand_total, 2, '.', '');
                ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <!--bottom-end-->
    <div style=" width: 100%; display: block; clear: both; height: 2px;"></div>
  </div>
  <div style=" max-width: 900px; margin: 0 auto; display: block; background: #fe0000; height: 8px; padding: 0 20px;"></div>

  <div class="container">


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Send Quotation Email</h4>
          </div>
          <div class="modal-body">
            <form id="form-send-mail">
              <div class="form-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="Email*" required>
              </div>
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name*" required>
              </div>
              <span class="modal-msg"></span>
              <button type="button" class="btn btn-default action-button-Back-new send-mail">Send</button>
            </form>
            <div class="spacer"></div>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default action-button-Back-new" data-dismiss="modal">Close</button>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('.btn-send-mail').on('click', function() {
        $('#myModal').modal('toggle');
        $('#myModal').modal('show');
        //$('#myModal').modal('hide');
      });

      $('.send-mail').on('click', function() {

        var html = $('.email-area').html();
        var email_to = $('#email').val();
        var name = $('#name').val();
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
          csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        //console.log(html)

        if (email_to != '' && name != '') {
          $('.modal-msg').html('');
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url('CustomerController/sendQuoteEmail'); ?>',
            data: {
              [csrfName]: csrfHash,
              email_to: email_to,
              name: name,
              email_body: '"' + html + '"'
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
    });
  </script>




</body>

</html>