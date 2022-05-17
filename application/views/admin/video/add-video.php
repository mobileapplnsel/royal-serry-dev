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
                    Add New Video
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="<?= base_url('admin/video-list') ?>"><i class="fa fa-dashboard"></i> Video List </a></li>
                    <li class="active">Add New Video</li>
                </ol>
            </section>    
            <div class="container">
                <div class="col-md-11">
                    <h2></h2>
                    <form method="POST" action="<?= base_url('videos/insertvideo') ?>" enctype="multipart/form-data" id="frmvideo">
                        <div class="form-group col-md-6">
                            <label>Is Series :</label>
                            <label style="display:none;">
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                Yes :                             
                                <input type="radio" name="is_series" class="minimal-red series" value="1" />
                            </label>&nbsp; &nbsp;
                            <label>
                                No :                            
                            <input type="radio" name="is_series" class="minimal-red series" value="0" checked />
                            </label>&nbsp; &nbsp;
                        </div>
                        <div class="form-group col-md-6">
                            <label>Is Banner :</label>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                Yes :
                                <input type="radio" name="is_banner" class="minimal-red" value="1" />
                            </label> &nbsp; &nbsp;
                            <label>
                                No :
                                <input type="radio" name="is_banner" class="minimal-red" value="0" checked />
                            </label> &nbsp; &nbsp;
                        </div>
                        <!--<div class="form-group col-md-6 col-md-offset-3"></div>-->
                        <div class="form-group col-md-6">
                            <label for="email">Video Title : </label>
                            <input type="text" class="form-control" placeholder="Video Title" name="video_title" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">User Age : </label>
                            <input type="text" class="form-control" placeholder="User Age" name="user_age" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Trailer Duration : </label>
                            <input type="text" class="time-duration form-control" placeholder="Trailer Duration" name="trailer_duration" value="" />
                        </div>
                        <div class="form-group col-md-6 main-video-switch">
                            <label for="email">Video Duration : </label>
                            <input type="text" class="time-duration form-control" placeholder="Video Duration" name="video_duration" value="" />
                        </div>                        
                        <div class="form-group col-md-6">
                            <label for="parent">Cast & Crew : </label>                            
                            <select class="form-control cast-crew-multiple" name="castcrew[]" multiple="multiple">
                                <?php
                                    if(!empty($castCrewList)){
                                        foreach($castCrewList as $castCrew){
                                ?>
                                    <option value="<?= $castCrew->cast_crews_id ?>"><?= $castCrew->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Video Tags : </label>                            
                            <select class="form-control cast-crew-multiple" name="videotags[]" multiple="multiple">
                                <?php
                                    if(!empty($videoTags)){
                                        foreach($videoTags as $tags){
                                ?>
                                    <option value="<?= $tags->tag_id ?>"><?= $tags->tag_name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="parent">Video Category : </label>                        
                            <select class="form-control cast-crew-multiple" name="category[]" multiple="multiple">
                                <option value="">Select Video Category</option>
                                <?php
                                    if(!empty($categoryList)){
                                        foreach($categoryList as $category){
                                ?>
                                <option value="<?= $category->cat_id ?>"><?= $category->category_name ?></option>
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
                            <textarea rows="10" cols="40" class="form-control" name="short_info" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Description : </label>
                            <textarea rows="10" cols="40" class="form-control" name="description" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Ratings : </label> <br/>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                1
                                <input type="radio" name="ratings" class="minimal-red" value="1" required />
                            </label> &nbsp; &nbsp;
                            <label>
                                2
                                <input type="radio" name="ratings" class="minimal-red" value="2"/>
                            </label> &nbsp; &nbsp;
                            <label>
                                3
                                <input type="radio" name="ratings" class="minimal-red" value="3"/>
                            </label> &nbsp; &nbsp;
                            <label>
                                4
                                <input type="radio" name="ratings" class="minimal-red" value="4"/>
                            </label> &nbsp; &nbsp;
                            <label>
                                5
                                <input type="radio" name="ratings" class="minimal-red" value="5"/>
                            </label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Publish Status : </label><br/>
                            <label style="display:none;">                                 
                                <input type="checkbox" class="minimal">
                            </label> &nbsp; &nbsp;
                            <label>
                                Active :
                                <input type="radio" name="publish_time" class="minimal-red" value="1" checked/>
                            </label> &nbsp; &nbsp;
                            <label>
                                In-Active :
                                <input type="radio" name="publish_time" class="minimal-red" value="0"/>
                            </label> &nbsp; &nbsp;
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pwd">Choose Trailer Resolution :</label><br/>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="426x240" class="minimal"> 426x240
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="640x360" class="minimal"> 640x360
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="854x480" class="minimal"> 854x480
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="1280x720" class="minimal"> 1280x720
                            </label>
                            <label>
                                <input type="checkbox" name="trailer_resolution[]" value="1920x1080" class="minimal"> 1920x1080
                            </label>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="main-video-switch">
                                <label for="pwd">Choose Main Video Resolution :</label><br/>
                                <label>
                                    <input type="checkbox" name="video_resolution[]" value="426x240" class="minimal"> 426x240
                                </label>
                                <label>
                                    <input type="checkbox" name="video_resolution[]" value="640x360" class="minimal"> 640x360
                                </label>
                                <label>
                                    <input type="checkbox" name="video_resolution[]" value="854x480" class="minimal"> 854x480
                                </label>
                                <label>
                                    <input type="checkbox" name="video_resolution[]" value="1280x720" class="minimal"> 1280x720
                                </label>
                                <label>
                                    <input type="checkbox" name="video_resolution[]" value="1920x1080" class="minimal"> 1920x1080
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pwd">Upload Video Poster Image :</label>
                            <input type="file" class="custom-file-input" name="video_poster_image" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pwd">Upload Mobile Poster Image :</label>
                            <input type="file" class="custom-file-input" name="mobile_poster_image" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pwd">Upload Trailer Video :</label>
                            <input type="file" class="custom-file-input" name="trailer_video" accept="video/mp4,video/x-m4v,video/*">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="main-video-switch">
                                <label for="pwd">Upload Main Video :</label>
                                <input type="file" class="custom-file-input" name="main_video" accept="video/mp4,video/x-m4v,video/*">
                            </div>
                        </div>
                        <div class="form-group col-md-12" style="margin-bottom:15px">
                            <button type="submit" class="btn btn-success">Add Video</button>
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