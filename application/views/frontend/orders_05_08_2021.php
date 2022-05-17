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

                     <a href="<?php echo base_url('home'); ?>" class="btn btn-success pull-right">Start Shipment</a>


                     <br clear="all">

                     <div style=" width: 100%; display: block; clear: both; height: 6px; border-top: 1px solid #76b382; border-bottom: 1px solid #76b382; margin-top: 10px;"></div>
                     <br clear="all">


                     <div class="table-responsive-sm">

                        <table class="table example1" class="table table-striped">

                           <thead class="thead-dark" style="font-size: 14px;">

                              <tr>

                                 <th class="center">Shipment No</th>

                                 <th>Shipment Date</th>

                                 <th>Shipment Status</th>


                              </tr>

                           </thead>

                           <tbody>

                              <?php foreach ($orders_list as $key => $value) { ?>

                                 <tr>

                                    <td><?php echo $value['shipment_no']; ?></td>

                                    <td><?php echo date('m-d-Y', strtotime($value['created_date'])); ?></td>

                                    <td>
                                    Order Placed
                                        <!-- <a href="<?php echo base_url('view-quote-print'); ?>/<?php echo $this->OuthModel->Encryptor('encrypt', $value['id']); ?>">View Details</a> -->
                                </td>

                                 </tr>

                              <?php } ?>

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