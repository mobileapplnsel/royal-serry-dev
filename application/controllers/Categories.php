<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

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
        $this->load->model('category_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   Categories Functions   ********************************************/

    public function index($page = 'list-categories')
    {
		if (!get_permission('CATEGORYLIST', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/categories/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['categoriesList']     =   $this->category_model->getCategoriesList();
                $data['title']              =   ucfirst($page);
                /*echo '<pre>';
                print_r($data);
                die();*/
                $this->load->view('admin/categories/' . $page, $data);
            }
        }
    }

    public function addcategory($page = 'add-category')
    {
		if (!get_permission('ADDCATEGORY', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/categories/' . $page . '.php'))
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
                    $data['parentCategory']     =   $this->category_model->getParentCategory($id);
					$data['ShippingCatList']     =   $this->category_model->getShippingCatList();
                    $data['title']              =   ucfirst($page);
                    $this->load->view('admin/categories/' . $page, $data);
                }
            }
        }
    }

    public function insertcategory()
    {
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('category_description', 'Category Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            // return redirect('categories/addcategories');
            echo redirectPreviousPage();
        }
        else
        {
            $data                           =   [];
            if($this->input->post('parent_cat_id', TRUE)){
                $data['parent_cat_id']      =   $this->input->post('parent_cat_id', TRUE);
            }
            $data['category_name']          =   $this->input->post('category_name', TRUE);
			$data['category_slug']          =   strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $this->input->post('category_name')));
            $data['status']                 =   $this->input->post('status', TRUE);
            $data['category_description']   =   $this->input->post('category_description', TRUE);
			$data['type']   				=   $this->input->post('type', TRUE);

                
			$duplicateCheck   =   $this->category_model->category_duplicate_check_by_name($this->input->post('category_name'));
			if($duplicateCheck > 0){
				$this->session->set_flashdata('error', 'Category name already exist!');
				echo redirectPreviousPage();
				exit;
			} else {
				$insertCategory   =   $this->category_model->insertcategory($data);

				if($insertCategory > 0){
					$this->session->set_flashdata('success', 'Category added Successfully');
					//echo redirectPreviousPage();
					redirect('admin/categories-list');
					exit;
				}
				else{
					$this->session->set_flashdata('error', 'Something went wrong');
					//echo redirectPreviousPage();
					redirect('admin/categories-list');
					exit;
				}
			}
        }
    }

    public function editcategory($id)
    {
		if (!get_permission('ADDCATEGORY', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        $data['parentCategory']     =   $this->category_model->getParentCategory($id);
        $data['editCategory']       =   $this->category_model->editCategory($id);
		$data['ShippingCatList']     =   $this->category_model->getShippingCatList();
        /*print_r($data);
        die();*/
        $this->load->view('admin/categories/edit-category', $data);
    }
    
    public function updatecategory($id)
    {
		
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('category_description', 'Category Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editcategory/'.$id);
        }
        else
        {
            $data                           =   [];
            $data['parent_cat_id']          =   $this->input->post('parent_cat_id', TRUE);
            //$data['is_series']              =   $this->input->post('is_series', TRUE);
            $data['category_name']          =   $this->input->post('category_name', TRUE);
			$data['category_slug']          =   strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $this->input->post('category_name')));
            $data['status']                 =   $this->input->post('status', TRUE);
            $data['category_description']   =   $this->input->post('category_description', TRUE);
			$data['type']   				=   $this->input->post('type', TRUE);

            /****************************** Single Image Upload ******************************/
            
            
            
            /****************************** Single Image Upload ******************************/
			$duplicateCheck   =   $this->category_model->category_duplicate_check_by_name_and_id($this->input->post('category_name'), $id);
			if($duplicateCheck > 0){
				$this->session->set_flashdata('error', 'Category name already exist!');
				//echo redirectPreviousPage();
				redirect('admin/categories-list');
				exit;
			} else {
				$updateCategory     =   $this->category_model->updateCategory($id, $data);
	
				if($updateCategory == 1){
					$this->session->set_flashdata('success', 'Category updated successfully');
					//return redirect('admin/editcategory/'.$id);
					redirect('admin/categories-list');
				}
				else{
					$this->session->set_flashdata('error', 'Nothing to update!!');
					//return redirect('admin/editcategory/'.$id);
					redirect('admin/categories-list');
				}
			}
        }
    }

    public function deletecategory($id)
    {   
        $checkParentCat         =   $this->category_model->is_parent_category($id);
        if($checkParentCat){
            $this->session->set_flashdata('error', 'This a Parent Category!!! Please ensure you have untag from its sub categories.');
            echo redirectPreviousPage();
            exit;
        }
        else{
            /*$getImageName           =   $this->category_model->getReplacedSingleImgName($id);
            
            if(!empty($getImageName)){
                $deleteFile     =   './uploads/category/'.$getImageName;            
                unlink($deleteFile);
            }*/
            
			$CheckCategoryDocument   =   $this->category_model->CheckCategoryDocument($id);
			$CheckCategoryPackage   =   $this->category_model->CheckCategoryPackage($id);
			
			if($CheckCategoryDocument == 1 || $CheckCategoryPackage == 1){
				$this->session->set_flashdata('error', 'Category Cannot deleted!! Because assign to other module.');
				//return redirect('admin/international/');
				echo redirectPreviousPage();
				exit;
			}
		
            $deleteCategory   =   $this->category_model->deleteCategory($id);
            
            if($deleteCategory == 1){
                $this->session->set_flashdata('success', 'Category deleted successfully');
                echo redirectPreviousPage();
                exit;
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                echo redirectPreviousPage();
                exit;
            }
        }
    }
}