<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

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
        $this->load->library(array('form_validation','encryption','session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('news_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   Subscription Functions   ********************************************/
    
    public function index($page = 'list-news')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/news/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['NewsList']   =   $this->news_model->getNewsList();
                $data['title']          =   ucfirst($page);
                $this->load->view('admin/news/' . $page, $data);
            }
        }
    }

    public function addnews($page = 'add-news')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/news/' . $page . '.php'))
            {
                show_404();
            }
            else{
                if(!$this->session->userdata('logged_in'))
                {
                    return redirect('admin/login');
                }
                else{
                    $data['title']          =   ucfirst($page);
					$data['categoryList']     =   $this->news_model->getNewsCategoriesList();
                    $this->load->view('admin/news/' . $page, $data);
                }
            }
        }
    }
    
    public function insertnews()
    {
        $this->form_validation->set_rules('name', 'News  Name', 'trim|required');
        $this->form_validation->set_rules('description', 'News Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('castcrew/addcastcrew');
            echo redirectPreviousPage();
            exit;
        }
        else
        {
            $data   =   array();
            $data['name']           =   $this->input->post('name', TRUE);
            $data['slug']           =   strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $this->input->post('name')));
			$data['category_id']    =   $this->input->post('category_id', TRUE);
			$data['status']         =   $this->input->post('status', TRUE);
            $data['description']    =   $this->input->post('description', TRUE);
            $data['image']       	=	time().'-'.$_FILES["image"]['name'];
			$data['add_date']       =	date('Y-m-d h:i:sa');

            if(!is_dir('./uploads/news_image'))
            mkdir('./uploads/news_image');
            
            $this->load->library('image_lib');
            
            $config['upload_path']       =   './uploads/news_image/';
            $config['allowed_types']     =   'gif|jpg|png';
            $config['file_name']         =    $data['image'];

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());

                $this->session->set_flashdata('error', 'Image format not supported');
                echo redirectPreviousPage();
                exit;
            }
            else{
                
                $image_data = $this->upload->data();
                // Resize image to the given format
                $imageResize =  [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  350,
                                    'height'          =>  250,
                                ];
                
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
                
                $insertnews   =   $this->news_model->insertnews($data);

                if($insertnews > 0){
                    $this->session->set_flashdata('success', 'News added Successfully.');
					redirect('admin/news-list');
                    exit;
                }
                else{
                    $this->session->set_flashdata('error', 'News cannot added!!');
					redirect('admin/news-list');
                    exit;
                }
            }

        }
    }    
    
    public function editnews($id)
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {//echo $id;
			$data['categoryList']     =   $this->news_model->getNewsCategoriesList();
			$data['editNews']   =   $this->news_model->editNews($id);
			$this->load->view('admin/news/edit-news', $data);
		}
    }
    
    public function updatenews($id)
    {
        $this->form_validation->set_rules('name', 'News Name', 'trim|required');
        $this->form_validation->set_rules('description', 'News Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/edit-news/'.$id);
        }
        else
        {
            //$data               =   $_POST;
            $data   =   [];
			$data['name']           =   $this->input->post('name', TRUE);
            //$data['slug']           =   strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $this->input->post('name')));
			$data['category_id']    =   $this->input->post('category_id', TRUE);
			$data['status']         =   $this->input->post('status', TRUE);
            $data['description']    =   $this->input->post('description', TRUE);

            /****************************** Single Image Upload ******************************/
            
            if(!empty($_FILES["image"]['name'])){
                $data['image']       =      time().'-'.$_FILES["image"]['name'];
                
                $getImageName   =   $this->news_model->getReplacedSingleImgName($id);
                if(!empty($getImageName)){
                    $deleteFile     =   './uploads/news_image/'.$getImageName;
                    if(is_readable($deleteFile) && unlink($deleteFile)){
                        //echo "The file has been deleted";
                    }
                }
                
                $this->load->library('image_lib');
            
                $config['upload_path']       =   './uploads/news_image/';
                $config['allowed_types']     =   'gif|jpg|png';
                $config['file_name']         =    $data['image'];
                
                $this->load->library('upload', $config);
                $this->upload->do_upload('image');
                $image_data = $this->upload->data();
                
                // Resize image to the given format
                $imageResize =  [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  350,
                                    'height'          =>  250,
                                ];

                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
            }
            
            /****************************** Single Image Upload ******************************/

            $updateNews     =   $this->news_model->updateNews($id, $data);

            if($updateNews == 1){
                $this->session->set_flashdata('success', 'News updated successfully');
                return redirect('admin/edit-news/'.$id);
            }
            else{
                $this->session->set_flashdata('error', 'News cannot updated!!');
                return redirect('admin/edit-news/'.$id);
            }
        }
    }

    public function deleteNews($id)
    {   
        $getImageName           =   $this->news_model->getReplacedSingleImgName($id);
        
        if(!empty($getImageName)){
            $deleteFile     =   './uploads/news_image/'.$getImageName;            
            unlink($deleteFile);
        }
        
        $deleteNews   =   $this->news_model->deleteNews($id);
        
        if($deleteNews == 1){
            $this->session->set_flashdata('success', 'News deleted successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'News cannot deleted!!');
            echo redirectPreviousPage();
            exit;
        }
    }
    
    /********************************************   Subscription Functions   ********************************************/

}