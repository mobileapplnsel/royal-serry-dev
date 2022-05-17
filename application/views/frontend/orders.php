<?php defined('BASEPATH') or exit('No direct script access allowed');

$this->load->view('frontend/includes/header');

?>

<style>
   .thead-dark {
      background: #006c16 !important;
      font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif' !important;
      color: #fff;
      font-weight: 400 !important;
      font-size: 14px !important;
   }

   .form-control {
      webkit-box-shadow: none !important;
      box-shadow: none !important;
      border-radius: 0;
      height: 38px !mportant;
      margin-top: 21px !mportant;
   }
</style>

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

                     <h3>Shipment</h3>

                     <a href="<?php echo base_url('order-shipment'); ?>" class="btn btn-success pull-right">Start Shipment</a>


                     <br clear="all">

                     <div style=" width: 100%; display: block; clear: both; height: 6px; border-top: 1px solid #76b382; border-bottom: 1px solid #76b382; margin-top: 10px;"></div>
                     <br clear="all">


                     <div class="table-responsive-sm">

                        <table class="table example1" class="table table-striped">

                           <thead class="thead-dark" style="font-size: 14px;">

                              <tr>

                                 <th class="center">Shipment No</th>

                                 <th class="center">Shipment Date</th>

                                 <th class="center">Shipment Status</th>

                                 <th class="center">Shipment Details</th>


                              </tr>

                           </thead>

                           <tbody>

                              <?php
                              //echo '<pre>';print_r($orders_list);
                              if (!empty($orders_list)) {
                                 foreach ($orders_list as $key => $value) {
                                    if ($value['shipment_status_id'] != '') {
                                       $getStatusName  = $this->customer_model->getShipmentStatusName($value['shipment_status_id']);
                                       $status_name  = (!empty($getStatusName) && $getStatusName['status_name'] != '')?$getStatusName['status_name']:'NA';
                                    } else {
                                       $status_name  = 'NA';
                                    }

                              ?>

                                    <tr>

                                       <td class="center"><?php echo $value['shipment_no']; ?></td>
                                       <td class="center"><?php echo date('m-d-Y', strtotime($value['created_date'])); ?></td>
                                       <td class="center"><?php echo $status_name; ?></td>
                                       <td class="center"><a href="<?php echo base_url('place-order'); ?>/<?php echo $this->OuthModel->Encryptor('encrypt', $value['quotation_id']); ?>" target="_blank">View Details</a></td>

                                    </tr>

                              <?php
                                 }
                              }
                              ?>

                           </tbody>

                        </table>
                     </div>
                  </div>

               </div>

            </div>

            <!--+++++++++++++++++++++++dashboard-end++++++++++++-->

         </div>

         <!--+++++++++++++++++++++++right-side==============-->

      </div>

   </div>

</section>

<?php $this->load->view('frontend/includes/footer'); ?>