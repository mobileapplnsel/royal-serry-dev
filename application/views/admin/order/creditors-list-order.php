<?php
//echo '<pre>'; print_r($orderList);echo '</pre>';
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <div class="content-wrapper">
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <section class="content-header">
                <h1>
                    All Credit Order List
                </h1>
                <ol class="breadcrumb">
                    <!--<li><a href="<?= base_url('admin/adddocument') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Quotation</a></li>-->
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Credit Order List</li>
                </ol>
            </section>
            <section class="content-header">
                <div class="row">
                    <div class="col-xs-12">    
                        <div class="box">
                            <div class="box-body">   
                                <?php echo form_open(base_url('admin/creditors-order-list'), array('id' => 'searchF', 'class' => 'form-inline','method'=>'POST', 'enctype' => 'multipart/form-data')); ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>From Date</label>
                                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="mm-dd-yyyy" value="<?php echo $from_date; ?>" readonly>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>To Date</label>
                                        <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="mm-dd-yyyy" value="<?php echo $to_date; ?>" readonly>
                                    </div>
                                    <div class="col-sm-4">                                        
                                        <input type="submit" name="search" id="search" class="btn btn-success" value="Search"> 
                                        <a href="<?php echo base_url('admin/creditors-order-list'); ?>" class="btn btn-success">Reset</a>                                        
                                    </div>                                    
                                </div>                                
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Credit Order List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Order No</th>
                                            <th>Customer Name</th>
                                            <th>Ordered Date</th>
                                            <th>Amount($)</th>
                                            <th>Payment Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($orderList)):
                                            foreach($orderList as $order){
                                        ?>
                                        <tr>
                                            <td><?= $order->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/vieworder/')?><?= $order->id ?>" class="btn" style="text-align: left"><i class="fa fa-eye text-blue"></i> View Order</a> </li>
                                                    
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $order->shipment_no ?></td>
                                            <td><?= $order->firstname.' '.$order->lastname ?></td>
                                            <td><?= date("m-d-Y", strtotime($order->created_date)); ?></td>
                                            <td><?= $order->grand_total ?></td>
                                            <td><?php if($order->payment_mode==3)
												{ echo 'Credit';} 
												elseif($order->payment_mode==2)
												{ echo 'Card';}
												else { echo 'Pay later';} ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="7">No Credit Order Found</td>';
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>                    
                        </div>
                        <div class="box">
                            
                        </div>
                    </div>            
                </div>
            </section>
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