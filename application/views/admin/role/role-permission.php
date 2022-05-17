  <?php
//echo '<pre>'; print_r($ShippingModeList); print_r($ShippingCatList); print_r($ShippingDocumentCatList); die;
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
                <h3 class="box-title">Role Permission For : <b><?php echo get_type_name_by_id('roles', $role_id); ?></b></h3>
                <!-- <a href="<?php //echo base_url('admin/role-add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add Permission</a> -->
              </div>
              <?php //echo form_open_multipart($this->uri->uri_string()); ?>
              <?php echo form_open(base_url('admin/addEditPermission'), array('id' => 'permissionForm')); ?>

              <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered table-hover table-condensed mt-sm" cellspacing="2" cellpadding="2" width="100%">
                  <thead>
                    <tr>
                      <th><?php echo Ucfirst('feature'); ?></th>
                      <th>
                        <div class="icheck-warning d-inline"> 
                          <input type="checkbox" id="all_view" value="1"> <label for="all_view"><?php echo Ucfirst('view'); ?></label> 
                        </div>                       
                      </th>
                      <th>
                        <div class="icheck-warning d-inline"> 
                          <input type="checkbox" id="all_add" value="1"> <label for="all_add"><?php echo Ucfirst('add'); ?></label> 
                        </div>
                      </th>
                      <th>
                        <div class="icheck-warning d-inline"> 
                          <input type="checkbox" id="all_edit" value="1"> <label for="all_edit"><?php echo Ucfirst('edit'); ?></label> 
                        </div>
                      </th>
                      <th>
                        <div class="icheck-warning d-inline"> 
                          <input type="checkbox" id="all_delete" value="1"> <label for="all_delete"><?php echo Ucfirst('delete'); ?></label> 
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(count($modules)){ 

                      foreach($modules as $module):
                      ?>
                    <tr>
                      <th colspan="5" style="color: <?php echo $module['tab_color']; ?>"><?php echo $module['icon_path']; ?> <?php echo $module['patent_name']; ?></th>
                    </tr>
                    <?php
                    $permissions = $this->role_model->check_permissions($module['parent_id'], $role_id);
                    foreach($permissions as $permission):
                    ?>
                    <input type="hidden" name="privileges[<?php echo $permission['tabid']; ?>][privileges_id]" value="<?php echo $permission['tabid']; ?>">
                    <tr>
                      <td class="pl-xl">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $permission['icon_path']; ?> </i> <?php echo $permission['tablabel']; ?></td>
                      <td>
                        <?php if($permission['show_view']){ ?>
                        <div class="icheck-success d-inline" <?php if($module['show_admin'] == 0 and $role_id == 1) { echo 'style="pointer-events: none;"'; } ?>> 
                          <input type="checkbox" class="cb_view" name="privileges[<?php echo $permission['tabid']; ?>][view]" id="privileges[<?php echo $permission['tabid']; ?>][view]" <?php echo ($permission['is_view'] == 1 ? 'checked' : '');?> value="1" >
                          <label for="privileges[<?php echo $permission['tabid']; ?>][view]"></label>
                        </div>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($permission['show_add']){ ?>
                        <div class="icheck-success d-inline" <?php if($module['show_admin'] == 0 and $role_id == 1) { echo 'style="pointer-events: none;"'; } ?>> 
                          <input type="checkbox" class="cb_add" name="privileges[<?php echo $permission['tabid']; ?>][add]" id="privileges[<?php echo $permission['tabid']; ?>][add]" <?php echo ($permission['is_add'] == 1 ? 'checked' : '');?> value="1" >
                          <label for="privileges[<?php echo $permission['tabid']; ?>][add]"></label>
                        </div>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($permission['show_edit']){ ?>
                        <div class="icheck-success d-inline" <?php if($module['show_admin'] == 0 and $role_id == 1) { echo 'style="pointer-events: none;"'; } ?>> 
                          <input type="checkbox" class="cb_edit" name="privileges[<?php echo $permission['tabid']; ?>][edit]" id="privileges[<?php echo $permission['tabid']; ?>][edit]" <?php echo ($permission['is_edit'] == 1 ? 'checked' : '');?> value="1" >
                          <label for="privileges[<?php echo $permission['tabid']; ?>][edit]"></label>
                        </div>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($permission['show_delete']){ ?>
                        <div class="icheck-success d-inline" <?php if($module['show_admin'] == 0 and $role_id == 1) { echo 'style="pointer-events: none;"'; } ?>> 
                          <input type="checkbox" class="cb_delete" name="privileges[<?php echo $permission['tabid']; ?>][delete]" id="privileges[<?php echo $permission['tabid']; ?>][delete]" <?php echo ($permission['is_delete'] == 1 ? 'checked' : '');?> value="1" >
                          <label for="privileges[<?php echo $permission['tabid']; ?>][delete]"></label>
                        </div>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endforeach; }?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="save" value="1" class="btn btn-success">Update</button>
                <a href="<?php echo getLastUrl(); ?>" class="btn btn-default pull-right">Back</a>
              </div>
              <?php echo form_close(); ?>
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
<script type="text/javascript">
  // permission page select all
$("#all_view").on( "click", function() {
    if($(this).is(':checked')){           
        $(".cb_view").prop("checked", true);
    }else{
        $(".cb_view").prop("checked", false);
    }
});

$("#all_add").on( "click", function() {
    if($(this).is(':checked')){           
        $(".cb_add").prop("checked", true);
    }else{
        $(".cb_add").prop("checked", false);
    }
});

$("#all_edit").on( "click", function() {
    if($(this).is(':checked')){           
        $(".cb_edit").prop("checked", true);
    }else{
        $(".cb_edit").prop("checked", false);
    }
});

$("#all_delete").on( "click", function() {
    if($(this).is(':checked')){           
        $(".cb_delete").prop("checked", true);
    }else{
        $(".cb_delete").prop("checked", false);
    }
});
</script>