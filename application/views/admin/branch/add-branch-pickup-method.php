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
                    Add Branch Pickup Method
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/branch-list') ?>"><i class="fa fa-dashboard"></i>Branch List</a></li>
                    <li class="active">Branch Pickup Method</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            
                            
                            <div class="box-body">
                                <div class="box-header">
                                    <h3 class="box-title">Branch Pickup Method</h3>
                                </div>
                                <?php echo form_open(base_url('admin/branch/add-pickup-method/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), array('id' => 'loginF', 'class' => 'contact-form', 'enctype' => 'multipart/form-data')); ?>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Week Day</th>                                            
                                            <th>Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <td>1</td>
                                            <td>Monday</td>
                                            <td>
                                                <select class="form-control" name="monday" required>
                                                    <?php if(!empty($deliveryModeList)){
                                                            foreach($deliveryModeList as $method){
                                                    ?>
                                                    <option value="<?= $method->id ?>" <?php if(isset($pickupMethod->monday) && $pickupMethod->monday==$method->id){echo "selected";} ?> ><?= $method->name ?></option>
                                                    <?php }}?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Tuesday</td>
                                            <td>
                                                <select class="form-control" name="tuesday" required>
                                                    <?php if(!empty($deliveryModeList)){
                                                            foreach($deliveryModeList as $method){
                                                    ?>
                                                    <option value="<?= $method->id ?>" <?php if(isset($pickupMethod->tuesday) && $pickupMethod->tuesday==$method->id){echo "selected";} ?>><?= $method->name ?></option>
                                                    <?php }}?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Wednesday</td>
                                            <td>
                                                <select class="form-control" name="wednesday" required>
                                                    <?php if(!empty($deliveryModeList)){
                                                            foreach($deliveryModeList as $method){
                                                    ?>
                                                    <option value="<?= $method->id ?>" <?php if(isset($pickupMethod->wednesday) && $pickupMethod->wednesday==$method->id){echo "selected";} ?>><?= $method->name ?></option>
                                                    <?php }}?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Thursday</td>
                                            <td>
                                                <select class="form-control" name="thursday" required>
                                                    <?php if(!empty($deliveryModeList)){
                                                            foreach($deliveryModeList as $method){
                                                    ?>
                                                    <option value="<?= $method->id ?>" <?php if(isset($pickupMethod->thursday) && $pickupMethod->thursday==$method->id){echo "selected";} ?>><?= $method->name ?></option>
                                                    <?php }}?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Friday</td>
                                            <td>
                                                <select class="form-control" name="friday" required>
                                                    <?php if(!empty($deliveryModeList)){
                                                            foreach($deliveryModeList as $method){
                                                    ?>
                                                    <option value="<?= $method->id ?>" <?php if(isset($pickupMethod->friday) && $pickupMethod->friday==$method->id){echo "selected";} ?>><?= $method->name ?></option>
                                                    <?php }}?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Saturday</td>
                                            <td>
                                                <select class="form-control" name="saturday" required>
                                                    <?php if(!empty($deliveryModeList)){
                                                            foreach($deliveryModeList as $method){
                                                    ?>
                                                    <option value="<?= $method->id ?>" <?php if(isset($pickupMethod->saturday) && $pickupMethod->saturday==$method->id){echo "selected";} ?>><?= $method->name ?></option>
                                                    <?php }}?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Sunday</td>
                                            <td>
                                                <select class="form-control" name="sunday" required>
                                                    <?php if(!empty($deliveryModeList)){
                                                            foreach($deliveryModeList as $method){
                                                    ?>
                                                    <option value="<?= $method->id ?>" <?php if(isset($pickupMethod->sunday) && $pickupMethod->sunday==$method->id){echo "selected";} ?>><?= $method->name ?></option>
                                                    <?php }}?>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>

                                <div class="box-footer">
                                  <button type="submit" class="btn btn-success">Update</button>
                                  <a href="<?php echo base_url('admin/branch-list'); ?>" class="btn btn-info pull-right">Back</a>
                                </div>
                                <input type="hidden" name="branch_id" value="<?php echo $this->uri->segment(3);?>" />
                                <?php echo form_close(); ?>
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