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
                    Add News
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/news-list') ?>"><i class="fa fa-dashboard"></i> News List </a></li>
                    <li class="active">Add News</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('news/insertnews'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                        <div class="box-header with-border"> Add News </div>
                        <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="News Name" name="name" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Category<span>*</span> : </label>                        
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php
                                    if(!empty($categoryList)){
                                        foreach($categoryList as $category){
                                ?>
                                <option value="<?= $category->cat_id ?>"><?= $category->category_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pwd">Upload News Image<span>*</span> :</label>
                            <input type="file" class="custom-file-input" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/png" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Status<span>*</span> : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">De-Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">News Description<span>*</span> : </label>
                            <textarea rows="10" cols="60" class="form-control" name="description" style="resize:none;" required></textarea>
                        </div>
                        
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Add News</button>
                          <a href="<?php echo base_url('admin/news-list'); ?>" class="btn btn-info pull-right">Back</a>
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