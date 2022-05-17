<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo '<pre>'; print_r($categoryList);echo '</pre>';
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
                    Add New Quotation
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/quotation-list') ?>"><i class="fa fa-dashboard"></i> Quotation List </a></li>
                    <li class="active">Add New Quotation</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('quotation/insertquotation'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Add New Quotation </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="parent">Select User<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="customer_id" required>
                                <option value="">Select User</option>
                                <?php
                                    if(!empty($usersList)){
                                        foreach($usersList as $users){
                                ?>
                                <option value="<?= $users->user_id ?>"><?= $users->firstname.' '.$users->lastname.' ('.$users->email.')' ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="status">Location Type<span>*</span> : </label>                        
                            <select class="form-control" name="location_type" id="location_type" required>
                                <option value="1">Domestic</option>
                                <option value="2">International</option>
                            </select>
                        </div>
                        <h5>From Location</h5>
                        <div class="form-group col-md-6">
                            <label for="email">First Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="First Name" name="firstname" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Last Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Line1<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Address Line1" name="address" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Line2 (Optional) : </label>
                            <input type="text" class="form-control" placeholder="Address Line2" name="lastname" value="" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Company (Optional) : </label>
                            <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Country/Territory<span>*</span> : </label>
                            <?php echo fillCombo('countries_master', 'id', 'name', '', 'status = 1', 'id', 'form-control', 'country', 'country', '1'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">State<span>*</span> : </label>
                            <?php //echo fillCombo('states_master', 'id', 'name', '', 'country_id=101', 'id', 'form-control form-control-new', 'state', 'state', '1'); ?>
                            <select class="form-control" name="state" id="state" required>
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">City<span>*</span> : </label>
                            <?php //echo fillCombo('cities_master', 'id', 'name', '', 'state_id=41', 'id', 'form-control form-control-new', 'city_to', 'city_to'); ?>
                            <select class="form-control" name="city_to" id="city_to" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Zip code<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Zip code" name="zip_to" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Address<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Email Address" name="email_to" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Phone no<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Phone no" name="telephone_to" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address Type<span>*</span> : </label>
                            <select class="form-control" name="address_type" id="address_type" required>
                                <option value="1">Home Address</option>
                                <option value="2">Business Address</option>
                            </select>
                        </div>
                        <h5>To Location</h5>
                        
                        
                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">De-Active</option>
                            </select>
                        </div> 
                                              
                        
                        </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Add Quotation</button>
                      <a href="<?php echo base_url('admin/quotation-list'); ?>" class="btn btn-info pull-right">Back</a>
                    </div>
                    </div>
                    <?php echo form_close(); ?>
                    
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