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
                    All Videos List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addvideo') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Video</a></li>
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Videos List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Videos List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Video ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Video Title</th>                                            
                                            <th>Banner</th>
                                            <th>Trailer Duration</th>
                                            <th>Video Duration</th>
                                            <!-- <th>Ratings</th> -->
                                            <th>No. of Views</th>
                                            <th>Series</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($videosList)):
                                            foreach($videosList as $videos){
                                        ?>
                                        <tr>
                                            <td><?= $videos->video_id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/editvideo/')?><?= $videos->video_id ?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="#"><i class="fa fa-eye text-green"></i> View</a></li>
                                                    <?php if($videos->is_series) {?>
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/addseriesvideo/')?><?= $videos->video_id ?>" class="btn" style="text-align: left"><i class="fa fa-mobile text-green"></i> Add Series Video</a> </li>
                                                    <?php } ?>
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-ban text-red"></i> Decline</a></li>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#videoDeleteModal" data-video-id="<?= $videos->video_id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $videos->video_title ?></td>
                                            <td><?php if($videos->is_banner) {echo '<span class="label label-success">Yes</span>';} else {echo '<span class="label label-warning">No</span>';} ?></td>
                                            <td><?= $videos->trailer_duration ?></td>
                                            <td><?= $videos->video_duration ?></td>
                                            <!-- <td><?= $videos->ratings ?></td> -->
                                            <td>0</td>
                                            <td><?php if($videos->is_series) {echo '<span class="label label-success">Yes</span>';} else {echo '<span class="label label-warning">No</span>';} ?></td>
                                            <td><?php if($videos->status) {echo '<span class="label label-success">Published</span>';} else {echo '<span class="label label-warning">Not Published</span>';} ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="7">No Videos Found</td>';
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