<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

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
        $this->load->library(array('form_validation','encryption', 'session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('banner_model');
		$this->load->model('category_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   document Functions   ********************************************/
	public function index($page = 'list-banner')
    {
		if (!get_permission('BANNERLIST', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/banner/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['bannerList']  =   $this->banner_model->getBannerList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/banner/' . $page, $data);
            }
        }
    }
	
	
    public function addbanner($page = 'add-banner')
    {
		if (!get_permission('ADDBANNER', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/banner/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$this->load->view('admin/banner/' . $page, $data);
			}
		}
    }
	
	public function insertbanner()
    {
        /*$this->form_validation->set_rules('name', 'Document Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Document description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {*/
            /*$data   =   $_POST;
			$checkAvailablity       =   $this->document_model->checkExistDocument($_POST['name']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Document Already exists!');
                echo redirectPreviousPage();
                exit;
            }*/
			
			$config['upload_path']       =   './uploads/banner/';
            $config['allowed_types']     =   'gif|jpg|png';
            
            if($_FILES["banner_image"]["name"]){
                $config["file_name"]    =   time().'-'.$_FILES["banner_image"]['name'];
                $this->load->library('upload', $config);
                $posterImage    =   $this->upload->do_upload('banner_image');
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
				$this->image_lib->clear();

				
				/* Second size */    
				 $configSize2['image_library']   = 'gd2';
				 $configSize2['source_image']    = $image_data['full_path'];
				 $configSize2['create_thumb']    = FALSE;
				 $configSize2['maintain_ratio']  = TRUE;
				 $configSize2['width']           = 220;
				 $configSize2['height']          = 320;
				 $configSize2['new_image']   = './uploads/banner/mobile/'.time().'-'.$_FILES["banner_image"]['name'];
				
				 $this->image_lib->initialize($configSize2);
				 $this->image_lib->resize();
				 $this->image_lib->clear();
            }
			
			$data['image']     =	time().'-'.$_FILES["banner_image"]['name'];
			$data['heading']     =	$this->input->post('heading');
			$data['heading2']     =	$this->input->post('heading2');
			$data['heading3']     =	$this->input->post('heading3');
			$data['sub_heading']     =	$this->input->post('sub_heading');
			//print_r($data); die;
            $insertBanner   =   $this->banner_model->addNewbanner($data);

            if($insertBanner > 0){
                $this->session->set_flashdata('success', 'Banner Successfully Added');
                //echo redirectPreviousPage();
				redirect('admin/banner-list');
            }
            else{
                $this->session->set_flashdata('error', 'Banner cannot added!!');
                echo redirectPreviousPage();
            }
        //}
    }
	
    

    
    
       
    
    public function editbanner($id)
    {
        //echo $id;
        $data['editDocument']   =   $this->banner_model->getBannerDetails($id);
        $this->load->view('admin/banner/edit-banner', $data);
    }
    
    public function updateBanner($id)
    {
        $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
        // $this->form_validation->set_rules('heading2', 'Heading 2', 'required');
        // $this->form_validation->set_rules('heading3', 'Heading 3', 'required');
        $this->form_validation->set_rules('sub_heading', 'Sub Heading', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editbanner/'.$id);
        }
        else
        {
			
            if($_FILES["banner_image"]["name"]){
                $config['upload_path']       =   './uploads/banner/';
                $config['allowed_types']     =   'gif|jpg|png';
                $config["file_name"] = $fileName   =   time().'-'.$_FILES["banner_image"]['name'];
                $this->load->library('upload', $config);
                $posterImage    =   $this->upload->do_upload('banner_image');
                $image_data     =   $this->upload->data();
                
                // Resize image to the given format
                $imageResize    =   [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  FALSE,
                                    'width'           =>  1380,
                                    'height'          =>  538,
                                ];
                
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
                $this->image_lib->clear();

                
                /* Second size */    
                 $configSize2['image_library']   = 'gd2';
                 $configSize2['source_image']    = $image_data['full_path'];
                 $configSize2['create_thumb']    = FALSE;
                 $configSize2['maintain_ratio']  = TRUE;
                 $configSize2['width']           = 220;
                 $configSize2['height']          = 320;
                 $configSize2['new_image']   = './uploads/banner/mobile/'.time().'-'.$_FILES["banner_image"]['name'];
                
                 $this->image_lib->initialize($configSize2);
                 $this->image_lib->resize();
                 $this->image_lib->clear();

                 $data['image']     =   $fileName;
            }
            $data['heading']     =	$this->input->post('heading');
			$data['heading2']     =	$this->input->post('heading2');
			$data['heading3']     =	$this->input->post('heading3');
			$data['sub_heading']     =	$this->input->post('sub_heading');
			
            $updateBanner     		=       $this->banner_model->updateBanner($id, $data);

            if($updateBanner == 1){
                $this->session->set_flashdata('success', 'Banner updated successfully');
                return redirect('admin/editbanner/'.$id);
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                return redirect('admin/editbanner/'.$id);
            }
        }
    }

    public function deleteBanner($id)
    {   
        
        $deleteBanner   =   $this->banner_model->deleteBanner($id);
        $getBannerDetails   =   $this->banner_model->getBannerDetails($id);
        if($deleteBanner == 1){
			$deleteFile     =   '/uploads/banner/';
			@unlink($deleteFile.$getBannerDetails[0]->image);
			@unlink($deleteFile.'mobile/'.$getBannerDetails[0]->image);
            $this->session->set_flashdata('success', 'Banner Image deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
    
    /********************************************   Subscription Functions   ********************************************/

}