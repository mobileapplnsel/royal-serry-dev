<?php
//echo '<pre>'; print_r($userPickupOrderList); echo '</pre>'; die;
$CI =& get_instance();
$CI->load->model('container_model');
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<style type="text/css">
.custom-file-input {
  color: transparent;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Choose files...';
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
}
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
                    Delivery Image Upload
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/pdboy-delivery-order-list') ?>"><i class="fa fa-dashboard"></i>Delivery Order List</a></li>
                    <li class="active">Delivery Image Upload</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Select Delivery Images</h3>
                            </div>
                            <div class="box-body" id="element_overlapT">
                                <form id="image-upload" method="POST" enctype="multipart/form-data">
                                <?php echo form_open(base_url('admin/processImage'), array('id' => 'image-upload', 'class' => '', 'enctype' => 'multipart/form-data')); ?>                                
                                <input type="hidden" name="shipment_id" id="shipment_id" value="<?php echo $this->uri->segment(3); ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="file" name="images[]" id="file_input" class="custom-file-input" multiple />        
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" id="save" class="btn btn-success">Upload</button>  
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>                    
                        </div>

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Uploaded Images</h3>
                            </div>
                            <div class="box-body">
                                <table id="example" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>                                            
                                            <th>Image</th>                                            
                                            <th>Comments</th> 
                                            <th>Action</th>                          
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php                                         
                                            if(count($uploadedImageList) > 0) { 
                                                foreach ($uploadedImageList as $key => $value) { 
                                        ?>
                                            <tr id="tr_<?php echo $value->id; ?>">
                                                <td><?php echo ($key + 1); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('uploads/delivery/'); ?><?php echo $value->image; ?>" download>
                                                    <img src="<?php echo base_url('uploads/delivery/'); ?><?php echo $value->image; ?>" class="img-thumbnail" width="100px"></a>
                                                </td>
                                                <td>
                                                    <input type="text" name="comment_<?php echo $value->id; ?>" id="comment_<?php echo $value->id; ?>" value="<?php echo $value->comment; ?>" class="form-control" onBlur="saveComments($(this).val(),'<?php echo $value->id; ?>');">
                                                </td>
                                                <td>
                                                    <!--<a href="javascript:void(0);" class="text-danger" data-id="<?php echo $value->id; ?>" onClick="deleteImage('<?php echo $value->id; ?>');"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
                                                    <a data-toggle="modal" data-target="#deliveryimgDeleteModal" data-deliveryimg-id="<?= $value->id ?>" class="btn text-danger" style="text-align: left"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>                                       
                                        <?php } } else {?>
                                            <tr>
                                                <td>No data available in table</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>                    
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
$(document).ready(function(){
    $('#save').on('click', function(){    
        $("#element_overlapT").LoadingOverlay("show");
        toastr.remove()
        toastr.success('<span style="color:#fff;">Please wait...</span>');    
        var fileInput   = $('#file_input')[0];        
        var shipment_id = $('#shipment_id').val();
        var type        = '2';
        if( fileInput.files.length > 0 ){
            var formData = new FormData();
            $.each(fileInput.files, function(k,file){
                formData.append('images[]', file);
            });            
            formData.append('shipment_id', shipment_id);     
            formData.append('type', type);     
            $.ajax({
                method: 'post',
                url:"<?php echo base_url('admin/processImage'); ?>",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if(data.code == 400)
                    {
                      toastr.remove()
                      toastr.error('<span style="color:#fff;">'+data.error+'</span>');
                    }

                    if(data.status == 0)
                    {
                      toastr.remove()
                      toastr.error('<span style="color:#fff;">'+data.message+'</span>');
                    }
                    if(data.status == 1)
                    {
                        toastr.remove()
                        toastr.success('<span style="color:#fff;">'+data.message+'</span>');
                        $('#image-upload').trigger('reset');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        }else{
            $("#element_overlapT").LoadingOverlay("hide", true);
            toastr.remove()
            toastr.error('<span style="color:#fff;">No Files Selected/</span>');
        }
    });
});

function saveComments(comment,id){  
    if(comment !=''){
        var csrfName         = '<?php echo $this->security->get_csrf_token_name(); ?>',csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';  
        $.ajax({
            dataType : "json",
            type : "post",
            url:"<?php echo base_url('admin/saveImageComments'); ?>",
            data: {[csrfName]: csrfHash, comment: comment,id :id},
            cache: false,
            success: function(data){
                //console.log(data);
                //$("#element_overlapT").LoadingOverlay("hide", true);
                if(data.code == 400)
                {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">'+data.error+'</span>');
                }

                if(data.status == 0)
                {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">'+data.message+'</span>');
                }
                if(data.status == 1)
                {
                    toastr.remove()
                    toastr.success('<span style="color:#fff;">'+data.message+'</span>');
                    // $('#image-upload').trigger('reset');
                    // setTimeout(function() {
                    //     location.reload();
                    // }, 2000);
                }
            }
        });
    }    
}

function deleteImage(id){
    var csrfName         = '<?php echo $this->security->get_csrf_token_name(); ?>',csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';  
    if (confirm("Are you sure want to delete ?")) {
        $.ajax({
            dataType : "json",
            type : "post",
            url:"<?php echo base_url('admin/deleteImageComments'); ?>",
            data: {[csrfName]: csrfHash,id :id},
            cache: false,
            success: function(data){
                //console.log(data);
                //$("#element_overlapT").LoadingOverlay("hide", true);
                if(data.code == 400)
                {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">'+data.error+'</span>');
                }

                if(data.status == 0)
                {
                  toastr.remove()
                  toastr.error('<span style="color:#fff;">'+data.message+'</span>');
                }
                if(data.status == 1)
                {
                    toastr.remove()
                    toastr.success('<span style="color:#fff;">'+data.message+'</span>');
                    $('#tr_'+id).hide(500);
                    // $('#image-upload').trigger('reset');
                    // setTimeout(function() {
                    //     location.reload();
                    // }, 2000);
                }
            }
        });
    }
}
</script>