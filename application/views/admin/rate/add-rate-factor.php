<?php
//echo '<pre>'; print_r($rateFactorList);echo '</pre>'; die;
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<style type="text/css">
.pagination{
	display:none!important;}
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
                    Change Rate Factor Amount
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/rate-list') ?>"><i class="fa fa-dashboard"></i>Rate List</a></li>
                    <li class="active">Rate Factor Amount</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Change Rate Factor Amount</h3>
                            </div>
                            <?php echo form_open(base_url('rate/insertratefactor/'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Change Rate Factor Amount </div>
                            <div class="box-body">
                               <div class="form-group col-md-6 col-md-offset-3"></div>
                            		<div class="form-group col-md-6">
                                    <label for="parent">Enter Rate Factor Amount($)<span>*</span> : </label>                        
                                    <input type="text" class="form-control" placeholder="Rate Factor Amount" onKeyPress="javascript:return isNumber(event)" maxlength="6" name="amount" value="" required>
                                </div>
                                
                                	
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Change Amount</button>
                                  <!--<a href="<?php echo base_url('admin/users-list'); ?>" class="btn btn-info pull-right">Back</a>-->
                                </div>
                                <input type="hidden" name="id" value="1" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">Rate Factor</h3>
                            </div>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Amount($)</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($rateFactorList)):
                                            foreach($rateFactorList as $rateFactor){
                                        ?>
                                        <tr>
                                            <td><?= $rateFactor->id?></td>
                                            <td><?= $rateFactor->name; ?></td>
                                            <td><?= $rateFactor->amount ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="3">No Rate Factor Found</td>';
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