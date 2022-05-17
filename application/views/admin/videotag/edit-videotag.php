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
                    Edit Tag
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/videotaglist') ?>"><i class="fa fa-dashboard"></i> Tags List </a></li>
                    <li class="active">Edit Tag</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <form method="POST" action="<?= base_url('admin/updateVideoTag') ?>/<?= $editVideoTag[0]->tag_id ?>" enctype="multipart/form-data">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Tag Name : </label>
                            <input type="text" class="form-control" placeholder="Tag Name" name="tag_name" value="<?= $editVideoTag[0]->tag_name ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option <?php if($editVideoTag[0]->status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editVideoTag[0]->status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div>                        
                        <div class="form-group col-md-12" style="margin-bottom:15px">
                            <button type="submit" class="btn btn-warning">Update Video Tag</button>
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