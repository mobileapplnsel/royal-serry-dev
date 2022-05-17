<?php
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
                <h6 style="text-align:center; color:red;">
                    <?= $this->session->flashdata('error'); ?>
                </h6>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <h6 style="text-align:center; color:green;">
                    <?= $this->session->flashdata('success'); ?>
                </h6>
            <?php } ?>
            <section class="content-header">
                <h1>
                    All Subscriptions List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addsubscription') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Subscription</a></li>
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Subscriptions List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Subscriptions List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Subscription ID</th>
                                            <th>Subscription Name</th>                 
                                            <th>Subscription Price</th>
                                            <th>Subscription Validity</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($subscriptionList)):
                                            foreach($subscriptionList as $subscription){
                                        ?>
                                        <tr>
                                            <td><?= $subscription->subscription_id ?></td>
                                            <td><?= $subscription->subscription_name ?></td>
                                            <td><?= $subscription->subscription_price ?></td>
                                            <td><?= $subscription->subscription_validity ?> Day/s</td>
                                            <td><?php if($subscription->subscription_status) {echo 'Active';} else {echo 'In-Active';} ?></td>
                                            <td><a href='<?= base_url('admin/editsubscription/')?><?= $subscription->subscription_id ?>'><i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a></td>
                                            <td><a data-toggle="modal" data-target="#subscriptionDeleteModal" data-subscription-id="<?= $subscription->subscription_id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="7">No Subscription Found</td>';
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