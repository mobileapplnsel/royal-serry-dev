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
                    Edit Subscription
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/subscription-list') ?>"><i class="fa fa-dashboard"></i> Subscriptions List </a></li>
                    <li class="active">Edit Subscription</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <form method="POST" action="<?= base_url('subscription/updateSubscription') ?>/<?= $editSubscription[0]->subscription_id ?>" enctype="multipart/form-data">
                        <div class="form-group col-md-6">
                            <label>IS Popular :</label>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                Yes :
                                <input type="radio" name="is_popular" class="minimal-red" <?php if($editSubscription[0]->is_popular == 1) {echo 'checked';} ?> value="1"/>
                            </label> &nbsp; &nbsp;
                            <label>
                                No :
                                <input type="radio" name="is_popular" class="minimal-red" <?php if($editSubscription[0]->is_popular == 0) {echo 'checked';} ?> value="0"/>
                            </label> &nbsp; &nbsp;                            
                        </div>
						<div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Subscription Name : </label>
                            <input type="text" class="form-control" placeholder="Subscription Name" name="subscription_name" value="<?= $editSubscription[0]->subscription_name ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Subscription Status : </label>                        
                            <select class="form-control" name="subscription_status" required>
                                <option value="">Select Status</option>
                                <option <?php if($editSubscription[0]->subscription_status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editSubscription[0]->subscription_status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Subscription Duration : (No. Of Days)</label>
                            <input type="number" class="form-control" placeholder="Subscription Duration" name="subscription_validity" min="1" value="<?= $editSubscription[0]->subscription_validity ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Subscription Price : </label>
                            <input type="number" class="form-control" placeholder="Subscription Pricing" name="subscription_price" min="1" value="<?= $editSubscription[0]->subscription_price ?>" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Subscription Description : </label>
                            <textarea rows="10" cols="60" class="form-control" name="subscription_brief" style="resize:none;" required><?= $editSubscription[0]->subscription_brief ?></textarea>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label for="pwd">Upload Package Image :</label>
                            <input type="file" class="custom-file-input" name="package_image" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="relatedimage">Related Images : </label>
                            <input type="file" name="files[]" multiple="multiple" accept="image/x-png,image/gif,image/jpeg">
                        </div> -->
                        <div class="form-group col-md-12" style="margin-bottom:15px">
                            <button type="submit" class="btn btn-warning">Update Subscription</button>
                        </div>
                    </form>
                    
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