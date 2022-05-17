<?php
//echo '<pre>'; print_r($ShippingModeList); print_r($ShippingCatList); print_r($ShippingDocumentCatList); die;
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');


if (!empty($role_list[0]['id'])) {
    $title_head         = 'Edit Role';
    $name       = $role_list[0]['name'];  
} else {
    $title_head         = 'Add Role';
    $name       = '';    
}
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
            $this->load->view('admin/include/sidebar');
        ?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
        <h1>
           <?php echo $title_head; ?>
        </h1>
        <ol class="breadcrumb">            
            <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="">Roles</li>
            <li class="active">Roles <?php echo $title_head; ?></li>
        </ol>
    </section>
  
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <div class="col-md-12">
               <!-- general form elements -->
               <div class="box box-secondary">
                  <div class="box-header">
                     <h3 class="box-title">  <?php if ($this->uri->segment(3) !== null) {echo 'Edit Roles';} else {echo 'Add Roles';}?></h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <?php if (!empty($role_list[0]['id'])) {?>
                  <?php echo form_open(base_url('admin/role-edit'), array('id' => 'form1', 'class' => '', 'enctype' => 'multipart/form-data')); ?>                  
                     <input type="hidden" name="operation" value="edit">
                     <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                  <?php } else {?>
                     <?php echo form_open(base_url('admin/role-edit'), array('id' => 'form1', 'class' => '', 'enctype' => 'multipart/form-data')); ?>
                     <input type="hidden" name="operation" value="add">
                     <input type="hidden" name="id" value="">
                  <?php }?>
                     <div class="box-body">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="service_name">Role Name <sprice class="required">*</sprice></label>
                                 <input type="text" class="form-control validate[required]" name="name" id="name" placeholder="Role Name" value="<?php echo $name; ?>" >
                              </div>
                           </div>
                     </div>
                     <!-- /.box-body -->
                     <div class="box-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?php echo getLastUrl(); ?>" class="btn btn-default pull-right">Back</a>
                     </div>
                  <?php echo form_close(); ?>
               </div>
               <!-- /.box -->
            </div>
         </div>
         <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
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