<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prohibited extends CI_Controller {

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
        $this->load->model('prohibited_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   prohibited Functions   ********************************************/
	public function index($page = 'list-prohibited')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/prohibited/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['prohibitedList']  =   $this->prohibited_model->getProhibitedList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/prohibited/' . $page, $data);
            }
        }
    }
	
	
    public function addprohibited($page = 'add-prohibited')
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/prohibited/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$data['ShippingCategoryList']   =   $this->prohibited_model->getShippingCategoriesList();
				$data['ShippingModeList']     	=   $this->prohibited_model->getShippingModeList();
				$this->load->view('admin/prohibited/' . $page, $data);
			}
		}
    }
	
	public function insertprohibited()
    {
        $this->form_validation->set_rules('name', 'prohibited Name', 'trim|required');
        $this->form_validation->set_rules('description', 'prohibited description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;
			$checkAvailablity       =   $this->prohibited_model->checkExistProhibited($_POST['name']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Item already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			//print_r($data); die;
            $insertprohibited   =   $this->prohibited_model->addNewprohibited($data);

            if($insertprohibited > 0){
                $this->session->set_flashdata('success', 'Prohibited Successfully Added');
                //echo redirectPreviousPage();
				redirect('admin/prohibited-list');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                //echo redirectPreviousPage();
				redirect('admin/prohibited-list');
            }
        }
    }
	
    

    
    
       
    
    public function editprohibited($id)
    {
        //echo $id;
        $data['editProhibited']   =   $this->prohibited_model->editProhibited($id);
		$data['ShippingCategoryList']   =   $this->prohibited_model->getShippingCategoriesList();
		$data['ShippingModeList']     	=   $this->prohibited_model->getShippingModeList();
        $this->load->view('admin/prohibited/edit-prohibited', $data);
    }
    
    public function updateProhibited($id)
    {
        $this->form_validation->set_rules('name', 'prohibited Name', 'trim|required');
        $this->form_validation->set_rules('description', 'prohibited description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editprohibited/'.$id);
        }
        else
        {
            $data                   =       $_POST;
			
            $updateprohibited     		=       $this->prohibited_model->updateProhibited($id, $data);

            if($updateprohibited == 1){
                $this->session->set_flashdata('success', 'Prohibited updated successfully');
                //return redirect('admin/editprohibited/'.$id);
				redirect('admin/prohibited-list');
            }
            else{
                $this->session->set_flashdata('error', 'Nothing to update!!');
                //return redirect('admin/editprohibited/'.$id);
				redirect('admin/prohibited-list');
            }
        }
    }

    public function deleteProhibited($id)
    {   
        
        $deleteProhibited   =   $this->prohibited_model->deleteProhibited($id);
        
        if($deleteProhibited == 1){
            $this->session->set_flashdata('success', 'Prohibited deleted successfully');
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