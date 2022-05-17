<?php
//echo '<pre>'; print_r($orderList); echo '</pre>';
$CI = &get_instance();
$CI->load->model('order_model');
defined('BASEPATH') or exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->view('admin/include/header');
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php
    $this->load->view('admin/include/sidebar');
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Dashboard
          <!--  <small>Version 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Info boxes -->
        <div class="row">
          <?php if ($this->session->userdata('user_type') == 'MO' || $this->session->userdata('user_type') == 'BO') { ?>
            <?php if ($this->session->userdata('user_type') == 'BO') { ?>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Pickup Orders</span>
                    <span class="info-box-number"><a href="<?= base_url('admin/pickup-order-list') ?>"><?php echo number_format($TotalPickedUp); ?></a></span>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Delivery Orders</span>
                    <span class="info-box-number"><a href="<?= base_url('admin/delivery-order-list') ?>"><?php echo number_format($TotalDeliverd); ?></a></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number"><a href="<?= base_url('admin/branch-users-list') ?>"><?php echo number_format($TotalUsers); ?></a></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            <?php } ?>
            <!-- /.col -->
            <?php if ($this->session->userdata('user_type') == 'MO') { ?>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-quora"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Quotation</span>
                    <span class="info-box-number"><a href="<?= base_url('admin/quotation-list') ?>"><?php echo number_format($TotalQuotation); ?></a></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Orders</span>
                    <?php if ($this->session->userdata('user_type') == 'MO') { ?>
                      <span class="info-box-number"><a href="<?= base_url('admin/order-list') ?>"><?php echo number_format($TotalOrders); ?></a></span>
                    <?php } else { ?>
                      <span class="info-box-number"><?php echo number_format($TotalOrders); ?></span>
                    <?php } ?>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number"><a href="<?= base_url('admin/users-list') ?>"><?php echo number_format($TotalUsers); ?></a></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            <?php } ?>
          <?php } ?>

          <?php if ($this->session->userdata('user_type') == 'PDB') { ?>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Current Pickup</span>
                  <span class="info-box-number"><a href="<?= base_url('admin/pdboy-pickup-order-list') ?>"><?php echo number_format($CurrentTotalPickedUp); ?></a></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Current Delivery</span>
                  <span class="info-box-number"><a href="<?= base_url('admin/pdboy-delivery-order-list') ?>"><?php echo number_format($CurrentTotalDeliverd); ?></a></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Picked-up orders</span>
                  <span class="info-box-number"><a href="<?= base_url('admin/pdboy-pickup-order-history-list') ?>"><?php echo number_format($TotalPickedUp); ?></a></span>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Delivered orders</span>
                  <span class="info-box-number"><a href="<?= base_url('admin/pdboy-delivery-order-history-list') ?>"><?php echo number_format($TotalDeliverd); ?></a></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

          <?php } ?>
        </div>
        <!-- /.row -->


        <!-- /.row -->

        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">
                  <?php if ($this->session->userdata('user_type') == 'MO') {
                    echo 'Latest Orders';
                  } else {
                    echo 'Latest Pickup/Delivery Orders';
                  }
                  ?>
                </h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Order Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!empty($orderList)) :
                        foreach ($orderList as $order) {
                      ?>
                          <tr>
                            <td><a href="<?= base_url('admin/vieworder/') ?><?= $order->id ?>"><?= $order->shipment_no ?></a></td>
                            <td><?= $order->firstname . ' ' . $order->lastname ?></td>
                            <td><?= date("m-d-Y", strtotime($order->created_date)); ?></td>
                            <?php
                            if ($this->session->userdata('user_type') == 'PDB') {
                              if ($order->order_type == 1) {
                                echo '<td><span class="label label-warning">Not-Pickup</span></td>';
                              } else {
                                echo '<td><span class="label label-warning">Not-Delivered</span></td>';
                              }
                            } else {
                              $order_status = $this->order_model->getOrderStatusDetails($order->id);
                              if (!empty($order_status)) {
                                foreach ($order_status as $val) {
                            ?>
                                  <td><span class="label label-success"><?= $val['status_name'] ?></span></td>
                                <?php }
                              } else {
                                ?>
                                <td><span class="label label-success">Ready for Pickup</span></td>
                            <?php
                              }
                            } ?>
                          </tr>
                      <?php
                        }
                      else :
                        echo '<td rowspan="4">No Order Found</td>';
                      endif;
                      ?>
                      <!--<tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="label label-warning">Pending</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f39c12" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="label label-danger">Delivered</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f56954" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="label label-info">Processing</span></td>
                            <td>
                              <div class="sparkbar" data-color="#00c0ef" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="label label-warning">Pending</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f39c12" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="label label-danger">Delivered</span></td>
                            <td>
                              <div class="sparkbar" data-color="#f56954" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                            <td>Call of Duty IV</td>
                            <td><span class="label label-success">Shipped</span></td>
                            <td>
                              <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                            </td>
                          </tr>-->
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <?php if ($this->session->userdata('user_type') == 'MO') { ?>
                  <!--<a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>-->
                  <a href="<?php echo base_url('admin/order-list'); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                <?php } elseif ($this->session->userdata('user_type') == 'BO') { ?>
                  <a href="<?php echo base_url('admin/pickup-order-list'); ?>" class="btn btn-sm btn-info btn-flat pull-left"> All Pickup Orders</a>
                  <a href="<?php echo base_url('admin/delivery-order-list'); ?>" class="btn btn-sm btn-default btn-flat pull-right"> All Delivery Orders</a>
                <?php } else { ?>
                  <a href="<?php echo base_url('admin/pdboy-pickup-order-list'); ?>" class="btn btn-sm btn-info btn-flat pull-left"> All Pickup Orders</a>
                  <a href="<?php echo base_url('admin/pdboy-delivery-order-list'); ?>" class="btn btn-sm btn-default btn-flat pull-right"> All Delivery Orders</a>
                <?php } ?>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- PRODUCT LIST -->
            <?php /*?><div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Recently Container List</h3>
        
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                        <li class="item">
                          <div class="product-img">
                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">Samsung TV
                              <span class="label label-warning pull-right">$1800</span></a>
                            <span class="product-description">
                                  Samsung 32" 1080p 60Hz LED Smart HDTV.
                                </span>
                          </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                          <div class="product-img">
                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">Bicycle
                              <span class="label label-info pull-right">$700</span></a>
                            <span class="product-description">
                                  26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                </span>
                          </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                          <div class="product-img">
                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                            <span class="product-description">
                                  Xbox One Console Bundle with Halo Master Chief Collection.
                                </span>
                          </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                          <div class="product-img">
                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">PlayStation 4
                              <span class="label label-success pull-right">$399</span></a>
                            <span class="product-description">
                                  PlayStation 4 500GB Console (PS4)
                                </span>
                          </div>
                        </li>
                        <!-- /.item -->
                      </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="javascript:void(0)" class="uppercase">View All Products</a>
                    </div>
                    <!-- /.box-footer -->
                  </div><?php */ ?>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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