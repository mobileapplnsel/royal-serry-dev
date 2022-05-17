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
                    Package Category List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addpackagecategory') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Package Category</a></li>
                    <li><a href="<?= base_url('admin/package-categories-list') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Package Category List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Package Category List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>                                            
                                            <!--<th>Parent Category</th>-->
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										//echo '<pre>'; print_r($categoriesList); echo '</pre>';
                                            if(!empty($categoriesList)):
                                            foreach($categoriesList as $categories){
                                        ?>
                                        <tr>
                                            <td><?= $categories->cat_id ?></td>
                                            <td><?= $categories->category_name ?></td>
                                            <!--<td><?php //echo $categories->parent_cat_name; ?></td>-->
                                            <td><?php if($categories->status) {echo '<span class="label label-success">Active</span>';} else {echo '<span class="label label-warning">De-Active</span>';} ?></td>
                                            <td>
                                                <a href='<?= base_url('admin/editpackagecategory/')?><?= $categories->cat_id ?>'>
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td><a data-toggle="modal" data-target="#packagecategoryDeleteModal" data-packagecategory-id="<?= $categories->cat_id ?>" style="cursor:pointer;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                                echo '<td rowspan="6">No Documents Category Found</td>';
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