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
            <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('error'); ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?= $this->session->flashdata('success'); ?></div>
        <?php } ?>
            <section class="content-header">
                <h1>
                    Edit Document & Package Category
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/categories-list') ?>"><i class="fa fa-dashboard"></i> Category List </a></li>
                    <li class="active">Edit Category</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('categories/updatecategory/'.$editCategory[0]->cat_id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                        <div class="box box-primary">
                        <div class="box-header with-border"> Edit Details </div>
                        <div class="box-body">
						<div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Category Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Category Name" name="category_name" maxlength="50" value="<?= $editCategory[0]->category_name ?>" onKeyUp="this.value=this.value.replace(/[^A-z_ ]/g,'');" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="destination">Select Parent Category : </label>                        
                            <select class="form-control" name="parent_cat_id">
                                <option value="0">Select Parent Category</option>
                                <?php
                                    if(!empty($parentCategory)){
                                        foreach($parentCategory as $category){
                                ?>
                                <option <?php if($category->cat_id == $editCategory[0]->parent_cat_id) {echo 'selected';} ?> value="<?= $category->cat_id ?>"><?= $category->category_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Category Type<span>*</span> : </label>                        
                            <select class="form-control" name="type" required>
                                <option value="">Select Type</option>
                                <?php
                                    if(!empty($ShippingCatList)){
                                        foreach($ShippingCatList as $ShippingCat){
                                ?>
                                <option value="<?= $ShippingCat->id ?>" <?php if($editCategory[0]->type == $ShippingCat->id) {echo 'selected';} ?>><?= $ShippingCat->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Category Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option <?php if($editCategory[0]->status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editCategory[0]->status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="email">Description<span>*</span> : </label>
                            <textarea rows="10" cols="60" class="form-control" name="category_description" style="resize:none;" required><?= $editCategory[0]->category_description ?></textarea>
                        </div>
                        
                        </div>
                        
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update Category</button>
                          <a href="<?php echo base_url('admin/categories-list'); ?>" class="btn btn-info pull-right">Back</a>
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