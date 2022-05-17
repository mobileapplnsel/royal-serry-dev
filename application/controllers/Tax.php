<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {

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
        $this->load->model('tax_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   document Functions   ********************************************/
	public function index($page = 'list-tax')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/tax/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['taxList']  =   $this->tax_model->getTaxList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/tax/' . $page, $data);
            }
        }
    }
	
	
    /*public function adddocument($page = 'add-document')
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/document/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$data['categoryList']     =   $this->category_model->getCategoriesList();
				$this->load->view('admin/document/' . $page, $data);
			}
		}
    }
	
	public function insertdocument()
    {
        $this->form_validation->set_rules('name', 'Document Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Document description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;
			$checkAvailablity       =   $this->document_model->checkExistDocument($_POST['name']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Document Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			//print_r($data); die;
            $insertDocument   =   $this->document_model->addNewdocument($data);

            if($insertDocument > 0){
                $this->session->set_flashdata('success', 'Document Successfully Added');
                echo redirectPreviousPage();
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                echo redirectPreviousPage();
            }
        }
    }*/
	
    

    
    
       
    
    public function edittax($id)
    {
        //echo $id;
        $data['editTax']   =   $this->tax_model->editTax($id);
        $this->load->view('admin/tax/edit-tax', $data);
    }
    
    public function updateTax($id)
    {
        $this->form_validation->set_rules('name', 'Tax Name', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/edittax/'.$id);
        }
        else
        {
            $data                   =       $_POST;
			
            $updatetax     		=       $this->tax_model->updateTax($id, $data);

            if($updatetax == 1){
                $this->session->set_flashdata('success', 'Tax updated successfully');
                return redirect('admin/edittax/'.$id);
            }
            else{
                $this->session->set_flashdata('error', 'Nothing to update!!');
                return redirect('admin/edittax/'.$id);
            }
        }
    }

    public function deleteTax($id)
    {   
        
        $deleteTax   =   $this->tax_model->deleteTax($id);
        
        if($deleteTax == 1){
            $this->session->set_flashdata('success', 'Tax deleted successfully');
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