<?php
//echo '<pre>'; print_r($editUser); echo '</pre>';//die;
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
                    Edit User
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/users-list') ?>"><i class="fa fa-dashboard"></i> Users List </a></li>
                    <li class="active">Edit User</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <?php echo form_open(base_url('users/updateUser/'.$editUser[0]->user_id), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box box-primary">
                    <div class="box-header with-border"> Edit User </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 col-md-offset-3"></div>
                        <div class="form-group col-md-10">
                            <label>User Type :</label>
                            <label style="display:none;">
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                            <label>
                                Normal User&nbsp; &nbsp;                             
                                <input type="radio" name="user_type" class="minimal-red series" value="NU" <?php if($editUser[0]->user_type=='NU') {echo 'checked';} ?>/>
                            </label>&nbsp; &nbsp;
                            <label>
                                Business User&nbsp; &nbsp;                            
                            <input type="radio" name="user_type" class="minimal-red series" value="BU" <?php if($editUser[0]->user_type=='BU') {echo 'checked';} ?> />
                            </label>&nbsp; &nbsp;
                            <label>
                                Pickup/Delivery Boy&nbsp; &nbsp;                            
                            <input type="radio" name="user_type" class="minimal-red series" value="PDB" <?php if($editUser[0]->user_type=='PDB') {echo 'checked';} ?> />
                            </label>&nbsp; &nbsp;
                            <label>
                                Branch Office User&nbsp; &nbsp;                            
                            <input type="radio" name="user_type" class="minimal-red series" value="BO" <?php if($editUser[0]->user_type=='BO') {echo 'checked';} ?> />
                            </label>&nbsp; &nbsp;
                        </div>
                        <div class="form-group col-md-6" id="branch_name" <?php if($editUser[0]->user_type=='BO' || $editUser[0]->user_type=='PDB'){ echo 'style="display:block;"';} else {echo 'style="display:none;"';}?>>
                            <label for="email">Select Branch<span>*</span> : </label>
                            <select class="form-control" name="branch_id" id="ddl_branch_id">
                            	<option value="">--Select Branch--</option>
                            <?php foreach($branchList as $branch){?>
                                <option value="<?= $branch->branch_id ?>" <?php if(!empty($editUser[0]->branch_id)){if($editUser[0]->branch_id==$branch->branch_id) {echo 'selected';}} ?>><?= $branch->name ?>&nbsp;(<?= $branch->email ?>)</option>
                            <?php } ?>
                            </select>
                        </div>
                        <div id="comp_details" <?php if($editUser[0]->user_type=='BU'){ echo 'style="display:block;"';} else {echo 'style="display:none;"';}?>>
                        <div class="form-group col-md-6">
                            <label for="email">Company Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Company Name" name="companyname" id="companyname" value="<?= $editUser[0]->companyname ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Company Details<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Company Details" name="companydetails" id="companydetails" value="<?= $editUser[0]->companydetails ?>">
                        </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">First Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="First Name" name="firstname" onKeyUp="this.value=this.value.replace(/[^A-z]/g,'');" value="<?= $editUser[0]->firstname ?>" maxlength="20" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Last Name<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname" onKeyUp="this.value=this.value.replace(/[^A-z]/g,'');" value="<?= $editUser[0]->lastname ?>" maxlength="20" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?= $editUser[0]->email ?>" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Telephone<span>*</span> : </label><br>
                			<input type="tel" class="form-control info-text telephone" name="country_code" value="<?php echo $editUser[0]->country_code; ?>" style="float:left;">
                            <input type="tel" class="form-control" placeholder="Telephone" name="telephone" value="<?= $editUser[0]->telephone ?>" required style="width:69%; float:right; margin-top:0;">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Address<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Address" name="address" maxlength="50" value="<?= $editUser[0]->address ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Country<span>*</span> : </label>
                            <?php echo fillCombo('countries_master', 'id', 'name', $editUser[0]->country, 'status = 1', 'id', 'form-control form-control-new', 'country', 'country', '1'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">State<span>*</span> : </label>
                            <?php echo fillCombo('states_master', 'id', 'name', $editUser[0]->state, 'country_id=' . $editUser[0]->country, 'id', 'form-control form-control-new', 'state', 'state', '1'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">City<span>*</span> : </label>
                            <?php echo fillCombo('cities_master', 'id', 'name', $editUser[0]->city, 'state_id=' . $editUser[0]->state, 'id', 'form-control form-control-new', 'city', 'city', '1'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Zip Code<span>*</span> : </label>
                            <input type="text" class="form-control" placeholder="Code" name="zip" value="<?= $editUser[0]->zip ?>" maxlength="8" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Online Status : </label>
                            <select class="form-control" name="online_status" required>
                                <option value="1" <?php if($editUser[0]->online_status=='1') {echo 'selected';} ?>>Online</option>
                                <option value="0" <?php if($editUser[0]->online_status=='0') {echo 'selected';} ?>>Offline</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status : </label>                        
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1" <?php if($editUser[0]->status=='1') {echo 'selected';} ?>>Active</option>
                                <option value="0" <?php if($editUser[0]->status=='0') {echo 'selected';} ?>>De-Active</option>
                            </select>
                        </div>  
                       </div>
                         <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update User</button>
                          <a href="<?php echo base_url('admin/users-list'); ?>" class="btn btn-info pull-right">Back</a>
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
<script type="text/javascript">
$(function () {
	/*if($("input[type='radio'].series").is(':checked')) {
    var user_type = $("input[type='radio'].series:checked").val();
    alert(user_type);
	if(user_type == 'BO' || user_type == 'PDB'){
		$("#branch_name").show(300);
		$("#comp_details").hide(300);
	} else if(radioValue == 'BU'){
		$("#comp_details").show(300);
		$("#branch_name").hide(300);
	} else {
		$("#comp_details").hide(300);
		$("#branch_name").hide(300);
	}
}*/

	$("input[type='radio']").click(function(){
		var radioValue = $("input[name='user_type']:checked").val();
		if(radioValue == 'BO' || radioValue == 'PDB'){
			$("#branch_name").show(300);
			$("#comp_details").hide(300);
			$("#companyname").prop('required',false);
			$("#companydetails").prop('required',false);
			$("#ddl_branch_id").prop('required',true);
		} else if(radioValue == 'BU'){
			$("#comp_details").show(300);
			$("#branch_name").hide(300);
			$("#companyname").prop('required',true);
			$("#companydetails").prop('required',true);
			$("#ddl_branch_id").prop('required',false);
		} else {
			$("#comp_details").hide(300);
			$("#branch_name").hide(300);
			$("#companyname").prop('required',false);
			$("#companydetails").prop('required',false);
			$("#ddl_branch_id").prop('required',false);
		}
	});
});
</script>