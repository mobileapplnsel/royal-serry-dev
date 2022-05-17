<?php
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
                    Add / Edit Videos Series
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/addvideo') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add New Video</a></li>
                    <li><a href="<?= base_url('admin/video-list') ?>"><i class="fa fa-dashboard"></i>Videos List</a></li>
                    <li class="active">Videos Series List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add / Edit Videos</h3>
                            </div>
                            <form method="POST" action="<?= base_url('videos/insertseriesvideo') ?>/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="email">Episode Name : </label>
                                <input type="text" class="form-control" placeholder="Episode Name" name="episode_name" value="<?php echo(isset($series_details->episode_name)? $series_details->episode_name : set_value('episode_name')); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Episode Number : </label>
                                <input type="text" class="form-control" placeholder="Episode Number" name="episode_no" value="<?php echo(isset($series_details->episode_no)? $series_details->episode_no : set_value('episode_no')); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                            <?php
                                if(!empty($editVidResolution)){
                                    $trailerRes   =   [];
                                    foreach($editVidResolution as $trailerResolution){
                                        $trailerRes[]      =   $trailerResolution->main_video_resize;
                                    }
									$trailerRes = array_diff( $trailerRes, [0] ); 
                                }
                                                               
                            ?>
                                <label for="pwd">Resolution :</label><br/>
                                <label>
                                    <input type="checkbox" name="series_resolution[]" value="426x240" class="minimal" <?php if(!empty($trailerRes)){ if(in_array("426x240", $trailerRes, TRUE)){ echo "checked";} }?>> 426x240
                                </label>
                                <label>
                                    <input type="checkbox" name="series_resolution[]" value="640x360" class="minimal" <?php if(!empty($trailerRes)){ if(in_array("640x360", $trailerRes, TRUE)){ echo "checked";} }?>> 640x360
                                </label>
                                <label>
                                    <input type="checkbox" name="series_resolution[]" value="854x480" class="minimal" <?php if(!empty($trailerRes)){ if(in_array("854x480", $trailerRes, TRUE)){ echo "checked";} }?>> 854x480
                                </label>
                                <label>
                                    <input type="checkbox" name="series_resolution[]" value="1280x720" class="minimal" <?php if(!empty($trailerRes)){ if(in_array("1280x720", $trailerRes, TRUE)){ echo "checked";} }?>> 1280x720
                                </label>
                                <label>
                                    <input type="checkbox" name="series_resolution[]" value="1920x1080" class="minimal" <?php if(!empty($trailerRes)){ if(in_array("1920x1080", $trailerRes, TRUE)){ echo "checked";} }?>> 1920x1080
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pwd">Upload Series Video :</label>
                                <input type="file" class="custom-file-input" name="series_video_name" accept="video/mp4,video/x-m4v,video/*">
                            </div>
                            <div class="form-group col-md-12" style="margin-bottom:15px">
                                <button type="submit" class="btn btn-success">Add Series Video</button>
                            </div>
                            <input type="hidden" name="video_id" value="<?php echo $this->uri->segment(3);?>" />
                            </form>
                            
                            <h3>Videos Series List</h3>
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Episode Name</th>                                            
                                            <th>Episode No</th>
                                            <th>Video Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($videoSeriesList)):
                                            foreach($videoSeriesList as $series){
                                        ?>
                                        <tr>
                                            <td><?= $series->vid_web_id ?></td>
                                            <td><ul class="admin-action btn btn-default" style="list-style:none;">
                                                <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"> Action <span class="caret"></span> </a>
                                                  <ul class="dropdown-menu dropdown-menu-left">
                                                    <li role="presentation"> <a role="button" href="<?= base_url('videos/insertseriesvideo') ?>/<?php echo $series->video_id;?>/<?php echo $series->vid_web_id;?>" class="btn" style="text-align: left"><i class="fa fa-pencil text-blue"></i> Edit</a> </li>
                                                    <li role="presentation"> <a data-toggle="modal" data-target="#videoseriesDeleteModal" data-series-id="<?= $series->vid_web_id ?>" class="btn" style="text-align: left"><i class="fa fa-trash text-red"></i> Delete</a> </li>
                                                  </ul>
                                                </li>
                                              </ul></td>
                                            <td><?= $series->episode_name ?></td>
                                            <td><?= $series->episode_no ?></td>
                                            <td><?= $series->series_video_name ?></td>
                                        </tr>
                                        <?php 
                                            }                                            
                                            else:
                                            echo '<td rowspan="5">No Videos Series Found</td>';
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
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