<?php
//echo '<pre>'; print_r($quotationList);echo '</pre>';
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
                    All Quotation List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/adddocument') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Quotation</a></li>
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li class="active">Quotation List</li>
                </ol>                
            </section>
            <section class="content-header">
                <div class="row">
                    <div class="col-xs-12">    
                        <div class="box">
                            <div class="box-body">   
                                <?php echo form_open(base_url('admin/quotation-list'), array('id' => 'searchF', 'class' => 'form-inline','method'=>'POST', 'enctype' => 'multipart/form-data')); ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>From Date</label>
                                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="mm-dd-yyyy" value="<?php echo $from_date; ?>" readonly>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>To Date</label>
                                        <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="mm-dd-yyyy" value="<?php echo $to_date; ?>" readonly>
                                    </div>
                                    <div class="col-sm-4">                                        
                                        <input type="submit" name="search" id="search" class="btn btn-success" value="Search"> 
                                        <a href="<?php echo base_url('admin/quotation-list'); ?>" class="btn btn-success">Reset</a>                                       
                                    </div>                                    
                                </div>                                
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Quotation List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class='notexport'>Action</th>
                                            <th>Quotation No</th>
                                            <th>Customer Name</th>
                                            <th>Created Date</th>
                                            <th>Quotation Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($quotationList)):
                                            foreach($quotationList as $quotation){
                                        ?>
                                        <tr>
                                            <td><?= $quotation->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/viewquotation/')?><?= $quotation->id ?>" class="btn" style="text-align: left"><i class="fa fa-eye text-blue"></i> View Quotation</a> </li>
                                                   
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#QuotationDeleteModal" data-quotation-id="<?= $quotation->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                    <?php if($quotation->status==1) {?>
                                                    <li class="divider" role="presentation"></li>
                                                    <li role="presentation"> <a role="button" href="<?= base_url('admin/quotationorderclosed/')?><?= $quotation->id ?>/2" class="btn" style="text-align: left"><i class="fa fa-times-circle text-blue"></i>Mark as closed</a> </li>
                                                    <?php }?>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $quotation->quote_no ?></td>
                                            <td><?= $quotation->firstname.' '.$quotation->lastname ?></td>
                                            <td><?= date("m-d-Y", strtotime($quotation->created_date)); ?></td>
                                            <td><?php if($quotation->quote_type==2) {echo '<span class="label label-success">Quote Request</span>';} else {echo '<span class="label label-warning">Quote</span>';} ?></td>
                                            <td><?php if($quotation->status==1) {echo '<span class="label label-success">Created</span>';} else {echo '<span class="label label-warning">Closed</span>';} ?></td>
                                            
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="7">No Quotation Found</td>';
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