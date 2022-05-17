<?php
//echo '<pre>'; print_r($editBranch); die;
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
                    Edit Tax
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/tax-list') ?>"><i class="fa fa-dashboard"></i> Tax List </a></li>
                    <li class="active">Edit tax</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    
                    <?php echo form_open(base_url('tax/updateTax/'.$editTax[0]->id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Edit Tax </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                       
                        <div class="form-group col-md-6">
                            <label for="email">Tax Name : </label>
                            <input type="text" class="form-control" placeholder="Tax Name" name="name" maxlength="20" value="<?= $editTax[0]->name ?>" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="email">Tax Amount(%): </label>
                            <input type="text" class="form-control" placeholder="Tax Amount" onkeypress="javascript:return isNumber(event)" maxlength="6" name="amount" value="<?= $editTax[0]->amount ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Tax Type : </label>                        
                            <select class="form-control" name="type" required>
                                <option value="">Select Type</option>
                                <option <?php if($editTax[0]->type == 'GA') {echo 'selected';} ?> value="GA">GA</option>
                                <option <?php if($editTax[0]->type == 'RA') {echo 'selected';} ?> value="RA">RA</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option <?php if($editTax[0]->status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editTax[0]->status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div> 
                        </div>                     
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update Tax</button>
                          <a href="<?php echo base_url('admin/tax-list'); ?>" class="btn btn-info pull-right">Back</a>
                        </div>
                        </div>
                    <?php echo form_close(); ?>
                    
                </div>
            </div>
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