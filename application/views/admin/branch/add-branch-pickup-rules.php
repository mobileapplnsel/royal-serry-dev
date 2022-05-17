<?php
//echo '<pre>'; print_r($userShiftList);echo '</pre>';
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<style type="text/css">
.pagination{display:none;}
.dataTables_filter{display:none;}
</style>
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
                    Add Branch Pickup/Delivery Rules
                </h1>
                <ol class="breadcrumb">
                    <!--<li><a href="<?= base_url('admin/addbranch') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Branch</a></li>-->
                    <li><a href="<?= base_url('admin/branch-list') ?>"><i class="fa fa-dashboard"></i>Branch List</a></li>
                    <li class="active">Branch Pickup/Delivery Rules</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add Pickup/Delivery Rules</h3>
                            </div>
                            <?php echo form_open(base_url('branch/insertbranchPickuprules/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Add Pickup/Delivery Rules </div>
                            <div class="box-body">
                               <div class="form-group col-md-6 col-md-offset-3"></div>
                                <div class="form-group col-md-6">
                                    <label for="parent">Select Rules<span>*</span> : </label>                        
                                    <select class="form-control" name="rule_id" id="rule_id" required>
                                        <?php
                                            if(!empty($RulesList)){
                                                foreach($RulesList as $Rules){
                                        ?>
                                        <option value="<?= $Rules->id ?>"><?= $Rules->name ?></option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-6" style="display:none;" id="lblhours">
                                    <label for="parent">Hours<span>*</span> : </label>                        
                                    <input type="text" class="form-control" placeholder="Enter Hours" onKeyPress="javascript:return isNumber(event)" maxlength="2" name="hours" id="hours" value="">
                                </div>
                                
                                
                                	
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Add Rules</button>
                                  <a href="<?php echo base_url('admin/branch-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="branch_id" value="<?php echo $this->uri->segment(3);?>" />
                                <input type="hidden" id="ship_date_time" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Branch Pickup/Delivery Rules</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rules Name</th>                                            
                                            <th>Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($branchPickupRules)):
                                            foreach($branchPickupRules as $pickupRules){
                                        ?>
                                        <tr>
                                            <td><?= $pickupRules->id ?></td>
                                            <td><?= $pickupRules->rules_name; ?></td>
                                            <td><?php if($pickupRules->rule_id == '3'){
											echo $pickupRules->hours; } ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="3">No Branch rules Found</td>';
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
$('#rule_id').on('change', function() {
	var rule_id = this.value;
  if(rule_id == '3'){
	$('#lblhours').show(300); 
	$("#hours").prop('required',true); 
  } else {
	  $('#lblhours').hide(300);
	  $('input').attr('required', false); 
  }
});
</script>