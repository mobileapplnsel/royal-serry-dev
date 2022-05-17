<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
                    Add New Banner
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/banner-list') ?>"><i class="fa fa-dashboard"></i> Banner List </a></li>
                    <li class="active">Add New Banner</li>
                </ol>
            </section>
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('banner/insertbanner'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                        <div class="box-header with-border"> Add New Banner </div>
                        <h4 class="box-header with-border">Resolution: 1380 x 768 px</h4>
                        <div class="box-body">
                            <div class="form-group col-md-6 col-md-offset-3"></div>

                            <div class="form-group col-md-6">
                                <label for="pwd">Upload Banner Image :</label>
                                <input type="file" class="custom-file-input" name="banner_image" accept="image/x-png,image/gif,image/jpeg" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="heading">Heading 1 :</label>
                                <input type="text" class="custom-file-input" name="heading" required>
                            </div>

                            
                            <div class="form-group col-md-6">
                                <label for="heading2">Heading 2 :</label>
                                <input type="text" class="custom-file-input" name="heading2" required>
                            </div>

                            
                            <div class="form-group col-md-6">
                                <label for="heading3">Heading 3 :</label>
                                <input type="text" class="custom-file-input" name="heading3" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sub_heading">Sub Heading :</label>
                                <input type="text" class="custom-file-input" name="sub_heading" required>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Add Banner</button>
                            <a href="<?php echo base_url('admin/banner-list'); ?>" class="btn btn-info pull-right">Back</a>
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