<?php
//echo '<pre>'; print_r($CheckPointList);echo '</pre>';
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
                    Add Pay Later
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/users-list') ?>"><i class="fa fa-dashboard"></i>Users List</a></li>
                    <li class="active">Pay Later</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add Pay Later</h3>
                            </div>
                            <?php echo form_open(base_url('users/insertuserpaylater/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="box box-primary">
                            <div class="box-header with-border"> Pay Later </div>
                            <div class="box-body">
                               <div class="form-group col-md-6 col-md-offset-3"></div>
                            	<div class="form-group col-md-12">
                                    <label for="parent">Pay Later<span>*</span> : &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;</label>                        
                                     <label>
                                        No&nbsp; &nbsp;                             
                                        <input type="radio" name="pay_later" class="minimal-red paylater" value="0" checked/>
                                    </label>&nbsp; &nbsp;
                                    <label>
                                        Yes&nbsp; &nbsp;                            
                                    <input type="radio" name="pay_later" class="minimal-red paylater" value="1"  />
                                    </label>&nbsp; &nbsp;
                                </div>
                                
                                <div class="form-group col-md-12" style="display:none;" id="have_checkpoint">
                                    <label for="parent">Have Check point<span>*</span> : &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;</label>                        
                                     <label>
                                        Yes&nbsp; &nbsp;                             
                                        <input type="radio" name="have_checkpoint" class="minimal-red checkpoint" value="1" />
                                    </label>&nbsp; &nbsp;
                                    <label>
                                        No&nbsp; &nbsp;                            
                                    <input type="radio" name="have_checkpoint" class="minimal-red checkpoint" value="0"  checked/>
                                    </label>&nbsp; &nbsp;
                                </div>
                                
                                <div class="form-group col-md-12" style="display:none;" id="checkpoint">
                                <label for="parent">Select Check point<span>*</span> : </label> 
                                <?php
									if(!empty($CheckPointList)){
										foreach($CheckPointList as $checkpoint){
								?>
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" value="<?= $checkpoint->id ?>" name="checkpoint[]" style="position:relative;">
                                      <?= $checkpoint->name ?>
                                    </label>
                                  </div>
                                  <?php 
										}
									}
								?>
                
                
                                  
                                </div>
                               </div>
                            
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                  <?php if($userPayLater[0]->user_type == 'NU'){?>
                                  	<a href="<?php echo base_url('admin/users-list'); ?>" class="btn btn-info pull-right">Back</a>
                                  <?php } else {?>
                                  	<a href="<?php echo base_url('admin/business-users-list'); ?>" class="btn btn-info pull-right">Back</a>
                                  <?php }?>
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3);?>" />
                            </div>
                            <?php echo form_close(); ?>
                            
                            <div class="box-header">
                                <h3 class="box-title">User Pay Later Check Points</h3>
                            </div>
                            <div class="box-body">
                            <div class="form-group col-md-6 col-md-offset-3"></div>
                            	<div class="form-group col-md-12">
                                	<p><strong>Pay Later :</strong> <?php if($userPayLater[0]->pay_later) {echo '<span class="label label-success">Yes</span>';} else {echo '<span class="label label-warning">No</span>';} ?></p>
                                </div>
                                <div class="form-group col-md-12">
                                	<p><strong>Check Points :</strong></p>
                                    <?php if(!empty($UserCheckPointList)){ ?>
                                    <ul>
                                    	<?php foreach($UserCheckPointList as $UserCheck){?>
                                    	<li><?= $UserCheck->checkpoint_name?></li>
                                        <?php } ?>
                                    </ul>
                                    <?php } else { echo '<span class="label label-warning">No Check Point</span>';} ?>
                                </div>
                                
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
$(function () {
	$("input[type='radio'].paylater").click(function(){
		var pay_later = $("input[name='pay_later']:checked").val();
		//alert(pay_later);
		if(pay_later == '1'){
			$("#have_checkpoint").show(300);
			$("input[type='radio'].checkpoint").click(function(){
				var checkpoint = $("input[name='have_checkpoint']:checked").val();
				//alert(checkpoint);
				if(checkpoint == '1'){
					$("#checkpoint").show(300);
				} else {
					$("#checkpoint").hide(300);
					$("input[type='checkbox']").removeAttr('required');
				}
			});
		} else {
			$("#have_checkpoint").hide(300);
			$("#checkpoint").hide(300);
			$('input[name="have_checkpoint"]').prop('checked', false);
		}
	});
});

/*$(function(){
    var requiredCheckboxes = $('.options :checkbox[required]');
	alert(requiredCheckboxes);
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});*/
</script>