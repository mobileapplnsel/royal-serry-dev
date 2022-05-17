<?php
//echo '<pre>'; print_r($editBranch); die;
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
                    Edit Prohibited
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/prohibited-list') ?>"><i class="fa fa-dashboard"></i> Prohibited List </a></li>
                    <li class="active">Edit Prohibited</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    
                    <?php echo form_open(base_url('prohibited/updateProhibited/'.$editProhibited[0]->prohibited_id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Edit Prohibited </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                       
                        <div class="form-group col-md-6">
                            <label for="email">Prohibited Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Prohibited Name" name="name" onKeyUp="this.value=this.value.replace(/[^A-z_ ]/g,'');" maxlength="20" value="<?= $editProhibited[0]->name ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Category<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="shipping_category_id" required>
                                <option value="">Select Shipping Category</option>
                                <?php
                                    if(!empty($ShippingCategoryList)){
                                        foreach($ShippingCategoryList as $scategory){
                                ?>
                                <option value="<?= $scategory->id ?>" <?php if($scategory->id==$editProhibited[0]->shipping_category_id){ echo "selected";} ?>><?= $scategory->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Shipping Mode<span>*</span> : </label>                        
                            <select class="form-control cast-crew-multiple" name="shipping_mode_id" required>
                                <option value="">Select Shipping Mode</option>
                                <?php
                                    if(!empty($ShippingModeList)){
                                        foreach($ShippingModeList as $mcategory){
                                ?>
                                <option value="<?= $mcategory->id ?>" <?php if($mcategory->id==$editProhibited[0]->shipping_mode_id){ echo "selected";} ?>><?= $mcategory->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Status<span>*</span> : </label>                        
                            <select class="form-control" name="status" required>
                                <option <?php if($editProhibited[0]->status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editProhibited[0]->status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Prohibited Description<span>*</span> : </label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Prohibited Description ..." required><?= $editProhibited[0]->description ?></textarea>
                        </div>
                        

                         
                        </div>                     
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update Prohibited</button>
                          <a href="<?php echo base_url('admin/prohibited-list'); ?>" class="btn btn-info pull-right">Back</a>
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