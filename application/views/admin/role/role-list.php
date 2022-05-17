<?php
//echo '<pre>'; print_r($rateList);echo '</pre>';
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <form action="<?php echo base_url('admin/role'); ?>" method="POST" id="form1">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo $title_head; ?>
        </h1>
        <ol class="breadcrumb">            
            <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title_head; ?></li>
        </ol>
    </section>  
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="box box-secondary">
              <div class="box-header">
                <h3 class="box-title">All Roles</h3>
                <?php if (get_permission('ROLE', 'is_add')){ ?>
                <a href="<?php echo base_url('admin/role-add'); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Add Roles</a>
              <?php } ?>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Roles Name</th>
                    <th>System Role</th>
                    <th data-priority="2" data-sortable="false">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($all_roles as $key => $value) {?>
                  <tr id="tr_<?php echo $value['id']; ?>">
                    <td><?php echo ($key + 1); ?></td>
                    <td><?php echo $value['name']; ?> </td>
                    <td><?php echo (($value['is_system'] ==1) ? 'Yes' : 'No'); ?></td>
                    <td>
                      <?php if (get_permission('ROLE', 'is_edit')){ ?>
                      <a href="<?php echo base_url('admin/role-edit/'); ?><?php echo  $this->OuthModel->Encryptor('encrypt',$value['id']); ?>">                      
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>&nbsp;&nbsp;
                    <a href="<?php echo base_url('admin/role-permission/'); ?><?php echo  $this->OuthModel->Encryptor('encrypt',$value['id']); ?>" class="btn btn-default btn-circle">
                      <i class="fa fa-braille text-danger" aria-hidden="true"></i> Permission
                    </a>&nbsp;&nbsp;
                    <?php } if (get_permission('ROLE', 'is_delete')){ ?>
                      <?php if($value['is_system'] !=1){ ?>
                       <a href="#" class="text-danger" data-id="<?php echo $value['id']; ?>" onClick="deleteRecordAjax($(this),'<?php echo base64_encode('roles'); ?>')" ><i class="fa fa-trash" aria-hidden="true"></i>
                  <?php } }?>                    
                    
                    </td>
                  </tr>
                 <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

      </div><!-- /.container-fluid -->
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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