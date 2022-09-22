<?php
//echo '<pre>'; print_r($documentList);echo '</pre>';
defined('BASEPATH') or exit('No direct script access allowed');
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
                    All Banner List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addbanner') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Banner</a></li>
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Banner List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Banner List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Image</th>
                                            <th>Heading</th>
                                            <th>Sub Heading</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($bannerList)) :
                                            foreach ($bannerList as $banner) {
                                        ?>
                                                <tr>
                                                    <td><?= $banner->id ?></td>
                                                    <td>
                                                        <ul class="admin-action btn btn-default" style="list-style:none;">
                                                            <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                                <ul class="dropdown-menu dropdown-menu-left">
                                                                    <li role="presentation"> <a data-toggle="modal" data-target="#BannerDeleteModal" data-banner-id="<?= $banner->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>

                                                                    <li role="presentation"> <a href="<?php echo base_url('admin/editbanner/' . $banner->id); ?>"><i class="fa fa-pencil"></i> Edit</a> </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td><img style="width: 180px;" src="<?php echo base_url('uploads/banner/') . $banner->image ?>" /></td>
                                                    <td><?php echo $banner->heading . ' ' . $banner->heading2 . ' ' . $banner->heading3; ?></td>
                                                    <td><?php echo $banner->sub_heading; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        else :
                                            echo '<td rowspan="3">No Banner Found</td>';
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box">

                        </div>
                    </div>
                </div>
            </section>
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