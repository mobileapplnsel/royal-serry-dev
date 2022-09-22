<?php
//echo '<pre>'; print_r($OrderStatusList); print_r($StatusList);echo '</pre>'; die;
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
			//echo '<pre>'; print_r($editVidResolution); echo '</pre>';
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
                    Add Order Status
                </h1>
                <ol class="breadcrumb">
                    <!--<li><a href="<?= base_url('admin/adduser') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New User</a></li>-->					<?php if($this->session->userdata('user_type') == 'MO'){?>
                    <li><a href="<?= base_url('admin/order-list') ?>"><i class="fa fa-dashboard"></i>Order List</a></li>
                    <?php } else {?>
                    <li><a href="<?= base_url('admin/pickup-order-list') ?>"><i class="fa fa-dashboard"></i>Pickup Order List</a></li>
                    <?php }?>
                    <li class="active">Order Status List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add Order Status</h3>
                            </div>
                            <?php echo form_open(base_url('order/insertorderstatus/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Add New Order Status </div>
                            <div class="box-body">
                                <div class="row">
                                   <div class="form-group col-md-6 col-md-offset-3"></div>
                                		<div class="form-group col-md-6">
                                        <label for="parent">Status Name<span>*</span> : </label>                        
                                        <select class="form-control" name="status_id" id="status_id" required>
                                            <?php
                                                if(!empty($StatusList)){
                                                    foreach($StatusList as $Status){
                                            ?>
                                            <option value="<?= $Status->id ?>"><?= $Status->status_name ?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php 
                                    $showLink = "none";
                                    if ($orderDetails['shipment_status_id'] >=4) {
                                        $showLink = "block";

                                    } ?>
                                    <div class="col-md-12 containter-tracking-link" style="display:<?=$showLink?>;">
                                        <label for="parent">Tracking Link<span>*</span> : </label>
                                        <div class="row tracking-link-item">
                                            <div class="form-group col-sm-4">
                                                <input class="form-control" type="url" name="tracking[]" value="<?php echo @$containerDetails->tracking_link;?>" readonly>
                                            </div>
                                            <div class="form-group col-sm-1">
                                                <button type="button" class="btn  add-more-link" style="background-color:#00a65a; color:#fff;">+</button>
                                            </div>
                                        </div>

                                        <?php if ($trackingLinks) {
                                            unset($trackingLinks[0]);
                                            foreach($trackingLinks as $key=>$trackingData){ ?>

                                                <div class="row tracking-link-item">
                                                    <div class="form-group col-sm-4">
                                                        <input class="form-control" type="url" name="tracking[]" value="<?php echo @$trackingData->tracking_link;?>">
                                                    </div>
                                                    <div class="form-group col-sm-1">
                                                        <button type="button" class="btn btn-danger remove-more-link">-</button>
                                                    </div>
                                                </div>
                                        <?php  }
                                        } ?>
                                    </div>
                                </div>

                                
                                	
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Update Status</button>
                                  <?php if($this->session->userdata('user_type') == 'MO'){?>
                                  <a href="<?php echo base_url('admin/order-list'); ?>" class="btn btn-info pull-right">Back</a>
                                  <?php } else {?>
                                  <a href="<?php echo base_url('admin/pickup-order-list'); ?>" class="btn btn-info pull-right">Back</a>
                                  <?php }?>
                                </div>
                                <input type="hidden" name="shipment_id" value="<?php echo $this->uri->segment(3);?>" />
                                <input type="hidden" name="branch_id" value="<?php echo $this->session->userdata('branch_id');?>" />
                                <input type="hidden" name="created_by" value="<?php echo $this->session->userdata('user_id');?>" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Order Status List</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Status</th>                                            
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($OrderStatusList)):
                                            foreach($OrderStatusList as $OrderStatus){
                                        ?>
                                        <tr>
                                            <td><?= $OrderStatus->id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                   <li role="presentation"> <a data-toggle="modal" data-target="#OrderStatusDeleteModal" data-OrderStatus-id="<?= $OrderStatus->id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $OrderStatus->status_name ?></td>
                                            <td><?= $OrderStatus->created_date ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="4">No order status Found</td>';
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
<script type="text/javascript">
    $(document).ready(function() {
    $("body").on("click",".add-more-link",function(){ 
        var html = '<div class="row tracking-link-item"><div class="form-group col-sm-4"><input class="form-control" type="url" name="tracking[]" value=""></div><div class="form-group col-sm-1"><button type="button" class="btn btn-danger remove-more-link">-</button></div></div>';
          $(".containter-tracking-link").append(html);
    });

    $("body").on("click",".remove-more-link",function(){ 
        $(this).parents(".tracking-link-item").remove();
    });

    $("#status_id").change(function () {
        var status = this.value;
        if (status >= 4) {
            $(".containter-tracking-link").show();
        }else{
            $(".containter-tracking-link").hide();
        }
        
    });
});
</script>