<?php
//echo '<pre>'; print_r($ShippingModeList); print_r($ShippingCatList); print_r($ShippingDocumentCatList); die;
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
                    Edit Rate
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/rate-list') ?>"><i class="fa fa-dashboard"></i> Rate List </a></li>
                    <li class="active">Edit RAte</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    
                    <?php echo form_open(base_url('rate/updateRate/'.$editRate[0]->id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Edit Rate </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                       
                       
                       	<div class="form-group col-md-6">
                            <label for="parent">Shipping Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_mode_id">
                                <?php
                                    if(!empty($ShippingModeList)){
                                        foreach($ShippingModeList as $ShippingMode){
                                ?>
                                <option value="<?= $ShippingMode->id ?>" <?php if($ShippingMode->id==$editRate[0]->ship_mode_id){ echo "selected";} ?>><?= $ShippingMode->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Delivery Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="delivery_mode_id">
                                <?php
                                    if(!empty($DeliveryModeList)){
                                        foreach($DeliveryModeList as $DeliveryMode){
                                ?>
                                <option value="<?= $DeliveryMode->id ?>" <?php if($DeliveryMode->id==$editRate[0]->delivery_mode_id){ echo "selected";} ?>><?= $DeliveryMode->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_cat_id" id="ship_cat_id">
                                <?php
                                    if(!empty($ShippingCatList)){
                                        foreach($ShippingCatList as $ShippingCat){
                                ?>
                                <option value="<?= $ShippingCat->id ?>" <?php if($ShippingCat->id==$editRate[0]->ship_cat_id){ echo "selected";} ?>><?= $ShippingCat->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Item Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_subcat_id" id="ship_subcat_id">
                                <?php
                                    if(!empty($ShippingDocumentCatList)){
                                        foreach($ShippingDocumentCatList as $ShippingDocumentCat){
                                ?>
                                <option value="<?= $ShippingDocumentCat->cat_id ?>" <?php if($ShippingDocumentCat->cat_id==$editRate[0]->ship_subcat_id){ echo "selected";} ?>><?= $ShippingDocumentCat->category_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="parent">Item Sub-Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="ship_sub_subcat_id" id="ship_sub_subcat_id">
                                <?php
                                    if(!empty($ShippingDocumentSubCatList)){
                                        foreach($ShippingDocumentSubCatList as $ShippingDocumentSubCat){
                                ?>
                                <option value="<?= $ShippingDocumentSubCat->cat_id ?>" <?php if($ShippingDocumentSubCat->cat_id==$editRate[0]->ship_sub_subcat_id){ echo "selected";} ?>><?= $ShippingDocumentSubCat->category_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                       
                       <div class="form-group col-md-6">
                            <label for="status">Rate Type<span>*</span> : </label>                        
                            <select class="form-control" name="rate_type" id="rate_type" required>
                                <option value="D" <?php if($editRate[0]->rate_type == 'D') {echo 'selected';} ?>>Distance</option>
                                <option value="L" <?php if($editRate[0]->rate_type == 'L') {echo 'selected';} ?>>Location</option>
                            </select>
                        </div> 
                        <div id="location_div" <?php if($editRate[0]->rate_type == 'D') {echo 'style="display:none"';} ?> >
                            <div class="form-group col-md-6">
                                <label for="email">From Location Name<span>*</span> : </label>
                                <!--<input type="text" class="form-control" placeholder="From Location Name" name="location_from" id="location_from" value="<?= $editRate[0]->location_from ?>" >-->
                                <?php echo fillCombo('states_master', 'id', 'name', $editRate[0]->location_from, '', 'id', 'form-control', 'location_from', 'location_from'); ?>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="email">To Location Name<span>*</span> : </label>
                               <!-- <input type="text" class="form-control" placeholder="To Location Name" name="location_to" id="location_to" value="<?= $editRate[0]->location_to ?>" >-->
                                <?php echo fillCombo('states_master', 'id', 'name', $editRate[0]->location_to, '', 'id', 'form-control', 'location_to', 'location_to'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Miles<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Miles" name="miles" value="<?= $editRate[0]->miles ?>" onKeyPress="javascript:return isNumber(event)" maxlength="6" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Rate($)<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Rate" name="rate" value="<?= $editRate[0]->rate ?>" onKeyPress="javascript:return isNumber(event)" maxlength="6" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Insurance($)<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Insurance" name="insurance" onKeyPress="javascript:return isNumber(event)" maxlength="6" value="<?= $editRate[0]->insurance ?>" required>
                        </div>
                       
                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option <?php if($editRate[0]->status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editRate[0]->status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div> 
                        </div>                     
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update Rate</button>
                          <a href="<?php echo base_url('admin/rate-list'); ?>" class="btn btn-info pull-right">Back</a>
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