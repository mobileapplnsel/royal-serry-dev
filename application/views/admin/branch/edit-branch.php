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
<style type="text/css">
.iti--allow-dropdown {
  width: 30%!important;
}
</style>
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
                    Edit Branch
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/branch-list') ?>"><i class="fa fa-dashboard"></i> Branch List </a></li>
                    <li class="active">Edit Branch</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    
                    <?php echo form_open(base_url('branch/updateBranch/'.$editBranch[0]->branch_id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Edit Branch </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-6">
                            <label for="email">Branch Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Branch Name" name="name" maxlength="50" onKeyUp="this.value=this.value.replace(/[^A-z_ ]/g,'');" value="<?= $editBranch[0]->name ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Branch Email<span>*</span> : </label>
                            <input type="email" class="form-control" placeholder="Branch Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?= $editBranch[0]->email ?>" required>
                        </div>
                        <!--<div class="form-group col-md-6">
                            <label for="email">Telephone Country Code<span>*</span> : </label>
                            <?php //echo fillCombo('country_code', 'phonecode', 'phonecode', $editBranch[0]->country_code, '', 'id', 'form-control form-control-new', 'country_code', 'country_code', '1'); ?>
                        </div>-->
                        <div class="form-group col-md-6">
                            <label for="email">Branch Telephone<span>*</span> : </label><br>
                			<input type="tel" class="form-control info-text telephone" name="country_code" value="<?php echo $editBranch[0]->country_code; ?>" style="float:left;">
                            <input type="tel" class="form-control" placeholder="Branch Telephone" name="telephone" value="<?= $editBranch[0]->telephone ?>" required style="width:69%; float:right; margin-top:0;">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Branch Address" name="address" maxlength="50" value="<?= $editBranch[0]->address ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Country<span>*</span> : </label>
                            <?php echo fillCombo('countries_master', 'id', 'name', $editBranch[0]->country, 'status = 1', 'id', 'form-control form-control-new', 'country', 'country', '1'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">State<span>*</span> : </label>
                            <?php echo fillCombo('states_master', 'id', 'name', $editBranch[0]->state, 'country_id=' . $editBranch[0]->country, 'id', 'form-control form-control-new', 'state', 'state', '1'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">City<span>*</span> : </label>
                            <?php echo fillCombo('cities_master', 'id', 'name', $editBranch[0]->city, 'state_id=' . $editBranch[0]->state, 'id', 'form-control form-control-new', 'city', 'city', '1'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Zip Code : </label>
                            <input type="text" class="form-control" id="zipcode" placeholder="Zip Code" name="zip" maxlength="8" value="<?= $editBranch[0]->zip ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Contact Person<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Branch Contact Person" maxlength="30" name="contact_person" value="<?= $editBranch[0]->contact_person ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option <?php if($editBranch[0]->status == 1) {echo 'selected';} ?> value="1">Active</option>
                                <option <?php if($editBranch[0]->status == 0) {echo 'selected';} ?> value="0">De-Active</option>
                            </select>
                        </div> 
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update Branch</button>
                          <a href="<?php echo base_url('admin/branch-list'); ?>" class="btn btn-info pull-right">Back</a>
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