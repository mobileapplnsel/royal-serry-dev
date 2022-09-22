<?php
//echo '<pre>'; print_r($usersList);echo '</pre>'; die;
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
                    Business Customers List
                </h1>
                <ol class="breadcrumb">
                    <!--<li><a href="<?= base_url('admin/addcategory') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Category</a></li>-->
                    <li><a href="<?= base_url('admin/users-list') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Business Customers List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Business Customers List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        	<th class='notexport'>Action</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Address</th>
                                            <th>Company Name</th>
                                            <th>Company Details</th>
                                            <th>Status</th>
                                            <!--<th>Edit</th>
                                            <th>Delete</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($usersList)):
                                            foreach($usersList as $user){
                                        ?>
                                        <tr>
                                        	<td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <?php if (get_permission('BUSINESSUSER', 'is_edit')){ ?>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/edituser/')?><?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                    
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/addcredit/')?><?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-money text-green"></i> Add Credit Amount</a> </li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/addpaylater/')?><?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-credit-card text-green"></i> Pay later</a> </li>
                                                    <?php } if (get_permission('BUSINESSUSER', 'is_delete')){ ?>
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#UserDeleteModal" data-videotag-id="<?= $user->user_id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                    <?php } ?>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $user->firstname ?></td>
                                            <td><?= $user->lastname ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->telephone ?></td>
                                            <td><?= $user->address.', '.$user->city_name.', '.$user->state_name.', '.$user->country_name.' - '.$user->zip ?></td>
                                            <td><?= $user->companyname ?></td>
                                            <td><?= $user->companydetails ?></td>
                                            <td><?php if($user->status) {echo '<span class="label label-success">Active</span>';} else {echo '<span class="label label-warning">De-Active</span>';} ?></td>
                                            <!--<td><a href='<?= base_url('admin/edituser/')?><?= $user->user_id ?>'><i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a></td>
                                            <td><a data-toggle="modal" data-target="#UserDeleteModal" data-videotag-id="<?= $user->user_id ?>" style="cursor:pointer;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>-->
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="9">No Branch Found</td>';
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