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
                    All News List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/add-news') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add News</a></li>
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">News List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">News List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Name</th>                                            
                                            <th>Image</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($NewsList)):
                                            foreach($NewsList as $news){
                                        ?>
                                        <tr>
                                            <td><?= $news->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/edit-news/')?><?= $news->id ?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                   
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#NewsDeleteModal" data-news-id="<?= $news->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $news->name ?></td>
                                            <td><img src="<?= base_url('/uploads/news_image/').$news->image ?>" hieght="100px;" width="100px;"></td>
                                            <td><?php if($news->status) {echo '<span class="label label-success">Active</span>';} else {echo '<span class="label label-warning">De-Active</span>';} ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="5">No news Found</td>';
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