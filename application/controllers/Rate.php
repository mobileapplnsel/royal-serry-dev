<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller {

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
        $this->load->model('rate_model');
		$this->load->model('category_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   document Functions   ********************************************/
	public function index($page = 'list-rate')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/rate/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['rateList']  =   $this->rate_model->getRateList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/rate/' . $page, $data);
            }
        }
    }
	
	public function ratefactor($page = 'add-rate-factor')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/rate/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['rateFactorList']  =   $this->rate_model->getRateFactorList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/rate/' . $page, $data);
            }
        }
    }
	
	
    public function addrate($page = 'add-rate')
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/rate/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
				$data['ShippingCatList']     		=   $this->rate_model->getShippingCatList();
				$data['ShippingDocumentCatList']    =   $this->rate_model->getShippingDocumentCatList();
				$data['DeliveryModeList']     		=   $this->rate_model->getDeliveryModeList();
				$this->load->view('admin/rate/' . $page, $data);
			}
		}
    }
	
	public function insertrate()
    {
        $this->form_validation->set_rules('rate', 'Amount', 'trim|required');
        $this->form_validation->set_rules('miles', 'Miles', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;
			$checkAvailablity       =   $this->rate_model->checkExistRate($_POST['ship_mode_id'],$_POST['delivery_mode_id'],$_POST['ship_cat_id'],$_POST['ship_subcat_id'],$_POST['ship_sub_subcat_id'],$_POST['rate_type'],$_POST['location_from'],$_POST['location_to']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Rate Already exists!');
                //echo redirectPreviousPage();
				redirect('admin/rate-list');
                exit;
            }
			
			//print_r($data); die;
            $insertRate   =   $this->rate_model->addNewrate($data);

            if($insertRate > 0){
                $this->session->set_flashdata('success', 'Rate Successfully Added');
                //echo redirectPreviousPage();
				redirect('admin/rate-list');
            }
            else{
                $this->session->set_flashdata('error', 'Rate cannot added!!');
                //echo redirectPreviousPage();
				redirect('admin/rate-list');
            }
        }
    }
	
    /*public function getpackageCategories(){
		$ShippingPackageCatList     =   $this->rate_model->getShippingPackageCatList();
		echo $ShippingPackageCatList;
		
	}*/

     public function getdocumentCategories(){
		$type   				=   $this->input->post('type', TRUE);
		$ShippingDocumentCatList     =   $this->rate_model->getShippingDocumentCatListbyOption($type);
		echo $ShippingDocumentCatList;
		
	}
	
	public function getdocumentSubCategories(){
		$catId   						=   $this->input->post('catId', TRUE);
		$type   						=   $this->input->post('type', TRUE);
		$ShippingDocumentsubCatList     =   $this->rate_model->getShippingDocumentSubCatListbyOption($catId, $type);
		echo $ShippingDocumentsubCatList;
		
	}
    
       
    
    public function editrate($id)
    {
        //echo $id;
        $data['editRate']   =   $this->rate_model->editRate($id);
		//echo $data['editRate'][0]->ship_cat_id; die;
		$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
		$data['ShippingCatList']     		=   $this->rate_model->getShippingCatList();
		$data['DeliveryModeList']     		=   $this->rate_model->getDeliveryModeList();
		$data['ShippingDocumentCatList']    =   $this->rate_model->getShippingDocumentCatList_byId($data['editRate'][0]->ship_cat_id);
		$data['ShippingDocumentSubCatList']    =   $this->rate_model->getShippingDocumentSubCatList_byId($data['editRate'][0]->ship_subcat_id,$data['editRate'][0]->ship_cat_id);
        $this->load->view('admin/rate/edit-rate', $data);
    }
    
    public function updateRate($id)
    {
        $this->form_validation->set_rules('rate', 'Amount', 'trim|required');
        $this->form_validation->set_rules('miles', 'Miles', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editrate/'.$id);
        }
        else
        {
            $data                   =       $_POST;
			
			$checkAvailablity       =   $this->rate_model->checkExistRate_byID($_POST['ship_mode_id'],$_POST['delivery_mode_id'],$_POST['ship_cat_id'],$_POST['ship_subcat_id'],$_POST['ship_sub_subcat_id'],$_POST['rate_type'],$_POST['location_from'],$_POST['location_to'],$id);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Rate Already exists!');
                //echo redirectPreviousPage();
				redirect('admin/rate-list');
                exit;
            }
			//print_r($data); die;
            $updateRate     		=       $this->rate_model->updateRate($id, $data);

            if($updateRate == 1){
                $this->session->set_flashdata('success', 'Rate updated successfully');
                //return redirect('admin/editrate/'.$id);
				redirect('admin/rate-list');
            }
            else{
                $this->session->set_flashdata('error', 'Nothing to update!!');
                return redirect('admin/editrate/'.$id);
				//redirect('admin/rate-list');
            }
        }
    }

    public function deleteRate($id)
    {   
        
        $deleteRate   =   $this->rate_model->deleteRate($id);
        
        if($deleteRate == 1){
            $this->session->set_flashdata('success', 'Rate deleted successfully');
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
	
	public function insertratefactor()
    {
		$amount           =   $this->input->post('amount', TRUE);
		$id               =   $this->input->post('id', TRUE);
		
		$data=array(
			'amount'=>$amount
		);
		
		//print_r($data); die;
		$UpdateRateFactor   =   $this->rate_model->update_rate_factor($data, $id);

		if($UpdateRateFactor > 0){
			$this->session->set_flashdata('success', 'Rate Factor Successfully Updated');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Rate Factor Cannot Updated!!');
			echo redirectPreviousPage();
		}
    }

}