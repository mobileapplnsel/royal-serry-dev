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
                    Edit Video
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/video-list') ?>"><i class="fa fa-dashboard"></i> Videos List </a></li>
                    <li class="active">Edit Video</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <form method="POST" action="<?= base_url('videos/updatevideo') ?>/<?= $editVideo[0]->video_id ?>" enctype="multipart/form-data">
                        <div class="form-group col-md-6" style="display:none;">
                            <label>Is Series :</label>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                Yes :
                                <input type="radio" name="is_series" class="minimal-red" value="1" <?php if($editVideo[0]->is_series) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                            <label>
                                No :
                                <input type="radio" name="is_series" class="minimal-red" value="0" <?php if(!$editVideo[0]->is_series) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-group col-md-12">
                            <label>Is Banner :</label>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                Yes :
                                <input type="radio" name="is_banner" class="minimal-red" value="1" <?php if($editVideo[0]->is_banner) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                            <label>
                                No :
                                <input type="radio" name="is_banner" class="minimal-red" value="0" <?php if(!$editVideo[0]->is_banner) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Video Title : </label>
                            <input type="text" class="form-control" placeholder="Video Title" name="video_title" value="<?= $editVideo[0]->video_title ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">User Age : </label>
                            <input type="text" class="form-control" placeholder="User Age" name="user_age" value="<?= $editVideo[0]->user_age ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Trailer Duration : </label>
                            <input type="text" class="time-duration form-control" placeholder="Trailer Duration" name="trailer_duration" value="<?= $editVideo[0]->trailer_duration ?>" required>
                        </div>
                        <div class="form-group col-md-6" style="display:none;">
                            <label for="email">Video Duration : </label>
                            <input type="text" class="time-duration form-control" placeholder="Video Duration" name="video_duration" value="<?= $editVideo[0]->video_duration ?>" required>
                        </div>
                        <?php
                            if(!empty($editVidCast)){
                                $cnc    =   [];
                                foreach($editVidCast as $editCast){
                                    $cnc[]      =   $editCast->cast_crews_id;
                                }
                            }
                        ?>
                        <div class="form-group col-md-6">
                            <label for="parent">Cast & Crew : </label>                            
                            <select class="form-control cast-crew-multiple" name="castcrew[]" multiple="multiple">
                                <?php
                                    if(!empty($castCrewList)){
                                        foreach($castCrewList as $castCrew){
                                ?>
                                    <option value="<?= $castCrew->cast_crews_id ?>" <?php if(in_array($castCrew->cast_crews_id, $cnc, TRUE)){ echo "selected";} ?>><?= $castCrew->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <?php
                            if(!empty($editVidTag)){
                                $tag    =   [];
                                foreach($editVidTag as $editTg){
                                    $tag[]      =   $editTg->tag_id;
                                }
                            }
                        ?>
                        <div class="form-group col-md-6">
                            <label for="parent">Video Tags : </label>                            
                            <select class="form-control cast-crew-multiple" name="videotags[]" multiple="multiple">
                                <?php                                    
                                    if(!empty($videoTags)){
                                        foreach($videoTags as $tags){
                                ?>
                                    <option value="<?= $tags->tag_id ?>" <?php if(in_array($tags->tag_id, $tag, TRUE)){ echo "selected";} ?>><?= $tags->tag_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <?php
                            if(!empty($editVidCat)){
                                $cat   =   [];
                                foreach($editVidCat as $editCt){
                                    $cat[]      =   $editCt->category_id;
                                }
                            }
                        ?>
                        <div class="form-group col-md-12">
                            <label for="parent">Video Category : </label>                        
                            <select class="form-control cast-crew-multiple" name="category[]" multiple="multiple">
                                <option value="">Select Video Category</option>
                                <?php
                                    if(!empty($categoryList)){
                                        foreach($categoryList as $category){
                                ?>
                                <option value="<?= $category->cat_id ?>" <?php if(in_array($category->cat_id, $cat, TRUE)){ echo "selected";} ?>><?= $category->category_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label for="parent">Video Sub Category : </label>                        
                            <select class="form-control" name="parent_cat_id">
                                <option value="">Select Video Sub Category</option>
                                <?php
                                    if(!empty($childCategory)){
                                        foreach($childCategory as $chcategory){
                                ?>
                                <option value="<?= $chcategory->cat_id ?>"><?= $chcategory->category_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div> -->
                        <div class="form-group col-md-6">
                            <label for="email">Short Description : </label>
                            <textarea rows="10" cols="40" class="form-control" name="short_info" style="resize:none;"><?= $editVideo[0]->short_info ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Description : </label>
                            <textarea rows="10" cols="40" class="form-control" name="description" style="resize:none;"><?= $editVideo[0]->description ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Ratings : </label> <br/>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                1
                                <input type="radio" name="ratings" class="minimal-red" value="1" <?php if($editVideo[0]->ratings == 1) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                            <label>
                                2
                                <input type="radio" name="ratings" class="minimal-red" value="2" <?php if($editVideo[0]->ratings == 2) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                            <label>
                                3
                                <input type="radio" name="ratings" class="minimal-red" value="3" <?php if($editVideo[0]->ratings == 3) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                            <label>
                                4
                                <input type="radio" name="ratings" class="minimal-red" value="4" <?php if($editVideo[0]->ratings == 4) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                            <label>
                                5
                                <input type="radio" name="ratings" class="minimal-red" value="5" <?php if($editVideo[0]->ratings == 5) {echo 'checked';} ?>/>
                            </label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Publish Status : </label><br/>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                Active :
                                <input type="radio" name="publish_time" class="minimal-red" value="1" <?php if($editVideo[0]->publish_time) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                            <label>
                                In-Active :
                                <input type="radio" name="publish_time" class="minimal-red" value="0" <?php if(!$editVideo[0]->publish_time) {echo 'checked';} ?>/>
                            </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                                if(!empty($editVidResolution)){
                                    $trailerRes   =   [];
                                    foreach($editVidResolution as $trailerResolution){
                                        $trailerRes[]      =   $trailerResolution->trailer_video_resize;
                                    }
                                }
                                $trailerRes = array_diff( $trailerRes, [0] );  
                            ?>
                            <label for="pwd">Choose Trailer Resolution :</label><br/>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="426x240" class="minimal" <?php if(in_array("426x240", $trailerRes, TRUE)){ echo "checked";} ?>> 426x240
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="640x360" class="minimal" <?php if(in_array("640x360", $trailerRes, TRUE)){ echo "checked";} ?>> 640x360
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="854x480" class="minimal" <?php if(in_array("854x480", $trailerRes, TRUE)){ echo "checked";} ?>> 854x480
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="1280x720" class="minimal" <?php if(in_array("1280x720", $trailerRes, TRUE)){ echo "checked";} ?>> 1280x720
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="1920x1080" class="minimal" <?php if(in_array("1920x1080", $trailerRes, TRUE)){ echo "checked";} ?>> 1920x1080
                            </label>
                        </div>
                        <div class="form-group col-md-6" <?php if($editVideo[0]->is_series == '1'){?>style="display:none;" <?php }?>>
                            <?php
                                if(!empty($editVidResolution)){
                                    $videoRes   =   [];
                                    foreach($editVidResolution as $mainResolution){
                                        $videoRes[]      =   $mainResolution->main_video_resize;
                                    }
                                }
                                $videoRes = array_diff( $videoRes, [0] );  
								//print_r($videoRes);                              
                            ?>
                            <label for="pwd">Choose Main Video Resolution :</label><br/>
                            <label>
                                <input type="checkbox" name="video_resolution[]" value="426x240" class="minimal" <?php if(in_array("426x240", $videoRes, TRUE)){ echo "checked";} ?>> 426x240
                            </label>
                            <label>
                                <input type="checkbox" name="video_resolution[]" value="640x360" class="minimal" <?php if(in_array("640x360", $videoRes, TRUE)){ echo "checked";} ?>> 640x360
                            </label>
                            <label>
                                <input type="checkbox" name="video_resolution[]" value="854x480" class="minimal" <?php if(in_array("854x480", $videoRes, TRUE)){ echo "checked";} ?>> 854x480
                            </label>
                            <label>
                                <input type="checkbox" name="video_resolution[]" value="1280x720" class="minimal" <?php if(in_array("1280x720", $videoRes, TRUE)){ echo "checked";} ?>> 1280x720
                            </label>
                            <label>
                                <input type="checkbox" name="video_resolution[]" value="1920x1080" class="minimal" <?php if(in_array("1920x1080", $videoRes, TRUE)){ echo "checked";} ?>> 1920x1080
                            </label>
                        </div>                       
                        <div class="form-group col-md-6">
                            <?php 
                                $videoPoster    =   FCPATH.'uploads/videos/'.$editVideo[0]->video_directory_path.'/'.$editVideo[0]->video_poster_image;
                                $mobilePoster   =   FCPATH.'uploads/videos/'.$editVideo[0]->video_directory_path.'/'.$editVideo[0]->mobile_poster_image;
                                if(file_exists($videoPoster)){
                            ?>    
                                <input type="hidden" name="old_video_poster" value="<?= $editVideo[0]->video_poster_image ?>">
                                <img width="150px" height="150px" src="<?php echo base_url('uploads/videos/').$editVideo[0]->video_directory_path.'/'.$editVideo[0]->video_poster_image ?>"/>
                            <?php
                                }
                            ?>
                            <!-- <img width="150px" height="150px" src="<?php echo $videoPoster; ?>"/> -->
                            <label for="pwd">Upload Video Poster Image :</label>
                            <input type="file" class="custom-file-input" name="video_poster_image" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                                if(file_exists($mobilePoster)){
                            ?>
                                <input type="hidden" name="old_mobile_poster" value="<?= $editVideo[0]->mobile_poster_image ?>">
                                <img width="150px" height="150px" src="<?php echo base_url('uploads/videos/').$editVideo[0]->video_directory_path.'/'.$editVideo[0]->mobile_poster_image ?>"/>
                            <?php
                                }
                            ?>
                            <label for="pwd">Upload Mobile Poster Image :</label>
                            <input type="file" class="custom-file-input" name="mobile_poster_image" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pwd">Upload Trailer Video :</label>
                            <input type="file" class="custom-file-input" name="trailer_video" accept="video/mp4,video/x-m4v,video/*">
                        </div>
                        <div class="form-group col-md-6" style="display:none;">
                            <label for="pwd">Upload Main Video :</label>
                            <input type="file" class="custom-file-input" name="main_video" accept="video/mp4,video/x-m4v,video/*">
                        </div>
                        <div class="form-group col-md-12" style="margin-bottom:15px">
                            <input type="hidden" name="video_directory_path" value="<?= $editVideo[0]->video_directory_path ?>" />
                            <button type="submit" class="btn btn-warning">Update Video</button>
                        </div>
                    </form>
                    
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