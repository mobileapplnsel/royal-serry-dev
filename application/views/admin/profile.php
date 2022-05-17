<?php
//echo '<pre>'; print_r($_SESSION); echo '</pre>'; //die;
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<style type="text/css">
/*.custom-file-input {
  color: transparent;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Choose file...';
  color: black;
  display: inline-block;
  background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active {
  outline: 0;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
}*/
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
      <h1> Edit Profile </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Profile</li>
      </ol>
    </section>
    <div class="container">
      <div class="col-md-11">
        <h2></h2>
        <?php echo form_open(base_url('admin/updateprofile'), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
          <div class="box box-primary">
            <div class="box-header with-border"> Edit Details </div>
            <div class="box-body">
              <div class="form-group col-md-6 col-md-offset-3"></div>
              <div class="form-group col-md-6">
                <label for="email">First Name<span>*</span> : </label>
                <input type="text" class="form-control" placeholder="First Name" name="firstname" maxlength="20" onKeyUp="this.value=this.value.replace(/[^A-z]/g,'');" value="<?= $profileData[0]->firstname ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Last Name<span>*</span> : </label>
                <input type="text" class="form-control" placeholder="Last Name" name="lastname" maxlength="20" onKeyUp="this.value=this.value.replace(/[^A-z]/g,'');" value="<?= $profileData[0]->lastname ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email<span>*</span> : </label>
                <input type="email" class="form-control" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?= $profileData[0]->email ?>" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Telephone<span>*</span> : </label><br>
                <input type="tel" class="form-control info-text telephone" name="country_code" value="<?php echo $profileData[0]->country_code; ?>" style="float:left;">
                <input type="tel" class="form-control" placeholder="Phone" name="telephone" value="<?= $profileData[0]->telephone ?>" required style="width:69%; float:right; margin-top:0;">
              </div>
              <div class="form-group col-md-6">
                <label for="email">Address<span>*</span> : </label>
                <input type="text" class="form-control" placeholder="Address" name="address" maxlength="50" value="<?= $profileData[0]->address ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Country<span>*</span> : </label>
                <?php echo fillCombo('countries_master', 'id', 'name', $profileData[0]->country, 'status = 1', 'id', 'form-control form-control-new', 'country', 'country', '1'); ?>
            </div>
            <div class="form-group col-md-6">
                <label for="email">State<span>*</span> : </label>
                <?php echo fillCombo('states_master', 'id', 'name', $profileData[0]->state, 'country_id=' . $profileData[0]->country, 'id', 'form-control form-control-new', 'state', 'state', '1'); ?>
            </div>
            <div class="form-group col-md-6">
                <label for="email">City<span>*</span> : </label>
                <?php echo fillCombo('cities_master', 'id', 'name', $profileData[0]->city, 'state_id=' . $profileData[0]->state, 'id', 'form-control form-control-new', 'city', 'city', '1'); ?>
            </div>
              <div class="form-group col-md-6">
                <label for="email">Zip Code<span>*</span> : </label>
                <input type="text" class="form-control" placeholder="Zip" name="zip" value="<?= $profileData[0]->zip ?>" required>
              </div>
              <div class="form-group col-md-12">
                
                <?php if($profileData[0]->profile_image != ''){?>
                <img src="<?= base_url('uploads/profile_img/') . $profileData[0]->profile_image ?>" alt="<?= $profileData[0]->profile_image ?>" class="img-thumbnail" style="height:75px;">
                <?php }?>
                <br>
                <label for="email">Profile Image : </label>
                <input type="file" class="custom-file-input" name="profile_image" accept="image/x-png,image/gif,image/jpeg" style="cursor:pointer;">
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Update Profile</button>
              <a href="<?php echo base_url('admin'); ?>" class="btn btn-info pull-right">Back</a>
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <?php $this->load->view('admin/include/footer-content'); ?>
  
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
