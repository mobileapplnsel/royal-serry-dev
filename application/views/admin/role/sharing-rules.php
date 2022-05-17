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
     <form action="<?php echo base_url('admin/outgoing-server'); ?>" method="POST" id="form1">
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
                <h3 class="box-title">Assign Role to User</h3>
                <!-- <a href="<?php echo base_url('admin/sharing-rule-add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add Sharing Rule</a> -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>                    
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Role</th>
                    <th data-priority="2" data-sortable="false">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($role_user as $key => $value) {?>
                  <tr id="tr_<?php echo $value['user_id']; ?>">
                    <td><?php echo ($key + 1); ?></td>
                    <td><?php echo $value['user_name']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['userType']; ?></td>
                    <td><?php echo $value['role_name']; ?></td>
                    <td>
                      <?php if (get_permission('SHARINGRULES', 'is_edit')){ ?>
                       <a href="<?php echo base_url('admin/sharing-rule-edit/'); ?><?php echo $this->OuthModel->Encryptor('encrypt',$value['user_id']); ?>">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                  <?php } ?>
                    <!-- &nbsp;&nbsp;<a href="#" class="text-danger" data-id="<?php echo $value['id']; ?>" onClick="softDeleteRecord($(this),'<?php echo base64_encode(TABLE_PREFIX . 'outgoing_server'); ?>')" ><i class="far fa-trash-alt"></i></a> -->
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