<?php
//echo '<pre>'; print_r($parentCategory);echo '</pre>';
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
                    Add New Document & Packages Category
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/categories-list') ?>"><i class="fa fa-dashboard"></i> Category List </a></li>
                    <li class="active">Add New Category</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('categories/insertcategory'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                        <div class="box-header with-border"> Add Category </div>
                        <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Category Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Category Name" name="category_name" maxlength="50"  value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Parent Category : </label>                        
                            <select class="form-control" name="parent_cat_id">
                                <option value="">Select Parent Category</option>
                                <?php
                                    if(!empty($parentCategory)){
                                        foreach($parentCategory as $category){
                                ?>
                                <option value="<?= $category->cat_id ?>"><?= $category->category_name ?></option>
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
                                <option value="<?= $ShippingCat->id ?>"><?= $ShippingCat->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Category Status<span>*</span> : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">De-Active</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="email">Category Description<span>*</span> : </label>
                            <textarea rows="10" cols="60" class="form-control" name="category_description" style="resize:none;" required></textarea>
                        </div>
                      </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Add Category</button>
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