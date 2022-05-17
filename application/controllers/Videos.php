<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','encryption', 'encrypt','session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('video_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   Videos Functions   ********************************************/

    public function index($page = 'list-videos')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/video/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                   =   [];
                $data['videosList']     =   $this->video_model->getVideosList();
                $data['title']          =   ucfirst($page);                
                $this->load->view('admin/video/' . $page, $data);
            }
        }
    }

    public function addvideo($page = 'add-video')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/video/' . $page . '.php'))
            {
                show_404();
            }
            else{
                if(!$this->session->userdata('logged_in'))
                {
                    return redirect('admin/login');
                }
                else{
                    $id = 0;
                    $data['parentCategory']     =   $this->video_model->getParentCategory($id);
                    $data['childCategory']      =   $this->video_model->getChildCategory($id);
                    $data['categoryList']       =   array_merge($data['parentCategory'],$data['childCategory']);
                    $data['castCrewList']       =   $this->video_model->getCastCrewList();
                    $data['videoTags']          =   $this->video_model->getVideoTags();
                    $data['title']              =   ucfirst($page);
                    $this->load->view('admin/video/' . $page, $data);
                }
            }
        }
    }

    public function insertvideo()
    {
        $this->form_validation->set_rules('is_series', 'Series Check', 'required');
        $this->form_validation->set_rules('video_title', 'Video Title', 'trim|required');
        $this->form_validation->set_rules('user_age', 'User Age', 'required');
        $this->form_validation->set_rules('ratings', 'Ratings', 'required');
        $this->form_validation->set_rules('publish_time', 'Publish Status', 'required');
        
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            // return redirect('categories/addcategories');
            echo redirectPreviousPage();
        }
        else
        {
            //Trailer Video         
            $file_name_tr 		= 	$_FILES['trailer_video']['name'];
            $file_size_tr 		=	$_FILES['trailer_video']['size'];
            $file_tmp_tr 		=	$_FILES['trailer_video']['tmp_name'];
            $file_type_tr		=	$_FILES['trailer_video']['type'];
            $file_arr_tr		=	explode('.',$_FILES['trailer_video']['name']);
            $file_ext_tr		=	strtolower(end($file_arr_tr));
            $file_ext_tr		=	"mp4";
            $file_out_ext_tr 	= 	str_replace(' ','-',$file_arr_tr[0]);

            $resolutionTr 	    = 	$this->input->post('trailer_resolution', TRUE);
            
            //directory path
            $videopath          =   '/home/solutio9/public_html/dev/ottdev/uploads/videos/';            

            $video_dir_Name     =   strtolower($file_out_ext_tr);

            if(!is_dir('./uploads/videos/'.$video_dir_Name)){
                mkdir('./uploads/videos/'.$video_dir_Name);
            }
            
            $file_out_ext_tr    =   $file_out_ext_tr.'-trailer';

            $videopath  =   $videopath.$video_dir_Name;

            foreach($resolutionTr as $resovalue_tr){
                $commandTr    =   "/usr/bin/ffmpeg -y -i $file_tmp_tr -s $resovalue_tr  -strict -2 $videopath/$file_out_ext_tr-$resovalue_tr.$file_ext_tr";
                //echo $command;
                system($commandTr);
            }

            $resolution     =   [];

            //upload new video of if not series
            if($_FILES['main_video']['name']){
                //Main Video
                $file_name 		= 	$_FILES['main_video']['name'];
                $file_size 		=	$_FILES['main_video']['size'];
                $file_tmp 		=	$_FILES['main_video']['tmp_name'];
                $file_type		=	$_FILES['main_video']['type'];
                $file_arr		=	explode('.',$_FILES['main_video']['name']);
                $file_ext		=	strtolower(end($file_arr));
                $file_ext		=	"mp4";
                $file_out_ext 	= 	str_replace(' ','-',$file_arr[0]);

                $resolution     = 	$this->input->post('video_resolution', TRUE);

                foreach($resolution as $resovalue){
                    $command    =   "/usr/bin/ffmpeg -y -i $file_tmp -s $resovalue  -strict -2 $videopath/$file_out_ext-$resovalue.$file_ext";
                    system($command);
                }
            }

            $this->load->library('image_lib');
            
            $config['upload_path']       =   './uploads/videos/'.$video_dir_Name.'/';
            $config['allowed_types']     =   'gif|jpg|png';
            
            if($_FILES["video_poster_image"]["name"]){
                $config["file_name"]    =   time().'-'.$_FILES["video_poster_image"]['name'];
                $this->load->library('upload', $config);
                $posterImage    =   $this->upload->do_upload('video_poster_image');
                $image_data     =   $this->upload->data();
                // Resize image to the given format
                $imageResize    =   [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  1380,
                                    'height'          =>  768,
                                ];
                
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
            }
        
            if($_FILES["mobile_poster_image"]["name"]){
                $config["file_name"]    =   time().'-'.$_FILES["mobile_poster_image"]['name'];
                if($_FILES["video_poster_image"]["name"]){
                    $this->upload->initialize($config);
                }else{
                    $this->loadl->library('upload', $config);
                }
                $mobilePoster = $this->upload->do_upload('mobile_poster_image');
                $image_data = $this->upload->data();
                // Resize image to the given format
                $imageResize =  [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  220,
                                    'height'          =>  320,
                                ];
                
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
            }
            
            $data                           =   [];

            if($this->input->post('is_series', TRUE) == 1){
                $data['video_duration']         =   0;
                $data['main_video']             =   "NA";                
            }
            else{
                $data['video_duration']         =   $this->input->post('video_duration', TRUE);
                $data['main_video']             =   $file_out_ext;
            }
            
            $data['video_title']            =   $this->input->post('video_title', TRUE);
            $data['user_age']               =   $this->input->post('user_age', TRUE);
            $data['trailer_duration']       =   $this->input->post('trailer_duration', TRUE);
            $data['trailer_video']          =   $file_out_ext_tr;
            
            
            $data['ratings']                =   $this->input->post('ratings', TRUE);
            $data['publish_time']           =   $this->input->post('publish_time', TRUE);
            $data['short_info']             =   $this->input->post('short_info', TRUE);
            $data['description']            =   $this->input->post('description', TRUE);

            $data['video_poster_image']     =	time().'-'.$_FILES["video_poster_image"]['name'];
            $data['mobile_poster_image']    =	time().'-'.$_FILES["mobile_poster_image"]['name'];

            $data['video_directory_path']   =   $video_dir_Name;
            $data['is_series']              =   $this->input->post('is_series', TRUE);
            $data['is_banner']              =   $this->input->post('is_banner', TRUE);
            $data['status']                 =   $this->input->post('publish_time', TRUE);

            $cast_crew                      =   $this->input->post('castcrew', TRUE);
            $videotags                      =   $this->input->post('videotags', TRUE);
            $categories                     =   $this->input->post('category', TRUE);
            
            $videoId    =   $this->video_model->insert_video($data);
            
            if(count($cast_crew) > 0 && $videoId != 0){
                $castCrew   =   [];
                foreach($cast_crew as $crew){
                    $castCrew['video_id']       =       $videoId;
                    $castCrew['cast_crews_id']  =       $crew;
                    $insertCnC   =   $this->video_model->insertcast_crew($castCrew);
                }
            }

            if(count($videotags) > 0 && $videoId != 0){
                $video_tags   =   [];
                foreach($videotags as $tag){
                    $video_tags['video_id']     =       $videoId;
                    $video_tags['tag_id']       =       $tag;
                    $insertTags   =   $this->video_model->insert_video_tag($video_tags);
                }
            }

            if(count($categories) > 0 && $videoId != 0){
                $category   =   [];
                foreach($categories as $categoryx){
                    $category['video_id']       =       $videoId;
                    $category['category_id']    =       $categoryx;
                    $insertCategory   =   $this->video_model->insert_category_video($category);
                }
            }

            if(count($resolutionTr) > 0 && $videoId != 0){
                $resolution_trailer   =   [];
                foreach($resolutionTr as $trailer){
                    $resolution_trailer['video_id']                 =       $videoId;
                    $resolution_trailer['trailer_video_resize']     =       $trailer;
                    $resolution_trailer['main_video_resize']        =       0;
                    $insertResolutionTrailer    =   $this->video_model->insert_resolution($resolution_trailer);
                }
            }

            if(count($resolution) > 0 && $videoId != 0){
                $resolution_video   =   [];
                foreach($resolution as $video){
                    $resolution_video['video_id']                 =       $videoId;
                    $resolution_video['trailer_video_resize']     =       0;
                    $resolution_video['main_video_resize']        =       $video;
                    $insertResolutionVideo      =   $this->video_model->insert_resolution($resolution_video);
                }
            }

            if($videoId > 0 && $cast_crew > 0 && $videotags > 0 && $resolutionTr > 0){
                $this->session->set_flashdata('success', 'Video added Successfully');
                //return redirect('domestic/addpackage');
                echo redirectPreviousPage();
                exit;
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                //return redirect('domestic/addpackage');
                echo redirectPreviousPage();
                exit;
            }            
        }
    }

    public function editvideo($id)
    {
        $cid = 0;
        $data['parentCategory']     =   $this->video_model->getParentCategory($cid);
        $data['childCategory']      =   $this->video_model->getChildCategory($cid);
        $data['categoryList']       =   array_merge($data['parentCategory'],$data['childCategory']);
        $data['castCrewList']       =   $this->video_model->getCastCrewList();
        $data['videoTags']          =   $this->video_model->getVideoTags();
        
        $data['editVideo']          =   $this->video_model->editVideo($id);
        $data['editVidCast']        =   $this->video_model->editVideoCastCrew($id);
        $data['editVidCat']         =   $this->video_model->editVideoCategory($id);
        $data['editVidTag']         =   $this->video_model->editVideoTags($id);
        $data['editVidResolution']  =   $this->video_model->editVideoResolution($id);

        /*print_r($data);
        die();*/
        $this->load->view('admin/video/edit-video', $data);
    }
    
    public function updatevideo($id)
    {
        $this->form_validation->set_rules('is_series', 'Series Check', 'required');
        $this->form_validation->set_rules('video_title', 'Video Title', 'trim|required');
        $this->form_validation->set_rules('user_age', 'User Age', 'required');
        $this->form_validation->set_rules('ratings', 'Ratings', 'required');
        $this->form_validation->set_rules('publish_time', 'Publish Status', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editvideo/'.$id);
        }
        else
        {
            $data               =       [];
            $videopath          =       '/home/solutio9/public_html/dev/ottdev/uploads/videos/';

            $video_dir_Name     =       $this->input->post('video_directory_path', TRUE);
            $videopath          =       $videopath.$video_dir_Name;

            if(!is_dir('./uploads/videos/'.$video_dir_Name)){
                mkdir('./uploads/videos/'.$video_dir_Name);
            }

            $config['upload_path']       =   './uploads/videos/'.$video_dir_Name.'/';
            $config['allowed_types']     =   'gif|jpg|png';

            //delete the trailer if any of checkbox is unchecked without uploading the video
            if(!$_FILES['trailer_video']['name']){
                $dbTrVideoResolution    =   $this->video_model->editVideoResolution($id);
                $resolutionTrx 	        = 	$this->input->post('trailer_resolution', TRUE);
                $exsitingTrResolution   =   [];
                $trInc                  =   0;
                foreach($dbTrVideoResolution as $dbTrResolution){
                    if($dbTrResolution->trailer_video_resize){
                        $exsitingTrResolution[$trInc]     =   $dbTrResolution->trailer_video_resize;
                        $trInc++;
                    }
                }

                $unlinkArray    =   array_diff($exsitingTrResolution,$resolutionTrx);

                $fileName       =   $this->video_model->get_trailer_file_name($id);

                if(count($unlinkArray) > 0){
                    foreach($unlinkArray as $unlinkData){
                        $uncheckTrailer =   ['video_id' => $id, 'trailer_video_resize' => $unlinkData];
                        $deleteTrailer  =   $fileName.'-'.$unlinkData.'.mp4';
                        @unlink($videopath.'/'.$deleteTrailer);
                        $this->video_model->delete_uncheck_video($uncheckTrailer);
                    }
                }
            }
            //upload new trailer of another version which was left over
            if($_FILES['trailer_video']['name']){
                //Trailer Video         
                $file_name_tr 		= 	$_FILES['trailer_video']['name'];
                $file_size_tr 		=	$_FILES['trailer_video']['size'];
                $file_tmp_tr 		=	$_FILES['trailer_video']['tmp_name'];
                $file_type_tr		=	$_FILES['trailer_video']['type'];
                $file_arr_tr		=	explode('.',$_FILES['trailer_video']['name']);
                $file_ext_tr		=	strtolower(end($file_arr_tr));
                $file_ext_tr		=	"mp4";
                $file_out_ext_tr 	= 	$this->video_model->get_trailer_file_name($id);
                // $file_out_ext_tr 	= 	str_replace(' ','-',$file_arr_tr[0]);

                // $file_out_ext_tr    =   $file_out_ext_tr.'-trailer';

                //Get existing trailer info from DB
                $dbTrVideoResolution    =   $this->video_model->editVideoResolution($id);
                $exsitingTrResolution   =   [];
                $trInc                  =   0;
                foreach($dbTrVideoResolution as $dbTrResolution){
                    if($dbTrResolution->trailer_video_resize){
                        $exsitingTrResolution[$trInc]     =   $dbTrResolution->trailer_video_resize;
                        $trInc++;
                    }
                }
                $resolutionTrx 	    = 	$this->input->post('trailer_resolution', TRUE);
                $resolutionTr       =   array_merge(array_diff($exsitingTrResolution,$resolutionTrx), array_diff($resolutionTrx, $exsitingTrResolution));
                
                foreach($resolutionTr as $resovalue_tr){
                    $commandTr    =   "/usr/bin/ffmpeg -y -i $file_tmp_tr -s $resovalue_tr  -strict -2 $videopath/$file_out_ext_tr-$resovalue_tr.$file_ext_tr";
                    //echo $command;
                    system($commandTr);
                }
                $data['trailer_video']          =   $file_out_ext_tr;

                if(count($resolutionTr) > 0 && $id != 0){
                    $resolution_trailer   =   [];
                    foreach($resolutionTr as $trailer){
                        $resolution_trailer['video_id']                 =       $id;
                        $resolution_trailer['trailer_video_resize']     =       $trailer;
                        $resolution_trailer['main_video_resize']        =       0;
                        $insertResolutionTrailer    =   $this->video_model->insert_resolution($resolution_trailer);
                    }
                }
            }
            //delete the main video if any of checkbox is unchecked without uploading the video
            if(!$_FILES['main_video']['name'] && $this->input->post('is_series', TRUE) == 0){
                $dbVideoResolution      =   $this->video_model->editVideoResolution($id);
                $resolutionVr           = 	$this->input->post('video_resolution', TRUE);
                $exsitingResolution     =   [];
                $nInc                  =   0;
                foreach($dbVideoResolution as $dbResolution){
                    if($dbResolution->main_video_resize){
                        $exsitingResolution[$nInc]     =   $dbResolution->main_video_resize;
                        $nInc++;
                    }
                }

                $unlinkVarray    =   array_diff($exsitingResolution,$resolutionVr);

                $fileVidName       =   $this->video_model->get_video_file_name($id);

                if(count($unlinkVarray) > 0){
                    foreach($unlinkVarray as $unlinkDataVid){
                        $uncheckVideo =   ['video_id' => $id, 'main_video_resize' => $unlinkDataVid];
                        $deleteVideo  =   $fileVidName.'-'.$unlinkDataVid.'.mp4';
                        @unlink($videopath.'/'.$deleteVideo);
                        $this->video_model->delete_uncheck_video($uncheckVideo);
                    }
                }
            }
            //upload new video of another version which was left over
            if($_FILES['main_video']['name']){
                //Main Video
                $file_name 		= 	$_FILES['main_video']['name'];
                $file_size 		=	$_FILES['main_video']['size'];
                $file_tmp 		=	$_FILES['main_video']['tmp_name'];
                $file_type		=	$_FILES['main_video']['type'];
                $file_arr		=	explode('.',$_FILES['main_video']['name']);
                $file_ext		=	strtolower(end($file_arr));
                $file_ext		=	"mp4";
                $file_out_ext 	= 	$this->video_model->get_video_file_name($id);
                //$file_out_ext 	= 	str_replace(' ','-',$file_arr[0]);

                //Get existing video info from DB
                $dbVideoResolution    =   $this->video_model->editVideoResolution($id);
                $exsitingResolution   =   [];
                $inc                  =   0;
                foreach($dbVideoResolution as $dbResolution){
                    if($dbResolution->main_video_resize){
                        $exsitingResolution[$inc]     =   $dbResolution->main_video_resize;
                        $inc++;
                    }
                }

                $resolutionV     = 	$this->input->post('video_resolution', TRUE);
                $resolution     = 	array_merge(array_diff($exsitingResolution,$resolutionV), array_diff($resolutionV, $exsitingResolution));

                foreach($resolution as $resovalue){
                    $command    =   "/usr/bin/ffmpeg -y -i $file_tmp -s $resovalue  -strict -2 $videopath/$file_out_ext-$resovalue.$file_ext";
                    system($command);
                }
                $data['main_video']             =   $file_out_ext;

                if(count($resolution) > 0 && $id != 0){
                    $resolution_video   =   [];
                    foreach($resolution as $video){
                        $resolution_video['video_id']                 =       $id;
                        $resolution_video['trailer_video_resize']     =       0;
                        $resolution_video['main_video_resize']        =       $video;
                        $insertResolutionVideo      =   $this->video_model->insert_resolution($resolution_video);
                    }
                }
            }
            
            $this->load->library('image_lib');
            
            $config['upload_path']       =   './uploads/videos/'.$video_dir_Name.'/';
            $config['allowed_types']     =   'gif|jpg|png';
            //upload new poster image & unlink the old one
            if($_FILES["video_poster_image"]["name"]){
                $config["file_name"]    =   time().'-'.$_FILES["video_poster_image"]['name'];
                $this->load->library('upload', $config);
                $posterImage    =   $this->upload->do_upload('video_poster_image');
                $image_data     =   $this->upload->data();
                // Resize image to the given format
                $imageResize    =   [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  1380,
                                    'height'          =>  768,
                                ];
                
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
                $oldPosterImage     =   $this->input->post('old_video_poster', TRUE);
                @unlink($videopath.'/'.$oldPosterImage);                
            }
            //upload new mobile poster image & unlink the old one
            if($_FILES["mobile_poster_image"]["name"]){
                $config["file_name"]    =   time().'-'.$_FILES["mobile_poster_image"]['name'];
                /*$this->load->library('upload', $config);
                $posterImage    =   $this->upload->do_upload('mobile_poster_image');
                $image_data     =   $this->upload->data();*/
                if($_FILES["mobile_poster_image"]["name"] && $_FILES["video_poster_image"]["name"]){
                    $this->upload->initialize($config);
                    $posterImage    =   $this->upload->do_upload('mobile_poster_image');
                    $image_data     =   $this->upload->data();
                }
                else if($_FILES["mobile_poster_image"]["name"]){
                    $this->load->library('upload', $config);
                    $posterImage    =   $this->upload->do_upload('mobile_poster_image');
                    $image_data     =   $this->upload->data();
                }                
                else{
                    $this->loadl->library('upload', $config);
                    $mobilePoster   =   $this->upload->do_upload('mobile_poster_image');
                    $image_data     =   $this->upload->data();
                }
                
                // Resize image to the given format
                $imageResize =  [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  220,
                                    'height'          =>  320,
                                ];
                
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
                $oldMobileImage     =   $this->input->post('old_mobile_poster', TRUE);
                @unlink($videopath.'/'.$oldMobileImage);
            }

            $data                           =   [];
            $videoId                        =   $id;

            $data['video_title']            =   $this->input->post('video_title', TRUE);
            $data['user_age']               =   $this->input->post('user_age', TRUE);
            $data['trailer_duration']       =   $this->input->post('trailer_duration', TRUE);
            $data['video_duration']         =   $this->input->post('video_duration', TRUE);
            $data['ratings']                =   $this->input->post('ratings', TRUE);
            $data['publish_time']           =   $this->input->post('publish_time', TRUE);
            $data['short_info']             =   $this->input->post('short_info', TRUE);
            $data['description']            =   $this->input->post('description', TRUE);

            if($_FILES["video_poster_image"]["name"]){
                $data['video_poster_image']     =	time().'-'.$_FILES["video_poster_image"]['name'];
            }
            if($_FILES["mobile_poster_image"]["name"]){
                $data['mobile_poster_image']    =	time().'-'.$_FILES["mobile_poster_image"]['name'];
            }
            
            $data['is_series']              =   $this->input->post('is_series', TRUE);
            $data['is_banner']              =   $this->input->post('is_banner', TRUE);
            $data['status']                 =   $this->input->post('publish_time', TRUE);

            $cast_crew                      =   $this->input->post('castcrew', TRUE);
            $videotags                      =   $this->input->post('videotags', TRUE);
            $categories                     =   $this->input->post('category', TRUE);

            $updateVidId                    =   $this->video_model->update_video($videoId,$data);

            if(count($cast_crew) > 0 && $videoId != 0){
                $castCrew   =   [];
                $this->video_model->delete_cast_crew($videoId);
                foreach($cast_crew as $crew){
                    $castCrew['video_id']       =       $videoId;
                    $castCrew['cast_crews_id']  =       $crew;
                    $updateCnC   =   $this->video_model->insertcast_crew($castCrew);
                }
            }

            if(count($videotags) > 0 && $videoId != 0){
                $video_tags   =   [];
                $this->video_model->delete_video_tag($videoId);
                foreach($videotags as $tag){
                    $video_tags['video_id']     =       $videoId;
                    $video_tags['tag_id']       =       $tag;
                    $insertTags   =   $this->video_model->insert_video_tag($video_tags);
                }
            }

            if(count($categories) > 0 && $videoId != 0){
                $category   =   [];
                $this->video_model->delete_category_video($videoId);
                foreach($categories as $categoryx){
                    $category['video_id']       =       $videoId;
                    $category['category_id']    =       $categoryx;
                    $insertCategory   =   $this->video_model->insert_category_video($category);
                }
            }                        

            if($videoId > 0 && $cast_crew > 0 && $videotags > 0){
                $this->session->set_flashdata('success', 'Video added Successfully');
                //return redirect('domestic/addpackage');
                echo redirectPreviousPage();
                exit;
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                //return redirect('domestic/addpackage');
                echo redirectPreviousPage();
                exit;
            }
        }
    }

    public function deletevideo($id)
    {
        $getDirectoryPath   =   $this->video_model->get_video_directory($id);

        $deleteVideo        =   $this->video_model->delete_video($id);
        
        if(!empty($getDirectoryPath)){
            $deleteFile     =   './uploads/videos/'.$getDirectoryPath;
            delete_files($deleteFile);
            rmdir($deleteFile);
        }            
        
        if($deleteVideo == 1){
            $this->session->set_flashdata('success', 'Video deleted successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	public function deleteseriesvideo($id)
    {
		$video_arr   =   $this->video_model->getVideoIdBySeriesId($id);
		$video_id = $video_arr[0]->video_id;
		$fileName = $video_arr[0]->series_video_name;
        $getDirectoryPath   =   $this->video_model->get_video_directory($video_id);
		$dbTrVideoResolution    =   $this->video_model->getSeriesVideoResolution($video_id,$id);
		$videopath          =       '/home/solutio9/public_html/dev/ottdev/uploads/videos/'.$getDirectoryPath;
		if(count($dbTrVideoResolution) > 0){
			foreach($dbTrVideoResolution as $unlinkData){
				$deleteseries  =   $fileName.'-'.$unlinkData->main_video_resize.'.mp4';
				if (file_exists($videopath.'/'.$deleteseries)) {
					@unlink($videopath.'/'.$deleteseries);
				}
			}
		}
        $deleteVideo        =   $this->video_model->delete_video_series($id);
        if($deleteVideo == 1){
            $this->session->set_flashdata('success', 'Video Series deleted successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	/*********************** ADD SERIES VIDEO ***********************/
	public function addseriesvideo($id)
    {
		$page = 'add-series-video';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/video/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                   =   [];
                $data['videoSeriesList']     =   $this->video_model->getVideoSeriesList($id);
                $data['title']          =   ucfirst($page);                
                $this->load->view('admin/video/' . $page, $data);
            }
        }
    }
	
	public function insertseriesvideo()
    {
		$page = 'add-series-video';
		$video_id = $this->uri->segment(3);
	 	$series_id = $this->uri->segment(4);
	 	$data = array();
		if($this->input->post()){
			$this->form_validation->set_rules('episode_name', 'Episode Name', 'trim|required');
			$this->form_validation->set_rules('episode_no', 'Episode No', 'required');
			//$this->form_validation->set_rules('series_resolution', 'Series Resolution', 'required');
			//$this->form_validation->set_rules('series_video_name', 'Series file', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('error', validation_errors());
				// return redirect('categories/addcategories');
				echo redirectPreviousPage();
			}
			else
			{
				if($series_id > 0){
					$data               =       [];
					$videopath          =       '/home/solutio9/public_html/dev/ottdev/uploads/videos/';
		
					$video_dir_Name     =       $this->video_model->get_video_directory($video_id);
					$videopath          =       $videopath.$video_dir_Name;
					
					//delete the series if any of checkbox is unchecked without uploading the video
					if(!$_FILES['series_video_name']['name']){ 
						$dbTrVideoResolution    =   $this->video_model->getSeriesVideoResolution($video_id,$series_id);
						$resolutionTrx 	        = 	$this->input->post('series_resolution', TRUE);
						$exsitingTrResolution   =   [];
						$trInc                  =   0;
						foreach($dbTrVideoResolution as $dbTrResolution){
							if($dbTrResolution->main_video_resize){
								$exsitingTrResolution[$trInc]     =   $dbTrResolution->main_video_resize;
								$trInc++;
							}
						}
		
						$unlinkArray    =   array_diff($exsitingTrResolution,$resolutionTrx);
						//print_r($unlinkArray);
						$fileName       =   $this->video_model->get_series_video_file_name($series_id);
						//echo $fileName; die;
						if(count($unlinkArray) > 0){
							foreach($unlinkArray as $unlinkData){
								$uncheckTrailer =   ['video_id' => $video_id, 'series_id' => $series_id, 'main_video_resize' => $unlinkData];
								$deleteTrailer  =   $fileName.'-'.$unlinkData.'.mp4';
								@unlink($videopath.'/'.$deleteTrailer);
								$this->video_model->delete_uncheck_video($uncheckTrailer);
							}
						}
					}
					//upload new trailer of another version which was left over
					if($_FILES['series_video_name']['name']){
						//Trailer Video         
						$file_name_tr 		= 	$_FILES['series_video_name']['name'];
						$file_size_tr 		=	$_FILES['series_video_name']['size'];
						$file_tmp_tr 		=	$_FILES['series_video_name']['tmp_name'];
						$file_type_tr		=	$_FILES['series_video_name']['type'];
						$file_arr_tr		=	explode('.',$_FILES['series_video_name']['name']);
						$file_ext_tr		=	strtolower(end($file_arr_tr));
						$file_ext_tr		=	"mp4";
						$file_out_ext_tr 	= 	$this->video_model->get_series_video_file_name($series_id);
						// $file_out_ext_tr 	= 	str_replace(' ','-',$file_arr_tr[0]);
		
						// $file_out_ext_tr    =   $file_out_ext_tr.'-trailer';
		
						//Get existing trailer info from DB
						$dbTrVideoResolution    =   $this->video_model->getSeriesVideoResolution($video_id,$series_id);
						$exsitingTrResolution   =   [];
						$trInc                  =   0;
						foreach($dbTrVideoResolution as $dbTrResolution){
							if($dbTrResolution->main_video_resize){
								$exsitingTrResolution[$trInc]     =   $dbTrResolution->main_video_resize;
								$trInc++;
							}
						}
						$resolutionTrx 	    = 	$this->input->post('series_resolution', TRUE);
						$resolutionTr       =   array_merge(array_diff($exsitingTrResolution,$resolutionTrx), array_diff($resolutionTrx, $exsitingTrResolution));
						
						foreach($resolutionTr as $resovalue_tr){
							$commandTr    =   "/usr/bin/ffmpeg -y -i $file_tmp_tr -s $resovalue_tr  -strict -2 $videopath/$file_out_ext_tr-$resovalue_tr.$file_ext_tr";
							//echo $command;
							system($commandTr);
						}
						$data['series_video_name']          =   $file_out_ext_tr;
		
						if(count($resolutionTr) > 0 && $series_id != 0){
							$resolution_trailer   =   [];
							foreach($resolutionTr as $trailer){
								$resolution_trailer['video_id']                 =       $video_id;
								$resolution_trailer['series_id']                =       $series_id;
								$resolution_trailer['trailer_video_resize']     =       0;
								$resolution_trailer['main_video_resize']        =       $trailer;
								$insertResolutionTrailer    =   $this->video_model->insert_resolution($resolution_trailer);
							}
						}
					}
					
					$data['episode_name']        =   $this->input->post('episode_name', TRUE);
					$data['episode_no']       	 =   $this->input->post('episode_no', TRUE);
					
					//$updateseries                 =   $this->video_model->update_series_video($video_id,$series_id,$data);
					if($this->video_model->update_series_video($video_id,$series_id,$data)){
						$this->session->set_flashdata('success', 'Video Updated Successfully');
						//return redirect('domestic/addpackage');
						echo redirectPreviousPage();
						exit;
					}
					else{
						$this->session->set_flashdata('error', 'Something went wrong');
						//return redirect('domestic/addpackage');
						echo redirectPreviousPage();
						exit;
					}
					
				} else {
					//Series Video         
					$file_name_ser 		= 	$_FILES['series_video_name']['name'];
					$file_size_ser 		=	$_FILES['series_video_name']['size'];
					$file_tmp_ser 		=	$_FILES['series_video_name']['tmp_name'];
					$file_type_ser		=	$_FILES['series_video_name']['type'];
					$file_arr_ser		=	explode('.',$_FILES['series_video_name']['name']);
					$file_ext_ser		=	strtolower(end($file_arr_ser));
					$file_ext_ser		=	"mp4";
					$file_out_ext_ser 	= 	str_replace(' ','-',$file_arr_ser[0]);
		
					$resolutionSer 	    = 	$this->input->post('series_resolution', TRUE);
					
					//directory path
					$videopath          =   '/home/solutio9/public_html/dev/ottdev/uploads/videos/';            
		
					//$video_dir_Name     =   strtolower($file_out_ext_tr);
					$video_dir_Name   =   $this->video_model->get_video_directory($this->input->post('video_id'));
		
					if(!is_dir('./uploads/videos/'.$video_dir_Name)){
						mkdir('./uploads/videos/'.$video_dir_Name);
					}
					
					$videopath  =   $videopath.$video_dir_Name;
		
					foreach($resolutionSer as $resovalue_sr){
						$commandSr    =   "/usr/bin/ffmpeg -y -i $file_tmp_ser -s $resovalue_sr  -strict -2 $videopath/$file_out_ext_ser-$resovalue_sr.$file_ext_ser";
						//echo $command;
						system($commandSr);
					}
					
					$data                        =   [];
					
					$data['video_id']            =   $this->input->post('video_id', TRUE);
					$data['episode_name']        =   $this->input->post('episode_name', TRUE);
					$data['episode_no']       	 =   $this->input->post('episode_no', TRUE);
					$data['series_video_name']   =   $file_out_ext_ser;
					
					$videoId		  =   $this->input->post('video_id', TRUE);
					$SeriesvideoId    =   $this->video_model->insert_series_video($data);
					
					if(count($resolutionSer) > 0 && $SeriesvideoId != 0){
						$resolution_series   =   [];
						foreach($resolutionSer as $series){
							$resolution_series['video_id']                 =       $videoId;
							$resolution_series['series_id']                =       $SeriesvideoId;
							$resolution_series['trailer_video_resize']     =       0;
							$resolution_series['main_video_resize']        =       $series;
							$insertResolutionSeries    =   $this->video_model->insert_resolution($resolution_series);
						}
					}
					
					if($SeriesvideoId > 0){
						$this->session->set_flashdata('success', 'Video added Successfully');
						//return redirect('domestic/addpackage');
						echo redirectPreviousPage();
						exit;
					}
					else{
						$this->session->set_flashdata('error', 'Something went wrong');
						//return redirect('domestic/addpackage');
						echo redirectPreviousPage();
						exit;
					} 
				}
			}
		}
		
		if($series_id > 0){
			$data['series_details'] 	 = 	 $this->video_model->video_series_details_by_id($series_id);
			$data['videoSeriesList']     =   $this->video_model->getVideoSeriesList($video_id);
			$data['editVidResolution']  =   $this->video_model->getSeriesVideoResolution($video_id,$series_id);
		}
		
		$this->load->view('admin/video/' . $page, $data);
	}
	
	
	
}