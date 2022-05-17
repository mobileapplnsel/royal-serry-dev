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
                    Edit Package
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/package-list') ?>"><i class="fa fa-dashboard"></i> Package List </a></li>
                    <li class="active">Edit Package</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    
                    <?php echo form_open(base_url('package/updatePackage/'.$editPackage[0]->package_id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Edit Package </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                       
                        <div class="form-group col-md-6">
                            <label for="email">Package Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Package Name" name="name" maxlength="20" onKeyUp="this.value=this.value.replace(/[^A-z_ ]/g,'');" value="<?= $editPackage[0]->name ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Package Category<span>*</span>: </label>                        
                            <select class="form-control cast-crew-multiple" name="category_id" required>
                                <option value="">Select Package Category</option>
                                <?php
                                    if(!empty($categoryList)){
                                        foreach($categoryList as $category){
                                ?>
                                <option value="<?= $category->cat_id ?>" <?php if($category->cat_id==$editPackage[0]->category_id){ echo "selected";} ?>><?= $category->category_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Package Description<span>*</span> : </label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Package Description ..." required><?= $editPackage[0]->description ?></textarea>
                        </div>
                        

                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option <?php if($editPackage[0]->status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editPackage[0]->status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div> 
                        </div>                     
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update Package</button>
                          <a href="<?php echo base_url('admin/package-list'); ?>" class="btn btn-info pull-right">Back</a>
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