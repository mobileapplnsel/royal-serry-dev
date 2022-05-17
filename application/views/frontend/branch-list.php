<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('frontend/includes/header');
$locationArr = array();
foreach ($branchList as $key => $value) {
   $locationArr[$value->city] = $value->city_name;
}
$loc_rr = array_unique($locationArr);
//print_r($loc_rr);
?>
<style type="text/css">
 @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");

        /* Responsive table */
        @media only screen and (max-width: 800px) {

            /* Force table to not be like tables anymore */
            #no-more-tables table,
            #no-more-tables thead,
            #no-more-tables tbody,
            #no-more-tables th,
            #no-more-tables td,
            #no-more-tables tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #no-more-tables tr {
                border: 1px solid #ccc;
            }

            #no-more-tables td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50% !important;
                white-space: normal;
                text-align: left;
            }

            #no-more-tables td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }

            /*
    Label the data
    */
            #no-more-tables td:before {
                content: attr(data-title);
            }
        }

        .cf {
            margin-bottom: 0;
        }

        .collapsed .branch-c {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            color: #000;
            font-weight: bold;
        }
        .branch-c {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            color: #fff;
            font-weight: bold;
        }
        .cf thead tr th {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            color: #000;
            background: #f1fbff;
        }

        .cf tr td {
            padding: 8px !important;
            font-size: 14px;
            color: #333;
            font-weight: 400;
            font-family: 'Open Sans', sans-serif;
        }

        .cf tr td a,
        .cf tr td a:hover,
        .cf tr td a:focus {
            font-size: 14px;
            color: #333;
            font-weight: 400;
            font-family: 'Open Sans', sans-serif;
            text-decoration: none;
        }

        .cf tr td:first-child {
            font-weight: bold;
        }

        .bracnches-wrapper-c {
            padding: 50px 0;
        }

        /* Collapse style */
        a:hover,
        a:focus {
            outline: none;
            text-decoration: none;
        }

        #accordion .panel {
            border: none;
            outline: none;
        }

        #accordion .panel-heading {
            padding: 0;
        }

        #accordion .panel-heading>.panel-title {
            position: relative;
        }

        #accordion .panel-heading>.panel-title>a {
            display: block;
            font-size: 14px;
            padding: 18px 35px 18px 15px;
            text-transform: uppercase;
            background: #fe0000;
            color: #fff;
            transition: all 0.2s linear 0s;
        }

        #accordion .panel-title>a.collapsed {
            background: transparent;
            color: #333;
        }

        #accordion .panel-title>a.collapsed:hover {
            color: #3498db;
        }

        #accordion .panel-title>a:after,
        #accordion .panel-title>a.collapsed:after {
            content: "\f139";
            font: normal normal normal 18px/1 FontAwesome;
            font-weight: 900;
            color: #fff;
            font-size: 18px;
            line-height: 20px;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translate(0%, -50%);
        }

        #accordion .panel-title>a.collapsed:after {
            content: "\f13a";
            color: #808080;
        }

        #accordion .panel-body {
            border: none;
        }
    </style>
<section class="blog-news-section">
   <div class="container">
      <div class="row">        
                <div class="col-md-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                     <?php $i=1; foreach ($loc_rr as $locKey => $locValue) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading<?php echo $locKey; ?><?php echo $i; ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $locKey; ?><?php echo $i; ?>"
                                        aria-expanded="true" aria-controls="collapse<?php echo $locKey; ?><?php echo $i; ?>">
                                        <div class="branch-c">Location: <?php echo $locValue; ?></div>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo $locKey; ?><?php echo $i; ?>" class="panel-collapse collapse <?php echo (($i == 1) ? 'in' : '');?>" role="tabpanel"
                                aria-labelledby="heading<?php echo $locKey; ?><?php echo $i; ?>">
                                <div class="panel-body">
                                    <div id="no-more-tables">
                                        <table class="table table-bordered table-striped table-condensed cf">
                                            <thead>
                                                <tr>
                                                    <th>Branch Name</th>
                                                    <th>Email</th>
                                                    <th>Telephone</th>
                                                    <th>Address</th>
                                                    <th>Contact Person</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $brachCityWise = $this->branch_model->getBranchList('1',$locKey);
                                                foreach ($brachCityWise as $Bkey => $Bvalue) { ?>
                                                <tr>
                                                    <td data-title="Branch Name"><?php echo $Bvalue->name;?></td>
                                                    <td data-title="Email"><?php echo $Bvalue->email;?></td>
                                                    <td data-title="Telephone"><a href="tel:<?php echo $Bvalue->country_code.$Bvalue->telephone;?>"><?php echo $Bvalue->country_code.$Bvalue->telephone;?></a>
                                                    </td>
                                                    <td data-title="Address"><?php echo $Bvalue->address;?></td>
                                                    <td data-title="Contact Person"><?php echo $Bvalue->contact_person;?></td>
                                                </tr>
                                             <?php } ?>
                                                <!-- <tr>
                                                    <td data-title="Branch Name">Singapore</td>
                                                    <td data-title="Email">11@gmail.com</td>
                                                    <td data-title="Telephone"><a href="tel:7300488416">7300488416</a>
                                                    </td>
                                                    <td data-title="Address">Singapore street, Singapore, Singapore,
                                                        Singapore -
                                                        199011</td>
                                                    <td data-title="Contact Person">alexa</td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <?php $i++; } ?>  
                      
                    </div>
                </div>
            </div>
   </div>
</section>
<?php $this->load->view('frontend/includes/footer');?>