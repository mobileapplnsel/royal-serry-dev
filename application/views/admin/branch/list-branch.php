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
                    All Branch List
                </h1>
                <ol class="breadcrumb">
                <?php if($this->session->userdata('user_type') == 'MO'){?>
                    <li><a href="<?= base_url('admin/addbranch') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Branch</a></li>
                <?php }?>
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Branch List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Branch List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Branch ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Branch Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Address</th>
                                            <th>Contact Person</th>
                                            <th>Status</th>
                                            <!--<th>Edit</th>
                                            <th>Delete</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($branchList)):
                                            foreach($branchList as $branch){
                                        ?>
                                        <tr>
                                            <td><?= $branch->branch_id ?></td>
                                            <td>
                                            <?php if($this->session->userdata('user_type') == 'MO' || $this->session->userdata('branch_id') == $branch->branch_id){?>
                                            <ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/editbranch/')?><?= $branch->branch_id ?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                    <!--<li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="#"><i class="fa fa-eye text-green"></i> View</a></li>-->
                                                    <?php //if($branch->is_series) {?>
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/addbrancharea/')?><?= $branch->branch_id ?>" class="btn" style="text-align: left"><i class="fa fa-area-chart"></i> Add Area</a> </li>
                                                    <?php //} ?>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/addbranchshift/')?><?= $branch->branch_id ?>"><i class="fa fa-calendar-check-o"></i> Add Shift</a></li>
                                                    
                                                    <?php //if($this->session->userdata('user_type') == 'BO'){ ?>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/addbranchholiday/')?><?= $branch->branch_id ?>"><i class="fa fa-calendar"></i> Add Holiday</a></li>
                                                    
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/addpickuprules/')?><?= $branch->branch_id ?>"><i class="fa fa-truck"></i> Add Pickup-delivery rules</a></li>
                                                    
                                                    <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('admin/addbranchcalendar/')?><?= $branch->branch_id ?>"><i class="fa fa-calendar-o"></i> Shift Calendar</a></li>-->
                                                    <?php //} ?>
                                                    <li class="divider" role="presentation"></li>
                                                   <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-ban text-red"></i> Decline</a></li>-->
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#videoTagDeleteModal" data-videotag-id="<?= $branch->branch_id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul>
                                              <?php }?>
                                            </td>
                                            <td><?= $branch->name ?></td>
                                            <td><?= $branch->email ?></td>
                                            <td><?= $branch->country_code.$branch->telephone ?></td>
                                            <td><?= $branch->address.', '.$branch->city_name.', '.$branch->state_name.', '.$branch->country_name.' - '.$branch->zip ?></td>
                                            <td><?= $branch->contact_person ?></td>
                                            <td><?php if($branch->status) {echo '<span class="label label-success">Active</span>';} else {echo '<span class="label label-warning">De-Active</span>';} ?></td>
                                            <!--<td><a href='<?= base_url('admin/editbranch/')?><?= $branch->branch_id ?>'><i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a></td>
                                            <td><a data-toggle="modal" data-target="#videoTagDeleteModal" data-videotag-id="<?= $branch->branch_id ?>" style="cursor:pointer;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>-->
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