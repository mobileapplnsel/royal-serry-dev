<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

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
        $this->load->model('package_model');
		$this->load->model('category_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   document Functions   ********************************************/
	public function index($page = 'list-package')
    {
		if (!get_permission('PACKAGELIST', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/package/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['packageList']  =   $this->package_model->getPackageList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/package/' . $page, $data);
            }
        }
    }
	
	
    public function addpackage($page = 'add-package')
    {
		if (!get_permission('ADDPACKAGE', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/package/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$data['categoryList']     =   $this->package_model->getpackageCategoriesList();
				$this->load->view('admin/package/' . $page, $data);
			}
		}
    }
	
	public function insertpackage()
    {
        $this->form_validation->set_rules('name', 'Package Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Package description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;
			$checkAvailablity       =   $this->package_model->checkExistPackage($_POST['name']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Package Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			//print_r($data); die;
            $insertPackage   =   $this->package_model->addNewpackage($data);

            if($insertPackage > 0){
                $this->session->set_flashdata('success', 'Package Successfully Added');
                //echo redirectPreviousPage();
				redirect('admin/package-list');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                //echo redirectPreviousPage();
				redirect('admin/package-list');
            }
        }
    }
	
    

    
    
       
    
    public function editpackage($id)
    {
		if (!get_permission('ADDPACKAGE', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        //echo $id;
        $data['editPackage']   =   $this->package_model->editPackage($id);
		$data['categoryList']     =   $this->package_model->getpackageCategoriesList();
        $this->load->view('admin/package/edit-package', $data);
    }
    
    public function updatePackage($id)
    {
        $this->form_validation->set_rules('name', 'Package Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Package description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editpackage/'.$id);
        }
        else
        {
            $data                   =       $_POST;
			
            $updatepackage     		=       $this->package_model->updatePackage($id, $data);

            if($updatepackage == 1){
                $this->session->set_flashdata('success', 'Package updated successfully');
                //return redirect('admin/editpackage/'.$id);
				redirect('admin/package-list');
            }
            else{
                $this->session->set_flashdata('error', 'Nothing to update!!');
                //return redirect('admin/editpackage/'.$id);
				redirect('admin/package-list');
            }
        }
    }

    public function deletePackage($id)
    {   
        
        $deletepackage   =   $this->package_model->deletePackage($id);
        
        if($deletepackage == 1){
            $this->session->set_flashdata('success', 'Package deleted successfully');
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